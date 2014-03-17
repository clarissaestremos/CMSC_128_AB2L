$(document).ready(function() {
$('#courseDiv').hide();
$('#collegeDiv').hide();
$('#numDiv').hide();	
});


function checker(){

$(".valClass").text("");
var selected = document.getElementById('classi').value;
var collegeBox = document.getElementById('college')
var NumBox = document.getElementById('stdNum');
var NumLabel = document.getElementById('labelNum');

$('#collegeDiv').show();
$('#numDiv').show();

if(selected === 'faculty'){
	collegeBox.disabled = false;
	NumBox.disabled = false;
	NumLabel.innerHTML = 'Employee Number (XXXXXXXXXX): ';
	NumLabel.placeholder = 'Your Faculty Number: ';
$('#courseDiv').hide();

}
else{
	collegeBox.disabled = false;
	NumBox.disabled = false;
	NumLabel.innerHTML = 'Student Number (XXXX-XXXXX): ';
	NumLabel.placeholder = 'Your Student Number: ';
	
	$('#courseDiv').show();
}


} 



			 $( document ).ready(function(){   
			 
				window.getResult = 	function (name){
				// var baseurl = <?php echo base_url()?>;
					var bool= false;
					$('#span_un').append("<span id = 'helpusername'></span>");
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
										
									bool= true;
								}
								else{
										$('#helpusername').removeClass('userOk').addClass('color-red');;
										$("#helpusername").text("Username not available.");
									 bool= false;
								}
							}
					})
					return bool;
				}

				 window.getResultAdminKey = 	function (key){
					// var baseurl = <?php echo base_url()?>;
					var bool= false;
					$('#span_ak').append("<span id = 'helpadminkey'></span>");
					$("#helpadminkey").text("Checking availability...");
					$.ajax({
						url : base_url + 'index.php/admin/controller_add_admin/check_admin_key/' + key,
						cache : false,
						async:false,
						success : function(response){
							$('#helpadminkey').delay(1000).removeClass('preloader');
							if(response == 'userOk'){
									$('#helpadminkey').removeClass('userNo').addClass('userOk');
									$('#helpadminkey').text("Admin Key available!");
									
								bool= true;
							}
							else{
									$('#helpadminkey').removeClass('userOk').addClass('color-red');;
									$("#helpadminkey").text("Admin Key not available.");
								 bool= false;
							}
						}
					})
					return bool;
				}

				window.getResultStdNo =  function (key){
					 // var baseurl = <?php echo base_url()?>;
					 var bool= false;
						$('#span_snum').append("<span id = 'helpstdno'></span>");
						$("#helpstdno").text("Checking availability...");
						$.ajax({
							url : base_url + 'index.php/admin/controller_add_user/check_std_no/' + key,
							cache : false,
							async:false,
							success : function(response){
								$('#helpstdno').delay(1000).removeClass('preloader');
								if(response == 'userOk'){
										$('#helpstdno').removeClass('userNo').addClass('userOk');
										$('#helpstdno').text("Student Number available!");
										
									bool= true;
								}
								else{
										$('#helpstdno').removeClass('userOk').addClass('color-red');;
										$("#helpstdno").text("Student Number not available.");
									 bool= false;
								}
							}
						})
						return bool;

				}

				 window.getResultENo =  function (key){
					// var baseurl = <?php echo base_url()?>;
					var bool= false;
					$('#span_snum').append("<span id = 'helpeno'></span>");
					$("#helpeno").text("Checking availability...");
					$.ajax({
						url : base_url + 'index.php/admin/controller_add_user/check_std_no/' + key,
						cache : false,
						async:false,
						success : function(response){
							$('#helpeno').delay(1000).removeClass('preloader');
							if(response == 'userOk'){
									$('#helpeno').removeClass('userNo').addClass('userOk');
									$('#helpeno').text("Employee Number available!");
									
								bool= true;
							}
							else{
									$('#helpeno').removeClass('userOk').addClass('color-red');;
									$("#helpeno").text("Employee Number not available.");
								 bool= false;
							}
						}
					})
					return bool;
				}

			 })



function courseChecker(){
var selected = document.getElementById('college').value;
var obj = document.getElementById('course')
obj.disabled = false;
var length = obj.options.length;
msg="Invalid Input: ";


while (obj.hasChildNodes())
		obj.removeChild(obj.firstChild);

if(selected == "default"){
	msg+="College is required!";
	
}

else{
	obj.options[obj.options.length] = new Option("Select Course","default", false, false);
	obj.options[0].disabled= true;
		if(selected === 'CA'){
			
			obj.options[obj.options.length] = new Option("BSA","BSA");
			obj.options[obj.options.length] = new Option("BSFT","BSFT");
			obj.options[obj.options.length] = new Option("BSAB","BSAB");
			obj.options[obj.options.length] = new Option("BSAC","BSAC");
			
		}
		else if(selected === 'CAS'){
			obj.options[obj.options.length] = new Option("BACA","BACA");
			obj.options[obj.options.length] = new Option("BA Philo","BA Philo");
			obj.options[obj.options.length] = new Option("BA Socio","BA Socio");
			obj.options[obj.options.length] = new Option("BS AMATH","BS AMATH");

			obj.options[obj.options.length] = new Option("BS APHY","BS APHY");
			obj.options[obj.options.length] = new Option("BS BIO","BS BIO");
			obj.options[obj.options.length] = new Option("BS CHEM","BS CHEM");
			obj.options[obj.options.length] = new Option("BSCS","BSCS");

			obj.options[obj.options.length] = new Option("BS MATH","BS MATH");
			obj.options[obj.options.length] = new Option("BS MST","BS MST");
			obj.options[obj.options.length] = new Option("BS STAT","BS STAT");
		}
		else if(selected === 'CDC'){
			obj.options[obj.options.length] = new Option("BSDC","BSDC");
		}
		else if(selected === 'CEAT'){
			obj.options[obj.options.length] = new Option("BS ABE","BS ABE");
			obj.options[obj.options.length] = new Option("BSChemE","BSChemE");
			obj.options[obj.options.length] = new Option("BSCE","BSCE");
			obj.options[obj.options.length] = new Option("BSEE","BSEE");

			obj.options[obj.options.length] = new Option("BSIE","BSIE");
		}
		else if(selected === 'CEM'){
			obj.options[obj.options.length] = new Option("BS AE","BS AE");
			obj.options[obj.options.length] = new Option("BSE","BSE");
			obj.options[obj.options.length] = new Option("BSAM","BSAM");

		}
		else if(selected === 'SESAM'){
			obj.options[obj.options.length] = new Option("PhD EnSci","PhD EnSci");
			obj.options[obj.options.length] = new Option("MS EnSci","MS EnSci");
		}
		else if(selected === 'CFNR'){
			obj.options[obj.options.length] = new Option("BSF","BSF");

		}
		else if(selected === 'CHE'){
		obj.options[obj.options.length] = new Option("BSHE","BSHE");
		obj.options[obj.options.length] = new Option("BSN","BSN");

		}
		else if(selected === 'GS'){

		}
		else if(selected === 'CPaf'){

		}
		else if(selected === 'CVM'){
		obj.options[obj.options.length] = new Option("DVM","DVM");
		obj.options[obj.options.length] = new Option("MSVM","MSVM");
		obj.options[obj.options.length] = new Option("MSV","MSV");
		}
}
if(selected != "default"){
	msg= "";
}
 document.getElementsByName("valCollege")[0].innerHTML=msg;
 if(selected != "default"){
	return false;
}
return true;
//alert(checker);
}
