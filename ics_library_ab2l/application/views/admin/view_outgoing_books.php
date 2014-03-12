<script type="text/javascript">
        var base_url = "<?php echo base_url() ?>";
        window.onload = get_data1;

        function get_data1(){ 
         
            $.ajax({
                
                url: base_url+"index.php/admin/controller_outgoing_books/get_info",     //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
                
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
                                        <h1>Admin <small>Outgoing Books</small></h1>
                                    </div>
                        <?php
                            if($query != NULL){
                        ?>
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of outgoing books
	                        </div>
	                        <div id = "change_here"> </div>
	                    </div>
	                    <?php
	                    	}
	                    	else{
	                    		echo "<hr>";
                                echo "<h2 class='color-grey'>There are no currently outgoing books!</h2>";
                                echo "<hr>";
	                    	}
	                    ?>
	                </div>				
	            </div>
<div id="confirmdialog" title="Confirm Borrowing Book Confirmation">
	<p>Are you sure that you want to borrow this book?</o>
</div>
<div id="canceldialog" title="Cancel Reservation Confirmation">
	<p>Are you sure that you want to cancel the reservation of this book?</o>
</div>
<div id='confirmsuccess' title="Confirm Borrowing Book Success">
	<p>You have successfuly confirmed an outgoing book.</p>
</div>
<div id="cancelsuccess" title="Cancel Reservation Success">
	<p>You have successfully cancelled a book reservation.</p>
</div>