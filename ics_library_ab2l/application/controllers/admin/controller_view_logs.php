<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_view_logs extends CI_Controller {
 
   /*Load the page for logs*/
    function index() {
    	$data['parent'] = "Admin";
    	$data['current'] = "Logs";

    	$this->load->helper(array('form','html'));
        $this->load->view("admin/view_header");
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_log");
        $this->load->view("admin/view_footer");
    }
}
/* End of file controller_view_logs.php */
/* Location: ./application/controllers/user/controller_view_logs.php */
