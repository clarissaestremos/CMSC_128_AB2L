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
<?php
	$base = base_url();
?>
<div id="thisbody" class="body width-fill background-white">
					<div class="col">
                            <div class="cell">
                                    <div class="page-header cell">
                                        <h1>Admin <small>Edit Announcement</small></h1>
                                    </div>
                                <div class="col width-fill">
                                	<div class="cell panel" style="border: 1px solid #9BA0AF;">
                                		<div class="header gradient">
                                				<h4 style="text-weight: normal; font-family: Arial;">Edit announcements</h4>
                                		</div>
                                		<div class="cell">		
										<div id="add" class="cell">
											<form action="" method="post">
												<div class="panel cell" style="background: #f6f6f6;border: 1px solid #9BA0AF;">
													<div class="cell">
														<label for="title">ANNOUNCEMENT TITLE</label><br/>
														<input type="text" name="title" id="title" class="background-white" style="width: 95%; margin-left: 3%;" value="<?php echo $title;?>" required="required" /><br/><br/>
													</div>
												</div>
												<div class="cell panel" style="background: #f6f6f6; margin-top: 1.5em; border: 1px solid #9BA0AF;">
													<div class="cell">
													<label for="content">ANNOUNCEMENT CONTENTS</label><br/>
													<textarea cols="40" rows="5" name="content" class="background-white" style="width: 95%; margin-left: 3%;" id="content" value = "<?php echo $id;?>" required="required"></textarea><br /><br/>
													
													</div>
												</div>
												<br/><br/>
										</div>
									 </div>
									 <div class="footer width-fill" style="border-top: 1px solid #9BA0AF;">
									 				<a href="<?php echo base_url(); ?>index.php/admin/controller_announcement"><input type="button"  name="cancel" id="add" class="float-right" value="Cancel" style="margin: 0px 5px 0px 5px;"/></a>
													<input type = "hidden" name = "date" id = "date" value = "<?php echo $id;?>" />
													<input type="submit" name="save" class='float-right' id="save" value="Save Changes" style="margin: 0px 5px 10px 18em;" />
									</div>
									</form>
								</div>
							</div>
                        </div>
							</div>
                        </div>
				</div>
			</div>