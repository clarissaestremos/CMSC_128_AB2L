<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_reserve_book extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('model_reserve_book');
	}

	function index(){
		if($this->session->userdata('id') == FALSE){
			redirect('index.php/user/controller_search_book', 'refresh');
		}
		$data['titlepage'] = 'Reservation Page';
		$data['id'] = urldecode($this->session->userdata('id'));
		$row=$this->model_reserve_book->fetch_book($data['id']);
		if($row->num_rows()>0){
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
		$data['borrower'] = $this->session->userdata('logged_in')['username'];
		$data['parent'] = "Books";
    	$data['current'] = "Reserve";

        $this->load->helper(array('form','html'));
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_reserve_book", $data);
        $this->load->view("user/view_footer");
	}

	function verify_login($id){
		$id = urldecode($id);
			$newdata = array(
				'id' => $id
				);
			$this->session->set_userdata($newdata);
			
		if($this->session->userdata('logged_in') == FALSE){
			redirect('index.php/user/controller_login', 'refresh');
		}
		else{
			redirect('index.php/user/controller_reserve_book');
		}
	}

	function confirm_reservation(){
		$base = base_url();
		if($this->session->userdata('id') != FALSE && $this->session->userdata('logged_in') != FALSE){
			$data['id'] = $this->session->userdata('id');
			$this->session->unset_userdata('id');
			$row = $this->model_reserve_book->fetch_user($this->session->userdata('logged_in')['username']);
			foreach ($row->result() as $value) {
				$data['borrower'] = $value->account_number;
			}
			$num_borrowed = $this->model_reserve_book->fetch_user_reservation($data['borrower'])->num_rows();
			if($num_borrowed < 3){
				$row = $this->model_reserve_book->fetch_user2($data['borrower']);
				foreach ($row->result() as $value) {
					$user_status = $value->status;
				}
				if($user_status == 'approve'){
					$row = $this->model_reserve_book->fetch_book($data['id']);
					if($row->num_rows() == 1){
						foreach ($row->result() as $value) {
							$no_of_available = $value->no_of_available;
						}
					}
					
					if($no_of_available > 0){
						$this->model_reserve_book->add_reservation($data);
						echo "<div id='mysuccess' title='Delete Book Success'>
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
					else{
						$this->model_reserve_book->waitlist_reservation($data);
						echo "<div id='mysuccess' title='Delete Book Success'>
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
				else{
					echo "<div id='mysuccess' title='Delete Book Success'>
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
				echo "<div id='mysuccess' title='Delete Book Success'>
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
			if($this->session->userdata('logged_in'))
				redirect('index.php/user/controller_search_book', 'refresh');
			else redirect('index.php/user/controller_login', 'refresh');
			
		}
		
	}

}