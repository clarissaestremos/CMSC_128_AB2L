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
			.itemhover { background-color:#d3d3d3 !important; color:black !important; width: 500px !important;}
			#selectItems ul { width:500px; font-size:14px; line-height:28px; list-style:none;}
			#selectItems ul li { }
			#selectItems ul li a { display:block; color:black; text-decoration:none; padding:0; }
			#sorry{text-align: center; padding: 10px;}
      #autosuggest_list{ padding: 50px 0px 0px 0px;}
     .howver:hover{background-color:#d3d3d3 !important; color:black !important;}
      #DAPPlugin{
        display:none;
      }
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
<script>
	$(document).ready(function() {
		$('#tabs').tabs();
		/**
			*Announcements Deletes
		*/
		$("#deleteconfirm").dialog({
        autoOpen: false,
      	modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
          resizable: false,
          width: 300,
          minHeight: 200,
 	        closeOnEscape: true,
 	        closeText: 'show',
 	        show: {
 	          effect: "fadeIn",
 	          duration: 200
 	        },
 	        draggable: false,
 	        close: function(event, ui){
 	          thisform.submit();
 	        },
 	        buttons : {
 	          "Ok": function() {
 	              thisform.submit();
 	          },
 	        }
     	});

		$("#confirmdialog").dialog({
        autoOpen: false,
      	modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
          resizable: false,
          width: 300,
          minHeight: 200,
 	        closeOnEscape: true,
 	        closeText: 'show',
 	        show: {
 	          effect: "fadeIn",
 	          duration: 200
 	        },
 	        draggable: false,
 	        close: function(event, ui){
 	          thisform.submit();
 	        },
 	        buttons : {
 	          "Ok": function() {
 	              thisform.submit();
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
            resizable: false,
            width: 300,
            minHeight: 200,
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
            resizable: false,
            width: 300,
            minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
        $("#notifydialog").dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
                document.getElementById(form).submit();
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

    $('#notifyall').submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $('#notifydialog').dialog('open');;
    });

    /**
    	*View User Modal
    */
    $("#confsuccess").dialog({
            autoOpen: false,
            modal: true,
            resizable: false,
            width: 300,
            minHeight: 200,
            closeOnEscape: true,
            closeText: 'show',
            show: {
              effect: "fadeIn",
              duration: 200
            },
            draggable: false,
            close: function(event, ui){
              thisform.submit();
            },
            buttons : {
              "Ok": function() {
                  thisform.submit();
              },
            }
 
        });

        $("#confdialog").dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
      resizable: false,
      width: 300,
      minHeight: 200,
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

    //END OF RESERVE BOOK MODAL
    

    /**
    	*Settings Modal
    */
    $("#elibmail").dialog({
        autoOpen: false,
      	modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
             	$('#elibmailconf').dialog('open');
           	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    });

		$("#elibmailconf").dialog({
        autoOpen: false,
      	modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
             	$('#elibmailsucc').dialog('open');
           	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    	});

		$("#elibmailsucc").dialog({
 	    	autoOpen: false,
 	        modal: true,
          resizable: false,
          width: 300,
          minHeight: 200,
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
 
		$( "#myform" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
        if(process_add())
      		$( "#elibmail" ).dialog( "open" );
    	});

    	$("#passadmin").dialog({
        autoOpen: false,
      	modal: true,
        resizable: false,
          width: 300,
          minHeight: 200,
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
             	$('#passadminconf').dialog('open');
           	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    });

		$("#passadminconf").dialog({
        autoOpen: false,
      	modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
             	$('#passadminsucc').dialog('open');
           	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    	});

		$("#passadminsucc").dialog({
 	    	autoOpen: false,
 	        modal: true,
          resizable: false,
          width: 300,
          minHeight: 200,
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
     	$("#cancelmsg").dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
              window.location.replace(link);
            },
          "No": function() {
              $(this).dialog('close');
          }
        }

      });
 
		$( "#form" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
        if(process_add())
      		$( "#passadmin" ).dialog( "open" );
    	});
    	$( "#cancelset1" ).click(function (e) {
    		e.preventDefault();
    	 	link = $(this).attr('href');
      		$( "#cancelmsg" ).dialog( "open" );
    	});
    	$( "#cancelset2" ).click(function (e) {
    		e.preventDefault();
    	 	link = $(this).attr('href');
      		$( "#cancelmsg" ).dialog( "open" );
    	});
    //END OF SETTINGS MODAL

    /*
    	*Add Admin Modals
    */
    $("#addadminsuccess").dialog({
            autoOpen: false,
            modal: true,
            resizable: false,
            width: 300,
            minHeight: 200,
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

        $("#addadmin").dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
          width: 300,
          minHeight: 200,
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
                document.getElementById('akeys').innerText = "Admin key: " + document.getElementById('adminkey').value;
                document.getElementById('ausernames').innerText = "Admin username: " + document.getElementById('uname').value;
                $('#addadminsuccess').dialog('open');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

        });

        $( "#adminReg" ).submit(function (e) {
            e.preventDefault();
            form = $(this).get(0).id;
            document.getElementById('akey').innerText = "Admin Key: "+ document.getElementById('adminkey').value;
            document.getElementById('aname').innerText = "Name: "+ document.getElementById('fname').value + " "+ document.getElementById('minit').value + " " + document.getElementById('lname').value;
            document.getElementById('aemail').innerText = "Admin Key: "+ document.getElementById('eadd').value;
            document.getElementById('ausername').innerText = "Admin Key: "+ document.getElementById('uname').value;
            $( "#addadmin" ).dialog( "open" );
        });
    //END OF ADD ADMIN MODALS

    /**
		*Add User Modals
    */

        $("#registerconf").dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
        width: 300,
        minHeight: 200,
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
                document.getElementById(form).submit();
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

        });

        $( "#userRegister" ).submit(function (e) {
            e.preventDefault();
            form = $(this).get(0).id;
            if(validateAll()){
            document.getElementById('regname').innerText = "Name: "+ document.getElementById('fname').value + " "+ document.getElementById('minit').value + " " + document.getElementById('lname').value;
            document.getElementById('regclass').innerText = "Classification: "+ document.getElementById('classi').value;
            if(document.getElementById('classi').value === "student"){
                document.getElementById('regnum').innerText = "Student Number: "+ document.getElementById('stdNum').value;
                document.getElementById('regcol').innerText = "College: "+ document.getElementById('college').value;
                document.getElementById('regcourse').innerText = "Course: "+ document.getElementById('course').value;
            }
            else if(document.getElementById('classi').value === "faculty"){
                document.getElementById('regcol').innerText = "College: "+ document.getElementById('college').value;
                document.getElementById('regnum').innerText = "Employee Number: "+ document.getElementById('stdNum').value;
            }

            document.getElementById('regemail').innerText = "Email: "+ document.getElementById('eadd').value;
            document.getElementById('reguser').innerText = "Username: "+ document.getElementById('uname').value;
            $( "#registerconf" ).dialog( "open" );
          }
        });
    //END OF ADD USER MODALS
    });
    function confirmUser(myformid){
        thisform = myformid;
        $('#confdialog').dialog('open');
        console.log(thisform);
        return false;
    }

    function confirmBookReserve(myformid){
        thisform = myformid;
        $( "#confirmdialog" ).dialog( "open" );
        console.log(thisform);
        return false;
    }

    function confirmDeleteReserve(myformid){
        thisform = myformid;
       $( "#canceldialog" ).dialog( "open" );
        console.log(thisform);
        return false;
    }

		var form;
    var thisform;
	 var button;
</script>