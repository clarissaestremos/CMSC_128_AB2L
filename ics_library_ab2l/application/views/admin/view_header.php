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
            					 echo $session_data['fname']." ".$session_data['mname']." ".$session_data['lname'];
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
<script>
	$(document).ready(function() {
		$('#tabs').tabs();
		/**
			*Announcements Deletes
		*/
		$("#deleteconfirm").dialog({
        autoOpen: false,
      	modal: true,
      	closeOnEscape: true,
      	closeText: 'show',
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
              $('#dasucc').dialog('open');
        	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}
      });
$("#dsucc").dialog({
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
          button.closest('form').submit();
        },
        buttons : {
          "Ok": function() {
              button.closest('form').submit();
          },
        }

    });

    $("#dasucc").dialog({
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
		$("#deletealldialog").dialog({
        autoOpen: false,
      	modal: true,
      	closeOnEscape: true,
      	closeText: 'show',
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
            	$('#deleteconfirm').dialog("open");
        	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    	});

    	$("#deletedialog").dialog({
        autoOpen: false,
      	modal: true,
      	closeOnEscape: true,
      	closeText: 'show',
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
              $('#dsucc').dialog('open');
        	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    	});

		$( "form#deleteall" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
      		$( "#deletealldialog" ).dialog( "open" );
    	});
    	$( "input[id^='delete']" ).click(function (e) {
    		e.preventDefault();
    	 	button = $(this);
      		$( "#deletedialog" ).dialog( "open" );
    	});
    	//END OF DELETE ANNOUNCEMENTS**********************************************************

    	/**
    		*Outgoing books
    	*/


		$("#confirmsuccess").dialog({
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

		$("#confirmdialog").dialog({
        autoOpen: false,
      	modal: true,
      	closeOnEscape: true,
      	closeText: 'show',
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
        		$('#confirmsuccess').dialog('open');
        	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}
    });
		$( "form[id^='confirm']" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
      		$( "#confirmdialog" ).dialog( "open" );
    	});

    	$("#canceldialog").dialog({
        autoOpen: false,
      	modal: true,
      	closeOnEscape: true,
      	closeText: 'show',
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

		$( "form[id^='cancel']" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
      		$( "#canceldialog" ).dialog( "open" );
    	});
    //END OF OUTGOING BOOK MODAL***********************************************************

    /*
    	*Overdue book modal
    */
	$("#extenddialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
        closeText: 'show',
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
            	$('#extendsucc').dialog('open');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });


    $("#extendsucc").dialog({
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

    $("#returnsucc").dialog({
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

        $("#returndialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
        closeText: 'show',
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
                $('#returnsucc').dialog('open');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }
    });
    $( "form[id^='borrret']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#returndialog" ).dialog( "open" );
    });
    $( "form[id^='borrext']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#extenddialog" ).dialog( "open" );
    });
    $( "form[id^='overret']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#returndialog" ).dialog( "open" );
    });
    $( "form[id^='overext']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#extenddialog" ).dialog( "open" );
    });

    /**
    	*View User Modal
    */
    $("#confsuccess").dialog({
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

        $("#confdialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
        maxHeight: 640,
        maxWidth: 320,
        closeText: 'show',
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
                $('#confsuccess').dialog('open');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });

        $("#deactivatedialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
        maxHeight: 640,
        maxWidth: 320,
        closeText: 'show',
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
                document.getElementById(form).submit();
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });
        $( "form[id^='accountconfirm']" ).submit(function (e) {
            e.preventDefault();
                form = $(this).get(0).id;
                $( "#confdialog" ).dialog( "open" );
        });
         $( "form[id='deactivateaccount']" ).submit(function (e) {
                e.preventDefault();
                form = $(this).get(0).id;
                $( "#deactivatedialog" ).dialog( "open" );
        });
	//END OF USER MODAL*****************************************************
	

	/*
		*Confirm book reservation
	*/
	$( "#confirmButton" ).click(function (e) {
    	e.preventDefault();
    	 link = $(this).attr('href');
      $( "#dialog" ).dialog( "open" );
    });

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
      		$('#ressucc').dialog('open')
      	},
      	"No": function() {
      		$(this).dialog('close');
      	}
      }
    });

    /*
		*Dialog for the success of the reservation of books
    */
    $("#ressucc").dialog({
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
      		window.location.replace(link);
      	},
      	buttons : {
        	"Ok": function() {
            	window.location.replace(link);
        	},
      	}

    });
    //END OF RESERVE BOOK MODAL
    });
		var form;
	var button;
</script>