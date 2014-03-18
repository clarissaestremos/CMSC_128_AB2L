<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Controller_reserve_book extends CI_Controller{
		
		function __construct(){
			parent::__construct();
			$this->load->model('model_reserve_book');
        		$this->load->library(array('form_validation','session'));
        		$this->load->helper(array('form','html'));
        		$this->load->model('model_check_session');
		}

		function index(){
			if($this->session->userdata('id') == FALSE){
				redirect('index.php/admin/controller_search_book', 'refresh');
			}
			$data['page_title'] = 'Reservation Page';
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
			$data['borrower'] = $this->session->userdata('borrower');
			$row = $this->model_reserve_book->fetch_user2($data['borrower']);
			foreach ($row->result() as $value) {
				$data['borrower_username'] = $value->username;
			}
			$data['parent'] = "Books";
    			$data['current'] = "Reserve";

		        $this->load->helper(array('form','html'));
		        $this->load->view("admin/view_header",$data);
		        $this->load->view("admin/view_aside");
		        $this->load->view("admin/view_reserve_book", $data);
		        $this->load->view("admin/view_footer");
		}
		
		/* This function checks if the user who want to reserve a book is logged in. */
		function verify_login($id){
        		if($this->model_check_session->check_admin_session() != TRUE)
            			redirect('index.php/user/controller_home', 'refresh');
			else{
				$id = urldecode($id);
				$newdata = array(
					'id' => $id
				);
				$this->session->set_userdata($newdata);
				if($this->session->userdata('borrower')){
					redirect('index.php/admin/controller_reserve_book', 'refresh');
				}
				else{
					redirect('index.php/admin/controller_view_users', 'refresh');
				}
			}
		}
		
		/* This function confirms the reservation of a book. */
		function confirm_reservation(){
			$base = base_url();
        		if($this->model_check_session->check_admin_session() != TRUE)
            			redirect('index.php/user/controller_home', 'refresh');
        		else{
        			if($this->session->userdata('id') != FALSE && $this->session->userdata('borrower') != FALSE){
					$data['id'] = $this->session->userdata('id');
					$data['borrower'] = $this->session->userdata('borrower');
					$this->session->unset_userdata('id');
					$this->session->unset_userdata('borrower');
					$row = $this->model_reserve_book->fetch_user($data['borrower']);
					foreach ($row->result() as $value) {
						$data['borrower'] = $value->account_number;
					}
					$num_borrowed = $this->model_reserve_book->fetch_user_reservation($data['borrower'])->num_rows();
					if($num_borrowed < 3){
						// echo "<script>console.log("$num_borrowed==0")</script>";
						$row = $this->model_reserve_book->fetch_user2($data['borrower']);
						foreach ($row->result() as $value) {
							$user_status = $value->status;
						}
						if($user_status == 'approve'){
							// echo "<script>console.log("$user_status==approve")</script>";
							$row = $this->model_reserve_book->fetch_book($data['id']);
							if($row->num_rows() == 1){
								foreach ($row->result() as $value) {
									$no_of_available = $value->no_of_available;
								}
							}
							
							//if the user's account is approved, and his number of borrowed/reserved books is less than three,
							//and there is an available copy of the book, then he is allowed to reserve it
							if($no_of_available > 0){
								// echo "<script>console.log("$no_of_available==0")</script>";
								if($this->model_reserve_book->add_reservation($data)){
									echo "<div id='mysuccess' title='Success: Reserved'>
										<h5>You have successfully reserved a book for user ".$data['borrower'].". Please confirm it.</h5>
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
									                window.location.replace('$base/index.php/admin/controller_outgoing_books');
									            },
									            buttons : {
									              'Ok': function() {
									                  window.location.replace('$base/index.php/admin/controller_outgoing_books');
									              },
									            }
									 
									        });
									</script>";	
								}
							
							}
							
							//but if there are no available copy of the book, then the user will be waitlisted for that material
							else{
								if($this->model_reserve_book->waitlist_reservation($data)){
									echo "<div id='mysuccess' title='Success: Waitlisted'>
										<h5>There is not enough number of books available. User ".$data['borrower']." is waitlisted.</h5>
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
									                window.location.replace('$base/index.php/admin/controller_outgoing_books');
									            },
									            buttons : {
									              'Ok': function() {
									                  window.location.replace('$base/index.php/admin/controller_outgoing_books');
									              },
									            }
									 
									        });
									</script>";
								}
							}	
					}
					//if the user's account is not yet activated, he is not allowed to reserve a book
					else{
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
						redirect('index.php/user/controller_home','refresh');
					}
					
				}
				//if the user currently has three borrowed/reserved books, then he will not be allowed to reserve another
				else{
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
						                window.location.replace('$base/index.php/user/controller_home');
							},
							buttons : {
								'Ok': function() {
								 	window.location.replace('$base/index.php/admin/controller_admin_home');
								 },
								            }
								 
						});
					</script>";
				}
				
				}
				else{
					if($this->session->userdata('borrower')){
						redirect('index.php/admin/controller_search_book', 'refresh');
					}
					else{
						redirect('index.php/admin/controller_view_users', 'refresh');
					}
				}
        		}
		}
	}
