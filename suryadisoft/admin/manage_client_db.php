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
	$query = "SELECT * FROM CLIENT_DATABASE WHERE USER_ID = '$user_id'";
else
	$query = "SELECT * FROM CLIENT_DATABASE";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"CLIENT_DATABASE");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);

$query = "SELECT user_id FROM USER WHERE user_id <> 'admin'";
$query_result2 = mysql_query($query);
while($rs = mysql_fetch_row($query_result2)) {
	$id[] = $rs[0];
}
	
$db_connect->close();
?>
<title>Manage Client Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editClientDB(id) {
	var url = "manage_client_db.php?Action=Update&user_id=" + id;
	open(url,"_self");
}

function deleteClientDB(id) {
	var url = "manage_client_db_result.php?Action=Delete&user_id=" + id;
	open(url,"_self");
}
</script>
</head>



<body vlink="00aeef" vlink="00aeef">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="manage_clients.php">Manage 
Cients</a><strong> &gt; <font color="00aeef">Manage Client Database User</font></strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_client_db_result.php" method="post" name="clientDBForm" id="clientDBForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<tr>
					<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>

					
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$field_name[$i]?>
        :</font></td>

					<td>
						<? if ($Action == "Update" && $i == 0) {?>
						<input type="hidden" name="<?=$field_name[$i]?>" value="<?=$rs[$i]?>">
						<?=$rs[$i]?>
						<? } else if ($field_name[$i] == "user_id") {?>						
						<select name="<?=$field_name[$i]?>">
						<? for($n=0;$n<count($id);$n++) {?>
						<option value="<?=$id[$n]?>" <? if ($Action == "Update" && $rs[$i] == $id[$n]) {?>selected<? }?>><?=$id[$n]?></option>
						<? }?>
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
		</table>
		<p>&nbsp;</p>

			
  <p> 

			
			
    <input type="submit" name="Submit" value="<?=$Action?> Client Database User">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td width="73"><a href="manage_client_db.php?Action=Create"><img src="../images/new_user.gif" alt="Add New Client Database User" width="73" height="21" border="0"></a></td>
    <td width="8">&nbsp;&nbsp;</td>
    <td width="163"><a href="manage_client_com.php"><img src="../images/ecommerce_components.gif" alt="Manage Client eCommerce Components" border="0"></a></td>
    <td width="110"><a href="manage_client_payment.php"><img src="../images/payment_service.gif" alt="Manage Client Payment Services" border="0"></a></td>
  </tr>
</table>
<br>
<table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>

		<? for($i=0;$i<count($field_name);$i++) {?>

		

		

    <td width="22" valign="bottom" bgcolor="#999999"> 



      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF">
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font>

    </td>

		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">

				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$rs[$i]?></font>

			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editClientDB('<?=$rs[0]?>');"></td>
		<? if ($rs[0] != "admin") {?>

		<td width="58"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteClientDB('<?=$rs[0]?>');"></td>

		<? }?>
	</tr>
	<? }?>
</table>

<br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="73"><a href="manage_client_db.php?Action=Create"><img src="../images/new_user.gif" alt="Add New Client Database User" width="73" height="21" border="0"></a></td>
    <td width="8">&nbsp;&nbsp;</td>
    <td width="163"><a href="manage_client_com.php"><img src="../images/ecommerce_components.gif" alt="Manage Client eCommerce Components" border="0"></a></td>
    <td width="110"><a href="manage_client_payment.php"><img src="../images/payment_service.gif" alt="Manage Client Payment Services" border="0"></a></td>
  </tr>
</table>
<br>
<? }?>

<? if (isset($Status) && $Status == "failed") {?>
<script>
alert("This user has already had a database created.");
</script>
<? }?>

</body>
</html>
