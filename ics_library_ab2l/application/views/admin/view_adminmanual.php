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
	//	document.getElementById('dialogboxfoot').innerHTML = '© 2013 ICS UPLB';
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
			<li><a href="#notify">Notify the Borrower</a></li>
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
		<ul>
			<li>The system gives the administrator the ability to view the registered users of the library. </li>
			<li>This can display the information of all the accounts of users of the system.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="add_user"></a>
		<span>Add User</span>
		<ul>
			<li>The administrator can add new users who want to access the online library and borrow materials from the library given that the student opts to register manually (filling the form in a paper). </li>
			<li>Allows the administrator to fill the information neede to create a new user.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="deactivate"></a>
		<span>Deactivate all Borrowers' Account</span>
		<ul>
			<li>The administration needs to deactivate all active accounts before the semester starts for him to monitor the users who are registered in that semester.
			<li> Deactivated users will not be able to borrow books but still can use other features such as search.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="search_user"></a>
		<span>Search Users</span>
		<ul>
			<li>The administrator is capable of searching for a specific user to retrieve any needed information about the user using their student number.</li>
			<li>The given list will then update showing all the information of the specified user.</li>

		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>


		<a name="notify"></a>
		<span>Notify the borrower</span>
		<ul>
			<li>The administrator or the librarian-in-charge will send a notification to the user's email whenever he/she passed all the requirements and whenever he/she has overdue books. </li>
			<li>The privilege of the administrator to notify the borrower in their emails is necessary in the development and usage of the system because it is for the benefit of the users to get reminded of the things they tend to forget, for them to borrow any books in the library.</li>
			<li>A notification will be sent to user's email if he/she approves his/her account. </li>
			<li>There is a button to signal the system that it needs to use the e-mailer application to send notification to the email of the borrowers.</li>
			<li>On the other hand, the administrator will know if the borrower has overdue books, thus a button for notification will appear to notify the borrower.</li>  
			<li>The user should have old transaction of the current time before administrator checks if he/she has overdue books.</li>

		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="approve"></a>
		<span>Approve User Account</span>
		<ul>
			<li>TThe privilege of the administrator to approve user accounts is necessary in the development and usage of the system because approved account is their prerequisite to borrow any books in the library. 
			<li>The requirements for approval of account are: UPLB Validated ID or Employee ID, Form 5 for the current semester (for students only)</li>
			<li>There will be a queue of pending user accounts. There will be a button for the approval of each account. Upon clicking the button, a pop-up message will appear for the assurance of accepting the account as valid one. After the confirmation, this will automatically send a notification to email of the user. </li>

		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="add_admin"></a>
		<span>Add Administrator</span>
		<ul>
			<li>The administrator has a privilege of adding a new administrator who passed qualifications.</li>
			<li>Allows the administrator to fill up the fields for new administrator.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		<a name="announcement"></a>
		<span>Add/Update Announcements</span>
		<ul>
			<li>The privilege of the administrator to add and update announcements is only an added feature but it is very useful to the visitors and users for them to know what are the updates on the library especially its books.</li>
			<li>There is a maximum of 5 announcements that will be made available. </li>
			<li>The posted announcements will appear in the home page, visible for visitors and authenticated users. </li>
			<li>The administrator is allowed to not put any announcements. </li>
			<li>Once he/she reaches the maximum limit of announcements, the system will overwrite the oldest announcement.The first posted announcement will be automatically deleted. The recent announcements will appear chronologically.</li>
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
		<ul>
			<li>The privilege of the administrator to view logs is very useful for the administrator for him/her to see what does the previous administrator who logged-in did in the system.</li>
			<li>This separate page visible only for the administrator contains username of the administrators, his/her tasks done for a specific duration of time he/she is logged-in, and when did he/she did the tasks.</li>
			<li> This page is for viewing only. There is no capability to delete or edit tasks done.</li>
			
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="add_book"></a>
		<span>Add Books</span>
		<ul>
			<li>The privilege of the administrator to add new books increase the interests of the users to borrow since the list of books is expanding. </li>
			<li> The administrator needs to fill up necessary information about the book. It will not let the administrator submit it unless all the values entered are correct and all required fields have filled in. </li>
			
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="update"></a>
		<span>Update Book Information </span>
		<ul> 
			<li>The privilege of the administrator to update information about the book is necessary in the development and usage of the system for the maintenance of evolution of the books available.</li>
			<li>Every book has a corresponding button for edit function. </li>
			<li>Upon clicking the update button, all previous details will be shown up and it is up to the administrator what details to edit. Validation of field will also be observed. A pop-up message will appear to show assurance of saving all changes he/she made. After this, all data entered will be automatically saved in the database.</li>
			
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="delete"></a>
		<span>Delete Book</span>
		<ul> 
			<li>The privilege of the administrator to delete book is necessary when the book is already obsolete or if a book in the library already has no copy available.</li>
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
				<ul>
					<li>Shows the list of books currently in the possession of the user.</li>
					<li>Shows the details of the transaction and the details of the book.</li>
				</ul>
			</li>
			<a name="overdueBooks"></a>
			<li><span>List of Overdue Books</span>
				<ul>
					<li>Shows the list of books not yet returned by the user and is already reached the due date.</li>
					<li>Shows the details of the transaction and the details of the book.</li>
				</ul>
			</li>

			<a name="outgoingBooks"></a>
			<li><span>List of Outgoing Books</span>
				<ul>
					<li>Shows the list of books reserved by the user.</li>
					<li>Shows the details of the transaction and the details of the book.</li>
				</ul>
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		</div>
			<div id="dialogboxfoot">© 2013 ICS UPLB</div>
			
		</div>
	</div>
	</body>
</html>