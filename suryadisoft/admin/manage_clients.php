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
	$query = "SELECT CLIENTS.*, database_name FROM CLIENTS LEFT JOIN CLIENT_DATABASE ON CLIENTS.user_id = CLIENT_DATABASE.user_id WHERE CLIENTS.user_id = '$user_id'";
else
	$query = "SELECT CLIENTS.*, database_name FROM CLIENTS LEFT JOIN CLIENT_DATABASE ON CLIENTS.user_id = CLIENT_DATABASE.user_id";	
$query_result = mysql_query($query);

for ($i=0;$i<mysql_num_fields($query_result);$i++)
	$field_name [] = mysql_field_name($query_result,$i);
	
$query = "SELECT user_id FROM USER WHERE user_id <> 'admin'";
$query_result2 = mysql_query($query);
while($rs = mysql_fetch_row($query_result2)) {
	$id[] = $rs[0];
}
	
$db_connect->close();
?>
<title>Manage Clients</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editClient(id) {
	var url = "manage_clients.php?Action=Update&user_id=" + id;
	open(url,"_self");
}

function deleteClient(id) {
	var url = "manage_clients_result.php?Action=Delete&user_id=" + id;
	open(url,"_self");
}
</script>
</head>







<body vlink="00aeef">

<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Clients</strong></font>

<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_clients_result.php?" method="post" name="clientsForm" id="clientsForm">
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
			<? }?>
		</table>
		<p>&nbsp;</p>

			
  <p> 

			
			
    <input type="submit" name="Submit" value="<?=$Action?> Clients">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
</font>

<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_clients.php?Action=Create"><img src="../images/new_client.gif" alt="Add New Clients" border="0"></a></td>
      <td>&nbsp;&nbsp;</td>
      <td><a href="manage_client_db.php"><img src="../images/client_database.gif" alt="Manage Client Database" width="107" height="21" border="0"></a></td>
      <td><a href="manage_client_com.php"><img src="../images/ecommerce_components.gif" alt="Manage Client eCommerce Components" width="163" height="21" border="0"></a></td>
      <td><a href="manage_client_payment.php"><img src="../images/payment_service.gif" alt="Manage Client Payment Services" border="0"></a></td>
    </tr>
  </table>
  <a href="manage_clients.php?Action=Create"><br>
  
  </a>
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
				<? if	($field_name[$i] == "company_url") {?>
					<a href="http://<?=$rs[$i]?>" target="new_window"><?=$rs[$i]?></a>
				<? } else if($field_name[$i] == "company_email") {?>
					<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a>
				<? } else {?>
					<?=$rs[$i]?>
				<? }?>

			</font></td>

		<? }?>

		<td width="43"><input name="Update" type="button" id="Update" value="Edit" onClick="editClient('<?=$rs[0]?>');"></td>

		<? if ($rs[0] != "admin") {?>

		<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteClient('<?=$rs[0]?>');"></td>

		<? }?>
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
      <td><a href="manage_clients.php?Action=Create"><img src="../images/new_client.gif" alt="Add New Clients" border="0"></a></td>
      <td>&nbsp;&nbsp;</td>
      <td><a href="manage_client_db.php"><img src="../images/client_database.gif" alt="Manage Client Database" width="107" height="21" border="0"></a></td>
      <td><a href="manage_client_com.php"><img src="../images/ecommerce_components.gif" alt="Manage Client eCommerce Components" width="163" height="21" border="0"></a></td>
      <td><a href="manage_client_payment.php"><img src="../images/payment_service.gif" alt="Manage Client Payment Services" border="0"></a></td>
    </tr>
  </table>
  <a href="manage_clients.php?Action=Create">
  </a>
</center>
<? }?>

<? if (isset($Status) && $Status == "failed") {?>
<script>
alert("Client is already exist.\nPlease select different User Id.");
</script>
<? }?>

</body>
</html>
