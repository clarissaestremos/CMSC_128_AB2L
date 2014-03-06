<!DOCTYPE html>

<html>
	<?php
  		 if($this->session->userdata('logged_in_type')!="admin")
            				redirect('index.php/user/controller_login', 'refresh');
    ?>
	<head>
		<title>Admin Page</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>style/admin/build-full.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>style/admin/admin-style.css" media="all"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery-ui.css">
		<link rel="icon" href="<?php echo base_url();?>images/ics_icon.png"/>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/edit.css" media="all"/>
		<script src="<?php echo base_url() ?>js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo  base_url() ?>js/jquery-ui.js"></script>
		<script>
			$(document).ready(function(){
				$heightbody = $("#thisbody").css("height");
				$heightaside = $("aside").css("height");
				console.log($heightbody);
				console.log($heightaside);
				if($heightbody > $heightaside){
					console.log("enter");
					$("#side-navigation").css("height",$heightbody);
				}
			});

			base_url= "<?php echo base_url() ?>";
		</script>
		<style type="text/css">
			.itemhover { background-color:black !important; color:#ffffff !important; width: 500px !important;}
			#selectItems ul { width:500px; font-size:14px; line-height:28px; list-style:none;}
			#selectItems ul li { }
			#selectItems ul li a { display:block; color:black; text-decoration:none; padding:0; }
			#sorry{text-align: center; padding: 10px;}
		</style>
	</head>


	<body>
		<div class="body main-content">
			<header id="main-header" class="site-header background-">
				<div id="first-header" class="col width-1of4 shadow-right">
					<img id="logo" src="<?php echo base_url() ?>images/icslogo.png"/>
					<div class="cell">
						
						<h1 class="title">ICS e-Lib</h1>
					</div>
				</div>
				<div class="col width-fill centered-content">
						<div class="col width-3of4">
						<h1 id="current-page" class="title col">Admin Portal</h1>
						</div>
				</div>
			</header>
			<header id="secondary-head" class="grad">
				<div  class="col width-1of4 shadow-right secondary-header border-bottom">
					<div class="col">
						<img id="icon-user" src="<?php echo base_url() ?>images/icn_user.png"/>
						<p id="user-name">
							<?php  
								$session_data = $this->session->userdata('logged_in');
            					 echo $session_data['fname']." ".$session_data['mname'].". ".$session_data['lname'];
            					?>
					(<a href="<?php echo base_url() ?>index.php/admin/controller_logout">Logout</a>)
					<a href="<?php echo base_url() ?>index.php/admin/controller_adminmanual" class="tiny float-right" style="margin-top:1.5em;" target="_blank">Admin Manual</a></p>
					</div>
				</div>
				<div class="col width-fill border-bottom secondary-header shadow-bottom">
					<div id="breadcrumbs" class="width-fit">
						<div class="crumbs">
							Admin Portal
						</div>
						<div class="divide">
							
						</div>
						<div class="crumbs">
							<?php echo $parent ?>
						</div>
						<div class="crumbs divide">
						</div>
						<div class="crumbs">
							<?php echo $current ?>
						</div>
					</div>
				</div>
			</header>