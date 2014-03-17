<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('controller_log.php');	//necessary para malagay sa ADMIN_LOGS yung paglog-in ng admin
class Controller_verify_login extends Controller_log {
    function __construct() {
        parent::__construct();
        //load session and connect to database
        $this->load->model('user_model','login',TRUE);
        $this->load->helper(array('form', 'url','html'));
        $this->load->library(array('form_validation','session'));
    }
 
    function index() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
         $data['i']= "fds";
           

        if($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<div class="isa_error">', '</div>');
          $data['titlepage']= "Login Page";
            $this->load->view('user/view_header',$data);
            $this->load->view('user/view_login',$data); //load view for login
            $this->load->view('user/view_footer');

            } 
        else {
                //Go to private area
           if($this->session->userdata('logged_in_type')=="user"){
            if($this->session->userdata('id')){
              redirect('index.php/user/controller_reserve_book');
            }
            else redirect('index.php/user/controller_home', 'refresh');
           }
           else{
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $session_user logged in.", "Admin Login");
			//the remove_unclaimed() and update_reservation_status() are better implemented as procedures in the database
			$this->remove_unclaimed();
			$this->update_reservation_status();
			redirect('index.php/admin/controller_admin_home', 'refresh');
		   
		   }
        }   
     }
 
     function check_database($password) {
         //Field validation succeeded.  Validate against database
         $username = $this->input->post('username');
         //query the database
         $result = $this->login->login($username, $password);
         if($result) {
             $sess_array = array();
             foreach($result as $row) {
                 //create the session
                 $sess_array = array(
                     'username' => $row->username,
                     'fname' => $row->first_name,
                     'mname' =>$row->middle_initial,
                     'lname'=>$row->last_name
                     );
                 //set session with value from database
                
                 $this->session->set_userdata('logged_in', $sess_array);
                 $this->session->set_userdata('logged_in_type', "user");
                 }
          return TRUE;
          } 
          //if not in user tables
          else {
                //check if admin
                 $result = $this->login->loginAdmin($username, $password);
                  if($result) {
                         $sess_array = array();
                         foreach($result as $row) {
                             //create the session
                             $sess_array = array(
                                 'username' => $row->username,
                                 'fname' => $row->first_name,
                                 'mname' =>$row->middle_name,
                                 'lname'=>$row->last_name);
                             //set session with value from database
                             //$this->session->set_userdata('logged_in1', $sess_array);
                             //$this->session->set_userdata('logged_in_type', "admin");
                             $sess_username = $row->username;
			     $this->session->set_userdata('logged_username', $sess_username);
                             redirect('index.php/user/controller_admin_key', 'refresh');
                             }
                         return TRUE;
                        }


              //if form validate false
              $this->form_validation->set_message('check_database', 'Invalid username or password');
              return FALSE;
          }
      }
}
/* End of file controller_verify_login.php */
/* Location: ./application/controllers/user/controller_verify_login.php */
