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

li{
	list-style:none;
}
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
			<li><a href="#bookReserve">Book Reservation</a></li>
			<li><a href="#faqs">FAQs</a></li>
			<li><a href="#contact">Contact Us</a></li>
			<li><a href="#borrowedBooks">Record of Borrowed Books</a>
				<ul>
					<li><a href="#borBooks">List of Borrowed Books</a></li>
					<li><a href="#retBooks">List of Returned Books</a></li>
				</ul>
			</li>
			<li><a href="#logout">Logout</a></li>
		</ul>			

		<br/><hr width="450px;"><br/>

		<a name="overview"></a>
		<span>Overview</span>
		<ul>
			<li>This is the UPLB Institute of Computer Science e-Library System. This allows UPLB <br/>constituents
			 to do library transactions online. <br/>Created by the <strong>CMSC 128 class AB-2L A.Y. 2013-2014.</strong></li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="search"></a>
		<span>Search</span>
		<a name="basicSearch"></a>
			<li><span>Basic Search</span>
				<ul>
					<li>Allows the user to search for a book by providing information on any of its fields.</li>
					<li>It will show the detailed list of books matching the specified query</li>
					<li><br/>
						<img src="<?php echo base_url();?>/images/usermanual/basicSearch.jpg" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>As you can see on the image above, you can use <strong>Basic Search</strong> by the book's </br><strong>TITLE, AUTHOR, SUBJECT, PUBLICATION,</strong> or <strong>TAG/s.</strong></li>
						</ul>
					</li><br/>
					<li>You can also use the <strong>Basic Search</strong> anywhere in within the site.<br/><br/>
						<img src="<?php echo base_url();?>/images/usermanual/basicSearch1.jpg" /><br/><br/><br/>
						<ul>
							<li>Located in the upper right of the site</li>
						</ul>
					</li>
				</ul>
			</li>
			<a name="advancedSearch"></a>
			<li><span>Advanced Search</span>
				<ul>
					<li>A more specific search capability which allows users to specify more than one field.</li>
					<li>Shows the detailed list of books matching the specified query.</li>
					<li><br/>
						<img src="<?php echo base_url();?>/images/usermanual/advSearch.jpg" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>To use the Advanced Search, you can fill out portions of the form above containing </br>the book's <strong>TITLE, AUTHOR, SUBJECT, PUBLICATION,</strong> or <strong>TAG/s.</strong></li>
						</ul>
					</li>
				</ul>
			</li>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="viewBooks"></a>
		<span>Overview</span>
		<ul>
			<li>This is the UPLB Institute of Computer Science e-Library System. This allows UPLB <br/>constituents
			 to do library transactions online. <br/>Created by the <strong>CMSC 128 class AB-2L A.Y. 2013-2014.</strong></li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="search"></a>
		<span>Search</span>
		<a name="basicSearch"></a>
			<li><span>Basic Search</span>
				<ul>
					<li>Allows the user to search for a book by providing information on any of its fields.</li>
					<li>It will show the detailed list of books matching the specified query</li>
					<li><br/>
						<img src="<?php echo base_url();?>/images/usermanual/basicSearch.jpg" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>As you can see on the image above, you can use <strong>Basic Search</strong> by the book's </br><strong>TITLE, AUTHOR, SUBJECT, PUBLICATION,</strong> or <strong>TAG/s.</strong></li>
						</ul>
					</li><br/>
					<li>You can also use the <strong>Basic Search</strong> anywhere in within the site.<br/><br/>
						<img src="<?php echo base_url();?>/images/usermanual/basicSearch1.jpg" /><br/><br/><br/>
						<ul>
							<li>Located in the upper right of the site</li>
						</ul>
					</li>
				</ul>
			</li>
			<a name="advancedSearch"></a>
			<li><span>Advanced Search</span>
				<ul>
					<li>A more specific search capability which allows users to specify more than one field.</li>
					<li>Shows the detailed list of books matching the specified query.</li>
					<li><br/>
						<img src="<?php echo base_url();?>/images/usermanual/advSearch.jpg" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>To use the Advanced Search, you can fill out portions of the form above containing </br>the book's <strong>TITLE, AUTHOR, SUBJECT, PUBLICATION,</strong> or <strong>TAG/s.</strong></li>
						</ul>
					</li>
				</ul>
			</li>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		<a name="faqs"></a>
		<span>Frequently Asked Questions (FAQs)</span>
		<ul>
			<li><strong>Frequently Asked Questions (FAQs)</strong> is found in with the navigation.<br/><br/>
				<img src="<?php echo base_url();?>/images/usermanual/faqs1.png" /><br/><br/><br/><br/>
				<ul>
					<li><strong>FAQs</strong> shows the answers or solutions to questions frequently asked by the users about the system.</li>
					<br/>
					<li>
						<img src="<?php echo base_url();?>/images/usermanual/faqs.png" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>Find your problem, click on it and get your answer or solution.</li>
							<li>If you can't find it there, might want to ask our <strong>ICS Librarian.</strong></li>
							
						</ul>
					</li>
				</ul>
			</li>
			
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		<a name="contact"></a>
		<span>Contact Us</span>
		<ul>
			<li>Shows the location of ICS Library on the map.
				<ul>
					<li>Note: you will need an internet connection for this.</li>
				</ul>
			</li><br/>
			<li>Included are the contact information of the ICS Library.<br/><br/>
				<img src="<?php echo base_url();?>/images/usermanual/contact2.png" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</li><br/>
			<li>You can get in touch with us through <strong>EMAIL.</strong> by simply <strong><br/>filling out the form.<br/>
				<img src="<?php echo base_url();?>/images/usermanual/contact1.png" /><br/><br/><br/><br/><br/><br/><br/><br/>
				
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		<a name="borrowedBooks"></a>
		<span>Record of Borrowed Books</span><br />
		<ul>
			<a name="borBooks"></a>
			<li>
				<img src="<?php echo base_url();?>/images/usermanual/borrowed.png" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			</li>
			<li><span>List of Borrowed Books</span>
				<ul>
					<li>
						<img src="<?php echo base_url();?>/images/usermanual/borrowed1.png" /><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>Shown is the list of books which are currently in your, the user's, possession.</li>
							<li>Shows the details of the transaction(s) and the details of the book.</li>
							<li>Also, shows the <strong>DUE DATE</strong> of the book.</li>
							<ul>
								<li>Note: Remember the <strong>DUE DATE</strong> of the book borrowed.</li>
							</ul>
						</ul>
					</li>
				</ul>
			</li><br />
			<a name="retBooks"></a>
			<li><span>List of Returned Books</span><br/><br/>
				<ul>
					<li>
						<img src="<?php echo base_url();?>/images/usermanual/reserved1.png" /><br/><br/><br/><br/><br/><br/>
						<ul>
							<li>Shown is the list of books previously borrowed by you, the user.</li>
							<li>The table shows the details of the transaction(s) and the details of the book.</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>


		<a name="logout"></a>
		<span>Logout</span>
		<ul>
			<li>Two ways to <strong>LOGOUT</strong>.</li>
			<ul>
				<li> One. By clicking the '<strong>Logout</strong>' link on the upper left corner of the login screen, beside 
				the user's name.<br /><br/>
					<ul>
						<li><img src="<?php echo base_url();?>/images/usermanual/logout1.png" /></li><br/><br/><br/>
					</ul>
				</li>
				<li> Two. By going through the account menu and selecting the <strong>logout</strong>.<br /><br/>
					<ul>
						<li><img src="<?php echo base_url();?>/images/usermanual/logout.png" /></li><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					</ul>
				</li>
			</ul>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		</div>
			<div id="dialogboxfoot">© 2013 ICS UPLB</div>
			
		</div>
	</div></body>
</html>