<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Controller for the frequently asked questions
*/

class Controller_faq extends CI_Controller {
 
    function index() {
        $this->load->helper(array('form','html'));
      
        $data['titlepage']= "Frequently Asked Questions";
        $this->load->view("user/view_header", $data);   //displays the page header
        $this->load->view("user/view_faq");            //display the questions and the given answers
        $this->load->view("user/view_footer");        //displays the page footer
    }
}
/* End of file controller_faq.php */
/* Location: ./application/controllers/user/controller_faq.php */
