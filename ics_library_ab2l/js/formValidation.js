	window.onload=function(){
	

				regForm.fname.onblur=validateFname;
				regForm.minit.onblur=validateMinitial;
				regForm.lname.onblur=validateLname;
				regForm.stdNum.onblur=validateNumber;
				regForm.classi.onblur=validateClassification;
				regForm.eadd.onblur=validateEmail;
				regForm.uname.onblur=validateUser;
				regForm.pass.onblur=validatePass;
				regForm.cpass.onblur=validateCpass;
				
			}
			
	function validateFname(){
		str=regForm.fname.value;
		msg="Invalid Input: ";
		
		if (str=="") msg+="First name is required!";
		else if (!str.match(/^[A-Za-z|\.|\-|ñ|Ñ|\s]{2,50}$/))  msg+="Must be between 2-50 alpha characters!<br/>";
		else if(msg="Invalid input") msg="";
		document.getElementsByName("valFname")[0].innerHTML=msg;
		if(msg=="") return true;
	}	
	function validateMinitial(){
		str=regForm.minit.value;
		msg="Invalid Input: ";
		
		if (str=="") msg+="Middle Initial is required!";
		else if (!str.match(/^[a-zA-Z|Ñ]{1,3}$/))  msg+="Must be between 1-3 alpha characters.<br/>";
		else if(msg="Invalid input") msg="";
		document.getElementsByName("valInitial")[0].innerHTML=msg;
		if(msg=="") return true;
	}
	function validateLname(){
		str=regForm.lname.value;
		msg="Invalid Input: ";
		
		if (str=="") msg+="Last name is required!";
		else if (!str.match(/^[A-Z|a-z\.|\-|\s|ñ|Ñ]{2,50}$/))  msg+="Must be between 2-50 alpha character!<br/>";
		else if(msg="Invalid input") msg="";
		document.getElementsByName("valLname")[0].innerHTML=msg;
		if(msg=="") return true;
	}
	function validateNumber(){
		str=regForm.stdNum.value;
		flag  = document.getElementById("classi").value;
		
		msg="Invalid Input: ";
		if(flag==="student"){
			if (str==""){
			msg+="Student number is required!";
				document.getElementsByName("valNumber")[0].innerHTML=msg;
			}
			else if (!str.match(/^[0-9]{4}\-[0-9]{5}$/)){
			  msg+="Must be xxxx-xxxxx";
				document.getElementsByName("valNumber")[0].innerHTML=msg;
			}
			else if(msg="Invalid input"){
				msg="";
				document.getElementsByName("valNumber")[0].innerHTML=msg;
				if(getResultStdNo(str)) msg="";
			}
		}
		else{
			if (str==""){
			msg+="Employee Number is required!";
				document.getElementsByName("valNumber")[0].innerHTML=msg;
			}
			else if (!str.match(/^[0-9]{10}$/)){
			  msg+="Must be 10 numeric characters!";
				document.getElementsByName("valNumber")[0].innerHTML=msg;
			}
			else if(msg="Invalid input"){
				msg="";
				document.getElementsByName("valNumber")[0].innerHTML=msg;
				if(getResultENo(str)) msg="";
			}
		}

		if(msg=="") return true;
		else return false;

	}
	function validateCollege(){
		str=regForm.college.value;
		msg="Invalid Input: ";
		
		if (str=="") msg+="College is required!";
		else if (!str.match(/^[A-Z]{2,4}$/))  msg+="Must be an acronym!<br/>";
		else if(msg="Invalid input") msg="";
		document.getElementsByName("valCollege")[0].innerHTML=msg;
		if(msg=="") return true;
	}
	function validateCourse(){
		str=regForm.course.value;
		msg="Invalid Input: ";
		
		if (str=="") msg+="Course is required!";
		else if (!str.match(/^[A-Z]{4,8}$/))  msg+="Must be an acronym!<br/>";
		else if(msg="Invalid input") msg="";
		document.getElementsByName("valCourse")[0].innerHTML=msg;
		if(msg=="") return true;
	}
	function validateClassification(){
		str=regForm.classi.value;
		msg="Invalid Input: ";
		
		if (str=="") msg+="Classification is required!";
		else if (!str.match(/^(student|faculty)$/))  msg+="Must be a student or faculty!<br/>";
		else if(msg="Invalid input") msg="";
		//document.getElementsByName("valClass")[0].innerHTML=msg;
		if(msg=="") return true;
	}	
			
	function validateEmail(){
		str=regForm.eadd.value;
		msg="Invalid Input: ";

		if (str=="") msg+="Email is required";
		else if (!str.match( /^[A-Za-z][A-Za-z-0-9\._]{3,20}@[A-Za-z]{3,8}\.[A-Za-z]{3,5}$/))  msg+="Enter valid email!";
		else if(msg="Invalid input") msg="";
		document.getElementsByName("valEmail")[0].innerHTML=msg;
		if(msg=="") return true;
	}
	function validateUser(){
		str=regForm.uname.value;
		msg="Invalid Input: ";
		

		if (str==""){
			msg+="Username is required!";
			document.getElementsByName("valUser")[0].innerHTML=msg;
		}
		else if (!str.match(/^[A-Za-z][A-Za-z0-9._]{4,20}$/)){
		  msg+="Must be between 5-20 characters.<br/>";
			document.getElementsByName("valUser")[0].innerHTML=msg;
		}
		else if(msg="Invalid input"){
			msg="";
			document.getElementsByName("valUser")[0].innerHTML=msg;
			if(getResult(str)) msg="";
		}

		if(msg=="") return true;
		else return false;

	}
	
	function validatePass(){
		str=regForm.pass.value;
		msg="";

		if (str=="") msg+="Password is required!";
		else if(str.length<5) msg+= "Password must be atleast 5 characters."
		else if (str.match(/^[a-z]{5,20}$/))  msg+="Strength: Weak";
		else if (str.match(/^[a-zA-Z]{5,20}$/))  msg+=" Strength: Medium";
		else if (str.match(/^[a-zA-Z0-9]{5,20}$/))  msg+="Strength: Strong";
		else if(msg="") msg="";
		document.getElementsByName("valPass")[0].innerHTML=msg;
		if(msg!= "Password is required!" || msg!= "Password must be atleast 5 characters." || msg!= "Strength: Weak" ) return true;
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
		document.getElementsByName("valCpass")[0].innerHTML=msg;
		if(msg==='Invalid Input: Password Mismatch')
			return false;

		return true;
	}
	function validateAll(){
		flag  = document.getElementById("classi").value;
		console.log(flag);
		if(validateFname()&&validateMinitial()&&validateLname()&&validateNumber()&&validateClassification()&&validateEmail()&&validateUser()&&validatePass()&&validateCpass())
		{
			// if(flag==='student'){
			// 	return true;
			// }
			// else if(flag==='faculty'){
				return true;
			// }
		}
		else{return false;}
	return true;
	}

