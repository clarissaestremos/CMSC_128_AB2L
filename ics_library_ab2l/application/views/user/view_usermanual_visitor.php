<!DOCTYPE html>
<html>
	<head>

		<title>User Manual</title>
		<!-- Include other css and javascript files -->
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/build-full.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/main-template.css" media="all"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery-ui.css"><!--source: http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css-->
  		<link rel="stylesheet" href="<?php echo base_url(); ?>style/user/slider.css" type="text/css" media="screen" />
  		<link rel="stylesheet" href="<?php echo base_url(); ?>default/default.css" type="text/css" media="screen" />
  		<link rel="icon" href="<?php echo base_url(); ?>images/ics_icon.png"/>
  		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/edit.css" media="all"/>
		
		<!-- CSS modification for the user manual -->
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

		li{
			text-decoration:none;
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

	/*Start of Body */
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
		<span>View Books</span>
		<ul>
			<li><strong>View Books</strong> displays the list of all books present in the ICS Library.</li>
			<li>As a user, the books' details and their current availability in the library is displayed.</li>
			<li>Will, also, allow the user to reserve a book displayed on the list.</li>
			<li><br/>
				<img src="<?php echo base_url();?>/images/usermanual/viewBooks1.png" /><br/><br/><br/><br/>
				<ul>
					<li>You will be seeing a table like this. Which contains the book's <br/>International Standard Book Number <strong>(ISBN)</strong>,
						<strong>TITLE</strong>, <strong>SUBJECT</strong>, and <strong>AVAILABILITY</strong>.</li>
				</ul>
			</li>
			<li>These images determines what type the material is.<br/>
				<img src="<?php echo base_url();?>/images/usermanual/type_book.png" height="100px" width="100px"/><br/><br/><br/><br/><br/><br/>
					<ul>
						<li>This is for a <strong>BOOK</strong>.</li>
					</ul>	<br/>
				<img src="<?php echo base_url();?>/images/usermanual/type_thesis.png" height="100px" width="100px" /><br/><br/><br/><br/><br/><br/>
					<ul>
						<li>This is for a <strong>THESIS</strong> or a <strong>SPECIAL PROBLEM (SP)</strong>.</li>
					</ul>
			</li><br/>
			<li>You will be seeing this above the table of books.<br/>
				<img src="<?php echo base_url();?>/images/usermanual/viewBooks2.png" /><br/><br/><br/><br/>
				<ul>
					<li>With this you can sort the books by either it's <strong>TITLE, SUBJECT, AUTHOR, TYPE,</strong> or<strong> AVAILABILITY</strong><br/> in <strong>ascending</strong> or <strong>descending</strong> order with this.</li>
				</ul>
			</li>

		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="bookStat"></a>
		<span>Book Statistics</span>
		<ul>
			<li><strong>Book Statistics</strong> is found in with the navigation.<br/>
				<img src="<?php echo base_url();?>/images/usermanual/stat.png" /><br/><br/><br/><br/>
				<ul>
					<li>Clicking on <strong>Book Statistics</strong> displays a pie chart of the<br/> <strong><b>TOP 10 MOST BORROWED BOOKS</b></strong> in <strong>ICS</strong>.</li>
				</ul>
			</li>
			
			
		</ul>
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

		<a name="login"></a>
		<span>Login</span>
		<ul>
			<li>Two ways to login:</li>
			<ul>
				<li> ONE, is to login through the <strong>LOG IN</strong> form<br/><br/>
					<ul>
						<li><img src="<?php echo base_url();?>/images/usermanual/login1.png" /></li>
					</ul>
				</li><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<li> TWO, is to login via the <strong>LOG IN</strong> form located above the site.<br /><br/>
					<ul>
						<li><img src="<?php echo base_url();?>/images/usermanual/login.png" /></li>
					</ul>
				</li>
			</ul>
			<br/><br/><br/><br/><br/>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="signUp"></a>
		<span>Sign Up</span>
		<ul>
			<li>Account registration can also be done through the ICS librarian.</li>
			<li>Located at the bottom of the LOG IN form on the upper right of the site.<br/><br/>
				<li><img src="<?php echo base_url();?>/images/usermanual/login.png" /></li>
			</li><br/><br/><br/><br/>
			<li>Fill out the form. The one marked with an asterisk (<strong>*</strong>) is required.
				<ul>
					<li>Step1: Complete your name.<br/><br/>
						<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup1.jpg" /></li></ul>
					</li><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<li>Step2: Select if you're a <strong>student</strong> or a <strong>faculty</strong>.<br/><br/>
						<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup2.jpg" /></li></ul>
					</li><br/><br/><br/><br/><br/><br/><br/>
					<li>Step3: 
						<ul>
							<li>If you're a <strong>student</strong> enter a valid student number. Your student number.<br/><br/>
								<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup3.jpg" /></li></ul>
							</li> 	<br/><br/><br/>
							<li>If you're a <strong>faculty</strong> enter a valid employee number. Your employee number.<br/><br/>
								<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup4.jpg" /></li></ul>
							</li>
						</ul>
					</li><br/><br/><br/><br/>
					<li>Step4: Select your College.<br/><br/>
						<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup5.jpg" /></li></ul>
					</li><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<li>Step5: If you're a <strong>student</strong>, select your course.<br/><br/>
						<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup6.jpg" /></li></ul>
					</li><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<li>Step6: Enter a valid <strong>EMAIL Address</strong>. Your <strong>EMAIL Address</strong><br/><br/>
						<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup7.jpg" /></li></ul>
					</li><br/><br/><br/><br/>
					<li>Step7: Enter a valid <strong>USERNAME</strong> and a strong<strong> PASSWORD</strong><br/><br/>
						<ul><li><img src="<?php echo base_url();?>/images/usermanual/signup8.jpg" /></li></ul>
					</li><br/><br/><br/><br/><br/><br/><br/>
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>

		<a name="announcements"></a>
		<span>News and Updates</span>
		<ul>
			<li>Displays the latest news and announcements posted by the administrator.<br/><br/>
				<ul><li><img src="<?php echo base_url();?>/images/usermanual/news.jpg" /><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></li></ul>
			</li>
		</ul><br/><br/><br/><br/>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr width="450px;"><br/>
		
		</div>
			<div id="dialogboxfoot">© 2013 ICS UPLB</div>
		</div>
	</div>
	</body>
</html>