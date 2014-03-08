<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('controller_log.php');
class Controller_view_users extends Controller_log {
 
    function index() {
        $this->viewUser(null);
    }

    function viewUser($msg){
        $this->load->model('model_users');
        $data['results']=$this->model_users->getAllUsers();
        $data['parent'] = "Users";
        $data['current'] = "View Users";
        if($msg != null){
            $data['msg'] = "You have successfully approved the account of $msg.";
            $data['msg1'] = true;
		}
        $this->load->helper(array('form','html'));
        $this->load->view("admin/view_header",$data);
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_users",$data);
        $this->load->view("admin/view_footer");
    }

    function search_user(){
        $this->load->model('model_users');
        $data['results']=$this->model_users->userSearch($this->input->post('s_user'));
        $data['parent'] = "Users";
        $data['current'] = "Search Users";

        $this->load->helper(array('form','html'));
        $this->load->view("admin/view_header",$data);
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_users",$data);
        $this->load->view("admin/view_footer");
    }

    function approve_user(){
        if($this->session->userdata('logged_in_type')!="admin")
                redirect('index.php/user/controller_login', 'refresh');
         if(isset($_POST['approve'])){
             if(isset($_POST['account_number1'])){
                 $this->email_confirm_account($_POST['account_number1']);
             }
             unset($_POST['approve']);
         }
     }
 
     function remove_user(){
        if($this->session->userdata('logged_in_type')!="admin")
                redirect('index.php/user/controller_login', 'refresh');
         if(isset($_POST['remove2'])){
             if(isset($_POST['account_number2'])){
                 $this->model_user->remove_user($_POST['account_number2']);
             }
             unset($_POST['remove2']);
         }
         else if(isset($_POST['remove3'])){
             if(isset($_POST['account_number3'])){
                 $this->model_user->remove_user($_POST['account_number3']);  
             }
             unset($_POST['remove3']);
         }
     }
 
	function email_confirm_account($account_number){
		if($this->session->userdata('logged_in_type')!="admin")
			redirect('index.php/user/controller_login', 'refresh');
		include("./application/controllers/admin/controller_retrieve_email.php");
		$config = array(
			'protocol' => 'smtp',
               'smtp_host' => 'ssl://smtp.googlemail.com',
               'smtp_port' => 465,
               'smtp_user' => $email,
               'smtp_pass' => "$password",
               'mailtype'  => 'text', 
                'charset'   => 'iso-8859-1'
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
		$message .= "The ICS e-Lib will never ask or provide confidential account details such as your password. In case you've received messages from us asking for your password, please report them immediately to our administrators. Thank you!<br />Mag-aral ng mabuti! ";
		//  echo $message;
		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($from_email, $from_name);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);
		//Send the email
		if($this->email->send()){
			$this->load->model('model_user');
			$this->model_user->approve_user($account_number);
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $session_user verified account of $account_number.", "Verify User Account");
			echo "<script>alert('Account of $account_number has been successfully validated! User may check the email provided for confirmation.')</script>";
			redirect('index.php/admin/controller_view_users/viewUser/'.$account_number,'refresh');
		}else{
			echo "<script>alert('The account of $account_number was not successfully validated!\nError: Email failed to send. Please check your internet connection.')</script>";
			redirect('index.php/admin/controller_view_users','refresh');
		}
	}
        
    function deactivate(){
        if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
        if(isset($_POST['deactivate'])){
             $this->load->model('model_reservation');
             $overdue = count($this->model_reservation->show_all_user_book_reservation("overdue"));
             $borrowed = count($this->model_reservation->show_all_user_book_reservation("borrowed"));
             $count = $overdue + $borrowed;
             if($count === 0){  //no more books at hand of users, all books are returned in th library
                 $this->load->model('model_user');
                 $this->model_user->deactivate_users();
                 echo "<script>alert('You have successfully deactivated the accounts of all users.')</script>";
                 $session_user = $this->session->userdata('logged_in')['username'];
                 $this->add_log("Admin $session_user deactivated all user accounts.", "Deactivate Users");
             }else{
                echo "<script>alert('You cannot deactivate all user accounts yet. Some users still have books on loan. Make sure all users have returned their borrowed materials before deactivating all user accounts.')</script>";
             }
             unset($_POST['deactivate']);
         }
        redirect('index.php/admin/controller_view_users','refresh');
    }
    
    function borrow($borrower){
        $this->load->library(array('form_validation','session'));
        $this->load->model('model_check_session');
        $this->load->helper(array('form','html'));
        if($this->model_check_session->check_admin_session() != TRUE)
            redirect('index.php/user/controller_home', 'refresh');
        else{

            $this->load->model('model_users');
            $data['results']=$this->model_users->userSearch($borrower);
            $count = 0;
            foreach ($data['results'] as $key) {
                $count++;
            }
            if($count > 0){
                $arr = array(
                    'borrower' => $borrower
                );
                $this->session->set_userdata($arr);
                redirect('index.php/admin/controller_search_book', 'refresh');
            
            }
            else
                redirect('index.php/admin/controller_view_users', 'refresh');
        }
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */