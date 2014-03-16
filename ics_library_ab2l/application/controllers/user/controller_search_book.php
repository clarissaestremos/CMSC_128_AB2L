<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	This class is used for searching to know if a book is available in the library.
*/
class Controller_search_book extends CI_Controller {
 	function __construct(){
		parent::__construct();
		$this->load->model('model_search_book');
		$this->load->model('model_get_list');
		$this->load->library('Jquery_pagination');
		$this->load->library('pagination');
	}

	/**
	*	Gets the input if the user used the header search for searching
	*	Set the title page
	*	Loads the header, page for searching a book, and footer
	*/
    function index(){
    	if(isSet($_POST['category'])) $data['category']=addslashes($this->input->post('category'));
    	if(isSet($_POST['hinput'])) $data['text']=addslashes($this->input->post('hinput'));
    	
    	$data['titlepage'] = "Books - Search";

        $this->load->helper(array('form','html'));
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_search_book");
        $this->load->view("user/view_footer");
    }

    /**
    *	Prints suggestions for the user.
    *	Triggered everytime a user type a character in the search input field
    */
    public function autosuggest(){
		//for escape characters
		$str = addslashes($this->input->post('str'));
		$category = addslashes($this->input->post('category'));
		$row = $this->model_search_book->find_suggestion($str, $category);
		// echo a list where each li has a set_activity function bound to its onclick() event
		echo "<div id='selectItems'><ul>";
		foreach ($row->result() as $activity) {
			echo '<li id="'.$activity->$category.'" class="howver" onclick="setActivity(\''.$activity->$category.'\',\'search_form\')"><a>'.$activity->$category.'</a></li>'; 
		}
		echo "</ul></div>";
	}
/**
	public function refreshpage(){
		redirect('index.php/user/controller_search_book', 'refresh');
	}
*/

	/**
    *   Gets the data of the book included in the results in searching
    *   This function includes the configuration for ajax pagination
    */
	public function get_book_data(){
		$this->input->post('serialised_form');
		
		//input declaration using POST in form
		$data['str'] = addslashes($this->input->post('sinput'));
		$data['category'] = addslashes($this->input->post('category'));
		if($this->input->post('title')!=="") $data['title'] = addslashes($this->input->post('title'));
		if($this->input->post('author')!=="") $data['author'] = addslashes($this->input->post('author'));
		if($this->input->post('year_of_pub')!=="") $data['year_of_pub'] = addslashes($this->input->post('year_of_pub'));
		if($this->input->post('subject')!=="") $data['subject'] = addslashes($this->input->post('subject'));
		if($this->input->post('tag_name')!=="") $data['tag_name'] = addslashes($this->input->post('tag_name'));
		
		// getting the number of rows for of a query for computing the total row
		$row_number=$this->model_search_book->fetch_book_data($data,0,0);
		//configuration of the ajax pagination  library.
		$config['base_url'] = base_url().'index.php/user/controller_search_book/get_book_data';		//EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
		$config['total_rows'] = $row_number->num_rows();
		$config['per_page'] = '10';
		$config['div'] = '#list_area';
		$config['additional_param']  = 'serialize_form()';
		$page=$this->uri->segment(4);		// splits the URI segment by /
		
		//fetches data from database.
		$row = $this->model_search_book->fetch_book_data($data,$config['per_page'],$page);
		//display data from database
		
		//initialize the configuration of the ajax_pagination
		$this->jquery_pagination->initialize($config);
		//create links for pagination
		$data['links'] = $this->jquery_pagination->create_links();
        $this->print_books($row, $data['links']);

	}

	/**
    *   This function produces the table of result
    */
	public function print_books($row, $links){
		if($row->num_rows()>0){
			echo"<div class='panel datasheet'>
	                <div class='header text-center background-red'>
	                    Search Results
	                </div>
	                <table class='body fixed'>
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
		                    foreach($row->result() as $row){
		                        $this->load->model('model_get_list');
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
		                                        <input type='submit' class='background-red table-button' value='Reserve Book'></form>
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
		else if($row->num_rows() == 0){
			echo"<div class='panel datasheet'>
            		<div class='header text-center background-red'>
                    	No results found.
                	</div>
                </div>";
		}

		
	}
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */