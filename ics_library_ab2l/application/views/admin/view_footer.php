			</div>
		</div>
	</body>
	<script src="<?php echo base_url() ?>js/main_admin.js" ></script>
</html>
<script>
$(document).ready(function(){
	$heightbody = $("#thisbody").css("height");
	console.log();
	$heightaside = $("aside").css("height");
	console.log($heightbody);
	console.log($heightaside);
    if($heightbody > $heightaside){
		$("#side-navigation").css("height",$heightbody);
	}
	else if($heightbody < $heightaside){
		$("#side-navigation").css("height",$heightbody);
	}
	});

</script>