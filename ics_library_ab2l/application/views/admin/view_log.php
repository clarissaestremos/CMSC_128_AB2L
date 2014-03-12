<div id="thisbody" class="body width-fill background-white">
					<div class="cell">
                        <div class="page-header cell">
                                        <h1>Admin <small>View Log</small></h1>
                        </div>
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of all Logs &nbsp; 
							<!--	<a class="float-right" href="<?php //echo base_url();?>index.php/admin/controller_log/today"><button style="font-size: 10px;">View Today's Logs</button></a>
								<a class="float-right" href="<?php //echo base_url();?>index.php/admin/controller_log"><button style="font-size: 10px;">View All Logs</button></a>-->
	                        </div>
	                        <table class="body">
                                <thead s>
                                    <tr>
                                        <th style="width: 3%; text-align:center;">#</th>
                                        <th style="width: 10%; text-align:center;">Date</th>
                                        <th style="width: 25%; text-align:center;">Message</th>
                                        <th style="width: 15%; text-align:center;">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count = 1;
										$date = "";
										foreach ($log as $iLog):
											echo "<tr><td>$count</td>";
											if($date == $iLog->date){
												echo "<td></td>";
											}else{
												echo "<td>".$iLog->date."</td>";
											}
											echo "<td>".$iLog->message."</td>";
											echo "<td>".$iLog->time."</td></tr>";
											$date = $iLog->date;
											$count++;
										endforeach
                                    ?>
                                </tbody>
                            </table>
	                    </div>
	                </div>
	            </div>
