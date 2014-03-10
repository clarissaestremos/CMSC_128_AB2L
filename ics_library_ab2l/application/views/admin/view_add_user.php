<!-- edited -->
<div id="thisbody" class="body width-fill">
                    <div class="col">
                            <div id="whoscell" class="cell">
                                <div class="page-header cell">
                                        <h1>Admin <small>Add Users</small></h1>
                                    </div>
                                <div class="col width-fill">
                                    <div class="col">
                                        <div class="cell panel">
                                            <div class="header background-red">
                                               User Registration Form
                                            </div>
                                            <div class="body">
                                                <div class="cell">
                                                    <div class="color-red width-fill" style="font-weight: bold;"><p>
                                                      
                                                      </p>
                                                    </div>
                                                    <div class="col">
                                                        <div class="cell">
                                                        <?php 
                                                            if(isset($msg)){
                                                                if($msg1){
                                                                    echo "<div class='color-green'>$msg</div>";
                                                                }
                                                                else{
                                                                     echo "<div class='color-red'>$msg</div>";
                                                                }
                                                             }

                                                     ?></p>
                                                    </div>
                         <?php 
                        $attributes = array('name' => 'regForm', 'id' => 'userRegister');

                        echo form_open("index.php/admin/controller_add_user/registration", $attributes); ?>
                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="fname">First name<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="fname" class="background-white" id = "fname" placeholder="Your first name" required  /><br/><span class="cell color-red" name = "valFname"></span>
                                </div>
                            </div>
                            <span>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="minit">Middle Initial<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="minit" class="background-white" id = "minit" placeholder="Your middle initial" required/><br/><span name = "valInitial" class = "color-red"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">

                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="lname">Last name<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="lname" class="background-white" id = "lname" placeholder="Your last name" required/><br/><span name = "valLname" class = "color-red"></span>
                                </div>
                            </div>
                        </div>


                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    </br><label for="classification">Classification <span class="color-red"> *</span></label>
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
                                    <br/><span class = "color-red" name = "valClass" class = "valClass">
                                </div>
                            </div>
                        </div>

                         <div class="col" id= "numDiv">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="stdNum" id = "labelNum">Student Number<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" name="stdNum" class="background-white" placeholder="Your ID number" id = "stdNum" required/><br/><span class = "color-red valClass" id="span_sno" name = "valNumber"></span>
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
                                    <select id = "college" name = "college" onblur = "courseChecker()"><br/><span name = "valCollege" class= "valClass color-red"></span>

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
                                    </br><label for="course">Course <span class="color-red"> *</span></label>
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
                                    <label for="eadd">Email Address<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="email" class="background-white" name="eadd" placeholder="Your email address" id = "eadd" required/><br/><span class = "color-red"   name = "valEmail"></span>
                                </div>
                            </div>
                        </div>



                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="uname">Username:<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="text" class="background-white" name="uname" id = "uname" placeholder="Your username" required/><br/><span class = "color-red" name = "valUser" id="span_un"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="pass">Password:<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="password" class="background-white" name="pass" id = "pass" placeholder="Your password" required/><br/><span  class = "color-red" name = "valPass"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                                <div class="cell">
                                    <label for="cpass">Confirm Password:<span class="color-red"> *</span></label>
                                </div>
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    <input type="password" class="background-white" name="cpass" id = "cpass" placeholder="Rety-pe Password" required/><br/><span class = "color-red" name = "valCpass"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="col width-1of4">
                            </div>
                            <div class="col width-fill">
                                <div class="cell">
                                    </br><input type="submit" onclick="return validateAll()" value="Submit"/>
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
<div id='registerconf' title='Registration Confirmation Dialog'>
    <h5>Are you sure that the following information is true?</h5>
    <p id='regname'></p>
    <p id='regclass'></p>
    <p id='regnum'></p>
    <p id='regcol'></p>
    <p id='regcourse'></p>
    <p id='regemail'></p>
    <p id='reguser'></p>
</div>
            <script src="<?php echo base_url() ?>js/formValidation.js"></script>
            <script src="<?php echo base_url() ?>js/register_validation.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("#registerconf").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
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
            "Yes": function() {
                $(this).dialog('close');
                document.getElementById(form).submit();
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

        });

        $( "#userRegister" ).submit(function (e) {
            e.preventDefault();
            form = $(this).get(0).id;
            document.getElementById('regname').innerText = "Name: "+ document.getElementById('fname').value + " "+ document.getElementById('minit').value + " " + document.getElementById('lname').value;
            document.getElementById('regclass').innerText = "Classification: "+ document.getElementById('classi').value;
            if(document.getElementById('classi').value === "student"){
                document.getElementById('regnum').innerText = "Student Number: "+ document.getElementById('stdNum').value;
                document.getElementById('regcol').innerText = "College: "+ document.getElementById('college').value;
                document.getElementById('regcourse').innerText = "Course: "+ document.getElementById('course').value;
            }
            else{
                document.getElementById('regcol').innerText = "College: "+ document.getElementById('college').value;
                document.getElementById('regnum').innerText = "Faculty Number: "+ document.getElementById('stdNum').value;
            }

            document.getElementById('regemail').innerText = "Email: "+ document.getElementById('eadd').value;
            document.getElementById('reguser').innerText = "Username: "+ document.getElementById('uname').value;
            $( "#registerconf" ).dialog( "open" );
        });
    });
</script>