<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$selected_db = $HTTP_SESSION_VARS["selected_db"];

$HTTP_SESSION_VARS["db_connect"]->open();

$table_list = mysql_list_tables($selected_db);
while ($row = mysql_fetch_row($table_list)) {
	$table_name [] = $row[0];
}
?>
<title>Database: <?=$selected_db?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database:</font><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
  <?=$selected_db?>
  </strong></font></p>
<table border="0" cellpadding="10" cellspacing="10">
  <tr>
<? for($i=0;$i<count($table_name);$i++) {?>
<? if ($i != 0 && ($i%3) == 0) {?>
</tr>
<tr>
<? }?>
	  <td valign="top"> 

      <table border="1" cellpadding="3" cellspacing="0" bordercolor="#bbbbbb">

		<tr bgcolor="#888888"> 

			<th colspan="3"><font color="#FFFFFF"> 

				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"><?=$table_name[$i]?></font>

				</font></th>
		</tr>
		<? $field_list = mysql_list_fields($selected_db,$table_name[$i]);
			for ($n=0;$n<mysql_num_fields($field_list);$n++) {?>
		<tr> 
			<td bgcolor="<? if(stristr(mysql_field_flags($field_list,$n),"primary_key")) {?>#FFFF00<? } else {?>#FFFFFF<? }?>">

				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=mysql_field_name($field_list,$n)?></font>

			</td>

			<td bgcolor="<? if(stristr(mysql_field_flags($field_list,$n),"primary_key")) {?>#FFFF00<? } else {?>#FFFFFF<? }?>"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=mysql_field_type($field_list,$n)?></font></td>

			<td bgcolor="<? if(stristr(mysql_field_flags($field_list,$n),"primary_key")) {?>#FFFF00<? } else {?>#FFFFFF<? }?>"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=mysql_field_flags($field_list,$n)?></font></td>

		</tr>
		<? }?>
	</table>
	</td>
<? }?>
</tr>
</table>
</body>
</html>
<?php
$HTTP_SESSION_VARS["db_connect"]->close();
?>