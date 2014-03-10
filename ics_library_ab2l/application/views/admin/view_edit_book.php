<script type="text/javascript">
                        window.onload=function() {
                            checker();
                            myform.call_number.onblur=validate_call_no;
                            myform.title1.onblur=validate_title;
                            myform.author.onblur=validate_author;
                            myform.subject.onblur=validate_subject;
                            myform.isbn.onblur=validate_isbn_key;
                            myform.year_of_pub.onblur=validate_year_pub;
                            myform.quantity.onblur=validate_quantity;
                            myform.onsubmit=process_add;
                        }
                                
                        function checker(){

                        var selected = document.getElementById('type').value;

                        if(selected === 'BOOK')
                            $('#isbn_div').show();
                        
                        else
                            $('#isbn_div').hide();
                        

                        } 

                        function validate_call_no() {
                            msg="Invalid input: ";
                            str=myform.call_number.value;
                                
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
                            msg="Invalid input: ";
                            str=myform.isbn.value;
                            var selected = document.getElementById('type').value;
                            if(str=="")
                                msg+="ISBN is required!<br/>";
                            if(!str.match(/^[0-9][0-9\-]+[0-9]$/))
                                msg+="Must start and end in number and 13 digits.<br/>";

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
                            if(!str.match(/^[a-zA-Z][a-zA-Z\ \,\.]*$/))
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
                            msg="Invalid input: ";
                            str=myform.subject.value;
                                
                            if(str=="")
                            msg+="Subject is required!<br/>";
                            if(!str.match(/^[A-Z\ ]{0,5}[0-9]{1,3}$/))
                            msg+="Must be a course number!<br/>";
                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_subject")[0].style.fontSize="10px";
                                document.getElementsByName("help_subject")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_subject")[0].style.color="red";
                            }
                            document.getElementsByName("help_subject")[0].innerHTML=msg;
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

                        /*function validate_quantity() {
                            msg="Invalid input: ";
                            str=myform.quantity.value;
                                
                            if(str=="")
                            msg+="Quantity is required!<br/>";
                            if(msg=="Invalid input: ")
                            msg="";
                            else {
                                document.getElementsByName("help_quantity")[0].style.fontSize="10px";
                                document.getElementsByName("help_quantity")[0].style.fontFamily="verdana";
                                document.getElementsByName("help_quantity")[0].style.color="red";
                            }
                            document.getElementsByName("help_quantity")[0].innerHTML=msg;
                            if(msg=="")
                                return true;
                        }*/
                        
                        
                        function process_add() {
                            if (validate_call_no() && validate_isbn_key() && validate_title() && validate_author() && validate_subject() && validate_year_pub() && validate_quantity()) {
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
                        
                        function addRow_call_number(element, indentFlag){
                            var maxFieldWidth = "500";
                            var elementClassName = element.className; // this is the class name of the button that was clicked
                            var fieldNumber = elementClassName.substr(3, elementClassName.length);

                            var newFieldNumber = ++fieldNumber;
                            var rowContainer = element.parentNode; // get the surrounding div so we can add new elements

                            // create text field
                            var textfield = document.createElement("input");
                            textfield.type = "text";
                            textfield.setAttribute("name", "call_number[]");
                            textfield.setAttribute("placeholder","Book Call Number");
                            textfield.setAttribute("required","required");
                            textfield.setAttribute("class","background-white call_nos");
                            

                            // create buttons
                            var button1 = document.createElement("input");
                            button1.type = "button";
                            button1.setAttribute("value", "Add Copy");
                            button1.setAttribute("onclick", "addRow_call_number(this, false)");
                            button1.className = "row" + newFieldNumber;


                            // add elements to page
                            rowContainer.removeChild(element);
                            rowContainer.appendChild(textfield);
                            rowContainer.appendChild(document.createTextNode(" ")); // add space
                            rowContainer.appendChild(button1);
                            rowContainer.appendChild(document.createElement("BR")); // add line break
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
                                                                                $authors = $this->model_book->get_book_authors($book[0]->id);
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
                                                                            <label for="callno">Call Number<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                           <?php 
                                                                            $call_numbers = $this->model_book->get_book_call_numbers($book[0]->id);
                                                                            foreach ($call_numbers as $call_number) {
                                                                                echo '<input id = "call_number" class="call_nos" type = "text" name = "call_number[]" value="'.$call_number->call_number.'" /><br/>';
                                                                            }
                                                                            ?><span name="help_call_number" class="color-red"></span>
                                                                            <input type="button" class="row1 cell" value="Add copy" onclick="addRow_call_number(this, false)">
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
                                                                            <?php 
                                                                            $subjects = $this->model_book->get_book_subjects($book[0]->id);
                                                                            foreach ($subjects as $subject) {
                                                                                echo '<input id = "subject" type = "text" class="subjects" name = "subject[]" value="'.$subject->subject.'" /><br/>';
                                                                            }
                                                                            ?>
                                                                            <span name="help_subject" class="color-red"></span>
                                                                            <input type="button" class="row2 cell" value="Add subject" onclick="addRow_subj(this, false)"/>
                                                                            <br/>
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
                                                                            <input id  = "year_of_pub" type = "number" name = "year_of_pub" min=1900 max="<?php echo date("Y"); ?>" value="<?php echo $book[0]->year_of_pub ;?>" />&nbsp;<span name="help_year_of_pub" class="color-red"></span><br/>
                                                                            
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
                                                                            <label for="subject">Tags<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fit">
                                                                        <div class="cell">
                                                                            <?php 
                                                                            $tags = $this->model_book->get_book_tags($book[0]->id);
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


                                                                
                                                                            <input id = "quantity" type = "hidden" name = "quantity" min=1 max=50 value="<?php echo $book[0]->quantity ;?>" />

                                                           
                                                                            <input type = "hidden" name = "no_of_available" value="<?php echo $book[0]->no_of_available ;?>"/>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            </br><input type = "submit" name = "sub" value = "Submit">
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
    <h5>Are you sure that the following book details are true?</h5>
    <p id="btitle"></p>
    <p id="bauthors"></p>
    <p id="bsubject"></p>
    <p id="bcall"></p>
    <p id="byear"></p>
    <p id="btype"></p>
    <p id="bisbn"></p>
    <p id="btags"></p>
    <p id="bquant"></p>
</div>
<script>
    $(document).ready(function(){
        $( "#editbookconf" ).dialog({
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
            console.log(document.getElementById('editbookForm'));
            document.getElementById('editbookForm').submit();
        },
        "No": function() {
            $(this).dialog('close');
        }
      }
    });

        $( "#editbookForm" ).submit(function (e) {
            e.preventDefault();
            form = $(this).get(0).id;
            if(validate_call_no() && validate_isbn_key() && validate_title() && validate_author() && validate_subject() && validate_year_pub()){
            document.getElementById('btitle').innerText = "Title: "+document.getElementById('title1').value;
            document.getElementById('byear').innerText = "Year Of Publication: "+ document.getElementById('year_of_pub').value;
            document.getElementById('bisbn').innerText = "ISBN: "+ document.getElementById('isbn').value;
            document.getElementById('btype').innerText = "Book Type: "+ document.getElementById('type').value;
            document.getElementById('bquant').innerText = "Quantity: "+ document.getElementById('quantity').value;
            var aut = document.getElementsByClassName("authors");
            var author = '';
            for(var i=0; i<aut.length; i++) {
                author = author+aut[i].value + " ";
                if(i <aut.length)
                    author += ",";
            }
            var sub = document.getElementsByClassName("subjects");
            var subject = '';
            for(var i=0; i<sub.length; i++) {
                subject =  subject+sub[i].value + " ";
                if(i <aut.length)
                    subject += ",";
            }
            var call = document.getElementsByClassName("call_nos");
            var call_no = '';
            for(var i=0; i<call.length; i++) {
                call_no =  call_no+call[i].value + " ";
                if(i < aut.length)
                    call_no += ",";
            }
            var t = document.getElementsByClassName("tag");
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

    var form;
</script>