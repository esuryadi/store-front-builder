<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
$log = fopen("../log.txt","a+");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

mysql_select_db($DatabaseName);
$result = mysql_query(stripslashes($SQLStatement));

fwrite($log,$SQLStatement . "\n\n");

if ($result) {
	if (stristr($SQLStatement,"select")) {
		for ($i=0;$i<mysql_num_fields($result);$i++)
			$field_name [] = mysql_field_name($result,$i);
	}
} else {
	$mysql_errno = mysql_errno();
	$mysql_error = mysql_error();
	fwrite($log,"ERROR " . $mysql_errno . ": " . $mysql_error . "\n\n");
} 

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Execute Query Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>SQL Statement:</b> 
<?=stripslashes($SQLStatement)?>
<? if ($result) {?>
	<? if (stristr($SQLStatement,"select")) {?>
		<p align="center">
		<table border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td> <table border="0" cellpadding="8" cellspacing="0">
		<tr>
						<? for($i=0;$i<count($field_name);$i++) {?>
          <th bgcolor="#999999"><font size="-1" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif"> 
            <?=$field_name[$i]?>
            </font></th>
						<? }?>
					</tr>
					<? for($n=0;$rs = mysql_fetch_row($result);$n++) {?>
					<tr>
						<? for($i=0;$i<count($rs);$i++) {?>
							<td align="<? if (stristr(mysql_field_type($result,$i),"INT") || stristr(mysql_field_type($result,$i),"DECIMAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
            <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
								<?=$rs[$i]?>
            </font></td>
						<? }?>
					</tr>
					<? }?>
      </table></td>
  </tr>
				</table>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
	<? } else if (stristr($SQLStatement,"insert")) {?>
</font> 
<p>
<h1><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Data has been 
  inserted successfully</font></h1>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
	<? } else if (stristr($SQLStatement,"update")) {?>
</font> 
<p>
<h1><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Data has been 
  updated successfully</font></h1>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
	<? } else if (stristr($SQLStatement,"delete")) {?>
</font> 
<p>
<h1><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Data has been 
  deleted successfully</font></h1>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
	<? } else if (stristr($SQLStatement,"drop database")) {?>
</font> 
<p>
<h1><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database has 
  been dropped successfully</font></h1>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
	<? } else if (stristr($SQLStatement,"drop table")) {?>
</font> 
<p>
<h1><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Table has been 
  dropped successfully</font></h1>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
	<? } else {?>
</font> 
<p>
<h1><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">SQL Statement 
  executed successfully</font></h1>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> 
		<? }?>
<? } else {
	echo "<p><b>MYSQL ERROR $mysql_errno:</b> $mysql_error</p>";
}?>
</font> 
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a href="menu_top.php?Action=Refresh" target="topFrame">Back</a></font></p>
</body>
</html>
<?php
fclose($log);
?>
