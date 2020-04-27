<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT * FROM REFERRAL WHERE referral_id = '$referral_id'";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);

$field_list = $query_result;
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$query2 = "SELECT COUNT(subscription_package) AS total_signup_client, subscription_package FROM PURCHASE_ORDER WHERE referral_id = '$referral_id' GROUP BY subscription_package";	
$query_result2 = mysql_query($query2);
$rs2 = mysql_fetch_array($query_result2);

$field_list2 = $query_result2;
for ($i=0;$i<mysql_num_fields($field_list2);$i++)
	$field_name2 [] = mysql_field_name($field_list2,$i);
	
$db_connect->close();
?>
<html>
<head>
<title>Referral Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Referral Info</strong>
</font> 
<p>
<blockquote>
<table cellspacing="0" cellpadding="5">
<? for ($i=0;$i<count($field_name);$i++) {?>
<tr>
	<td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=str_replace("_"," ",$field_name[$i])?>:</font></td>
	<td>
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
		<? if ($field_name[$i] == "referral_id") {?>
			<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a>
		<? } else {?>
			<?=$rs[$i]?>
		<? }?>
		</font></td>
</tr>
<? }?>
</table>
<p>
<table border="0" align="center" cellpadding="8" cellspacing="0">
<tr>
	<? for($i=0;$i<count($field_name2);$i++) {?>
		<th width="154" bgcolor="#999999"> 
			<font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<?=strtoupper(str_replace("_"," ",$field_name2[$i]))?>
			</font> 
		</th>
	<? }?>
	<th bgcolor="#999999"><font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif">REFERRAL FEE</font></th>
</tr>
<? for($n=0;$rs = mysql_fetch_row($query_result2);$n++) {?>		
<tr>
	<? for($i=0;$i<count($rs2);$i++) {?>
		<td bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<?=$rs2[$i]?>
			</font>
		</td>
	<? }?>
	<td align="right" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">$ <? printf("%01.2f",$rs[count($rs)-1] * 50);?></td>
</tr>
<? }?>
</table>
</blockquote>
</body>
</html>
