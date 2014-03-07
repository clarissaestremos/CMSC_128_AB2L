<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once("controller_log.php");
class Controller_settings extends Controller_log {

    public function __construct()
    {
      parent::__construct();
      $this->load->model('model_check_session');
    }
 
    function index() {
    	$data['parent'] = "Admin";
    	$data['current'] = "Settings";
		$data['msg1'] ="";
		$data['msg'] ="";
    		$this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        //if($this->checkpoint())
	        		$this->load->view("admin/view_settings");
	        $this->load->view("admin/view_footer");
    }

	public function checkpoint()
    {
		//ask for password
		//if validated
		//$session_user = $this->session->userdata('logged_in')['username'];
		//$this->add_log("Admin $session_user accessed the ICS e-Library settings.", "Access Settings");
		return true;
    }
	
    public function saveChanges()
    {
		if($this->model_check_session->check_admin_session() == TRUE){
			$data['msg'] ="";
			$data['msg1'] ="";
			if($this->session->userdata('logged_in_type')!="admin")
				redirect('index.php/user/controller_login', 'refresh');
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->load->library('form_validation');
			// field name, error message, validation rules
			$this->form_validation->set_rules('icsmail', 'ICS e-Lib Email Address', 'trim|valid_email');
			$this->form_validation->set_rules('icsmailpw', 'ICS e-Lib Password', 'trim|min_length[5]|max_length[32]|alpha_numeric');
			$this->form_validation->set_rules('icsmailpw1', 'Retype Password', 'trim||matches[icsmailpw]');
			
			if((isset($_POST['admin_password']) and isset($_POST['admin_password1'])) or isset($_POST['icsmail']))
				$this->form_validation->set_rules('admin_pass', 'Password Confirmation', 'trim|required|min_length[5]|max_length[32]|alpha_numeric');
				
			$this->load->model('model_add_admin');
			if($this->model_add_admin->check_password($session_user)['password'] == sha1($_POST['admin_pass'])){
				if($this->form_validation->run() == FALSE)
				{
					$data['msg'] = validation_errors();
					$this->success($data); 
				}
				else
				{
					include("./application/controllers/admin/controller_retrieve_email.php");
					if(strlen($_POST['icsmail']) > 0){
						$new_email = $_POST["icsmail"];
					}else{	
						$new_email = $email;
					}
					if(strlen($_POST['icsmailpw']) > 0){
						$new_password = $_POST["icsmailpw"];
					}else{
						$new_password = $password;
					}
					//save content to string
					//overwrite the text file with the new settings
					$savestring = $new_email."\n".$new_password;
					$fp = fopen('./application/third_party/e99b386ab2e00f9ad17b.txt', "w");
					fwrite($fp, $savestring);
					fclose($fp);
					echo "<script>alert('You have successfully changed ICS e-Lib settings.');</script>";
					$session_user = $this->session->userdata('logged_in')['username'];
					$this->add_log("Admin $session_user changed ICS e-Lib settings.", "System Settings");

					$data['msg'] = "<span class='color-green'>You have successfully changed ICS e-Lib settings.</span>";
					$this->success($data);
				}
			}else{
				$data['msg'] = "<span class='color-red'>Administrator password mismatched with the one stored in the database.</span>";
				$this->success($data); 
			}
		}
        //redirect('index.php/admin/controller_settings', 'refresh');
    }
	
	public function changeAdminPassword()
    {
		if($this->model_check_session->check_admin_session() == TRUE){
			$data['msg'] ="";
			$data['msg1'] ="";
			if($this->session->userdata('logged_in_type')!="admin")
				redirect('index.php/user/controller_login', 'refresh');
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->load->library('form_validation');
			// field name, error message, validation rules
			$this->form_validation->set_rules('admin_password', 'New Password', 'trim|min_length[5]|max_length[32]|alpha_numeric');
			$this->form_validation->set_rules('admin_password1', 'Retype Password', 'trim||matches[admin_password]');
			if(isset($_POST['admin_password']) and isset($_POST['admin_password1']))
				$this->form_validation->set_rules('admin_pass', 'Password Confirmation', 'trim|required|min_length[5]|max_length[32]|alpha_numeric');
			
			$this->load->model('model_add_admin');
			if($this->model_add_admin->check_password($session_user)['password'] == sha1($_POST['admin_pass'])){
				if($this->form_validation->run() == FALSE)
				{
					$data['msg1'] = validation_errors();
					$this->success($data); 
				}
				else
				{
					$new_pass = sha1($_POST["admin_password"]);
					$this->load->model('model_add_admin');
					$this->model_add_admin->change_password($session_user, $new_pass);
					$data['msg1'] = "<span class='color-green'>You have successfully changed your administrator password.</span>";
					$this->success($data);
				}
			}else{
				$data['msg'] = "<span class='color-red'>Administrator password mismatched with the one stored in the database.</span>";
				$this->success($data); 
			}
			
		}
        //redirect('index.php/admin/controller_settings', 'refresh');
    }

    function success($data) {
		$data['parent'] = "Admin";
		$data['current'] = "Settings";
		$this->load->helper(array('form','html'));
		$this->load->view("admin/view_header",$data);
		$this->load->view("admin/view_aside");
		$this->load->view("admin/view_settings",$data);
		$this->load->view("admin/view_footer");
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */

