<div id="thisbody" class="body width-fill background-white">
					<div class="cell">
                        <div class="page-header cell">
                                        <h1>Admin <small>View Borrowed Books</small></h1>
                        </div>
                        <div id="tabs" style="border:0px solid black; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 1em;">
                        <ul style="border:0px solid black; border-bottom: 1px solid #aaa; border-radius: 0px;" class="background-white">
                            <li><a href="#tabs-1">Overdue Books</a></li>
                            <li><a href="#tabs-2">Borrowed Books</a></li>
                        </ul>
                        <div id='tabs-1'>
                        <?php
                            if($overdue != NULL){
                        ?>
                        
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of overdue books
	                        </div>
                                 <script type="text/javascript">
                                $(window).load(function(){
                                    $.ajax({
                                        url: base_url+"index.php/admin/controller_reservation/get_book_data",                    //no need to edit this
                                        type: 'POST',
                                        async: true,
                                        success: function(result){                  //displays result.
                                            $('#displayArea').html(result);
                                        }
                                    });
                                    $.ajax({
                                        url: base_url+"index.php/admin/controller_reservation/get_book_data2",                    //no need to edit this
                                        type: 'POST',
                                        async: true,
                                        success: function(result){                  //displays result.
                                            $('#displayArea2').html(result);
                                        }
                                    });
                                    
                                });
                                </script>
                                <div id="displayArea"></div>
                                
                                <form action='controller_outgoing_books/send_email' method='post' id='notifyall' class="float-right">
                                    <input type='hidden' name='notify_all' value='notif'/>
                                   <input type='submit' value='Notify All' enabled/>
                                </form>
	                    </div>
                        <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h2 class='color-grey'>There are no currently overdue books!</h2>";
                                echo "<hr>";
                            }
                        ?>
                            </div>
                            <div id='tabs-2'>
                        <?php
                            if($query != NULL){
                        ?>
                        
                        <div class="panel datasheet cell">
                            <div class="header background-red">
                                List of borrowed books
                            </div>
                            <div id="displayArea2"></div>
                                <!--<form action='' method='post' class="float-right">
                                   <input type='submit' name='notify_all' value='Notify All' enabled/>
                                </form>-->
                        </div>
                        <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h2 class='color-grey'>There are no currently borrowed books!</h2>";
                                echo "<hr>";

                            }
                        ?>
	       </div>
</div>
<div id="returndialog" title="Return Book Dialog">
    <p>Are you sure that this material was properly returned?</o>
</div>
<div id="extenddialog" title="Extend Book Dialog">
    <p>Do you really want to extend the due date of this material?</o>
</div>
<div id="returnsucc" title="Return Book Success">
    <p>You have successfully returned a material!</p>
</div>
<div id="extendsucc" title="Extend Book Success">
    <p>You have successfully extend the due date of a material!</p>
</div>
<div id='notifydialog' title='Notify Overdue Books Dialog'>
    <p>Do you really want to notify all users regarding their overdue material?</p>
</div>