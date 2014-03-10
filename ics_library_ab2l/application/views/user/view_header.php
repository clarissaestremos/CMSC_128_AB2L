<!DOCTYPE html>
<script src="<?php echo  base_url() ?>js/module/jquery/global.js" type="text/javascript"></script>

<script type = "text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
<?php
if($this->session->userdata('logged_in_type')=='admin')
                    redirect('index.php/admin/controller_admin_home', 'refresh');
          ?>
<html>
	<head>
		<title><?php echo $titlepage?></title>
		<!--The full build of all the generic classes of the framework(Framework itself)-->
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/build-full.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/main-template.css" media="all"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery-ui.css"><!--source: http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/bootstrap.css"/>
  		<link rel="stylesheet" href="<?php echo base_url(); ?>style/user/slider.css" type="text/css" media="screen" />
  		<link rel="stylesheet" href="<?php echo base_url(); ?>default/default.css" type="text/css" media="screen" />
  		<link rel="icon" href="<?php echo base_url(); ?>images/ics_icon.png"/>

  	<!-- Source:	http://isabelcastillo.com/error-info-messages-css -->
  		<link rel="stylesheet" href="<?php echo base_url(); ?>style/user/custom-style.css" type="text/css"  />

  		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/edit.css" media="all"/>
  		<script src="<?php echo  base_url() ?>js/jquery-1.10.2.min.js"></script>
      <script src="<?php echo  base_url() ?>js/bootstrap.js"></script>
  		<script src="<?php echo  base_url() ?>js/jquery-ui.js"></script>
  		<script src="<?php echo  base_url() ?>js/main.js"></script>
  		<meta name="viewport" content="width=device-width"/>
  		<style type="text/css">
  			body,html{
  				height: 100%;
          overflow-x: hidden;
  			}
			#main-body{
				background-image:url('<?php echo base_url();?>images/g.jpg'); 
				background-size: 200px 130px;
				background-position: 100% 100%; 
				background-repeat:no-repeat;
				min-height: 74vh;
			}
			.search_button{
				background-image: url('<?php echo base_url(); ?>images/icn_search.png');
				background-size: 100% 100%;
				background-repeat: no-repeat;
				width: 2em;
			}
			.clear-right{
				clear: right;
			}
      #DAPPlugin{
        display:none;
      }
      #account-collapse{
        line-height:20px;
        border-bottom-style:none;
      }
		
      .itemhover { background-color:#d3d3d3 !important; color:black !important;}
			#selectItems ul { width:500px; font-size:14px; line-height:28px; list-style:none;}
			#selectItems ul li { }
			#selectItems ul li a { display:block; color:black; text-decoration:none; padding:0; }
      #category {width: 100px;}
      #sinput{width: 200px;}
      #autosuggest_list{ padding: 50px 0px 0px 0px;}
	  .howver:hover{background-color:#d3d3d3 !important; color:black !important;}
		</style>
  		<?php
  		 if($this->session->userdata('logged_in_type')=='admin')
            				redirect('index.php/admin/controller_home', 'refresh');
          ?>
          <script type="text/javascript">


          var base_url= "<?php echo  base_url() ?>"</script>
  		<meta charset="utf-8"/>
	</head>
	<body>
		<div class="width-fill" style="height:100vh;">			
			<div class="site-header background-red">
				<div class="site-center">
					<div class="cell width-1of2 float-left">
						<img src="<?php echo base_url();?>/images/try.png"/>
					</div>
					<div class="width-fit float-right">
						<div style="padding: 3px 3px 5px 3px;" class="color-black" >
							<?php if($titlepage !== "Admin Key" AND $titlepage !== "Login Page")
								{
							?>
							<?php
								if(!$this->session->userdata('logged_in') ){
							?>
							<div class="collapse navbar-collapse menu login float-right" id="account-collapse">
                <form action='<?php echo base_url(); ?>index.php/user/controller_verify_login' method="POST">
                  <input type="text" placeholder="Username" name="username" required="required" class="background-white float-left" style='margin: 2px 2px 2px 2px;'/>
                  <input type="password" placeholder="Password" name="password" required="required" class="background-white float-left" style='margin: 2px 2px 2px 2px;'/>
                  <input type="submit" value="Login" class=" float-left" style="background: #656565; color:white; margin: 2px 3px 3px 3px;"/>
                  <br/>
                  <a href="<?php echo base_url(); ?>index.php/user/controller_register" class="float-left" style="color:white;">Not yet a member? Register Here!</a></p>
                  
                </form>
              </div>
							<?php
								}
							
								else if($this->session->userdata('logged_in') ){
							?>
							<div class="collapse navbar-collapse menu login float-right" id="account-collapse">
                  <img src= "<?php echo base_url();?>images/icn_user.png" style="height: 23px;"/>
                  <p class='float-left' style="color:white; background-size: contain; background-position: 0% 0%; background-repeat: no-repeat;"><?php
                    $session_data = $this->session->userdata('logged_in');
                     echo $session_data['fname']." ".$session_data['mname'].". ".$session_data['lname'];
              ?>
                  <a class="btn btn-danger" href='<?php echo base_url(); ?>index.php/user/controller_logout'>Logout</a>
                  </p>
                </div>
							<?php
								}
							}
							?>
						</div>
            <?php 
              if($titlepage !== "Books - Search")
              {

            ?>
            <div class="collapse navbar-collapse menu login float-right color-black" id="account-collapse" style ="padding: 3px 3px 5px 3px;">
                <form name="headerSearch" method="post" action='<?php echo base_url(); ?>index.php/user/controller_search_book' method="POST">
                  <select id="category" name="category">
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="subject">Subject</option>
                    <option value="year_of_pub">Publication</option>
                    <option value="tag_name">Tag</option>
                  </select>
                  <input type="search" required="required" placeholder="Search..." class="background-white" id="sinput" name="hinput"/>
                  <input type="submit" value="Search" id="headerSearch"/> 
                  <!--<div class="autosuggest" id="autosuggest_list">-->
                </form>
            </div>
            <?php }?>
					</div>
					
				</div>
			</div>
			<nav id="headnav" class="navbar-default" role="navigation" style="background-image:url('<?php echo base_url();?>images/navigation.png'); box-shadow: 2px 2px 10px -2px #000000;z-index: 5;">
        <div class="container-fluid center" id="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand color-white" href="<?php echo base_url();?>">
            <?php if($titlepage === "ICS Library Home") echo "<span class='glyphicon glyphicon-home'></span>";
              if($titlepage === "View all books") echo "<span class='glyphicon glyphicon-book'></span>";
              if($titlepage === "Books - Search") echo "<span class='glyphicon glyphicon-search'></span>";
              if($titlepage === "Frequently Asked Questions") echo "<span class='glyphicon glyphicon-list'></span>";
              if($titlepage === "Book Statistics") echo "<span class='glyphicon glyphicon-stats'></span>";
            ?>            
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse menu" id="menu-collapse">
          <ul class="nav navbar-nav">
          <?php if($titlepage === "ICS Library Home"){ echo ' <li id="active">'; }else{ echo '<li class="hov">'; }?><a class="color-white" href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
          <?php if($titlepage === "View all books"){ echo ' <li id="active">'; }else{ echo '<li class="hov">'; }?><a class="color-white" href="<?php echo base_url(); ?>index.php/user/controller_books"><span class="glyphicon glyphicon-book"></span>  View Books</a></li>
          <?php if($titlepage === "Books - Search"){ echo ' <li id="active">'; }else{ echo '<li class="hov">'; }?><a class="color-white" href="<?php echo base_url(); ?>index.php/user/controller_search_book"><span class="glyphicon glyphicon-search"></span>  Search</a></li>
          <?php if($titlepage === "Frequently Asked Questions") { echo ' <li id="active">'; }else{ echo '<li class="hov">'; }?><a class="color-white" href="<?php echo base_url(); ?>index.php/user/controller_faq"><span class="glyphicon glyphicon-list"></span>  FAQs</a></li>
          <?php if($titlepage === "Contact Us") { echo ' <li id="active">'; }else{ echo '<li class="hov">'; }?><a class="color-white" href="<?php echo base_url(); ?>index.php/user/controller_contact"><span class="glyphicon glyphicon-map-marker"></span>  Contacts</a></li>
          <?php if($titlepage === "Book Statistics") { echo ' <li id="active">'; }else{ echo '<li class="hov">'; }?><a class="color-white" href="<?php echo base_url(); ?>index.php/user/controller_stat"><span class="glyphicon glyphicon-stats"></span>  Statistics</a></li>
          <li class="divider"></li>
          <?php
            if(!$this->session->userdata('logged_in')){
          ?>
            <?php if($titlepage === "Login") { echo ' <li id="active">'; }else{ echo '<li>'; }?><a class="color-white" href="<?php echo base_url(); ?>index.php/user/controller_login">Login</a></li>
          <?php
              
            }
            else{
          ?>
            
            <li class="dropdown">
              <a class="color-white" id="accountanchor"  data-toggle="dropdown" href="#">
                <span class="glyphicon glyphicon-pencil"></span>My Account <span class="caret"></span>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li><a href="<?php echo base_url(); ?>index.php/user/controller_editprofile"><span class="glyphicon glyphicon-user"></span>View Profile</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/user/controller_book/user_reserved_list"><span class="glyphicon glyphicon-book"></span>Reserved Books</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/user/controller_book/user_borrowed_list"><span class="glyphicon glyphicon-tags"></span>Borrowed Books</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/user/controller_logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                </ul>
              </div>
            </li>
            
          <?php
            }
          ?>

          </ul>
        </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
<script>
	$(document).ready(function() {
	/**
		Fixation of the navigation on the top
	*/
    var s = $("#headnav");
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
    /*
		*Dialog for cancellation of reserved books.
    */
    $( "#canceldialog" ).dialog({
      autoOpen: false,
      modal: true,
      closeOnEscape: true,
      closeText: true,
      show: {
        effect: "fadeIn",
        duration: 500
      },
      hide: {
        effect: "fadeOut",
        duration: 500
      },
      draggable: false,
      buttons : {
      	"Yes": function() {
      		$(this).dialog('close');
      		$('#cancelsuccess').dialog('open');
      	},
      	"No": function() {
      		$(this).dialog('close');
      	}
      }
    });

    $("#cancelsuccess").dialog({
		autoOpen: false,
      	modal: true,
      	closeOnEscape: true,
      	closeText: 'show',
      	show: {
       	 	effect: "fadeIn",
        	duration: 200
      	},
      	draggable: false,
      	close: function(event, ui){
      		document.getElementById(form).submit();
      	},
      	buttons : {
        	"Ok": function() {
            	document.getElementById(form).submit();
        	},
      	}

    });
    /*
		*Dialog for reservation of books
    */
    $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
      closeOnEscape: true,
      closeText: true,
      show: {
        effect: "fadeIn",
        duration: 500
      },
      hide: {
        effect: "fadeOut",
        duration: 500
      },
      draggable: false,
      buttons : {
      	"Yes": function() {
      		$(this).dialog('close');
      		window.location.replace(link);
      	},
      	"No": function() {
      		$(this).dialog('close');
      	}
      }
    });

    /*
		*Dialog for the success of the reservation of books
    */
     /*
		Trigger for the cancellation of reserved books
     */
     $( "form[id^='cancel']" ).submit(function (e) {
    	e.preventDefault();
    	form = $(this).get(0).id;
      $( "#canceldialog" ).dialog( "open" );
    });

     /*
		Trigger for the confirmation of the reservation of books
     */
    $( "#confirmButton" ).click(function (e) {
    	e.preventDefault();
    	 link = $(this).attr('href');
      $( "#dialog" ).dialog( "open" );
    });
});
	var form;
	var link;
</script>

<script>
</script>