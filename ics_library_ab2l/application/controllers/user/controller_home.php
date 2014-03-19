<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Controller_home extends CI_Controller {

  function index() {
   $this->load->helper(array('form','html'));
   $data['titlepage']= "ICS Library Home"; //title page  
   $this->load->view("user/view_header", $data); //displays the header
   
   $this->load->view("user/view_home"); //displays the home page
   $this->load->view("user/view_footer"); //displays the footer
  }
 }  
/* End of file controller_home.php */
/* Location: ./application/controllers/user/controller_home.php */
