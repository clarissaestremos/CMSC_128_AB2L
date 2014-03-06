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
                        <?php
                            if($overdue != NULL){
                        ?>
                        <div id='tabs-1'>
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
                                                <td><b>{$row->first_name} {$row->middle_initial} {$row->last_name} </b><br/>{$row->account_number}</td>
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
										echo "<td><form action='controller_reservation/extend' id='overext$count' method='post'>
												<input type='hidden' name='res_number' value='{$row->res_number}' />
												<input type='submit' class='background-red' name='extend' value='Extend' />
												</form></td>";
										echo	"<td><form action='controller_outgoing_books/return_book/' id='overret$count' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='return' value='Return' />
                                            </form></td>";
                                        echo "</tr>";
                                        $count++;
                                    }
                                ?>
                                </tbody>
                            </table>
                                </tbody>
                            </table>
                            <div class="footer pagination">
                                <ul class="nav">
                                    <li><a href="#">Prev</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                                <form action='controller_outgoing_books/send_email' method='post' class="float-right">
                                   <input type='submit' name='notify_all' value='Notify All' enabled/>
                                </form>
	                    </div>
                        <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h2 class='color-grey'>There is no currently overdue books!</h2>";
                                echo "<hr>";
                            }
                            echo "</div>";
                            if($query != NULL){
                        ?>
                        <div id='tabs-2'>
                        <div class="panel datasheet cell">
                            <div class="header background-red">
                                List of borrowed books
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
                                    <tr>
                                <?php
                                    $date = date("Y-m-d");
                                    $count = 1;
                                    $base = base_url();
                                    foreach($query as $row){
                                        echo "<tr>
                                                <td>$count</td>
                                                <td><b>{$row->first_name} {$row->middle_initial} {$row->last_name} </b><br/>{$row->account_number}</td>
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
                                                <td>{$row->due_date}</td>";;
										if($row->due_date != $date){
											echo "<td></td>";
										}else{
											echo "<td><form action='controller_reservation/extend' id='borrext$count' method='post'>
												<input type='hidden' name='res_number' value='{$row->res_number}' />
												<input type='submit' class='background-red' name='extend' value='Extend' />
												</form></td>";
										}
                                        echo "<td><form action='$base/index.php/admin/controller_outgoing_books/return_book/' id='borrret$count' method='post'>
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
                                <!--<form action='' method='post' class="float-right">
                                   <input type='submit' name='notify_all' value='Notify All' enabled/>
                                </form>-->
                        </div>
                        <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h2 class='color-grey'>There is no currently borrowed books!</h2>";
                                echo "<hr>";

                            }
                            echo "</div>";
                        ?>
	       </div>
</div>
<div id="returndialog" title="Return Book Dialog">
    <p>Are you sure that you want to confirm that this book was properly returned?</o>
</div>
<div id="extenddialog" title="Extend Book Dialog">
    <p>Are you sure that you want to extend the due date of this book?</o>
</div>
<script>
    $(document).ready(function(){
        $('#tabs').tabs();

        $("#extenddialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
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
                alert('You have successfully extend the due date of a book!');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });
        $("#returndialog").dialog({
        autoOpen: false,
        modal: true,
        closeOnEscape: true,
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
                alert('You have successfully confirm that a book was properly returned!');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }

    });
    $( "form[id^='borrret']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#returndialog" ).dialog( "open" );
    });
    $( "form[id^='borrext']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#extenddialog" ).dialog( "open" );
    });
    $( "form[id^='overret']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#returndialog" ).dialog( "open" );
    });
    $( "form[id^='overext']" ).submit(function (e) {
        e.preventDefault();
        form = $(this).get(0).id;
        $( "#extenddialog" ).dialog( "open" );
    });

    var form;

    });
</script>