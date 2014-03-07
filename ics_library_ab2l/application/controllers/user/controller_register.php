<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_register extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('model_register');

         $this->load->library(array('form_validation','session'));
    }
 
    function index() {
        $this->load->helper(array('form','html'));
       
        $data['titlepage']= "Register";
        $this->load->view("user/view_header", $data);
        $this->load->view("user/view_register");
        $this->load->view("user/view_footer");
    }

     public function alpha_space($str){
       $this->form_validation->set_message('alpha_space', 'Invalid input.');
      return(! preg_match("/^([-a-z\ \-])+$/i", $str))? FALSE: TRUE;

    }


    public function check_dupes_acctNum($str3){

       $sql=$this->db->query("select account_number from user_account where account_number like '$str3' ");
      $this->form_validation->set_message('username_dupes_acctNum', 'Student already exist.');
       if($sql->num_rows()!=0)
              {return FALSE;}
        else {return TRUE;}         
    }

    public function registration()
    {
          $this->load->library('form_validation');
          // field name, error message, validation rules
         $this->form_validation->set_rules('fname', 'First Name', 'trim|required|ucwords|min_length[2]|max_length[50]|callback_alpha_space|xss_clean');
          $this->form_validation->set_rules('minit', 'Middle Initial', 'trim|required|xss_clean');
          $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|ucwords|min_length[2]|max_length[50]|callback_alpha_space|xss_clean');

           $this->form_validation->set_rules('stdNum', 'Student Number', 'trim|required|min_length[10]|alpha_dash|xss_clean|callback_check_dupes_accntNum');
           $this->form_validation->set_message('check_dupes_acctNum', 'You have a duplicate Student/Employee number');

          $this->form_validation->set_rules('college', 'College', 'trim|min_length[2]|alpha|xss_clean');
          $this->form_validation->set_rules('course', 'Course', 'trim|min_length[3]|xss_clean');
          $this->form_validation->set_rules('classi', 'Classification', 'trim|alpha|xss_clean');
          
          $this->form_validation->set_rules('eadd', 'Your Email', 'trim|required|valid_email|xss_clean');

          $this->form_validation->set_rules('uname', 'Username', 'trim|required|min_length[4]|alpha_dash|xss_clean|callback_check_dupes|callback_usernameRegex');
          $this->form_validation->set_message('check_dupes', 'You have a duplicate username');
          
          $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[5]|max_length[32]|alpha_numeric');
          $this->form_validation->set_rules('cpass', 'Password Confirmation', 'trim|required|matches[pass]');

          if($this->form_validation->run() == FALSE)
          {
           $data['msg'] = validation_errors();
           $data['msg1'] = false;
           $this->success($data); 
          }
          else
          {
            $this->model_register->add_user("guest");
            $data['msg'] = "You successfully registered an account. You may proceed to ICS library to activate it!";
            $data['msg1'] = true;
            $this->success($data);
        }
      }

    public function username_Regex($username){
        if (preg_match('/^[A-Za-z][A-Za-z0-9._]{4,20}$/', $username) ) {
            return TRUE;
          } else {
            return FALSE;
            $this->form_validation->set_message('username_Regex', 'Invalid input.');
          }
    }

    public function check_stdNum( $stdNum){
            $this->db->where('account_number',$stdNum);
            $query = $this->db->get('user_account')->num_rows();
            if($query == 0 ){
                    $this->db->where('account_number',$stdNum);
                    $query = $this->db->get('admin_account')->num_rows();
                     if($query == 0 )
                       echo 'userOk';
                     else echo 'userNo';
              }
            else echo 'userNo';
            
    }    

    function success($data) {
        $data['titlepage']= "Register";
        $this->load->helper(array('form','html'));
        $this->load->view("user/view_header",$data);
        $this->load->view("user/view_register",$data);
        $this->load->view("user/view_footer");
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */