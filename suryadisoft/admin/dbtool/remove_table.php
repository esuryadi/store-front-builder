<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$table_list = mysql_list_tables($selected_db);
while ($row = mysql_fetch_row($table_list)) {
	$table_name [] = $row[0];
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Remove Table</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
	function validateForm(form) {
		var valid = true;
		var err_msg = "";
		
		if (form.elements[0].selectedIndex == -1) {
			valid = false;
			err_msg = err_msg + "No table has been selected yet!\n";
		}
		
		if (!valid)
			alert(err_msg);
			
		event.returnValue = valid;
	}
</script>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Remove 
  Table</strong></font></p>
  <form action="remove_table_result.php" method="post" name="RemoveTableForm" id="RemoveTableForm">
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database: 
    <?=$HTTP_SESSION_VARS["selected_db"]?>
    </font></p>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
		<input type="hidden" name="DatabaseName" value="<?=$HTTP_SESSION_VARS['selected_db']?>">
  </font> 
		<table border="0" cellspacing="5" cellpadding="5">
      <tr>
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Select 
        Table:</strong></font></td>
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
					<select name="TableName[]" size="5" multiple id="TableName">
          <? for ($i=0;$i<count($table_name);$i++) { ?>
          <option value="<?=$table_name[$i]?>"> 
          <?=$table_name[$i]?>
          </option>
						<? }?>
					</select>
        </font></td>
      </tr>
    </table>

    
  <p> 
      <input type="submit" name="Submit" value="Remove Table" onClick="validateForm(this.form);">
      <input type="reset" name="Submit2" value="Reset">
    </p>
    </form>

</body>
</html>
