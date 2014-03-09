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
	                                foreach($query as $row) {
										echo "<tr>
											<td>$count</td>
											<td><b>{$row->first_name} {$row->middle_initial}{$row->last_name}</b><br/>{$row->account_number}</td>
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
										echo "<td><form action='controller_outgoing_books/reserve/' id='confirm$count' method='post'>
											<input type='hidden' name='res_number' value='{$row->res_number}' />
											<input type='submit' class='background-red' name='reserve' value='Confirm' />
										</form></td>";				//button to be clicked if the reservation will be approved; functionality of this not included
										echo "<td><form action='controller_outgoing_books/cancel/' id='cancel$count' method='post'>
											<input type='hidden' name='res_number' value='{$row->res_number}' />
											<input type='submit' class='background-red' name='cancel' value='Cancel' />
										</form></td>";				//button to be clicked if the reservation will be cancelled; functionality of this not included
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
                                echo "<h2 class='color-grey'>There is no currently outgoing books!</h2>";
                                echo "<hr>";
	                    	}
	                    ?>
	                </div>				
	            </div>
<div id="confirmdialog" title="Confirm Borrowing Book Confirmation">
	<p>Are you sure that you want confirm the borrowing of this book?</o>
</div>
<div id="canceldialog" title="Cancel Reservation Confirmation">
	<p>Are you sure that you want to cancel the reservation of this book?</o>
</div>
<div id='confirmsuccess' title="Confirm Borrowing Book Success">
	<p>You have successfuly confirm an outgoing book</p>
</div>
<div id="cancelsuccess" title="Cancel Reservation Success">
	<p>You have successfully cancel a book reservation</p>
</div>