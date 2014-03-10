<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_book extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('model_check_session','',TRUE);
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
        $this->load->library('Jquery_pagination');
        $this->load->model('model_get_list');
            $this->load->model('model_book');
            $this->load->library('pagination');
    }


	public function index()
    {
    }

    public function user_reserved_list(){
        $this->load->helper(array('form','html'));
        if($this->model_check_session->check_session() == TRUE){
        
        $session_data = $this->session->userdata('logged_in');
        $acc = $session_data['username'];                       
        $data['title'] = $acc." :: Reserved Books";
        $this->load->model("model_get_list");
        $data['result'] = $this->model_get_list->get_list($acc,"reserved",NULL,0,0);
        $data['titlepage'] = "Reserved books";
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_reserved_books",$data);
        $this->load->view("/user/view_footer");
        }else{
        //If no session, redirect to login page
            redirect('index.php/user/controller_login', 'refresh');
        }
    }
  public function get_book_data(){

        $session_data = $this->session->userdata('logged_in');
        $acc = $session_data['username'];


        $this->input->post('serialised_form');
        $data['result_all']  = $this->model_get_list->select_returned_books($acc,"due_date","asc",NULL,0,0);

        //configuration of the ajax pagination  library.
        $config['base_url'] = base_url().'index.php/user/controller_book/get_book_data';        //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = count($data['result_all']);
        $config['per_page'] = '3';
        $config['div'] = '#change_here';
      //  $config['additional_param']  = 'serialize_form1()';

        $page=$this->uri->segment(4);       // splits the URI segment by /
        
        $data['result'] = $this->model_get_list->select_returned_books($acc,"due_date","asc",$data['result_all'],$config['per_page'],$page);
        $this->jquery_pagination->initialize($config);
        //$this->pagination->initialize($config);
        $data['links'] = $this->jquery_pagination->create_links();
        $this->print_returned_books($data['result'],$data['links']);   
    }	


    public function print_returned_books($result,$links){
echo  ' <table class="body fixed">
        <thead>
            <tr>
                <th style="width: 2%;">#</th>
                <th style="width: 10%;" nowrap="nowrap">Subject</th>
                <th style="width: 40%;" nowrap="nowrap">Material</th>
                <th style="width: 6%;" nowrap="nowrap">Type</th>
                <th style="width: 10%;" nowrap="nowrap">Date Borrowed</th>
                <th style="width: 10%;" nowrap="nowrap">Date Returned</th>
            </tr>
        </thead>
        <tbody>';

                 $count = 1;
                $base = base_url();
                  foreach($result as $row){
                            echo "<tr>";
                                echo "<td>$count</td>";
                                            
                                $data['multi_valued'] = $this->model_get_list->get_book_subjects($row->id);
                                $subjects = "";
                                foreach ($data['multi_valued'] as $subject_list)
                                    $subjects = $subjects."{$subject_list->subject}<br/>";
                                echo "<td>".$subjects."</td>";            
                                            
                                echo "<td><b>$row->title</b> <br/>";
                                $data['multi_valued'] = $this->model_get_list->get_book_authors($row->id);
                                $authors="";
                                foreach($data['multi_valued'] as $authors_list){
                                    $authors = $authors."{$authors_list->author},";
                                }
                                echo "$authors ($row->year_of_pub)</td>";

                                if ($row->type == "BOOK"){
                                    echo "<td><center><img title = 'BOOK' width = 30px height = 30px src='../../../images/type_book.png'/></center></td>";
                                }
                                else
                                    //image source: http://www.webweaver.nu/clipart/img/education/diploma.png
                                    echo "<td><img title = 'THESIS/SP'  width = 30px height = 30px src='../../../images/type_thesis.png' /></td>";
                                echo "<td>".$row->date_borrowed."</td>";
                                echo "<td>".$row->date_returned."</td>";
                            echo "</tr>";
                            
                            $count++;
            
                                        
                    }
    echo" </tbody>
</table><div class='pagination'>";
echo $links;
echo "</div>";
}


	
	
	public function user_borrowed_list(){
		
		if($this->model_check_session->check_session() == TRUE){
		
		$session_data = $this->session->userdata('logged_in');
		$acc = $session_data['username'];						
		$data['title'] = $acc." :: Borrowed Books";
		$data['titlepage'] = "Borrowed Books";
		$this->load->model("model_get_list");
		
		$this->load->view("user/view_header",$data);

		$data['result1'] = $this->model_get_list->get_list($acc,"overdue",NULL,0,0);
        $data['message1'] = "There are no overdue books!";
		$data['header1'] = "List of overdue books";

		$data['result2'] = $this->model_get_list->get_list($acc,"borrowed",NULL,0,0);
		$data['header2'] = "List of borrowed books";
		$data['message2'] = "There are no borrowed books!";

        $data['result3'] = $this->model_get_list->get_list($acc,"returned",NULL,0,0);
        $data['message3'] = "There are no returned books!";
		$data['header3'] = "List of returned books";
		$this->load->view("user/view_borrowed_books",$data);
        $this->load->view("/user/view_footer");
		}else{
        //If no session, redirect to login page
            redirect('index.php/user/controller_login', 'refresh');
        }
	}

	public function cancel(){
		$res_number = $_POST['res_number'];
		$call_number = $_POST['call_number'];
		//$id = $_POST['id'];
		$rank = $_POST['rank'];
		$this->load->model("model_get_list");
		$this->model_get_list->cancel_reservation($res_number);
		$this->model_get_list->update_rank($call_number);
		$this->model_get_list->update_available($call_number);
		
		$this->load->helper(array('form','html'));
		if($this->model_check_session->check_session() == TRUE){
		
		$session_data = $this->session->userdata('logged_in');
		$acc = $session_data['username'];						
		$data['title'] = $acc." :: Reserved Books";
		$this->load->model("model_get_list");
		$data['result'] = $this->model_get_list->get_list($acc,"reserved",NULL,0,0);
		$data['titlepage'] = "Reserved books";
		$data['message'] = 'You cancelled your book reservation';
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_reserved_books",$data);
        $this->load->view("/user/view_footer");
        }else{
        //If no session, redirect to login page
            redirect('index.php/user/controller_login', 'refresh');
        }
	}

}
?>