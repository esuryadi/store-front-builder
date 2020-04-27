<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	$main_cat_query = "SELECT categories_main FROM CATEGORIES GROUP BY categories_main ORDER BY categories_main";	
	$main_cat_query_result = mysql_query($main_cat_query);
	$main_cat = Array();
	while ($rs = mysql_fetch_row($main_cat_query_result))
		$main_cat[] = $rs[0];
		
	$sub_cat_1_query = "SELECT categories_sub_1 FROM CATEGORIES GROUP BY categories_sub_1 ORDER BY categories_sub_1";	
	$sub_cat_1_query_result = mysql_query($sub_cat_1_query);
	$sub_cat_1 = Array();
	while ($rs = mysql_fetch_row($sub_cat_1_query_result))
		if ($rs[0] != "")
			$sub_cat_1[] = $rs[0];
	
	$sub_cat_2_query = "SELECT categories_sub_2 FROM CATEGORIES GROUP BY categories_sub_2 ORDER BY categories_sub_2";	
	$sub_cat_2_query_result = mysql_query($sub_cat_2_query);
	$sub_cat_2 = Array();
	while ($rs = mysql_fetch_row($sub_cat_2_query_result))
		if ($rs[0] != "")
			$sub_cat_2[] = $rs[0];
		
	if (!isset($Action))
		$Action = "Add";
	if (!isset($category))
		$category = $main_cat[0];
	
	if (array_search($category,$main_cat) > -1)
		$category_level = "main";
	else if (array_search($category,$sub_cat_1) > -1) {
		$category_level = "sub 1";
		$query = "SELECT categories_main FROM CATEGORIES WHERE categories_sub_1 = '$category' GROUP BY categories_main";
		$rs = mysql_fetch_row(mysql_query($query));
		$sub_cat = $rs[0];
	} else if (array_search($category,$sub_cat_2) > -1) {
		$category_level = "sub 2";
		$query = "SELECT categories_sub_1 FROM CATEGORIES WHERE categories_sub_2 = '$category' GROUP BY categories_sub_1";
		$rs = mysql_fetch_row(mysql_query($query));
		$sub_cat = $rs[0];
	}
	
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<html>
<head>
<title>Manage Categories</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function setCategoryAction(action) {
	var url = "categories.php?Action=" + action;
	open(url,"_self");
}

function selectCategory(category) {
	var url = "categories.php?Action=<?=$Action?>&category=" + category;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.category_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Category Name is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
<style type="text/css">
<!--
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body vlink="00aeef">
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong><a href="file:///web_content.php">Manage 
  Store Components</a> &gt; <font color="00AEEF">Manage Categories</font></strong></font></p>
<form action="categories_result.php" method="post" name="categoriesForm" target="_parent" id="categoriesForm">
  <p> 
    <input name="Action" type="radio" value="Add" onClick="setCategoryAction('Add');" <? if (!isset($Action) || $Action == "Add") {?>checked<? }?>>
    <strong>Add New Category</strong> 
    <input type="radio" name="Action" value="Update" onClick="setCategoryAction('Update');" <? if (!isset($Action) || $Action == "Update") {?>checked<? }?>>
    <strong>Edit Existing Category</strong></p>
	<? if (isset($Action) && $Action == "Update") {?>
  <p><strong>Select Category: 
    <select name="category" id="category" onChange="selectCategory(this.value);">
		<? for ($i=0;$i<count($main_cat);$i++) {?>
		<option value="<?=$main_cat[$i]?>" <? if ($category == $main_cat[$i]) {?>selected<? }?>><?=$main_cat[$i]?></option>
		<? }?>
		<? for ($i=0;$i<count($sub_cat_1);$i++) {?>
		<option value="<?=$sub_cat_1[$i]?>" <? if ($category == $sub_cat_1[$i]) {?>selected<? }?>><?=$sub_cat_1[$i]?></option>
		<? }?>
		<? for ($i=0;$i<count($sub_cat_2);$i++) {?>
		<option value="<?=$sub_cat_2[$i]?>" <? if ($category == $sub_cat_2[$i]) {?>selected<? }?>><?=$sub_cat_2[$i]?></option>
		<? }?>
    </select>
    </strong></p>
		<input type="hidden" name="current_category_level" value="<?=$category_level?>">
	<? }?>
	<p><strong>Category Name:</strong> 
		<input name="category_name" type="text" id="category_name" <? if (isset($Action) && $Action == "Update") {?>value="<?=$category?>"<? }?>>
	</p>
	<p> 
		<input name="category_level" type="radio" value="main" <? if (!isset($category_level) || (isset($category_level) && $category_level == "main")) {?>checked<? }?>>
		<strong>Main Category</strong></p>
	<p> 
		<input type="radio" name="category_level" value="sub 1" <? if (isset($category_level) && $category_level == "sub 1") {?>checked<? }?>>
		<strong>Sub Category 1 of</strong> 
		<select name="main_category" id="main_category">
		<? for ($i=0;$i<count($main_cat);$i++) {?>
		<option value="<?=$main_cat[$i]?>" <? if (isset($sub_cat) && $sub_cat == $main_cat[$i]) {?>selected<? }?>><?=$main_cat[$i]?></option>
		<? }?>
		</select>
	</p>
	<p> 
		<input type="radio" name="category_level" value="sub 2" <? if (isset($category_level) && $category_level == "sub 2") {?>checked<? }?>>
		<strong>Sub Category 2 of </strong> 
		<select name="sub_category_1" id="sub_category_1">
		<? for ($i=0;$i<count($sub_cat_1);$i++) {?>
		<option value="<?=$sub_cat_1[$i]?>" <? if (isset($sub_cat) && $sub_cat == $sub_cat_1[$i]) {?>selected<? }?>><?=$sub_cat_1[$i]?></option>
		<? }?>
		</select>
	</p>
	<p align="center"> 
    <input name="categoryButton" type="submit" id="categoryButton" value="<?=$Action?> Category" onClick="validateForm(this.form);">
    <input name="resetButton" type="reset" id="resetButton" value="Reset">
    <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#categories','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
  </p>
</form>
</body>
</html>
