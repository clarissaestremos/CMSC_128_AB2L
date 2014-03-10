<div id="thisbody" id="thisbody" class="body width-fill background-white">
    <div class="cell">
        <div class="page-header cell">
           <h1>Admin <small>Home Page</small></h1>
        </div>
        <div class="cell">
        	<div id="tabs" style="border:0px solid black; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 1em;">
        		<ul style="border:0px solid black; border-bottom: 1px solid #aaa; border-radius: 0px;" class="background-white">
        			<li><a href="#tabs-1">Overdue Books</a></li>
        			<li><a href="#tabs-2">Outgoing Books</a></li>
        			<li><a href="#tabs-3">Pending User Account</a></li>
        			<li><a href="#tabs-4">Announcements</a></li>
        		</ul>
        		<div id="tabs-1">
        			<?php
        				$base = base_url();
                            if($overdue != NULL){
                        ?>
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of overdue books
	                        </div>
	                        <table class="body">
                                <thead>
                                    <tr>
                                        <th style="width: 2%;">#</th>
                                        <th style="width: 17%;">Borrower</th>
                                        <th style="width: 40%;">Material</th>
                                        <th style="width: 12%;">Date Borrowed</th>
                                        <th style="width: 11%;">Due Date</th>
                                        <th style="width: 9%;"></th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $date = date("Y-m-d");
                                    $count = 1;
                                    foreach($overdue as $row){
                                        echo "<tr>
                                                <td>$count</td>
                                                <td><b>{$row->first_name} {$row->middle_initial}. {$row->last_name} </b><br/>{$row->account_number}</td>
                                                <td><b>{$row->title}</b><br/>";

                                                	$data['multi_valued'] = $this->model_reservation->get_book_authors($row->id);
					                                $authors="";
					                                foreach($data['multi_valued'] as $authors_list){
					                                    $authors = $authors."{$authors_list->author},";
					                                }
					                                echo "$authors ($row->year_of_pub)<br/>
					                                Call Number: {$row->call_number}</td>";

                                                echo "</td>
                                                <td>{$row->date_borrowed}</td>
                                                <td>{$row->due_date}</td>";
                                        echo "<td><form action='$base/index.php/admin/controller_reservation/extend' id='overext$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='extend' value='Extend' />
                                                </form></td>";
                                        echo "<td><form action='$base/index.php/admin/controller_outgoing_books/return_book/' id='overret$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='return' value='Return' />
                                            </form></td>";
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
                                <form action="<?php echo $base ?>index.php/admin/controller_outgoing_books/send_email" method='post' id='notifyall' class="float-right">
                                	<input type='hidden' name='notify_all' value='notify'/>
                                   <input type='submit' value='Notify All' enabled/>
                                </form>
	                    </div>

	                    <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h4 class='color-grey'>There are no currently overdue books!</h4>";
                                echo "<hr>";
                            }
                        ?>
        		</div>
        		<div id="tabs-2">
        			 <?php
                            if($reserved != NULL){
                        ?>
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of outgoing books
	                        </div>
	                        <table class="body">
	                            <thead>
	                                <tr>
	                                    <th style="width: 2%;">#</th>
	                                    <th style="width: 20%;">Borrower</th>
	                                    <th style="width: 40%;">Material</th>
										<th style="width: 10%;">Due Date</th>
	                                    <th style="width: 10%;"></th>
	                                    <th style="width: 10%;"></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	<?php
	                            	$count = 1;
	                                foreach($reserved as $row) {
										if($row->rank ==1){
											echo "<tr>
												<td>$count</td>
												<td><b>{$row->first_name} {$row->middle_initial}. {$row->last_name}</b><br/>{$row->account_number}</td>
												<td><b>{$row->title}</b><br/>";

	                                                	$data['multi_valued'] = $this->model_reservation->get_book_authors($row->id);
						                                $authors="";
						                                foreach($data['multi_valued'] as $authors_list){
						                                    $authors = $authors."{$authors_list->author},";
						                                }
						                                echo "$authors ($row->year_of_pub)<br/>
						                                Call Number: {$row->call_number}</td>";

	                                                echo "</td>
												<td>{$row->due_date}</td>";
											echo "<td><form action='$base/index.php/admin/controller_outgoing_books/reserve/' id='confirm$count' method='post'>
												<input type='hidden' name='res_number' value='{$row->res_number}' />
												<input type='submit' class='background-red' name='reserve'  onclick='return confirmBookReserve(confirm$count); 'value='Confirm' />
											</form></td>";				//button to be clicked if the reservation will be approved; functionality of this not included
											echo "<td><form action='$base/index.php/admin/controller_outgoing_books/cancel/' id='cancel$count' method='post'>
												<input type='hidden' name='res_number' value='{$row->res_number}' />
												<input type='submit' class='background-red' name='cancel' onclick='return confirmDeleteReserve(confirm$count);' value='Cancel' />
											</form></td>";	
											echo "</tr>";echo "</tr>";

											$count++;
										}
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
	                    </div>
	                    <?php
	                    	}
	                    	else{
	                    		echo "<hr>";
                                echo "<h4 class='color-grey'>There are no currently outgoing books!</h4>";
                                echo "<hr>";
	                    	}
	                    ?>
        		</div>
        		<div id="tabs-3">
        			<?php
        				if($users != NULL){
        			?>
        			<div class="panel datasheet cell">
				            <div class="header background-red">
				                List of Users
				            </div>
				            <table class="body">
				                <thead>
				                    <tr>
				                        <th style="width: 2%;">#</th>
				                        <th style="width: 8%;">ID Number</th>
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
				                        foreach ($users as $row) {
											echo "<tr>";
											echo "<td>$count</td>";
											echo "<td>".$row->account_number."</td>";
											$fullName = $row->first_name." ".$row->middle_initial.". ".$row->last_name;
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

											if($stat === "approve"){
											echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'>Click to borrow</a></td>";
											}
											else{
												echo "<form action='$base/index.php/admin/controller_view_users/approve_user' id='accountconfirm$count' method='POST'>";
				                                echo "<input type='hidden' name='account_number1' value='$row->account_number'/>";
				                                 echo "<input type='hidden' name='approve' value='approve'/>";
				                                echo "<td>"."<input type ='submit' class='background-red' name='approve' onclick='return confirmUser(accountconfirm$count);' value = 'Confirm'>"."</td>";   //'Validate' button. Functionality not included here.
				                                echo "</form>";	//'Validate' button. Functionality not included here.
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
				           </div>
				           <?php
				           	}
				           	else{
				           		echo "<hr>";
                                echo "<h4 class='color-grey'>There are no currently pending user account!</h4>";
                                echo "<hr>";
				           	}

				           ?>
        		</div>
        		<div id="tabs-4">
					<?php

/*
Uses explode to split the file, array_shift to remove the first element and returns its value,
and info to get row data.
*/

$counter = 0;
$txt_file = file_get_contents('./application/announcements.txt');
$rows = explode("*", $txt_file);
array_shift($rows);
if($rows != NULL){
foreach($rows as $row => $data)
{
	$counter = $counter + 1;
	$data1 = explode("^",$data);
	$info[$row]['date'] = $data1[0]; 
	$info[$row]['tc'] = $data1[1];

	if($counter>5) break;
	//echo 'Date: ' . ($date=$info[$row]['date']) . '<br />';

	array_shift($data1);

	foreach($data1 as $row1 => $data2)
	{
		$row_data = explode('#', $data2);
		$info[$row1]['title'] = $row_data[0];
		$info[$row1]['content'] = $row_data[1];

		echo "<div class='panel cell'>";
		echo "<div class='gradient header'>Title: {$info[$row1]['title']}
		<form action='$base/index.php/admin/controller_announcement/find' class='float-right' method='post'>
				<input type='hidden' name='date' ' value='{$info[$row]['date']}' />
				<input type='hidden' name='delete'/>
				<input type='submit' name='edit' style='height:1.5em; font-size: 10px; line-height: 0px;' value='Edit' enabled/>
				<input type='submit' name='delete' id='delete$count' value='Delete' style='height:1.5em; font-size:10px; line-height: 0px;'enabled/>
				</form><br/>
		Date: {$info[$row]['date']}
				</div>";
		echo "<div class='body'>";
		echo "<div class='cell'>";
		echo "<div>";
		echo "</div>";
		echo "{$info[$row1]['content']}<br/>";
		echo "</div>";
		echo "</div>";
		echo "</div><hr/>";
	}
	
}
}
else{
	echo "<div class='cell'><h2>There is no announcement to display!</h2></div><hr/>";
}
	echo "<form action='$base/index.php/admin/controller_announcement/deleteAll' id='deleteall' class='float-right' style='margin-left: 5px;' method='post'>
			<input type='hidden' name='delete_all' value='del'/>
			<input type='submit'' value='Delete All Announcements' enabled/>
		</form>
		<form action='$base/index.php/admin/controller_announcement/viewForm' class='float-right' method='post'>
			<input type='submit' name='new' value='Add New Announcement' enabled/>
		</form>

		";
?>
        		</div>
        	</div>
        </div>
	</div>
</div>
</div>
<div id="deletealldialog" title="Add Announcement Confirmation Dialog">
	<p>Are you sure that you want to delete all the announcement?</o>
</div>
<div id="deletedialog" title="Add Announcement Confirmation Dialog">
	<p>Are you sure that you want to delete this announcement?</o>
</div>
<div id="deleteconfirm" title="Add Announcement Confirmation Dialog">
	<p>Are you really sure that you want to delete all announcements? Doing so will removed it from the database.</p>
</div>
<div id="confirmdialog" title="Confirm Borrowing Book Confirmation">
	<p>Are you sure that you want confirm the borrowing of this book?</o>
</div>
<div id="canceldialog" title="Cancel Reservation Confirmation">
	<p>Are you sure that you want to cancel the reservation of this book?</o>
</div>
<div id="returndialog" title="Return Book Dialog">
    <p>Are you sure that you want to confirm that this book was properly returned?</o>
</div>
<div id="extenddialog" title="Extend Book Dialog">
    <p>Are you sure that you want to extend the due date of this book?</o>
</div>

<div id="confdialog" title="Confirm Account Dialog">
    <p>Are you sure that you want to activate this user account?</p>
</div>

<div id="deactivatedialog" title="Deactivate Account Dialog">
    <p>Do you really wish to deactivate all account?</p>
</div>
<div id="dsucc" title="Delete Announcement Success">
   <p>You have successfuly deleted an announcement</p>
</div>
<div id="dasucc" title="Delete All Announcement Success">
  <p>You have successfully deleted all the announcement!</p>
</div>
<div id='confirmsuccess' title="Confirm Borrowing Book Success">
	<p>You have successfuly confirm an outgoing book</p>
</div>
<div id="cancelsuccess" title="Cancel Reservation Success">
	<p>You have successfully cancel a book reservation</p>
</div>
<div id="confsuccess" title="Confirm User Account Success">
    <p>You have successfully confirmed an user account!!</p>
</div>
<div id="returnsucc" title="Return Book Success">
    <p>You have successfully returned a book!</p>
</div>
<div id="extendsucc" title="Extend Book Success">
    <p>You have successfully extend the due date of a book!</p>
</div>
<div id='notifydialog' title='Notify Overdue Books Dialog'>
    <p>Do you really want to notify all users regarding their overdue books?</p>
</div>