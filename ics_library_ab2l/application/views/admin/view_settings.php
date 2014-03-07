<script type="text/javascript">
			window.onload=function() {
				myform.icsmailpw1.onblur=validate_epass;
				myform.admin_password1.onblur=validate_apass;
				myform.onsubmit=process_add;
			}
					
			function validate_epass() {	//EMAIL PASSWORD
				msg="Invalid input: ";
				pass=myform.icsmailpw.value;
				pass1=myform.icsmailpw1.value;
					
				if(pass!=pass1)
					msg+="Passwords did not matched.";
				if(msg=="Invalid input: ")
					msg="";
				else {
					document.getElementsByName("help_epass")[0].style.fontSize="10px";
					document.getElementsByName("help_epass")[0].style.fontFamily="verdana";
					document.getElementsByName("help_epass")[0].style.color="red";
				}
				document.getElementsByName("help_epass")[0].innerHTML=msg;
				if(msg=="")
					return true;
			}
			
			function validate_apass() {		//ADMIN PASSWORD
				msg="Invalid input: ";
				pass=myform.admin_password.value;
				pass1=myform.admin_password1.value;
					
				if(pass!=pass1)
					msg+="Passwords did not matched.";
				if(msg=="Invalid input: ")
					msg="";
				else {
					document.getElementsByName("help_apass")[0].style.fontSize="10px";
					document.getElementsByName("help_apass")[0].style.fontFamily="verdana";
					document.getElementsByName("help_apass")[0].style.color="red";
				}
				document.getElementsByName("help_apass")[0].innerHTML=msg;
				if(msg=="")
					return true;
			}

			
			function process_add() {
				if (validate_epass()) {
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
                                        <h1>Admin <small>Settings</small></h1>
                                    </div>
                                    <?php
										include("./application/controllers/admin/controller_retrieve_email.php");
                                    ?>
                                <div class="col width-fill">
                                	<div class="cell panel" style="border: 1px solid #9BA0AF;">
                                		<div class="header gradient">
                                				<h4 style="text-weight: normal; font-family: Arial;">ICS e-Lib Settings</h4>
                                		</div>
                                		<div class="cell"><?php echo $msg;?>
										<div id="add" class="cell">
											<form name="myform" action="<?php echo base_url(); ?>index.php/admin/controller_settings/saveChanges" method="post">
												<div class="cell panel" style="background: #f6f6f6; margin-top: 1.5em; border: 1px solid #9BA0AF;">
													<div class="cell">
													<label>ICS e-Lib Email Address: <?php echo  $email;?></label><br/>
													<input type="email" name="icsmail" id="icsmail" placeholder="New Email" class="background-white" style="width: 95%; margin-left: 3%;" />
													<label>ICS e-Lib Email Password: ********************</label><br/>
													<input type="password" name="icsmailpw" id="icsmailpw" placeholder="New Password" class="background-white" style="width: 95%; margin-left: 3%;"/><br /><br/>
													<input type="password" name="icsmailpw1" id="icsmailpw1" placeholder="Retype Password" class="background-white" style="width: 95%; margin-left: 3%;"/><br /><br/>
													<label>Enter your Administrator Password</label><br/>
													<input type="password" name="admin_pass" id="admin_pass" placeholder="Admin Password" class="background-white" style="width: 95%; margin-left: 3%;"/><span name="help_epass" class="color-red"></span><br /><br/>
													</div>
												</div>
												<br/><br/>
										</div>
									 </div>
									 <div class="footer width-fill" style="border-top: 1px solid #9BA0AF;">
													<a href="<?php echo base_url(); ?>index.php/admin/controller_admin_home"><input type="button"  name="cancel" id="cancel" class="float-right" value="Cancel" onclick="return confirm('Are you sure you want to cancel editing the ICS e-Lib settings?')" style="margin: 0px 5px 0px 5px;"/></a>
													<input type="submit" name="save" class='float-right' id="save" value="Save Changes" onclick="return confirm('Note that changing the password here does not change the password of your email account. It only modifies the stored password that will be used to facilitate the system in sending and receiving necessary messages. If you want to continue, press OK. ')" style="margin: 0px 5px 10px 18em;" />
									</form>
									</div>	
								</div>
							</div>
							
							<div class="col width-fill">
                                	<div class="cell panel" style="border: 1px solid #9BA0AF;">
                                		<div class="header gradient">
                                				<h4 style="text-weight: normal; font-family: Arial;">Administrator Account Settings</h4>
                                		</div>
                                		<div class="cell"><?php echo $msg1;?>
										<div id="add" class="cell">
											<form name="form" action="<?php echo base_url(); ?>index.php/admin/controller_settings/changeAdminPassword" method="post">
												<div class="cell panel" style="background: #f6f6f6; margin-top: 1.5em; border: 1px solid #9BA0AF;">
													<div class="cell">
													<label>Administrator Password: ********************</label><br/>
													<input type="password" name="admin_password" id="admin_password" placeholder="New Password" class="background-white" style="width: 95%; margin-left: 3%;"/><br /><br/>
													<input type="password" name="admin_password1" id="admin_password1" placeholder="Retype Password" class="background-white" style="width: 95%; margin-left: 3%;"/><span name="help_apass" class="color-red"></span><br /><br/>
													<label>Current Password</label><br/>
													<input type="password" name="admin_pass" id="admin_pass" placeholder="Current Password" class="background-white" style="width: 95%; margin-left: 3%;"/><span name="help_content" class="color-red"><br /><br/>
													</div>
												</div>
												<br/><br/>
										</div>
									 </div>
									 <div class="footer width-fill" style="border-top: 1px solid #9BA0AF;">
													<a href="<?php echo base_url(); ?>index.php/admin/controller_admin_home"><input type="button"  name="cancel" id="cancel" class="float-right" value="Cancel" onclick="return confirm('Are you sure you want to cancel editing the ICS e-Lib settings?')" style="margin: 0px 5px 0px 5px;"/></a>
													<input type="submit" name="save" class='float-right' id="save" value="Save Changes" onclick="return confirm('Are you sure you want to change your password?')" style="margin: 0px 5px 10px 18em;" />
													
									</form>
									</div>	
								</div>
							</div>
                        </div>
							</div>
                        </div>
				</div>
			</div>
