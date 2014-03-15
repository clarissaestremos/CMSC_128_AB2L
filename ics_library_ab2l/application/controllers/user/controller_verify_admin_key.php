<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("controller_log.php");  //necessary para malagay sa ADMIN_LOGS yung paglog-in ng admin
class Controller_verify_admin_key extends Controller_log {
    function __construct() {
        parent::__construct();
        //load session and connect to database
        $this->load->model('user_model','login',TRUE);
        $this->load->helper(array('form', 'url','html'));
        $this->load->library(array('form_validation','session'));
    }
 
    function index() {
         $this->form_validation->set_rules('admin_key', 'Administrator Key', 'trim|required|xss_clean|callback_check_database');
         $data['i']= "fds";

         if(!($this->session->userdata('count'))){  //checks is session already exists
            $this->session->set_userdata('count',0);
         }

        if($this->form_validation->run() == FALSE) {        
            $data['titlepage']= "Administrator Verification";
            $this->load->view('user/view_header',$data);
            $this->load->view('user/view_admin_key',$data); //load view for login
            $this->load->view('user/view_footer');
            } 
        else {
                //Go to private area
           if($this->session->userdata('logged_in_type')=="admin"){
            $this->session->unset_userdata('count');
            
            $session_user = $this->session->userdata('logged_in')['username'];
            $this->add_log("Admin $session_user logged in.", "Admin Login");
            //the remove_unclaimed() and update_reservation_status() are better implemented as procedures in the database
            $this->remove_unclaimed();
            $this->update_reservation_status();
            redirect('index.php/admin/controller_admin_home', 'refresh');
           
           }
           else{
                $sess_enterKey = $this->session->userdata('count'); 
                if($sess_enterKey == 2){                    //limits the incorrect admin key to 3 inputs
                    $this->session->unset_userdata('count');//destroys the created session
                    redirect('index.php/user/controller_login', 'refresh');
                }
                else{
                    $sess_enterKey++;
                    $this->session->set_userdata('count',$sess_enterKey);
                    redirect('index.php/user/controller_admin_key', 'refresh');
                }
           }
        }   
     }
 
     function check_database() {
         //Field validation succeeded.  Validate against database
         $admin_key = $this->input->post('admin_key');
         $user_name = $this->session->userdata('logged_username');
         //query the database
         $result = $this->login->admin_key($admin_key,$user_name);
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
                             $this->session->set_userdata('logged_in', $sess_array);
                             $this->session->set_userdata('logged_in_type', "admin");

                             }
                         return TRUE;
                        


              //if form validate false
              $this->form_validation->set_message('check_database', 'Invalid Administrator Key');
              return FALSE;
          }
      }
}
/* End of file controller_verify_login.php */
/* Location: ./application/controllers/user/controller_verify_login.php */
