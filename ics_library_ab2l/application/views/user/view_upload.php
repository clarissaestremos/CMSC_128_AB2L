	
<html>
 
<head>
 
<title> Image Upload </title>
 
</head>
 
<body>
 
<div id="container">
 
<?php echo  form_open_multipart('index.php/user/controller_upload/uploadImage')?>
 


                                    <div id = "frame" style = "width: 220px;height:220px;border-radius:110px;border:solid 2px;margin-top:40px;margin-left:50px;background:#FFF8DC;"></div><br/><br/><br/>
                                    <h4 style = "color: #413839; padding-left: 37px; font-size: 22px;font-family:'Lucida Console', Monaco, monospace"><?php echo $name?></h4>
                                    </div>
                                    <div id='sib'>
                                        <ul>
                                            <li style = "list-style: none;margin-top:-65px"><input type="file" name="userfile" id="file"></li>
                                            <li style = "list-style: none;margin-top:-30px;margin-left:250px;"><input type="submit" name="Upload" value="Upload"></li>
                                        </ul>
                                    </div>
                               


 

 
<?php echo form_close();?>
 
</div>
 
</body>
 
</html>