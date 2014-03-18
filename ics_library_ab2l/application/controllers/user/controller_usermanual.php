<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_usermanual extends CI_Controller {
 
    function index() {
        $this->load->helper(array('form','html'));

        if($this->session->userdata('logged_in')){
            $this->load->view("user/view_usermanual_borrower");
        }
        else{
             $this->load->view("user/view_usermanual_visitor");
        }  
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */
