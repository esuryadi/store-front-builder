<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");

if (isset($transaction_id) && $transaction_id != "") {
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	if (isset($Action) && $Action == "UpdateStatus") {
		$query = "UPDATE PURCHASE SET PURCHASE_STATUS = '$purchase_status' WHERE PURCHASE_ID = $purchase_id";
		mysql_query($query);
	}
	$query = "SELECT PURCHASE_ID, PRODUCT_NAME, PURCHASE.PRODUCT_COLOR, PURCHASE.PRODUCT_SIZE, PURCHASE.PRODUCT_CHOICE, PURCHASE_QUANTITY, PURCHASE_CHARGE, PURCHASE_STATUS FROM PURCHASE, PRODUCT WHERE PRODUCT.PRODUCT_ID = PURCHASE.PRODUCT_ID AND TRANSACTION_ID = $transaction_id";	
	$query_result = mysql_query($query);
	
	for ($i=0;$i<mysql_num_fields($query_result);$i++)
		$field_name2 [] = mysql_field_name($query_result,$i);
		
	$db_connect->close();
}
?>
<html>
<head>
<title>Purchase Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Purchase Detail Information</strong>
</font> 

<p>

<? if (isset($transaction_id) && $transaction_id != "") {?>
<input type="button" name="addBtn" value="Add Item" onClick="window.open('purchase_form.php?Action=Add&transaction_id=<?=$transaction_id?>&customer_id=<?=$customer_id?>','purchase_form','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=900,height=380');"/><br>
<table border="0" cellpadding="3" cellspacing="0">
<tr>
	<? for($i=0;$i<count($field_name2);$i++) {?>
    <th bgcolor="#999999"> 
		<font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF">
      	<?=ucwords(strtolower(str_replace("_"," ",$field_name2[$i])))?>
      	</font> 
	</th>
	<? }?>
</tr>
<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
<tr>
	<? for($i=0;$i<count($rs);$i++) {?>
	<td valign="top" align="<? if (stristr(mysql_field_type($query_result,$i),"INT") || stristr(mysql_field_type($query_result,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"> 
		<? if ($field_name2[$i] == "PURCHASE_STATUS") {?>
      	<form method="POST" action="purchase_info.php?Action=UpdateStatus&purchase_id=<?=$rs[0]?>">
        	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<input type="hidden" name="Action" value="UpdateStatus">
			<input type="hidden" name="transaction_id" value="<?=$transaction_id?>">
			<select name="purchase_status" onChange="submit();">
          		<option value="In Process" <? if($rs[$i] == "In Process") {?>SELECTED<? }?>>In Process</option>
          		<option value="Back Order" <? if($rs[$i] == "Back Order") {?>SELECTED<? }?>>Back Order</option>
				<option value="Shipped" <? if($rs[$i] == "Shipped") {?>SELECTED<? }?>>Shipped</option>
				<option value="Cancelled" <? if($rs[$i] == "Cancelled") {?>SELECTED<? }?>>Cancelled</option>
			</select>
        	</font> 
		</form>
      	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
		<? } else {?>
			<? if ($field_name2[$i] == "PURCHASE_CHARGE") {?>$ <? }?><?=$rs[$i]?>
		<? }?>
      	</font> 
	</td>
	<? }?>
	<td nowrap>
		<input type="button" name="editBtn" value="Edit" onClick="window.open('purchase_form.php?Action=Update&transaction_id=<?=$transaction_id?>&purchase_id=<?=$rs[0]?>','purchase_form','toolbar=no,status=no,scrollbars=yes,location=no,menubar=no,directories=no,width=900,height=380');"/>
		<input type="button" name="deleteBtn" value="Delete" onClick="window.open('purchase_form_action.php?Action=Delete&transactionId=<?=$transaction_id?>&purchaseId=<?=$rs[0]?>');"/>
	</td>
</tr>
<? }?>
</table>
<? }?>
</body>
</html>
