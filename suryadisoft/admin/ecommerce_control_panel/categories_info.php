<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$query = "SELECT * FROM CATEGORIES ORDER BY categories_main, categories_sub_1, categories_sub_2";	
$query_result = mysql_query($query);
$main_categories = Array();
$temp = "";
$temp2 = "";
$sub_cat_1 = Array();
$sub_cat_2 = Array();
$sub_category_2 = Array();
$sub_categories_2 = Array();
while ($rs = mysql_fetch_row($query_result)) {
	if ($temp2 != $rs[2]) {
		if ($temp2 != "") {
			$sub_category_2 [] = $sub_cat_2;
			$sub_cat_2 = Array();
		}
	}
	if ($temp != $rs[1]) {
		if ($temp != "") {
			$sub_categories_1 [] = $sub_cat_1;
			$sub_cat_1 = Array();
			$sub_categories_2 [] = $sub_category_2;			
			$sub_category_2 = Array();
		}	
	}

	if ($rs[3] != "")
		$sub_cat_2 [] = $rs[3];
		
	if ($temp2 != $rs[2]) {
		if ($rs[2] != "")
			$sub_cat_1 [] = $rs[2];
		$temp2 = $rs[2];
	}
	
	if ($temp != $rs[1]) {
		$main_categories [] = $rs[1];
		$temp = $rs[1];			
	}
}
$sub_category_2 [] = $sub_cat_2;
$sub_categories_1 [] = $sub_cat_1;
$sub_categories_2 [] = $sub_category_2;

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>
<script language="JavaScript">
<!--
function deleteCategories() {
	document.deleteCategoriesForm.submit();
}
-->
</script>
<body>
<table width="0" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td>
			<table width="0" border="1" cellpadding="1" cellspacing="0" bordercolor="#000000">
        <tr>
          <td bgcolor="#eeeeee"><font size="-3">&nbsp;&nbsp;&nbsp;</font></td>
        </tr>
      </table>
		</td>
    <td><strong><font size="-3">Main Category</font></strong></td>
    <td>
			<table width="0" border="1" cellpadding="1" cellspacing="0" bordercolor="#000000">
        <tr>
          <td bgcolor="#FFFF99"><font size="-3">&nbsp;&nbsp;&nbsp;</font></td>
        </tr>
      </table>
		</td>
    <td><strong><font size="-3">Sub Category 1</font></strong></td>
    <td>
			<table width="0" border="1" cellpadding="1" cellspacing="0" bordercolor="#000000">
        <tr>
          <td bgcolor="#CCFFFF"><font size="-3">&nbsp;&nbsp;&nbsp;</font></td>
        </tr>
      </table>
		</td>
    <td><strong><font size="-3">Sub Category 2</font></strong></td>
  </tr>
</table>
<form name="deleteCategoriesForm" method="post" action="categories_result.php" target="_parent">
<input type="hidden" name="Action" value="Delete">
<table cellpadding="0" cellspacing="0" border="1" bordercolor="#FFCC66">
<tr><td>
	<table width="100%" border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td colspan="2" bgcolor="#FFCC66"><strong>Categories</strong>:</td>
	</tr>
	<? for ($x=0;$x<count($main_categories);$x++) {
	$sub_category_1 = $sub_categories_1[$x];
	$sub_category_2 = $sub_categories_2[$x];?>
	<tr>
		<td width="10%" bgcolor="#eeeeee"><input name="main_cat[]" type="checkbox" value="<?=$main_categories[$x]?>"></td>
		<td width="90%" bgcolor="#eeeeee" nowrap><?=$main_categories[$x]?></td>
	</tr>
	<? if (count($sub_category_1) > 0) {?>
	<tr>
		<td width="10%" bgcolor="#eeeeee">&nbsp;</td>
		<td width="90%" bgcolor="#eeeeee"> 
			<table width="100%" cellpadding="3" cellspacing="0">
			<? for ($y=0;$y<count($sub_category_1);$y++) {
			$sub_cat_2 = $sub_category_2[$y];?>
			<tr>
				<td width="10%" bgcolor="#FFFF99"><input name="sub_cat_1[]" type="checkbox" value="<?=$sub_category_1[$y]?>"></td>
				<td width="90%" bgcolor="#FFFF99" nowrap><?=$sub_category_1[$y]?></td>
			</tr>
			<? if (count($sub_cat_2) > 0) {?>
			<tr>
				<td width="10%" bgcolor="#FFFF99">&nbsp;</td>
				<td align="right" bgcolor="#FFFF99"> 
					<table width="100%" cellpadding="3" cellspacing="0">
					<? for ($z=0;$z<count($sub_cat_2);$z++) {?>
					<tr>
						<td width="10%" bgcolor="#CCFFFF"><input name="sub_cat_2[]" type="checkbox" value="<?=$sub_cat_2[$z]?>"></td>
						<td width="90%" bgcolor="#CCFFFF" nowrap><?=$sub_cat_2[$z]?></td>
					</tr>
					<? }?>
					</table>
				</td>
			</tr>
			<? }?>
			<? }?>
			</table>
		</td>
	</tr>
	<? }?>
	<? }?>
	</table>
</td></tr>
</table>
</form>
</body>
</html>
