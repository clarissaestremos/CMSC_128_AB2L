<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("controller_log.php");
/**
*   This class is used for viewing/editing the list of all books in the library.
*   You can sort the books by title, subject, author, type, and availability in ascending or descending order.
*/
class Controller_book extends Controller_log {   
	function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library('Jquery_pagination');
        $this->load->model('model_get_list');
        $this->load->model('model_book');
        $this->load->library('pagination');
    }

    /**
    *   Set the title page
    *   Loads the header, side container, page for viewing all books, and footer
    */
	public function index()
	{
		$data['parent'] = "Books";
    	$data['current'] = "View Books";
    	
    	$this->load->helper(array('form','html'));
	    $this->load->view("admin/view_header",$data);
	    $this->load->view("admin/view_aside");
	    $this->load->view("admin/view_books");
	    $this->load->view("admin/view_footer");
		
	}

	/**
    *   Gets the data of all the books in the library
    *   Sorts the books depending on what the admin wants
    *   This function includes the configuration for ajax pagination
    */
	public function get_book_data1(){
        $this->input->post('serialised_form');
        $sort_by = addslashes($this->input->post('sort_by')); 
        $order_by = addslashes($this->input->post('order_by')); 
        
        // getting the number of rows for of a query for computing the total row
        $data['result_all']  = $this->model_get_list->select_all_book_info($sort_by,$order_by,NULL,0,0);
        //configuration of the ajax pagination  library.
        $config['base_url'] = base_url().'index.php/admin/controller_book/get_book_data1';
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
    public function print_books($result, $links){
		echo" <table class='body'>
                <thead>
                    <tr>
                        <th style='width: 5%;'>#</th>
        				<th style='width: 10%;'><center>Call Number</center></th>
                        <th style='width: 10%;'><center>Subject</center></th>
                        <th style='width: 50%;'><center>Material</center></th>
                        <th style='width: 7%;'><center>Type</center></th>
                        <th style='width: 5%;'><center>Qty</center></th>
                        <th style='width: 8%;'></th>
                    </tr>
                </thead> 
                <tbody>";                
                    $count = 1;
                    foreach($result as $row){
                        echo "<tr>";
                        echo "<td>$count</td>";

                        $data['query1'] = $this->model_get_list->get_book_call_numbers($row->id);
                        $call_number="";
                        foreach($data['query1'] as $call_number_list){
                            $call_number .= "{$call_number_list->call_number}<br/> ";
                        }
                        echo "<td>{$call_number}</td>";
                        
                        $data['query1'] = $this->model_get_list->get_book_subjects($row->id);
                        $subjects ="";
                        foreach($data['query1'] as $subjects_list){
                            $subjects .= "{$subjects_list->subject}<br/> ";
                        }
                        echo "<td>{$subjects}</td>";

                        echo "<td><b>{$row->title}</b><br/>";
                        $data['query1'] = $this->model_get_list->get_book_authors($row->id);
                        $authors ="";
                        foreach($data['query1'] as $authors_list){
                            $authors .= "{$authors_list->author},";
                        }
                       	echo"{$authors} ({$row->year_of_pub})<br/>";
                       		if ($row->isbn != NULL)
                       			echo "ISBN:{$row->isbn}";
                       echo"</td>";
                       
                        //image source: http://3.bp.blogspot.com/-hUGEJQbn1Hk/ULY_bdWVgdI/AAAAAAAAAd0/Z2vFFfsae_4/s1600/Red_book_cover.png
                        if ($row->type == "BOOK"){
                            echo "<td><center><img title = 'BOOK' width = 30px height = 30px src='../../images/type_book.png'/></center></td>";
                        }

                        else
                       		 //image source: http://www.webweaver.nu/clipart/img/education/diploma.png
                        	 echo "<td><img title = 'THESIS/SP' width = 30px height = 30px src='../../images/type_thesis.png' /></td>";


                        echo "<td>{$row->no_of_available}/{$row->quantity}</td>

                        <td>";
                        $base = base_url();
                        echo "<form action='$base"."index.php/admin/controller_book/edit/' method='post'>
                                <input type=\"hidden\" name=\"id\" value=\"{$row->id}\" />
                                <input type='submit' class='background-red' name='edit' value='Edit' enabled/>
                            </form>
                        </td>
                        ";
                        echo "</tr></tr>";
                        $count++;
                    }
               
          	echo "</tbody>
        	</table>
	        <div class='footer pagination'>";
	            echo $links;
	        echo"</div>";

    }
	
	/**
	*	Adds a book in the database
	*/
	public function call_add(){
		//gets the username of the account currently logged in
		$session_user = $this->session->userdata('logged_in')['username'];

		//checks if the user is an administrator
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		
		if(isset($_POST['sub'])){
			$call_number = array_unique ($_POST['call_number']);
			$title = htmlspecialchars($_POST['title1']);
			$author = array_unique ($_POST['author']);
			$subject = array_unique ($_POST['subject']);
			$isbn = htmlspecialchars($_POST['isbn']);
			$year_of_pub = htmlspecialchars($_POST['year_of_pub']);
			$type = strtoupper ($_POST['type1']);
			$quantity = sizeof($call_number);
			$no_of_available = $quantity;
			$book_stat = 0;
			$tags = array_unique ($_POST['tags']);
			
			$id = $this->model_book->insert_book_info($call_number, $title, $year_of_pub, $isbn, $type, $no_of_available, $quantity, $book_stat, $author, $subject, $tags);
			if($type== "BOOK"){
				$type = ucfirst($type);
				$message = "Admin $session_user added a new $type with ISBN: $isbn";
			}else{
				$cn="";
				foreach ($call_number as $value3) {
					$cn .= $value3.", ";
				}
				$message = "Admin $session_user added a new $type with Call Number(s): $cn";
			}
			$this->add_log($message,"Add Book");	
			$this->call_success();
		}
	}
	
	/**
	*	Checks if the isbn is already registered in the database
	*/
	public function check_isbn($isbn){
		$this->db->where('isbn',$isbn);
        $query = $this->db->get('book')->num_rows();
        if($query == 0 ){
           echo 'userOk';
           return true;
	    }
	    else{
	    	echo 'userNo';
	    	return false;
	    }
	}

	/**
	*	Prompts that the admin successfully added a new material
	*/
	public function call_success(){

		//checks if the user is an administrator
		if($this->session->userdata('logged_in_type')!="admin")
        	redirect('index.php/user/controller_login', 'refresh');
		$base = base_url();
		echo "<div id='mysuccess' title='Add Book Success'>
		<h6>You have successfully added a new material!!</h6>
		</div>
		<script src='$base/js/jquery-1.10.2.min.js'></script>
		<script src='$base/js/jquery-ui.js'></script>
		<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
		<script>
			$('#mysuccess').dialog({
	            modal: true,
	            closeOnEscape: true,
	            resizable: false,
			      width: 300,
			      minHeight: 200,
	            closeText: 'show',
	            show: {
	              effect: 'fadeIn',
	              duration: 200
	            },
	            draggable: false,
	            close: function(event, ui){
	                window.location.replace('$base/index.php/admin/controller_add_books');
	            },
	            buttons : {
	              'Ok': function() {
	                  window.location.replace('$base/index.php/admin/controller_add_books');
	              },
	            }
	 
	        });
		</script>";
	}
	
	/**
	*	function for editing an attribute in a material
	*/
	function edit(){
		//gets the username of the account currently logged in
		$session_user = $this->session->userdata('logged_in')['username'];

		//checks if the user is an administrator
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$book = $this->model_get_list->get_by_id($id);
			$data['book'] = $book;

			$data['parent'] = "Books";
	    	$data['current'] = "Books";
	    	$data['user'] = $this->session->userdata('logged_in');

	    	//loads the header, side container, page for editing a material, and footer
			$this->load->helper(array('form','html'));
			$this->load->view("admin/view_header",$data);
			$this->load->view("admin/view_aside");
			$this->load->view('admin/view_edit_book', $data);
			$this->load->view("admin/view_footer");	
		}
		else{
			redirect('index.php/admin/controller_book', 'refresh');
		}
	}

	function edit_book(){
		$session_user = $this->session->userdata('logged_in')['username'];
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$this->load->model('model_book');
		$id = $this->input->post('id');
		$call_numbers = array_unique ($this->input->post('call_number'));
		$book_authors = array_unique ($this->input->post('author'));
		$book_subjects = array_unique ($this->input->post('subject'));
		$tags = array_unique ($this->input->post('tags'));
		$isbn = $this->input->post('isbn');
		$typeCheck = $this->input->post('type');

		if(sizeof($call_numbers) >= 1){
			if ($typeCheck != "BOOK")
				$isbn = "";
			$book = array(
				'title' => $this->input->post('title'),
				'year_of_pub' => $this->input->post('year_of_pub'),
				'no_of_available' => $no_of_available,
				'type' => strtoupper($this->input->post('type')),
				'isbn' => $isbn,
				'quantity' => sizeof($call_numbers),
			);

			$this->model_book->edit_book($id, $book, $call_numbers, $book_authors, $book_subjects, $tags);
			$this->add_log("Admin $session_user updated book with ID Number: $id", "Update Book");
			$this->edit_success();	
		}
		else{

			$newdata = array('id' => $id);
			$this->session->set_userdata($newdata);
			echo "<div id='mysuccess' title='Empty Call Number'>
					<h6>A book must have at least one copy. Do you want to delete the record of the book in the library?</h6>
				</div>
				<script src='$base/js/jquery-1.10.2.min.js'></script>
				<script src='$base/js/jquery-ui.js'></script>
				<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
				<script>
						$('#mysuccess').dialog({
					      	modal: true,
					        resizable: false,
					        width: 300,
					        minHeight: 200,
					      	closeOnEscape: true,
					      	closeText: 'show',
					      	show: {
					       	 	effect: 'fadeIn',
					        	duration: 500
					      	},
					      	hide: {
					        	effect: 'fadeOut',
					        	duration: 500
					      	},
					      	draggable: false,
					      	buttons : {
					        	'Yes': function() {
					            	$(this).dialog('close');
					              	window.location.replace('$base/index.php/admin/controller_book/delete');
					        	},
					        	'No': function() {
					            	$(this).dialog('close');
					        	}
					      	}
					      });
			</script>";
			$this->session->unset_userdata('id');
		}
		
	}

	function edit_success(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$session_user = $this->session->userdata('logged_in')['username'];
		$base = base_url();
		echo "<div id='mysuccess' title='Edit Book Success'>
					<h6>You have successfully edited the material!!</h6>
				</div>
				<script src='$base/js/jquery-1.10.2.min.js'></script>
				<script src='$base/js/jquery-ui.js'></script>
				<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
				<script>
						$('#mysuccess').dialog({
				            modal: true,
				            closeOnEscape: true,
				            resizable: false,
						      width: 300,
						      minHeight: 200,
				            closeText: 'show',
				            show: {
				              effect: 'fadeIn',
				              duration: 200
				            },
				            draggable: false,
				            close: function(event, ui){
				                window.location.replace('$base/index.php/admin/controller_book');
				            },
				            buttons : {
				              'Ok': function() {
				                  window.location.replace('$base/index.php/admin/controller_book');
				              },
				            }
				 
				        });
			</script>";
	}
	
	//DELETE
	function delete(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		$session_user = $this->session->userdata('logged_in')['username'];
		$this->load->model('model_book');
		$id = $this->session->userdata('id');
		$this->session->unset_userdata('id');
		$this->add_log("Admin $session_user deleted book with ID Number: $id", "Delete Book");
		$this->model_book->delete_book($id);
		$base = base_url();
		echo "
		<div id='mysuccess' title='Delete Book Success'>
			<h6>You have successfully deleted a material!!</h6>
		</div>
		<script src='$base/js/jquery-1.10.2.min.js'></script>
		<script src='$base/js/jquery-ui.js'></script>
		<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
		<script>
				$('#mysuccess').dialog({
		            modal: true,
		            closeOnEscape: true,
		            closeText: 'show',
		            resizable: false,
				    width: 300,
				    minHeight: 200,
		            show: {
		              effect: 'fadeIn',
		              duration: 200
		            },
		            draggable: false,
		            close: function(event, ui){
		                window.location.replace('$base/index.php/admin/controller_book');
		            },
		            buttons : {
		              'Ok': function() {
		                  window.location.replace('$base/index.php/admin/controller_book');
		              },
		            }
		 
		        });
			</script>";
	}

	function edit_cancel(){
        redirect('index.php/admin/controller_book', 'refresh');
	}
}
 ?>

