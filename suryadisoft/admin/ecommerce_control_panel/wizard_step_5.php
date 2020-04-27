<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";
require_once "../../path_config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {
	$logout = true;
} else {
	$admin = $HTTP_SESSION_VARS["admin_user"];
	$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
	$db_connect->open();
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	$db_connect->close();
	$admin->retrieveAdminInfo($userid);
		
	$logout = false;
}
?>
<html>
<head>
<title>Online Store Builder Wizard - Step 5</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
.style2 {font-size: smaller}
-->
</style>
</head>
<script language="javascript">
<!--
	function setComponent(position,form) {
		form.action = "wizard_step_4.php?position=" + position;
		form.submit();
	}
-->
</script>
<body>
<table width="600" height="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="00AEEF">
<tr><td>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
<tr>
  <td bgcolor="00AEEF" height="5%"><span class="style1">Online Store Builder Wizard - Step 5 </span></td>
</tr>
<tr><td height="90%">
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td><table width="100%" height="350" border="1" cellpadding="5" cellspacing="0" bordercolor="#4ACDFF">
      <tr>
        <td width="40%" valign="top" bgcolor="#CCF1FF"><p class="style2"><strong>Thank you for using SuryadiSoft Online Store Builder! </strong></p>
        </td>
      </tr>
    </table>
	</td>
    <td width="60%"><p class="style2">Congratulations! You have just finished created your online store. </p>
      <p class="style2">From this point, you can create more pages or you can preview your store by pressing the button below.</p>
      <p class="style2">To setup your store settings (title, keywords, description, etc.) and payment setting, please click on the <a href="settings.php"><strong>Settings</strong></a> menu. </p>
      <p class="style2">If you need to edit your page such as changing page name, add more store components, etc. You need to do this from the <a href="menu_bottom.php?page=manage_store"><strong>Manage Store</strong></a> section. </p></td>
  </tr>
</table>
  </td>
</tr>
<tr>
  <td align="center" bgcolor="00AEEF" height="5%"><table width="100%"  border="0">
    <tr>
      <td width="33%" align="left">
        <input name="createPageButton" type="button" id="createPageButton" value="Create Another Page" onClick="window.open('wizard_step_2.php','_self');">        </td>
      <td align="center" width="34%">
	  <? if (substr($admin->getUserId(),0,5) == "trial") {?>
	  <input name="activateButton" type="button" id="activateButton" value="Please Activate My Trial Account" onClick="window.open('http://www.suryadisoft.net/suryadisoft.php?page=Pricing&subpage=StorePricing&trial_id=<?=$admin->getUserId()?>','activate');">
	  <? }?>	  </td>
      <td align="right" width="33%">
		<input name="PreviewButton" type="button" id="PreviewButton" value="Preview Store" onClick="window.open('http://<?=$admin->getCompanyURL()?>','new_window');">
      </td>
    </tr>
  </table></td>
</tr>
</table>
</td></tr>
</table>
</body>
</html>
