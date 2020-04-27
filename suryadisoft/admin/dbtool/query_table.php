<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$selected_db = $HTTP_SESSION_VARS["selected_db"];
$selected_table = $HTTP_SESSION_VARS["selected_table"];
	
$HTTP_SESSION_VARS["db_connect"]->open();

$field_list = mysql_list_fields($selected_db,$selected_table);
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Query Table</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Query 
Table</strong></font>
<form action="query_table_result.php" method="post" name="QueryTableForm" id="QueryTableForm">

  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Database:</strong> 
    <?=$selected_db?>
    </font></p>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
	<input type="hidden" name="DatabaseName" value="<?=$selected_db?>"> 
  </font> 
	<p>
	<table cellpadding="5" cellspacing="5">
<tr>
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Select:</font></td>
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<select name="Select[]" size="5" multiple id="Select[]">
          <option value="*" selected>*</option>
          <? for($i=0;$i<count($field_name);$i++) {?>
          <option value="<?=$field_name[$i]?>">
          <?=$field_name[$i]?>
          </option>
          <? }?>
        </select>
        </font></td>
		</tr>
	</table>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"></p> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <p><font size="-1"><strong>From Table:</strong> 
    <?=$selected_table?>
    </font></p>
  <font size="-1">
	<input type="hidden" name="TableName" value="<?=$selected_table?>">
  <p><strong>Where:</strong></p>
  </font></font> 
	<blockquote>
<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
      <textarea name="WhereClause" cols="50" rows="5" id="WhereClause"></textarea>
      </font></p>
  </blockquote>
  <table cellpadding="5" cellspacing="0">
<tr>
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Group 
        by:</strong></font></td>
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<select name="GroupBy[]" size="5" multiple id="GroupBy[]">
          <? for($i=0;$i<count($field_name);$i++) {?>
          <option value="<?=$field_name[$i]?>"> 
          <?=$field_name[$i]?>
          </option>
					<? }?>
				</select>
        </font></td>
		</tr>
	</table>
	<p>
  <table cellpadding="5" cellspacing="0">
<tr>
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Order 
        by:</strong></font></td>
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<select name="OrderBy[]" size="5" multiple id="OrderBy[]">
          <? for($i=0;$i<count($field_name);$i++) {?>
          <option value="<?=$field_name[$i]?>"> 
          <?=$field_name[$i]?>
          </option>
					<? }?>
				</select>
        </font></td>
      <td valign="top"><p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
          <input name="Order" type="radio" value="ASC" checked>
          ASCENDING</font></p>
        <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
          <input type="radio" name="Order" value="DESC">
          DESCENDING</font></p></td>
		</tr>
	</table>
	<p></p> 
  <p>
    <input type="submit" name="Submit" value="Query">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
<p align="left">&nbsp;</p>
</body>
</html>
