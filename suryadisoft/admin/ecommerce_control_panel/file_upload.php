<?php
require_once "../../class/FTP.php";
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../../class/WebContent.php";
require_once "../config.php";
require_once "../../path_config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	
	$admin = $HTTP_SESSION_VARS["admin_user"];
	$db_connect->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	$db_connect->close();
	$admin->retrieveAdminInfo($userid);
	
	$db_connect->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT PROPERTY_NAME, PROPERTY_VALUE FROM PROPERTY";
	$query_result = mysql_query($query);
	$prop = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$prop[$rs[0]] = $rs[1];
	}
	$db_connect->close();
	$ftp_user_name = (isset($prop["ftp_username"]))?$prop["ftp_username"]:substr($admin->getUserId(),0,8) . ((substr($admin->getUserId(),0,8) == "demo")?"0":"");
	$ftp_user_pwd = (isset($prop["ftp_password"]))?$prop["ftp_password"]:$admin->getPassword() . ((substr($admin->getUserId(),0,8) == "demo")?"0":"");
	
	if (substr($admin->getUserId(),0,5) == "trial") {
		$ftp_user_name = "tria0";
		$ftp_user_pwd = "trial";
	} else if (isset($file_type) && $file_type == "product_images_gallery") {
		$ftp_user_name = "client";
		$ftp_user_pwd = "image";
	}
	
	if (isset($Job) && $Job == "Upload") {
		echo "<center><font size='+2'>Uploading ...</font></center>";
		if (substr($admin->getUserId(),0,5) == "trial") {
			$dest_file_tmp = $dest_file;
			$dest_file = substr($dest_file,strpos($dest_file,"/")+1);
		}
		if (isset($file_type) && $file_type == "product_image") {
			if ($img_size == "product_image_small")
				$product_image_small = $dest_file;
			else if ($img_size == "product_image_medium")
				$product_image_medium = $dest_file;
			else if ($img_size == "product_image_large")
				$product_image_large = $dest_file;
		} else if (isset($file_type) && $file_type == "product_images_gallery") {
			$product_image_src = $dest_file;
		} else if (isset($file_type) && $file_type == "image") {
			if (isset($page) && $page == "component_properties")
				$img_src = $dest_file;
			else if (isset($page) && ($page == "links" || $page == "wizard_links"))
				$link_img_src = $dest_file;
			else
				$logo_img_src = $dest_file;
		} else {
			$filename = $dest_file;
		}
		if (substr($admin->getUserId(),0,5) == "trial")
			$dest_file = $dest_file_tmp;
		if (substr($admin->getCompanyURL(),0,3) == "www")
			$url = substr($admin->getCompanyURL(),4);
		else
			$url = $admin->getCompanyURL();
		if (substr($ftp_user_name,0,4) == "test" || substr($admin->getUserId(),0,5) == "trial" || $admin->getUserId() == "demo1" || $admin->getUserId() == "demo2" || $admin->getUserId() == "demo")
			$root_path = "/www/";
		else if (isset($file_type) && $file_type == "product_images_gallery") {
			$root_path = "/www/";
			if (!file_exists(_ROOTPATH . "client_img_src/" . $admin->getUserId())) {
				mkdir(_ROOTPATH . "client_img_src/" . $admin->getUserId(),0777);
				chmod(_ROOTPATH . "client_img_src/" . $admin->getUserId(),0777);
				mkdir(_ROOTPATH . "client_img_src/" . $admin->getUserId() . "/images/",0777);
				chmod(_ROOTPATH . "client_img_src/" . $admin->getUserId() . "/images/",0777);
			}
		} else
			$root_path = "/www/" . $url . "/httpdocs/";
		$dest_file = $root_path . $dest_file;
		$ftp = new FTP($ftp_user_name,$ftp_user_pwd,$HTTP_POST_FILES['source_file']['tmp_name'],$dest_file);
		$ftp->put();
	}
	
	if (substr($admin->getUserId(),0,5) == "trial")
		$dest_file = $admin->getUserId() . "/";
	else
		$dest_file = "";
	$prefix = "";
	if (isset($file_type) && $file_type == "product_image") {
		$prefix = "Image ";
		$dest_file = $dest_file . "images/product/";
		$db_connect->open();
		$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"PRODUCT");
		for ($i=0;$i<mysql_num_fields($field_list);$i++)
			$field_name [] = mysql_field_name($field_list,$i);
		$db_connect->close();
	} else if (isset($file_type) && $file_type == "product_images_gallery") {
		$prefix = "Image ";
		$dest_file = $dest_file . ((substr($admin->getUserId(),0,5) == "trial")?"images/":$admin->getUserId() . "/images/");
	} else if (isset($file_type) && $file_type == "image") {
		$prefix = "Image ";
		$dest_file = $dest_file . "images/";
	} else if (isset($file_type) && $file_type == "file") {
		$db_connect->open();
		$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"WEB_CONTENT");
		for ($i=0;$i<mysql_num_fields($field_list);$i++)
			$field_name [] = mysql_field_name($field_list,$i);
		$db_connect->close();
	}
	
	if (isset($file_type) && ($file_type == "product_image" || $file_type == "file")) {
		for ($i=0;$i<count($field_name);$i++) {
			session_register($field_name[$i]);
		}
	}
}
?>
<html>
<head>
<title>Upload File</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: smaller;
}
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: smaller;
}
-->
</style>
</head>
<script language="JavaScript">

function setDestinationFile(form) {
	var source_file = form.source_file.value;
	if (source_file.lastIndexOf("\\") > 0)
		form.dest_file.value = "<?=$dest_file?>" + source_file.substr(source_file.lastIndexOf("\\")+1);
	else
		form.dest_file.value = "<?=$dest_file?>" + source_file.substr(source_File.lastIndexOf("/")+1);		
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.source_file.value == "") {
		is_valid = false;
		err_msg = err_msg + "Uploaded File is required\n";
	} else if (form.source_file.value.indexOf(".") == -1) {
		is_valid = false;
		err_msg = err_msg + "Please select a valid filename. A valid filename should have an extension such as \".jpg\".\n";
	}
	if (form.dest_file.value == "") {
		is_valid = false;
		err_msg = err_msg + "Target/Destination Directory & File is required\n";
	} else if (form.dest_file.value.indexOf(".") == -1) {
		is_valid = false;
		err_msg = err_msg + "Invalid Target Filename. A valid filename should have an extension such as \".jpg\".\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}

</script>
<body>
<div align="center">
	<? if (!isset($Job)) {?>
  <p><strong><font size="+1">Upload <?=$prefix?>File</font></strong></p>
  <? }?>
	<form action="file_upload.php" method="post" enctype="multipart/form-data" name="upload_form" id="upload_form">
    <input TYPE="hidden" name="MAX_FILE_SIZE" value="800000">
		<input name="Job" type="hidden" value="Upload">
	 	<? if (isset($file_type) && $file_type == "product_image") {?>
	 	<input name="file_type" type="hidden" value="<?=$file_type?>">
	 	<input name="img_size" type="hidden" value="<?=$img_size?>">
		<input name="page" type="hidden" value="<?=$page?>">
		<? if ($page == "product") {?>
	 	<input name="Action" type="hidden" value="<?=$Action?>">
		<? }?>
		<? } else if (isset($file_type) && $file_type == "product_images_gallery") {?>
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<input name="Action" type="hidden" value="<?=$Action?>">
		<? if ($Action == "Update") {?>
		<input type="hidden" name="id" value="<?=$id?>">
		<? }?>
		<input type="hidden" name="product_id" value="<?=$product_id?>">
		<input type="hidden" name="product_image_src" value="<?=$product_image_src?>">
		<? } else if (isset($file_type) && $file_type == "image") {?>
		<? if (isset($page) && $page == "component_properties") {?>
		<input name="Action" type="hidden" value="Update">
		<input name="id" type="hidden" value="<?=$id?>">
		<input name="selected_component" type="hidden" value="<?=$selected_component?>">
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<input name="page" type="hidden" value="<?=$page?>">
		<input name="fieldname" type="hidden" value="<?=$fieldname?>">
		<input name="img_src" type="hidden" value="<?=$img_src?>">
		<? } else if (isset($page) && ($page == "links" || $page == "wizard_links")) {?>
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<input name="page" type="hidden" value="<?=$page?>">
		<input name="Action" type="hidden" value="<?=$Action?>">
		<input type="hidden" name="link_id" value="<?=$link_id?>">
		<input type="hidden" name="link_type" value="<?=$link_type?>">
		<input type="hidden" name="link_text" value="<?=$link_text?>">
		<input type="hidden" name="link_img_src" value="<?=$link_img_src?>">
		<input type="hidden" name="link_url" value="<?=$link_url?>">
		<input type="hidden" name="link_position" value="<?=$link_position?>">
		<input type="hidden" name="link_target" value="<?=$link_target?>">
		<input type="hidden" name="sequence" value="<?=$sequence?>">
		<? } else {?>
		<input name="Tab" type="hidden" value="<?=$Tab?>">
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<input name="page" type="hidden" value="<?=$page?>">
		<input name="setting_type" type="hidden" value="<?=$setting_type?>">
		<input name="logo_img_src" type="hidden" value="<? if (isset($logo_img_src)) {?><?=$logo_img_src?><? }?>">
		<? }?>
		<? } else if (isset($file_type) && ($file_type == "sound_file" || $file_type == "css_file")) {?>
		<input name="Tab" type="hidden" value="<?=$Tab?>">
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<input name="page" type="hidden" value="<?=$page?>">
		<input name="setting_type" type="hidden" value="<?=$setting_type?>">
		<? if ($file_type == "sound_file") {?>
		<input name="bg_sound_src" type="hidden" value="<? if (isset($filename)) {?><?=$filename?><? }?>">
	 	<? } else if ($file_type == "css_file") {?>
		<input name="css_file" type="hidden" value="<? if (isset($filename)) {?><?=$filename?><? }?>">
		<? }?>
		<? } else if (isset($file_type) && $file_type == "link_file") {?>
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<input name="page" type="hidden" value="<?=$page?>">
		<input name="Action" type="hidden" value="<?=$Action?>">
		<input type="hidden" name="link_id" value="<?=$link_id?>">
		<input type="hidden" name="link_type" value="<?=$link_type?>">
		<input type="hidden" name="link_text" value="<?=$link_text?>">
		<input type="hidden" name="link_url" value="<?=$filename?>">
		<input type="hidden" name="link_img_src" value="<?=$link_img_src?>">
		<input type="hidden" name="link_position" value="<?=$link_position?>">
		<input type="hidden" name="link_target" value="<?=$link_target?>">
		<input type="hidden" name="sequence" value="<?=$sequence?>">	
		<? } else if (isset($file_type) && $file_type == "file") {?>
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<? if ($page == "web_content") {?>
		<input name="Action" type="hidden" value="<?=$Action?>">
		<? }?>
		<input name="page" type="hidden" value="<?=$page?>">
	 	<input name="Refresh" type="hidden" value="true">
		<? if (isset($selected_index)) {?>
		<input name="selected_index" type="hidden" value="<?=$selected_index?>">
		<? }?>
		<? } else {?>
		<input name="file_type" type="hidden" value="<?=$file_type?>">
		<? }?>
	 <? if (!isset($Job)) {?>
		<div align="left">
			<table cellpadding="5" cellspacing="0">
				<? if (isset($ftp_user_name)) {?>
				<input name="ftp_user_name" type="hidden" value="<?=$ftp_user_name?>">
				<? } else {?>
        <tr>
          <td align="right"><strong>FTP Login:</strong></td>
          <td><input name="ftp_user_name" type="text" id="ftp_user_name" value="<?=$ftp_user_name?>"></td>
        </tr>
				<? }?>
				<? if (isset($ftp_user_pwd)) {?>
				<input name="ftp_user_pwd" type="hidden" value="<?=$ftp_user_pwd?>">
				<? } else {?>
        <tr> 
          <td align="right"><strong>FTP Password:</strong></td>
          <td><input name="ftp_user_pwd" type="text" id="ftp_user_pwd" value="<?=$ftp_user_pwd?>"></td>
        </tr>
				<? }?>
        <tr> 
          <td align="right"><strong><?=$prefix?>File that will be uploaded:</strong></td>
          <td><input name="source_file" type="file" id="source_file" value="<? if (isset($source_file)) {?><?=$source_file?><? }?>" size="30" <? if (eregi("msie",$_SERVER['HTTP_USER_AGENT'])) {?>onChange="setDestinationFile(this.form);"<? } else {?>onClick="setDestinationFile(this.form);"<? }?>></td>
        </tr>
        <tr> 
          <td align="right"><strong><?=$prefix?>Target/Destination Directory &amp; Filename:</strong></td>
          <td><input name="dest_file" type="text" id="dest_file" value="<?=$dest_file?>" size="30"></td>
        </tr>
      </table>
      <p align="center"> 
        <input type="submit" name="UploadButton" value="Upload" onClick="validateForm(this.form);">
        <input name="CancelButton" type="button" id="CancelButton" value="Cancel" onClick="window.close();">
      </p>
    </div>
		<? }?>
  </form>
</div>
</body>
</html>
<script language="JavaScript">
		
<? if (isset($Job) && $Job == "Upload") {?>
	<? if (isset($file_type) && $file_type == "product_image") {?>
		<? if (isset($page) && $page == "product") {?>
			document.upload_form.action = "product.php?refresh_cat=true";
		<? } else if (isset($page) && $page == "wizard") {?>
			document.upload_form.action = "wizard_step_3.php?refresh_cat=true";
		<? }?>
	<? } else if (isset($file_type) && $file_type == "product_images_gallery") {?>
		document.upload_form.action = "product_images_gallery.php";
	<? } else if (isset($file_type) && $file_type == "image") {?>
		<? if (isset($page) && $page == "settings") {?>
			document.upload_form.action = "settings.php?Tab=<?=Tab?>";
		<? } else if (isset($page) && $page == "wizard") {?>
			document.upload_form.action = "wizard_step_8.php";
		<? } else if (isset($page) && $page == "links") {?>
			document.upload_form.action = "links.php?Refresh=true";
		<? } else if (isset($page) && $page == "wizard_links") {?>
			document.upload_form.action = "wizard_step_6.php?Refresh=true";
		<? } else if (isset($page) && $page == "component_properties") {?>
			document.upload_form.action = "component_properties.php";
		<? }?>
	<? } else if (isset($file_type) && ($file_type == "sound_file" || $file_type == "css_file")) {?>
		<? if (isset($page) && $page == "settings") {?>
			document.upload_form.action = "settings.php?Tab=<?=Tab?>";
		<? }?>
	<? } else if (isset($file_type) && $file_type == "link_file") {?>
		<? if (isset($page) && $page == "links") {?>
			document.upload_form.action = "links.php?Refresh=true";
		<? } else if (isset($page) && $page == "wizard_links") {?>
			document.upload_form.action = "wizard_step_6.php?Refresh=true";
		<? }?>
	<? } else if (isset($file_type) && $file_type == "file") {?>
		<? if (isset($page) && $page == "web_content") {?>
			document.upload_form.action = "web_content.php";
		<? } else if (isset($page) && $page == "wizard") {?>
			document.upload_form.action = "wizard_step_5.php";
		<? }?>
	<? } else {?>
		window.open("file_upload.php?file_type=all_type","file_upload");
		window.open("file_tree.php","file_tree");
	<? }?>
	<? if (isset($file_type) && $file_type != "all_type") {?>
		document.upload_form.method = "POST";
		document.upload_form.submit();
	<? }?>
<? }?>
</script>