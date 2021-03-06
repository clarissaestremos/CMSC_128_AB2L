<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*   This class is used for viewing the list of all books in the library.
*   You can sort the books by title, subject, author, type, and availability in ascending or descending order.
*/
class Controller_books extends CI_Controller {
     function __construct(){
            parent::__construct();
            $this->load->helper("url");
            $this->load->library('Jquery_pagination');
            $this->load->model('model_get_list');
            $this->load->library('pagination');
    }

    /**
    *   Set the title page
    *   Loads the header, page for viewing all books, and footer
    */
    function index() {
        $this->load->helper(array('form','html'));
        
        $data['titlepage'] = "View all books";
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_all_books");
        $this->load->view("user/view_footer");
    }

    /**
    *   Gets the data of all the books in the library
    *   Sorts the books depending on what the user wants
    *   This function includes the configuration for ajax pagination
    */
    public function get_book_data1(){
        $this->input->post('serialised_form');
        $sort_by = addslashes($this->input->post('sort_by')); 
        $order_by = addslashes($this->input->post('order_by')); 
        
        // getting the number of rows for of a query for computing the total row
        $data['result_all']  = $this->model_get_list->select_all_book_info($sort_by,$order_by,NULL,0,0);
        //configuration of the ajax pagination  library.
        $config['base_url'] = base_url().'index.php/user/controller_books/get_book_data1';
        $config['total_rows'] = count($data['result_all']);
        $config['per_page'] = '10';
        $config['div'] = '#change_here';
        $config['additional_param']  = 'serialize_form1()';
        $page=$this->uri->segment(4);       // splits the URI segment by /
        
        //fetches data from database.
        $data['result'] = $this->model_get_list->select_all_book_info($sort_by,$order_by,$data['result_all'],$config['per_page'],$page);
        //display data from database
        
        //initialize the configuration of the ajax_pagination
        $this->jquery_pagination->initialize($config);
        //create links for pagination
        $data['links'] = $this->jquery_pagination->create_links();
        $this->print_books($data['result'],$data['links']);
       
    }

    /**
    *   This function produces the table of result
    */
    public function print_books($result,$links){
        echo "<table class='body fixed'>
                <thead>
                    <tr>
                        <th style='width: 3%;''>#</th>
                        <th style='width: 15%;' nowrap='nowrap'>ISBN</th>
                        <th style='width: 15%;' nowrap='nowrap'>Subject</th>
                        <th style='width: 50%;' nowrap='nowrap'>Material</th>
                        <th style='width: 5%;' nowrap='nowrap'>Type</th>
                        <th style='width: 8%;' nowrap='nowrap'>Availability</th>
                        <th style='width: 13%;' nowrap='nowrap'>Action</th>
                    </tr>
                </thead>
                                            
                <tbody>";
                    $count = 1;
                    foreach($result as $row){
                        echo "<tr>";
                        echo "<td>$count</td>";
                        echo "<td>$row->isbn</td>";

                        $data['multi_valued'] = $this->model_get_list->get_book_subjects($row->id);
                        $subject="";
                        foreach($data['multi_valued'] as $subject_list){
                            $subject = $subject."{$subject_list->subject}<br/>";
                        }
                        echo "<td>".$subject."</td>";

                        echo "<td><b>$row->title</b> <br/>";
                        $data['multi_valued'] = $this->model_get_list->get_book_authors($row->id);
                        $authors="";
                        foreach($data['multi_valued'] as $authors_list){
                            $authors = $authors."{$authors_list->author},";
                        }
                        echo "$authors ($row->year_of_pub)</td>";

                        if ($row->type == "BOOK"){
                            echo "<td><center><img title = 'BOOK' width = 30px height = 30px src='../../images/type_book.png'/></center></td>";
                        }
                        else{
                            //image source: http://www.webweaver.nu/clipart/img/education/diploma.png
                            echo "<td><img title = 'THESIS/SP' width = 30px height = 30px src='../../images/type_thesis.png' /></td>";
                        }
                            
                        echo "<td>".$row->no_of_available. "/" . $row->quantity."</td>";

                        if ($row->type == "BOOK"){
                            if($row->no_of_available != 0){
                                echo "<td><form method='POST' action='controller_reserve_book/verify_login/$row->id'>
                                        <input type='submit' class='background-red table-button' value='Reserve Book'>
                                        </form>
                                    </td>";
                            }
                            else{
                                echo "<td><form method='POST' action='controller_reserve_book/verify_login/$row->id'>
                                        <input type='submit' class='background-red table-button' value='Waitlist'></form>
                                    </td>";
                            }
                        }
                        else{
                            echo "<td>Visit admin to borrow SP/Thesis</td>";
                        }
                        echo "</tr>";
                        
                        $count++;
                    }
                echo" </tbody>
            </table><div class='pagination'>";
            echo $links;
            echo "</div>";
    }
}

/* End of file controller_books.php */
/* Location: ./application/controllers/user/controller_books.php */