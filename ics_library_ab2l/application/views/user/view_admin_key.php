<!-- This file view_admin_key.php is a file for view the page where the
admin will input the admin key before entering the admin portal -->
<div id="main-body" class="site-body" >
	<div class="site-center">
		<div class="cell body">
			<p class="tiny">Administrator Verification</p>
		</div>
		<div id="signbox2" class="background-red width-2of5">
			<div class="col width-fill">
				<p style="text-align:center; font-size:1.2em">Administrator Key Verification</p>
			</div>
			<div id="sign" class="col" >
				<div class="col" >
					<span>
					<?php 		//This will check for validation errors like wrong input of admin key
						if(validation_errors()){
					?>
					<!-- DIV to show that the admin input a wrong admin_key -->
					<div class="errormsg" style='margin: 3px 10px 3px 10px;'>
						<div class="msgwrape">
							<p class="color-red"><?php echo validation_errors(); ?></p>
						</div>
					</div>
					<?php
						}
					?>
					</span>
		 			<?php 		//Redirect to the admin portal
		 				$attributes = array('name' =>'admin_login', 'id' => 'admin_login');
	     				echo form_open('index.php/user/controller_verify_admin_key', $attributes); ?>
	     
	     		<!-- DIV to get the admin key from user/ admin
	     			a form with a password fiel is present and a submit button -->
					<div class="cell width-1of1" >
						<div class="cell width-1of1">
							<label for="admin_key">Administrator Key:</label>
						</div>
						<div class="cell width-1of1" >
							<input type="password" id="admin_key" name="admin_key" required="required" class="width-9of10 background-white"/>
							<span name ="helpadminkey" class="color-red"/><span>
						</div>
					</div>
				
					<div class="cell">
						<input type="submit" value= "Enter" onclick= "validate_admin_key()" name = "admin_key_button" class="cell float-right"/>
		
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
