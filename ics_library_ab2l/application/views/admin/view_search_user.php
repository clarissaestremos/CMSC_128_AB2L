<script type="text/javascript">
    var base_url = "<?php echo base_url() ?>";
    $(window).load(function(){
        $.ajax({
            url: base_url+"index.php/admin/controller_view_users/search_user";
            type: 'POST',
            data: 's_user': <?php echo $this->input->post('s_user');?>
            async: true,
                success: function(result){
                $('#showSearchUser').html(result);
                $('#showSearchUser').fadeIn(1000);
            }
        });
    });
</script>
<div id="thisbody" class="body width-fill background-white">
    <div class="cell">
        <div class="page-header cell">
           <h1>Admin <small>Search Users</small></h1>
        </div>
       
        <?php 
        if($results != NULL){
        echo '
         <div class="panel datasheet cell">
            <div class="header background-red">
                Results
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
                <tbody>';
                        $count = 1;
                        foreach ($results as $row) {
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
                            $base = base_url();
                            if($stat === "approve"){
                            echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'><input type='button' style='background:#ccc;' value='Click to borrow'/></a></td>";
                            }
                            else{
                                echo "<form action='$base"."index.php/admin/controller_view_users/approve_user' id='accountconfirm$count' method='POST'>";
                                echo "<input type='hidden' name='account_number1' value='$row->account_number'/>";
                                echo "<input type='hidden' name='approve' value='app'/>";
                                echo "<td>"."<input type ='submit' class='background-red' onclick='return confirmUser(accountconfirm$count);' name='approve' value = 'Confirm'>"."</td>";
                                echo "</form>";
                            }
                            
                            echo "</tr>";
                            $count++;
                        }

               echo'</tbody>
            </table>';
        }
        else{
            echo "<div class='cell'>
                <hr>
                <h5>User(s) not found!</h5>
                <hr>
            </div>";
        }
            ?>
    </div>
</div>