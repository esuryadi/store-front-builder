<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
require_once("../../path_config.php");

if (isset($id) && $id != "") {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT * FROM WEB_CONTENT WHERE id = $id";
	$query_result = mysql_query($query);
	$rs = mysql_fetch_array($query_result);
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<html>
<head>
<title>Component Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> <strong>Component 
Detail Information</strong> </font> 
<? if (isset($id) && $id != "") {?>
<p>
<table width="100%" cellspacing="0" cellpadding="5">
<? for ($i=0;$i<count($field_name);$i++) {?>
<tr>
	<td valign="top" width="120"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=ucwords(str_replace("_"," ",$field_name[$i]))?>:</font></td>
	<td valign="top">
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<?=$rs[$i]?>
		</font>
	</td>
</tr>

<? if ($field_name[$i] == "style" && WebContent::getComponentStylePreviewImages($rs[1],$rs[9]) != "") {?>
<tr><td colspan="2">
	<p><img src="<?=_URLPATH?>components/images/<?=WebContent::getComponentStylePreviewImages($rs[1],$rs[9]);?>">
</td></tr>
<? }?>
<? }?>
</table>
<? }?>
</body>
</html>
