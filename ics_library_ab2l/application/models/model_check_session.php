<?php
class Model_check_session extends CI_Model {

	public function check_session()
	{
		//if user, return true
		if($this->session->userdata('logged_in_type')=="user"){
         	return true;
        }
        
        //else if, admin, redirect to admin page
		else if($this->session->userdata('logged_in_type')=="admin"){

			redirect('index.php/admin/controller_admin_home');
		}
		
		//else, return false
		else{
			redirect('index.php/user/controller_login');
			return false;
		}
	}

	public function check_admin_session()
	{
		//if admin, return true
		if($this->session->userdata('logged_in_type')=="admin"){
         	return true;
        }
        
        //else if, user, redirect to user home
		else if($this->session->userdata('logged_in_type')=="user"){

			redirect('index.php/user/controller_home');
		}
		//else, return false
		else{
			redirect('index.php/user/controller_login');
			return false;
		}

	}
}
?>
