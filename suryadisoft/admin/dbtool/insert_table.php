<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$selected_db = $HTTP_SESSION_VARS["selected_db"];
$selected_table = $HTTP_SESSION_VARS["selected_table"];

$field_list = mysql_list_fields($selected_db,$selected_table);
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Insert Data Into Table</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<h1 align="center">Insert Data Into Table </h1>
<p align="center">&nbsp;</p>
<form action="insert_table_result.php" method="post" name="InsertTableForm" id="InsertTableForm">
  <p>Database: <?=$selected_db?></p>
	<input type="hidden" name="DatabaseName" value="<?=$selected_db?>"> 
	<p>Table: <?=$selected_table?></p>
	<input type="hidden" name="TableName" value="<?=$selected_table?>">
	<table bgcolor="#eeeeee" border="0" cellspacing="0" cellpadding="5">
	<? for ($i=0;$i<count($field_name);$i++) {?>
	<tr>		
		<td><?=$field_name[$i]?>:</td>
		<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
		<input type="hidden" name="FieldName[]" value="<?=$field_name[$i]?>">
		<td><input name="FieldValue[]" type="text" value="" size="50"></td>
		<? } else {?>
		<td>Auto</td>
		<? }?>
	</tr>
	<? }?>
	</table>
  <p>&nbsp;</p>
  <p align="center"> 
    <input type="submit" name="Submit" value="Insert">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  </form>
</body>
</html>
