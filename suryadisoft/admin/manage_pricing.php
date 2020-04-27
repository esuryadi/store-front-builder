<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM PRICING WHERE pricing_id = $pricing_id";
else
	$query = "SELECT * FROM PRICING";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"PRICING");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Pricing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editPrice(id) {
	var url = "manage_pricing.php?Action=Update&pricing_id=" + id;
	open(url,"_self");
}

function deletePrice(id) {
	var url = "manage_pricing_result.php?Action=Delete&pricing_id=" + id;
	open(url,"_self");
}
</script>
</head>







<body vlink="00aeef">

<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Pricing</strong></font> 

<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_pricing_result.php?" method="post" name="PricingForm" id="PricingForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
    <? if ($field_name[$i] != "database_name") {?>
				<tr>
					<? if (stristr(mysql_field_flags($query_result,$i),"AUTO_INCREMENT") == false) {?>

					
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$field_name[$i]?>
        :</font></td>

					<td>
						<? if ($field_name[$i] == "pricing_term") {?>						
						<select name="<?=$field_name[$i]?>">
          <option value="One Time" <? if ($Action == "Update" && $rs[$i] == "One Time") {?>selected<? }?>>One 
          Time</option>
						<option value="Monthly" <? if ($Action == "Update" && $rs[$i] == "Monthly") {?>selected<? }?>>Monthly</option>
						</select>
						<? } else {?>
						<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
						<? }?>
					</td>
					<? } else {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
					<? }?>
				</tr>
			<? }?>
    <? }?>
		</table>
		<p>&nbsp;</p>

			
  <p> 

			
			
    <input type="submit" name="Submit" value="<?=$Action?> Pricing">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_pricing.php?Action=Add"><img src="../images/add_new_pricing.gif" width="111" height="21" border="0"></a></td>
    </tr>
  </table>
  <br>
</center>
  
<table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>

    <th width="154" bgcolor="#999999"> <font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font> </th>

		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
					<?=$rs[$i]?>
			</font></td>
		<? }?>
		<td width="43"><input name="Update" type="button" id="Update" value="Edit" onClick="editPrice('<?=$rs[0]?>');"></td>
		<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deletePrice('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
  </center>
</p>

<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_pricing.php?Action=Add"><img src="../images/add_new_pricing.gif" width="111" height="21" border="0"></a></td>
    </tr>
  </table>
</center>
<? }?>
</body>
</html>
