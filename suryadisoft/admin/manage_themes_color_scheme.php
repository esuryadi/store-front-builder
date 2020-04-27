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

$query = "SELECT theme_name FROM THEMES";
$query_result2 = mysql_query($query);
while($rs = mysql_fetch_row($query_result2)) {
	$theme_names[] = $rs[0];
}

if (!isset($theme_name))
	$theme_name = $theme_names[0];

if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM THEMES_COLOR_SCHEME WHERE theme_name = '$theme_name' AND theme_color_scheme = '$theme_color_scheme'";
else
	$query = "SELECT * FROM THEMES_COLOR_SCHEME WHERE theme_name = '$theme_name' ORDER BY theme_color_scheme";
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"THEMES_COLOR_SCHEME");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Themes Property</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editColorScheme(theme_name,theme_color_scheme) {
	var url = "manage_themes_color_scheme.php?Action=Update&theme_name=" + theme_name + "&theme_color_scheme=" + theme_color_scheme;
	open(url,"_self");
}

function deleteColorScheme(theme_name,theme_color_scheme) {
	var url = "manage_themes_color_scheme_result.php?Action=Delete&theme_name=" + theme_name + "&theme_color_scheme=" + theme_color_scheme;
	open(url,"_self");
}

function changeTheme(theme_name) {
	var url = "manage_themes_color_scheme.php?theme_name=" + theme_name;
	open(url,"_self");
}
</script>
</head>
<body vlink="00aeef">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="manage_themes.php">Manage 
Themes</a><strong> &gt; <font color="00aeef">Color Schemes</font></strong></font> 
<p>
  <? if (isset($Action)) {?>
</p>
<form action="manage_themes_color_scheme_result.php" method="post" name="ThemesColorSchemeForm" id="Themes PropertyForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_theme_color_scheme" value="<?=$rs[1]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<tr>
					<? if (stristr(mysql_field_flags($query_result,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$field_name[$i]?>:</font></td>
					<td>
						<? if ($field_name[$i] == "theme_name") {?>
							<? if ($Action == "Add") {?><?=$theme_name?><? } else {?><?=$rs[$i]?><? }?>
							<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Add") {?><?=$theme_name?><? } else {?><?=$rs[$i]?><? }?>">
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
    <input type="submit" name="Submit" value="<?=$Action?> Color Scheme">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
</font>

<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_themes_color_scheme.php?Action=Add&theme_name=<?=$theme_name?>"><img src="../images/new_color_scheme.gif" alt="New Color Scheme" width="129" height="21" border="0"></a></td>
    </tr>
  </table>
  <p align="left"><b>Theme:</b> 
    <select name="theme_name" onChange="changeTheme(this.value);">
			<? for($i=0;$i<count($theme_names);$i++) {?>
			<option value="<?=$theme_names[$i]?>" <? if ($theme_names[$i] == $theme_name) {?>selected<? }?>><?=$theme_names[$i]?></option>
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
			<? if ($i == 1) {?>
			<a href="manage_themes_property.php?theme_name=<?=$rs[0]?>&theme_color_scheme=<?=urlencode($rs[$i])?>"><?=$rs[$i]?></a>
			<? } else {?>
			<?=$rs[$i]?>
			<? }?>
			</font>
			</td>
		<? }?>
		<td width="43"><input name="Update" type="button" id="Update" value="Edit" onClick="editColorScheme('<?=$rs[0]?>','<?=$rs[1]?>');"></td>
		<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteColorScheme('<?=$rs[0]?>','<?=$rs[1]?>');"></td>
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
      <td><a href="manage_themes_color_scheme.php?Action=Add&theme_name=<?=$theme_name?>"><img src="../images/new_color_scheme.gif" alt="New Color Scheme" width="129" height="21" border="0"></a></td>
    </tr>
  </table>
</center>
<? }?>
</body>
</html>
