<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Model_upload extends CI_Model {

		public function __construct()
		{
	    	$this->load->database();
		}
	
		public function add_picture()
		{    
	    	$data=array(
	    		'account_no'=>$this->input->post('account_no'),
	    		'file_name'=>$this->input->post('userfile'),
	    		);
	
	    	$this->db->insert('profile_pictures',$data);
	    }
	  
		function get_filename($id){
	    	$query = $this->db->get_where('profile_pictures', array('account_no' => $id));
	    	return $query->row_array();
	  	}
	}
?>
