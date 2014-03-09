<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once("controller_log.php");
class Controller_announcement extends Controller_log {

	public function index()
	{
		$data['parent'] = "Admin";
    	$data['current'] = "View Announcement";
    	
    		$this->load->helper(array('form','html'));
	        $this->load->view("admin/view_header",$data);
	        $this->load->view("admin/view_aside");
	        $this->load->view("admin/view_announcements");
	        $this->load->view("admin/view_footer");
	}
	
	public function viewForm(){
		//$this->load->view("admin/view_add_announcement.php");
		$data['parent'] = "Admin";
    	$data['current'] = "Add Announcement";
    	$data['user'] = $this->session->userdata('logged_in');
    	$this->load->helper(array('form','html'));
	    $this->load->view("admin/view_header",$data);
	    $this->load->view("admin/view_aside");
	    $this->load->view("admin/view_add_announcement.php");
	    $this->load->view("admin/view_footer");
		
		if(isset($_POST["add"]))
		{
			$this->writeToFile();
		}else if(isset($_POST["cancel"])){
			header("refresh:0;url=../controller_announcement");
		}

		
	}
	
	public function deleteAll(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		if(isset($_POST["delete_all"]))
		{
			$fp = fopen('./application/announcements.txt', "w");
			fclose($fp);
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $session_user deleted all announcements.", "Delete Announcements");
			header("refresh:0;url=../controller_announcement");
		}
	}
	
	public function writeToFile(){
		$status = 1;
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		if(isset($_POST["add"]))
		{
			$title = htmlspecialchars($_POST["title"]);	
			$content = nl2br(htmlspecialchars($_POST["content"]));
			$date = date('M-d-Y');
			$time = date("G:i:s");
				
			if(trim($content) == '')
			{
				$status = 0;
				echo "You did not fill out the required fields.";
			}

			//save content to string
			//overwrite the text file with the new announcement

			if($status == 1){
				$savestring = "*" . $date ."-". $time . "^" . $title . "#" . $content;
				$txt_file = file_get_contents('./application/announcements.txt');
				$announcements = explode("*", trim($txt_file, "*"));	//separate the announcements
				foreach($announcements as $announcement){	//remove announcements older anouncements
					$index = array_search($announcement, $announcements);
					if($index > 3)	
						unset($announcements[$index]);
				}
				$new="";
				foreach($announcements as $announcement){
					$new .= "*".$announcement;
				}
				$fp = fopen('./application/announcements.txt', "w");
				fwrite($fp, $savestring);
				fwrite($fp, $new);
				fclose($fp);
				$session_user = $this->session->userdata('logged_in')['username'];
				$this->add_log("Admin $session_user added a new announcement.", "Add Announcement");
				unset($_POST["add"]);
				redirect('index.php/admin/controller_announcement','refresh');
			}
		}
	}
	
	public function find(){
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		if(isset($_POST["edit"]))
		{
			$id = htmlspecialchars($_POST["date"]);
			$flag = 0;
			$txt_file = file_get_contents('./application/announcements.txt');
			$rows = explode("*", $txt_file);
			array_shift($rows);

			foreach($rows as $row => $data)
			{
				$data1 = explode("^",$data);
				$info[$row]['date'] = $data1[0];
				$info[$row]['tc'] = $data1[1];

				if($data1[0] == $id){
					$flag = 1;
				}

				array_shift($data1);

				foreach($data1 as $row => $data2)
				{
					$row_data = explode('#', $data2);
					$info[$row]['title'] = $row_data[0];
					$info[$row]['content'] = $row_data[1];
					if($flag == 1){
						$title = $row_data[0];
						$content = $row_data[1];
						$content = str_replace( '<br />', '', $content);
					}
				}

				if($flag == 1){
					break;
				}
			}

			/*
			Saves the id, title, and content to an array and pass it to the view.
			*/

			$entry['id'] = $id;
			$entry['title'] = $title;
			$entry['content'] = $content;
			
			$entry['parent'] = "Admin";
	    	$entry['current'] = "Edit Announcement";
			
			$this->load->helper(array('form','html'));
			$this->load->view("admin/view_header", $entry);
			$this->load->view("admin/view_aside");
			$this->load->view("admin/view_edit_announcement", $entry);
			$this->load->view("admin/view_footer");
			
		}else if(isset($_POST["delete"])){
			$txt_file = file_get_contents('./application/announcements.txt');
			$id = htmlspecialchars($_POST["date"]);
			$announcements = explode("*", trim($txt_file, "*"));	//separate the announcements
			foreach($announcements as $announcement){	//find the announcement to be deleted
				if(strpos($announcement, $id)!== false)				
					$index = array_search($announcement, $announcements);
			}
			unset($announcements[$index]);	//delete the element
			$new="";
			foreach($announcements as $announcement){
				$new .= "*".$announcement;
			}
			$fp = fopen('./application/announcements.txt', "w");
			fwrite($fp, $new);
			fclose($fp);
			$session_user = $this->session->userdata('logged_in')['username'];
			$this->add_log("Admin $session_user deleted an announcement.", "Delete Announcement");
			header("refresh:0;url=../controller_announcement");
		}
	}
	
	public function saveChanges(){
		$status = 1;
		if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
		if(isset($_POST["save"]))
		{
			$new_title = htmlspecialchars($_POST["title"]);	
			$new_content = nl2br(htmlspecialchars($_POST["content"]));
			$new_date = date('M-d-Y');
			$new_time = date("H:i:s");
				
			if(trim($new_content) == '')
			{
				$status = 0;
				echo "You did not fill out the required fields.";
			}
			
			if($status == 1){
				$txt_file = file_get_contents('./application/announcements.txt');
				$id = htmlspecialchars($_POST["date"]);
				$announcements = explode("*", trim($txt_file, "*"));	//separate the announcements
				foreach($announcements as $announcement){	//find the announcement to be deleted
					if(strpos($announcement, $id)!== false)				
						$index = array_search($announcement, $announcements);
				}
				unset($announcements[$index]);	//delete the element
				$new="";
				foreach($announcements as $announcement){
					$new .= "*".$announcement;
				}
				$fp = fopen('./application/announcements.txt', "w");
				fclose($fp);

				$fp = fopen('./application/announcements.txt', "a");
				$savestring = "*" . $new_date ."-". $new_time . "^" . $new_title . "#" . $new_content;
				fwrite($fp, $savestring);
				fwrite($fp, $new);
				fclose($fp);
				$session_user = $this->session->userdata('logged_in')['username'];
				$this->add_log("Admin $session_user updated an announcement", "Update Announcement");
				header("refresh:0;url=../controller_announcement");
			}
		}
		else if(isset($_POST["cancel"])){
			header("refresh:0;url=..");
		}
	}
}
