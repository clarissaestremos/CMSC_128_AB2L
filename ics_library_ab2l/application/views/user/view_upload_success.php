<!-- This is will show when the user added a picture successfully -->
<html>
	<head>
		<title> Image Upload </title>
	</head>
	<body>
		<div id="container">
		        File Name:
		 
		        <?php echo $uploadInfo['file_name'];?>
		 	<br/> 
		        File Size:
		        <?php echo $uploadInfo['file_size'];?>
		 	<br/>
		        File Extension:
		        <?php echo $uploadInfo['file_ext'];?>
		 
		 	<br/>
			<p>The Image:</p>
			
			<img alt="Your uploaded image" src="<?=base_url(). 'uploads/' . $uploadInfo['file_name'];?>"> 
			
			<p>The Image:</p> 
			
			<img alt="Your Thumbnail image" src="<?=base_url(). 'uploads/' . $thumbnail_name;?>">  
		</div>
	 
	</body>
</html>
<!-- End of file view_user_upload_success.php -->
<!-- Location: ./application/view/user/vew_user_upload_success.php -->
