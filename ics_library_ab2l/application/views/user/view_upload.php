<?php echo  form_open_multipart('index.php/user/controller_upload/uploadImage')?>
 
 </ul>
    <li style = "list-style: none;margin-top:-35px;margin-left:10px;"><input type="file" name="file" id="file"></li>
     <li style = "list-style: none;margin-top:-30px;margin-left:260px;"><input type="submit" name="Upload" value="Upload"></li>
 </ul>
<?php echo form_close();?>
