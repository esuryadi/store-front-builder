<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
$query = "SELECT * FROM CUSTOMER WHERE customer_id = $customer_id";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);

$field_list = $query_result;
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<html>
<head>
<title>Customer Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Customer Info</strong>
</font> 
<p>
<blockquote>
<table cellspacing="0" cellpadding="5">
<? for ($i=0;$i<count($field_name);$i++) {?>
<tr>
	<td valign="top" width="120"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=str_replace("_"," ",$field_name[$i])?>:</font></td>
	<td valign="top">
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<? if ($field_name[$i] == "customer_email") {?>
				<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a>
			<? } else {?>
				<?=$rs[$i]?>
			<? }?>
		</font></td>
</tr>
<? }?>
</table>
</blockquote>
</body>
</html>