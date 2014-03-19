<?php
class Model_users extends CI_Model{

/*
Model for viewing all users existing in the db.
Query used was SELECT from the table 'user_account'.
*/
	
	function getAllUsers()
	{
		$sqlQuery = "SELECT account_number, first_name, middle_initial, last_name, 
						course, email,classification, status FROM user_account
						ORDER BY status desc";
		$query = $this->db->query($sqlQuery);
		return $query->result();
	}
	
	function userSearch($s_user)
	{
		$sqlQuery = "SELECT account_number, first_name, middle_initial, last_name, 
						course, email,classification, status FROM user_account
						WHERE account_number LIKE '".$s_user."'
						or email LIKE '".$s_user."'";
		$query = $this->db->query($sqlQuery);
		return $query->result();
	}
	
	function getPendingUsers()
	{
		$sqlQuery = "SELECT account_number, first_name, middle_initial, last_name, 
						course, email,classification, status FROM user_account
						where status ='pending'
						ORDER BY status desc";
		$query = $this->db->query($sqlQuery);
		return $query->result();
	}
	
	function countPendingUsers()
	{
		$this->db->select( "* FROM user_account where status ='pending'
						ORDER BY status desc",false);
		$query=$this->db->get();
		return $query->num_rows();
	}
	
		/*Function for getting data for pagination*/
	function getAllUsers2($data,$limit,$start)
	{
		$sqlQuery = "SELECT account_number, first_name, middle_initial, last_name, 
						course, email,classification, status FROM user_account
						ORDER BY status desc";
		$query = $this->db->query($sqlQuery);
	
		if($limit>0){
			if ($start == NULL)
				$start=0;
			$sqlQuery = "SELECT account_number, first_name, middle_initial, last_name, 
						course, email,classification, status FROM user_account
						ORDER BY status desc LIMIT $start,$limit";
			$query = $this->db->query($sqlQuery);
		}	
		return $query->result();
	}
}


/* End of file model_users.php */
/* Location: ./application/model/model_users.php */
?>
