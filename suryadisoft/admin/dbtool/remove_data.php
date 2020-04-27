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
<title>Remove Data</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Remove 
Data from Table</strong></font>
<form action="remove_data_result.php" method="post" name="RemoveDataForm" id="RemoveDataForm">

  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database: 
    <?=$selected_db?>
    </font></p>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
	<input type="hidden" name="DatabaseName" value="<?=$selected_db?>"> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <p><font size="-1">Table: 
    <?=$selected_table?>
    </font></p>
  <font size="-1">
	<input type="hidden" name="TableName" value="<?=$selected_table?>">
	<p>Where</p>
  </font></font> 
  <blockquote> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <textarea name="WhereClause" cols="50" rows="5" id="WhereClause"></textarea>
    </font></blockquote>
	<p>&nbsp;</p>
  <p> 
    <input type="submit" name="Submit" value="Remove Data">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
