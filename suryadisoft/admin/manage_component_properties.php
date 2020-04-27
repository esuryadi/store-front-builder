<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

$query = "SELECT component_name FROM BUILT_IN_WEB_CONTENT ORDER BY component_name";
$query_result2 = mysql_query($query);
while($rs = mysql_fetch_row($query_result2)) {
	$component_names[] = $rs[0];
}

if (!isset($component_name))
	$component_name = $component_names[0];

if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM COMPONENT_PROPERTIES WHERE component_name = '$component_name' AND property_name = '$property_name'";
else
	$query = "SELECT * FROM COMPONENT_PROPERTIES WHERE component_name = '$component_name' ORDER BY property_name";
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"COMPONENT_PROPERTIES");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Component Design</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editComponentProperties(component_name,property_name) {
	var url = "manage_component_properties.php?Action=Update&component_name=" + component_name + "&property_name=" + property_name;
	open(url,"_self");
}

function deleteComponentProperties(component_name,property_name) {
	var url = "manage_component_properties_result.php?Action=Delete&component_name=" + component_name + "&property_name=" + property_name;
	open(url,"_self");
}

function changeComponent(component_name) {
	var url = "manage_component_properties.php?component_name=" + component_name;
	open(url,"_self");
}
</script>
</head>
<body vlink="00aeef">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="manage_web_contents.php">Manage 
Built-in Components</a><strong> &gt; <font color="00aeef">Component Properties</font></strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_component_properties_result.php" method="post" name="ComponentPropertiesForm" id="ComponentDesignForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_property_name" value="<?=$rs[1]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<tr>
					<? if (stristr(mysql_field_flags($query_result,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=ucwords(str_replace("_"," ",$field_name[$i]))?>:</font></td>
					<td>
						<? if ($field_name[$i] == "component_name") {?>
							<? if ($Action == "Add") {?><?=$component_name?><? } else {?><?=$rs[$i]?><? }?>
							<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Add") {?><?=$component_name?><? } else {?><?=$rs[$i]?><? }?>">
						<? } else if ($field_name[$i] == "property_description" || $field_name[$i] == "property_default_value") {?>
						<textarea name="<?=$field_name[$i]?>" cols="40" rows="5"><? if ($Action == "Update") {?><?=$rs[$i]?><? }?></textarea>
						<? } else {?>
						<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
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
    <input type="submit" name="Submit" value="<?=$Action?> Component Properties">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
</font>

<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_component_properties.php?Action=Add&component_name=<?=$component_name?>"><img src="../images/new_component_properties.gif" alt="New Component Properties" width="154" height="21" border="0"></a></td>
    	<td>&nbsp;</td>
			<td><a href="manage_component_design.php"><img src="../images/component_design.gif" alt="Component Design" width="137" height="21" border="0"></a></td>
		</tr>
  </table>
  <p align="left"><b>Components:</b> 
    <select name="component_name" onChange="changeComponent(this.value);">
			<? for($i=0;$i<count($component_names);$i++) {?>
			<option value="<?=$component_names[$i]?>" <? if ($component_names[$i] == $component_name) {?>selected<? }?>><?=$component_names[$i]?></option>
			<? }?>
    </select>
    <br>
  </p>
</center>
  
<table border="0" align="center" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>	
    <th width="154" bgcolor="#999999"> 
			<font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font> 
		</th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
			<?=$rs[$i]?>
			</font>
			</td>
		<? }?>
		<td width="43"><input name="Update" type="button" id="Update" value="Edit" onClick="editComponentProperties('<?=$rs[0]?>','<?=$rs[1]?>');"></td>
		<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteComponentProperties('<?=$rs[0]?>','<?=$rs[1]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
  </center>
</p>

<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_component_properties.php?Action=Add&component_name=<?=$component_name?>"><img src="../images/new_component_properties.gif" alt="New Component Properties" width="154" height="21" border="0"></a></td>
    	<td>&nbsp;</td>
			<td><a href="manage_component_design.php"><img src="../images/component_design.gif" alt="Component Design" width="137" height="21" border="0"></a></td>
		</tr>
  </table>
</center>
<? }?>
</body>
</html>
