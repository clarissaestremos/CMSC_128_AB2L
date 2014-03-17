function validatePasswordeEmail(){
     str=$("#pword_for_email").val();
       
        msg="";

        if (str=="") msg+="Password is required!";
        else if(str.length<5) msg+= "Password must be atleast 5 alpha-numeric characters."
        else msg= "";
        $('#pword_email_help').text(msg);
        msg= msg.trim();
        if(msg== ""){
            return true;
        }
        return false;
}

$( document ).ready(function(){   
       
         
         //for checking if the new username already exist
          $('#input_email').on('blur', validate_new_email);


   window.validate_email = function() { 

        if(window.validatePasswordeEmail()){
            return bool =validate_new_email();
        }
        else return false;
   }

    function validate_new_email(){

            //validation of the input
            msg= "Invalid input.";
            check= false;
                str= $('#input_email').val().trim();
                $('#input_email').val(str);
                if (str==""){ msg+="Username is required!";
                     $("#helpemail").text(msg);
                }
                else if(str==prev_email){
                    msg+="Enter a new email."
                    $("#helpemail").text(msg);
                }
               else if (!str.match(/^[A-Za-z][A-Za-z-0-9_\.]{3,20}@[A-Za-z]{3,8}\.[A-Za-z]{3,5}$/)){
                    msg="invalid email.";
                    $("#helpemail").text(msg);
                }
                //if valid, check username availability
                else if(msg="Invalid input"){
                 msg="";
                    $("#helpemail").text(msg);
                    return true;
                }
                //document.getElementsByName("valUser")[0].innerHTML=msg;
               
            //ajax for checking if the username already exist
            return false;  
           
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