<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_register extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('model_register');
			$this->load->model('model_check_session');
		}
 
		function index() {
			$this->load->helper(array('form','html'));
							 
    		if($this->session->userdata('logged_in')) //if logged in and check_session() returns true, redirect to home page
				 if($this->model_check_session->check_session() == TRUE) redirect('index.php/user/controller_home');
			
				$data['titlepage']= "Register"; 
				$this->load->view("user/view_header", $data); //display header
				$this->load->view("user/view_register"); //display register page
				$this->load->view("user/view_footer");  //display footer
		
		}


		 public function alpha_space($str)
		{
			return(! preg_match("/^([-a-z\ \-])+$/i", $str))? FALSE: TRUE;
		}
		 public function acct_num($str)
		{
			if($this->input->post('classi')=="student")// if student,
				return(! preg_match("/^[12][0-9]{3}\-[0-9]{5}$/i", $str))? FALSE: TRUE; // returns false if the string does not match the format 12XXX-XXXXX, else returns true
			else{// if employee,
				return(! preg_match("/^[0-9]{10}$/i", $str))? FALSE: TRUE;  // return false if the string does not match the format XXXXXXXXXX, else return true
			}
		}
		 public function last_name($str)
		{
			return(! preg_match("/^([A-Za-zñÑ]){1}([A-Za-zñÑ]){1,}(\s([A-Za-zñÑ]){1,})*(\-([A-Za-zñÑ]){1,}){0,1}$/i", $str))? FALSE: TRUE; //returns false if the format does not match any possibility of a surname, else return true
		}

		 public function first_name($str)
		{
			return(! preg_match("/^[A-Za-zñÑ]{1}[A-Za-zñÑ\s]*\.?((\.\s[A-Za-zñÑ]{2}[A-Za-zñÑ\s]*\.?)|(\s[A-Za-zñÑ][A-Za-zñÑ]{1,2}\.)|(-[A-Za-zñÑ]{1}[A-Za-zñÑ\s]*))*$/i", $str))? FALSE: TRUE; // returns true if the string matches any possibility of a given a first given name including those containing periods or hyphens or those with multiple first names or with special alphabets
		}
		 public function check_dupes($str2)
		{

			 $sql=$this->db->query("select username from user_account where username like '$str2' "); // checks if the input username already exists

			 if($sql->num_rows()!=0)
					{return FALSE;} //if the username exists, return false, else return true
				else {return TRUE;}         
		}


		public function check_dupes_accntNum($str3)
		{

			 $sql=$this->db->query("select account_number from user_account where account_number like '$str3' ");
        // checks if the input string already exists
			 if($sql->num_rows()!=0)  //if the username exists, return false, else return true
					{return FALSE;}
				else {return TRUE;}         
		}

		 public function check_account( $account_number){
            $this->db->where('account_number',$account_number); // checks if the account number exists
            $query = $this->db->get('user_account')->num_rows();
            
    	}


		public function registration()
		{
					$this->load->library('form_validation');
					// field name, error message, validation rules
					$this->form_validation->set_rules('fname', 'First Name', 'trim|required|ucwords|min_length[2]|max_length[50]|callback_first_name|xss_clean');
					$this->form_validation->set_rules('minit', 'Middle Initial', 'trim|ucwords|required|xss_clean');
					$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|ucwords|callback_last_name|xss_clean');

					$this->form_validation->set_message('check_first_name', 'Invalid input. Invalid name.');
					$this->form_validation->set_message('check_last_name', 'Invalid input. Invalid name.');

					 $this->form_validation->set_rules('stdNum', 'Student Number', 'trim|required|min_length[10]|callback_acct_num|xss_clean|callback_check_account');
					 $this->form_validation->set_message('check_dupes_acctNum', 'You have a duplicate Student/Employee number');
					 $this->form_validation->set_message('acct_num', 'Invalid Student/Employee number');

					$this->form_validation->set_rules('college', 'College', 'trim|min_length[2]|alpha|xss_clean');
					$this->form_validation->set_rules('course', 'Course', 'trim|min_length[3]|xss_clean');
					$this->form_validation->set_rules('classi', 'Classification', 'trim|alpha|xss_clean');
					
					$this->form_validation->set_rules('eadd', 'Your Email', 'trim|required|valid_email|xss_clean');

					$this->form_validation->set_rules('uname', 'Username', 'trim|required|min_length[4]|alpha_dash|xss_clean|callback_check_dupes|callback_usernameRegex');
					$this->form_validation->set_message('check_dupes', 'You have a duplicate username');
					
					$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[5]|max_length[20]|alpha_numeric');
					$this->form_validation->set_rules('cpass', 'Password Confirmation', 'trim|required|matches[pass]');

					if($this->form_validation->run() == FALSE)  //if there are validation errors, prompt error
					{
					 $data['msg'] = validation_errors();
					 $data['fname'] = $this->input->post('fname');
					 $data['minit'] = $this->input->post('minit');
					 $data['lname'] = $this->input->post('lname');
					 $data['eadd'] = $this->input->post('eadd');
					 $data['uname'] = $this->input->post('uname');
					 $this->error($data);
					
					}
					else  // else, create session where the input data will be data of the user
					{
						$this->model_register->add_user();

			             //create the session
			             $sess_array = array(
			                 'username' => $this->input->post('uname'),
			                 'fname' => $this->input->post('fname'),
			                 'mname' =>$this->input->post('minit'),
			                 'lname'=>$this->input->post('lname')
			             );

			              $this->session->set_userdata('logged_in', $sess_array);
			              $this->session->set_userdata('logged_in_type', "user");

			             $base = base_url();
			             // displays a prompt that the user successfully registered
			            echo "
					<div id='mysuccess' title='User Register Success'>  
						<h6>You have successfully registered!</h6>
						<p>But you're account is not yet activated in order to reserve a material.</p>
					</div>
					<script src='$base/js/jquery-1.10.2.min.js'></script>
					<script src='$base/js/jquery-ui.js'></script>
					<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
					<script>
							$('#mysuccess').dialog({
					            modal: true,
					            closeOnEscape: true,
					            closeText: 'show',
					            show: {
					              effect: 'fadeIn',
					              duration: 200
					            },
					            draggable: false,
					            close: function(event, ui){
					                window.location.replace('$base/index.php/user/controller_home');
					            },
					            buttons : {
					              'Ok': function() {
					                  window.location.replace('$base/index.php/user/controller_home');
					              },
					            }
					 
					        });
						</script>";
			            if($this->session->userdata('logged_in_type')=="user"){ 
			              if($this->session->userdata('id')){
			                //redirect('index.php/user/controller_reserve_book');
			                }
			                //else redirect('index.php/user/controller_home', 'refresh');
			            }
			           else{
			            $session_user = $this->session->userdata('logged_in')['username'];
			            $this->add_log("Admin $session_user logged in.", "Admin Login");
			            $this->remove_unclaimed();
			            $this->update_reservation_status();
			            redirect('index.php/admin/controller_admin_home', 'refresh');
			            }
					}
		}

		function success($data) { //displays the success page
				$data['titlepage']= "Register";
				$this->load->helper(array('form','html'));
				$this->load->view("user/view_header",$data);
				$this->load->view("user/view_register",$data);
				$this->load->view("user/view_footer");
		}

		function error($data) { //displays error page
				$data['titlepage']= "Register";
				$this->load->helper(array('form','html'));
				$this->load->view("user/view_header",$data);
				$this->load->view("user/view_register",$data);

				$this->load->view("user/view_footer");
		}

		 public function username_Regex($username){
				if (preg_match('/^[A-Za-z][A-Za-z0-9._]{4,20}$/', $username) ) { // return true if the input begins with an upper or lowercase letter followed by upper or lowercase letters or numbers
						return TRUE;
					} else {
						return FALSE; // else return false and prompt error
						$this->form_validation->set_message('username_Regex', 'Invalid input.');
					}
		}
}
/* End of file controller_register.php */
/* Location: ./application/controllers/user/controller_register.php */
