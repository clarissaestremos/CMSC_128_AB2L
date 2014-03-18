<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/style/noscript.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/style/style.css">
<div id="main-body" class="site-body" style="">
				<div class="cell site-center" style="border-radius: 10px 10px 10px 10px;">
				<div class="cell body">
									<p class="tiny">Home</p>
				</div>
				<div class="width-full">
									<div id="wrapper" class="width-3of5 float-left">
								        <div id="ei-slider" class="ei-slider">
				                    <ul class="ei-slider-large" style='margin: 0px 0px; padding: 0px 0px; list-style:none;'>
										<li>
				                            <img src="<?php echo base_url();?>images/home/1.jpg" alt="image1"/>
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/2.jpg" alt="image2" />
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/3.jpg" alt="image3" />
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/4.jpg" alt="image4"/>
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/5.jpg" alt="image5"/>
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/6.jpg" alt="image6"/>
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/7.jpg" alt="image7"/>
				                        </li> 

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/8.jpg" alt="image8"/>
				                        </li> 

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/9.jpg" alt="image9"/>
				                        </li> 

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/10.jpg" alt="image10"/>
				                        </li>

				                        <li>
				                            <img src="<?php echo base_url();?>images/home/11.jpg" alt="image11"/>
				                        </li>
				                    </ul><!-- ei-slider-large -->
				                    <ul class="ei-slider-thumbs">
				                        <li class="ei-slider-element"></li>
										<li><a href="#">Image1</a><img src="<?php echo base_url();?>images/thumbs/1.jpg"  /></li>
				                        <li><a href="#">Image2</a><img src="<?php echo base_url();?>images/thumbs/2.jpg" alt="thumb2" /></li>
				                        <li><a href="#">Image3</a><img src="<?php echo base_url();?>images/thumbs/3.jpg" alt="thumb3" /></li>
				                        <li><a href="#">Image4</a><img src="<?php echo base_url();?>images/thumbs/4.jpg" alt="thumb4" /></li>
				                        <li><a href="#">Image5</a><img src="<?php echo base_url();?>images/thumbs/5.jpg" alt="thumb5" /></li>
				                        <li><a href="#">Image6</a><img src="<?php echo base_url();?>images/thumbs/6.jpg" alt="thumb6" /></li>
				                        <li><a href="#">Image7</a><img src="<?php echo base_url();?>images/thumbs/7.jpg" alt="thumb7" /></li>
				                        <li><a href="#">Image8</a><img src="<?php echo base_url();?>images/thumbs/8.jpg" alt="thumb8" /></li>
				                        <li><a href="#">Image9</a><img src="<?php echo base_url();?>images/thumbs/9.jpg" alt="thumb9" /></li>
				                        <li><a href="#">Image10</a><img src="<?php echo base_url();?>images/thumbs/10.jpg" alt="thumb10" /></li>
				                        <li><a href="#">Image11</a><img src="<?php echo base_url();?>images/thumbs/11.jpg" alt="thumb11" /></li>
				                    </ul><!-- ei-slider-thumbs -->
           						 </div><!-- ei-slider -->
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tabslet.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/slider/jquery.eislideshow.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/slider/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(window).ready(function() {
	$('#ei-slider').eislideshow({
						animation			: 'center',
						autoplay			: true,
						slideshow_interval	: 3000,
						titlesFactor		: 0
	});
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