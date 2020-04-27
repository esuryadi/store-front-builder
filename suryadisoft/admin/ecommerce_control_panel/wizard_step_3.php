<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {
	$logout = true;
} else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	$query = "SELECT categories_main FROM CATEGORIES GROUP BY categories_main";
	$query_result = mysql_query($query);
	$categories = Array();
	$categories [] = "- Select The Main Page -";
	$categories [] = "Home";
	while($rs = mysql_fetch_row($query_result))
		$categories [] = $rs[0];
	
	if (!isset($page_layout))
		$page_layout = "one column";
	
	$HTTP_SESSION_VARS["db_connect"]->close();
	
	$logout = false;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Store Builder Wizard - Step 3 </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
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
-->
</style>
<script language="JavaScript">
<!--
<? if ($logout) {?>
window.open("../login.php?Action=logout&session_out=true","_top");
<? }?>

	function validateForm(form) {
		var is_valid = true;
		var err_msg = "";
		
		if (form.page_name.value == "") {
			is_valid = false;
			err_msg = err_msg + "Page Name is required\n";
		}
		if (form.page_category[1].checked && (form.main_category.value == "- Select The Main Page -" || form.main_category.value == "- Select Sub Category -")) {
			is_valid = false;
			err_msg = err_msg + "Please select main category or sub category\n";
		}
		
		if (!is_valid)
			alert(err_msg);
			
		event.returnValue = is_valid;
	}
	
	function changePageLayout(page_layout) {
		var url = "wizard_step_3.php?action=change_layout&page_layout=" + page_layout + "&page_name=" + document.CreatePageForm.page_name.value;
		open(url,"_self");
	}
-->
</script>
<body>
<form action="create_page.php" method="post" name="CreatePageForm" id="CreatePageForm">
<table width="600" height="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="00AEEF">
<tr><td>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
<tr>
  <td bgcolor="00AEEF" height="5%"><span class="style1">Online Store Builder Wizard - Step 3 </span></td>
</tr>
<tr><td height="90%">    <table width="100%"  border="0" cellpadding="5">
  <tr>
    <td width="40%"><table width="100%" height="360" border="1" cellpadding="5" cellspacing="0" bordercolor="#4ACDFF">
      <tr>
        <td width="40%" valign="top" bgcolor="#CCF1FF">
		<p class="style2"><strong>Page Layout:</strong></p>
		<p>
		<? if (isset($page_layout) && $page_layout == "one column") {?>
          <img src="../../components/images/layout_1.jpg">
          <? } else if (isset($page_layout) && $page_layout == "two columns") {?>
          <img src="../../components/images/layout_2.jpg">
          <? } else if (isset($page_layout) && $page_layout == "three columns") {?>
          <img src="../../components/images/layout_3.jpg">
          <? } else if (isset($page_layout) && $page_layout == "top, two columns") {?>
          <img src="../../components/images/layout_4.jpg">
          <? } else if (isset($page_layout) && $page_layout == "top, three columns") {?>
          <img src="../../components/images/layout_5.jpg">
          <? } else if (isset($page_layout) && $page_layout == "two columns, bottom") {?>
          <img src="../../components/images/layout_6.jpg">
          <? } else if (isset($page_layout) && $page_layout == "three columns, bottom") {?>
          <img src="../../components/images/layout_7.jpg">
          <? } else if (isset($page_layout) && $page_layout == "top, two columns, bottom") {?>
          <img src="../../components/images/layout_8.jpg">
          <? } else if (isset($page_layout) && $page_layout == "top, three columns, bottom") {?>
          <img src="../../components/images/layout_9.jpg">
          <? }?>
</p>
		<p class="style2">Each page is divided into 5 different sections: Top, Left, Center, Right, and Bottom. On each section you can add one or more store components. </p></td>
      </tr>
    </table></td>
    <td width="60%"><p><strong><span class="style2">Enter the name of your page (e.g. Home, About Us, Contact Us, etc.)</span><br>
      </strong>
          <input name="page_name" type="text" id="page_name2" size="40" value="<? if (isset($page_name) && $page_name != "") {?><?=$page_name?><? }?>">
    </p>
      <p><span class="style2"><strong>This page is a: </strong></span><br>
          <input name="page_category" type="radio" value="main" checked>
          <span class="style2"><strong> Main Page<br> 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- or - </strong></span><br> 
          <strong>
          <input type="radio" name="page_category" value="sub">
          <span class="style2">Sub Level of Page:</span></strong>
          <select name="main_category">
            <? for($i=0;$i<count($categories);$i++) {?>
            <option value="<?=$categories[$i]?>">
            <?=$categories[$i]?>
            </option>
            <? }?>
          </select>
      </p>
      <p><span class="style2"><strong>Select your page layout: </strong></span>
          <select name="page_layout" id="select" onChange="changePageLayout(this.value);">
            <option value="one column" <? if ((isset($page_layout) && $page_layout == "one column")) {?>selected<? }?>>One Column</option>
            <option value="two columns" <? if ((isset($page_layout) && $page_layout == "two columns")) {?>selected<? }?>>Two Columns</option>
            <option value="three columns" <? if ((isset($page_layout) && $page_layout == "three columns")) {?>selected<? }?>>Three Columns</option>
            <option value="top, two columns" <? if ((isset($page_layout) && $page_layout == "top, two columns")) {?>selected<? }?>>Top and Two Columns</option>
            <option value="top, three columns" <? if ((isset($page_layout) && $page_layout == "top, three columns")) {?>selected<? }?>>Top and Three Columns</option>
            <option value="two columns, bottom" <? if ((isset($page_layout) && $page_layout == "two columns, bottom")) {?>selected<? }?>>Two Columns and Bottom</option>
            <option value="three columns, bottom" <? if ((isset($page_layout) && $page_layout == "three columns, bottom")) {?>selected<? }?>>Three Columns and Bottom</option>
            <option value="top, two columns, bottom" <? if ((isset($page_layout) && $page_layout == "top, two columns, bottom")) {?>selected<? }?>>Top, Two Columns and Bottom</option>
            <option value="top, three columns, bottom" <? if ((isset($page_layout) && $page_layout == "top, three columns, bottom")) {?>selected<? }?>>Top, Three Columns and Bottom</option>
          </select>
      </p>	</td>
  </tr>
</table>
</td>
</tr>
<tr>
  <td align="center" bgcolor="00AEEF" height="5%"><table width="100%"  border="0">
    <tr>
      <td align="left" width="50%">&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="BackButton" type="button" id="BackButton" value="&lt;&lt; Back" onClick="window.open('wizard_step_2.php','_self');">        </td>
      <td align="right" width="50%">
		<input name="NextButton" type="submit" id="NextButton" value="Next &gt;&gt;" onClick="validateForm(this.form);">

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
