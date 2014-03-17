    var toggle="false";
       $( document ).ready(function(){   

       if(toggle == "false"){
        $('#form_password').hide();
       }

         //for checking if the new username already exist
          $('#current_password').on('blur', validate_password);
           $('#new_password').on('blur', validate_new_password);
           $('#confirm_password').on('blur', validate_confirm_password);


   window.validate_passwords = function() { 

        if(validate_password() && validate_new_password() && validate_confirm_password()){
            return true;
        }
        else return false;
   }

 
         function validate_password(){
               str=$("#current_password").val();
                msg="";

                if (str=="") msg+="Password is required!";
                else if(str.length<5) msg+= "Password must be atleast 5 characters."
               
                $("#helppassword").text(msg);
                if(msg==""){
              
                  return true;

                }
                else return false;
        }  

        function validate_new_password(){
                str=$("#new_password").val();
                msg="";

                if (str=="") msg+="Password is required!";
                else if(str.length<5) msg+= "Password must be atleast 5 alpha-numeric characters."
                else if (str.match(/^[a-z]{5,20}$/))  msg+="Invalid Input: Strength: Weak";
                else if (str.match(/^[a-zA-Z]{5,20}$/))  msg+=" Strength: Medium";
                else if (str.match(/^[a-zA-Z0-9]{5,20}$/))  msg+="Strength: Strong";
                else if (msg=="") msg="Invalid Input: Special characters are not allowed";

              $("#helpnewpassword").text(msg);
                if(msg === "Strength: Medium" || msg==="Strength: Strong"){
                  $('#helpnewpassword').removeClass('color-red');
                  $('#helpnewpassword').removeClass('validmsg');
                  $('#helpnewpassword').addClass('userOk');
                  $('#helpnewpassword').css("font-weight", "bold");
                 
                  return true;
                }

                else {
                  $('#helpnewpassword').addClass('color-red');
                  $('#helpnewpassword').addClass('validmsg');
                  return false;
                }
        }       
    function validate_confirm_password(){
            str=$("#new_password").val();
            str2=$("#confirm_password").val();
            msg="Invalid Input: ";
            
            if(str2=="") msg+="Confirmation of password is required!";
            else if (str2!=str){
                msg+="Password Mismatch"
            }
            else if(msg="Invalid Input: ") msg="";
            $("#helpcpassword").text(msg);
            if(msg==""){
             
              return true;
            }
            else return false;
        }     

       
         $("#edit_password").click(function(){      
          
           if(toggle== false){
               $('#form_password').slideDown();
               toggle= true
           }
           else{
                 $('#form_password').slideUp();
                 toggle= false;
           }

        });
         //cancel edit email
         $("#cancel_password").click(function(){
            toggle= false;
             $('#form_password').slideUp();
        
        });


          

      });