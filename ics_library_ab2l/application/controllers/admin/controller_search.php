<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_search extends CI_Controller {

/* This function catches the data to be searched and then loads the search view along with the header and footer. */
    function index() {
    	$data['parent'] = "Books";
    	$data['current'] = "Search";

    		$this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        $this->load->view("admin/view_search");
	        $this->load->view("admin/view_footer");
        
    }
}

/* End of file controller_search.php */
/* Location: ./application/controllers/user/controller_search.php */
