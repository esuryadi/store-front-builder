<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";
include "../ewebwp/ewebwp.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$contents = "";
	
	if (isset($filename)) {
		$selected_db = $HTTP_SESSION_VARS["selected_db"];
		$admin = $HTTP_SESSION_VARS["admin_user"];
		$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
		$db_connect->open();
		
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
		$rs = mysql_fetch_row(mysql_query($query));
		$userid = $rs[0];
		$db_connect->close();
		$admin->retrieveAdminInfo($userid);
		
		if (substr($admin->getUserId(),0,4) == "test" || substr($admin->getUserId(),0,5) == "trial" || $admin->getUserId() == "demo1" || $admin->getUserId() == "demo2" || $admin->getUserId() == "demo")
			$str = "wwwuser";
		else
			$str = substr($admin->getUserId(),0,8);
		if (substr($admin->getCompanyURL(),0,3) == "www")
			$url = substr($admin->getCompanyURL(),4);
		else
			$url = $admin->getCompanyURL();
		
		$rootpath = "/www/" . $str . "/" . $url . "/";
		
		$file_path = $rootpath . $filename; 
		
		if (file_exists($file_path)) {
			$file = fopen($file_path,"r");
			$contents = "";
			while(!feof($file)) {
				$str = fgets($file,10000);
				$contents .= $str;
			}
			
			fclose($file);
		}
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form name="ewebwpForm" method="post" action="save_html.php">
<center>
<input name="new_file" type="button" value="New File" onClick="createNewFile();">
</center>
<br>
<strong>Filename:</strong> <input type="text" name="filename" value="<? if (isset($filename)) {?><?=$filename?><? }?>">
<input name="open_file" type="button" value="Open File" onClick="openFile(this.form);">
<? echo eWebWPEditor("contents","100%","100%",$contents);?>
<script language="JavaScript1.2" type="text/javascript">
<!--
	<? if (!isset($action) && isset($filename)) {?>
	alert("File saved successfully");
	<? } else if (isset($action) && !file_exists($file_path)) {?>
	alert("File doesn't exists!");
	<? }?>
	
	function contents_onsubmit()
	{
		if (document.ewebwpForm.filename.value == "") {
			alert("Filename is required!");
			return false;
		} else if (document.ewebwpForm.filename.value == "index.htm") {
			return confirm("index.htm file exist! Overwriting this file could cause your website to function improperly. Do you still want to overwrite?");
		} else
			return true;
	}
	
	function createNewFile() 
	{
		open("html_editor.php","_self");
	}
	
	function openFile(form) 
	{
		open("html_editor.php?action=openfile&filename=" + form.filename.value,"_self");
	}
//-->
</script>
</form>
</body>
</html>
