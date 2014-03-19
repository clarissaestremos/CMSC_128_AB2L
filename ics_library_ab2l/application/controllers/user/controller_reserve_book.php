<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_reserve_book extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('model_reserve_book');
	}

	function index(){
		if($this->session->userdata('id') == FALSE){
			redirect('index.php/user/controller_search_book', 'refresh');// redirect to controller_search_book
		}
		$data['titlepage'] = 'Reservation Page';  //displays reservation page
		$data['id'] = urldecode($this->session->userdata('id'));
		$row=$this->model_reserve_book->fetch_book($data['id']);
		if($row->num_rows()>0){ // displays book details from the database 
			foreach($row->result() as $book_details){
				$data['title'] = $book_details->title;
				$data['year_of_pub'] = $book_details->year_of_pub;
				$data['type'] = $book_details->type;
				$newdata = array();
				$arow = $this->model_reserve_book->fetch_book_author($data['id']);
				//display data from database
				if($arow->num_rows()>0){
					foreach($arow->result() as $abook_details){
						array_push($newdata, $abook_details->author);
					}
				}
				else{}
				$data['author'] = $newdata;	
			}
		}
		$data['borrower'] = $this->session->userdata('logged_in')['username'];// the data borrower is the username of the logged-in user
		$data['parent'] = "Books";  //the data parent will be "Books"
    $data['current'] = "Reserve"; // the current data will be "Reserve"

        $this->load->helper(array('form','html'));
        $this->load->view("user/view_header",$data);  // displays the header
        $this->load->view("user/view_reserve_book", $data); //  displays view_reserve_book
        $this->load->view("user/view_footer");  //displays footer
	}

	function verify_login($id){ // function for verification if the user is logged in
		$id = urldecode($id);
			$newdata = array(
				'id' => $id
				);
			$this->session->set_userdata($newdata);
			
		if($this->session->userdata('logged_in') == FALSE){ // if the user is not logged in, redirect to login page
			redirect('index.php/user/controller_login', 'refresh');
		}
		else{
			redirect('index.php/user/controller_reserve_book'); // redirect to controller_reserve_book
		}
	}

	function confirm_reservation(){ // function to confirm reservation
		$base = base_url();
		if($this->session->userdata('id') != FALSE && $this->session->userdata('logged_in') != FALSE){  // if user is logged in,
			$data['id'] = $this->session->userdata('id');
			$this->session->unset_userdata('id');
			$row = $this->model_reserve_book->fetch_user($this->session->userdata('logged_in')['username']);
			foreach ($row->result() as $value) {  // an account number will be assigned to the borrower
				$data['borrower'] = $value->account_number;
			}
			$num_borrowed = $this->model_reserve_book->fetch_user_reservation($data['borrower'])->num_rows(); // get the number of borrowed books
				if($num_borrowed < 3){  //if it is less than 3, allow user to reserve book
				$row = $this->model_reserve_book->fetch_user2($data['borrower']);
				foreach ($row->result() as $value) {
					$user_status = $value->status;  //a status will be assigned as user_status
				}
				if($user_status == 'approve'){  //user_staus is approve
					$row = $this->model_reserve_book->fetch_book($data['id']);
					if($row->num_rows() == 1){
						foreach ($row->result() as $value) {
							$no_of_available = $value->no_of_available; //number of available books will be assigned to $no_of_available
						}
					}
					
					if($no_of_available > 0){ //if available book is greater than 0, prompt success in reserving the book
						$data['updatechecker'] = false;
						if($this->model_reserve_book->add_reservation($data)){
							echo "<div id='mysuccess' title='Success: Reserved'>
									<h5>You have successfully reserved a book. Please confirm it to the administrator..</h5>
								</div>
								<script src='$base/js/jquery-1.10.2.min.js'></script>
								<script src='$base/js/jquery-ui.js'></script>
								<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
								<script>
										$('#mysuccess').dialog({
								            modal: true,
								            closeOnEscape: true,
								            closeText: 'show',
								            show: {
								              effect: 'fadeIn',
								              duration: 200
								            },
								            draggable: false,
								            close: function(event, ui){
								                window.location.replace('$base/index.php/user/controller_book/user_reserved_list/');
								            },
								            buttons : {
								              'Ok': function() {
								                  window.location.replace('$base/index.php/user/controller_book/user_reserved_list/');
								              },
								            }
								 
								        });
							</script>";
						}
						
					}
					else{
					  //else, prompt that user is waitlisted for reservation of book
						if($this->model_reserve_book->waitlist_reservation($data)){
						echo "<div id='mysuccess' title='Success: Waitlisted'>
									<h5>There is not enough number of books available. You are waitlisted.</h5>
								</div>
								<script src='$base/js/jquery-1.10.2.min.js'></script>
								<script src='$base/js/jquery-ui.js'></script>
								<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
								<script>
										$('#mysuccess').dialog({
								            modal: true,
								            closeOnEscape: true,
								            closeText: 'show',
								            show: {
								              effect: 'fadeIn',
								              duration: 200
								            },
								            draggable: false,
								            close: function(event, ui){
								                window.location.replace('$base/index.php/user/controller_book/user_reserved_list/');
								            },
								            buttons : {
								              'Ok': function() {
								                  window.location.replace('$base/index.php/user/controller_book/user_reserved_list/');
								              },
								            }
								 
								        });
							</script>";	
						}

						
					}	
				}
				else{
				  // else, the account is not yet validated by the admin
					echo "<div id='mysuccess' title='Error: Account Activation'>
									<h5>Your account is not yet activated. Please confirm it to the administrator.</h5>
								</div>
								<script src='$base/js/jquery-1.10.2.min.js'></script>
								<script src='$base/js/jquery-ui.js'></script>
								<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
								<script>
										$('#mysuccess').dialog({
								            modal: true,
								            closeOnEscape: true,
								            closeText: 'show',
								            show: {
								              effect: 'fadeIn',
								              duration: 200
								            },
								            draggable: false,
								            close: function(event, ui){
								                window.location.replace('$base/index.php/user/controller_home');
								            },
								            buttons : {
								              'Ok': function() {
								                  window.location.replace('$base/index.php/user/controller_home');
								              },
								            }
								 
								        });
							</script>";
				}
				
			}
			else{
			  //else, prompt that the user already exceeded the limits of reserving a book
				echo "<div id='mysuccess' title='Error: Reservation Limitation'>
									<h5>A user is allowed to borrow and reserve at most 3 books</h5>
								</div>
								<script src='$base/js/jquery-1.10.2.min.js'></script>
								<script src='$base/js/jquery-ui.js'></script>
								<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
								<script>
										$('#mysuccess').dialog({
								            modal: true,
								            closeOnEscape: true,
								            closeText: 'show',
								            show: {
								              effect: 'fadeIn',
								              duration: 200
								            },
								            draggable: false,
								            close: function(event, ui){
								                window.location.replace('$base/index.php/user/controller_book/user_borrowed_list');
								            },
								            buttons : {
								              'Ok': function() {
								                  window.location.replace('$base/index.php/user/controller_book/user_borrowed_list');
								              },
								            }
								 
								        });
							</script>";
			}
			
		}
		else{
			if($this->session->userdata('logged_in')) // if logged in, redirect to controller_search_book
				redirect('index.php/user/controller_search_book', 'refresh');
			else redirect('index.php/user/controller_login', 'refresh');// else, redirect to login page
			
		}
		
	}

}

/* End of file controller_reserve_book.php */
/* Location: ./application/controllers/admin/controller_reserve_book.php */