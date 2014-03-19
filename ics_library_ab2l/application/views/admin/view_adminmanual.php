<!DOCTYPE html>
<html>
	<head>
		<title>Admin Manual</title>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/build-full.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/main-template.css" media="all"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery-ui.css"><!--source: http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css-->
  		<link rel="stylesheet" href="<?php echo base_url(); ?>style/user/slider.css" type="text/css" media="screen" />
  		<link rel="stylesheet" href="<?php echo base_url(); ?>default/default.css" type="text/css" media="screen" />
  		<link rel="icon" href="<?php echo base_url(); ?>images/ics_icon.png"/>
  		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/edit.css" media="all"/>
		<style type="text/css">
			* {font-family: Arial;}
			span {font-size: 20px;}
			h2, span, hr, .sub {color: #BF0A0A;}
			h2 {font-weight: bold;}
			body{
				margin: 30px;	
			}
			
			#dialogoverlay{
				display: none;
				position: absolute;
				width: 100%;
				

			}
			#dialogbox{
				margin-top: 4%;
				margin-left:16%;
				background: #B00000 ;
				border-radius:4%; 
				width:70%;
				height: 85%;
				z-index: 10;
			}

			#dialogboxhead{
				margin-top: 2%;
			}

			#boxbody{
				height: 97%;
			}
			#dialogboxbody{
				width:95.4%;
				height: 72%;
				overflow-x:auto;
				background:white;
			}


			#dialogbox > div{ background:#B80000  ; margin:8px; }
			#dialogbox > div > #dialogboxhead{ background: #B80000 ; font-size:19px; padding:10px; color:white; }
			#dialogbox > div > #dialogboxbody{ padding:20px; color:black; }
			#dialogbox > div > #dialogboxfoot{ background: #B80000 ; padding:10px; text-align:right;color:white; }

			<script>
				function CustomAlert(){
					this.render = function(){
						var winW = window.innerWidth;
					    var winH = window.innerHeight;
						var dialogoverlay = document.getElementById('dialogoverlay');
					    var dialogbox = document.getElementById('dialogbox');
						dialogoverlay.style.display = "block";
					    dialogoverlay.style.height = winH+"px";
						dialogbox.style.left = (winW/2) - (550 * .5)+"px";
					    dialogbox.style.top = "100px";
					    dialogbox.style.display = "block";
					//	document.getElementById('dialogboxhead').innerHTML = "USER MANUAL";
					//    document.getElementById('dialogboxbody').innerHTML = "Do you want to add these information in the database?";
					//	document.getElementById('dialogboxfoot').innerHTML = '� 2013 ICS UPLB';
					}
					this.ok = function(){
						document.getElementById('dialogbox').style.display = "none";
						document.getElementById('dialogoverlay').style.display = "none";
						proceed_add();
					}
					
					this.no = function(){
						document.getElementById('dialogbox').style.display = "none";
						document.getElementById('dialogoverlay').style.display = "none";
					}
				}
				
				var Alert = new CustomAlert();
			</script>	
		</style>
	</head>
	<body onload="Alert.render()">
		<div id="dialogoverlay"></div>
			<div id="dialogbox">
				<div id="boxbody">
					<div id="dialogboxhead">ADMINISTRATOR MANUAL</div>
					<div id="dialogboxbody">
					<a name="top"></a>
					<h2>Privileges</h2>
					<a href="<?php echo base_url() ?>index.php/admin/controller_admin_home" class="tiny">Back to Home</a>	<!-- Cla, palagay na lang nung link :D -->
					<hr width="450px;"><br/>
					<span>Table of Contents</span>
						<div id="sub">User</div>
						<ul>
							<li><a href="#view_users">View Users</a></li>
							<li><a href="#add_user">Add User</a></li>
							<li><a href="#deactivate">Deactivate all borrower accounts</a></li>
							<li><a href="#search_user">Search Users</a></li>
							
							<li><a href="#approve">Approve User Accounts</a></li>
							<li><a href="#add_admin">Add Administrator</a></li>
						</ul>
						<div id="sub">Admin</div>
						<ul>
							<li><a href="#announcement">Add/Update Announcements</a></li>
							<li><a href="#stat">View Statistics</a></li>
							<li><a href="#log">View Logs</a></li>
						</ul>
						<div id="sub">Book</div>
						<ul>
							<li><a href="#add_book">Add books</a></li>
							<li><a href="#update">Update book information </a></li>
							<li><a href="#delete">Delete Book </a></li>
							<li><a href="#books">Record of Books</a>
								<ul>
									<li><a href="#borBooks">List of Borrowed Books</a></li>
									<li><a href="#overdueBooks">List of Overdue Books</a></li>
									<li><a href="#outgoingBooks">List of Outgoing Books</a></li>
								</ul>
							</li>
						</ul>			
						<br/><hr width="450px;"><br/>
						<a name="view_users"></a>
						<span>View Users</span>
						<br/><br/>
					<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/view_user.png" alt="image not found" height="500" width="800"/>
				</div><br/>
				<ul>
					<li>This displays the information of all the registered user accounts of the system.</li>
					<li>Includes the user accounts which have not been approved yet.</li>
					<li>It also allows the administrator to confirm unconfirmed user accounts and manually borrow books for confirmed user accounts.</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="add_user"></a>
				<span>Add User</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/add_user.png" alt="image not found" height="100" width="500"/>
				</div><br/>
				<ul>
					<li>This allows users to manually register their accounts through the administrator.</li>
					<li>Allows the administrator to fill the information needed to create a new user account.</li>
					<li>Accounts created through the administrator is automatically approved.</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="deactivate"></a>
				<span>Deactivate all Borrowers' Account</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/deactivate_accounts.png" alt="image not found" height="500" width="800"/>
				</div><br/>
				<ul>
					<li>The administration needs to deactivate all active accounts before the semester starts for him to monitor the users who are registered in that semester.
					<li> Deactivated users will not be able to borrow books but can still use other features such as search.</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="search_user"></a>
				<span>Search Users</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/search_users.png" alt="image not found" height="500" width="400"/>
				</div><br/>
				<ul>
					<li>The administrator is capable of searching for a specific user to retrieve any needed information about the user using their student number.</li>
					<li>The given list will then display all the information of the specified user.</li>

				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>


				
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="approve"></a>
				<span>Confirm/Approve User Account</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/confirm_accounts.png" alt="image not found" height="700" width="800"/>
				</div><br/>
				<ul>
					<li>An important privilege of the administrator is to approve registered user accounts. The approval of user accounts is necessary for securing the
					authority of the user to use the Library System and to be able to monitor the users' activities. </li>
					<li>The requirements for approval of account are: UPLB Validated ID or Employee ID, Form 5 for the current semester (for students only)</li>
					<li>There will be a queue of pending user accounts. There will be a button for the approval of each account. Upon clicking the button, a pop-up message will appear for the assurance of accepting the account as valid one.</li>

				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="add_admin"></a>
				<span>Add Administrator</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/add_admin.png" alt="image not found" height="700" width="500"/>
				</div><br/>
				<ul>
					<li>The administrator has a privilege of adding a new administrator who passed qualifications.</li>
					<li>Allows the administrator to fill up the fields for a new administrator.</li>
					<li>The administrator key will be provided by the administrator.</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>
				
				<a name="announcement"></a>
				<span>Add/Update Announcements</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/add_announcement.png" alt="image not found" height="500" width="800"/>
				</div><br/>
				<ul>
					<li>The privilege of the administrator to add and update announcements to provide helpful information for the users.</li>
					<li>There is a maximum of 5 announcements that will be displayed in the home page.</li>
					<li>The posted announcements will appear in the home page, visible for visitors and authenticated users. </li>
					<li>The administrator is allowed to not put any announcements. </li>
					<li>Once he/she reaches the maximum limit of announcements, the system will overwrite the oldest announcement. The most recent announcements will appear chronologically.</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="stat"></a>
				<span>View Statistics</span>

				<ul>
					<li>Displays in a chart the top 10 most borrowed books.</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="log"></a>
				<span>View Logs</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/view_log.png" alt="image not found" height="500" width="800"/>
				</div><br/>
				<ul>
					<li>This privilege allows administrators to track changes and actions committed by each other.</li>
					<li>This separate page is visible only to the administrator. This contains username of the administrators, his/her committed for a specific duration of time he/she is logged-in, and when did he/she did the tasks.</li>
					<li>This page is for viewing only. There is no capability to delete or edit tasks done.</li>
					<li>The display can be filtered by logs for the current date and by all the logs in the previous dates..</li>
					
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="add_book"></a>
				<span>Add Books</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/add_books.png" alt="image not found" height="800" width="600"/>
				</div><br/>
				<ul>
					<li>This is for adding new materials to the library. This is necessary for future expansion of the ICS Library.</li>
					<li> The administrator needs to fill up the necessary information about the book. It will not let the administrator submit it unless all the values entered are correct and all required fields have been filled in. </li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="update"></a>
				<span>Update Book Information </span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/edit_book.png" alt="image not found" height="500" width="800"/>
				</div><br/>
				<ul> 
					<li>The privilege of the administrator to update information about the book is necessary in the development and usage of the system for the maintenance of evolution of the books available.</li>
					<li>Every book has a corresponding button for edit function. </li>
					<li>Upon clicking the update button, all previous details will be shown up and it is up to the administrator what details to edit. Validation of field will also be observed. A pop-up message will appear to show assurance of saving all changes he/she made. After this, all data entered will be automatically saved in the database.</li>

				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/edit_book2.png" alt="image not found" height="500" width="400"/>
				</div><br/>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="delete"></a>
				<span>Delete Book</span>
				<br/><br/>
				<div>
					<img src="<?php echo base_url(); ?>images/admin_manual_images/delete_book.png" alt="image not found" height="600" width="800"/>
				</div><br/>
				<ul> 
					<li>The privilege of the administrator to delete book records is necessary when the book is already obsolete or if a book in the library is no longer available.</li>
					<li>Every book has a corresponding button for delete function. </li>
					<li>Upon clicking the delete button, a pop-up message will appear to show assurance of saving all changes he/she made. </li>
					
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>

				<a name="books"></a>
				<span>Records of Books</span>
				<ul>
					<a name="borBooks"></a>
					<li><span>List of Borrowed Books</span>
					<br/><br/>
					<div>
						<img src="<?php echo base_url(); ?>images/admin_manual_images/view_books.png" alt="image not found" height="500" width="800"/>
					</div><br/>
						<ul>
							<li>Shows the list of books currently in the possession of the user.</li>
							<li>Shows the details of the transaction and the details of the book.</li>
						</ul>
					</li>
					<a name="overdueBooks"></a>
					<li><span>List of Overdue Books</span>
					<br/><br/>
					<div>
						<img src="<?php echo base_url(); ?>images/admin_manual_images/overdue_books.png" alt="image not found" height="500" width="800"/>
					</div><br/>
						<ul>
							<li>Shows the list of books not yet returned by the user and is already reached the due date.</li>
							<li>Shows the details of the transaction and the details of the book.</li>
						</ul>
					</li>

					<a name="outgoingBooks"></a>
					<li><span>List of Outgoing Books</span>
					<br/><br/>
					<div>
						<img src="<?php echo base_url(); ?>images/admin_manual_images/outgoing_books.png" alt="image not found" height="500" width="800"/>
					</div><br/>
						<ul>
							<li>Shows the list of books reserved by the user.</li>
							<li>Shows the details of the transaction and the details of the book.</li>
						</ul>
					</li>
				</ul>
				<a href="#top" class="tiny">Back to Top</a>
				<br/><hr width="450px;"><br/>
			</div>
			<div id="dialogboxfoot">� 2013 ICS UPLB</div>
				
			</div>
		</div>
	</body>
</html>

<!-- End of file view_adminmanual.php */
    /* Location: ./application/views/admin/view_adminmanualphp */ -->
