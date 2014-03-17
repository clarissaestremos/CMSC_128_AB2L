<div id="main-body" class="site-body" style="">
				<div class="cell site-center" style="border-radius: 10px 10px 10px 10px;">
				<div class="cell body">
									<p class="tiny">Home</p>
				</div>
				<div class="width-full">
									<div id="wrapper" class="width-3of5 float-left">
								        <div class="slider-wrapper theme-default">
								            <div id="slider" class="slider" style="height:300px">
								                <img src="<?php echo base_url();?>images/home/1.jpg" data-thumb="<?php echo base_url();?>images/home/1.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/2.jpg" data-thumb="<?php echo base_url();?>images/home/2.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/3.jpg" data-thumb="<?php echo base_url();?>images/home/3.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/4.jpg" data-thumb="<?php echo base_url();?>images/home/4.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/5.jpg" data-thumb="<?php echo base_url();?>images/home/5.jpg" alt=""/>
								            	<img src="<?php echo base_url();?>images/home/6.jpg" data-thumb="<?php echo base_url();?>images/home/6.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/8.jpg" data-thumb="<?php echo base_url();?>images/home/8.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/9.jpg" data-thumb="<?php echo base_url();?>images/home/9.jpg" alt=""/>
								                <img src="<?php echo base_url();?>images/home/10.jpg" data-thumb="<?php echo base_url();?>images/home/10.jpg" alt=""/>
								            	<img src="<?php echo base_url();?>images/home/11.jpg" data-thumb="<?php echo base_url();?>images/home/11.jpg" alt=""/>
	
								            </div>
								        </div>
								    </div>

									<div class="col width-2of5 float-left">
		                                <div class="cell panel">
		                                	<div class="header" style="background:#656565;">
		                                		<h4 id="news" style="color:white;">News and Updates</h4>
		                                	</div>
		                                    <div class="body">
		                                        <div class="cell">
		                                                    <div id="tabs" class="tabs_rotate">
																<ul class="background-white">
		                                                        	
		                                                        	<?php

																		$counter = 0;
																		$count = 1;
																		$txt_file = file_get_contents('./application/announcements.txt');
																		$rows = explode("*", $txt_file);
																		array_shift($rows);

				                                               		
																		if($rows != NULL){
																			foreach($rows as $row => $data)
																			{
																				$counter = $counter + 1;
																				$data1 = explode("^",$data);
																				$info[$row]['date'] = $data1[0]; 
																				//$info[$row]['tc'] = $data1[1];

																				if($counter>5) break;
																				array_shift($data1);

																				foreach($data1 as $row1 => $data2)
																				{
																					if($count==1)
																						echo "<li class=\"active\"><a href=\"#tabs-1\">1</a></li>";
																					else
																					echo "<li><a href='#tabs-".$count."'>".$count."</a></li>";
					                                                            
																					$count++;
																				}
																			
																			}
																		}
																	?>
		                                                            
		                                                        </ul>
																<?php

																$counter = 0;
																$count = 1;
																$txt_file = file_get_contents('./application/announcements.txt');
																$rows = explode("*", $txt_file);
																array_shift($rows);

		                                               		
																if($rows != NULL){
																	foreach($rows as $row => $data)
																	{
																		$counter = $counter + 1;
																		$data1 = explode("^",$data);
																		$info[$row]['date'] = $data1[0]; 
																		$info[$row]['tc'] = $data1[1];

																		if($counter>5) break;
																		//echo 'Date: ' . ($date=$info[$row]['date']) . '<br />';

																		array_shift($data1);

																		foreach($data1 as $row1 => $data2)
																		{
																			$row_data = explode('#', $data2);
																			$info[$row1]['title'] = $row_data[0];
																			$info[$row1]['content'] = $row_data[1];

																			if($count==1){
																				echo "<div class=\"cell\" id=\"tabs-".$count."\">";
																			echo "<h1 id = \"news1\">{$info[$row1]['title']}</h1>";
																			echo "<p>{$info[$row1]['content']}</p><br/>";
																			echo "</div>";
																		}else{
																			echo "<div class=\"cell\" id=\"tabs-".$count."\">";
																			echo "<h1 id = \"news$count\">{$info[$row1]['title']}</h1>";
																			echo "<p>{$info[$row1]['content']}</p><br/>";
																			echo "</div>";
																		}
																			$count++;
																		}
																	}
																}
																?>
															</div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/slider/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tabslet.min.js"></script>
<script type="text/javascript">
$(window).ready(function() {
	$('#slider').nivoSlider();
});
$(document).ready(function() {
	$('.tabs_rotate').tabslet({
	autorotate: true,
	delay: 10000,
	active:1,
	animation:true
	});
	});
</script>