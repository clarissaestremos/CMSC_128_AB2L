<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('controller_log.php');
class Controller_view_users extends Controller_log {
 
    function index() {
        $this->viewUser(null);
    }

    function viewUser($msg){
    /*Views all the users in the page*/
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
    /*Searches for the users*/
        $this->load->model('model_users');
        $data['results']=$this->model_users->userSearch($this->input->post('s_user'));
        $data['parent'] = "Users";
        $data['current'] = "Search Users";

        $this->load->helper(array('form','html'));
        $this->load->view("admin/view_header",$data);
        $this->load->view("admin/view_aside");
        $this->load->view("admin/view_search_user",$data);
        $this->load->view("admin/view_footer");
    }

    function approve_user(){
    	/*Approves users using account number*/
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
     	/*Removes user using account number*/
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
     	/*Confirms usera ccount by e-mail*/
	if($this->session->userdata('logged_in_type')!="admin")
	    redirect('index.php/user/controller_login', 'refresh');
	    include("./application/controllers/admin/controller_retrieve_email.php");
        
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => $email,
                'smtp_pass' => $password,
                'mailtype'  => 'html', 
                'charset'   => 'utf-8'
			);//config for the email
		$subject='Re: ICS e-Lib Account Approval';
		$from_email= $email;
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
		//displays prompt
		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($from_email, $from_name);
		$this->email->to($to); 
		$this->email->subject($subject);
		$this->email->message($message);
		//Send the email
        	$base = base_url();
    		//if($this->email->send()){
			$this->load->model('model_user');
	        $this->model_user->approve_user($account_number);
	        $session_user = $this->session->userdata('logged_in')['username'];
	        $this->add_log("Admin $session_user verified account of $account_number.", "Verify User Account");
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
                                    window.location.replace('$base/index.php/admin/controller_view_users/viewUser/$account_number');
                                },
                                buttons : {
                                  'Ok': function() {
                                      window.location.replace('$base/index.php/admin/controller_view_users/viewUser/$account_number');
                                  },
                                }
                     
                            });
                        </script>";
		/**}else{
            echo "
                    <div id='mysuccess' title='Add User Account Failed'>
                        <h6>The account of $account_number was not successfully validated! Error: Email failed to send. Please check your internet connection.</h6>
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
                                    window.location.replace('$base/index.php/admin/controller_view_users');
                                },
                                buttons : {
                                  'Ok': function() {
                                      window.location.replace('$base/index.php/admin/controller_view_users');
                                  },
                                }
                     
                            });
                        </script>";
		}*/
	}
        
    function deactivate(){
    /*Deactivates users only if no materials are borrowed or overdue.*/
        if($this->session->userdata('logged_in_type')!="admin")
            redirect('index.php/user/controller_login', 'refresh');
        if(isset($_POST['deactivate'])){
            $this->load->model('model_reservation');
            $overdue = count($this->model_reservation->show_all_user_book_reservation("overdue"));
            $borrowed = count($this->model_reservation->show_all_user_book_reservation("borrowed"));
            $count = $overdue + $borrowed;
             if($count === 0){  //no more books at hand of users, all books are returned in the library
                $this->load->model('model_user');
                $this->model_user->deactivate_users();
                echo "
                    <div id='mysuccess' title='Add User Account Success'>
                        <h6>You have successfully deactivated the accounts of all users.</h6>
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
                                    window.location.replace('$base/index.php/admin/controller_view_users');
                                },
                                buttons : {
                                  'Ok': function() {
                                      window.location.replace('$base/index.php/admin/controller_view_users');
                                  },
                                }
                     
                            });
                        </script>";
             $session_user = $this->session->userdata('logged_in')['username'];
             $this->add_log("Admin $session_user deactivated all user accounts.", "Deactivate Users");
             }
             else{
                echo "
                    <div id='mysuccess' title='Add User Account Success'>
                        <h6>You cannot deactivate all user accounts yet. Some users still have books on loan. Make sure all users have returned their borrowed materials before deactivating all user accounts.</h6>
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
                                    window.location.replace('$base/index.php/admin/controller_view_users');
                                },
                                buttons : {
                                  'Ok': function() {
                                      window.location.replace('$base/index.php/admin/controller_view_users');
                                  },
                                }
                     
                            });
                        </script>";
             }
         unset($_POST['deactivate']);
         }
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

    
    /*FUNCTIONS FOR PAGINATION*/
    
    
    function get_info() {
        $this->load->model('model_users');
        
        $data['result_all']  = $this->model_users->getAllUsers2(NULL,0,0);
 
         //Configuration of the ajax pagination  library.
        $config['base_url'] = base_url().'index.php/admin/controller_view_users/get_info'; //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        $config['total_rows'] = count($data['result_all']);
        $config['per_page'] = '15';
        $config['div'] = '#change_here';
      	//$config['additional_param']  = 'serialize_form1()';

        $page=$this->uri->segment(4);// splits the URI segment by
        
        $data['result'] = $this->model_users->getAllUsers2($data['result_all'],$config['per_page'],$page);
        $this->jquery_pagination->initialize($config);
        //$this->pagination->initialize($config);
        $data['links'] = $this->jquery_pagination->create_links();
        $this->print_info($data['result'],$data['links']); 
    }


    function print_info($results,$links) {
        if(count($results)>0){
        echo '<table class="body">
                <thead>
                    <tr>
                        <th style="width: 2%;">#</th>
                        <th style="width: 8%;">Student Number</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 5%;">Course</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 8%;">Classification</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>';
                        $count = 1;
                        foreach ($results as $row) {
                            echo "<tr>";
                            echo "<td>$count</td>";
                            echo "<td>".$row->account_number."</td>";
                            $fullName = $row->first_name." ".$row->middle_initial.". ".$row->last_name;
                            echo "<td>".$fullName."</td>";
                            echo "<td>".$row->course."</td>";
                            echo "<td>".$row->email."</td>";
                            echo "<td>".$row->classification."</td>";
                            $stat = $row->status;

                            /*
                                If status not yet 'approve', meaning the account was not yet validated,
                                a button with a value 'Validate' will be seen in the status column.
                                If status is already 'approve', meaning the account was already validated,
                                'Registered' will be displayed on the said column. 
                            */
                            $base = base_url();
                            if($stat === "approve"){
                            echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'><input type='button' style='background:#ccc;' value='Click to borrow'/></a></td>";
                            }
                            else{
                                echo "<form action='$base"."index.php/admin/controller_view_users/approve_user' id='accountconfirm$count' method='POST'>";
                                echo "<input type='hidden' name='account_number1' value='$row->account_number'/>";
                                echo "<input type='hidden' name='approve' value='app'/>";
                                echo "<td>"."<input type ='submit' class='background-red' onclick='return confirmUser(accountconfirm$count);' name='approve' value = 'Confirm'>"."</td>";
                                echo "</form>";
                            }
                            
                            echo "</tr>";
                            $count++;
                        }

               echo'</tbody>
            </table>
            <div class="footer pagination">';
                echo $links;
            echo "</div>";
          }
          else if(count($results) == 0){
              echo"<div class='panel datasheet'>
                <div class='header text-center background-red'>
                    No results found.
                </div></div>";

    	}
    }
}
/* End of file home_controller.php */
/* Location: ./application/controllers/user/controller_home.php */
