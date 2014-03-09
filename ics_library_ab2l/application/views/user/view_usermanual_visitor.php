<!DOCTYPE html>
<html>
	<head>
		<title>User Manual</title>
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
	top: 0px;
	left: 0px;
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
	background:url('../../../images/bgmanual.jpg');
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
			<div id="dialogboxhead">USER MANUAL</div>
			<div id="dialogboxbody">
		<a name="top"></a>
		<h2>Features</h2>
		<a href="<?php echo base_url(); ?>" class="tiny">Back to Home</a>	<!-- Cla, palagay na lang nung link :D -->
		<hr width="450px;"><br/>
		<span>Table of Contents</span>
		<ul>
			<li><a href="#overview">Overview</a></li>
			<li><a href="#search">Search</a></li>
				<ul>
					<li><a href="#basicSearch">Basic Search</a></li>
					<li><a href="#advancedSearch">Advanced Search</a></li>
				</ul>
			<li><a href="#viewBooks">View Books</a></li>
			<li><a href="#bookStat">Book Statistics</a></li>
			<li><a href="#faqs">FAQs</a></li>
			<li><a href="#contact">Contact Us</a></li>
			<li><a href="#login">Login</a></li>
			<li><a href="#signUp">Sign Up</a></li>
			<li><a href="#announcements">News and Updates</a></li>
		</ul>	


		<br/><hr width="450px;"><br/>
		<a name="overview"></a>
		<span>Overview</span>
		<ul>
			<li>This is the UPLB Institute of Computer Science e-Library System. This allows UPLB <br>constituents
			 to do library transactions online. Created by CMSC 128 AB-2L A.Y. 2013-2014.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="search"></a>
		<span>Search</span>
		<a name="basicSearch"></a>
			<li><span>Basic Search</span>
				<ul>
					<li>Allows the user to search for a book by providing information on any of its fields.</li>
					<li>Shows the detailed list of books matching the specified query</li>
				</ul>
			</li>
			<a name="advancedSearch"></a>
			<li><span>Advanced Search</span>
				<ul>
					<li>A more specific search capability which allows users to specify more than one field.</li>
					<li>Shows the detailed list of books matching the specified query.</li>
				</ul>
			</li>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="viewBooks"></a>
		<span>View Books</span>
		<ul>
			<li>Displays the list of all books present in the ICS Library.</li>
			<li>Allows user to see the books' details and their current availability in the library.</li>
			<li>Allows the user to reserve a book displayed on the list.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="bookStat"></a>
		<span>Book Statistics</span>
		<ul>
			<li>Displays in a chart the top 10 most borrowed books.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="faqs"></a>
		<span>Frequently Asked Questions (FAQs)</span>
		<ul>
			<li>Shows answers or solutions to questions frequently asked by the users about the system.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="contact"></a>
		<span>Contact Us</span>
		<ul>
			<li>Shows the location of ICS Library on the map.</li>
			<li>Shows the contact information of the ICS Library.</li>
			<li>Allows the user to provide feedback, raise questions or give suggestions about the system.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="login"></a>
		<span>Login</span>
		<ul>
			<li>Establishes the user's identity which gives him a higher privilege that allows him <br>to do certain operations.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="signUp"></a>
		<span>Sign Up</span>
		<ul>
			<li>Allows an anonymous user to register an account in order to gain access to privileged <br>transactions such as reserving a book.</li>
			<li>In signing up for an account, the user must fill up the registration form.</li>
			<li>Account registration can also be done through the ICS librarian.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="announcements"></a>
		<span>News and Updates</span>
		<ul>
			<li>Displays the latest news and announcements posted by the administrator.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		</div>
			<div id="dialogboxfoot">© 2013 ICS UPLB</div>
			
		</div>
	</div>
	</body>
</html>