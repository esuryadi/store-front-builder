<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
require_once("../../path_config.php");
define("_DB",$HTTP_SESSION_VARS["selected_db"]);
?>
<html>
<head>
<?php
if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	if (isset($Action) && $Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0))
		$query = "SELECT * FROM WEB_CONTENT WHERE WEB_CONTENT.ID = $id";
	else {
		$query = "SELECT * FROM WEB_CONTENT ORDER BY component_name, sequence, id ";	
	}
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"WEB_CONTENT");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$query2 = "SELECT categories_main FROM CATEGORIES GROUP BY categories_main ORDER BY categories_main";
	$query_result2 = mysql_query($query2);
	$categories = Array();
	while ($rs2 = mysql_fetch_row($query_result2))
		if (trim($rs2[0]) != "")
			$categories [] = $rs2[0];
			
	$query3 = "SELECT categories_sub_1 FROM CATEGORIES GROUP BY categories_sub_1 ORDER BY categories_sub_1";
	$query_result3 = mysql_query($query3);
	while ($rs3 = mysql_fetch_row($query_result3))
		if (trim($rs3[0]) != "")
			$categories [] = $rs3[0];
			
	$query4 = "SELECT categories_sub_2 FROM CATEGORIES GROUP BY categories_sub_2 ORDER BY categories_sub_2";
	$query_result4 = mysql_query($query4);
	while ($rs4 = mysql_fetch_row($query_result4))
		if (trim($rs4[0]) != "")
			$categories [] = $rs4[0];
			
	$query5 = "SELECT * FROM PRODUCT_GROUP ORDER BY group_name";
	$query_result5 = mysql_query($query5);
	while ($rs5 = mysql_fetch_row($query_result5))
		$product_group [] = $rs5[0];
	
	$query7 = "SELECT * FROM PROPERTY WHERE property_name = 'HomeRemoved'";
	$query_result7 = mysql_query($query7);
	$rs7 = mysql_fetch_row($query_result7);
	if (mysql_num_rows($query_result7) > 0)
		$HomeRemoved = $rs7[2];
	else
		$HomeRemoved = "no";
	
	if (!isset($cat) && $HomeRemoved == "no")
		$cat = 'Home';
	else if ((!isset($cat) || (isset($cat) && $cat == "Home")) && isset($categories[0]) && $categories[0] != "" && $HomeRemoved == "yes")
		$cat = $categories[0];
	
	$top_component_query = "SELECT WEB_CONTENT.id, WEB_CONTENT.component_name, WEB_CONTENT.title, admin.BUILT_IN_WEB_CONTENT.display_name FROM WEB_CONTENT LEFT JOIN admin.BUILT_IN_WEB_CONTENT ON WEB_CONTENT.component_name = admin.BUILT_IN_WEB_CONTENT.component_name WHERE WEB_CONTENT.position = 'Top' AND (WEB_CONTENT.category = 'All Category' OR WEB_CONTENT.category = '$cat') ORDER BY WEB_CONTENT.sequence";
	$top_component_query_result = mysql_query($top_component_query);
	
	$left_component_query = "SELECT WEB_CONTENT.id, WEB_CONTENT.component_name, WEB_CONTENT.title, admin.BUILT_IN_WEB_CONTENT.display_name FROM WEB_CONTENT LEFT JOIN admin.BUILT_IN_WEB_CONTENT ON WEB_CONTENT.component_name = admin.BUILT_IN_WEB_CONTENT.component_name WHERE WEB_CONTENT.position = 'Left' AND (WEB_CONTENT.category = 'All Category' OR WEB_CONTENT.category = '$cat') ORDER BY WEB_CONTENT.sequence";
	$left_component_query_result = mysql_query($left_component_query);
	
	$center_component_query = "SELECT WEB_CONTENT.id, WEB_CONTENT.component_name, WEB_CONTENT.title, admin.BUILT_IN_WEB_CONTENT.display_name FROM WEB_CONTENT LEFT JOIN admin.BUILT_IN_WEB_CONTENT ON WEB_CONTENT.component_name = admin.BUILT_IN_WEB_CONTENT.component_name WHERE WEB_CONTENT.position = 'Center' AND (WEB_CONTENT.category = 'All Category' OR WEB_CONTENT.category = '$cat') ORDER BY WEB_CONTENT.sequence";
	$center_component_query_result = mysql_query($center_component_query);
	
	$right_component_query = "SELECT WEB_CONTENT.id, WEB_CONTENT.component_name, WEB_CONTENT.title, admin.BUILT_IN_WEB_CONTENT.display_name FROM WEB_CONTENT LEFT JOIN admin.BUILT_IN_WEB_CONTENT ON WEB_CONTENT.component_name = admin.BUILT_IN_WEB_CONTENT.component_name WHERE WEB_CONTENT.position = 'Right' AND (WEB_CONTENT.category = 'All Category' OR WEB_CONTENT.category = '$cat') ORDER BY WEB_CONTENT.sequence";
	$right_component_query_result = mysql_query($right_component_query);
	
	$bottom_component_query = "SELECT WEB_CONTENT.id, WEB_CONTENT.component_name, WEB_CONTENT.title, admin.BUILT_IN_WEB_CONTENT.display_name FROM WEB_CONTENT LEFT JOIN admin.BUILT_IN_WEB_CONTENT ON WEB_CONTENT.component_name = admin.BUILT_IN_WEB_CONTENT.component_name WHERE WEB_CONTENT.position = 'Bottom' AND (WEB_CONTENT.category = 'All Category' OR WEB_CONTENT.category = '$cat') ORDER BY WEB_CONTENT.sequence";
	$bottom_component_query_result = mysql_query($bottom_component_query);
	
	$query6 = "SELECT id FROM WEB_CONTENT where category = 'All Category' OR category = '$cat' ORDER BY sequence LIMIT 1";	
	$query_result6 = mysql_query($query6);
	$rs = mysql_fetch_row($query_result6);
	$comp_id = $rs[0];
	
	$HTTP_SESSION_VARS["db_connect"]->close();
	
	$web_contents = WebContent::getBuiltInWebContent();
	
	if (isset($selected_index) && $selected_index > -1)
		$content = $web_contents[$selected_index];
	
	if (isset($Action) && $Action == "Update" && !isset($selected_index)) { 
		$rs = mysql_fetch_row($query_result);
		$comp_type = $rs[7];
		$design_style = WebContent::getDesignStyle($rs[1]);
		$component_properties = WebContent::getComponentProperties($rs[1]);
		$selected_component = $rs[1];
	} else if (isset($content)) {
		$design_style = WebContent::getDesignStyle($content["component_name"]);
		$component_properties = WebContent::getComponentProperties($content["component_name"]);
		$selected_component = $content["component_name"];
	}
		
	if (isset($design_style)) {
		if (isset($design_style_index)) {
			$dstyle = $design_style[$design_style_index];
			$preview_images = $dstyle["preview_images"];
		} else {
			if (isset($Action) && $Action == "Update" && !isset($selected_index)) {
				$preview_images = WebContent::getComponentStylePreviewImages($rs[1],$rs[9]);
			} else {
				$dstyle = $design_style[0];
				$preview_images = $dstyle["preview_images"];
			}
		}	
	}
	
	for ($i=1;$i<10;$i++)
		if (!isset($rs[$i]))
			$rs[$i] = null;
			
	if ((isset($content) && $content["component_name"] == "Product Group") || (isset($Action) && $Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[1] == "Product Group")) {
		if (!isset($selected_product_group)) {
			if (isset($Action) && $Action == "Update" || ($Action == "Update" && isset($Mode) && $Mode != "wizard"))
				$selected_product_group = $rs[2];
			else
				$selected_product_group = (isset($product_group[0]))?$product_group[0]:"";
		} else
			$selected_product_group = stripslashes($selected_product_group);
	} 
}
?>
<title>Create Web Content</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editWebContent(id) {
	var url = "web_content.php?Action=Update&cat=<?=urlencode($cat)?>&id=" + id;
	open(url,"_parent");
}

function deleteComponent() {
	document.deleteComponentForm.submit();
}

function setBuiltInWebContent(form) {
	<? if (isset($Mode) && $Mode == "wizard" && $Action == "Update") {?>
	form.action = "web_content.php?id=" + form.id.value;
	<? } else {?>
	form.action = "web_content.php?id=" + form.id.value + "&selected_index=" + (form.selected_web_content.selectedIndex - 1);
	<? }?>
	form.method = "POST";
	form.submit();
}

function refreshWebContent() {
	<? if (isset($Mode) && $Mode == "wizard" && $Action == "Update") {?>
	document.webContentForm.action = "web_content.php?id=" + document.webContentForm.id.value;
	<? } else {?>
	document.webContentForm.action = "web_content.php?id=" + document.webContentForm.id.value + "&selected_index=" + (document.webContentForm.selected_web_content.selectedIndex - 1);
	<? }?>
	document.webContentForm.method = "POST";
	document.webContentForm.submit();
}

function changeDesignStyle(form) {
	form.action = "web_content.php?Refresh=true&id=" + form.id.value + "&design_style_index=" + form.style.selectedIndex + "<? if (isset($selected_index)) {?>&selected_index=<?=$selected_index?><? }?>";
	form.method = "POST";
	form.submit();
}

function uploadFile(form) {
	form.action = "file_upload.php?file_type=file&page=web_content<? if (isset($selected_index)) {?>&selected_index=<?=$selected_index?><? }?>";
	form.method = "POST";
	form.submit();
}

function changeCategory(category) {
	var url = "web_content.php?cat=" + category;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.component_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Component Name is required\n";
	}
	<? if ((isset($content) && $content["component_name"] == "Product Group") || (isset($Action) && $Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[1] == "Product Group")) {?>
	if (form.selected_product_group.value == "") {
		is_valid = false;
		err_msg = err_msg + "Please select product group\n";
	}
	<? }?>
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}

function updateProperties() {
	window.open("wizard.php?step=4","_parent");
}
</script>
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body vlink="00aeef">
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td>
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
  Store Components</strong></font> </p>
</td><td align="right">
<? if (isset($Action) && !isset($MainCat)) {?>
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#web_contents','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
<? }?>
</td></tr>
</table>
<? if (isset($Action) && $Action != "edit_page" && $Action != "create_page") {?>
</p>
<form action="web_content_result.php" method="post" name="webContentForm" id="webContentForm">
	<input type="hidden" name="Mode" value="<? if (isset($Mode)) {?><?=$Mode?><? }?>">
	<input type="hidden" name="cat" value="<?=$cat?>">
	<input type="hidden" name="Action" value="<?=$Action?>">
	<? if (isset($Mode) && $Mode == "wizard") {?>
	<input type="hidden" name="page_name" value="<? if ($Action == "Update") {?><?=$rs[8]?><? } else {?><?=$page_name?><? }?>">
	<input type="hidden" name="page_layout" value="<?=$page_layout?>">
	<input type="hidden" name="page_category" value="<?=$page_category?>">
	<input type="hidden" name="main_category" value="<?=$main_category?>">
	<? }?>
	<table cellpadding="5" cellspacing="5">
			<tr>
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Built-in 
        Components:</font>
			</td>
      <td> 
				<? if (isset($Mode) && $Mode == "wizard" && $Action == "Update") {?>
				<input type="hidden" name="selected_web_content" value="<?=$rs[1]?>">
				<strong><?=$rs[1]?></strong>
				<? } else {?>
				<select name="selected_web_content" onChange="setBuiltInWebContent(this.form);">
					<option value="">Import External Component</option>
					<? for($i=0;$i<count($web_contents);$i++) {
						$web_content = $web_contents[$i];?>
					<option value="<?=$web_content["component_name"]?>" <? if (isset($content) && $content["component_name"] == $web_content["component_name"]) {?>selected<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[1] == $web_content["component_name"]) {?>SELECTED<? }?>>
          <?=$web_content["display_name"]?>
          </option>
					<? }?>
        </select> 
				<? }?>
				<? if (isset($component_properties) && count($component_properties) > 0) {?>
				&nbsp;&nbsp;&nbsp;<input name="properties" type="button" value="Component Settings" onClick="window.open('component_properties_frame.php?Action=<?=$Action?>&selected_component=<?=$selected_component?><? if (isset($Action) && $Action == "Update") {?>&id=<?=$id?><? }?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">				<? }?>
				<? if (($Action == "Update" && ($rs[1] == "All Products" || $rs[1] == "New Items" || $rs[1] == "Used Items" || $rs[1] == "Refurbished Items" || $rs[1] == "Product Group")) || (isset($selected_component) && ($selected_component == "All Products" || $selected_component == "New Items" || $selected_component == "Used Items" || $selected_component == "Refurbished Items" || $selected_component == "Product Group"))) {?>
				&nbsp;&nbsp;&nbsp;
				<input name="addProductButton" type="button" value="Add New Product" onClick="window.open('product.php?Action=Add<? if (isset($Mode) && $Mode == "wizard") {?>&Mode=wizard&page_name=<? if ($Action == "Update") {?><?=urlencode($rs[8])?><? } else {?><?=urlencode($page_name)?><? }?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<? if ($Action == "Update") {?><?=$rs[1]?><? } else{?><?=$selected_component?><? }?><? }?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">				<? }?>
			</td>
			</tr>
			<? if ((isset($content) && $content["component_name"] == "Product Group") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[1] == "Product Group")) {?>
			<tr>
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Group:</font>
			</td>
      <td> 
				<select name="selected_product_group" onChange="setBuiltInWebContent(this.form);">
					<? if (count($product_group) == 0) {?>
					<option value="">No Product Group Available</option>
					<? } else {?>
					<option value="">- Select Product Group -</option>
					<? }?>
					<? for($i=0;$i<count($product_group);$i++) {?>
					<option value="<?=$product_group[$i]?>" <? if ($product_group[$i] == $selected_product_group) {?>selected<? }?>>
          <?=$product_group[$i]?>
          </option>
					<? }?>
        </select> 
				&nbsp;&nbsp;&nbsp;<input name="addProductGroupButton" type="button" value="Create Product Group" onClick="window.open('product_group.php?Mode=wizard','product_group','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">				</td>
			</tr>
			<? }?>
			<? for($i=0;$i<count($field_name);$i++) {
				if (isset($Refresh) && $Refresh == "true")
					eval("\$field_value = \$" . $field_name[$i] . ";");?>			
			<tr>
				<? if ((isset($content) && $field_name[$i] == "filename") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $field_name[$i] == "filename" && $comp_type == "built-in")) {?>
					<input name="<?=$field_name[$i]?>" type="hidden" value="<? if (isset($content)) {?><?=$content[$field_name[$i]]?><? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0)) {?><?=$rs[$i]?><? }?>">
				<? } else if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      	<td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<? if ($field_name[$i] != "style" || (isset($content) && $field_name[$i] == "style") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $field_name[$i] == "style" && $comp_type == "built-in")) {?>
				<?=ucwords(str_replace("_"," ",$field_name[$i]))?>:</font>
				<? }?>
			  </td>
			  <td>
					<? if ($field_name[$i] == "style") {?>
						<? if (isset($content) || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $comp_type == "built-in")) {?>
							<select name="<?=$field_name[$i]?>" onChange="changeDesignStyle(this.form);">
							<? for($n=0;$n<count($design_style);$n++) {
								$dstyle = $design_style[$n];?>
							<option value="<?=$dstyle["design_style"]?>" <? if (isset($Refresh) && $Refresh == "true" && $field_value == $dstyle["design_style"]) {?>selected<? } else if ($Action == "Update" && !isset($Refresh) && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == $dstyle["design_style"]) {?>selected<? }?>>
							<?=$dstyle["design_style"]?>
							</option>
							<? }?>
							</select>
						<? } else {?>
							<input type="hidden" name="<?=$field_name[$i]?>" value="">
						<? }?>						 
					<? } else if ((isset($content) && $field_name[$i] == "component_name") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $field_name[$i] == "component_name" && $comp_type == "built-in")) {?>
						<? if (isset($content)) {?><?=$content[$field_name[$i]]?><? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0)) {?><?=$rs[$i]?><? }?>
						<input name="<?=$field_name[$i]?>" type="hidden" value="<? if (isset($content)) {?><?=$content[$field_name[$i]]?><? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0)) {?><?=$rs[$i]?><? }?>">
					<? } else if ($field_name[$i] == "title" && ((isset($content) && $content["component_name"] == "Product Group") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[1] == "Product Group"))) {?>
						<input name="<?=$field_name[$i]?>" type="hidden" value="<?=$selected_product_group?>">
						<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$selected_product_group?></font>
					<? } else if ($field_name[$i] == "type") {?>
					<select name="<?=$field_name[$i]?>">
					<option value="Frame" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Frame") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "Frame") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Frame") {?>SELECTED<? }?>>Frame</option>
          <option value="No Frame" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "No Frame") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "No Frame") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "No Frame") {?>SELECTED<? }?>>No 
          Frame</option>
					</select>
					<? } else if ($field_name[$i] == "position") {?>
					<? if (isset($Mode) && $Mode == "wizard") {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Create") {?><?=$position?><? } else {?><?=$rs[$i]?><? }?>">
					<? if ($Action == "Create") {?><?=$position?><? } else {?><?=$rs[$i]?><? }?>
					<? } else {?>
					<select name="<?=$field_name[$i]?>">
					<option value="Top" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Top") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "Top") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Top") {?>SELECTED<? }?>>Top</option>
					<option value="Bottom" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Bottom") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "Bottom") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Bottom") {?>SELECTED<? }?>>Bottom</option>
					<option value="Left" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Left") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "Left") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Left") {?>SELECTED<? }?>>Left</option>
					<option value="Center" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Center") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "Center") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Center") {?>SELECTED<? }?>>Center</option>
					<option value="Right" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Right") {?>SELECTED<? } else if (!isset($Refresh) && isset($content) && $content[$field_name[$i]] == "Right") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Right") {?>SELECTED<? }?>>Right</option>
					</select>
					<? }?>
					<? } else if ($field_name[$i] == "component_type") {?>
						<? if (isset($content) || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $comp_type == "built-in")) {?>
							built-in
							<input name="<?=$field_name[$i]?>" type="hidden" value="built-in">
						<? } else {?>
							custom
							<input name="<?=$field_name[$i]?>" type="hidden" value="custom">
						<? }?>
					<? } else if ($field_name[$i] == "category") {?>
						<? if (isset($Mode) && $Mode == "wizard") {?>
							<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Create") {?><?=urldecode($page_name)?><? } else {?><?=$rs[$i]?><? }?>">
							<? if ($Action == "Create") {?><?=urldecode($page_name)?><? } else {?><?=$rs[$i]?><? }?>
						<? } else {?>
							<select name="<?=$field_name[$i]?>">
							<option value="All Category" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "All Category") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "All Category") {?>SELECTED<? }?>>All Category</option>
							<option value="Home" <? if (isset($Refresh) && $Refresh == "true" && $field_value == "Home") {?>SELECTED<? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[$i] == "Home") {?>SELECTED<? }?>>Home</option>
							<? for($n=0;$n<count($categories);$n++) {?>
							<option value="<?=$categories[$n]?>" <? if (isset($Refresh) && $Refresh == "true" && $field_value == $categories[$n]) {?>SELECTED<? } else if ($Action == "Update"  && (!isset($selected_index) || isset($selected_index) && $selected_index >0)&& $rs[$i] == $categories[$n]) {?>SELECTED<? }?>><?=$categories[$n]?></option>
							<? }?>
							</select>
						<? }?>
			<? } else if (isset($Mode) && $Mode == "wizard" && $Action == "Update" && $field_name[$i] == "sequence") {?>
        	<input type="hidden" name="<?=$field_name[$i]?>" value="<?=$rs[$i]?>"><?=$rs[$i]?>
			<? } else {?>
        	<input name="<?=$field_name[$i]?>" type="text" value="<? if (isset($Refresh) && $Refresh == "true") {?><?=$field_value?><? } else if (isset($content)) {?><?=$content[$field_name[$i]]?><? } else if ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0)) {?><?=$rs[$i]?><? }?>" <? if ($i == 6) {?>size="1"<? }?>>
        <? }?>
        <? if ($field_name[$i] == "title" && !((isset($content) && $content["component_name"] == "Product Group") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $rs[1] == "Product Group"))) {?>
        <i><font size="-1">(e.g. Feature Products)</font></i> 
        <? } else if ($field_name[$i] == "filename") {?>
				<input name="UploadButton" type="button" value="Upload Files" onClick="uploadFile(this.form);">
        <i><font size="-1">(e.g. sponsor.htm) -> html or text file only! Do not upload image file such as .jpg or .gif. Use the image component if you want to put an image. </font></i><? } else if ($field_name[$i] == "sequence" && !isset($Mode)) {?>
        <font size="-1"><i>(e.g. 1)</i></font> 
        <? }?>
      </td>
				<? } else {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update" && $id == "") {?><?=$rs[$i]?><? } else if ($Action == "Update" && $id != "") {?><?=$id?><? }?>">
				<? }?>
			</tr>
			<? if ((isset($content) && $field_name[$i] == "style") || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && $field_name[$i] == "style" && $comp_type == "built-in")) {?>
			<tr>
				<td align="center" colspan="2">
					<img src="<?=_URLPATH?>/components/images/<?=$preview_images?>">
				</td>
			</tr>
			<? }?>
			<? if (isset($Refresh)) session_unregister($field_name[$i]);?>
			<? }?>
			<? if ((isset($content) && ($content["component_name"] == "Product Group" || $content["component_name"] == "All Products" || $content["component_name"] == "New Items" || $content["component_name"] == "Used Items" || $content["component_name"] == "Refurbished Items")) || ($Action == "Update" && (!isset($selected_index) || isset($selected_index) && $selected_index >0) && ($rs[1] == "Product Group" || $rs[1] == "All Products" || $rs[1] == "New Items" || $rs[1] == "Used Items" || $rs[1] == "Refurbished Items"))) {?>
			<? if ($Action == "Update" && !isset($Refresh))
				$style = $rs[9]; 
			if (isset($style) && ($style != "Images List" && $style != "Plain List" && $style != "Express Check-Out")) {?>
			<tr>
				<td>Number of column displayed:</td>
				<td>
					<?php 
					if ($Action == "Create" || (isset($Refresh) && $Refresh == "true") || ($Action == "Update" && WebContent::getPropertyValue("num_col_" . $id) == "")) {
						if (isset($style) && $style == "Table Images")
							$num_col = 3;
						else if (isset($style) && $style == "Headlines")
							$num_col = 1;
						else if (isset($style) && $style == "Headlines 2")
							$num_col = 3;
						else if (isset($style) && $style == "Table Images 2")
							$num_col = 2;
						else if (isset($style) && $style == "Table Images 3")
							$num_col = 2;
						else
							$num_col = 1;						
					} else {
						$num_col = WebContent::getPropertyValue("num_col_" . $id);
					}?>
					<input type="text" name="num_col" value="<?=$num_col?>" size="1">
				</td>
			</tr>
			<? }?>
			<tr>
				<td>Number of items displayed:</td>
				<td>
					<?php 
					if ($Action == "Create" || (isset($Refresh) && $Refresh == "true") || ($Action == "Update" && WebContent::getPropertyValue("show_items_" . $id) == "")) {
						if ($Action == "Update" && !isset($Refresh))
							$style = $rs[9];
						if (isset($style) && $style == "Table Images")
							$num_items = 12;
						else if (isset($style) && $style == "Plain List")
							$num_items = 15;
						else if (isset($style) && $style == "Images List")
							$num_items = 7;
						else if (isset($style) && $style == "Headlines")
							$num_items = 1;
						else if (isset($style) && $style == "Headlines 2")
							$num_items = 6;
						else if (isset($style) && $style == "Table Images 2")
							$num_items = 10;
						else if (isset($style) && $style == "Table Images 3")
							$num_items = 8;
						else if (isset($style) && $style == "Express Check-Out")
							$num_items = 15;
						else
							$num_items = 1;						
					} else {
						$num_items = WebContent::getPropertyValue("show_items_" . $id);
					}?>
					<input type="text" name="show_items" value="<?=$num_items?>" size="1">
				</td>
			</tr>
			<? }?>
	</table>
  <p align="center"> 			
    <input type="submit" name="Submit" value="<?=$Action?> Component" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
			<? if (isset($Mode) && $Mode == "wizard") {?>
      <input type="button" name="Submit2" value="Close Window" onClick="window.close();">
			<? }?>
</p>
</form>
<script language="JavaScript">
<!--
<? if (isset($Mode) && $Mode == "wizard" && isset($Action) && $Action == "Create") {?>
open("wizard_step_3.php?Action=<?=$Action?>&page_layout=<?=$page_layout?>&position=<?=$position?>&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>","wizard_contents");
<? }?>
-->
</script>
<? } else {?>
<p>
<strong>Please choose page/category:</strong> 
<select name="cat" onChange="changeCategory(this.value);">
<? if ($HomeRemoved == "no") {?>
<option value="Home" <? if ((isset($cat) && $cat == "Home") || !isset($cat)) {?>selected<? }?>>Home</option>
<? }?>
<? for($n=0;$n<count($categories);$n++) {?>
<option value="<?=urlencode($categories[$n])?>" <? if (isset($cat) && $cat == $categories[$n]) {?>selected<? }?>><?=urldecode($categories[$n])?></option>
<? }?>
</select>
</p>
<form name="deleteComponentForm" action="web_content_result.php" target="_parent">
<input name="Action" type="hidden" value="Delete">
<input name="cat" type="hidden" value="<?=$cat?>">
<table width="100%">
<tr><td colspan="3">
	<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#CCCCFF">
	<tr><th bgcolor="#999999" colspan="3"><font color="#FFFFFF" size="-1">Top Components</font></th></tr>
	<? for($n=0;$rs=mysql_fetch_row($top_component_query_result);$n++) {?>
	<tr>
	<td width="5%"><input type="checkbox" name="id[]" value="<?=$rs[0]?>"></td>
	<td width="90%" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><a href="web_content_info.php?id=<?=$rs[0]?>" target="rightFrame"><? if ($rs[3] != "") {?><?=$rs[3]?><? } else {?><?=$rs[1]?><? }?></a> <? if ($rs[2] !== "") {?>(<?=$rs[2]?>)<? }?></td>
	<td width="5%"><input name="Update" type="button" id="Update" value="Edit" onClick="editWebContent(<?=$rs[0]?>);"></td>
	</tr>
	<? }?>
	</table>
</td></tr>
<tr>
	<td width="33%" valign="top">
		<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#CCCCFF">
		<tr><th bgcolor="#999999" colspan="3"><font color="#FFFFFF" size="-1">Left Components</font></th></tr>	
		<? for($n=0;$rs=mysql_fetch_row($left_component_query_result);$n++) {?>
		<tr>
		<td><input type="checkbox" name="id[]" value="<?=$rs[0]?>"></td>
		<td bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><a href="web_content_info.php?id=<?=$rs[0]?>" target="rightFrame"><? if ($rs[3] != "") {?><?=$rs[3]?><? } else {?><?=$rs[1]?><? }?></a> <? if ($rs[2] !== "") {?>(<?=$rs[2]?>)<? }?></td>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editWebContent(<?=$rs[0]?>);"></td>
		</tr>
		<? }?>
		</table>
	</td>
	<td width="34%" valign="top">
		<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#CCCCFF">
		<tr><th bgcolor="#999999" colspan="3"><font color="#FFFFFF" size="-1">Middle Components</font></th></tr>
		<? for($n=0;$rs=mysql_fetch_row($center_component_query_result);$n++) {?>
		<tr>
		<td><input type="checkbox" name="id[]" value="<?=$rs[0]?>"></td>
		<td bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><a href="web_content_info.php?id=<?=$rs[0]?>" target="rightFrame"><? if ($rs[3] != "") {?><?=$rs[3]?><? } else {?><?=$rs[1]?><? }?></a> <? if ($rs[2] !== "") {?>(<?=$rs[2]?>)<? }?></td>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editWebContent(<?=$rs[0]?>);"></td>
		</tr>
		<? }?>
		</table>
	</td>
	<td width="33%" valign="top">
		<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#CCCCFF">
		<tr><th bgcolor="#999999" colspan="3"><font color="#FFFFFF" size="-1">Right Components</font></th></tr>
		<? for($n=0;$rs=mysql_fetch_row($right_component_query_result);$n++) {?>
		<tr>
		<td><input type="checkbox" name="id[]" value="<?=$rs[0]?>"></td>
		<td bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><a href="web_content_info.php?id=<?=$rs[0]?>" target="rightFrame"><? if ($rs[3] != "") {?><?=$rs[3]?><? } else {?><?=$rs[1]?><? }?></a> <? if ($rs[2] !== "") {?>(<?=$rs[2]?>)<? }?></td>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editWebContent(<?=$rs[0]?>);"></td>
		</tr>
		<? }?>	
		</table>
	</td>
</tr>
<tr><td colspan="3">
	<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#CCCCFF">
	<tr><th bgcolor="#999999" colspan="3"><font color="#FFFFFF" size="-1">Bottom Components</font></th></tr>
	<? for($n=0;$rs=mysql_fetch_row($bottom_component_query_result);$n++) {?>
	<tr>
	<td width="5%"><input type="checkbox" name="id[]" value="<?=$rs[0]?>"></td>
	<td width="90%" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><a href="web_content_info.php?id=<?=$rs[0]?>" target="rightFrame"><? if ($rs[3] != "") {?><?=$rs[3]?><? } else {?><?=$rs[1]?><? }?></a> <? if ($rs[2] !== "") {?>(<?=$rs[2]?>)<? }?></td>
	<td width="5%"><input name="Update" type="button" id="Update" value="Edit" onClick="editWebContent(<?=$rs[0]?>);"></td>
	</tr>
	<? }?>
	</table>
</td></tr>
</table>
</form>
<script language="JavaScript">
<!--
open("web_content_info.php?id=<?=$comp_id?>","rightFrame");
open("web_content_button.php?cat=<?=urlencode($cat)?>","buttonFrame");
-->
</script>
<br>
<? }?>
</body>
</html>
