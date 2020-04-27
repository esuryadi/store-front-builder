<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$selected_db = $HTTP_SESSION_VARS["selected_db"];
$selected_table = $HTTP_SESSION_VARS["selected_table"];

$field_list = mysql_list_fields($selected_db,$selected_table);
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Update Data In Table</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Update 
Data in Table</strong></font>
<form action="update_table_result.php" method="post" name="UpdateTableForm" id="UpdateTableForm">

  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database: 
    <?=$selected_db?>
    </font></p>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
	<input type="hidden" name="DatabaseName" value="<?=$selected_db?>"> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><p><font size="-1">Table: 
    <?=$selected_table?>
  </font></p>
  <font size="-1"><input type="hidden" name="TableName" value="<?=$selected_table?>">
  <p>Set:</p>
  </font></font> 
	<blockquote>
	<table bgcolor="#eeeeee" border="0" cellspacing="0" cellpadding="5">
	<? for ($i=0;$i<count($field_name);$i++) {?>
	<tr>		
        <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
          <?=$field_name[$i]?>
          :</font></td>
		<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
		<input type="hidden" name="FieldName[]" value="<?=$field_name[$i]?>">
        <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
          <input name="FieldValue[]" type="text" value="" size="50">
          </font></td>
		<? } else {?>
        <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Auto</font></td>
		<? }?>
	</tr>
	<? }?>
	</table>
  </blockquote>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Where:</font></p>
  <p> 
  <blockquote> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
    <textarea name="WhereClause" cols="50" rows="5" id="WhereClause"></textarea>
    </font></blockquote>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> </font> 
  <p>&nbsp; </p>

  <p> 
    <input type="submit" name="Submit" value="Update Data">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
<p align="left">&nbsp;</p>
</body>
</html>
