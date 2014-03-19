<div id = "logindiv">
<p><h1>Admin Login </h1></p>
   <div id = "logindiv2">
 
   <?php	$attributes = array('name' =>'admin_login', 'id' => 'admin_login');
     echo form_open('admin/controller_admin_verify_login', $attributes); ?>
  
     <p id= "validation_error"><?php echo validation_errors(); ?></p>
      <label for= "username">Username:</label> <input type = "text" name= "username" id="username"required= "required"  >
      <span id = "helpusername2"></span><br>
      <label for= "password">Password:</label> <Input type= "password" name = "password" id = "password" required= "required" >
      <span id = "helppword2"></span><br>
      <input type="submit" value= "Login"  onclick = "return validate_admin_login()"name = "login_button">

   </form>
</div>

</div>

   <!-- End of file view_admin_login.php */
    /* Location: ./application/views/admin/view_admin_login.php */ -->
    
