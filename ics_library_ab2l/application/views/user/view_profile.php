<div id="main-body" class="site-body">

                <div class="site-center">
				<div class="cell body">
               
    </div>
    <div class="col">
        <div class="cell">
            <div class="col width-fill">
                <div class="col">
                   
                    <div class="cell panel">
                        <div id="regform" class="body" style="margin-top: 2%">
                            <div class="cell">
                                <div class="color-red width-fill" style="font-weight: bold"><p>
                                    <?php 
                                        if(isset($msg)){
                                            echo $msg;
                                         }

                                 ?>

                               
                                    <?php echo  form_open_multipart('index.php/user/controller_editprofile/uploadImage')?>
                                    <!--div id = "frame" style = "width: 220px;height:220px;border-radius:110px;border:solid 2px;margin-top:40px;margin-left:50px;background:#FFFFFF;"-->

                                     <div id="picture"> 
						<object data="<?php echo base_url().'imgs/'.$user_details->account_number.'.jpg';?>" type="image/jpg" style = "height: 300px;width:300px; margin-left: 18px; object-fit: cover; ">
						<img src="<?php echo base_url().'imgs/'.'default'.'.png';?>" alt = "Oops, something went wrong. " style = "height: 300px;width:300px;  margin-left: 16px;"/>
	                                      </object>
				     </div>

                                      <!--img  alt = "Oops, something went wrong. " style = "padding: 2.5em; length: 250px;width:250px;" src="<?php echo base_url().'imgs/'.$user_details->account_number.'.jpg';?>">
                                    <!--a class="col width-fill" id = "edit_picture">Edit</a-->
                                </div><br/><br/><br/>
                                    
                                    <!--/div-->

                                    <div id='name' style="margin-left: -1%">
                                        <ul>
                                            <li style = "list-style: none;margin-top:-65px; border=black;"><input  type = 'file' id= 'new_picture' accept="image/jpg, image/png, image/jpeg, image/gif" name = 'userfile' class='background-white' required ></li>
                                            <li style = "list-style: none;margin-top:-2.24em; margin-left:250px;"><input type="submit" name="Upload" value="Upload"></li>
                                        </ul>
                                    </div>
                                  <?php echo form_close();?>
                                    
                                        
                                </div>
                               
                               <div style = "margin-top:-420px;margin-left:320px; ">
                                <div class="col">
                                    <div class="cell">
                                        
                                        <?php echo validation_errors();
                                            if ($this->session->flashdata('success_username') != ''): 
                                                echo "<div class= 'isa_success'>".$this->session->flashdata('success_username')."</div>"; 
                                            endif;   
                                            if ($this->session->flashdata('error_username1') != ''): 
                                                echo $this->session->flashdata('error_username1'); 
                                            endif; 

                                             if ($this->session->flashdata('success_email') != ''): 
                                                echo "<div class= 'isa_success'>".$this->session->flashdata('success_email')."</div>"; 
                                            endif;   
                                            if ($this->session->flashdata('error_email1') != ''): 
                                                echo $this->session->flashdata('error_email1'); 
                                            endif; 

                                              if ($this->session->flashdata('success_password') != ''): 
                                                echo "<div class = 'isa_success'>".$this->session->flashdata('success_password')."</div>"; 
                                            endif;   
                                            if ($this->session->flashdata('error_password1') != ''): 
                                                echo $this->session->flashdata('error_password1'); 
                                            endif; 
                                         ?>

                                     <div class="col" >
                                        <h4 style = "color: #413839; padding-left: 37px; font-size: 22px;font-family:'Lucida Console', Monaco, monospace"><?php echo $name?></h4>
                                                <div class="cell panel" >
                                                    <div class="body">
                                                        <div class="cell">
                                                           <span id="label_username" class = "main" style='margin-right:1.3em;'>Username:</span><em id= "username"><?php echo  $user_details->username?></em> <a id = "edit_username">Edit</a><br>
                                     
                                                            <form id= 'form_username' method= 'post'  action = 'controller_editprofile/edit_username'>
                                                            <span id="label_username1" style='margin-right:1.3em;'>Username: </span><input style = "margin-left: 28px;"  type = 'text' id= 'input_username'name = 'new_username' ><span id = "helpusername" class= "validmsg"></span><br><br/>
 	                                                        <span style='margin-right:1.3em;'>Enter password:</span><input type= "password" id ='pword_for_username' class="background-white" name ='pword_for_username' onblur="validatePassword()"  ><span class = "color-red validmsg" id= "pword_username_help"></span><br><br/>
                                                            <input style = "margin-left: 60px; margin-top: 10px;"type='button' id = "cancel_username" value= 'Cancel' >
                                                            <input style = "margin-top: 10px;" type='submit' name = "sub" onclick= "return validate_username()" value= 'Save'><br><br>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="body">
                                                        <div class="cell">
                                                            <span class = "main" style='margin-right:1em;'>Classification:</span><em><?php echo  $user_details->classification?></em>
                                                         </div>
                                                    </div>
                                                    <div class="body">
                                                        <div class="cell">
                                                            <span class = "main" style='margin-right:1.3em;'>College:</span><em><?php echo  $user_details->college?></em>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        if($user_details->classification == "student"){
                                                            echo "<div class='body'>
                                                                <div class='cell'>
                                                                    <span class = 'main' style='margin-right:1.3em;'>Course:</span><em>".$user_details->course."</em>
                                                                </div>
                                                            </div>";
                                                        }
                                                    ?>
                                                     <div class="body">
                                                        <div class="cell">
                                                            <span class = "main" id="label_email" style='margin-right:1.3em;'>Email:</span><em id= "email"><?php echo  $user_details->email?></em> <a id = "edit_email">Edit</a><br>
                                                            <form id= 'form_email' method= 'post' action = 'controller_editprofile/edit_email'>
                                                            <span id="label_email1" style='margin-right:1.3em;'>Email Address:</span>  <input type = 'text' id= 'input_email'name = 'new_email'value="<?php echo  $user_details->email?>" required><span class="color-red validmsg" id = "helpemail"></span></br><br/>
                                                           	<span style='margin-right:1.3em;'>Enter password:</span><input type= 'password' id ='pword_for_email' class="background-white" onblur="validatePasswordeEmail()"name ='pword_for_email' required><span class="color-red validmsg" id= "pword_email_help"></span><br><br/>
                                                            <input style = "margin-left: 60px; margin-top: 10px;" type='button' id = "cancel_email" value= 'Cancel'>
                                                            <input style = "margin-left: 10px; margin-top: 10px;" type='submit'  onclick= "return  validate_email()" value= 'Save'><br/><br/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="body">
                                                        <div class="cell">
                                                            <span class = "main" style='margin-right:1.3em;'>Status:</span><em><?php if(($user_details->status == "approve") || ($user_details->status =="approved")) {echo "Approved";}
                                                                else{
                                                                    echo "Pending";
                                                                }

                                                            ?></em>
                                                        </div>
                                                    </div>
                                                    <div class="body">
                                                        <div class="cell">
                                                             <a style = "margin-left:20px;" id ="edit_password">Change Password</a>
                                 
                                                             <form id= 'form_password' method= 'post' action = 'controller_editprofile/edit_password'>
                                                           
                                                            <span style='margin-right:1.3em;'>Enter current password:</span><input type= 'password' id ='current_password' class="background-white" name ='current_password' required><span id = "helppassword" class="color-red validmsg"></span><br><br/>
                                                            <span style='margin-right:1.3em;'>Enter new password:</span><input style = "margin-left: 16px;" type= 'password' id ='new_password' class="background-white" name ='new_password' required><span id = "helpnewpassword"  class="color-red validmsg"></span><br><br/>
                                                            <span style='margin-right:1.3em;'>Confirm password:</span><input style = "margin-left: 28px;" type= 'password' id ='confirm_password' class="background-white" name ='confirm_password' required><span id = "helpcpassword"  class="color-red validmsg"></span><br><br/>
                                                            <input style = "margin-left: 60px; margin-top: 10px;" type='button' id = "cancel_password" value= 'Cancel'>
                                                            <input style = "margin-left: 10px; margin-top: 10px;" type='submit'  onclick= "return  validate_passwords()" value= 'Save'><br/><br/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                    
                                     <?php

                                         ?>
                                    
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <script src="<?php echo base_url() ?>js/validation.js"></script>
     <script >
     name = $("#username").text();
     prev_email= "<?php echo  $user_details->email?>";
    success = "<?php echo $this->session->flashdata('success')?>";
    error_username="<?php echo $this->session->flashdata('error_username')?>";
  
    error_email = "<?php echo $this->session->flashdata('error_email')?>";
 
    error_password = "<?php echo $this->session->flashdata('error_password')?>";
    success_password= "<?php echo $this->session->flashdata('success_password')?>"


     </script>

<script src="<?php echo  base_url() ?>js/edit_username.js"></script>
<script src="<?php echo  base_url() ?>js/edit_email.js"></script>
<script src="<?php echo  base_url() ?>js/edit_password.js"></script>
<script src="<?php echo  base_url() ?>js/edit_picture.js"></script>
<!-- End of file view_profile.php -->
<!-- Location: ./application/view/user/view_profile.php -->
