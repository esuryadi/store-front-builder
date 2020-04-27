<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
require_once("../../path_config.php");
include "../ewebwp/ewebwp.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	define("_DB",$HTTP_SESSION_VARS["selected_db"]);
	
	if (isset($HTTP_SESSION_VARS["wizard_mode"]) && $HTTP_SESSION_VARS["wizard_mode"] == "beginner") {
		if ($Action == "create_page")
			$Action = "Create";
		if (isset($PageType) && $PageType == "blank_page")
			$selected_component = "Blank Page";
		else if (isset($PageType) && $PageType == "about")
			$selected_component = "About Us";
		else if (isset($PageType) && $PageType == "contact")
			$selected_component = "Contact Form";
		else if (isset($PageType) && $PageType == "welcome")
			$selected_component = "Welcome";
		if (isset($PageID))
			$id = $PageID;
		if (isset($selected_component))
			$filename = "component_properties.php?Action=$Action&selected_component=$selected_component&";
		else
			$filename = "wizard_beginner_step_3.php?Action=$Action&MainCat=$MainCat&SubCat=$SubCat&PageType=$PageType&PageID=$PageID&";
	}
	$component_properties = WebContent::getComponentProperties($selected_component);
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "select MAX(id) from WEB_CONTENT";
	$rs = mysql_fetch_row(mysql_query($query));
	if ($Action == "Create") {
		if (isset($PageType))
			$id = $rs[0];
		else
			$id = $rs[0] + 1;
	}
	
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<html>
<head>
<title><?=$selected_component?> Properties</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function addValue(form,name,type) {
	var fieldname1 = name + "_text";
	var fieldname2 = name + "_list";
	if (type == "image_list") {
		form[fieldname2].options[form[fieldname2].length] = new Option(form[fieldname1].value.substr(form[fieldname1].value.lastIndexOf("\\")+1));
		if (form[name].value == "")
			form[name].value = form[fieldname1].value.substr(form[fieldname1].value.lastIndexOf("\\")+1);
		else
			form[name].value = form[name].value + ";" + form[fieldname1].value.substr(form[fieldname1].value.lastIndexOf("\\")+1);
		form[name + "_dest"].value = form[fieldname1].value.substr(form[fieldname1].value.lastIndexOf("\\")+1);
		form.action = "update_component_properties.php?subaction=upload_image";
		form.method = "POST";
		form.submit();
	} else {
		form[fieldname2].options[form[fieldname2].length] = new Option(form[fieldname1].value);
		if (form[name].value == "")
			form[name].value = form[fieldname1].value;
		else
			form[name].value = form[name].value + ";" + form[fieldname1].value;
	}
}

function deleteValue(form,name) {
	var fieldname1 = name + "_text";
	var fieldname2 = name + "_list";
	form[fieldname2].options[form[fieldname2].selectedIndex] = null;
	form[name].value = "";
	for(i=0;i<form[fieldname2].length;i++) {
		if (i == 0)
			form[name].value = form[fieldname2].options[i].value;
		else
			form[name].value = form[name].value + ";" + form[fieldname2].options[i].value;
	}
}

function uploadImage(form,name) {
	form.submit();
	var url = "file_upload.php?file_type=image&page=component_properties&id=<?=$id?>&selected_component=<?=urlencode($selected_component)?>&fieldname=" + name;
	open(url,"_self");
}

function updateProperties() {
	document.componentPropertiesForm.submit();
}

function clearForm() {
	document.componentPropertiesForm.reset();
}

</script>
</head>

<body>
<form name="componentPropertiesForm" enctype="multipart/form-data" method="post" action="update_component_properties.php">
<input TYPE="hidden" name="MAX_FILE_SIZE" value="800000">
  <? if (isset($HTTP_SESSION_VARS["wizard_mode"]) && $HTTP_SESSION_VARS["wizard_mode"] == "beginner") {?>
	<input type="hidden" name="PageType" value="<? if (isset($PageType)) {?><?=$PageType?><? }?>">
	<input type="hidden" name="PageID" value="<? if (isset($PageID)) {?><?=$PageID?><? }?>">
	<? }?>
	<input type="hidden" name="selected_component" value="<?=$selected_component?>">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="Action" value="<?=$Action?>">
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
    <tr> 
    <td width="5%" bgcolor="#CCCCCC" nowrap> 
      <div align="center"><strong>Property<br>Name</strong></div></td>
    <td width="*" bgcolor="#CCCCCC"> 
      <div align="center"><strong>Property Value</strong></div></td>
    <td width="30%" bgcolor="#CCCCCC"><div align="center"><strong>Description</strong></div></td>
  </tr>
	<? for ($i=0;$i<count($component_properties);$i++) {
		$prop = $component_properties[$i];
		$value = WebContent::getPropertyValue(str_replace(" ","_",strtolower($selected_component)) . $id . "_" . $prop["name"]);?>
  <tr bgcolor="<? if (($i%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"> 
      <td valign="top" nowrap> 
        <?=ucwords(str_replace("_"," ",$prop["name"]))?>
      </td>
      <td valign="top">
      <? if ($prop["type"] == "textfield") {?>
        <input name="<?=$prop["name"]?>" type="text" value="<? if ($value != "") {?><?=$value?><? } else {?><?=$prop["default_value"]?><? }?>" size="<? if (isset($PageType)) {?>50<? } else {?>27<? }?>">
			<? } else if ($prop["type"] == "textarea") {?>
				<? //if ((isset($use_html_editor) && $use_html_editor == "No") || (isset($selected_component) && $selected_component != "Blank Page")) {?>
					<? //if (isset($selected_component) && $selected_component == "Blank Page") {?>
					<!-- a href="<?=$filename?>use_html_editor=Yes">Use HTML Editor</a><br -->
					<? //}?>
					<textarea name="<?=$prop["name"]?>" cols="<? if (isset($PageType) && $PageType == "blank_page") {?>75<? } else if (isset($selected_component) && $selected_component == "Blank Page") {?>55<? } else {?>55<? }?>" rows="<? if (isset($PageType) && $PageType == "blank_page") {?>18<? } else if (isset($selected_component) && $selected_component == "Blank Page") {?>26<? } else {?>10<? }?>"><? if ($value != "") {?><?=$value?><? } else {?><?=$prop["default_value"]?><? }?></textarea><br>
					<script language="JavaScript">
					eWebWP.createButton("btnTest","<?=$prop["name"]?>");
					</script> --> Click this button to launch HTML Editor
				<? //} else {?>
					<!-- a href="<?=$filename?>use_html_editor=No">Use Regular Text Area</a> <font size="-1">(Click Update Properties button instead of the Save button.)</font><br -->
					<? //echo eWebWPEditor($prop["name"],"475","350",$value);?>
				<? //}?>
			<? } else if ($prop["type"] == "imagefield") {?>
				<input type="text" name="<?=$prop["name"]?>" value="<? if (isset($fieldname) && $prop["name"] == $fieldname && isset($img_src)) {?><?=$img_src?><? } else if ($value != "") {?><?=$value?><? } else {?><?=$prop["default_value"]?><? }?>" <? if (isset($PageType)) {?>size="50"<? }?>>
		    <input name="UploadButton" type="button" value="Upload Image" onClick="uploadImage(this.form,'<?=$prop["name"]?>');">
			<? } else if ($prop["type"] == "list") {?>
			<input type="hidden" name="<?=$prop["name"]?>" value="<? if ($value != "") {?><?=$value?><? } else {?><?=$prop["default_value"]?><? }?>">
			<input type="text" name="<?=$prop["name"]?>_text" value="">&nbsp;<input type="button" name="addButton" value="Add" onClick="addValue(this.form,'<?=$prop["name"]?>','list');"><p>
			<select name="<?=$prop["name"]?>_list" size="5">
			<? if ($value != "" || $prop["default_value"] != "") {
				$values = ($value != "")?$value:$prop["default_value"];
				$options = explode(";",$values);?>
				<? for($n=0;$n<count($options);$n++) {?>
				<option value="<?=$options[$n]?>"><?=$options[$n]?></option>
				<? }?>			
			<? }?>
      </select>
			<input type="button" name="delButton" value="Delete" onClick="deleteValue(this.form,'<?=$prop["name"]?>');">
			<? } else if ($prop["type"] == "image_list") {?>
			<input type="hidden" name="<?=$prop["name"]?>" value="<? if ($value != "") {?><?=$value?><? } else {?><?=$prop["default_value"]?><? }?>">
			<input type="hidden" name="<?=$prop["name"]?>_dest" value="">
			<input type="file" name="<?=$prop["name"]?>_text" value="" <? if (eregi("msie",$_SERVER['HTTP_USER_AGENT'])) {?>onChange="addValue(this.form,'<?=$prop["name"]?>','image_list');"<? } else {?>onClick="addValue(this.form,'<?=$prop["name"]?>','image_list');"<? }?>><p>
			<select name="<?=$prop["name"]?>_list" size="5">
			<? if ($value != "" || $prop["default_value"] != "") {
				$values = ($value != "")?$value:$prop["default_value"];
				$options = explode(";",$values);?>
				<? for($n=0;$n<count($options);$n++) {?>
				<option value="<?=$options[$n]?>"><?=$options[$n]?></option>
				<? }?>			
			<? }?>
      </select>
			<input type="button" name="delButton" value="Delete" onClick="deleteValue(this.form,'<?=$prop["name"]?>');">
			<? } else if ($prop["type"] == "choice") {
				$options = explode(",",$prop["option_values"]);?>
			<select name="<?=$prop["name"]?>">
			<? for ($n=0;$n<count($options);$n++) {?>
			<option value="<?=$options[$n]?>" <? if ($value == $options[$n] || ($value == "" && $prop["default_value"] == $options[$n])) {?>selected<? }?>><?=$options[$n]?></option>
			<? }?>
			</select>
          <? }?>
      </td>
      <td valign="top">
				<?=$prop["description"]?>
      </td>
  </tr>
	<? }?>
</table>
</form>
</body>
</html>
