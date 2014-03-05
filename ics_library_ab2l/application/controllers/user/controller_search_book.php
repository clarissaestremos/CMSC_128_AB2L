<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_search_book extends CI_Controller {
 	function __construct(){
		parent::__construct();
		$this->load->model('model_search_book');
		$this->load->library('Jquery_pagination');
		//$this->load->library('pagination');
	}

    function index() {
    	$data['titlepage'] = "Books - Search";

        $this->load->helper(array('form','html'));
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_search_book");
        $this->load->view("user/view_footer");
    }

    //AJAX. DO NOT TOUCH IF YOU ARE NOT FAMILIAR WITH IT. Nah.
	//autosuggest function. Fetches data from server and loads it using AJAX.
	public function autosuggest(){
		//for escape characters
		$str = addslashes($this->input->post('str'));
		$category = addslashes($this->input->post('category'));
		$row = $this->model_search_book->find_suggestion($str, $category);
		// echo a list where each li has a set_activity function bound to its onclick() event
		
		foreach ($row->result() as $activity) {
			echo '<li onclick="set_activity(\''.addslashes($activity->$category).'\'';
			echo ');" class="suggested_list">'.$activity->$category.'</li>'; 
		}
	}

	public function refreshpage(){
		redirect('index.php/user/controller_search_book', 'refresh');
	}

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
		$this->print_books($row);
		
		//initialize the configuration of the ajax_pagination
		$this->jquery_pagination->initialize($config);
		//$this->pagination->initialize($config);
		//create links for pagination
		echo $this->jquery_pagination->create_links();
		//echo $this->pagination->create_links();

	}

	public function print_books($row){
		//display data from database
		if($row->num_rows()>0){
			echo "<div class='panel datasheet'>
					  <div class='header text-center background-red'>
                                            List of Searched Books
                      </div>
                      <table class='body fixed'>
                      <thead>
                          <tr>
                            <th style='width: 5%;'>#</th>
                            <th style='width: 35%;' nowrap='nowrap'>Title</th>
                            <th style='width: 22%;' nowrap='nowrap'>Author</th>
                            <th style='width: 8%;' nowrap='nowrap'>Type</th>
                            <th style='width: 10%;' nowrap='nowrap'>Availability</th>
                            <th style='width: 13%;' nowrap='nowrap'>Action</th>
                          </tr>
                       </thead>";
             $count=1;
			foreach($row->result() as $book_details){
				echo "<tr>
						<td>$count</td>
						<td>$book_details->title</td>";
				echo "<td>";
				$arow = $this->model_search_book->fetch_book_author($book_details->id);
				//display data from database
				if($arow->num_rows()>0){
					foreach($arow->result() as $abook_details){
						echo "$abook_details->author ";
					}
				}
				echo "</td>";
				echo "<td>$book_details->type</td>";
				echo "<td>$book_details->no_of_available</td>";
				echo "<td>";
					if($book_details->no_of_available == 0){	//if book is not available
						//put the transaction code here
						//WAITLIST TRANSACTION CODE HERE
						echo"<form action='controller_reserve_book/verify_login/$book_details->id' method='post'>
							<input type='submit' class='background-red style='font-size: 1.5em;' value='Waitlist'/>
						</form>";
					}else{	
						//and if book is available
						//RESERVE TRANSACTION CODE HERE
						echo "<form action='controller_reserve_book/verify_login/$book_details->id' method='post'>
							<input type='submit' class='background-red style='font-size: 1.5em;' value='Reserve Book'/>
						</form>";
					}
				echo "</td></tr>";
				$count++;
			}
			echo "</table></div>";
		}else{
			echo "Book does not exist in out library";
		}
		
	}
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */