<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
$HTTP_SESSION_VARS["db_connect"]->open();

$db_list = mysql_list_dbs();
while ($row = mysql_fetch_array($db_list)) {
	$dbname [] = $row[0];
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<title>Remove Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
	function validateForm(form) {
		var valid = true;
		var err_msg = "";
		
		if (form.elements[0].selectedIndex == -1) {
			valid = false;
			err_msg = err_msg + "No database has been selected yet!\n";
		}
		
		if (!valid)
			alert(err_msg);
			
		event.returnValue = valid;
	}
</script>
</head>

<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Remove 
Database</strong></font>
<form action="remove_db_result.php" method="post" name="RemoveDBForm" id="RemoveDBForm">
  <table border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Select 
        Database:</strong></font></td>
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="DatabaseName[]" size="5" multiple id="DatabaseName">
          <? for ($i=0;$i<count($dbname);$i++) { ?>
          <option value="<?=$dbname[$i]?>"> 
          <?=$dbname[$i]?>
          </option>
					<? }?>
				</select>
        </font></td>
    </tr>
  </table>
  <p> 
    <input type="submit" name="Submit" value="Remove Database" onClick="validateForm(this.form);">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
</body>
</html>
