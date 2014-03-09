<script type="text/javascript">
        var base_url = "<?php echo base_url() ?>";
        window.onload = get_data1;

        function get_data1(){  
        $.ajax({
        //url: "http://localhost/zurbano_module/index.php/controller_search_book/get_book_data",        //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
        url: base_url+"index.php/admin/controller_book/get_book_data1",     //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
        
        type: 'POST',
        async: false,
        data: serialize_form1(),
        success: function(result){
            $('#change_here').html(result);
            $('#change_here').fadeIn(1000);
            $('#change_here').removeClass('loading');
        }
        });

}

function serialize_form1()
{
//  document.write(str);
    return $("#sort_list").serialize();
}
</script>

<div id="thisbody" class="body width-fill background-white">
                    <div id="whoscell" class="cell">
                        <div class="page-header cell">
                                        <h1>Admin <small>View Books</small></h1>
                        </div>
                        <?php
                            if(isset($message)){
                        ?>
                        <div id="success" class="widht-fill">
                            <div id="check" class="cell">
                                <p>
                                <?php
                                    echo $message;          
                                ?>
                                </p>
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                         <center><form method="post" id="sort_list" name="sort_list" action="<?php echo site_url("application/controllers/user/controller_books/sort_by()"); ?>">
                                        <b> Sort List By: </b> 
                                        <select id = "sort_by" name ="sort_by" onchange = "get_data1();" onload = "get_data1();">
                                              <option value="subject">Subject</option>
                                              <option value="author">Author</option>
                                              <option selected="selected"value="title">Title</option>
                                              <option value="type">Type</option>
                                              <option value="no_of_available">Availability</option>
                                        </select>
                                         <select id = "order_by" name ="order_by" onchange = "get_data1();">
                                              <option value="asc">Ascending</option>
                                              <option value="desc">Descending</option>
                                        </select>

                                    </form></center>
                        <div class="panel datasheet cell">
                            <div class="header background-red">
                                List of all books
                            </div>
                            <div id = "change_here"> </div>
                            
                                    <form action="<?php echo base_url(); ?>index.php/admin/controller_add_books" method='post'>
                                            <input type='submit' name='add' class="float-right" value='Add Book' enabled/>
                                    </form>
                        </div>
                    </div>
                </div>
<div id='mydeletebook' title='Delete Book Confirmation'>
    <h5>Do you really wish to delete this book?</h5>
</div>
<div id='deletebookconfirm' title='Delete Book Confirmation'>
    <h5>Are you 100% sure that you want to delete this book? Doing so will delete the book in the database.</h5>
</div>
<script>
    $(document).ready(function(){
        $("#mydeletebook").dialog({
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
                $(this).dialog('close');
               $('#deletebookconfirm').dialog('open');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }
        });

        $("#deletebookconfirm").dialog({
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
                $(this).dialog('close');
               thisform.submit();
            },
            "No": function() {
                $(this).dialog('close');
            }
        }
        });
    });

    function trySubmit(myformid){
        thisform = myformid;
        $('#mydeletebook').dialog('open');
        console.log(thisform);
        return false;
    }

    var thisform;
</script>