<?php
	class Model_log extends CI_Model {

		public function __construct()
		{
			$this->load->database();
		}

		public function get_log($today)	//select statements
		{
			if ($today === FALSE)
			{
				$query = $this->db->order_by("log_number", "desc");
				$query = $this->db->get('admin_log'); //table name
				return $query->result();
			}
			
			else{
				$query = $this->db->order_by("log_number", "desc");
				$query = $this->db->get_where('admin_log', array('date' => 'NOW()'));
				 
				return $query->result();
			}
		}
		
		public function add_log($message, $type)
		{
			$time = date("G:i:s");
			$sql="INSERT INTO `admin_log` (`date`, `message`, `type`, `time`) VALUES (NOW(), ".$this->db->escape($message).", ".$this->db->escape($type).", '$time')";
			$query = $this->db->query($sql) or die(mysql_error());
		}
	}
?>
