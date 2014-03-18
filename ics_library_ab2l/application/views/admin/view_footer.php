			</div>
		</div>
	</body>
	<script src="<?php echo base_url() ?>js/main_admin.js" ></script>
</html>

<script>
	$(document).ready(function(){
		var heightbody = $("#thisbody").css("height");
		var heightaside = $("aside").css("height");
		// console.log(heightbody);
		// console.log(heightaside);
		var heighta = heightaside.replace('px','');
		var heightb = heightbody.replace('px','');
		// console.log(heighta);
		// console.log(heightb);
		heighta = parseInt(heighta);
		heightb = parseInt(heightb);
		
	    		if(heightb > heighta){
				$("#side-navigation").css("height",heightbody);
			}
			
			else if(heightb < heighta){
				$("#side-navigation").css("height",700);
			}
	});

</script>
</html>
