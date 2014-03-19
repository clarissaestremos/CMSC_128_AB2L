<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_about extends CI_Controller {
 
    function index() {                                   
        $this->load->helper(array('form','html'));
    
        $data['titlepage']= "About Us";
        $this->load->view("user/view_header", $data);         //loads the header for the page
        $this->load->view("user/view_about");                //loads the information about the library
        $this->load->view("user/view_footer");               //loads the footer for the page
        
    }
}
/* End of file controller_about.php */
/* Location: ./application/controllers/user/controller_about.php */
