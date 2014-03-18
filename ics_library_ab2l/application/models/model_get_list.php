<?php
	class Model_get_list extends CI_Model{

	public function select_all_book_info($sort_by,$order_by,$data, $limit,$start){
		if ($sort_by != "author" && $sort_by != "subject")
			$query=$this->db->order_by($sort_by,$order_by)->get('book');

		else if ($sort_by == "author")
			$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_author ba
										WHERE b.id = ba.id
										ORDER BY ba.author $order_by ");

		else if ($sort_by == "subject")
			$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_subject bs
										WHERE b.id = bs.id
										ORDER BY bs.subject $order_by");
		

		if($limit>0){	
			if ($start == NULL)
					$start = 0;

			if ($sort_by != "author" && $sort_by!="subject") 
				$query=$this->db->order_by($sort_by,$order_by)->limit($limit,$start)->get('book');
			
			else if ($sort_by == "author")
				$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_author ba
										WHERE b.id = ba.id
										ORDER BY ba.author $order_by
										LIMIT $start,$limit");
			
			else if ($sort_by == "subject")
				$query = $this->db->query("SELECT DISTINCT b.*
										FROM book b, book_subject bs
										WHERE b.id = bs.id
										ORDER BY bs.subject $order_by
										LIMIT $start,$limit");


		}

		return $query->result();
		
	}


public function select_returned_books($account,$sort_by,$order_by,$data, $limit,$start){
	
	if ($sort_by == "due_date")
			$query= $this->db->query("SELECT *
			FROM book_reservation br, book b, user_account u, book_call_number cn
			WHERE u.username='".$account."' 
			AND br.call_number = cn.call_number
			AND u.account_number = br.account_number
			AND cn.id = b.id
			AND br.status='returned'
			GROUP BY br.call_number
			ORDER BY br.due_date");

	if($limit>0){	
		if ($start == NULL)
				$start = 0;
		if ($sort_by == "due_date")
			$query= $this->db->query("SELECT * FROM book_reservation br, book b, user_account u, book_call_number cn
					WHERE u.username='".$account."' 
					AND br.call_number = cn.call_number
					AND u.account_number = br.account_number
					AND cn.id = b.id
					AND br.status='returned'
					GROUP BY br.call_number
					ORDER BY br.due_date
					LIMIT $start,$limit");
		}
		return $query->result();
}

	public function get_book_call_numbers($id){
		$query = $this->db->get_where('book_call_number', array('id' => $id));
		return $query->result();
	}

	public function get_book_authors($id){
	 	$query = $this->db->get_where('book_author', array('id' => $id));
		return $query->result();
	}
	
	public function get_book_subjects($id){
		$query = $this->db->get_where('book_subject', array('id' => $id));
		return $query->result();
	}

	public function get_book_tags($id){
		$query = $this->db->get_where('tag', array('id' => $id));
		return $query->result();
	}
	
	public function get_edit_call_numbers($id){
		$query = $this->db->query("SELECT call_number FROM book_call_number
									WHERE id LIKE $id
									AND call_number NOT IN
										(SELECT call_number
										FROM book_reservation
										WHERE status NOT LIKE 'reserved'
										OR status NOT LIKE 'overdue'
										OR status NOT LIKE 'borrowed')");
		return $query->result();
	}

	public function get_notedit_call_numbers($id){
		$query = $this->db->query("SELECT call_number FROM book_call_number
									WHERE id LIKE $id
									AND call_number IN
										(SELECT call_number
										FROM book_reservation
										WHERE status NOT LIKE 'reserved'
										OR status NOT LIKE 'overdue'
										OR status NOT LIKE 'borrowed')");
		return $query->result();
	}


	public function get_book_by_resnum($res_number){
		$query = $this->db->query("SELECT * FROM book_call_number
									WHERE call_number IN
										(SELECT call_number
										FROM book_reservation
										WHERE res_number LIKE $res_number)");
		return $query->result();
	}

	function get_book_by_id($id){
		$query = $this->db->get_where('book', array('id' => $id));
		return $query->result();
	}



	function get_by_id($id){
		$book = $this->db->get_where('book', array('id' => $id));
		$book_result = $book->result();

		$book_result[0]->authors = $this->get_authors($id);
		$book_result[0]->subjects = $this->get_subjects($id);
		
		return $book_result;
	}

	public function get_authors($id){
		$this->db->where('id', $id);
		$authors = $this->db->get('book_author');
		$authors = $authors->result();
	
		$author_array = array();

		foreach ($authors as $author) {
			$author_array[] = $author->author;
		}

		$author_array = implode('; ', $author_array);
		return $author_array;
	}

	public function get_subjects($id){
		$this->db->where('id', $id);
		$subjects = $this->db->get('book_subject');
		$subjects = $subjects->result();
	
		$subject_array = array();

		foreach ($subjects as $subject) {
			$subject_array[] = $subject->subject;
		}

		$subject_array = implode('; ', $subject_array);
		return $subject_array;
	}


	public function get_list($account,$status,$data,$limit,$start){
		$query= $this->db->query("SELECT *
		FROM book_reservation br, book b, user_account u, book_call_number cn
		WHERE u.username='".$account."' 
		AND br.call_number = cn.call_number
		AND u.account_number = br.account_number
		AND cn.id = b.id
		AND br.status='".$status."'
		GROUP BY br.call_number
		ORDER BY br.due_date");

		

		return $query->result();
	}

	public function cancel_reservation($res_number){
		$this->db->where('res_number', $res_number);
		$this->db->delete('book_reservation');
	}

	public function update_rank($call_number, $rank){
		$query = $this->db->query("SELECT id FROM book_call_number WHERE call_number LIKE '$call_number'");
		$book = $query->result();
			
		$this->load->model('model_reserve_book');
		$borrower = $this->model_reserve_book->get_borrower($book[0]->id, $rank);
		$count=0;
		foreach ($borrower as $user) {
			if($user->rank == 2)	{
				$row = $this->model_reserve_book->fetch_available_book($book[0]->id);
				$newdata = array('call_number' => $row->result()[0]->call_number, 'rank' => 1);
				$this->db->update('book_reservation', $newdata, array('account_number' => $user->account_number, 'res_number' => $user->res_number));
				$status = $this->db->get('book')->result();
				$status = $status[0]->no_of_available;
				$status--;
				$data = array(
					'no_of_available' => "$status"
					);
				$this->db->where('id', $book[0]->id);
				$this->db->update('book', $data);
			}
			else{
				$this->model_reserve_book->update_book_res($book[0]->id, $user->account_number);
			}
		}
	}

	public function update_available($call_number){
		$this->db->query("UPDATE book a,book_call_number c
							SET a.no_of_available = a.no_of_available + 1
							WHERE c.call_number = '".$call_number."' AND
  							c.id = a.id");

	}


}
	
?> 
