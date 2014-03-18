<script type="text/javascript">
    var base_url = "<?php echo base_url() ?>";
    window.onload = get_data1;

    function get_data1(){ 
         
        $.ajax({
            //url: "http://localhost/zurbano_module/index.php/controller_search_book/get_book_data",        //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
            url: base_url+"index.php/user/controller_books/get_book_data1",     //EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
            
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


    function serialize_form1(){
    //  document.write(str);
        return $("#sort_list").serialize();
    }
</script>

<div id="main-body" class="site-body">
    <div class="site-center">
        <div class="cell body">
            <p class="tiny">View Books</p>
        </div>
        
        <div class="col">
            <div class="cell">
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
                    <div id = "change_here">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
