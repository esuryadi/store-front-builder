<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once "../config.php";

if (isset($SelectedDB))
	$HTTP_SESSION_VARS["selected_db"] = $SelectedDB;

if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {
	$db = $HTTP_SESSION_VARS["client_db"];
}
?>
<html>
<head>
<title>Menu Top</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {?>


<script language="JavaScript">

var coldColor = "#ffffff"
var hotColor  = "#ffffff"
var motionPix = "0"
var a='<style>'+
'A.InstantLink:link {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;'+
'  }'+  
'A.InstantLink:visited {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;}'+  
'A.InstantLink:active {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;'+
'  }'+  
'A.InstantLink:hover {'+
'  color:'+hotColor+';'+
'  text-decoration:underline;'+
'  padding:0 0 0 '+motionPix+';'+
'  }'+
'</style>'
if (document.all || document.getElementById){
    document.write(a)
}

function setDatabase(db) {
	var url = "menu_top.php?SelectedDB=" + db;
	open(url,"_self");
}

function refreshMainFrame() {
	open("settings.php","bottomFrame");
}

</script>
<? }?>
</head>

<body vlink="00aeef" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" <? if (isset($SelectedDB)) {?>onLoad="refreshMainFrame();"<? }?>>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="00AEEF">
  <tr>

    <td valign="bottom"><img src="../../images/ecommerce_control_hdr.jpg"></td>

    <td valign="bottom">
			<? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {?>
			<table border="0" cellspacing="0" cellpadding="5"> 
			<tr> 
				<td>
					<b><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Database:</font></b> 
					<select name="selected_db" onChange="setDatabase(this.value);">
					<? for ($i=0;$i<count($db);$i++) {?>
						<option value="<?=$db[$i]?>" <? if (isset($SelectedDB) && $SelectedDB == $db[$i]) {?>selected<? }?>>
						<?=$db[$i]?>
						</option>
					<? }?>
					</select>
				</td>
			</tr>
			</table>
			<? }?>
		</td>
    <td align="right" valign="bottom"> 
			<div align="right"> 
			<table border="0" cellspacing="0" cellpadding="5">
        <tr> 
          <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
						<? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {?>
						<a class="InstantLink" href="../control_panel.php" target="_parent"><font color="#FFFFFF">Administrator Control Panel</font></a> | 
						<? }?>
						<a class="InstantLink" href="../login.php?Action=Logout" target="_parent"><font color="#FFFFFF">Logout</font></a> 
            </font>
					</td>
        </tr>
      </table>
			</div>
		</td>
  </tr>
  <tr bgcolor="#333333"><td colspan="3"><img src="../../images/spacer.gif" height="4" width="4"></td></tr>
</table>
</body>
</html>
<script language="JavaScript">
var width = screen.width - 100;
var height = screen.height - 150;

function getCookie(cookie_name) {
	var cookie_value = "";
	if(document.cookie) {
		index = document.cookie.indexOf(cookie_name);
		if (index != -1)
		{
			namestart = (document.cookie.indexOf("=", index) + 1);
			nameend = document.cookie.indexOf(";", index);
			if (nameend == -1) {nameend = document.cookie.length;}
				cookie_value = document.cookie.substring(namestart, nameend);
		}
	}
	return cookie_value;
}

//if (getCookie("launch_wizard_window") == "" || getCookie("launch_wizard_window") == "true")
//	window.open('wizard.php','wizard','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=50,left=50,width=' + width + ',height=' + height);
</script>
