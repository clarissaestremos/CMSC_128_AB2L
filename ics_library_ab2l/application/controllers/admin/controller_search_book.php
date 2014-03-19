<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_search_book extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_search_book');
		$this->load->library('Jquery_pagination');
		$this->load->library('pagination');
	}
	
	function index() {
    	if($this->session->userdata('id') && $this->session->userdata('borrower')){
    		redirect('index.php/admin/controller_reserve_book/verify_login/'.$this->session->userdata('id'), 'refresh');
    	}
    	$data['parent'] = "Books";
    	$data['current'] = "Search";

        $this->load->helper(array('form','html'));
        $this->load->view("admin/view_header",$data);
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_search_book");
        $this->load->view("admin/view_footer");
    	}

	/*Autosuggest function*/
	//Fetches data from server and loads it using AJAX.
	public function autosuggest(){
		//for escape characters
		$str = addslashes($this->input->post('str'));
		$category = addslashes($this->input->post('category'));
		$row = $this->model_search_book->find_suggestion($str, $category);
		//displays a list where each li has a set_activity function bound to its onclick() event
		echo "<div id='selectItems'><ul>";
		foreach ($row->result() as $activity) {
			echo '<li id="'.$activity->$category.'" class="howver" onclick="setActivity(\''.$activity->$category.'\',\'search_form\')"><a>'.$activity->$category.'</a></li>'; 
		}
		echo "</ul></div>";
	}

	public function get_book_data(){
		$this->input->post('serialised_form');
		//Input declaration using POST in form
		$data['str'] = addslashes($this->input->post('sinput'));
		$data['category'] = addslashes($this->input->post('category'));
		if($this->input->post('title')!=="") $data['title'] = addslashes($this->input->post('title'));
		if($this->input->post('author')!=="") $data['author'] = addslashes($this->input->post('author'));
		if($this->input->post('year_of_pub')!=="") $data['year_of_pub'] = addslashes($this->input->post('year_of_pub'));
		if($this->input->post('subject')!=="") $data['subject'] = addslashes($this->input->post('subject'));
		if($this->input->post('tag_name')!=="") $data['tag_name'] = addslashes($this->input->post('tag_name'));
		

		//Getting the number of rows for of a query for computing the total row
		$row_number=$this->model_search_book->fetch_book_data($data,0,0);
		//configuration of the ajax pagination  library.
		$config['base_url'] = base_url().'index.php/user/controller_search_book/get_book_data';
		//EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
		$config['total_rows'] = $row_number->num_rows();
		$config['per_page'] = '10';
		$config['div'] = '#list_area';
		$config['additional_param']  = 'serialize_form()';
		$page=$this->uri->segment(4);		// splits the URI segment by /
		//Fetches data from database.
		$row = $this->model_search_book->fetch_book_data($data,$config['per_page'],$page);
		//Displays data
		
		//Initializes the configuration of the ajax_pagination
		$this->jquery_pagination->initialize($config);
		//$this->pagination->initialize($config);
		//creates links for pagination
		$data['links'] = $this->jquery_pagination->create_links();
        
        	$this->print_books($row, $data['links']);
		//echo $this->pagination->create_links();

	}

	public function print_books($row, $links){
		//Displays data from database
		$base = base_url();
		
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
                        <th style='width: 13%;' nowrap='nowrap'>Action</th>
                    </tr>
                </thead>
                                            
                <tbody>";
	        
		$count=1;
		
		foreach($row->result() as $row){
			$this->load->model('model_get_list');
			echo "<tr>
			<td>$count</td>
			<td>$row->isbn</td>";
						
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
			
			else
			//image source: http://www.webweaver.nu/clipart/img/education/diploma.png
				echo "<td><img title = 'THESIS/SP' width = 30px height = 30px src='../../images/type_thesis.png' /></td>";
			
			        echo "<td>".$row->no_of_available. "/" . $row->quantity."</td>";
			        echo "
		        
			        <td><form action='$base"."index.php/admin/controller_book/edit/' method='post'>
			            <input type=\"hidden\" name=\"id\" value=\"{$row->id}\" />
			            <input type='submit' class='background-red' name='edit' value='Edit' enabled/>
			        </form>
			        </td>";
			    
			if($row->no_of_available != 0)
				echo "<td><form method='POST' action='controller_reserve_book/verify_login/$row->id'>
			                <input type='submit' class='background-red table-button' value='Reserve Book'>                                                       </form>
			            </td>";
			else
			        echo "<td><form method='POST' action='controller_reserve_book/verify_login/$row->id'>
			                <input type='submit' class='background-red table-button' value='Waitlist'></form></td>";
			    
			 	echo "</tr>";
				$count++;
			}
				echo" </tbody>
				</table><div class='footer pagination'>";
				echo $links;

	                	"</div></div>";
		}

			else if($row->num_rows() == 0){
				echo"<div class='panel datasheet'>
		                <div class='header text-center background-red'>
		                    No results found.
		                </div></div>";
		
			}

		
	}
}
/* End of file controller_search_book.php */
/* Location: ./application/controllers/user/controller_search_book.php */
