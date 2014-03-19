<?php
class Model_book extends CI_Model {
	
	public function select_all_book_info()
	{
		$query = $this->db->get('book');
		return $query->result();
	}
	
	/*All BOOKS Table*/
	public function get_book_call_numbers($id)
	{
		$query = $this->db->get_where('book_call_number', array('id' => $id));
		return $query->result();
	}
	
	public function get_book_authors($id)
	{
		$query = $this->db->get_where('book_author', array('id' => $id));
		return $query->result();
	}
	
	public function get_book_subjects($id)
	{
		$query = $this->db->get_where('book_subject', array('id' => $id));
		return $query->result();
	}

	public function get_book_tags($id)
	{
		$query = $this->db->get_where('tag', array('id' => $id));
		return $query->result();
	}
	
	/*ADD Book*/
	public function insert_book_info($call_number, $title, $year_of_pub, $isbn, $type, $no_of_available, $quantity, $book_stat, $author, $subject, $tags)
	{
		$this->db->query("INSERT INTO book values(default, '$title', '$year_of_pub', '$type', $no_of_available, $quantity, $book_stat, '$isbn')");
	
		foreach ($author as $value) {
				$this->db->query("INSERT INTO book_author values((SELECT max(id) FROM book), '$value')");
		}
		
		foreach ($subject as $value2) {
			$this->db->query("INSERT INTO book_subject values((SELECT max(id) FROM book), '$value2')");
		}
		
		foreach ($call_number as $value3) {
			$this->db->query("INSERT INTO book_call_number values((SELECT max(id) FROM book), '$value3')");
		}
	
		foreach ($tags as $value4) {
				$this->db->query("INSERT INTO tag values((SELECT max(id) FROM book), '$value4')");
		}
		
			return $this->db->query("SELECT max(id) FROM book")->result();
	}
	

	/*EDIT BOOK*/
	public function edit_book($id, $book, $call_numbers, $book_authors, $book_subjects, $tags)
	{

		$query = $this->db->where('id', $id);
		$this->db->update('book', $book);

		$this->clear_auth_subj($id, 'book_author');
		$this->clear_auth_subj($id, 'book_subject');
		$this->clear_auth_subj($id, 'tag');
		
		$this->load->model('model_get_list');
		$row = $this->model_get_list->get_edit_call_numbers($id);
		foreach ($row as $value) {
			$this->db->delete('book_call_number', array('call_number' => $value->call_number));
		}

		if(isset($call_numbers)){
			if($call_numbers !== "")
			foreach ($call_numbers as $call_number) {
				$call_number = trim($call_number);
				if(!empty($call_number)){
					$book_call_number_info = array(
						'id' => $id,
						'call_number' => $call_number
					);
					$this->db->insert('book_call_number', $book_call_number_info);
				}
			}
		}
		
		if(isset($book_authors)){
			foreach ($book_authors as $book_author) {
				$book_author = trim($book_author);
				if(!empty($book_author)){
					$book_author_info = array(
						'id' => $id,
						'author' => $book_author
					);
					$this->db->insert('book_author', $book_author_info);
				}
			}
		}
		
		//update Book Subjects table
		if(isset($book_subjects)){
			foreach ($book_subjects as $book_subject) {
				$book_subject = trim($book_subject);
				if(!empty($book_subject)){
					$book_subject_info = array(
						'id' => $id,
						'subject' => $book_subject
					);
					$this->db->insert('book_subject', $book_subject_info);
				}
			}
		}

		if(isset($tags)){
			foreach ($tags as $tag) {
				$tag = trim($tag);
				if(!empty($tag)){
					$tags_info = array(
						'id' => $id,
						'tag_name' => $tag
					);
					$this->db->insert('tag', $tags_info);
				}
			}
		}
		
		$this->db->where('id', $id);
		$this->db->update('book', $book);
	
	}
	
	public function clear_auth_subj($id, $table)
	{

		$this->db->where('id', $id);
		$this->db->delete($table);

	}
	
	/*DELETE Book*/
	public function delete_book($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('book');
		$this->db->where('id', $id);
		$this->db->delete('book_call_number');
		$this->db->where('id', $id);
		$this->db->delete('book_author');
		$this->db->where('id', $id);
		$this->db->delete('book_subject');

	}

	public function get_book_info()
	{
		$books = $this->db->get('book');

		foreach ($books->result() as $book) {
			$book->author = $this->get_authors($book->call_number);
			$book->subject = $this->get_subjects($book->call_number);
		}
		
		return $books;

	}

	public function view_all($id)
	{

		$query = $this->db->get_where('book', array('id' => $id));
		return $query;
	}

	public function get_authors($id)
	{
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

	public function get_subjects($id)
	{
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

	function get_by_id($id)
	{
		$this->db->where('id', $id);
		$book = $this->db->get('book');
		
		$book_result = array();
		$book_result = $book->result();


		$book_result[0]->authors = $this->get_authors($id);
		$book_result[0]->subjects = $this->get_subjects($id);
		
		return $book_result;
	}
}


/* End of file model_book.php */
/* Location: ./application/model/model_book.php */
?>
