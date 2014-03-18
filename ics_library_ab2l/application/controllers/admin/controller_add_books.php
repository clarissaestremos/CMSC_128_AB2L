<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_add_books extends CI_Controller {
 
    function index() {
    	$this->add_book(null);
    }
    /*
    * Calls the view_add_book, which has the form for adding new books
    */
	function add_book($msg){
	$data['parent'] = "Books";
	$data['current'] = "Add Books";
	if($msg != null)
	    $data['message'] = "<span class='color-green'>You have successfully added the book: $msg</span>";
	
	$this->load->helper(array('form','html'));
	$this->load->view("admin/view_header",$data);
	$this->load->view("admin/view_aside");
	$this->load->view("admin/view_add_books");
	$this->load->view("admin/view_footer");
	}
}
/* End of file controller_add_books.php */
/* Location: ./application/controllers/admin/controller_add_books.php */
