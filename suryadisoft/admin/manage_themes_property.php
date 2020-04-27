<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");
?>
<html>
<head>
<?php
$theme_color_scheme = urldecode($theme_color_scheme);
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

$query = "SELECT theme_color_scheme FROM THEMES_COLOR_SCHEME WHERE theme_name = '$theme_name'";
$query_result2 = mysql_query($query);
while($rs = mysql_fetch_row($query_result2)) {
	$theme_color_schemes[] = $rs[0];
}

if (!isset($theme_color_scheme))
	$theme_color_scheme = $theme_color_schemes[0];

if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM THEMES_PROPERTY WHERE theme_name = '$theme_name' AND theme_color_scheme = '$theme_color_scheme' AND theme_property_name = '$theme_property_name' ORDER BY theme_property_name";
else
	$query = "SELECT * FROM THEMES_PROPERTY WHERE theme_name = '$theme_name' AND theme_color_scheme = '$theme_color_scheme' ORDER BY theme_property_name";
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"THEMES_PROPERTY");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Themes Property</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editThemeProperties(theme_color_scheme,theme_property_name) {
	var url = "manage_themes_property.php?Action=Update&theme_name=<?=$theme_name?>&theme_color_scheme=" + theme_color_scheme + "&theme_property_name=" + theme_property_name;
	open(url,"_self");
}

function deleteThemeProperties(theme_color_scheme,theme_property_name) {
	var url = "manage_themes_property_result.php?Action=Delete&theme_name=<?=$theme_name?>&theme_color_scheme=" + theme_color_scheme + "&theme_property_name=" + theme_property_name;
	open(url,"_self");
}

function changeColorScheme(theme_color_scheme) {
	var url = "manage_themes_property.php?theme_name=<?=$theme_name?>&theme_color_scheme=" + theme_color_scheme;
	open(url,"_self");
}
</script>
</head>
<body vlink="00aeef">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="manage_themes.php">Manage 
Themes</a><strong> &gt; </strong><a href="manage_themes_color_scheme.php?theme_name=<?=$theme_name?>">Color 
Schemes</a><strong> &gt; <font color="00aeef">Theme Properties</font></strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_themes_property_result.php" method="post" name="Themes PropertyForm" id="Themes PropertyForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_theme_property_name" value="<?=$rs[2]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<tr>
					<? if (stristr(mysql_field_flags($query_result,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$field_name[$i]?>:</font></td>
					<td>
						<? if ($field_name[$i] == "theme_name" || $field_name[$i] == "theme_color_scheme") {?>
						<? if ($Action == "Add" && $field_name[$i] == "theme_name") {?><?=$theme_name?><? } else if ($Action == "Add" && $field_name[$i] == "theme_color_scheme") {?><?=$theme_color_scheme?><? } else {?><?=$rs[$i]?><? }?>
						<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Add" && $field_name[$i] == "theme_name") {?><?=$theme_name?><? } else if ($Action == "Add" && $field_name[$i] == "theme_color_scheme") {?><?=$theme_color_scheme?><? } else {?><?=$rs[$i]?><? }?>">
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
    <input type="submit" name="Submit" value="<?=$Action?> Themes Property">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
</font>

<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_themes_property.php?Action=Add&theme_name=<?=$theme_name?>&theme_color_scheme=<?=$theme_color_scheme?>"><img src="../images/new_property.gif" width="97" height="21" border="0"></a></td>
    </tr>
  </table>
  <p align="left"><b>Color Scheme:</b> 
    <select name="theme_color_scheme" onChange="changeColorScheme(this.value);">
			<? for($i=0;$i<count($theme_color_schemes);$i++) {?>
			<option value="<?=$theme_color_schemes[$i]?>" <? if ($theme_color_schemes[$i] == $theme_color_scheme) {?>selected<? }?>><?=$theme_color_schemes[$i]?></option>
			<? }?>
    </select>
    <br>
  </p>
</center>
  
<table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>

		
    <th width="154" bgcolor="#999999"> <font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font> </th>

		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
					<?=$rs[$i]?>
			</font></td>
		<? }?>
		<td width="43"><input name="Update" type="button" id="Update" value="Edit" onClick="editThemeProperties('<?=$rs[1]?>','<?=$rs[2]?>');"></td>
		<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteThemeProperties('<?=$rs[1]?>','<?=$rs[2]?>');"></td>
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
      <td><a href="manage_themes_property.php?Action=Add&theme_name=<?=$theme_name?>&theme_color_scheme=<?=$theme_color_scheme?>"><img src="../images/new_property.gif" width="97" height="21" border="0"></a></td>
    </tr>
  </table>
</center>
<? }?>
</body>
</html>
