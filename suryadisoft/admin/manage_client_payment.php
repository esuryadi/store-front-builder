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

$query = "SELECT user_id FROM USER WHERE user_id <> 'admin'";
$query_result2 = mysql_query($query);
while($rs = mysql_fetch_row($query_result2)) {
	$id[] = $rs[0];
}

if (!isset($user_id) && isset($id))
	$user_id = $id[0];
	
if (isset($Action) && $Action == "Set")
	$query = "SELECT * FROM CLIENT_PAYMENT_SERVICE WHERE user_id = '$user_id'";
else
	$query = "SELECT * FROM CLIENT_PAYMENT_SERVICE ORDER BY user_id";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"CLIENT_PAYMENT_SERVICE");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Client Payment Service</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function getClientComponent(id) {
	var url = "manage_client_payment.php?Action=Set&user_id=" + id;
	open(url,"_self");
}

</script>
</head>



<body vlink="00aeef">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="manage_clients.php">Manage 
Clients</a><strong> &gt; <font color="00aeef">Manage Client Payment Services</font></strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_client_payment_result.php" method="post" name="clientPaymentServiceForm" id="clientPaymentServiceForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? $rs = mysql_fetch_row($query_result);?>		 
			<tr>				

      	
      <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">User Id:

        	<select name="user_id" onChange="getClientComponent(this.value);">
					<? for($n=0;$n<count($id);$n++) {?>
					<option value="<?=$id[$n]?>" <? if (isset($user_id) && $user_id == $id[$n]) {?>selected<? }?>><?=$id[$n]?></option>
					<? }?>
					</select>

				</font></td>

			</tr>
			<tr>

				
      <td nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">

				<b>Online Payment Service:</b>
				<blockquote> 
          <p>
            <input type="radio" name="Payment" value="Manual">
            Manual </p>
          <p>
            <input type="radio" name="Payment" value="PayPal" <? if ($rs[1] == "PayPal") {?>checked<? }?>>
            PayPal</p>
          <p>
				<input type="radio" name="Payment" value="VeriSign PayFlow Link" <? if ($rs[1] == "VeriSign PayFlow Link") {?>checked<? }?>>
             VeriSign PayFlow Link
<p>
				<input type="radio" name="Payment" value="VeriSign PayFlow Pro" <? if ($rs[1] == "VeriSign PayFlow Pro") {?>checked<? }?>> VeriSign PayFlow Pro<p>
				</blockquote>

				</font></td>

			</tr>
		</table>
  <p> 
			
    <input type="submit" name="Submit" value="<?=$Action?> Client Payment Service">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td><a href="manage_client_payment.php?Action=Set"><img src="../images/set_payment_services.gif" alt="Set Client Payment Services" width="137" height="21" border="0"></a></td>
    <td>&nbsp;&nbsp;</td>
    <td><a href="manage_client_db.php"><img src="../images/client_database.gif" width="107" height="21" border="0"></a></td>
    <td><a href="manage_client_com.php"><img src="../images/ecommerce_components.gif" alt="Manage Client Ecommerce Components" width="163" height="21" border="0"></a></td>
  </tr>
</table>

<br>
<table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>

		<? for($i=0;$i<count($field_name);$i++) {?>

		

		

    <th width="21" valign="bottom" nowrap bgcolor="#999999"> <font size="-1" color="#ffffff" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font> </th>



		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>

			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">

				<?=$rs[$i]?>

			</font></td>

		<? }?>
	</tr>
	<? }?>
</table>
<p>
<center>

    
  <table border="0" align="center" cellpadding="0" cellspacing="0">
      
    <tr>
        
      <td><a href="manage_client_payment.php?Action=Set"><img src="../images/set_payment_services.gif" alt="Set Client Payment Services" width="137" height="21" border="0"></a></td>
      <td>&nbsp;&nbsp;</td>
      <td><a href="manage_client_db.php"><img src="../images/client_database.gif" width="107" height="21" border="0"></a></td>
      <td><a href="manage_client_com.php"><img src="../images/ecommerce_components.gif" alt="Manage Client Ecommerce Components" width="163" height="21" border="0"></a></td>
    </tr>
    
  </table>
  </center>
</p>
<? }?>
</body>
</html>
