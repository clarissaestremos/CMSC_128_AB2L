<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_adminmanual extends CI_Controller {
  /**
   * Calls for the view of the adminmanual page
   * */
    function index() {
        $this->load->helper(array('form','html'));
        $this->load->view("admin/view_adminmanual");
        
    }
}
/* End of file controller_adminmanual.php */
/* Location: ./application/controllers/admin/controller_adminmanual.php */
