<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_stat extends CI_Controller {
 
    function index() {
        $this->load->model("model_stat");
        $data['results'] = $this->model_stat->get_stat();
        $data['titlepage']= "Statistics";
        $this->load->helper(array('form','html'));
        
        $data['titlepage']= "Book Statistics";
        $this->load->view("user/view_header", $data);
        $this->load->view("user/view_stat",$data);
        $this->load->view("user/view_footer");
    }
        
}
/* End of file controller_stat.php */
/* Location: ./application/controllers/user/controller_stat.php */
