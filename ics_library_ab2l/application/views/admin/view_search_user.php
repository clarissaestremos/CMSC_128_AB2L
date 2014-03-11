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
           <h1>Admin <small><?php echo $current?></small></h1>
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
                Results
            </div>
<div id="showSearchUser"></div>
 </div>
    </div>
</div>