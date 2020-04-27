<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";

$admin = $HTTP_SESSION_VARS["admin_user"];
if (isset($action) && $action == "delete page") {
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	$page_name = strtok($page,";");
	$cat_type = strtok(";");

	if ($page_name == "Home") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'HomeRemoved'";
		$num_rows = mysql_num_rows(mysql_query($query));
		$HomeRemoved = "yes";
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('HomeRemoved','$HomeRemoved')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$HomeRemoved' WHERE property_name = 'HomeRemoved'";
		mysql_query($query) or die(mysql_error());
	} else if ($cat_type == "main") {
		$query = "select categories_sub_1 from CATEGORIES where categories_main = '" . urldecode($page_name) . "' and categories_sub_1 <> '' group by categories_sub_1";
		$query_result = mysql_query($query) or die(mysql_error());
		while ($rs = mysql_fetch_row($query_result)) {
			$query = "delete from WEB_CONTENT where category = '" . $rs[0] . "'";
			mysql_query($query);
		}
		$query = "delete from WEB_CONTENT where category = '" . urldecode($page_name) . "'";
		mysql_query($query) or die(mysql_error());
		$query = "delete from CATEGORIES where categories_main = '" . urldecode($page_name) . "'";
		mysql_query($query) or die(mysql_error());
	} else if ($cat_type == "sub") {
		$query = "delete from WEB_CONTENT where category = '" . urldecode($page_name) . "'";
		mysql_query($query) or die(mysql_error());
		$query = "delete from CATEGORIES where categories_sub_1 = '" . urldecode($page_name) . "'";
		mysql_query($query) or die(mysql_error());
	} 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Store Builder Wizard - Step 3</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if (isset($action) && ($action == "create page" || $action == "edit page")) {?>
<meta http-equiv="refresh" content="0;URL=wizard_step_3.php">
<? }?>
</head>
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style1 {
	font-size: smaller;
	font-weight: bold;
	color: #FFFFFF;
}
.style2 {
	font-size: smaller;
	font-weight: bold;
}
-->
</style>
<body>
<? if (isset($action) && $action == "delete page") {?>
<table width="600" height="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="00AEEF">
<tr><td>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
<tr>
  <td bgcolor="00AEEF" height="5%"><span class="style1">Online Store Builder Wizard - Step 3 </span></td>
</tr>
<tr><td height="400">    
	<p align="center" class="style2">Page <?=$page_name?> has been successfully deleted! </p></td>
</tr>
<tr>
  <td align="center" bgcolor="00AEEF" height="5%"><table width="100%"  border="0">
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="BackButton" type="button" id="BackButton" value="&lt;&lt; Back" onClick="window.open('wizard_step_2.php','_self');"></td>
      <td align="right">
        <input name="previewButton" type="button" id="deleteButton" value="Preview Site" onClick="window.open('http://<?=$admin->getCompanyURL()?>','new_window');">
        &nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table></td>
</tr>
</table>
</td></tr>
</table>
<? }?>
</body>
</html>
