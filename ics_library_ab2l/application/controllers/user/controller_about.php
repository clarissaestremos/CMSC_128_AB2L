<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_about extends CI_Controller {
 
    function index() {
        $this->load->helper(array('form','html'));
    
        $data['titlepage']= "About Us";
        $this->load->view("user/view_header", $data);
        $this->load->view("user/view_about");
        $this->load->view("user/view_footer");
        
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */