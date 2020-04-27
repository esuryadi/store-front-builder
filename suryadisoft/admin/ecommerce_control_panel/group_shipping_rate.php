<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = "SELECT * FROM GROUP_SHIPPING_RATE";
$query_result = mysql_query($query);
while ($rs = mysql_fetch_row($query_result)) {
	$group ["name"] = $rs[0];
	$group ["rate"] = $rs[2];
	$group ["minorder"] = $rs[3];
	$groups[] = $group;
} 

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Group Shipping Rate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">

<p>
  <font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Group Shipping</strong></font> 
</p>

<p align="center">
  <input type="button" name="addGroupShipping" value="Add Group Shipping" onClick="window.open('group_shipping_rate_form.php?action=add','_self');">
</p>

<p>
  <table align="center" cellpadding="5" cellspacing="0">
  <tr>
    <th bgcolor="#999999"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF">Group Name</font></th>
	<th bgcolor="#999999"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF">Shipping Rate</font></th>
	<th bgcolor="#999999"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF">Minimum Order</font></th>
  </tr>
  <? for ($i=0;$i<count($groups);$i++) {
     $group = $groups[$i];?>
  <tr>    
    <td><?=$group["name"]?></td>
	<td align="right">$<?=$group["rate"]?></td>
	<td align="right">$<?=$group["minorder"]?></td>
	<td><input type="button" name="edit" value="Edit" onClick="window.open('group_shipping_rate_form.php?action=update&groupName=<?=urlencode($group["name"])?>','_self');"></td>
	<td><input type="button" name="delete" value="Delete" onClick="window.open('group_shipping_rate_action.php?action=delete&groupName=<?=urlencode($group["name"])?>','_self');"></td>
  </tr>
  <? }?>
  </table>
</p>

</body>
</html>
