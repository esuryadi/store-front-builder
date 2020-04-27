<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	if (isset($display_option) && $display_option == "some")
		$limit = "LIMIT $num_of_transactions";
	else if (isset($display_option) && $display_option == "all")
		$limit = "";
	else
		$limit = "LIMIT 50";
	
	if (isset($sort_by) && $sort_by == "status")
		$sort_by = "transaction_status";
	else if (isset($sort_by) && $sort_by == "charge")
		$sort_by = "transaction_total_charge";
	else
		$sort_by = "transaction_date_time";
	
	if (isset($sort_order) && $sort_order == "asc")
		$sort_order = "";
	else
		$sort_order = "DESC";
		
	if (isset($name) && $name != "") {
		$from = "TRANSACTION, CUSTOMER";
		$where = "WHERE TRANSACTION.customer_id = CUSTOMER.customer_id AND (CUSTOMER.customer_first_name LIKE '%$name%' OR CUSTOMER.customer_last_name LIKE '%$name%')";
	} else {
		$from = "TRANSACTION";
		$where = "";
	}
		
	$query = "SELECT transaction_id, transaction_date_time, transaction_total_charge, transaction_status, transaction_tracking_number FROM $from $where ORDER BY $sort_by $sort_order $limit";	
	$query_result = mysql_query($query);
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Transaction</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function deleteTransaction() {
	document.deleteTransactionForm.submit();
}

function updateTransactionStatus(id,transaction_status) {
	var url = "transaction_result.php?Action=UpdateStatus&transaction_id=" + id + "&transaction_status=" + transaction_status;
	open(url,"_parent");
}

function updateTransactionTrackingNumber(id,transaction_tracking_number) {
	var url = "transaction_result.php?Action=UpdateTrackingNumber&transaction_id=" + id + "&transaction_tracking_number=" + transaction_tracking_number;
	open(url,"_parent");
}
</script>
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body vlink="00aeef">
<p align="center">
<form name="deleteTransactionForm" method="post" action="transaction_result.php?Action=Delete" target="_parent">
<table border="0" cellpadding="8" cellspacing="0">
<tr>
	<th>&nbsp;</th>
	<? for($i=0;$i<count($field_name);$i++) {?>
	<? if ($i != 0) {?>
	<th bgcolor="#999999"> 
		<font size="-1"><?=str_replace("TRANSACTION ","",strtoupper(str_replace("_"," ",$field_name[$i])))?></font>
	</th>
	<? }?>
	<? }?>
</tr>
<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) { if ($n == 0) $id = $rs[0];?>
<tr>
	<td><input name="id[]" type="checkbox" value="<?=$rs[0]?>"></td>
	<? for($i=0;$i<count($rs);$i++) {?>
	<? if ($i != 0) {?>
	<td valign="top" align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>" <? if ($field_name[$i] == "transaction_date_time") {?>nowrap<? }?>>
		<? if ($field_name[$i] == "transaction_date_time") {?>
			<a href="transaction_info.php?transaction_id=<?=$rs[0]?>" target="rightFrame"><?=str_replace(" ","<br>",$rs[$i])?></a> 
		<? } else if ($field_name[$i] == "transaction_status") {?>
		<select name="transaction_status" onChange="updateTransactionStatus('<?=$rs[0]?>',this.value);">
		<option value="Pending" <? if($rs[$i] == "Pending") {?>SELECTED<? }?>>Pending</option>
		<option value="Partially Completed" <? if($rs[$i] == "Partially Completed") {?>SELECTED<? }?>>Partially Completed</option>
		<option value="Completed" <? if($rs[$i] == "Completed") {?>SELECTED<? }?>>Completed</option>
		<option value="Cancelled" <? if($rs[$i] == "Cancelled") {?>SELECTED<? }?>>Cancelled</option>
		</select>
		<? } else if ($field_name[$i] == "transaction_tracking_number") {?>
		    <input name="transaction_tracking_number" type="text" onBlur="updateTransactionTrackingNumber('<?=$rs[0]?>',this.value);" value="<?=$rs[$i]?>" size="12">
		<? } else {?>
			<? if ($field_name[$i] == "transaction_total_charge") {?>$<? }?><?=$rs[$i]?>
		<? }?> 
	</td>
	<? }?>
	<? }?>
</tr>
<? }?>
</table>
</form>
<script language="JavaScript">
<!--
open("transaction_info.php?transaction_id=<? if (isset($id)) {?><?=$id?><? }?><? if (isset($status)) {?>&status=<?=$status?><? }?>","rightFrame");
-->
</script>
</body>
</html>
