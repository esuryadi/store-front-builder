<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
if (isset($Action) && $Action == "UpdateStatus") {
	$query = "UPDATE PURCHASE SET PURCHASE_STATUS = '$purchase_status' WHERE PURCHASE_ID = $purchase_id";
	mysql_query($query);
}
$query = "SELECT PURCHASE_ID, PRODUCT_NAME, PURCHASE_QUANTITY, PURCHASE_CHARGE, PURCHASE_STATUS FROM PURCHASE, PRODUCT WHERE PRODUCT.PRODUCT_ID = PURCHASE.PRODUCT_ID AND TRANSACTION_ID = $transaction_id";	
$query_result = mysql_query($query);

for ($i=0;$i<mysql_num_fields($query_result);$i++)
	$field_name [] = mysql_field_name($query_result,$i);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Purchase Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Purchase 
  Order</strong></font></p>
<p>&nbsp; </p>
<table border="0" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
    <th bgcolor="#999999" nowrap> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF">
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font> </th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($query_result,$i),"INT") || stristr(mysql_field_type($query_result,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<? if ($i == 4) {?>
      </font> <form method="POST" action="../ecommerce_tool/view_purchase.php?Action=UpdateStatus&purchase_id=<?=$rs[0]?>">
        <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
					<input type="hidden" name="transaction_id" value="<?=$transaction_id?>">
					<select name="purchase_status" onChange="submit();">
          <option value="In Process" <? if($rs[$i] == "In Process") {?>SELECTED<? }?>>In 
          Process</option>
          <option value="Back Order" <? if($rs[$i] == "Back Order") {?>SELECTED<? }?>>Back 
          Order</option>
					<option value="Shipped" <? if($rs[$i] == "Shipped") {?>SELECTED<? }?>>Shipped</option>
					</select>
        </font> 
					</form>
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<? } else {?>
					<?=$rs[$i]?>
				<? }?>
      </font> </td>
		<? }?>
	</tr>
	<? }?>
</table>
<p align="center"><a href="transaction.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back</font></a></p>

</body>
</html>
