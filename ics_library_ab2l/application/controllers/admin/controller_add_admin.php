<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


include_once("controller_log.php");
class Controller_add_admin extends Controller_log{
    public function __construct(){
        parent::__construct();
        $this->load->model('model_add_admin');
        $this->load->model('model_check_session');
    }

    function index(){
        $data['parent'] = "Users";
        $data['current'] = "Add Admin";

        $this->load->helper(array('form','html'));
        $this->load->view("admin/view_header",$data);
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_add_admin");
        $this->load->view("admin/view_footer");
    }
    /*
    * Sets the regex for input that requires alpha with space/s
    */
    public function alpha_space($str){
        $this->form_validation->set_message('alpha_space', 'Invalid input.');
        return(! preg_match("/^([-a-z\ \-])+$/i", $str))? FALSE: TRUE;
    }
    
    
    /*
    *   Checks the validation of the user input and if no validation error is detected, continues to add the admin account
    */
    function registration(){
        if($this->model_check_session->check_admin_session() == TRUE){
            if($this->session->userdata('logged_in_type')!="admin")
                redirect('index.php/user/controller_login', 'refresh');
            $this->load->library('form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('adminkey', 'Administrator Key', 'trim|required|alphanumeric|xss_clean');
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|callback_alpha_space|xss_clean');
            $this->form_validation->set_rules('minit', 'Middle Initial', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|callback_alpha_space|xss_clean');
            $this->form_validation->set_rules('eadd', 'Your Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('uname', 'Username', 'trim|required|min_length[4]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric');
            $this->form_validation->set_rules('cpass', 'Password Confirmation', 'trim|required|matches[pass]');
            $this->form_validation->set_rules('parent_key', 'Parent Key', 'trim|required|alphanumeric|xss_clean');

            if($this->form_validation->run() == FALSE){
                echo validation_errors();
                $data['msg'] = validation_errors();
                redirect('index.php/admin/controller_add_admin', 'refresh');
            }
            else{
                $this->model_add_admin->add_admin();
                $data['msg'] = "You successfully added a new admin account.";
                $session_user = $this->session->userdata('logged_in')['username'];
                $this->add_log("Admin $session_user added a new administrator.", "Add Administrator");
                $this->success($data);
            }
        }
    }
    
    /*
    *   Checks if an admin_key already exists
    */
    public function check_admin_key( $admin_key){
            $this->db->where('admin_key',sha1($admin_key));
            $query = $this->db->get('admin_account')->num_rows();
            if($query == 0 ) echo 'userOk';
            else echo 'userNo';
    }

    function redirectPage(){
        if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
        if(isset($_POST['cancelAdd'])){
            //redirect('index.php/admin/controller_view_users','refresh');
        }
    }
    
    /*
    *   returns to view_add_admin with either the validation error message or that admin account was successfull added
    */
    function success($data) {

        $data['parent'] = "Admin";
        $data['current'] = "Add Admin";

            $this->load->helper(array('form','html'));
            $this->load->view("admin/view_header",$data);
            $this->load->view("admin/view_aside");
            $this->load->view("admin/view_add_admin",$data);
            $this->load->view("admin/view_footer");
    }
}
?>
