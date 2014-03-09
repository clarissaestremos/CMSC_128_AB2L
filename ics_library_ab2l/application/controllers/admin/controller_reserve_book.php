<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

	function confirm_reservation(){
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
							echo "<script>alert('You have successfully reserved a book for user ".$data['borrower'].". Please confirm it.');</script>";
							redirect('index.php/admin/controller_outgoing_books','refresh');
						}
						else{
							$this->model_reserve_book->waitlist_reservation($data);
							echo "<script>alert('There is not enough number of books available. User ".$data['borrower']." is waitlisted.');</script>";
							redirect('index.php/admin/controller_admin_home', 'refresh');
						}	
					}
					else{
						echo "<script>alert('Your account is not yet activated. Please confirm it to the administrator.');</script>";
						redirect('index.php/user/controller_home','refresh');
					}
					
				}
				else{
					echo "<script>alert('A user is allowed to borrow at most 3 books');</script>";
						redirect('index.php/admin/controller_admin_home', 'refresh');
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