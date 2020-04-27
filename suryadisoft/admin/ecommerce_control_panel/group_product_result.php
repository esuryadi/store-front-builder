<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$selected_table = strtoupper(str_replace(" ","_",$selected_product_group));
$selected_table = strtoupper(str_replace("(","",$selected_table));
$selected_table = strtoupper(str_replace(")","",$selected_table));
$selected_table = strtoupper(str_replace("&","",$selected_table));
$selected_table = strtoupper(str_replace("'","",$selected_table));
$selected_table = strtoupper(str_replace("\\","",$selected_table));
$selected_table = strtoupper(str_replace("?","",$selected_table));
$selected_table = strtoupper(str_replace("!","",$selected_table));
if ($Action == "Add") {
	$query1 = "SELECT * FROM $selected_table";
	$query_result = mysql_query($query1);
	if (mysql_num_rows($query_result) > 0) {
		$max_sequence = "SELECT MAX(sequence) FROM $selected_table";
		$max_sequence_result = mysql_query($max_sequence);
		$rs = mysql_fetch_row($max_sequence_result);
		$sequence = $rs[0] + 1;
	} else
		$sequence = 1;
	for ($i=0;$i<count($product_list);$i++) { 
		$query[] = "INSERT INTO $selected_table (product_id,sequence) VALUES ($product_list[$i],$sequence)";
		$sequence = $sequence + 1;
	}
} else if ($Action == "Delete") {
	for ($i=0;$i<count($group_product_list);$i++)
		$query[] = "DELETE FROM $selected_table WHERE product_id = $group_product_list[$i]";
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
<meta http-equiv="refresh" content="0;URL=group_product.php?selected_product_group=<?=urlencode(stripslashes($selected_product_group))?>">
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
