<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (isset($DBName)) {
	$selected_db = $DBName;
	$selected_table = $TableName;
	$HTTP_SESSION_VARS["selected_db"] = $selected_db;
	$HTTP_SESSION_VARS["selected_table"] = $selected_table;
} else {
	$selected_db = $HTTP_SESSION_VARS["selected_db"];
	$selected_table = $HTTP_SESSION_VARS["selected_table"];
}
	
if ($selected_table != "") {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	$query = "SELECT * FROM " . $selected_table;
	mysql_select_db($HTTP_SESSION_VARS['selected_db']);
	$query_result = mysql_query($query);
	$field_list = mysql_list_fields($selected_db,$selected_table);
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Table: <?=$HTTP_SESSION_VARS['selected_table']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<? if ($selected_table != "") {?>
<h1 align="center">TABLE: <?=$HTTP_SESSION_VARS['selected_table']?></h1>
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
				  <td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
            <?=$rs[$i]?>
          </td>
				<? }?>
			</tr>
			<? }?>
		</table>
	</td></tr>
</table>
<? } else {?>
<h1>There are no table in this database</h1>
<? }?>
</body>
</html>
