<style type="text/css">
            * {font-family: Arial;}
            span {font-size: 20px;
                    font-weight: bold;}
            em{font-size: 17px;}
            #helpusername, #helpemail, #helppassword, #helpnewpassword,#helpcpassword{
                font-size: 13px;
                color: red;
            }
            
        </style>
<div id="main-body" class="site-body">
                <div class="site-center">
<div class="cell body">
               
    </div>
    <div class="col">
        <div class="cell">
            <div class="col width-2of2">
                <div class="col">
                   
                    <div class="cell panel">
                        <div id="regform" class="body">
                            <div class="cell">
                                <div class="color-red width-fill" style="font-weight: bold;"><p>
                                    <?php 
                                        if(isset($msg)){
                                            echo $msg;
                                         }

                                 ?>

                                  <h2><?php echo $name?></h2>
                                </div>
                               
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
                                    <span class="col width-1of4" id="label_username">Username:</span><em class="col width-fill" id= "username"><?php echo  $user_details->username?></em> <a class="col width-fill" id = "edit_username">Edit</a>
                                    <br/>
                                    <form id= 'form_username' method= 'post'  action = 'controller_editprofile/edit_username'>
                                    <span class="col width-1of4"  id="label_username1">Username:</span><input  type = 'text' id= 'input_username'name = 'new_username' required ><span id = "helpusername" class="col width-fill"></span><br>
                                    <span class="col width-1of4">Enter password:</span><input type= "password" id ='pword_for_username' class="background-white" name ='pword_for_username' required class="col width-fill"><br>
                                     <input type='button' id = "cancel_username" value= 'Cancel' >
                                    <input type='submit' name = "sub" onclick= "return validate_username()" value= 'Save'><br>
                                    </form>
                                    <hr>

                                  
                                    <br/>
                                    <span class="col width-1of4" >Classification:</span><em class="col width-fill"><?php echo  $user_details->classification?></em><br/><hr>
                                    <span class="col width-1of4">College:</span><em class="col width-fill"><?php echo  $user_details->college?></em><br/><hr>
                                    <span class="col width-1of4">Course:</span><em class="col width-fill"><?php echo  $user_details->course?></em><br/><hr>
                                    <span class="col width-1of4" id="label_email">Email:</span><em class="col width-fill" id= "email"><?php echo  $user_details->email?></em> <a class="col width-fill" id = "edit_email">Edit</a><br>

                                    <form id= 'form_email' method= 'post' action = 'controller_editprofile/edit_email'>
                                    <span class="col width-1of4" id="label_email1">Email Address:</span><input type = 'text' id= 'input_email'name = 'new_email' value="<?php echo  $user_details->email?>" required><span class="col width-fill" id = "helpemail"></span><br>
                                    <span class="col width-1of4">Enter password:</span><input type= 'password' id ='pword_for_email' class="background-white" name ='pword_for_email' required class="col width-fill"><br>
                                     <input type='button' id = "cancel_email" value= 'Cancel'>
                                    <input type='submit'  onclick= "return  validate_email()" value= 'Save'><br/><br/>
                                    </form>
                                    <hr>
                                    <br/>
                                    <span class="col width-1of4">Status:</span><em class="col width-fill"><?php echo  $user_details->status?></em><br/>
                                    <a id ="edit_password">Change Password</a>
                                 
                                     <form id= 'form_password' method= 'post' action = 'controller_editprofile/edit_password'>
                                   
                                    <span class="col width-1of4">Enter current password:</span><input type= 'password' id ='current_password' class="background-white" name ='current_password' required><span id = "helppassword" class = "color-red" class="col width-fill"></span><br>
                                    <span class="col width-1of4">Enter new password:</span><input type= 'password' id ='new_password' class="background-white" name ='new_password' required><span id = "helpnewpassword" class = "color-red" class="col width-fill"></span><br>
                                    <span class="col width-1of4">Confirm password:</span><input type= 'password' id ='confirm_password' class="background-white" name ='confirm_password' required><span id = "helpcpassword" class = "color-red" class="col width-fill"></span><br>
                                     <input type='button' id = "cancel_password" value= 'Cancel'>
                                    <input type='submit'  onclick= "return  validate_passwords()" value= 'Save'><br/><br/>
                                    </form>
                                    </div>

                                     <?php
          $this->load->model('model_upload');
          $this->load->view('user/view_upload');

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