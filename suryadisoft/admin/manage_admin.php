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
	$query = "SELECT * FROM USER WHERE USER_ID = '$user_id'";
else
	$query = "SELECT * FROM USER";	
$query_result = mysql_query($query);

$field_list = mysql_list_fields(_ADMIN_DATABASE,"USER");
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editUser(id) {
	var url = "manage_admin.php?Action=Update&user_id=" + id;
	open(url,"_self");
}

function deleteUser(id) {
	var url = "manage_admin_result.php?Action=Delete&user_id=" + id;
	open(url,"_self");
}
</script>
</head>



<body vlink="00aeef">



<table width="100%"  border="0">

  <tr> 



    <td><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Administrator 



      User</strong></font> <p> 

  <? if (isset($Action)) {?>
</p>

      <form action="manage_admin_result.php?" method="post" name="adminForm" id="adminForm">

		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_user_id" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<? if ($field_name[$i] != "password" || $Action == "Create") {?> 
				<tr>
					<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>

            <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
              <?=$field_name[$i]?>

              :</font></td>

            <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

						<? if ($Action == "Update" && $i == 0) {?>
						<input type="hidden" name="<?=$field_name[$i]?>" value="<?=$rs[$i]?>">
						<?=$rs[$i]?>
						<? } else if ($field_name[$i] == "role") {?>
						<select name="<?=$field_name[$i]?>">
						<option value="Administrator" <? if ($Action == "Update" && $rs[$i] == "Administrator") {?>selected<? }?>>Administrator</option>
						<option value="User" <? if ($Action == "Update" && $rs[$i] == "User") {?>selected<? }?>>User</option>
						<option value="Sales" <? if ($Action == "Update" && $rs[$i] == "Sales") {?>selected<? }?>>Sales</option>
						</select>
						<? } else if ($field_name[$i] == "status") {?>
						<select name="<?=$field_name[$i]?>">
						<option value="Active" <? if ($Action == "Update" && $rs[$i] == "Active") {?>selected<? }?>>Active</option>
						<option value="Inactive" <? if ($Action == "Update" && $rs[$i] == "Inactive") {?>selected<? }?>>Inactive</option>
						<option value="Suspended" <? if ($Action == "Update" && $rs[$i] == "Suspended") {?>selected<? }?>>Suspended</option>
						</select>
						<? } else {?>
						<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
						<? }?>

            </font></td>

					<? } else {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
					<? }?>
				</tr>
				<? }?>
			<? }?>
		</table>
		<p>&nbsp;</p>

        <p> 
			
    <input type="submit" name="Submit" value="<?=$Action?> Administrator User">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
      <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><a href="manage_admin.php?Action=Create"><img src="../images/new_user.gif" alt="New Administrator User" border="0"></a></td>
          <td>&nbsp;&nbsp;</td>
          <td><a href="change_admin_password.php"><img src="../images/change_admin_password.gif" width="159" height="21" border="0"></a></td>
        </tr>
      </table>
<p align="center">

      <table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>

						<? if ($field_name[$i] != "password") {?>



							
          <th width="97" valign="bottom" bgcolor="#999999"> <font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
            </font></th>

		<? }?>

					<? }?>

	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>

						<? if ($field_name[$i] != "password") {?>

							<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 

				<? if	($field_name[$i] == "email") {?>
				<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a> 
				<? } else {?>
					<?=$rs[$i]?>
				<? }?>

							</font></td>

		<? }?>

          <? }?>

          <td width="51"><input name="Update" type="button" id="Update" value="Edit" onClick="editUser('<?=$rs[0]?>');"></td>

		<? if ($rs[0] != "admin") {?>

          <td width="58"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteUser('<?=$rs[0]?>');"></td>

		<? }?>
	</tr>
	<? }?>
</table>
<p>
<center>
        <table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td><a href="manage_admin.php?Action=Create"><img src="../images/new_user.gif" alt="New Administrator User" border="0"></a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="change_admin_password.php"><img src="../images/change_admin_password.gif" width="159" height="21" border="0"></a></td>
          </tr>
        </table>
        </center>
      <p></p>
<? }?>

<? if (isset($Status) && $Status == "failed") {?>
<script>



alert("User Id already exists.\nPlease select different User Id.");



</script>
<? }?>

    </td>

  </tr>

</table>

</body>
</html>
