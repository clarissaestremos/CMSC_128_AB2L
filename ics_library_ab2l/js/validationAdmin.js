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
                regForm.add_admin.onclick=validateAll;
            }
            
    function validateFname(){
        str=regForm.fname.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="First name is required!";
        else if (!str.match(/^[A-Za-z|ñ|Ñ][A-Za-z|\.|\-|ñ|Ñ|\s]{1,49}$/))  msg+="Must be between 2-50 alpha characters!<br/>";
        else if(msg=="Invalid Input: ") msg="";
        document.getElementsByName("helpfname")[0].innerHTML=msg;
        if(msg=="") return true;
    }
    function validateMinitial(){
        str=regForm.minit.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="Middle Initial is required!";
        else if (!str.match(/^[a-zA-Z|Ñ|ñ]{1,3}$/))  msg+="Must be between 1-3 alpha characters.<br/>";
        else if(msg=="Invalid Input: ") msg="";
        document.getElementsByName("helpmname")[0].innerHTML=msg;
        if(msg=="") return true;
    }
    function validateLname(){
        str=regForm.lname.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="Last name is required!";
        else if (!str.match(/^[A-Za-z|ñ|Ñ][A-Za-z|\.|\-|ñ|Ñ|\s]{1,49}$/))  msg+="Must be between 2-50 alpha character!<br/>";
        else if(msg=="Invalid Input: ") msg="";
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
        else if (!str.match(/^[A-Za-z0-9][A-Za-z0-9._]{7,9}$/)){
          msg+="Must be between 8-10 alphanumeric character!<br/>";
            document.getElementsByName("helpadminkey")[0].innerHTML=msg;
        }
        else if(msg=="Invalid Input: "){
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
        else if (!str.match(/^[A-Za-z][A-Za-z-0-9\._]{3,20}@[A-Za-z0-9]{3,8}\.[A-Za-z]{3,5}(\.[A-Za-z]{2,3}){0,1}$/))  msg+="Enter valid email.";
        else if(msg="Invalid Input: ") msg="";
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
          msg+="Must be between 5-20 alphanumeric characters.<br/>";
            document.getElementsByName("helpusername")[0].innerHTML=msg;
        }
        else if(msg=="Invalid Input: "){
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
        else if(str.length<5) msg+= "Password must be atleast 5 alpha-numeric characters."
        else if (str.match(/^[a-z]{5,20}$/))  msg+="Invalid Input: Strength: Weak";
        else if (str.match(/^[a-zA-Z]{5,20}$/))  msg+=" Strength: Medium";
        else if (str.match(/^[a-zA-Z0-9]{5,20}$/))  msg+="Strength: Strong";
        else if (msg=="") msg="Invalid Input: Strength: Weak";

        document.getElementsByName("helppassword")[0].innerHTML=msg;
        if(msg === "Strength: Strong" || msg === "Strength: Medium"){
            return true;
        }
        else return false;
    }     
    function validateCpass(){
        str=regForm.pass.value;
        str2=regForm.cpass.value;
        msg="";
        
        if(str2=="") msg+="Invalid Input: Confirmation of password is required!";
        else if (str2!=str){
            msg+="Invalid Input: Password Mismatch"
        }
        else if(msg=="") msg="";
        document.getElementsByName("helpcpassword")[0].innerHTML=msg;
        if(msg!="") return false;
        return true;
    }
    function validateAll(){
        if(validateAdminkey() && validateFname()&&validateMinitial()&&validateLname()&&validateEmail()&&validateUser()&&validatePass()&&validateCpass())
        {
            return true;
        }
        else{
            return false;
        }
    }
