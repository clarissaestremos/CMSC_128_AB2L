<!-- Script for ajax in pagination of viewing list of borrowed books -->
<script type="text/javascript">
    var base_url = "<?php echo base_url() ?>";
    window.onload = get_data1;          //on default load of page get_data1() will be called 
    
    function get_data1(){ 
     
        $.ajax({ //change the url if you are about to change the location            
            url: base_url+"index.php/user/controller_book/get_book_data",     //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
            type: 'POST',
            async: false,
            success: function(result){      //change here is the name of the div to display the results
                $('#change_here').html(result);
                $('#change_here').fadeIn(1000);
                $('#change_here').removeClass('loading');
            }
        });
    
    }

</script>


<div id="main-body" class="site-body">
    <div class="site-center">
        <div class="cell body"> </div>
            <div class="col">
                <div class="cell">
                    <?php
                         if($result1 != null){
                    ?>
        
                        <div class="panel datasheet">
                            <div class="header text-center background-red">
                                <?php echo $header1; ?>
                            </div>
                            <!-- FIRST DIV TO SHOW THE LIST OF OVERDUE BOOKS -->
                            <table class="body fixed">
                            <thead>
                                <tr>
                                    <th style="width: 2%;">#</th>
                                    <th style="width: 15%;" nowrap="nowrap">Subject</th>
                                    <th style="width: 45%;" nowrap="nowrap">Material</th>
                                    <th style="width: 8%;" nowrap="nowrap">Type</th>
                                    <th style="width: 13%;" nowrap="nowrap">Date Borrowed</th>
                                    <th style="width: 13%;" nowrap="nowrap">Due Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $count = 1;
                                    
                                    foreach($result1 as $row){
                                        echo "<tr>";
                                            echo "<td>$count</td>";
                                                        
                                            $data['multi_valued'] = $this->model_get_list->get_book_subjects($row->id);
                                            $subjects = "";
                                            foreach ($data['multi_valued'] as $subject_list)
                                                $subjects = $subjects."{$subject_list->subject}<br/>";
                                            echo "<td>".$subjects."</td>";            
                                                        
                                            echo "<td><b>$row->title</b> <br/>";
                                            $data['multi_valued'] = $this->model_get_list->get_book_authors($row->id);
                                            $authors="";
                                            foreach($data['multi_valued'] as $authors_list){
                                                $authors = $authors."{$authors_list->author},";
                                            }
                                            echo "$authors ($row->year_of_pub)</td>";
            
                                            if ($row->type == "BOOK"){
                                                echo "<td><center><img title = 'BOOK' width = 30px height = 30px src='../../../images/type_book.png'/></center></td>";
                                            }
                                            else
                                                //image source: http://www.webweaver.nu/clipart/img/education/diploma.png
                                                echo "<td><img title = 'THESIS/SP'  width = 30px height = 30px src='../../../images/type_thesis.png' /></td>";
                                            echo "<td>".$row->date_borrowed."</td>";
                                            echo "<td>".$row->due_date."</td>";
                                         echo "</tr>";
                                        
                                        $count++;
                                    }
                                ?>
                                                
                            </tbody>
                            </table>
            
                            <div class="pagination">
                            </div>
                        </div>
                        <?php 
                            } 
                            // Else show that there is no list in the table
                            else{
                                echo "<hr>";
                                echo "<h2 class='color-grey'>$message1</h2>";
                                echo "<hr>";
                            }
                        ?>
                        <?php
                         if($result2 != null){
                        ?>
                        <br/>
                        <div class="panel datasheet">
                            <div class="header text-center background-red">
                                <?php echo $header2; ?>
                            </div>
                            <!-- SECOND TABLE TO SHOW THE LIST OF BORROWED BOOKS -->
                            <table class="body fixed">
                            <thead>
                                <tr>
                                    <th style="width: 2%;">#</th>
                                    <th style="width: 15%;" nowrap="nowrap">Subject</th>
                                    <th style="width: 45%;" nowrap="nowrap">Material</th>
                                    <th style="width: 8%;" nowrap="nowrap">Type</th>
                                    <th style="width: 13%;" nowrap="nowrap">Date Borrowed</th>
                                    <th style="width: 13%;" nowrap="nowrap">Due Date</th>
                                </tr>
                            </thead>

                        <tbody>
                        <?php
                            $count = 1;
                        
                            foreach($result2 as $row){
                                echo "<tr>";
                                    echo "<td>$count</td>";
                                                
                                    $data['multi_valued'] = $this->model_get_list->get_book_subjects($row->id);
                                    $subjects = "";
                                    foreach ($data['multi_valued'] as $subject_list)
                                        $subjects = $subjects."{$subject_list->subject}<br/>";
                                    echo "<td>".$subjects."</td>";            
                                                
                                    echo "<td><b>$row->title</b> <br/>";
                                    $data['multi_valued'] = $this->model_get_list->get_book_authors($row->id);
                                    $authors="";
                                    foreach($data['multi_valued'] as $authors_list){
                                        $authors = $authors."{$authors_list->author},";
                                    }
                                    echo "$authors ($row->year_of_pub)</td>";
    
                                    if ($row->type == "BOOK"){
                                        echo "<td><center><img title = 'BOOK' width = 30px height = 30px src='../../../images/type_book.png'/></center></td>";
                                    }
                                    else
                                        //image source: http://www.webweaver.nu/clipart/img/education/diploma.png
                                        echo "<td><img title = 'THESIS/SP'  width = 30px height = 30px src='../../../images/type_thesis.png' /></td>";
                                    echo "<td>".$row->date_borrowed."</td>";
                                    echo "<td>".$row->due_date."</td>";
                                echo "</tr>";
                                
                                $count++;
                            }
                        ?>
                                                
                     </tbody>
                    </table>
            
                    <div class="fpagination">
                </div>
            </div>
            <?php 
                } 
            
                else{
                    echo "<hr>";
                    echo "<h2 class='color-grey'>$message2</h2>";
                    echo "<hr>";
                }
            ?>
            <?php
             if($result3 != null){
            ?>
        
            <br/>
            <div class="panel datasheet">
                <div class="header text-center background-red">
                    <?php echo $header3; ?>
                </div>
                <div id = "change_here">
                </div>
            </div>
            <?php 
                } 
            
                else{
                    //If there is no result
                    echo "<hr>";
                    echo "<h2 class='color-grey'>$message3</h2>";
                    echo "<hr>";
                }
            ?>
            </div>
        </div>
    </div>
</div>
<!-- End of file view_borrowed_book.php -->
<!-- Location: ./application/view/user/view_borrowed_book.php -->
