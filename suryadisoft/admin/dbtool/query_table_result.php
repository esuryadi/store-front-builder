<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<?php
$where_clause = "";
$order_by_clause = "";
$group_by_clause = "";

for ($i=0;$i<count($Select);$i++) {
	if ($i == 0) {
		$select_clause = $Select[$i];
	} else {
		$select_clause = $select_clause . ", " . $Select[$i];
	}
}	 

if (isset($WhereClause) && $WhereClause != "")
	$where_clause = "WHERE $WhereClause";
	
if (isset($GroupBy)) {
	for ($i=0;$i<count($GroupBy);$i++) {
		if ($i == 0) {
			$group_by_clause = "GROUP BY " . $GroupBy[$i];
		} else {
			$group_by_clause = $group_by_clause . ", " . $GroupBy[$i];
		}
	}
}

if (isset($OrderBy)) {
	for ($i=0;$i<count($OrderBy);$i++) {
		if ($i == 0) {
			$order_by_clause = "ORDER BY " . $OrderBy[$i];
		} else {
			$order_by_clause = $order_by_clause . ", " . $OrderBy[$i];
		}
	}
	$order_by_clause = $order_by_clause . " " . $Order;
}

$HTTP_SESSION_VARS["db_connect"]->open();

$query = "SELECT $select_clause FROM $TableName $where_clause $group_by_clause $order_by_clause";
mysql_select_db($DatabaseName);
$query_result = mysql_query($query);
fwrite($log,$query . "\n\n");

for ($i=0;$i<mysql_num_fields($query_result);$i++)
	$field_name [] = mysql_field_name($query_result,$i);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Query Table Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<p align="center">
<table border="1" cellpadding="0" cellspacing="0">
	<tr><td>
		<table border="0" cellpadding="8" cellspacing="0">
<tr>
				<? for($i=0;$i<count($field_name);$i++) {?>
				<th bgcolor="#999999"><?=$field_name[$i]?></th>
				<? }?>
			</tr>
			<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
			<tr>
				<? for($i=0;$i<count($rs);$i++) {?>
				  <td align="<? if (stristr(mysql_field_type($query_result,$i),"INT") || stristr(mysql_field_type($query_result,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
            <?=$rs[$i]?>
          </td>
				<? }?>
			</tr>
			<? }?>
		</table>
	</td></tr>
</table>
</p>
<p align="center">[<a href="query_table.php">Query More Data</a>][<a href="menu_top.php?Action=Refresh" target="topFrame">Back</a>]</p>
</body>
</html>
<?php
fclose($log);
?>