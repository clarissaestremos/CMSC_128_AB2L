<script type="text/javascript">
			window.onload=function() {
				myform.content.onblur=validate_content;
				myform.title.onblur=validate_title;
				myform.onsubmit=process_add;
			}
					
			function validate_title() {
				msg="Invalid input: ";
				str=myform.title.value;
				
				if(str=="")
				msg+="Please provide a title for your announcement!<br/>";
				if(!str.match(/^[a-zA-Z0-9\ \'\,\.\-\!]+[a-zA-Z0-9\ \'\,\.\-\!]*$/))
                msg+="Title must be between 1-100 alpha numeric character!<br/>";
				if(msg=="Invalid input: ")
				msg="";
				else {
					document.getElementsByName("help_title")[0].style.fontSize="10px";
					document.getElementsByName("help_title")[0].style.fontFamily="verdana";
					document.getElementsByName("help_title")[0].style.color="red";
				}
				document.getElementsByName("help_title")[0].innerHTML=msg;
				if(msg=="")
					return true;
			}

			function validate_content() {
				msg="Invalid input: ";
				str=myform.content.value;
					
				if(str=="")
				msg+="The content field is empty! There's no sense posting this kind of announcement!<br/>";
				if(msg=="Invalid input: ")
				msg="";
				else {
					document.getElementsByName("help_content")[0].style.fontSize="10px";
					document.getElementsByName("help_content")[0].style.fontFamily="verdana";
					document.getElementsByName("help_content")[0].style.color="red";
				}
				document.getElementsByName("help_content")[0].innerHTML=msg;
				if(msg=="")
					return true;
			}

			
			function process_add() {
				if (validate_content() && validate_title()) {
					<?php
						if(isset($_POST['submit'])){
							
						}
					?>
				}
				else 
					return false;
			}
		</script>

<div id="thisbody" class="body width-fill background-white">
					<div class="col">
                            <div class="cell">
                                    <div class="page-header cell">
                                        <h1>Admin <small>Add Announcement</small></h1>
                                    </div>
                                <div class="col width-fill">
                                	<div class="cell panel" style="border: 1px solid #9BA0AF;">
                                		<div class="header gradient">
                                				<h4 style="text-weight: normal; font-family: Arial;">Post another announcement</h4>
                                		</div>
                                		<div class="cell">		
										<div id="add" class="cell">
											<form action="" name="myform" id="addannouncement" method="post">
												<div class="panel cell" style="background: #f6f6f6;border: 1px solid #9BA0AF;">
													<div class="cell">
														<label for="title">ANNOUNCEMENT TITLE</label><br/>
														<input type="text" name="title" id="title" class="background-white" style="width: 95%; margin-left: 3%;" placeholder="Title" required="required" /><br/><span name="help_title" class="color-red"></span><br/>
													</div>
												</div>
												<div class="cell panel" style="background: #f6f6f6; margin-top: 1.5em; border: 1px solid #9BA0AF;">
													<div class="cell">
													<label for="content" >ANNOUNCEMENT CONTENTS</label><br/>
													<textarea cols="40" rows="5" name="content" class="background-white" style="width: 95%; margin-left: 3%;" id="content" placeholder="Content" required="required"></textarea><span name="help_content" class="color-red"></span><br /><br/>
													
													</div>
												</div>
												<br/><br/>
										</div>
									 </div>
									 <div class="footer width-fill" style="border-top: 1px solid #9BA0AF;">
										<a id="addcancel" href="<?php echo base_url(); ?>index.php/admin/controller_announcement"><input type="button"  name="cancel" id="cancel" class="float-right" value="Cancel" style="margin: 0px 5px 0px 5px;"/></a>
										<input type='hidden' name='add'/>
										<input type="submit" id="add" class="float-right" value="Add Anouncement"/>
									</div>
									</form>
								</div>
							</div>
                        </div>
				</div>
			</div>
<div id="announcementdialog" title="Add Announcement Confirmation Dialog">
	<p>Are you sure that you want to add this announcement?</p>
</div>
	<div id="addsucc" title="Add Announcement Success">
		<p>You have successfully added a new announcement. This announcement will be shown on the homepage of the website.</p>
 	</div>
<div id="canceladddialog" title="Cancel Add Announcement Dialog">
	<p>Do you really want to cancel adding an announcement?</p>
</div>
<script>
	$(document).ready(function(){
		$("#announcementdialog").dialog({
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
             	$('#addsucc').dialog('open');
           	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    });

		$("#addsucc").dialog({
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

     	$("#canceladddialog").dialog({
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
             	window.location.replace(link);
           	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}

    });


     	$( "#addcancel" ).click(function (e) {
    		e.preventDefault();
    	 	link = $(this).attr('href');
      		$( "#canceladddialog" ).dialog( "open" );
    	});
 
		$( "#addannouncement" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
      		$( "#announcementdialog" ).dialog( "open" );
    	});


     	
	});
	var form;
	var link;
</script>