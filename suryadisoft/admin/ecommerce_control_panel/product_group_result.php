<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$table = strtoupper(str_replace(" ","_",$group_name));
$table = str_replace("(","",$table);
$table = str_replace(")","",$table);
$table = str_replace("&","",$table);
$table = str_replace("'","",$table);
$table = str_replace("\\","",$table);
$table = str_replace("?","",$table);
$table = str_replace("!","",$table);
$query = Array();
$isSuccess = true;
if ($Action == "Add") {
	$query[] = "INSERT INTO PRODUCT_GROUP (group_name) VALUES ('$group_name')";
	$query[] = "CREATE TABLE $table (id INT UNSIGNED NOT NULL AUTO_INCREMENT, product_id INT UNSIGNED NOT NULL , sequence INT UNSIGNED NOT NULL , PRIMARY KEY(id))";
} else if ($Action == "Update") {
	$old_table = strtoupper(str_replace(" ","_",$old_group_name));
	$old_table = strtoupper(str_replace("(","",$old_table));
	$old_table = strtoupper(str_replace(")","",$old_table));
	$old_table = strtoupper(str_replace("&","",$old_table));
	$old_table = strtoupper(str_replace("'","",$old_table));
	$old_table = strtoupper(str_replace("\\","",$old_table));
	$old_table = strtoupper(str_replace("?","",$old_table));
	$old_table = strtoupper(str_replace("!","",$old_table));
	$query[] = "UPDATE PRODUCT_GROUP SET group_name = '$group_name' WHERE group_name = '$old_group_name'";
	$query[] = "ALTER TABLE $old_table RENAME TO $table";
} else if ($Action == "Delete") {
	$query[] = "DELETE FROM PRODUCT_GROUP WHERE group_name = '$group_name'";
	$query[] = "DROP TABLE $table";
} else if ($Action == "Clean") {
	$query1 = "select $table.product_id from $table LEFT JOIN PRODUCT on $table.product_id = PRODUCT.product_id where PRODUCT.product_id IS NULL";
	$query_result = mysql_query($query1);
	while ($rs = mysql_fetch_row($query_result)) {
		$query[] = "DELETE FROM $table WHERE product_id = " . $rs[0];
	}
}

for ($i=0;$i<count($query);$i++) {
	$isSuccess = mysql_query($query[$i]);
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::write($query[$i] . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?> Product Group Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
<meta http-equiv="refresh" content="0;URL=product_group.php<? if (isset($Mode)) {?>?Mode=<?=$Mode?><? }?>">
<? }?>
</head>
<script language="javascript">
<!--
if (window.opener != null) {
	window.opener.eval("refreshWebContent()");
	window.close();
}
-->
</script>
</html>
