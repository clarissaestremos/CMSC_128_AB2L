<!DOCTYPE html>

<html>
	<head>
		<title><?php echo $titlepage?></title>
		<!--The full build of all the generic classes of the framework(Framework itself)-->
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/build-full.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/main-template.css" media="all"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery-ui.css"><!--source: http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css-->
  		<link rel="stylesheet" href="<?php echo base_url(); ?>style/user/slider.css" type="text/css" media="screen" />
  		<link rel="stylesheet" href="<?php echo base_url(); ?>default/default.css" type="text/css" media="screen" />
  		<link rel="icon" href="<?php echo base_url(); ?>images/ics_icon.png"/>
  		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/edit.css" media="all"/>
  		<script src="<?php echo  base_url() ?>js/module/jquery/jquery-2.0.3.min.js"></script>
  		<script src="<?php echo  base_url() ?>js/jquery-ui.js"></script>
  		<script src="<?php echo  base_url() ?>js/main.js"></script>
  		<meta name="viewport" content="width=device-width"/>
  		<style type="text/css">
  			.grad{
				background: rgb(255,255,255); /* Old browsers */
				background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(229,229,229,1) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(229,229,229,1))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%); /* IE10+ */
				background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(229,229,229,1) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */
			}
			#main-body{
				background-image:url('<?php echo base_url();?>images/g.jpg'); 
				background-size: 200px 130px;
				background-position: 100% 100%; 
				background-repeat:no-repeat;
			}
		</style>
  		<?php
  		 if($this->session->userdata('logged_in_type')=='admin')
            				redirect('index.php/admin/controller_announcement', 'refresh');
          ?>
          <script type="text/javascript">var base_url= "<?php echo  base_url() ?>"</script>
  		<meta charset="utf-8"/>
	</head>
	<body>
		<div class="width-fill" style="background-image:url('<?php echo base_url();?>images/g.jpg'); background-position: 100% 100%; background-repeat:no-repeat; background-size: cover;">			<div class="site-header background-red">
				<div class="site-center">
					<div class="cell width-1of2 float-left">
						<img src="<?php echo base_url();?>/images/try.png"/>
					</div>
					<div class="width-fit float-right">
						<div style="padding: 3px 3px 5px 3px;" class="color-black" >
							<?php
								if(!$this->session->userdata('logged_in')){
							?>
							<form action='<?php echo base_url(); ?>index.php/user/controller_verify_login' method="POST">
								<input type="text" placeholder="Username" name="username" required="required" class="login float-left background-white"/>
								<input type="password" placeholder="Password" name="password" required="required" class="login float-left background-white"/>
								<input type="submit" value="Submit" class="login float-left" style="background: #656565; color:white;"/>
								<br/>
								<a href="<?php echo base_url(); ?>index.php/user/controller_register" class="float-right color-white">Not yet a member? Register Here!</a></p>
							</form>
							<?php
								}
								else{
							?>
							<p style="background-image:url('<?php echo base_url();?>images/icn_user.png'); text-indent: 1.5em; background-size: contain; background-position: 0% 0%; background-repeat: no-repeat"><?php
								$session_data = $this->session->userdata('logged_in');
            					 echo $session_data['fname']." ".$session_data['mname'].". ".$session_data['lname'];
							?>
							(<a href='<?php echo base_url(); ?>index.php/user/controller_editprofile'>Edit Profile</a>) | <a href='<?php echo base_url(); ?>index.php/user/controller_book/user_borrowed_list'>Borrowed Books</a> | <a href='<?php echo base_url(); ?>index.php/user/controller_book/user_reserved_list'>Reserved Books</a> | <a href='<?php echo base_url(); ?>index.php/user/controller_logout'>Logout</a>
							</p>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="site-header" id="sticker" style="background-image:url('<?php echo base_url();?>images/navigation.png'); box-shadow: 2px 2px 10px -2px #000000;z-index: 5;">
					<div id="navigation" class="width-6of8 center">
						<ul>
							<a  href="<?php echo base_url(); ?>"><li <?php if($titlepage === "ICS Library Home") echo 'id="active"'?> >Home</li></a>
							<a href="<?php echo base_url(); ?>index.php/user/controller_books"><li <?php if($titlepage === "View all books") echo 'id="active"'?>>View Books</li></a>
							<a href="<?php echo base_url(); ?>index.php/user/controller_search_book"><li <?php if($titlepage === "Books - Search") echo 'id="active"'?>>Search</li></a>
							<a href="<?php echo base_url(); ?>index.php/user/controller_faq"><li <?php if($titlepage === "Frequently Asked Questions") echo 'id="active"'?>>FAQs</li></a>
							<a href="<?php echo base_url(); ?>index.php/user/controller_contact"><li <?php if($titlepage === "Contact Us") echo 'id="active"'?>>Contacts</li></a>
							<a href="<?php echo base_url(); ?>index.php/user/controller_stat"><li <?php if($titlepage === "Book Statistics") echo 'id="active"'?>>Statistics</li></a>
							<?php
								if(!$this->session->userdata('logged_in')){
							?>
								<a href="<?php echo base_url(); ?>index.php/user/controller_login"><li <?php if($titlepage === "Login") echo 'id="active"'?>>Login</li></a>
							<?php
								}
								else{
							?>
								<a href="#" id="myaccount"><li>My Account
									<ul class="">
										<a href=""><li>View Profile</li></a>
										<a href=""><li>Reserved Books</li></a>
										<a href=""><li>Borrowed Books</li></a>
										<a href=""><li>Logout</li></a>
									</ul>
								</li>
								</a>
								
								
							<?php
								}
							?>
						</ul>
					</div>
			</div>
<script>
	$(document).ready(function() {
    var s = $("#sticker");
    var pos = s.position();                    
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos.top) {
            s.css("position","fixed");
            s.css("top","0");
            s.css("z-index","100");
        } else {
            s.css("position","relative");
        }
    });
});
</script>