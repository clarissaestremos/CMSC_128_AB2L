<div id="thisbody" class="body width-fill background-white">
	<div class="cell">
		<div class="page-header cell">
           <h1>Admin <small>View Announcements</small></h1>
        </div>
<?php

/*
Uses explode to split the file, array_shift to remove the first element and returns its value,
and info to get row data.
*/

$counter = 0;
$txt_file = file_get_contents('./application/announcements.txt');
$rows = explode("*", $txt_file);       //delimeter used for detecting each entry of announcement is '*'
array_shift($rows);
if($rows != NULL)
{

	foreach($rows as $row => $data)
	{
		$counter = $counter + 1;
		$data1 = explode("^",$data);          //delimeter used for detecting the announcement's title
		$info[$row]['date'] = $data1[0]; 
		//$info[$row]['tc'] = $data1[1];

		if($counter>5) break;
		//echo 'Date: ' . ($date=$info[$row]['date']) . '<br />';

		array_shift($data1);
		$count = 0;

		foreach($data1 as $row1 => $data2)
		{
			$row_data = explode('#', $data2);       //delimeter used for detecting the announcement's body
			$info[$row1]['title'] = $row_data[0];
			$info[$row1]['content'] = $row_data[1];

			echo "<div class='panel cell'>";
			echo "<div class='gradient header'>Title: {$info[$row1]['title']}
			<form action='controller_announcement/find' class='float-right' method='post'>
				<input type='hidden' name='date' ' value='{$info[$row]['date']}' />
				<input type='hidden' name='delete'/>
				<input type='submit' name='edit' style='height:1.5em; font-size: 10px; line-height: 0px;' value='Edit' enabled/>
				<input type='submit' value='Delete' id='delete$count' style='height:1.5em; font-size:10px; line-height: 0px;' enabled/>
				</form><br/>
			Date: {$info[$row]['date']}
				</div>";
			echo "<div class='body'>";
			echo "<div class='cell'>";
			echo "<div>";
			echo "</div>";
			echo "{$info[$row1]['content']}<br/>";
			echo "</div>";
			echo "</div>";
			echo "</div><hr/>";
			$count++;
		}
	
	}
}

else
{
	echo "<div class='cell'><h2>There is no announcement to display!</h2></div><hr/>";
}

	echo "<form action='controller_announcement/deleteAll' id='deleteall' class='float-right' style='margin-left: 5px;' method='post'>
			<input type='hidden' name='delete_all'/>
			<input type='submit' value='Delete All Announcements' enabled/>
		</form>
		<form action='controller_announcement/viewForm' class='float-right' method='post'>
			<input type='submit' name='new' value='Add New Announcement' enabled/>
		</form>

		";
?>

<div id="deletealldialog" title="Delete All Announcement Confirmation">
	<p>Are you sure that you want to delete all the announcements?</o>
</div>

<div id="deletedialog" title="Delete Announcement Confirmation">
	<p>Are you sure that you want to delete this announcement?</o>
</div>

<div id="deleteconfirm" title="Delete All Announcement Confirmation">
	<p>Are you really sure that you want to delete all announcements? Doing so will remove it from the database.</p>
</div>

<div id="dsucc" title="Delete Announcement Success">
   <p>You have successfuly deleted an announcement!</p>
</div>

<div id="dasucc" title="Delete All Announcement Success">
  <p>You have successfully deleted all the announcements!</p>
</div>

<!-- End of file view_announcements.php */
    /* Location: ./application/views/admin/view_announcements.php */ -->
