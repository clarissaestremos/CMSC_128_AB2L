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
            <table class="body">
                <thead>
                    <tr>
                        <th style="width: 2%;">#</th>
                        <th style="width: 8%;">Student Number</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 5%;">Course</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 8%;">Classification</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                    	$count = 1;
                        foreach ($results as $row) {
							echo "<tr>";
							echo "<td>$count</td>";
							echo "<td>".$row->account_number."</td>";
							$fullName = $row->first_name." ".$row->middle_initial." ".$row->last_name;
							echo "<td>".$fullName."</td>";
							echo "<td>".$row->course."</td>";
							echo "<td>".$row->email."</td>";
							echo "<td>".$row->classification."</td>";
							$stat = $row->status;

							/*
								If status not yet 'approve', meaning the account was not yet validated,
								a button with a value 'Validate' will be seen in the status column.
								If status is already 'approve', meaning the account was already validated,
								'Registered' will be displayed on the said column. 
							*/
                            $base = base_url();
							if($stat === "approve"){
							echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'><input type='button' class='background-blue' value='Click to borrow'/></a></td>";
							}
							else{
								echo "<form action='$base"."index.php/admin/controller_view_users/approve_user' id='confirmaccount$count' method='POST'>";
                                echo "<input type='hidden' name='account_number1' value='$row->account_number'/>";
                                echo "<input type='hidden' name='approve' value='approve'/>";
                                echo "<td>"."<input type ='submit' class='background-red' name='approve' value = 'Confirm'>"."</td>";
                                echo "</form>";
						    }
							
							echo "</tr>";
							$count++;
						}
					?>
                </tbody>
            </table>
            <div class="footer pagination">
                <ul class="nav">
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
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
    <h5>Do you really wish to deactivate all account?</h5>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#confdialog").dialog({
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
            "Yes": function() {
                document.getElementById(form).submit();
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });

        $("#deactivatedialog").dialog({
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
            "Yes": function() {
                document.getElementById(form).submit();
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });

        $( "form[id^='confirmaccount']" ).submit(function (e) {
            e.preventDefault();
                form = $(this).get(0).id;
                $( "#confdialog" ).dialog( "open" );
        });
         $( "form[id='deactivateaccount']" ).submit(function (e) {
                e.preventDefault();
                form = $(this).get(0).id;
                $( "#deactivatedialog" ).dialog( "open" );
        });

    });
    var form;
</script>