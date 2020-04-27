<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "config.php";
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM BUILT_IN_WEB_CONTENT WHERE ID = $id";
else
	$query = "SELECT * FROM BUILT_IN_WEB_CONTENT ORDER BY component_name";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"BUILT_IN_WEB_CONTENT");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Built-in Web Content</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editWebContent(id) {
	var url = "manage_web_contents.php?Action=Update&id=" + id;
	open(url,"_self");
}

function deleteWebContent(id,comp_name) {
	var url = "manage_web_contents_result.php?Action=Delete&id=" + id + "&comp_name=" + comp_name;
	open(url,"_self");
}
</script>
</head>



<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
Built-in Components</strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_web_contents_result.php?" method="post" name="webContentForm" id="webContentForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update")
				$rs = mysql_fetch_row($query_result);?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
			<tr>
				<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>

				
      <td align="right" nowrap><b><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=str_replace("_"," ",$field_name[$i])?>
        :</font></b></td>

				<td>
					<? if ($field_name[$i] == "type") {?>
					<select name="<?=$field_name[$i]?>">
					<option value="Frame" <? if ($Action == "Update" && $rs[$i] == "Frame") {?>SELECTED<? }?>>Frame</option>
					<option value="No Frame" <? if ($Action == "Update" && $rs[$i] == "No Frame") {?>SELECTED<? }?>>No Frame</option>
					</select>
					<? } else if ($field_name[$i] == "position") {?>
					<select name="<?=$field_name[$i]?>">
					<option value="Top" <? if ($Action == "Update" && $rs[$i] == "Top") {?>SELECTED<? }?>>Top</option>
					<option value="Left" <? if ($Action == "Update" && $rs[$i] == "Left") {?>SELECTED<? }?>>Left</option>
					<option value="Center" <? if ($Action == "Update" && $rs[$i] == "Center") {?>SELECTED<? }?>>Center</option>
					<option value="Right" <? if ($Action == "Update" && $rs[$i] == "Right") {?>SELECTED<? }?>>Right</option>
					<option value="Bottom" <? if ($Action == "Update" && $rs[$i] == "Bottom") {?>SELECTED<? }?>>Bottom</option>
					</select>
					<? } else if ($field_name[$i] == "description") {?>
					<textarea name="<?=$field_name[$i]?>" cols="40" rows="5"></textarea>
        	<? } else {?>
			<? if ($field_name[$i] == "component_name" && $Action == "Update") {?>
			<input name="old_component_name" type="hidden" value="<?=$rs[$i]?>">
			<? }?>
        	<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>" <? if ($i == 6) {?>size="3"<? }?>>
					<? }?>
				</td>
				<? } else {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
				<? }?>
			</tr>
			<? }?>
		</table>
		<p>&nbsp;</p>

			
  <p> 
			<input type="submit" name="Submit" value="<?=$Action?> Web Content">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<p align="center">
<a href="manage_web_contents.php?Action=Create"><img src="../images/add_new_component.gif" width="137" height="21" border="0"></a>
&nbsp;
<a href="manage_component_design.php"><img src="../images/component_design.gif" alt="Component Design" width="137" height="21" border="0"></a>
&nbsp;
<a href="manage_component_properties.php"><img src="../images/component_properties.gif" alt="Component Properties" width="137" height="21" border="0"></a>
</p>

<p align="center">
<table border="0" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>

		<th bgcolor="#999999"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"><?=strtoupper($field_name[$i])?></font></th>

		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<? if ($field_name[$i] == "component_name") {?>
				<a href="manage_component_design.php?component_name=<?=$rs[$i]?>"?><?=$rs[$i]?></a>
				<? } else {?>
				<?=$rs[$i]?>
				<? }?>
				</font>
			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editWebContent(<?=$rs[0]?>);"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteWebContent(<?=$rs[0]?>,'<?=$rs[1]?>');"></td>
	</tr>
	<? }?>
</table>
<p align="center">
<a href="manage_web_contents.php?Action=Create"><img src="../images/add_new_component.gif" width="137" height="21" border="0"></a> 
&nbsp;
<a href="manage_component_design.php"><img src="../images/component_design.gif" alt="Component Design" width="137" height="21" border="0"></a>
&nbsp;
<a href="manage_component_properties.php"><img src="../images/component_properties.gif" alt="Component Properties" width="137" height="21" border="0"></a>
</p>
<? }?>
</body>
</html>
