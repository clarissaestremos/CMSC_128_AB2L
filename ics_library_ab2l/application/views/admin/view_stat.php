<script src="<?php echo base_url(); ?>/js/charts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/js/charts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/js/charts/amcharts/themes/chalk.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            var chart;
            var legend;

            var chartData = [];
			<?php
			  // query MySQL and put results into array $results
			  foreach ($results as $row) {
				  echo "chartData.push({title:'{$row->title}', value:{$row->book_stat}});";
			  }
			?>
			
			var chartProp = {
				"type": "pie",
				"theme": "dark",
				"titles": [{
					"text": "Book Statistics - Top 10 Most Borrowed Books",
					"size": 20
				}],
				
				"valueField": "value",
				"titleField": "title",
				"fontSize": 13,
				"fontFamily": "Verdana",
				
				"startDuration": 2,
				"labelRadius": 10,
				
				"depth3D": 10,
				"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
				"angle": 15,
				"exportConfig":{	
				  "menuItems": [{
				  "icon": '/export.png',
				  "format": 'png'	  
				  }]  
				}
			};
			chartProp.dataProvider = chartData;
		
			var chart = AmCharts.makeChart("chartdiv", chartProp);
			


        </script>

	<style type="text/css">
		#chartdiv{
			height: 500px; 
			width:inherit; 
			font-size:11px; 
			<!--background: url('<?php echo base_url();?>imgs/black-board.jpg');-->
			border-radius:10px;
		}
		
	</style>
	
<div id="thisbody" class="body width-fill background-white">
	<div class="cell">
        <div class="page-header cell">
           <h1>Admin <small>Material Statistics</small></h1>
        </div>
        <div class = "hero-unit">
		
			<div id="chartdiv"></div>
    </div>
</div>
</div>
