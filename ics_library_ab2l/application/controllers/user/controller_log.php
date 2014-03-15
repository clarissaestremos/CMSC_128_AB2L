<?php

	class Controller_log extends CI_Controller{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('model_check_session');
		}

		function index(){
			$this->show_all_log(false);
		}


		function add_log($message, $type){
			if($this->session->userdata('logged_in_type')!="admin")
            	redirect('index.php/user/controller_login', 'refresh');
			$this->load->model('model_log');
			$this->model_log->add_log($message, $type);
		}
	
		public function remove_unclaimed(){
			$date = date("Y-m-d");
			$this->load->model('model_reservation');
			$data['query'] = $this->model_reservation->show_all_user_book_reservation("reserved",0,0);
			foreach($data['query'] as $reservation){
				if(($reservation->due_date < $date) && ($reservation->rank == 1)){ //if due date is yesterday, or older and is reserved
					$this->model_reservation->delete_book_reservation($reservation->res_number);
				}
			}
		}

		public function update_reservation_status(){
			$date = date("Y-m-d");
			$this->load->model('model_reservation');
			$data['query'] = $this->model_reservation->show_all_user_book_reservation("borrowed",0,0);
			foreach($data['query'] as $reservation){
				if($reservation->due_date < $date){		//if due date is yesterday, or older meaning reservation is already overdue
					$this->model_reservation->update_book_reservation($reservation->res_number, "auto");
				}
			}
		}
	}
?>