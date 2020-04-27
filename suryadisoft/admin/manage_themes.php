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
if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM THEMES WHERE theme_name = '$theme_name'";
else
	$query = "SELECT * FROM THEMES";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"THEMES");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Themes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editPrice(id) {
	var url = "manage_themes.php?Action=Update&theme_name=" + id;
	open(url,"_self");
}

function deletePrice(id) {
	var url = "manage_themes_result.php?Action=Delete&theme_name=" + id;
	open(url,"_self");
}
</script>
</head>







<body vlink="00aeef">

  <font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Themes</strong></font></p>

<p>
  <? if (isset($Action)) {?>
<form action="manage_themes_result.php?" method="post" name="ThemesForm" id="ThemesForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_theme_name" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<tr>
					<? if (stristr(mysql_field_flags($query_result,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$field_name[$i]?>
        :</font></td>
      <td> <input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>"> 
					</td>
					<? } else {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
					<? }?>
				</tr>
			<? }?>
		</table>
		<p>&nbsp;</p>			
  <p> 			
    <input type="submit" name="Submit" value="<?=$Action?> Themes">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
<center>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table border="0">
          <tr> 
            <td><a href="manage_themes.php?Action=Add"><img src="../images/add_new_theme.gif" width="104" height="21" border="0"></a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="manage_themes_property.php"><img src="../images/theme_properties.gif" width="116" height="21" border="0"></a></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br>
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
				<? if ($i == 0) {?>
					<a href="manage_themes_color_scheme.php?theme_name=<?=$rs[$i]?>"><?=$rs[$i]?></a>
				<? } else {?>
					<?=$rs[$i]?>
				<? }?>
			</font></td>
		<? }?>
		<td width="43"><input name="Update" type="button" id="Update" value="Edit" onClick="editPrice('<?=$rs[0]?>');"></td>
		<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deletePrice('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<center>
  <br>
  <br>
  <table border="0">
    <tr>
      <td><a href="manage_themes.php?Action=Add"><img src="../images/add_new_theme.gif" width="104" height="21" border="0"></a></td>
      <td>&nbsp;&nbsp;</td>
      <td><a href="manage_themes_property.php"><img src="../images/theme_properties.gif" width="116" height="21" border="0"></a></td>
    </tr>
  </table>
</center>
<? }?>
</body>
</html>
