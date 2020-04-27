<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Themes.php";
require_once "../config.php";
require_once "../../path_config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {
	$logout = true;
} else {
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	$query = "SELECT PROPERTY_NAME, PROPERTY_VALUE FROM PROPERTY";
	$query_result = mysql_query($query);
	$prop = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$prop[$rs[0]] = $rs[1];
	}
	
	mysql_select_db(_ADMIN_DATABASE);
	
	$query = "SELECT * FROM THEMES ORDER BY theme_name";
	$query_result = mysql_query($query);
	$themes = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$themes[] = $rs[0]; 
	}
	if (!isset($selected_theme)) {
		if (isset($prop["selected_theme"]))
			$selected_theme = $prop["selected_theme"];
		else
			$selected_theme = $themes[0];
	}
	$query = "SELECT * FROM THEMES_COLOR_SCHEME WHERE theme_name = '$selected_theme' ORDER BY theme_color_scheme";
	$query_result = mysql_query($query);
	$color_schemes = Array();
	while ($rs = mysql_fetch_row($query_result)) {
		$color_schemes[] = $rs[1]; 
	}
	if (!isset($selected_color_scheme)) {
		if (isset($prop["selected_color_scheme"]))
			$selected_color_scheme = $prop["selected_color_scheme"];
		else
			$selected_color_scheme = $color_schemes[0];
	} else if (isset($ChangeTheme)) {
		$selected_color_scheme = $color_schemes[0];
	}
	$theme = new Themes();
	$properties = $theme->getProperties($selected_theme,$selected_color_scheme);
	
	$db_connect->close();
	
	$logout = false;
}
?>
<html>
<head>
<title>Online Store Builder - Step 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

<? if ($logout) {?>
window.open("../login.php?Action=logout&session_out=true","_top");
<? }?>
	
function changeThemes(form) {
	form.action = "wizard_step_1.php?ChangeTheme=yes";
	form.method = "POST";
	form.submit();
}

function changeColorSchemes(form) {
	form.action = "wizard_step_1.php?ChangeColorScheme=yes";
	form.method = "POST";
	form.submit();
}

</script>
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
-->
</style>
</head>

<body>
<form action="setThemes.php" method="post" name="set_themes_form" id="set_themes_form">
<table width="600" height="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="00AEEF">
<tr><td>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
<tr>
  <td bgcolor="00AEEF" height="5%"><span class="style1">Online Store Builder Wizard - Step 1</span></td>
</tr>
<tr><td height="90%">
<div align="center">
    <? for($i=0;$i<count($properties);$i++) {
		$theme_prop = $properties[$i];
		$name = $selected_theme . "_" . str_replace(" ","_",strtolower($theme_prop["name"]));?>
			<? if ($theme_prop["name"] != "Preview Images") {?>
			<input type="hidden" name="<?=$name?>" value="<? if (isset($prop[$name]) && !isset($DefaultSettings) && !isset($ChangeColorScheme)) {?><?=$prop[$name]?><? } else {?><?=$theme_prop["value"]?><? }?>">
			<? } else {
				$theme_img_src = "../../themes/" . $theme->getDirectory($selected_theme) . "/images/" . $theme_prop["value"];
			}?>
		<? }?>
		<table border="0" cellpadding="20">
			<tr> 
				<td valign="top"> <strong><font size="-1">Select Design Themes:</font></strong> 
					<p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Themes:</strong><br>
					<select name="selected_theme" size="5" onChange="changeThemes(this.form);">
					<? for($i=0;$i<count($themes);$i++) {?>
					<option value="<?=$themes[$i]?>" <? if (isset($selected_theme) && $themes[$i] == $selected_theme) {?>selected<? }?>> 
					<?=ucwords(str_replace("_"," ",$themes[$i]))?>
					</option>
					<? }?>
					</select>
					</font>
					</p>
						<p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Color 
							Schemes:</strong><br> 
					<select name="selected_color_scheme" size="5" onChange="changeColorSchemes(this.form);">
					<? for($i=0;$i<count($color_schemes);$i++) {?>
					<option value="<?=$color_schemes[$i]?>" <? if (isset($selected_color_scheme) && $color_schemes[$i] == $selected_color_scheme) {?>selected<? }?>> 
					<?=ucwords(str_replace("_"," ",$color_schemes[$i]))?>
					</option>
					<? }?>
					</select>
					</font>
					</p>
			</td>
			<td valign="top">           
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><? if ($theme_img_src == "") {?>
				<strong>Do not choose this option, unless you have Custom Store-Front Design</strong>
				<? } else {?><img src="<?=$theme_img_src?>"><? }?> 
				</font> 
			</td>
		</tr>
	</table>  
</div>
</td></tr>
<tr><td align="right" bgcolor="00AEEF" height="5%"><input name="NextButton" type="submit" id="NextButton" value="Next &gt;&gt;">
  &nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>
