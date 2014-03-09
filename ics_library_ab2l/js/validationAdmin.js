//edited
 window.onload=function(){
                regForm.adminkey.onblur=validateAdminkey;
                regForm.fname.onblur=validateFname;
                regForm.minit.onblur=validateMinitial;
                regForm.lname.onblur=validateLname;
                regForm.eadd.onblur=validateEmail;
                regForm.uname.onblur=validateUser;
                regForm.pass.onblur=validatePass;
                regForm.cpass.onblur=validateCpass;
                regForm.onsubmit=validateAll;
            }
            
    function validateFname(){
        str=regForm.fname.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="First name is required!";
        else if (!str.match(/^[A-Z|a-z|\s]{3,50}$/))  msg+="Must be between 3-50 alpha character!<br/>";
        else if(msg="Invalid input") msg="";
        document.getElementsByName("helpfname")[0].innerHTML=msg;
        if(msg=="") return true;
    }   
    function validateMinitial(){
        str=regForm.minit.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="Middle Initial is required!";
        else if (!str.match(/^[A-Z]{1,3}$/))  msg+="Must be between 1-3 capital alpha character.<br/>";
        else if(msg="Invalid input") msg="";
        document.getElementsByName("helpmname")[0].innerHTML=msg;
        if(msg=="") return true;
    }
    function validateLname(){
                str=regForm.lname.value;
                msg="Invalid Input: ";
                
                if (str=="") msg+="Last name is required!";
                else if (!str.match(/^[A-Z|a-z\s]{2,50}$/))  msg+="Must be between 2-50 alpha character!<br/>";
                else if(msg="Invalid input") msg="";
                document.getElementsByName("helplname")[0].innerHTML=msg;
                if(msg=="") return true;
            }
    function validateAdminkey(){
                str=regForm.adminkey.value;
                msg="Invalid Input: ";

                if (str==""){
                    msg+="Admin key is required!";
                    document.getElementsByName("helpadminkey")[0].innerHTML=msg;
                }
                else if (!str.match(/^[A-Za-z][A-Za-z0-9._]{7,9}$/)){
                  msg+="Must be between 8-10 alphanumeric character!<br/>";
                    document.getElementsByName("helpadminkey")[0].innerHTML=msg;
                }
                else if(msg="Invalid input"){
                    msg="";
                    document.getElementsByName("helpadminkey")[0].innerHTML=msg;
                    if(getResultAdminKey(str)) msg="";
                }

                if(msg=="") return true;
                else return false;
            }
            
    function validateEmail(){
                str=regForm.eadd.value;
                msg="Invalid Input: ";
            
                if (str=="") msg+="Email is required!";
                else if (!str.match(/^(\w|\.){6,30}\@([0,9]|[a-z]|[A-Z]){3,}\./))  msg+="Must be in the form: name@domain.extension! 'name' should be atleast 6 characters.<br/>";
                else if(msg="Invalid input") msg="";
                document.getElementsByName("helpemail")[0].innerHTML=msg;
                if(msg=="") return true;
            }
    function validateUser(){
                str=regForm.uname.value;
                msg="Invalid Input: ";

                if (str==""){
                    msg+="Username is required!";
                    document.getElementsByName("helpusername")[0].innerHTML=msg;
                }
                else if (!str.match(/^[A-Za-z][A-Za-z0-9._]{4,20}$/)){
                  msg+="Must be between 5-20 characters.<br/>";
                    document.getElementsByName("helpusername")[0].innerHTML=msg;
                }
                else if(msg="Invalid input"){
                    msg="";
                    document.getElementsByName("helpusername")[0].innerHTML=msg;
                    if(getResult(str)) msg="";
                }

                if(msg=="") return true;
                else return false;
            }
    
    function validatePass(){
                str=regForm.pass.value;
                msg="";

                if (str=="") msg+="Password is required!";
                else if (str.length<6) msg+="Password must be atleast 6 characters.";
                else if (str.match(/^([a-z]{5,}|\d{5,})$/))  msg+="Invalid input: Strength: Weak";
                else if (str.match(/^[a-zA-Z]{5,}$/))  msg+="Strength: Medium";
                else if (str.match(/^[a-zA-Z0-9]{5,}$/))  msg+="Strength: Strong";
                else if (str== "") msg="";
                document.getElementsByName("helppassword")[0].innerHTML=msg;
                if(msg!="Invalid input: Minimum of 6 characters!" || msg!="Invalid input: Strength: Weak"  || msg!="Password must be atleast 6 characters.") return true;
                else return false;
        }     
    function validateCpass(){
            str=regForm.pass.value;
            str2=regForm.cpass.value;
            msg="Invalid Input: ";
            
            if(str2=="") msg+="Confirmation of password is required!";
            else if (str2!=str){
                msg+="Password Mismatch"
            }
            else if(msg="") msg="";
            document.getElementsByName("helpcpassword")[0].innerHTML=msg;
            return true;
        }
    function validateAll(){
        if(validateFname()&&validateMinitial()&&validateLname()&&/*validateCollege()&&validateCourse()&&
           validateClassification()&&*/validateEmail()&&validateUser()&&validatePass()&&validateCpass())
        {
            return true;
        }
        else{
            // console.log(validateFname());
            // console.log(validateMinitial());
            // console.log(validateLname());
            // console.log(validateEmail());
            // console.log(validateUser());
            // console.log(validatePass());
            // console.log(validateCpass());
            return false;
        }
    }
