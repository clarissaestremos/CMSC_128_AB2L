<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="<?php echo  base_url() ?>js/module/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo  base_url() ?>js/module/jquery/global.js" type="text/javascript"></script>
<script src="<?php echo  base_url() ?>js/jquery-ui.js"></script>
	
<script type = "text/javascript">
	var base_url = "<?php echo base_url() ?>";
	$(function() {
		$( "#accordion" ).accordion({
	   		heightStyle: "content"
	   	});
	
	   	$("#accordion").accordion({
        		activate: function (event, ui) { 
		        active = $( "#accordion" ).accordion( "option", "active" );
		 		if(active == 1){
		 			$('#sinput').val("");
		 			$('#autosuggest_list').hide();
		 		}
		 		else{
		 			$('#title').val("");
		 			$('#author').val("");
		 			$('#subject').val("");
		 			$('#year_of_pub').val("");
		 			$('#tag_name').val("");
	 			}
 			}
    		});
   		
 	});
</script>

<div id="thisbody" class="body width-fill background-white">
	<div class="cell">
		<div class="page-header cell">
                	<h1>Admin <small>Search Books</small></h1>
		</div>
		
		<div id="accordion">
			<h3>Basic Search<h3>
			<div class="col body">
				<form method="post" id="search_form" name="search_form" autocomplete="off" class="col width-3of4">
					<select id="category" name="category" class="form-elements" onchange="autosuggest(sinput.value, this.value, 'admin');showAutoSuggestResultinBody(sinput.value,'admin','search_form', false);">
						<option value="title">Title</option>
						<option value="author">Author</option>
						<option value="subject">Subject</option>
						<option value="year_of_pub">Publication</option>
						<option value="tag_name">Tag</option>
					</select>
					<input type="text" required="required" placeholder="Search..." class="form-elements background-white" id="sinput" name="sinput" onkeyup="autosuggest(this.value, category.value, 'admin');showAutoSuggestResultinBody(this.value,'admin','search_form', false);" />
					<input type="button" value="Basic Search" class="form-elements" id="basicSearch" onclick="get_data('admin', 'search_form',true);"/>
					<div class="autosuggest" id="autosuggest_list"></div>
					
				</form>
			</div>
			
			<h3>Advanced Search<h3>
			<div class="col body">
				<form method="post" id="search2_form" name="search2_form" class="col width-3of4">
					<div class="cell">
						<div class="col width-1of3">
							<div class="cell">
								<label for="title">
									<p>Title:</p>
								</label>
							</div>
						</div>
						
						<div class="col width-fill">
								<input type="text" id="title" name="title" placeholder="Title" class="background-white"/>
						</div>
					</div>
				
				
					<div class="cell">
						<div class="col width-1of3">
							<div class="cell">
								<label for="author">
									<p>Author:</p>
								</label>
							</div>
						</div>
					
						<div class="col width-fill">
								<input type="text" id="author" name="author" placeholder="Author"/>
						</div>
					</div>
				
				
					<div class="cell">
						<div class="col width-1of3">
							<div class="cell">
								<label for="subject">
									<p>Subject:</p>
								</label>
							</div>
						</div>
					
						<div class="col width-fill">
								<input type="text" id="subject" name="subject" placeholder="Subject"/>
						</div>
					</div>
					
					
					<div class="cell">
						<div class="col width-1of3">
							<div class="cell">
								<label for="year_of_pub">
									<p>Publication:</p>
								</label>
							</div>
						</div>
					
						<div class="col width-fill">
								<input type="text" id="year_of_pub" name="year_of_pub" placeholder="Publication"/>
						</div>
					</div>
					
					
					<div class="cell">
						<div class="col width-1of3">
							<div class="cell">
								<label for="tag_name">
									<p>Tag:</p>
								</label>
							</div>
						</div>
						<div class="col width-fill">
								<input type="text" id="tag_name" name="tag_name" placeholder="Tag"/>
						</div>
					</div>
					
					<div class="cell width-1of3">
						<input type="button" value="Advanced Search" class="form-elements" onclick="get_data('admin', 'search2_form');" />
					</div>
				</form>
			</div>
		</div>
    </div>
	<div id="list_area" class="cell"></div>
	</div>

	<div id='mydeletebook' title='Delete Book Confirmation'>
	    <p>Do you really wish to delete this book?</p>
	</div>

	<div id='deletebookconfirm' title='Delete Book Confirmation'>
	    <p>Are you 100% sure that you want to delete this book? Doing so will delete the book in the database.</p>
	</div>

	<script>
	    $(document).ready(function(){
	        $("#mydeletebook").dialog({
	        autoOpen: false,
	        modal: true,
	        resizable: false,
      		width: 300,
      		minHeight: 200,
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
        resizable: false,
        width: 300,
        minHeight: 200,
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
        // console.log(thisform);
        return false;
    }

    var thisform;
</script>

<!-- End of file view_search_book */
    /* Location: ./application/views/admin/view_search_book.php */ -->
