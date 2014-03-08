
var currentSelection = 0;
var currentUrl = '';
var showResultInBody;
var checkIfClicked=false;
var sinput;
var category;
var searchform;
/**
	For navigating through autosuggest list using up and down keys
*/
$(window).keydown(function Event(e) {
		switch(e.keyCode) { 
			// User pressed "up" arrow
			case 38:
				e.preventDefault();		//prevents the page from scrolling
				//alert('up');
				navigate('up');
			break;
			// User pressed "down" arrow
			case 40:
				//alert('down');
				e.preventDefault();
				navigate('down');
			break;
			// User pressed "enter"
			case 13:
				if(sinput != '') {
					$("#sinput").val(sinput);	//sets current value
					$("#autosuggest_list").hide();	
					$("#basicSearch").focus();		//focuses on the submit button
				}
			break;
		}
		// Add data to let the hover know which index they have
		for(var i = 0; i < $("#selectItems ul li a").size(); i++) {
		$("#selectItems ul li a").eq(i).data("number", i);
		}
	
		// Simulote the "hover" effect with the mouse
		$("#selectItems ul li a").hover(
			function () {
				$("#selecItems").focus();
				currentSelection = $(this).data("number");
				setSelected(currentSelection);
			}, function() {
				$("#selecItems").focus();
				$("#selectItems ul li a").removeClass("itemhover");
				sinput = '';
			});
});
/*
	Function that hovers through the autosuggest list
*/
function navigate(direction) {
	$('#sinput').blur();		//removes focus from textbox
	$('#selectItems').focus(function(e){	//unbinds keydown
		$(document).unbind('keydown');
		return true;
	});
	$("#list_area").css("opacity","1");		//
	// Check if any of the menu items is selected
	if($("#selectItems ul li .itemhover").size() == 0) {
		currentSelection = -1;
	}
	if(direction == 'up' && currentSelection != -1) {
		if(currentSelection != 0) {
			currentSelection--;
		}
	} else if (direction == 'down') {
		if(currentSelection != $("#selectItems ul li").size() -1) {
			currentSelection++;
		}
	}
	setSelected(currentSelection);
}
function autosuggest(str, category, user){
	sinput=str;
	$('#sinput').attr('autocomplete','off');
	$('#sinput').bind('keypress', function(event){ 
		if(event.keyCode == 13){ 
			$("#basicSearch").focus();
			return false;
		}
	});
	if (str.length == 0) {
		$('#autosuggest_list').fadeOut(500);
	}
	else {
	   	// Ajax request to CodeIgniter controller "ajax" method "autosuggest"
	    // post the str parameter value
	    $.ajax({
		url: base_url+"index.php/"+user+"/controller_search_book/autosuggest",					//no need to edit this
		type: 'POST',
		async: true,
		data:{
		'str':str,
		'category':category },
		success: function(result){
			if(result==""){				//hides the list if result is an empty string
				$('#autosuggest_list').hide();
			}else{						//displays result.
				$('#autosuggest_list').html(result);
				$('#autosuggest_list').show();
			}
		}
		});
	}
}
function showAutoSuggestResultinBody(str,user,form,clicked){
	var size=str.length;
	if(showResultInBody && !checkIfClicked){
		$('#list_area').css("opacity",".5");
		showResultInBody=false;
	}
	if(size % 5 == 0 || size % 2 == 0 || size % 3 == 0){
		if (size==0){
			$('#list_area').fadeOut();
		}else if(size >5 || size>=15){
			$('#list_area').css("opacity","1");
			get_data(user, form, clicked);
			showResultInBody=true;
		}
	}
}

// triggered by an onclick from any of the li's in the autosuggest list
// wait and fade the autosuggest list
// then display the activity details
function setSelected(menuitem) {
	$("#selectItems ul li a").removeClass("itemhover");
	$("#selectItems ul li a").eq(menuitem).addClass("itemhover");
	sinput = $("#selectItems ul li").eq(menuitem).attr('id');
	changed=true;
}
function setActivity(name, form){
	$("#sinput").val(name);
	$("#autosuggest_list").hide();
	$("#basicSearch").focus();
	get_data(name, form, false);
}

//get the data of the books after clicking the search button
function get_data(str, str2, clicked){
	var flag = true;
	checkIfClicked=clicked;
	searchform = str2;
	if(checkIfClicked){
		$('#list_area').css("opacity","1");
	}
	if(str2 == 'search_form'){
		sinput = $('#sinput').val();
		category = $('#category').val();
		if(sinput == ""){
			flag = false;
		}
	}
	else{
		title = $('#title').val();
		author = $('#author').val();		
		subject = $('#subject').val();
		year_of_pub = $('#year_of_pub').val();		
		tag_name = $('#tag_name').val();		
	}
	$('#autosuggest_list').fadeOut(500);
	$('#list_area').addClass('loading');
	if(flag){
		$.ajax({
			//url: "http://localhost/zurbano_module/index.php/controller_search_book/get_book_data",		//EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
		url: base_url+"index.php/"+str+"/controller_search_book/get_book_data",		//EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
		
	//		url: "http://localhost/kebench/index.php/search/get_book_data",
		type: 'POST',
		async: true,
		data: serialize_form(),
		success: function(result){
			$('#list_area').html(result);
			$('#list_area').fadeIn(1000);
			$('#list_area').removeClass('loading');
		}
		});

		
	}
}

//serializes the form enebling all the inputs to have a value of an empty string if forms.value is equal to " ".
//This will be used in sending data inputs in Ajax
function serialize_form()
{
	if(searchform == 'search_form'){
		$('#sinput').val(sinput);
		$('#category').val(category);
	}else{
		$('#title').val(title);
		$('#author').val(author);		
		$('#subject').val(subject);
		$('#year_of_pub').val(year_of_pub);		
		$('#tag_name').val(tag_name);
	}
	return $("#"+searchform).serialize();
}
