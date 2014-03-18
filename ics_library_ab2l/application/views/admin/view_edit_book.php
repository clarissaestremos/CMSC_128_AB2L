<?php
    $ccount = 0;
?>
<script type="text/javascript">
                  window.onload=function() {
                            checker();
                            myform.call_number.onblur=validate_call_no;
                            myform.title1.onblur=validate_title;
                            myform.author.onblur=validate_author;
                            myform.subject.onblur=validate_subject;
                            myform.isbn.onblur=validate_isbn_key;
                            myform.year_of_pub.onblur=validate_year_pub;
                            myform.onsubmit=process_add;
                        }
                                
                        function deleteCopy(copy){
                            var elm = document.getElementById("cnum"+copy);
                            elm.parentNode.removeChild(elm);
                        }

                        function checker(){

                        var selected = document.getElementById('type').value;

                        if(selected === 'BOOK')
                            $('#isbn_div').show();
                        
                        else
                            $('#isbn_div').hide();
                        } 

                        function validate_author() {
                            msg="Invalid input: ";
                            console.log(myform.author);
                            str=myform.author.value;
                                
                            if(str=="")
                            msg+="Author is required!<br/>";
                            if(!str.match(/^[a-zA-Z][a-zA-Z\ \,\.]*$/))
                            msg+="Author must be between 1-100 alpha character!<br/>";
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

                        function validate_call_no() {
                            msg="Invalid input: ";
                            // console.log(myform.number);
                            str=myform.call_number1.value;
                                
                            if(str=="")
                            msg+="Call number is required!<br/>";
                            if(!str.match(/^[a-zA-Z0-9\ \.\-]+[a-zA-Z0-9\ \.\-]*$/))
                            msg+="Call number must be between 1-20 alpha numeric character!<br/>";
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
                            msg="Invalid input: ";
                            str=myform.isbn.value;
                            var selected = document.getElementById('type').value;
                            if(str=="")
                                msg+="ISBN is required!<br/>";
                            if(!str.match(/^[0-9][0-9\-]+[0-9]$/))
                                msg+="ISBN must start and end in number and 13 digits.<br/>";

                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_isbn_key")[0].style.fontSize="10px";
                                document.getElementsByName("help_isbn_key")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_isbn_key")[0].style.color="red";
                            }
                            document.getElementsByName("help_isbn_key")[0].innerHTML=msg;

                            if(msg=="" || selected != "BOOK")
                                return true;
  
                        }

                        function validate_title() {
                            msg="Invalid input: ";
                            str=myform.title1.value;
                                
                            if(str=="")
                            msg+="Title is required!<br/>";
                            if(!str.match(/^[a-zA-Z0-9\ ]+[a-zA-Z0-9\ ]*$/))
                            msg+="Title must be between 1-100 alpha numeric character!<br/>";
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

                        function validate_subject() {
                            // console.log(document.getElementsByName('subject[]'));
                            subjects=document.getElementsByName("subject[]")[0].selectedOptions.length;
                            // console.log(subjects);
                            document.getElementsByName("help_subject")[0].innerHTML="";
                            if(subjects>0)
                                return true;
                            document.getElementsByName("help_subject")[0].innerHTML="</br>Subject is required! Select at least one."
                            return false;
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
                        
                        function process_add() {
                            console.log("ETOETOETOETOETOETOETOETOETOETOETOETOETOETO");
                            console.log("validate_call_no: "+validate_call_no());
                            console.log("validate_isbn_key: "+validate_isbn_key());
                            console.log("validate_title: "+validate_title());
                            console.log("validate_author: "+validate_author());
                            console.log("validate_subject: "+validate_subject());
                            console.log("validate_year_pub: "+validate_year_pub());
                            if (validate_call_no() && validate_isbn_key() && validate_title() && validate_author() && validate_subject() && validate_year_pub()) {
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

                        }
                        
                        function addRow_call_number(element, indentFlag, copy){
                            var maxFieldWidth = "500";
                            var elementClassName = element.className; // this is the class name of the button that was clicked
                            var fieldNumber = elementClassName.substr(3, elementClassName.length);

                            var newFieldNumber = ++fieldNumber;
                            var rowContainer = element.parentNode; // get the surrounding div so we can add new elements

                            
                            var newDiv = document.createElement("div");
                            newDiv.id = "cnum"+copy;
                            newDiv.innerHTML = '<input id = "call_number'+copy+'" class="call_nos" type = "text" name = "call_number[]" value="" /><input type="button" id="deletebutton'+copy+'" value="Delete Copy" onclick="deleteCopy('+copy+');"/><br/>';


                            // add elements to page
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(newDiv);
                            
                            copy++;
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Copy");
                            button1.setAttribute("onclick", "addRow_call_number(this, false, "+copy+")");
                            button1.className = "row" + newFieldNumber;

                            rowContainer.appendChild(button1);
                            
                        }

                        function addRow_subj(element, indentFlag){
                            var maxFieldWidth = "500";
                            var elementClassName = element.className; // this is the class name of the button that was clicked
                            var fieldNumber = elementClassName.substr(3, elementClassName.length);

                            var newFieldNumber = ++fieldNumber;
                            var rowContainer = element.parentNode; // get the surrounding div so we can add new elements

                            // create text field
                            var textfield = document.createElement("input");
                            textfield.type = "text";
                            textfield.setAttribute("name", "subject[]");
                            textfield.setAttribute("placeholder","Book Subject");
                            textfield.setAttribute("required","required");
                            textfield.setAttribute("class","background-white subjects");
                            

                            // create buttons
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Subject");
                            button1.setAttribute("onclick", "addRow_subj(this, false)");
                            button1.className = "row" + newFieldNumber;


                            // add elements to page
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(textfield);
                            rowContainer.appendChild(document.createTextNode(" ")); // add space
                            rowContainer.appendChild(button1);
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
                            textfield.setAttribute("name", "tags[]");
                            textfield.setAttribute("placeholder","Tags");
                            textfield.setAttribute("class","background-white tags");
                            

                            // create buttons
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Tags");
                            button1.setAttribute("onclick", "addRow_tags(this, false)");
                            button1.className = "row" + newFieldNumber;


                            // add elements to page
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(textfield);
                            rowContainer.appendChild(document.createTextNode(" ")); // add space
                            rowContainer.appendChild(button1);
                            rowContainer.appendChild(document.createElement("BR")); // add line break
                        }
</script>
<div id="thisbody" class="body width-fill background-white">
                    <div class="col">
                            <div class="cell">
                                    <div class="page-header cell">
                                        <h1>Admin <small>Edit Books</small></h1>
                                    </div>
                                <div class="col width-fill">
                                    <div class="col">
                                        <div class="cell panel">
                                            <div class="header gradient">
                                               Admin Edit Book Form
                                            </div>
                                            <p class="tiny cell">Note: *- required fields</p>
                                            <div class="body">
                                                <div class="cell">
                                                    <div class="col">
                                                        <div class="cell">
                                                            <form id='editbookForm' name = "myform" action="<?php echo base_url() ?>index.php/admin/controller_book/edit_book" method="post">

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="title">Title<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input id = "title1" type = "text" name = "title" value="<?php echo $book[0]->title ;?>" />&nbsp;<span name="help_title" class="color-red"></span><br/>
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
                                                                            <?php 
                                                                                $authors = $this->model_get_list->get_book_authors($book[0]->id);
                                                                                $count = 0;
                                                                                foreach ($authors as $author) {
                                                                                    echo '<input id  = "author" class="authors" type = "text" name = "author[]" value="'.$author->author.'"><br />';
                                                                                    $count++;
                                                                                }
                                                                            ?><span name="help_author" class="color-red"></span>
                                                                            <input type="button" class="row1 cell" value="Add author" onclick="addRow_author(this, false)">
                                                                            
                                                                            <br/>
                                                                        </div>
                                                                    </div>
                    
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="call_number">Call Number<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                           <span name="help_call_number" class="color-red"></span>
                                                                           <?php 
                                                                            
                                                                            $call_numbers = $this->model_get_list->get_edit_call_numbers($book[0]->id);
                                                                            foreach ($call_numbers as $call_number) {
                                                                                echo '<div id="cnum'.$ccount.'"><input id = "call_number'.$ccount.'" class="call_nos" type = "text" name = "call_number[]" value="'.$call_number->call_number.'" /><input type="button" id="deletebutton'.$ccount.'" value="Delete Copy" onclick="deleteCopy('.$ccount.');"/><br/></div>';
                                                                                $ccount++;
                                                                                echo $ccount;
                                                                            }
                                                                            $call_numbers = $this->model_get_list->get_notedit_call_numbers($book[0]->id);
                                                                            foreach ($call_numbers as $call_number) {
                                                                                echo '<div id="cnum'.$ccount.'"><input id = "call_number'.$ccount.'" class="call_nos" type = "text" name = "call_number[]" value="'.$call_number->call_number.'" disabled/><br/></div>';
                                                                                $ccount++;
                                                                            }
                                                                            ?>
                                                                            <?php echo "<input type='button' class='row1 cell' value='Add copy' onclick='addRow_call_number(this, false, ".$ccount.")'>";?>
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
                                                                            <label for="year_of_pub">Year of Publication<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input id  = "year_of_pub" type = "number" name = "year_of_pub" min=1900 max="<?php echo date("Y"); ?>" value="<?php echo $book[0]->year_of_pub ;?>" />&nbsp;<span name="help_year_of_pub" class="color-red"></span><br/>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="type">Type of the Book<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <select name="type" id = 'type' onchange = "checker()">
                                                                                <?php
                                                                                $types = array("BOOK", "SP", "THESIS");
                                                                                foreach($types as $type){
                                                                                    if($type == $book[0]->type){
                                                                                        echo "<option value=\"$type\" selected=\"selected\">";
                                                                                    }else{
                                                                                        echo "<option value=\"$type\">";
                                                                                    }
                                                                                    $type = strtoupper($type);
                                                                                    echo "$type</option>";
                                                                                }
                                                                            ?>
                                                                            </select>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col" id = 'isbn_div'>
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="isbn">ISBN<span class="color-red"></span> *</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" id="isbn" name = "isbn" placeholder="ISBN" value="<?php echo $book[0]->isbn;?>">&nbsp;
                                                                            <br/><span name="help_isbn_key" class="color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="tags">Tags<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fit">
                                                                        <div class="cell">
                                                                            <?php 
                                                                            $tags = $this->model_get_list->get_book_tags($book[0]->id);
                                                                            foreach ($tags as $tag) {
                                                                                echo '<input id = "tags" type = "text" name = "tags[]" value="'.$tag->tag_name.'" /><br/>';
                                                                            }
                                                                            ?>
                                                                            <span name="help_tags" class="color-red"></span>
                                                                            <input type="button" class="row2 cell" value="Add Tags" onclick="addRow_tags(this, false)"/>
                                                                            <br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            </br><input type = "submit" name = "sub" value = "Submit">
                                                                            <a id='cancelEditBook' href="<?php echo base_url(); ?>index.php/admin/controller_admin_home"><input type='button' value='Cancel'/></a>
                                                                            <input type = "hidden" name = "id" value="<?php echo $book[0]->id ;?>" />
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
<div id='editbookconf' title='Edit Book Confirmation'>
    <h6>Are you sure that the following book details are true?</h6>
    <p id="btitle"></p>
    <p id="bauthors"></p>
    <p id="bsubject"></p>
    <p id="bcall"></p>
    <p id="byear"></p>
    <p id="btype"></p>
    <p id="bisbn"></p>
    <p id="btags"></p>
</div>
<div id="editcancelbook" title="Cancel Edit Confirmation">
        <p>Do you really wish to cancel editing this book? Doing so will retain the old details of the book.</p>
</div>
<script>
    $(document).ready(function(){
        $( "#editbookconf" ).dialog({
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
            // console.log(document.getElementById('editbookForm'));
            document.getElementById('editbookForm').submit();
        },
        "No": function() {
            $(this).dialog('close');
        }
      }
    });
        $( "#editcancelbook" ).dialog({
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

        $( "#cancelEditBook" ).click(function (e) {
            e.preventDefault();
            link = $(this).attr('href');
            $( "#editcancelbook" ).dialog( "open" );
        });

        $( "#editbookForm" ).submit(function (e) {
            e.preventDefault();
            form = $(this).get(0).id;
            if(validate_call_no() && validate_isbn_key() && validate_title() && validate_author() && validate_subject() && validate_year_pub()){
            document.getElementById('btitle').innerText = "Title: "+document.getElementById('title1').value;
            document.getElementById('byear').innerText = "Year Of Publication: "+ document.getElementById('year_of_pub').value;
            document.getElementById('bisbn').innerText = "ISBN: "+ document.getElementById('isbn').value;
            document.getElementById('btype').innerText = "Book Type: "+ document.getElementById('type').value;
            var aut = document.getElementsByClassName("authors");
            var author = '';
            for(var i=0; i<aut.length; i++) {
                author = author+aut[i].value + " ";
                if(i <aut.length)
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
                if(i < aut.length)
                    call_no += ",";
            }
            var t = document.getElementsByClassName("tags");
            var tag = '';
            for(var i=0; i<t.length; i++) {
                tag =  tag + t[i].value + " ";
                if(i <t.length)
                    tag += ",";
            }
            document.getElementById('bauthors').innerText =  "Author: "+ author;
            document.getElementById('bsubject').innerText = "Subject: "+ subject;
            document.getElementById('bcall').innerText = "Call Number: "+ call_no;            
            document.getElementById('btags').innerText = "Tag: "+ tag;
            $( "#editbookconf" ).dialog( "open" );
        }
        });

    });
    var link;
    var form;
</script>