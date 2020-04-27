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
	$query = "SELECT * FROM CLIENT_COMPONENTS WHERE user_id = '$user_id'";
else
	$query = "SELECT * FROM CLIENT_COMPONENTS ORDER BY user_id";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"CLIENT_COMPONENTS");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Client Components</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function getClientComponent(id) {
	var url = "manage_client_com.php?Action=Set&user_id=" + id;
	open(url,"_self");
}

function selectUserAccount(form) {
	if (form.WishList.checked)
		form.UserAccount.checked = true;
}

function unselectWishList(form) {
	if (form.UserAccount.checked == false)
		form.WishList.checked = false;
}

</script>
</head>



<body vlink="00aeef">
<font face="Verdana, Arial, Helvetica, sans-serif"><a href="manage_clients.php"><font size="-1">Manage 
Clients</font></a><strong> <font size="-1">&gt;</font></strong></font> <font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
Client Components</strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_client_com_result.php" method="post" name="clientComForm" id="clientComForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? while($rs = mysql_fetch_array($query_result)) {
				$components[] = $rs["component"];
			}?>		 
			<tr>				
      <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">User Id:</font> 
        	<select name="user_id" onChange="getClientComponent(this.value);">
					<? for($n=0;$n<count($id);$n++) {?>
					<option value="<?=$id[$n]?>" <? if (isset($user_id) && $user_id == $id[$n]) {?>selected<? }?>><?=$id[$n]?></option>
					<? }?>
					</select>
				</td>
			</tr>
			<tr>
      <td nowrap> <b><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Components:</font></b> 
				<blockquote>
          <input type="checkbox" name="ShoppingCart" value="Shopping Cart" <? if (isset($components) && array_search("Shopping Cart",$components) > -1) {?>checked<? }?>>
          <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Shopping 
          Cart</font> 
          <p> 
            <input type="checkbox" name="WishList" value="Wish List" <? if (isset($components) && array_search("Wish List",$components) > -1) {?>checked<? }?> onClick="selectUserAccount(this.form);">
            <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Wish 
            List</font> 
          <p> 
            <input type="checkbox" name="UserAccount" value="User Account" <? if (isset($components) && array_search("User Account",$components) > -1) {?>checked<? }?> onClick="unselectWishList(this.form);">
            <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">User 
            Account</font> 
          <p> 
				</blockquote>
				</td>
			</tr>
		</table>
  <p> 
    <input type="submit" name="Submit" value="<?=$Action?> Client Components">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>

<br>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="112"><a href="manage_client_com.php?Action=Set"><img src="../images/set_components.gif" alt="Set Client eCommerce Components" width="112" height="21" border="0"></a></td>
    <td width="8">&nbsp;&nbsp;</td>
    <td width="107"><a href="manage_client_db.php"><img src="../images/client_database.gif" alt="Manage Client Database" width="107" height="21" border="0"></a></td>
    <td width="111"><a href="manage_client_payment.php"><img src="../images/payment_service.gif" alt="Payment Services" border="0"></a></td>
  </tr>
</table>
<br>
<p align="center">

<table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>

    <th valign="bottom" bgcolor="#999999"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"> 
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
      </font> </td>
		<? }?>
	</tr>
	<? }?>
</table>
<center>

    <br>
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="112"><a href="manage_client_com.php?Action=Set"><img src="../images/set_components.gif" alt="Set Client eCommerce Components" width="112" height="21" border="0"></a></td>
      <td width="8">&nbsp;&nbsp;</td>
      <td width="107"><a href="manage_client_db.php"><img src="../images/client_database.gif" alt="Manage Client Database" width="107" height="21" border="0"></a></td>
      <td width="111"><a href="manage_client_payment.php"><img src="../images/payment_service.gif" alt="Payment Services" border="0"></a></td>
    </tr>
  </table>
  </center>
</p>
<? }?>
</body>
</html>
