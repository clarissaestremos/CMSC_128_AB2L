<!-- Script for ajax in pagination of viewing all the list of books -->
<script type="text/javascript">
    var base_url = "<?php echo base_url() ?>";
    window.onload = get_data1;          //on default load of page get_data1() will be called 

    function get_data1(){ 
         
        $.ajax({ //change the url if you are about to change the location
            url: base_url+"index.php/user/controller_books/get_book_data1",   
            
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

    //Serialize the form
    function serialize_form1(){
        return $("#sort_list").serialize();
    }
</script>
<!-- End of script file -->

<!-- Start of main body in viewing all the list of books in the user side
This file will basically prints all the books in the library with pagination -->
<div id="main-body" class="site-body">
    <div class="site-center">
        <div class="cell body">
            <p class="tiny">View Books</p>
        </div>
        
        <div class="col">
            <div class="cell">
                <!-- Two select will be present on the page one is for choosing what to sort
                    the other one is to whether in descending or ascending 
                    If the value in the select changes the get_data1() function will be called-->
                <center><form method="post" id="sort_list" name="sort_list" action="<?php echo site_url("application/controllers/user/controller_books/sort_by()"); ?>">
                <b> Sort List By: </b> 
                <select id = "sort_by" name ="sort_by" onchange = "get_data1();">
                  <option value="subject">Subject</option>
                  <option value="author">Author</option>
                  <option selected = "selected" value="title">Title</option>
                  <option value="type">Type</option>
                  <option value="no_of_available">Availability</option>
                </select>

                <select id = "order_by" name ="order_by" onchange = "get_data1();">
                  <option value="asc">Ascending</option>
                  <option value="desc">Descending</option>
                </select>

                </form><br/></center>
                <div class="panel datasheet">
                    <div class="header text-center background-red">
                        List of all books
                    </div>
                    <!-- This is where the results will be printed -->
                    <div id = "change_here">        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
