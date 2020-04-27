<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");
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
	if (isset($Action) && $Action == "Update")
		$query = "SELECT * FROM LINK WHERE LINK_ID = $link_id";
	else
		$query = "SELECT * FROM LINK";	
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"LINK");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
	
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Links</title>
<meta http-equiv="Link-Type" Link="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editLink(id) {
	var url = "links.php?Action=Update&link_id=" + id;
	open(url,"_self");
}

function deleteLink(id) {
	var url = "links_result.php?Action=Delete&link_id=" + id;
	open(url,"_self");
}

function changeLinkType(form) {
	form.method = "POST";
	form.action = "links.php?Refresh=true<? if (isset($Action)) {?>&Action=<?=$Action?><? }?><? if (isset($link_id)) {?>&link_id=<?=$link_id?><? }?>";
	form.submit();
}

function uploadFile(form,file_type) {
	form.action = "file_upload.php?file_type=" + file_type + "&page=links";
	form.method = "POST";
	form.submit();
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";

	if (form.link_text.value == "") {
		is_valid = false;
		err_msg = err_msg + "Link Text is required\n";
	}
	
	if (form.link_url.value == "") {
		is_valid = false;
		err_msg = err_msg + "Link URL is required\n";
	}
	
	if (form.link_url.value.search("http") > -1 && form.link_target.value == "Self") {
		is_valid = false;
		err_msg = err_msg + "External link cannot be targeted to self\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong><a href="web_content.php">Manage 
  Web Contents</a> &gt; <font color="00AEEF">Manage Links</font></strong></font></p>
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#links','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>
  <? if (isset($Action)) {?>
</p>
<form action="links_result.php?" method="post" name="linkForm" id="linkForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update")
				$rs = mysql_fetch_row($query_result);?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
			<? if (isset($Refresh)) 
				eval("\$value = \"$" . $field_name[$i] . "\";");?>
			<? if ((!isset($link_type) || (isset($link_type) && $link_type == "Text")) && $field_name[$i] == "link_img_src") {?>
				<input name="<?=$field_name[$i]?>" type="hidden" value="">
			<? } else {?>
			<tr>
				<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=ucwords(str_replace("_"," ",$field_name[$i]))?>
        :</font></td>
				<td>
					<? if ($i == 1) {?>
					<select name="<?=$field_name[$i]?>" onChange="changeLinkType(this.form);">
					<option value="Text" <? if ((isset($link_type) && $link_type == "Text") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "Text")) {?>SELECTED<? }?>>Text</option>
					<option value="Image" <? if ((isset($link_type) && $link_type == "Image") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "Image")) {?>SELECTED<? }?>>Image</option>
					</select>
					<? } else if ($i == 5) {?>
					<select name="<?=$field_name[$i]?>">
					<option value="Top" <? if ((isset($link_position) && $link_position == "Top") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "Top")) {?>SELECTED<? }?>>Top</option>
					<option value="Bottom" <? if ((isset($link_position) && $link_position == "Bottom") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "Bottom")) {?>SELECTED<? } else if (!isset($Refresh) && !isset($Action) && !isset($link_position)) {?>SELECTED<? }?>>Bottom</option>
					</select>
					<? } else if ($i == 6) {?>
					<select name="<?=$field_name[$i]?>">
					<option value="Self" <? if ((isset($link_target) && $link_target == "Self") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "Self")) {?>SELECTED<? }?>>Self</option>
					<option value="Parent" <? if ((isset($link_target) && $link_target == "Parent") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "Parent")) {?>SELECTED<? }?>>Parent</option>
          <option value="New Window" <? if ((isset($link_target) && $link_target == "New Window") || (!isset($Refresh) && $Action == "Update" && $rs[$i] == "New Window")) {?>SELECTED<? }?>>New 
          Window</option>
					</select>
        	<? } else {?>
        	<input name="<?=$field_name[$i]?>" type="text" value="<? if (isset($Refresh)) {?><?=$value?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? } else if ($i == 3) {?>images/<? }?>" <? if ($i == 7) {?>size="1"<? }?>>
					<? if ($field_name[$i] == "link_img_src") {?>
					<input name="UploadImageButton" type="button" value="Upload Image" onClick="uploadFile(this.form,'image');">
					<i>(e.g. images/img.gif)</i>
					<? } else if ($field_name[$i] == "link_url") {?>
					<input name="UploadFileButton" type="button" value="Upload File" onClick="uploadFile(this.form,'link_file');">
					<i>(e.g. about_us.htm or http://www.mystore.com/about_us.htm)</i>
					<? }?>
					<? }?>
				</td>
				<? } else {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if (isset($Refresh)) {?><?=$value?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
				<? }?>
			</tr>
			<? }?>
			<? }?>
		</table>
		<p>&nbsp;</p>
			<p align="center"> 
			<input type="submit" name="Submit" value="<?=$Action?> Link" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><a href="links.php?Action=Create"><img src="../../images/add_new_link.gif" width="93" height="21" border="0"></a></td>
    <td>&nbsp;&nbsp;</td>
    <td><a href="categories.php"><img src="../../images/manage_categories.gif" width="128" height="21" border="0"></a></td>
  </tr>
</table>
<br>
<table border="0" align="center" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
			<? if ($i != 0) {?>
	    <th bgcolor="#999999"><font size="-1" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif">
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font></th>
			<? }?>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<? if ($i != 0) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<?=$rs[$i]?>
      </font> </td>
			<? }?>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editLink(<?=$rs[0]?>);"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteLink(<?=$rs[0]?>);"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td><a href="links.php?Action=Create"><img src="../../images/add_new_link.gif" width="93" height="21" border="0"></a></td>
      <td>&nbsp;&nbsp;</td>
      <td><a href="categories.php"><img src="../../images/manage_categories.gif" width="128" height="21" border="0"></a></td>
    </tr>
  </table>
  </center>
<p></p>
<? }?>
</body>
</html>
