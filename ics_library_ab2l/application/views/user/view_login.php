<div id="main-body" class="site-body" ><!--style="background-image:url('<?php echo base_url();?>images/library.jpg'); height:100vh;"-->
                <div class="site-center">
<div class="cell body">
	<p class="tiny">Login Page</p>
</div>
<div id="signbox" class="background-red width-2of5">
	<div class="col width-fill">
		<p style="text-align:center; font-size:1.2em">Login Box</p>
	</div>
	<div id="sign" class="col">
		<div class="col">
			<span>
			<?php
				if(validation_errors()){
			?>
			<div class="errormsg" style='margin: 3px 10px 3px 10px;'>
				<div class="msgwrape">
					<p class="color-red"><?php echo validation_errors(); ?></p>
				</div></div>
			<?php
				}
			?>
		</span>
	 <?php	$attributes = array('name' =>'user_login', 'id' => 'user_login');
     echo form_open('index.php/user/controller_verify_login', $attributes); ?>
     
			<div class="cell width-1of1">
				<div class="cell width-1of1">
					<label for="emailuser">Username:</label>
				</div>
				<div class="cell width-1of1">
					<input type="text" id="emailuser" name="username" required="required" class="background-white"/>
				</div>
			</div>
			<div class="cell width-1of1">
				<div class="col width-1of1">
					<label for="logpword">Password:</label>
	</div>
	<div class="col width-1of1">
		<input type="password" id="logpword" name="password" required="required" class="background-white"/>
	</div>
</div>
<div class="cell">
	<input type="submit" value= "Login" onclick= "return validate_login()" name = "login_button" class="cell float-right"/>
	<a href="<?php echo base_url(); ?>index.php/user/controller_register" class="cell float-right">Sign up now!</a>
</div>
				
			</form>
		</div>
	</div>

</div>
</div>
</div>
<!-- End of file view_login.php -->
<!-- Location: ./application/view/user/view_login.php -->
