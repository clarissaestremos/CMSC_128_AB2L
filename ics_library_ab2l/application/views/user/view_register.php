<div id="main-body" class="site-body">
                <div class="site-center">
<div class="cell body">
                                    <p class="tiny">Sign-up</p>
                                </div>
                        <div class="col">
                            <div class="cell">
                                <div class="col width-fill">
                                    <div class="col">
                                        <h4>Sign-up Form</h4>
                                        <div class="cell panel">
                                            <div id="regform" class="body">
                                                <div class="cell">
                                                    <div class="width-fill" style="font-weight: bold;"><p>
                                                        <?php 
                                                            
                                                            if(isset($msg))    
                                                            echo $msg;
                                                            

                                                     ?></p>
                                                    </div>
                        
                        
                         <?php 
                        $attributes = array('name' => 'regForm', 'id' => 'regForm');

                        echo form_open("index.php/user/controller_register/registration", $attributes); ?>
                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="firstname">First name<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="fname" class="background-white" id = "fname" placeholder="Your first name" required  /><span class="cell color-red validmsg" name = "valFname"></span>
                                </div>
                            </div>
                            <span>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="firstname">Middle Initial<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="minit" class="background-white" id = "minit" placeholder="Your middle initial" required/><span name = "valInitial" class = "cell color-red validmsg"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">

                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="lastname">Last name<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="lname" class="background-white" id = "lname" placeholder="Your last name" required/><span name = "valLname" class = "cell color-red validmsg"></span>
                                </div>
                            </div>
                        </div>


                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    </br><label for="classification">Classification <span class="cell color-red validmsg"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <br/>
                                    <select id = "classi" name = "classi" onchange = "checker()" required >
                                    <option value="default" disabled selected="selected">Select Classification</option>
                                    <option value="student">Student</option>
                                    <option value="faculty">Faculty</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input style="display:none;" data-required="true" data-error-message="Classification is required">
                                    <span class = "color-red" name = "valClass" class = "valClass">
                                </div>
                            </div>
                        </div>

                         <div class="col" id= "numDiv">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="studno" id = "labelNum">Student Number<span id="labelNum" class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="stdNum" class="background-white" placeholder="Your ID number" id = "stdNum" required/><span class = "cell color-red validmsg valClass" name = "valNumber"></span>
                                </div>
                            </div>
                        </div>

                           <div class="col" id= "collegeDiv">
                            <div class="col width-1of4">
                                <div class="cell">
                                    </br><label for="college">College <span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <br/>
                                    <select id = "college" name = "college" onblur = "courseChecker()"><span name = "valCollege" class= "valClass cell color-red validmsg"></span>
                                    <option value="default" disabled selected="selected">Select College</option>
                                    <option value="CA">CA</option>
                                    <option value="CAS">CAS</option>
                                    <option value="CDC">CDC</option>
                                    
                                    <option value="CEAT">CEAT</option>
                                    <option value="CEM">CEM</option>
                                    <option value="CFNR">CFNR</option>
                                    <option value="CHE">CHE</option>

                                    <option value="CVM">CVM</option>
                                    <!--option value="SESAM">SESAM</option>
                                    <option value="GS">GS</option>
                                    <option value="CPAf">CPAf</option-->
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input style="display:none;" data-required="true" data-error-message="College is required">
                                </div>
                            </div>
                        </div>

                        <div class="col" id= "courseDiv">
                            <div class="col width-1of4">
                                <div class="cell">
                                    </br><label for="college">Course <span class="color-red"> *</span></label>
                                </div>
                            </div>
                        <div class="col width-fill">
                                <div class="cell"><br/>
                                    <select id = "course" name = "course" onfocus = "courseChecker()" >
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input style="display:none;" data-required="true" data-error-message="Course is required">
                                </div>
                            </div>
                        </div>

                        <div class="col" id = "divEadd">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="occupation">Email Address<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="email" class="background-white" name="eadd" placeholder="Your email address" id = "eadd" required/><span class = "cell color-red validmsg"   name = "valEmail"></span>
                                </div>
                            </div>
                        </div>



                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="occupation">Username:<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" class="background-white" name="uname" id = "uname" required/><span class = "cell color-red validmsg" name = "valUser" id="span_un"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="occupation">Password:<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="password" class="background-white" name="pass" id = "pass" required/><span  class = "cell color-red validmsg" name = "valPass"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="occupation">Confirm Password:<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="password" class="background-white" name="cpass" id = "cpass" required/><span class = "cell color-red validmsg" name = "valCpass"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    </br><input type="submit" value="Submit"/>
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
                </div>
<div id="regdialog" title="Extend Book Dialog">
    <p id="myfname"></p>
    <p id="mymname"></p>
    <p id="mylname"></p>
    <p id="mycol"></p>
    <p id="myemail"></p>
    <p id="myusername"></p>
    <p>Are you sure that the information provided is legit?</p>
</div>
            <script src="<?php echo base_url() ?>js/formValidation.js"></script>
            <script src="<?php echo base_url() ?>js/register_validation.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#regdialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
        maxHeight: 640,
        maxWidth: 320,
        closeText: 'show',
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
            "Confirm": function() {
                document.getElementById(form).submit();            },
            "Edit": function() {
                $(this).dialog('close');
            }
        }

    });
        $( "form#regForm" ).submit(function (e) {
            e.preventDefault();
            document.getElementById('myfname').innerText = "First Name: "+document.getElementById('fname').value;
            document.getElementById('mymname').innerText = "Middle Initial: " +document.getElementById('minit').value;
            document.getElementById('mylname').innerText = "Last Name: " +document.getElementById('lname').value;
            document.getElementById('mycol').innerText = "College: " +document.getElementById('college').value;
            document.getElementById('myemail').innerText = "Email: " +document.getElementById('eadd').value;
            document.getElementById('myusername').innerText = "Username: " +document.getElementById('uname').value;
            if(validateAll()){
                form = $(this).get(0).id;
                $( "#regdialog" ).dialog( "open" );
            }
        });

    });
    var form;
</script>