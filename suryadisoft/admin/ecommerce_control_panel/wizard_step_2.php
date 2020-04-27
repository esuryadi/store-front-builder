<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {
	$logout = true;
} else {
	$admin = $HTTP_SESSION_VARS["admin_user"];
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	$query = "SELECT categories_id, categories_main FROM CATEGORIES GROUP BY categories_main";
	$query_result = mysql_query($query) or die(mysql_error());
	$categories = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$cat["id"] = $rs[0];
		$cat["name"] = $rs[1];
		$categories [] = $cat;
	}
	
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'HomeRemoved'";
	$query_result = mysql_query($query);
	$rs = mysql_fetch_row($query_result);
	if (mysql_num_rows($query_result) > 0)
		$HomeRemoved = $rs[2];
	else
		$HomeRemoved = "no";
	
	$db_connect->close();
	$admin->retrieveAdminInfo($userid);
	
	function getSubCategory($main_category,$selected_db) {
		$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
		$db_connect->open();
		
		mysql_select_db($selected_db);
		
		$query = "SELECT categories_id, categories_sub_1 FROM CATEGORIES WHERE categories_main = '$main_category' AND categories_sub_1 <> '' GROUP BY categories_sub_1";
		$query_result = mysql_query($query) or die(mysql_error());
		$categories = Array();
		while ($rs = mysql_fetch_row($query_result)) {
			$cat["id"] = $rs[0];
			$cat["name"] = $rs[1];
			$categories [] = $cat;
		}	
		
		$db_connect->close();
		
		return $categories;
	}
	$logout = false;
}
?>
<html>
<head>
<title>Online Store Builder - Step 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style1 {
	font-size: smaller;
	font-weight: bold;
	color: #FFFFFF;
}
.style2 {font-size: smaller}
.style4 {font-size: smaller; font-weight: bold; }
.style5 {
	font-size: xx-small;
	font-weight: bold;
}
-->
</style>
</head>
<script language="javascript">
<!--
<? if ($logout) {?>
window.open("../login.php?Action=logout&session_out=true","_top");
<? }?>

	function setAction(action) {
		open("wizard_step_2.php?act=" + action,"_self");
	}
	
	function validateForm(form) {
		var is_valid = true;
		var err_msg = "";
		
		if (form.page.value == "") {
			is_valid = false;
			err_msg = err_msg + "Please select the page you want to delete!";
		}
		
		if (!is_valid)
			alert(err_msg);
			
		event.returnValue = is_valid;
	}
-->
</script>
<body>
<form action="setAction.php" method="post" name="set_action_form" id="set_action_form">
<table width="600" height="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="00AEEF">
<tr><td>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
<tr>
  <td bgcolor="00AEEF" height="5%"><span class="style1">Online Store Builder Wizard - Step 2 </span></td>
</tr>
<tr><td height="90%">    <table width="100%" cellpadding="5">
  <tr>
    <td width="40%"><table width="100%" height="350" border="1" cellpadding="5" cellspacing="0" bordercolor="#4ACDFF">
      <tr>
        <td width="40%" valign="top" bgcolor="#CCF1FF"><p class="style2"><strong>Welcome to online store builder wizard! </strong></p>
          <p class="style2">From here, you can start to create a new page or delete an existing page.</p>
          <p class="style2">However, to edit your existing page such as changing page name, adding more store components, etc. You need to go to <a href="menu_bottom.php?page=manage_store"><strong>Manage Store</strong></a> section<strong>.  </strong></p></td>
      </tr>
    </table></td>
    <td width="60%"><p><span class="style4">What would you like to do?</span><br>
          <input name="action" type="radio" value="create page" onClick="setAction('create');" <? if (!isset($act) || (isset($act) && $act == "create")) {?>checked<? }?>>
          <span class="style2">Create a new page</span><br>
          <input name="action" type="radio" value="delete page" onClick="setAction('delete');" <? if (isset($act) && $act == "delete") {?>checked<? }?>>
          <span class="style2">Delete your existing page</span> </span></p>
      <? if (isset($act) && $act != "create") {?>
      <p><span class="style2"><strong>Select which page you'd like to
              <?=$act?>
        </strong>:</span><br>
        <select name="page" id="page">
		  <? if ($HomeRemoved == "no") {?>
          <option value="Home;main">+ Home</option>
		  <? }?>
          <? $sub_categories = getSubCategory("Home",$HTTP_SESSION_VARS["selected_db"]); 
		for($n=0;$n<count($sub_categories);$n++) {
		$sub_cat = $sub_categories[$n];?>
          <option value="<?=$sub_cat["name"]?>;sub"> -
          <?=$sub_cat["name"]?>
          </option>
          <? }?>
          <? for($i=0;$i<count($categories);$i++) {
		$cat = $categories[$i];?>
          <? if ($cat["name"] != "Home") {?>
          <option value="<?=$cat["name"]?>;main">+
          <?=$cat["name"]?>
          </option>
          <? $sub_categories = getSubCategory($cat["name"],$HTTP_SESSION_VARS["selected_db"]); 
		for($n=0;$n<count($sub_categories);$n++) {
		$sub_cat = $sub_categories[$n];?>
          <option value="<?=$sub_cat["name"]?>;sub"> -
          <?=$sub_cat["name"]?>
          </option>
          <? }?>
          <? }?>
          <? }?>
        </select>
      </p>
      <p class="style5">+ Main Category - Sub Category </p>
      <? }?></td>
  </tr>
</table>
</td>
</tr>
<tr>
  <td align="center" bgcolor="00AEEF" height="5%"><table width="100%"  border="0">
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="BackButton" type="button" id="BackButton" value="&lt;&lt; Back" onClick="window.open('wizard_step_1.php','_self');">        </td>
      <td align="right">
	  	<? if (!isset($act) || (isset($act) && $act != "delete")) {?>
		<input name="NextButton" type="submit" id="NextButton" value="Next &gt;&gt;">
		<? } else {?>
        <input name="deleteButton" type="submit" id="deleteButton" value="Delete Page" onClick="validateForm(this.form);">
		<? }?>
        &nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table></td>
</tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>