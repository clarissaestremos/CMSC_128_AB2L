<div id="main-body" class="site-body" ><!--style="background-image:url('<?php echo base_url();?>images/library.jpg'); height:100vh;"-->
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
					<?php
						if(validation_errors()){
					?>
					<div class="errormsg" style='margin: 3px 10px 3px 10px;'>
						<div class="msgwrape">
							<p class="color-red"><?php echo validation_errors(); ?></p>
						</div>
					</div>
					<?php
						}
					?>
					</span>
		 			<?php
		 				$attributes = array('name' =>'admin_login', 'id' => 'admin_login');
	     				echo form_open('index.php/user/controller_verify_admin_key', $attributes); ?>
	     
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
