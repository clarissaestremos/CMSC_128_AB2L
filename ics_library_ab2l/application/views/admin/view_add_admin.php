<div id="thisbody" class="body width-fill">
                    <div class="col">
                            <div id="whoscell" class="cell">
                                <div class="page-header cell">
                                        <h1>Admin <small>Add Admin</small></h1>
                                    </div>
                                <div class="col width-fill">
                                    <div class="col">
                                        <div class="cell panel">
                                            <div class="header background-red">
                                               Admin Registration Form
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
                                                                if($msg === "You successfully added a new admin account."){
                                                                    echo "<div class='color-green'>$msg</div>";
                                                                }
                                                                else{
                                                                     echo "<div class='color-red'>Unsuccessful adding admin account. Recheck input values.</div>";
                                                                }
                                                             }

                                                     ?></p>
                                                    </div>
                         <?php 
                        $attributes = array('name' => 'regForm', 'id' => 'adminReg');

                        echo form_open("index.php/admin/controller_add_admin/registration", $attributes); ?>
                          <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="adminkey">Administrator Key<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" name="adminkey" class="background-white" id = "adminkey" required placeholder="Administrator's Key"/><br/>&nbsp;<span name="helpadminkey" id="span_ak" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="fname">First name<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" name="fname" class="background-white" id = "fname" required placeholder="First Name"/><br/>&nbsp;<span name="helpfname" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="minit">Middle initial<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" name="minit" class="background-white" id = "minit" required placeholder="Middle Initial"/><br/>&nbsp;<span name="helpmname" class="validate color-red"></span><br/>
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
                                                                            <input type="text" name="lname" class="background-white" id = "lname" required placeholder="Last Name"/><br/>&nbsp;<span name="helplname" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                 <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="email">Email Address<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="email" name="eadd" class="background-white" id = "eadd" required placeholder="Email Address"/><br/>&nbsp;<span name="helpemail" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                 <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="username">Username<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="text" name="uname" class="background-white" id = "uname" required placeholder="Username"/><br/>&nbsp;<span name="helpusername" id="span_un" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="password">Password<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="password" class="background-white" name="pass" id = "pass" required placeholder="Password"/><br/>&nbsp;<span name="helppassword" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                        <div class="cell">
                                                                            <label for="password">Confirm Password<span class="color-red"> *</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="password" class="background-white" name="cpass" id = "cpass" required placeholder="Confirm Password"/><br/>&nbsp;<span name="helpcpassword" class="validate color-red"></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col">
                                                                    <div class="col width-1of4">
                                                                    </div>
                                                                    <div class="col width-fill">
                                                                        <div class="cell">
                                                                            <input type="hidden" name="parent_key" id = "parent_key" value="<?php echo "{$this->session->userdata('logged_in')['username']}"; ?>"required/>
                                                                            <input type = "submit" name= "add_admin"value = "Add Administrator"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <p id="haha"></p>
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

            <script src="<?php echo base_url() ?>js/validationAdmin.js"></script>
            <script src="<?php echo base_url() ?>js/register_validation.js"></script>
            <div id="addadmin">
                <h6>Are you sure that the following information is true?</h6>
                <p id='akey'></p>
                <p id='aname'></p>
                <p id='aemail'></p>
                <p id='ausername'></p>
            </div>
            <div id="addadminsuccess">
                <h6>You have successfully added a new admin with</h6>
                <p id='akeys'></p>
                <p id='ausernames'></p>
            </div>