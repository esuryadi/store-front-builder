<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

if ($page_category == "main") {
	$query = "SELECT * FROM CATEGORIES where categories_main = '$page_name'";
} else {
	$query = "SELECT * FROM CATEGORIES where categories_main = '$main_category' AND $categories_sub_1 = '$page_name'";
}			
$query_result = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($query_result) < 1) {
	if (strtolower($page_name) != "home") {
		if ($page_category == "main") {
			$query = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) VALUES ('$page_name','','')";
		} else {
			$query = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) VALUES ('$main_category','$page_name','')";
		}			
		mysql_query($query) or die(mysql_error());
	} 
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>

<form name="PageInfoForm" id="PageInfoForm" method="post" action="wizard_step_4.php">
<input type="image" src="https://www.suryadisoft.net/images/spacer.gif">
<input type="hidden" name="page_name" value="<?=$page_name?>">
<input type="hidden" name="page_category" value="<?=$page_category?>">
<input type="hidden" name="main_category" value="<?=$main_category?>">
<input type="hidden" name="page_layout" value="<?=$page_layout?>">
</form>

<script language="JavaScript">
<!--
	<? if (mysql_num_rows($query_result) < 1) {?>
	document.PageInfoForm.submit();
	<? } else {?>
	alert("Page is already exists! Please choose different name.");
	window.open("wizard_step_3.php","_self");
	<? }?>
-->
</script>
