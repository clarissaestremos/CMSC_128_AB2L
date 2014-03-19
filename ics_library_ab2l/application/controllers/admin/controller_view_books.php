<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("controller_log.php");
class Controller_view_books extends Controller_log {
 
   /*Loads the list of books along with the data*/
    function index() {
    	$data['parent'] = "Books";
    	$data['current'] = "View Books";
        
    	$this->load->helper(array('form','html'));
        $this->load->view("admin/view_header",$data);
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_books");
        $this->load->view("admin/view_footer");
   }
}
/* End of file controller_view_books.php */
/* Location: ./application/controllers/user/controller_view_books.php */
