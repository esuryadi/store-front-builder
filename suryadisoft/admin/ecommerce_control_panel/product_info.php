<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");

if (isset($product_id) && $product_id != "") {
	$admin_user = $HTTP_SESSION_VARS["admin_user"];
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT * FROM PRODUCT WHERE product_id = $product_id";
	$query_result = mysql_query($query);
	$rs = mysql_fetch_array($query_result);
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$db_connect->close();
	
	$admin_user->retrieveAdminInfo($userid);
}
?>
<html>
<head>
<title>Product Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> <strong>Product 
Detail Information</strong> </font> 
<? if (isset($product_id) && $product_id != "") {?>
<p>
<table width="100%" cellspacing="0" cellpadding="5">
<? for ($i=0;$i<count($field_name);$i++) {?>
<tr>
	<td valign="top" width="120"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=ucwords(str_replace("_"," ",$field_name[$i]))?>:</font></td>
	<td valign="top">
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		<? if ($field_name[$i] == "product_price" || $field_name[$i] == "product_retail_price") {?>
			$ <?=$rs[$i]?>
		<? } else if (substr($field_name[$i],0,13) == "product_image") {?>
			<?=$rs[$i]?><p>
			<? if ($rs[$i] != "") {?>
			<img src="http://<?=$admin_user->getCompanyURL() . "/" . $rs[$i]?>">
			<? } else {?>
			<img src="http://www.suryadisoft.net/images/blank_img_sm.gif">
			<? }?>
		<? } else {?>
			<?=$rs[$i]?>
		<? }?>
		</font></td>
</tr>
<? }?>
</table>
<? }?>
</body>
</html>
