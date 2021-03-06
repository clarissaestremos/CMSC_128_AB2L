<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Controller_logout extends CI_Controller {
    function __construct() {
      parent::__construct();
      $this->load->model('user_model','',TRUE);
      $this->load->helper('url');
      $this->load->library(array('form_validation','session'));
    }
  
    
    function index() {
      $this->load->helper(array('form','html'));
      $this->logout();  //call logout function
    }
  
  
    function logout() {
      //removes all session data
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('logged_in_type');
      $this->session->sess_destroy();
      redirect(base_url(), 'refresh');
    }
  
  }
/* End of file controller_logout.php */
/* Location: ./application/controllers/user/controller_logout.php */
