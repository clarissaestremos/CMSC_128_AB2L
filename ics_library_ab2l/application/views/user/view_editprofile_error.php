<!-- This file is for editing the profile of the user
Will show you a form just like in registrations wherein you will input a value
and it will be validated -->
<div id="main-body" class="site-body">
        <div class="site-center">
<div class="cell body">
        <p class="tiny">Edit Profile</p>
    </div>
    <div class="col">
        <div class="cell">
            <div class="col width-fill">
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

                                  <h4><?php echo $name?></h4>
                                </div>
                               
                                <div class="col">
                                    <div class="cell">
                                       
                                    <span id="label_username">Username:</span><em id= "username"><?php echo  $user_details->username?></em> (<a id = "edit_username">Edit</a>)
                                    
                                    <form id= 'form_username' method= 'post' action = 'controller_editprofile/edit_username'>
                                    <span id="label_username1">Username:</span><input type = 'text' id= 'input_username'name = 'new_username'><span id = "helpusername"></span><br>
                                    <span>Enter password:</span><input type= "password" id ='pword_for_username' class="background-white" name ='pword_for_username' required><br>
                                     <input type='button' id = "cancel_username" value= 'Cancel'>
                                    <input type='submit' onClick="return validate_new_un" value= 'Save'><br>
                                    </form>
                                
                                    <br/>
                                    <span>Classification:</span><em><?php echo  $user_details->classification?></em><br/>
                                    <span>College:</span><em><?php echo  $user_details->college?></em><br/>
                                    <span>Course:</span><em><?php echo  $user_details->course?></em><br/>
                                    <span id="label_email">Email:</span><em id= "email"><?php echo  $user_details->email?></em><a id = "edit_email">Edit</a><br>

                                    <form id= 'form_email' method= 'post' action = 'controller_editprofile/edit_email'>
                                    <span id="label_email1">Email Address:</span><input type = 'text' id= 'input_email'name = 'new_email' value="<?php echo  $user_details->email?>"><span id = "helpemail"></span><br>
                                    <span>Enter password:</span><input type= 'password' id ='pword_for_email' class="background-white" name ='pword_for_email'required ><br>
                                     <input type='button' id = "cancel_email" value= 'Cancel'>
                                    <input type='submit' disabled= "return false" value= 'Save'>
                                    </form>
                                    
                                    <span>Status:</span><em><?php if(($user_details->status == "approve") || ($user_details->status =="approved")) {echo "approved";}?></em><br/>

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

<!-- This includes script tags for validation of the value input by the user -->
    <script src="<?php echo base_url() ?>js/validation.js"></script>
     <script >
     name = $("#username").text();
    // alert(name);
        $( document ).ready(function(){   
         $('#form_username').hide();
         $('#form_email').hide();
         //if the edit username is clicked, the form for updating the username will be visible
         $("#edit_username").click(function(){
            
            $('#form_username').slideDown();
            $("#input_username").val(name);
            $("#label_username").text("Edit Username");
            $("#username").hide();
            $("#edit_username").hide();

        });
         //cancel edit username
         $("#cancel_username").click(function(){

            $('#form_username').slideUp();
            $("#label_username").text("Username:");
            $("#username").show();
            $("#edit_username").show();

        });
         //for checking if the new username already exist
          $('#input_username').on('blur', validate_new_un);

    function validate_new_un(){

            //validation of the input
            msg= "Invalid input.";
            check= false;
                str= $('#input_username').val().trim();
                $('#input_username').val(str);
                if (str==""){ msg+="Username is required!";
                     $("#helpusername").text(msg);
                }
                else if(str==name){
                    msg+="Enter a new username."
                    $("#helpusername").text(msg);
                }
                else if (!str.match(/^[A-Za-z][A-Za-z0-9._]{2,20}$/)){
                    msg="Invalid characters.";
                
                }
                //if valid, check username availability
                else if(msg="Invalid input"){
                 msg="";
                 if(getResult(str)){
                    return false;
                 }
                 else return true;
                }
                //document.getElementsByName("valUser")[0].innerHTML=msg;
                //ajax for checking if the username already exist
            return false;
    }        

    //to check if the new username is still available
    function getResult(name){
               // var baseurl = <?php echo base_url()?>;
                $('#helpusername').addClass('preloader');
                $("#helpusername").text("Checking availability...");
                $.ajax({
                    url : base_url + 'index.php/user/controller_editprofile/check_username/' + name,
                    cache : false,
                    success : function(response){

                        $('#helpusername').delay(1000).removeClass('preloader');
                        if(response == 'userOk'){
                            $('#helpusername').removeClass('userNo').addClass('userOk');
                            $('#helpusername').text("Username available!");
                            return true;
                           // alert("Username available");
                        }
                        else{
                            $('#helpusername').removeClass('userOk').addClass('userNo');;
                            $("#helpusername").text("Username not available.");
                            return false;
                        }
                    }
                })
            }

         $("#edit_email").click(function(){

            
            $('#form_email').slideDown();
            $("#label_email").text("Edit email");
            $("#email").hide();
            $("#edit_email").hide();

        });
         //cancel edit email
         $("#cancel_email").click(function(){

            $('#form_email').slideUp();
            $("#label_email").text("Email Address:");
            $("#email").show();
            $("#edit_email").show();

        });
          

      });


     </script>
<!-- End of file view_editprofile_error.php -->
<!-- Location: ./application/view/user/view_editprofile_error.php -->
