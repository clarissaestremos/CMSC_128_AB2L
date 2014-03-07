<?php
	class Model_reserve_book extends CI_Model{
		//constructor loads the database
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function fetch_book_borrow($id){
			$query="call_number
			FROM book_call_number
			WHERE id LIKE $id
			AND call_number NOT IN
			(SELECT call_number
			FROM book_reservation
			WHERE status LIKE 'borrowed'
			or status LIKE 'overdue'
			or status LIKE 'reserved')";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}
		
		function fetch_book_borrow2($id){
			$query="call_number
			FROM book_call_number
			WHERE id LIKE $id";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}
		

		function fetch_book($id){
			$query="*
			FROM book
			WHERE id LIKE $id";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function fetch_user($username){
			$query="account_number
			FROM user_account
			WHERE username LIKE '$username'";
			//execute query
			$this->db->select($query,FALSE);
			
			return $this->db->get();
		}

		function getCurrentDate(){
			// set default timezone
			date_default_timezone_set('Asia/Manila'); // CDT

			$info = getdate();
			$date = $info['mday'];
			$month = $info['mon'];
			$year = $info['year'];
			$wday = $info['wday'];

			$current_date = array(
				'mday' => "$date",
				'mon' => "$month",
				'year' => "$year",
				'wday' => "$wday"
				);
			return $current_date;
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

		function waitlist_reservation($data){
			$row = $this->model_reserve_book->fetch_book_borrow2($data['id']);
			$rank = 1000;
			$call_number;
			if($row->num_rows() > 0){
				foreach ($row->result() as $book_details) {
					$row2 = $this->model_reserve_book->fetch_breservation($book_details->call_number);
					if($rank > $row2->num_rows()){
						$call_number = $book_details->call_number;
						$rank = $row2->num_rows();
						if($row2->num_rows() == 0)
							$rank = 0;
					}
				}
			}
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
			$this->db->update('book', $newdata2);
		}

		function add_reservation($data){
			$date_reserved = getdate();
			$date_expired = $this->model_reserve_book->getExpiration($date_reserved);
			$due_date = $date_expired['year']."-".$date_expired['mon']."-".$date_expired['mday'];
			$due_date = date("Y-m-d", strtotime($due_date));
			
			$row = $this->model_reserve_book->fetch_book($data['id']);
			foreach ($row->result() as $value) {
				$no_of_available = $value->no_of_available;
				$book_stat = $value->book_stat;
			}
			$row = $this->model_reserve_book->fetch_book_borrow($data['id']);
			foreach ($row->result() as $book_details) {
				$data['call_number'] = $book_details->call_number;
			}

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

		function fetch_breservation($call_number){
			$query="*
			FROM book_reservation
			WHERE call_number LIKE '".$call_number."'
			AND status LIKE 'reserved'";
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
			OR status LIKE 'overdue')";
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

	}


/*End of model_reserve_book.php*/