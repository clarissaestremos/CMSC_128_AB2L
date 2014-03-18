<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	include_once("controller_log.php");

	class Controller_logout extends Controller_log {

    		function __construct() {
        		parent::__construct();
        		$this->load->model('admin_model','',TRUE);
        		$this->load->helper('url');
        		$this->load->library(array('form_validation','session'));
    		}

 
    		function index() {
        		$this->logout();
    		}
 
   
    		function logout() {
         		//remove all session data
		 	$username = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $username logged out.", "Admin Login");
         		$this->session->unset_userdata('logged_in');
         		$this->session->unset_userdata('logged_in_type');
         		$this->session->sess_destroy();
         		redirect('index.php/user/controller_home', 'refresh');
     		}
 
	}
/* End of file controller_admin_home.php */
/* Location: ./application/controllers/admin/controller_admin_home.php */
