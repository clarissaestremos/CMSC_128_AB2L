<?php
	class Model_reserve_book extends CI_Model{
		//constructor loads the database
		function __construct(){
			parent::__construct();
			$this->load->database();
		}


		function getExpiration($date_reserved){
			$span = 3;
			if($date_reserved['wday'] == 3 || $date_reserved['wday'] == 4 || $date_reserved['wday'] == 5){
				$span += 2;
			}
			else if($date_reserved['wday'] == 6){
				$span++;
			}
			$date2 = $date_reserved['year']."-".$date_reserved['mon']."-".$date_reserved['mday'];
			$date2 = date("Y-m-d", strtotime($date2 ."+".$span." days"));
			$date = date('d', strtotime($date2));
			$month = date('m', strtotime($date2));
			$year = date('Y', strtotime($date2));
			$wday = (($date_reserved['wday']+$span)%8)+1;
			$expired_date = array(
				'mday' => "$date",
				'mon' => "$month",
				'year' => "$year",
				'wday' => "$wday"
				);
			return $expired_date;
		}

		function check_user_and_book($call_number, $borrower){
			$query="*
			FROM book_reservation
			WHERE account_number LIKE '$borrower'
			AND call_number LIKE '$call_number'
			AND (status LIKE 'borrowed'
				OR status LIKE 'reserved'
				OR status LIKE 'overdue')";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function add_reservation($data){
			$flag = true;
			$row = $this->model_reserve_book->fetch_call_number($data['id']);
			foreach ($row->result() as $book_details) {
				$call_number = $book_details->call_number;
				$row2 = $this->model_reserve_book->check_user_and_book($call_number, $data['borrower']);
				if($row2->num_rows > 0){
					$flag = false;
					echo "<div id='mysuccess' title='Error: Duplication of Copy'>
									<h5>Error. You currently have the copy or already reserved/waitlisted for that book.</h5>
							</div>
								<script src='".base_url()."/js/jquery-1.10.2.min.js'></script>
								<script src='".base_url()."/js/jquery-ui.js'></script>
								<link rel='stylesheet' href='".base_url()."/style/jquery-ui.css'/>
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
								                window.location.replace('".base_url()."index.php/user/controller_home');
								            },
								            buttons : {
								              'Ok': function() {
								                  window.location.replace('".base_url()."index.php/user/controller_home');
								              },
								            }
								 
								        });
							</script>";
							break;
				}
			}
			if($flag){
						$date_reserved = getdate();
						$date_expired = $this->model_reserve_book->getExpiration($date_reserved);
						$due_date = $date_expired['year']."-".$date_expired['mon']."-".$date_expired['mday'];
						$due_date = date("Y-m-d", strtotime($due_date));
						
						$row = $this->model_reserve_book->fetch_book($data['id']);
						$no_of_available = $row->result()[0]->no_of_available;
						$book_stat = $row->result()[0]->book_stat;
						
						$row = $this->model_reserve_book->fetch_available_book($data['id']);
						$data['call_number'] = $row->result()[0]->call_number;
						$status = "reserved";
						$rank = 1;
						$call_number = $data['call_number'];
						$newdata = array(
							'rank' => $rank,
							'status' => $status,
							'due_date' => $due_date,
							'date_borrowed' => NULL,
							'date_returned' => NULL,
							'call_number' => $call_number,
							'account_number' => $data['borrower']
							);
						$this->db->insert('book_reservation', $newdata);
						$book_stat++;
						$no_of_available--;
						$newdata2 = array(
							'no_of_available' => $no_of_available,
							'book_stat' => $book_stat
							);
						$this->db->where('id', $data['id']);
						$this->db->update('book', $newdata2);
			}
			return $flag;
		}

		function waitlist_reservation($data){
			$flag = true;
			$row = $this->model_reserve_book->fetch_call_number($data['id']);
			foreach ($row->result() as $book_details) {
					$call_number = $book_details->call_number;
					$row2 = $this->model_reserve_book->check_user_and_book($call_number, $data['borrower']);
					if($row2->num_rows > 0){
						$flag = false;
						echo "<div id='mysuccess' title='Error: Duplication of Copy'>
									<h5>Error. You currently have the copy or already reserved/waitlisted for that book.</h5>
								</div>
								<script src='".base_url()."/js/jquery-1.10.2.min.js'></script>
								<script src='".base_url()."/js/jquery-ui.js'></script>
								<link rel='stylesheet' href='".base_url()."/style/jquery-ui.css'/>
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
								                window.location.replace('".base_url()."index.php/user/controller_home');
								            },
								            buttons : {
								              'Ok': function() {
								                  window.location.replace('".base_url()."index.php/user/controller_home');
								              },
								            }
								 
								        });
							</script>";
						break;
					}
					$row2 = $this->model_reserve_book->fetch_breservation($call_number);
					$rank = $row2->num_rows();
					break;
			}
			if($flag){
						$status = "reserved";
						$rank++;
						$newdata = array(
							'rank' => $rank,
							'status' => $status,
							'due_date' => NULL,
							'date_borrowed' => NULL,
							'date_returned' => NULL,
							'call_number' => $call_number,
							'account_number' => $data['borrower']
							);
			
						$this->db->insert('book_reservation', $newdata);
			
						$row = $this->model_reserve_book->fetch_book($data['id']);
						if($row->num_rows() > 0){
							foreach ($row->result() as $book_details) {
								$book_stat = $book_details->book_stat;
							}
						}
						$book_stat++;
						$newdata2 = array(
							'book_stat' => $book_stat
							);
						$this->db->where('id', $data['id']);
						$this->db->update('book', $newdata2);}
			return $flag;
		}

		function fetch_book($id){
			$query="*
			FROM book
			WHERE id LIKE $id";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_available_book($id){
			$query="call_number
			FROM book_call_number
			WHERE id LIKE '$id'
			AND call_number NOT IN
				(SELECT call_number
				FROM book_reservation
				WHERE status LIKE 'borrowed'
				or status LIKE 'overdue'
				or res_number IN
					(SELECT res_number
					FROM book_reservation
					WHERE status LIKE 'reserved'
					AND rank=1)
				)";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}
		
		function fetch_call_number($id){
			$query="call_number
			FROM book_call_number
			WHERE id LIKE $id";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}
		
		function fetch_breservation($call_number){
			$query="*
			FROM book_reservation
			WHERE call_number LIKE '".$call_number."'
			AND (status LIKE 'reserved'
			OR status LIKE 'overdue'
			OR status LIKE 'borrowed')";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_user($username){
			$query="*
			FROM user_account
			WHERE username LIKE '$username'";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_user2($account_number){
			$query="*
			FROM user_account
			WHERE account_number LIKE '$account_number'";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_breservation2($id){
			$query="*
			FROM book_reservation
			WHERE status LIKE 'reserved'
			AND call_number IN
				(SELECT call_number
				FROM book_call_number
				WHERE id LIKE $id)";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function search_user($str){
			$query="account_number, username, CONCAT(first_name, ' ', middle_initial, '. ', last_name) as name, classification, college, course, status
			FROM user_account ua, book_reservation br
			WHERE username LIKE '".$str."'
			or account_number LIKE '".$str."'";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_user_reservation($account_number){
			$query="*
			FROM book_reservation
			WHERE account_number LIKE '".$account_number."'
			AND
			(status LIKE 'borrowed'
			OR status LIKE 'overdue'
			OR 'reserved')";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_book_author($id){
			$query="author
			FROM book_author
			WHERE id LIKE '".$id."'";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function get_borrower($id, $rank){
			$query = $this->db->query("SELECT call_number FROM book_call_number WHERE id LIKE '$id'");
			$call_number = $query->result()[0]->call_number;
			$query = $this->db->query("SELECT * FROM book_reservation
										WHERE call_number LIKE '$call_number'
										AND status LIKE 'reserved'
										AND rank > $rank
										ORDER BY rank");
			return $query->result();
		}

		function update_book_res($id, $account_number){
			$query = $this->db->query("SELECT call_number FROM book_call_number WHERE id LIKE '$id'");
			$row = $query->result();
			$call_number = $row[0]->call_number;
			$query = $this->db->query("SELECT rank FROM book_reservation
										WHERE account_number LIKE '$account_number'
										AND call_number LIKE '$call_number'
										AND status LIKE 'reserved'");
			$row = $query->result();
			$rank = $row[0]->rank;
			$rank--;
			$newdata = array('rank' => $rank);
			$this->db->update('book_reservation', $newdata, array('account_number' => $account_number));
		}
	}


/*End of model_reserve_book.php*/
/* Location: ./application/model/model_reserve_book.php */