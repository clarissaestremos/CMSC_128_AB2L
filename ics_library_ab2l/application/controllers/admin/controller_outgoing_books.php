<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	include_once("controller_log.php");
	
	class Controller_outgoing_books extends Controller_log{
 
    		function index() {
	        	$this->load->model('model_reservation');
	        	$data['parent'] = "Books";
	        	$data['current'] = "Outgoing Books";
	        	$data['query'] = $this->model_reservation->show_all_user_book_reservation("reserved",0,0);   
	        
	            	$this->load->view("admin/view_header",$data);
	            	$this->load->view("admin/view_aside");
	            	$this->load->view('admin/view_outgoing_books', $data);
	            	$this->load->view("admin/view_footer");
    		}

    		/*The function send_email sends an email to the borrower with overdue materials*/
    		public function send_email(){
        		if($this->session->userdata('logged_in_type')!="admin")
            		redirect('index.php/user/controller_login', 'refresh');
        		if(isset($_POST['notify_all'])){
				include("./application/controllers/admin/controller_retrieve_email.php");
            			$config = array(
            				'protocol'  => 'smtp',
            				'smtp_host' => 'ssl://smtp.gmail.com',
		            		'smtp_port' => 465, //25
		            		'smtp_user' => "$email",
		            		'smtp_pass' => "$password",
		            		'mailtype'  => 'html', 
		            		'charset'   => 'utf-8',
		            		'wordwrap'  => true,
		            		'newline'   => "\r\n",
		            		'crlf'      => "\n"
		            	);//config for the email
		            	//$account_number=$_POST['account_number'];
		            	//$to=$_POST['email'];
		            	$subject='Re: ICS e-Lib Overdue Materials';
		            	$from_email = "$email";
		            	$from_name='ICS e-Lib';
            
            			$this->load->model('model_reservation');
            			//Get user account in database
            			$data['result'] = $this->model_reservation->get_overdue_accounts();
            			foreach($data['result'] as $recipients){
                			$to = $recipients->email;
                			$account_number = $recipients->account_number;
                			$data['query'] = $this->model_reservation->get_overdue_user_info($to);
                			foreach($data['query'] as $row){
                    				$first_name = $row->first_name;
                    				$middle_initial = $row->middle_initial;
                    				$last_name = $row->last_name;
                			}
                
                			//This will construct the body of the message to be sent to the borrower with overdue materials.
                			$message = "Dear {$first_name} {$middle_initial}. {$last_name},<br /><br />Please settle your library accountabilities as soon as possible.<br />Overdue Materials<br />";
                			foreach($data['query'] as $row){
                    				$message .= "Title: {$row->title}<br />";
                    				$data['query1'] = $this->model_reservation->get_book_authors($row->id);
                    				$authors ="";
                    				foreach($data['query1'] as $authors_list){
                        				$authors .= "{$authors_list->author}; ";
                    				}
                    				$message .= "Author(s): {$authors}<br />";
                    				$message .= "Date Borrowed: {$row->date_borrowed}<br />";
                    				$message .= "Due Date: {$row->due_date}<br /><br />";
                			}
                			$message .= "If you've already settled your accountabilities, please ignore this message.<br />";
                			$message .= "For inquiries, please contact the ICS Library librarian.<br /><br />";
                			$message .= "Thank you!<br />ICS Library Administrator<hr />";
					$message .= "The ICS e-Lib will never ask or provide confidential account details such as your password. In case you've received messages from us asking for your password, please report them immediately to our administrators. Thank you!<br />Mag-aral ng mabuti!";

                			//Composing the email
                			$this->load->library('email', $config);
					$this->email->initialize($config);
                			$this->email->set_newline("\r\n");
                			$this->email->from($from_email, $from_name);
                			$this->email->to($to); 
                			$this->email->subject($subject);
                			$this->email->message($message);
                			//Send the email
                			//if($this->email->send()){
                    			$this->model_reservation->update_user_date_notif($account_number);
                			//}	
            			}
            			unset($_POST['notify_all']);
            			$date = date("Y-m-d");
				$session_user = $this->session->userdata('logged_in')['username'];
            			$this->add_log("Admin $session_user sent notification email to all borrowers with overdue materials for $date", "Notify Users");
				redirect('index.php/admin/controller_reservation','refresh');
        		}//END OF notify_all
    		}
    		
    		/* This function extends the deadline of a material. */
    		public function extend(){
			if($this->session->userdata('logged_in_type')!="admin")
                	redirect('index.php/user/controller_login', 'refresh');
        		$res_number=$_POST['res_number'];
        		$this->load->model('model_reservation');
        		$this->model_reservation->update_book_reservation($res_number, "extend");
			$session_user = $this->session->userdata('logged_in')['username'];
            		$this->add_log("Admin $session_user extended a book reservation with Reservation Number: $res_number", "Extend Reservation");
            		echo "<div id='mysuccess' title='Add Book Success'>
        			<h6>You have successfully confirmed to extend the material's due date!</h6>
        		</div>
        		<script src='$base/js/jquery-1.10.2.min.js'></script>
        		<script src='$base/js/jquery-ui.js'></script>
        		<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
        		<script>
            			$('#mysuccess').dialog({
                			modal: true,
                			closeOnEscape: true,
                			resizable: false,
                  			width: 300,
                  			minHeight: 200,
                			closeText: 'show',
                			show: {
                  				effect: 'fadeIn',
                  				duration: 200
                			},
                			draggable: false,
                			close: function(event, ui){
                    				window.location.replace('$base/index.php/admin/controller_reservation');
                			},
                			buttons : {
                  				'Ok': function() {
                      					window.location.replace('$base/index.php/admin/controller_reservation');
                  				},
                			}
     
            			});
        		</script>";
    		}//END OF extend()
    		
    		/* This function is used when a material is returned to the library. */
    		public function return_book(){
			if($this->session->userdata('logged_in_type')!="admin")
                	redirect('index.php/user/controller_login', 'refresh');
        		$res_number=$_POST['res_number'];
        		$this->load->model('model_reservation');
        		$this->model_reservation->update_book_reservation($res_number, "returned");
        		echo "<div id='mysuccess' title='Add Book Success'>
        			<h6>You have successfully confirmed the return of the material!</h6>
        		</div>
        		<script src='$base/js/jquery-1.10.2.min.js'></script>
        		<script src='$base/js/jquery-ui.js'></script>
        		<link rel='stylesheet' href='$base/style/jquery-ui.css'/>
        		<script>
            			$('#mysuccess').dialog({
                			modal: true,
                			closeOnEscape: true,
                			resizable: false,
                  			width: 300,
                  			minHeight: 200,
                			closeText: 'show',
                			show: {
                  				effect: 'fadeIn',
                  				duration: 200
                			},
                			draggable: false,
                			close: function(event, ui){
                    				window.location.replace('$base/index.php/admin/controller_reservation');
                			},
                			buttons : {
                  				'Ok': function() {
                      					window.location.replace('$base/index.php/admin/controller_reservation');
                  				},
                			}
     
            			});
        		</script>";
    		}//END OF return_book()
    		
    		/* This function reserves a book for a user. */
    		public function reserve(){
        		$base = base_url();
        		$flag = true;
			if($this->session->userdata('logged_in_type')!="admin")
                	redirect('index.php/user/controller_login', 'refresh');
        		$res_number=$_POST['res_number'];
        		$this->load->model('model_reservation');
        		//if the borrower currently has less than three materials borrowed, he will be allowed to borrow another one
        		if($this->model_reservation->count_user_reservation($res_number) < 3){
				$this->model_reservation->update_book_reservation($res_number, "reserved");
				$session_user = $this->session->userdata('logged_in')['username'];
            			$this->add_log("Admin $session_user confirmed a book reservation with Reservation Number: $res_number", "Confirm Reservation");
			}
			//if he already has three borrowed materials, the request will not be granted and he will be asked to return other materials that he has in order to borrow another one
			else{
            			$flag = false;
            			echo "
                    			<div id='mysuccess' title='Add User Account Success'>
                        			<h6>Maximum number of allowable books to be borrowed has been reached! Please return other books on hand to be able to borrow new books again.</h6>
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
                                    				window.location.replace('$base/index.php/admin/controller_reservation');
                                			},
                                			buttons : {
                                  				'Ok': function() {
                                      					window.location.replace('$base/index.php/admin/controller_reservation');
                                  				},
                                			}
                     
                            			});
                        		</script>";
					$this->model_reservation->delete_book_reservation($res_number);
			}
			
        		if($flag)
		  	redirect('index.php/admin/controller_reservation','refresh');
    		}//END OF reserve()
    		
    		/* This function cancels a reservation. */
    		public function cancel(){
			if($this->session->userdata('logged_in_type')!="admin")
                	redirect('index.php/user/controller_login', 'refresh');
       
        		$res_number=$_POST['res_number'];
        		$call_number = $_POST['call_number'];

        		$this->load->model('model_get_list');
        		$this->model_get_list->cancel_reservation($res_number);
        		$this->model_get_list->update_rank($call_number);
        		$this->model_get_list->update_available($call_number);
        		redirect('index.php/admin/controller_outgoing_books','refresh');
    		}//END OF cancel()
		
		/* This function gets the information of the reserved books. */
    		function get_info() {
        		$this->load->model('model_reservation');
        		$status = "reserved";

        		$data['result_all']  = $this->model_reservation->show_reservation($status,NULL,0,0);

        		//configuration of the ajax pagination  library.
        		$config['base_url'] = base_url().'index.php/admin/controller_outgoing_books/get_info';        //EDIT THIS BASE_URL IF YOU ARE USING A DIFFERENT URL. 
        		$config['total_rows'] = count($data['result_all']);
        		$config['per_page'] = '10';
        		$config['div'] = '#change_here';
      			//  $config['additional_param']  = 'serialize_form1()';

        		$page=$this->uri->segment(4);       // splits the URI segment by /
        
        		$data['result'] = $this->model_reservation->show_reservation($status,$data['result_all'],$config['per_page'],$page);
        		$this->jquery_pagination->initialize($config);
        		//$this->pagination->initialize($config);
        		$data['links'] = $this->jquery_pagination->create_links();
        		$this->print_info($data['result'],$data['links']); 
    		}
		
		/* This function shows/prints the information of the reserved books. */
     		function print_info($query,$links) {

        		echo '<table class="body">
            			<thead>
                			<tr>
                    				<th style="width: 2%;">#</th>
                    				<th style="width: 20%;">Borrower</th>
                    				<th style="width: 40%;">Material</th>
                    				<th style="width: 10%;">Due Date</th>
                    				<th style="width: 10%;"></th>
                    				<th style="width: 10%;"></th>
                			</tr>
            			</thead>
            
            		<tbody>';
                
                	$count = 1;
                	foreach($query as $row) {
                		if($row->rank == 1){
                        		echo "<tr>
	                    			<td>$count</td>
	                    			<td><b>{$row->first_name} {$row->middle_initial}. {$row->last_name}</b><br/>{$row->account_number}</td>
	                    			<td><b>{$row->title}</b><br/>";

	                    			$data['multi_valued'] = $this->model_reservation->get_book_authors($row->id);
	                    			$authors="";
	                    			foreach($data['multi_valued'] as $authors_list){
	                       				$authors = $authors."{$authors_list->author},";
	                    			}
	                    			echo "$authors ($row->year_of_pub)<br/>
	                    			Call Number: {$row->call_number}</td>";
                        		echo "</td>
	                    		<td>{$row->due_date}</td>";
	                    		echo "<td><form action='controller_outgoing_books/reserve/' id='confirm$count' method='post'>
	                        		<input type='hidden' name='res_number' value='{$row->res_number}' />
	                        		<input type='submit' class='background-red' name='reserve' onclick='return confirmBookReserve(confirm$count);' value='Confirm' />
	                    		</form></td>";              //button to be clicked if the reservation will be approved; functionality of this not included
	                    		echo "<td><form action='controller_outgoing_books/cancel/' id='cancel$count' method='post'>
                            			<input type='hidden' name='res_number' value='{$row->res_number}' />
	                        		<input type='hidden' name='call_number' value='{$row->call_number}' />
	                        		<input type='submit' class='background-red' name='cancel' onclick='return confirmDeleteReserve(cancel$count);' value='Cancel' />
	                    		</form></td>";              //button to be clicked if the reservation will be cancelled; functionality of this not included
	                     		echo "</tr>";

	            			$count++;
						}
                	}
                                
                        echo'    </tbody>
                         	</table>
                            		<div class="footer pagination">';
                                		echo $links;
                            		echo "</div>";
    		}
    
	}
/* End of file controller_outgoing_books.php*/
/* Location: ./application/controllers/admin/controller_outgoing_books.php */
