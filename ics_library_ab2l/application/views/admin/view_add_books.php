<script>
                        window.onload=function(){
                            //
                            myform.title1.onblur=validate_title;
                            myform.author.onblur=validate_author;
                            myform.callno.onblur=validate_call_no;
                            myform.isbn.onblur=validate_isbn_key;
                            myform.year_of_pub.onblur=validate_year_pub;
                            myform.onsubmit=process_add;
                        }
                              
                        function checker(){

                        var selected = document.getElementById('type_book').value;

                        if(selected === 'BOOK')
                            $('#isbn_div').show();
                        
                        else
                            $('#isbn_div').hide();

                        } 
  

                        function validate_title() {
                            msg="Invalid input: ";
                            str=myform.title1.value;
                                
                            if(str=="")
                            msg+="Title is required!<br/>";
                            if(!str.match(/^[A-Z0-9a-z]+\ ?[A-Z|a-z|0-9|ñ|Ñ\ ]*$/))
                            msg+="Must be between 1-100 alpha numeric character!<br/>";
                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_title")[0].style.fontSize="10px";
                                document.getElementsByName("help_title")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_title")[0].style.color="red";
                            }
                            document.getElementsByName("help_title")[0].innerHTML=msg;
                            if(msg=="")
                                return true;
                        }


                        function validate_author() {
                            msg="Invalid input: ";
                            str=myform.author.value;
                                
                            if(str=="")
                            msg+="Author is required!<br/>";
                            if(!str.match(/^[a-zA-Z]+\.?\,?\ ?[a-zA-Z\ ]*\.?$/))
                            msg+="Must be between 1-100 alpha character!<br/>";
                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_author")[0].style.fontSize="10px";
                                document.getElementsByName("help_author")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_author")[0].style.color="red";
                            }
                            document.getElementsByName("help_author")[0].innerHTML=msg;
                            if(msg=="")
                                return true;
                        }

            
                        function validate_subject() {
                            console.log(document.getElementsByName('subject[]'));
                            subjects=document.getElementsByName("subject[]")[0].selectedOptions.length;
                            // console.log(subjects);
                            document.getElementsByName("help_subject")[0].innerHTML="";
                            if(subjects>0)
                                return true;
                            document.getElementsByName("help_subject")[0].innerHTML="Subject is required! Select at least one."
                            return false;
                        }

                        function validate_call_no() {
                            msg="Invalid input: ";
                            str=myform.callno.value;
                                
                            if(str=="")
                            msg+="Call number is required!<br/>";
                            if(!str.match(/^[a-zA-Z0-9\ \.\-]+[a-zA-Z0-9\ \.\-]*$/))
                            msg+="Must be between 1-20 alpha numeric character!<br/>";
                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_call_number")[0].style.fontSize="10px";
                                document.getElementsByName("help_call_number")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_call_number")[0].style.color="red";
                            }
                            document.getElementsByName("help_call_number")[0].innerHTML=msg;
                            if(msg=="")
                                return true;
                        }
                        
                        function validate_isbn_key(){
                            var selected = document.getElementById('type_book').value;
                            if(selected != "BOOK") return true;

                            msg="";
                            str=myform.isbn.value;
                            if(str==""){
                                msg+="Invalid input: ISBN is required!";
                            }
                            else if(!str.match(/^[0-9][0-9\-]+[0-9]$/))
                                msg+="Invalid input: Must start and end in number and 13 digits.<br/>";
                            else if(str != "" && !getResultIsbn(str)){
                                 msg+="ISBN alreay exist."
                            }
                            else if(str != ""  && getResultIsbn(str))
                            msg="";
                            
                            else {
                                document.getElementsByName("help_isbn_key")[0].style.fontSize="10px";
                                document.getElementsByName("help_isbn_key")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_isbn_key")[0].style.color="red";
                            }
                            document.getElementsByName("help_isbn_key")[0].innerHTML=msg;

                            if(msg=="")
                                return true;
                        }



                        function validate_year_pub() {
                            msg="Invalid input: ";
                            str=myform.year_of_pub.value;
                                
                            if(str=="")
                            msg+="Year of Publication is required!<br/>";
                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_year_of_pub")[0].style.fontSize="10px";
                                document.getElementsByName("help_year_of_pub")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_year_of_pub")[0].style.color="red";
                            }
                            document.getElementsByName("help_year_of_pub")[0].innerHTML=msg;
                            if(msg=="")
                                return true;
                        }
                        
                        
                        
                        $( document ).ready(function(){   
                         window.getResultIsbn =  function (key){
                             // var baseurl = <?php echo base_url()?>;
                            var bool= false;
                             
                                $('#help_isbn_key').append("<span id = 'helpkey'></span>");
                                $("#helpkey").text("Checking availability...");
                                $.ajax({
                                        url : base_url + 'index.php/admin/controller_book/check_isbn/' + key,
                                        cache : false,
                                        async:false,
                                        success : function(response){

                                                $('#helpekey').delay(1000).removeClass('preloader');
                                                if(response.trim() == 'userOk'){
                                                        //$('#helpekey').removeClass('userNo').addClass('userOk');
                                                       // $('#helpekey').text("I available!");
                                                        
                                                    bool= true;

                                                }
                                                else{
                                                       // $('#helpekey').removeClass('userOk').addClass('color-red');;
                                                        //$("#helpekey").text("ISBN already exist.");
                                                     bool= false;
                                                }
                                        }
                                })

                            
                                return bool;

                        }

                    })
                        
                        function process_add() {
                            if (validate_title() && validate_author() && validate_subject() && validate_call_no() && validate_year_pub() && validate_isbn_key()) {
                                <?php
                                    if(isset($_POST['submit'])){
                                        
                                    }
                                ?>
                            }
                            else 
                                return false;
                        }

                        function addRow_author(element, indentFlag){
                            var maxFieldWidth = "500";
                            var elementClassName = element.className; // this is the class name of the button that was clicked
                            var fieldNumber = elementClassName.substr(3, elementClassName.length);

                            var newFieldNumber = ++fieldNumber;
                            var rowContainer = element.parentNode; // get the surrounding div so we can add new elements

                            // create text field
                            var textfield = document.createElement("input");
                            textfield.type = "text";
                            textfield.setAttribute("name","author[]");
                            textfield.setAttribute("placeholder","Author's Name");
                            textfield.setAttribute("required","required");
                            textfield.setAttribute("class","background-white authors");

                            // create buttons
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Author");
                            button1.setAttribute("onclick", "addRow_author(this, false)");
                            button1.className = "row" + newFieldNumber;


                            // add elements to page
                            //
                            rowContainer.appendChild(textfield);
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(document.createTextNode(" ")); // add space
                            rowContainer.appendChild(button1);
                            rowContainer.appendChild(document.createElement("BR")); // add line break
                            rowContainer.appendChild(document.createElement("BR")); // add line break

                        }

                        function addRow_callno(element, indentFlag){
                            var maxFieldWidth = "500";
                            var elementClassName = element.className; // this is the class name of the button that was clicked
                            var fieldNumber = elementClassName.substr(3, elementClassName.length);

                            var newFieldNumber = ++fieldNumber;
                            var rowContainer = element.parentNode; // get the surrounding div so we can add new elements

                            // create text field
                            var textfield = document.createElement("input");
                            textfield.type = "text";
                            textfield.setAttribute("name","call_number[]");
                            textfield.setAttribute("placeholder","Call Number of the Book");
                            textfield.setAttribute("required","required");
                            textfield.setAttribute("class","background-white call_nos");

                            // create buttons
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Copy");
                            button1.setAttribute("onclick", "addRow_callno(this, false)");
                            button1.className = "row" + newFieldNumber;


                            // add elements to page
                            //
                            rowContainer.appendChild(textfield);
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(document.createTextNode(" ")); // add space
                            rowContainer.appendChild(button1);
                            rowContainer.appendChild(document.createElement("BR")); // add line break
                            rowContainer.appendChild(document.createElement("BR")); // add line break

                        }

                        function addRow_tags(element, indentFlag){
                            var maxFieldWidth = "500";
                            var elementClassName = element.className; // this is the class name of the button that was clicked
                            var fieldNumber = elementClassName.substr(3, elementClassName.length);

                            var newFieldNumber = ++fieldNumber;
                            var rowContainer = element.parentNode; // get the surrounding div so we can add new elements

                            // create text field
                            var textfield = document.createElement("input");
                            textfield.type = "text";
                            textfield.setAttribute("name","tag[]");
                            textfield.setAttribute("placeholder","Tags");
                            textfield.setAttribute("class","background-white tag");

                            // create buttons
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Tags");
                            button1.setAttribute("onclick", "addRow_tags(this, false)");
                            button1.className = "row" + newFieldNumber;


                            // add elements to page
                            //
                            rowContainer.appendChild(textfield);
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(document.createTextNode(" ")); // add space
                            rowContainer.appendChild(button1);
                            rowContainer.appendChild(document.createElement("BR")); // add line break
                            rowContainer.appendChild(document.createElement("BR")); // add line break

                        }
</script>
<div id="thisbody" class="body width-fill background-white">
                    <div class="col">
                            <div class="cell">
                                    <div class="page-header cell">
                                        <h1>Admin <small>Add Books</small></h1>
                                    </div>
                                <div class="col width-fill">
                                    <div class="col">
                                        <?php
                                            if(isset($message)){
                                        ?>
                                        <div>
                                            <?php echo $message; ?>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="cell panel">
                                            <div class="header background-red">
                                                Admin Add Book Form
                                            </div>
                                            <p class="tiny cell">Note: *- required fields</p>
                                            <div class="body">
                                                <div class="cell">
                                                    <div class="col">
                                                        <div class="cell">
                                                            <form id="addbookForm" name = "myform" action="<?php echo base_url() ?>index.php/admin/controller_book/call_add" method="post">

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="title">Title<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" id="title" placeholder="Title of the Book" class='background-white' name="title1" data-required="true" required>&nbsp;<br/><span name="help_title" class="color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="author">Author<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fit">
                                                                        <div class="cell">
                                                                            <input type="text" class="authors background-white" id="author" name = "author[]" placeholder="Author's Name"  data-required="true" required>&nbsp;
                                                                             <input type="button" class="row1 cell" value="Add author" onclick="addRow_author(this, false)">
                                                                             <br/><span name="help_author" class="color-red"></span>
                                                                           
                                                                            <br/>
                                                                        </div>
                                                                    </div>
                    
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="subject">Subject<span class="color-red"> *</span></label>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fit">
                                                                        <div class="cell">
                                                                            <span class="tiny cell">Note: Press Ctrl(Windows)/Command(Mac) while selecting.</span></br>
                                                                            <select name="subject[]" onChange="validate_subject()" style="height: 70pt" multiple="multiple">
                                                                                <option value="CMSC 2">CMSC 2</option>
                                                                                <option value="CMSC 11">CMSC 11</option>
                                                                                <option value="CMSC 21">CMSC 21</option>
                                                                                <option value="CMSC 22">CMSC 22</option>
                                                                                <option value="CMSC 56">CMSC 56</option>
                                                                                <option value="CMSC 57">CMSC 57</option>
                                                                                <option value="CMSC 100">CMSC 100</option>
                                                                                <option value="CMSC 123">CMSC 123</option>
                                                                                <option value="CMSC 124">CMSC 124</option>
                                                                                <option value="CMSC 125">CMSC 125</option>
                                                                                <option value="CMSC 127">CMSC 127</option>
                                                                                <option value="CMSC 128">CMSC 128</option>
                                                                                <option value="CMSC 130">CMSC 130</option>
                                                                                <option value="CMSC 131">CMSC 131</option>
                                                                                <option value="CMSC 132">CMSC 132</option>
                                                                                <option value="CMSC 137">CMSC 137</option>
                                                                                <option value="CMSC 141">CMSC 141</option>
                                                                                <option value="CMSC 142">CMSC 142</option>
                                                                                <option value="CMSC 150">CMSC 150</option>
                                                                                <option value="CMSC 170">CMSC 170</option>
                                                                                <option value="CMSC 190">CMSC 190</option>
                                                                                <option value="CMSC 199">CMSC 199</option>
                                                                                <option value="CMSC 200">CMSC 200</option>
                                                                            </select>
                                                                            <span name="help_subject" class="color-red"></span><br/><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="callno">Call Number<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" class="call_nos background-white" id="callno" name = "call_number[]" placeholder="Call number of the book" data-required="true" required>&nbsp;
                                                                             <input type="button" class="row3 cell" value="Add copy" onclick="validate_subject"="addRow_callno(this, false)">
                                                                             <br/><span name="help_call_number" class="color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                 <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="yearpub">Year of Publication<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="number" id="yearpub" name="year_of_pub" min=1900 max=<?php echo date("Y"); ?> value=<?php echo date("Y"); ?> data-required="true" required/>&nbsp;<br/><span name="help_year_of_pub" class="color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="booktype">Type of the Book<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <select id = "type_book" name="type1" onchange = "checker()">
                                                                                <option value="BOOK">BOOK</option>
                                                                                <option value="SP">SP</option>
                                                                                <option value="THESIS">THESIS</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <br/>
                                                                </div>


                                                                <div class="col" id ='isbn_div'>
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="isbn">ISBN</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" id="isbn" name = "isbn" placeholder="ISBN" data-required="true">&nbsp;
                                                                            <br/><span name="help_isbn_key" class="color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                 <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="callno">Tags</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" class="tag" id="tags" name = "tags[]" placeholder="Tags" >&nbsp;
                                                                             <input type="button" class="row4 cell" value="Add tags" onclick="addRow_tags(this, false)">
                                                                             <br/><span name="help_tags" class="color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type='hidden' name='sub'/>
                                                                            <input type="submit"  value="Add Book"/>
                                                                            <a id='cancelAddBook' href="<?php echo base_url(); ?>index.php/admin/controller_admin_home"><input type='button' value='Cancel'/></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
<div id='addbookconf' title='Add Material Confirmation'>
    <h6>Are you sure that the following material details are true?</h6>
    <p id="btitle"></p>
    <p id="bauthors"></p>
    <p id="bsubject"></p>
    <p id="bcall"></p>
    <p id="byear"></p>
    <p id="btype"></p>
    <p id="bisbn"></p>
    <p id="btags"></p>
</div>
<div id="addcancelbook" title="Cancel Add Confirmation">
        <p>Do you really wish not to add this material?</p>
</div>
<script>
    $(document).ready(function(){
        $( "#addbookconf" ).dialog({
      autoOpen: false,
      modal: true,
      closeOnEscape: true,
      closeText: true,
      show: {
        effect: "fadeIn",
        duration: 500
      },
      hide: {
        effect: "fadeOut",
        duration: 500
      },
      draggable: false,
      buttons : {
        "Yes": function() {
            $(this).dialog('close');
            console.log(document.getElementById(form).submit());
        },
        "No": function() {
            $(this).dialog('close');
        }
      }
    });

        $( "#addbookForm" ).submit(function (e) {
            // console.log("addbookform");
            // console.log("title: ", validate_title());
            // console.log("author: ", validate_author());
            // console.log("subject: ", validate_subject());
            // console.log("call_no: ", validate_call_no());
            // console.log("year_pub: ", validate_year_pub());
            // console.log("isbn_key: ", validate_title());
            e.preventDefault();
            form = $(this).get(0).id;
            if(validate_title() && validate_author() && validate_subject() && validate_call_no() && validate_year_pub() && validate_isbn_key()){
            document.getElementById('btitle').innerText = "Title: "+document.getElementById('title').value;
            document.getElementById('byear').innerText = "Year of Publication: "+ document.getElementById('yearpub').value;
            $isbnValue=document.getElementById('isbn').value;
            if($isbnValue=="") $isbnValue="None";
            document.getElementById('bisbn').innerText = "ISBN: "+ $isbnValue;
            document.getElementById('btype').innerText = "Book Type: "+ document.getElementById('type_book').value;
            var aut = document.getElementsByClassName("authors");
            var author = '';
            for(var i=0; i<aut.length; i++) {
                author = author+aut[i].value + " ";
                if(i <aut.length-1)
                    author += ",";
            }

            var sub = document.getElementsByName("subject[]");
            var subject = '';
            for(var i=0; i<sub[0].selectedOptions.length; i++) {
                subject =  subject+sub[0].selectedOptions[i].innerText + " ";
                if(i <aut.length-1)
                    subject += ",";
            }
            var call = document.getElementsByClassName("call_nos");
            var call_no = '';
            for(var i=0; i<call.length; i++) {
                call_no =  call_no+call[i].value + " ";
                if(i <aut.length-1)
                    call_no += ",";
            }
            var t = document.getElementsByClassName("tag");
            var tag = '';
            for(var i=0; i<t.length; i++) {
                tag =  tag + t[i].value + " ";
                if(i <t.length-1)
                    tag += ",";
            }
            document.getElementById('bauthors').innerText =  "Author: "+ author;
            document.getElementById('bsubject').innerText = "Subject: "+ subject;
            document.getElementById('bcall').innerText = "Call Number: "+ call_no; 
            if(tag.trim().length === 0){
                tag = "None";
            }      
            document.getElementById('btags').innerText = "Tag: "+ tag;
                
            
            console.log(form);
            $( "#addbookconf" ).dialog( "open" );
        }
        });
    
    $( "#addcancelbook" ).dialog({
      autoOpen: false,
      modal: true,
      resizable: false,
      width: 300,
      minHeight: 200,
      closeOnEscape: true,
      closeText: true,
      show: {
        effect: "fadeIn",
        duration: 500
      },
      hide: {
        effect: "fadeOut",
        duration: 500
      },
      draggable: false,
      buttons : {
        "Yes": function() {
            $(this).dialog('close');
            window.location.replace(link);
        },
        "No": function() {
            $(this).dialog('close');
        }
      }
        });

        $( "#cancelAddBook" ).click(function (e) {
            e.preventDefault();
            link = $(this).attr('href');
            $( "#addcancelbook" ).dialog( "open" );
        });

    });
    var link;
    var form;
</script>
