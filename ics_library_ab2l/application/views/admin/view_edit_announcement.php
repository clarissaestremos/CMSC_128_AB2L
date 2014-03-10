<script type="text/javascript">
			window.onload=function() {
				myform.content.onblur=validate_content;
				myform.onsubmit=process_add;
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
				if (validate_content()) {
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
                                        <h1>Admin <small>Edit Announcement</small></h1>
                                    </div>
                                <div class="col width-fill">
                                	<div class="cell panel" style="border: 1px solid #9BA0AF;">
                                		<div class="header gradient">
                                				<h4 style="text-weight: normal; font-family: Arial;">Post another announcements</h4>
                                		</div>
                                		<div class="cell">		
										<div id="add" class="cell">
											<form action="../controller_announcement/saveChanges" id="editannouncement" method="post">
												<div class="panel cell" style="background: #f6f6f6;border: 1px solid #9BA0AF;">
													<div class="cell">
														<label>ANNOUNCEMENT TITLE</label><br/>
														<input type="text" name="title" id="title" class="background-white" style="width: 95%; margin-left: 3%;" value="<?php echo $title;?>" required="required" /><br/><br/>
													</div>
												</div>
												<div class="cell panel" style="background: #f6f6f6; margin-top: 1.5em; border: 1px solid #9BA0AF;">
													<div class="cell">
													<label>ANNOUNCEMENT CONTENTS</label><br/>
													<textarea cols="40" rows="5" name="content" class="background-white" style="width: 95%; margin-left: 3%;" id="content" required="required"><?php echo $content;?></textarea><span name="help_content" class="color-red"><br /><br/>
													
													</div>
												</div>
												<br/><br/>
										</div>
									 </div>
									 <div class="footer width-fill" style="border-top: 1px solid #9BA0AF;">
													<a id="buttoncancel" href="<?php echo base_url(); ?>index.php/admin/controller_announcement"><input type="button"  name="cancel" id="cancel" class="float-right" value="Cancel" style="margin: 0px 5px 0px 5px;"/></a>
												
													<input type = "hidden" name = "date" id = "date" value = "<?php echo $id;?>" />
													<input type="hidden" name="save"/>
 													<input type="submit" class='float-right' id="save" value="Save Changes" style="margin: 0px 5px 10px 18em;" />
													
									</form>
									</div>	
								</div>
							</div>
                        </div>
							</div>
                        </div>
				</div>
			</div>
<div id="announcementdialog" title="Edit Announcement Confirmation Dialog">
	<p>Are you sure that you want to edit this announcement?</o>
</div>
<div id='successdialog' title='Success Dialog'>
	<h5>You have successfully edit the announcement!!</h5>
</div>
<div id="announcementcancel" title="Cancel Add Announcement Dialog">
	<h5>Do you really want to cancel editing this announcement?</h5>
	<h5>Do you really want to cancel adding an announcement?</h5>
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
            	$('#successdialog').dialog('open');
        	},
        	"No": function() {
            	$(this).dialog('close');
        	}
      	}
	});
		$("#successdialog").dialog({
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

		$("#announcementcancel").dialog({
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
		$("#cancelannouncement").dialog({
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

		$( "#editannouncement" ).submit(function (e) {
    		e.preventDefault();
    	 	form = $(this).get(0).id;
      		$( "#announcementdialog" ).dialog( "open" );
    	});

    	$( "#buttoncancel" ).click(function (e) {
    		e.preventDefault();
    	 	link = $(this).attr('href');
      		$( "#announcementcancel" ).dialog( "open" );
    	$( "#cancelbutton" ).submit(function (e) {
    		e.preventDefault();
    	 	link = $(this).attr('href');
      		$( "#cancelannouncement" ).dialog( "open" );
    	});
	});
	var form;
	var link;
</script>