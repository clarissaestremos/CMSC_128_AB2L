<!-- for database use only. -->

<?php
class Model_user extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_acct($account_number)	//select statements
	{
	
		$query = $this->db->query("SELECT *
			FROM user_account
			WHERE account_number = '$account_number' ");
		return $query->result();
	}
	
	public function remove_pending()
	{
		//automatic removal of 1 month pending requests
		$query = $this->db->query("DELETE 
			FROM user_account
			WHERE (status = 'pending') AND (datediff(curdate(), date_notif) >= 30)");
	}

	public function approve_user($account_number)
	{
		$query = $this->db->query("UPDATE user_account 
			SET status='approved', date_notif=curdate() 
			WHERE account_number='{$account_number}'");
	}

	public function remove_user($account_number)
	{
		$query = $this->db->query("DELETE 
			FROM user_account
			WHERE account_number='{$account_number}'");
	}
	
	public function deactivate_users()
	{
		$this->db->select('account_number');
		$query = $this->db->get('user_account');
		foreach($query->result() as $user){
			$this->db->query("UPDATE user_account 
			SET status='pending', date_notif='' 
			WHERE account_number='{$user->account_number}'");
		}
	}
}


/* End of file model_user.php */
/* Location: ./application/model/model_user.php */
?>
