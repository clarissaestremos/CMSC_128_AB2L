<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('controller_log.php');
class Controller_add_user extends Controller_log {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('model_register');
      $this->load->model('model_check_session');
    }
 
    function index() {
    	$data['parent'] = "Users";
    	$data['current'] = "Add Users";

    		$this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        $this->load->view("admin/view_add_user");
	        $this->load->view("admin/view_footer");
    }
 public function alpha_space($str)
		{
			return(! preg_match("/^([-a-z\ \-])+$/i", $str))? FALSE: TRUE;
		}
		 public function acct_num($str)
		{
			if($this->input->post('classi')=="student")
				return(! preg_match("/^[12][0-9]{3}\-[0-9]{5}$/i", $str))? FALSE: TRUE;
			else{
				return(! preg_match("/^[0-9]{10}$/i", $str))? FALSE: TRUE;
			}
		}
		 public function last_name($str)
		{
			return(! preg_match("/^([A-Za-zñÑ]){1}([A-Za-zñÑ]){1,}(\s([A-Za-zñÑ]){1,})*(\-([A-Za-zñÑ]){1,}){0,1}$/i", $str))? FALSE: TRUE;
		}

		 public function first_name($str)
		{
			return(! preg_match("/^[A-Za-zñÑ]{1}[A-Za-zñÑ\s]*\.?((\.\s[A-Za-zñÑ]{2}[A-Za-zñÑ\s]*\.?)|(\s[A-Za-zñÑ][A-Za-zñÑ]{1,2}\.)|(-[A-Za-zñÑ]{1}[A-Za-zñÑ\s]*))*$/i", $str))? FALSE: TRUE;
		}
		 public function check_dupes($str2)
		{

			 $sql=$this->db->query("select username from user_account where username like '$str2' ");

			 if($sql->num_rows()!=0)
					{return FALSE;}
				else {return TRUE;}         
		}


		public function check_dupes_accntNum($str3)
		{

			 $sql=$this->db->query("select account_number from user_account where account_number like '$str3' ");

			 if($sql->num_rows()!=0)
					{return FALSE;}
				else {return TRUE;}         
		}

		 public function check_account( $account_number){
            $this->db->where('account_number',$account_number);
            $query = $this->db->get('user_account')->num_rows();
            
    	}

    public function registration()
    {
          if($this->model_check_session->check_admin_session() == TRUE){
            if($this->session->userdata('logged_in_type')!="admin")
              redirect('index.php/user/controller_login', 'refresh');
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



            if($this->form_validation->run() == FALSE)
            {
             $data['msg'] = validation_errors();
             $data['msg1'] = false;
             $this->success($data); 
            }
            else
            {
              $this->model_register->add_user("admin");
			  $this->email_confirm_account($this->input->post('stdNum'));
              
            }
          }
    }
	
	function email_confirm_account($account_number){
		$base = base_url();
		if($this->session->userdata('logged_in_type')!="admin")
			redirect('index.php/user/controller_login', 'refresh');
		include("./application/controllers/admin/controller_retrieve_email.php");
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => "$email",
			'smtp_pass' => "$password",
			'mailtype'  => 'html', 
			'charset'   => 'utf-8',
			'wordwrap'  => true,
			'newline'   => "\r\n",
			'crlf'      => "\n"
			);//config for the email
		$subject='Re: ICS e-Lib Account Approval';
		$from_email= "$email";
		$from_name='ICS e-Lib';

		//Get user account in database
		$this->load->model('model_user');
		$query['query'] = $this->model_user->get_acct($account_number);
		$username = $query['query'][0]->username;
		$first_name= $query['query'][0]->first_name;
		$mi=$query['query'][0]->middle_initial;
		$last_name=$query['query'][0]->last_name;
		$to=$query['query'][0]->email;

		$message = "<br />Dear {$first_name} {$mi} {$last_name},<br/>";
		$message .= "Your account with the following information has been approved:<br />";
		$message .= "<b>Name:</b> {$first_name} {$mi} {$last_name}<br />";
		$message .= "<b>Email:</b> {$to}<br />";
		$message .= "<b>Username:</b> {$username}<br />";
		$message .= "Please remember necessary information such as your username and password used for this account to be able to access your profile in the ICS e-Lib. Please maximize the use of the site for your needs. For inquiries, please contact the ICS Library librarian.<br/><br />";
		$message .= "Thank you!<br/>";
		$message .= "ICS Library Administrator<hr />";
		$message .= "The ICS e-Lib will never ask or provide confidential account details such as your password. In case you've received messages from us asking for your password, please report them immediately to our administrators. Thank you!<br />Mag-aral ng mabuti!";
		//  echo $message;
		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($from_email, $from_name);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);
		//Send the email
		//if($this->email->send()){
			$this->load->model('model_user');
			$this->model_user->approve_user($account_number);
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $session_user verified account of $account_number.", "Verify User Account");
			$base = base_url();
			echo "
					<div id='mysuccess' title='Add User Account Success'>
						<h6>Account of $account_number has been successfully validated! User may check the email provided for confirmation.</h6>
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

			$data['msg'] = "You've successfully registered and validated a user account.";
            $data['msg1'] = true;
			//redirect('index.php/admin/controller_view_users/viewUser/'.$account_number,'refresh');
		/**}else{
			$data['msg']= "The account of $account_number was not successfully validated! Email failed to send";
			$data['msg1']= false;
			echo "
					<div id='mysuccess' title='Add User Account Success'>
						<h6>The account of $account_number was not successfully validated! Error: Email failed to send.</h6>
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
					                window.location.replace('$base/index.php/admin/controller_add_user');
					            },
					            buttons : {
					              'Ok': function() {
					                  window.location.replace('$base/index.php/admin/controller_add_user');
					              },
					            }
					 
					        });
						</script>";
		}*/
		$this->success($data);
	}

     public function username_Regex($username){
        if (preg_match('/^[A-Za-z][A-Za-z0-9._]{4,20}$/', $username) ) {
            return TRUE;
          } else {
            return FALSE;
            $this->form_validation->set_message('username_Regex', 'Invalid input.');
          }
    }

    function success($data) {

        $data['parent'] = "Users";
        $data['current'] = "Add Users";

            $this->load->helper(array('form','html'));
            $this->load->view("admin/view_header",$data);
            $this->load->view("admin/view_aside");
            $this->load->view("admin/view_add_user",$data);
            $this->load->view("admin/view_footer");
    }

	public function check_std_no( $account_number){
            $this->db->where('account_number',$account_number);
            $query = $this->db->get('user_account')->num_rows();
            if($query == 0 ) echo 'userOk';
            else echo 'userNo';
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */

