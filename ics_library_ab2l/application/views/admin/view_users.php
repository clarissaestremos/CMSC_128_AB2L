<script type="text/javascript">
        var base_url = "<?php echo base_url() ?>";
        window.onload = get_data1;

        function get_data1(){ 
         
            $.ajax({
                
                url: base_url+"index.php/admin/controller_view_users/get_info",     //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
                
                type: 'POST',
                async: false,
                    success: function(result){
                    $('#change_here').html(result);
                    $('#change_here').fadeIn(1000);
                    $('#change_here').removeClass('loading');
                }
            });

        }

</script>

<div id="thisbody" class="body width-fill background-white">
	<div class="cell">
        <div class="page-header cell">
           <h1>Admin <small>View Users</small></h1>
        </div>
        
        <?php if(isset($message)){ ?>
        <div>
            <?php echo $message ?>
        </div>
        <?php
            }
        ?>
	
	<div class="panel datasheet cell">
            <div class="header background-red">
                List of Users
            </div>

            <div id = "change_here"> </div>
		<form action='<?php echo base_url();?>index.php/admin/controller_view_users/deactivate' id='deactivateaccount' method='POST' class="float-right">
        	        <input type='hidden' name='deactivate' id='deactivate' value='deact'/>
			<input type ='submit' class='background-white' value = 'Deactivate All User Accounts'>
		</form>
	    </div>
        </div>
</div>


<div id="confdialog" title="Confirm Account Dialog">
    <h5>Are you sure that you want to activate this user account?</h5>
</div>

<div id="deactivatedialog" title="Deactivate Account Dialog">
    <h5>Do you really wish to deactivate all user accounts?</h5>
</div>
<div id="confsuccess" title="Confirm User Account Success">
    <p>You have successfully confirmed a user account!</p>
</div>

<!-- End of file view_users.php */
    /* Location: ./application/views/admin/view_users.php */ -->
