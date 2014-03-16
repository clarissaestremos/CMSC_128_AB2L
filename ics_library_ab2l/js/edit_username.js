       $( document ).ready(function(){   
       
          if(error_username == '' &&  error_email == ''){

                $('#form_username').hide();
                $('#form_email').hide();

          }
          else if( error_username== "error"){
                $('#form_username').show();
                $("#label_username").text("Edit Username");
                $("#username").hide();
                $('#form_email').hide();
                 $("#edit_username").hide();
          }
          else if(error_email== ""){
                $('#form_username').hide();
                $('#form_email').hide();
          }
          else if(error_email== "error"){
                $('#form_email').show();
                $("#label_email").text("Edit email address");
                $("#email").hide();
                $('#form_username').hide();
                $("#edit_email").hide();

          }
                     if(error_password!= ""){
                  $('#form_password').show();
                  toggle= true;
          }
        else{
                  $('#form_password').hide();
                  toggle= false;
          }

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


   window.validate_username = function() { 

        if($("#pword_for_username").val().trim()!= ""){
            return bool =validate_new_un();
        }
        else return false;
   }

    function validate_new_un(){

            //validation of the input
            msg= "Invalid input.";
            check= false;
                str= $('#input_username').val().trim();
                $('#input_username').val(str);
                if (str==""){ msg+="Username is required!";
                     $("#helpusername").text(msg);
                     $("#helpusername").css("color", "red");
                     $("#helpusername").css("font-weight", "bold");
                }
                else if(str==name){
                    msg+="Enter a new username."
                    $("#helpusername").text(msg);
                     $("#helpusername").css("color", "red");
                     $("#helpusername").css("font-weight", "bold");
                }
                else if (!str.match(/^[A-Za-z][A-Za-z0-9._]{4,20}$/)){
                    msg="Invalid characters.";
                   $("#helpusername").text(msg);
                    $("#helpusername").css("color", "red");
                    $("#helpusername").css("font-weight", "bold");
                }
                //if valid, check username availability
                else if(msg="Invalid input"){
                 msg="";
                 if(getResult(str)){
                    return true;
                 }
                 else return false;
                }
                //document.getElementsByName("valUser")[0].innerHTML=msg;
               
            //ajax for checking if the username already exist
            return false;  
           
    }        

    //to check if the new username is still available
    function getResult(name){
               // var baseurl = <?php echo base_url()?>;
               var bool= false;
                $('#helpusername').addClass('preloader');
                $("#helpusername").text("Checking availability...");
                $.ajax({
                    url : base_url + 'index.php/user/controller_editprofile/check_username/' + name,
                    cache : false,
                    async:false,
                    success : function(response){

                        $('#helpusername').delay(1000).removeClass('preloader');
                        if(response == 'userOk'){
                            $('#helpusername').removeClass('userNo').addClass('userOk');
                            $('#helpusername').text("Username available!");
                            $("#helpusername").css("color", "green");
                            $("#helpusername").css("font-weight", "bold");
                          bool= true;
                        }
                        else{
                            $('#helpusername').removeClass('userOk').addClass('userNo');;
                            $("#helpusername").text("Username not available.");
                            $("#helpusername").css("color", "red");
                            $("#helpusername").css("font-weight", "bold");
                           bool= false;
                        }
                    }
                })

              
                return bool;

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