<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Admin.php";
require_once("config.php");
?>
<html>
<head>
<title>Administrator Control Panel - Left Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<script language="JavaScript">

var coldColor = "#000000"
var hotColor  = "#00AEEF"
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
</script>







<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000" leftmargin="0" rightmargin="0" marginheight="0" marginwidth="0">



<table width="150" border="0" cellpadding="0" cellspacing="0" bgcolor="#eeeeee">

  <tr> 
    <td></td>
    <td></td>
    <td align="right" valign="top"><img src="../images/corner-tr.gif" width="8" height="8"></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>
		<? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Administrator") {?>
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>
      <p><a class="InstantLink" href="manage_admin.php" target="mainFrame">Manage 
        Users</a></p>
      <p><a class="InstantLink" href="manage_clients.php" target="mainFrame">Manage 
        Clients</a></p>
      <p><a class="InstantLink" href="manage_pricing.php" target="mainFrame">Manage 
        Pricing</a></p>
      </b></font> 
      <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="manage_themes.php" target="mainFrame">Manage 
        Themes</a></b></font></p>
      <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a class="InstantLink" href="manage_referral.php" target="mainFrame">Manage 
        Referral</a> </font></b></p>
      <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="manage_web_contents.php" target="mainFrame">Manage 
        Built-in Components</a></b></font></p>
      <p><b><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><a class="InstantLink" href="manage_trial_order.php" target="mainFrame">Manage 
        Trial Order</a></font></b></p>
      <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a class="InstantLink" href="manage_order.php" target="mainFrame">Manage 
        Order </a></font></b></p>
      <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a class="InstantLink" href="manage_billing.php" target="mainFrame">Manage 
        Billing</a> </font></b></p>
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
      <p><b><a class="InstantLink" href="moderate_clients.php" target="mainFrame">Moderate 
        Clients </a></b></p>
      </font>
      <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="ecommerce_control_panel/initialize.php" target="_parent">eCommerce 
        Control Panel</a></b></font></p>
      <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="dbtool/initialize.php" target="_parent">Database 
        Tool </a> </b></font></p>
			<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="manage_sales_associate.php" target="mainFrame">Manage Sales Associates</a> </b></font></p>
      </td>
			<? } else {?>
			<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="sales_associate_data.php" target="mainFrame">Associate Data</a> </b></font></p>
			<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="sales_order.php" target="mainFrame">Online Store Order</a> </b></font></p>
			<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="web_hosting_order.php" target="mainFrame">Website Builder Order</a> </b></font></p>
			<p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b><a class="InstantLink" href="sales_commission.php" target="mainFrame">Sales Commission</a> </b></font></p>
			<? }?>
    <td></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr> 
    <td></td>
    <td></td>
    <td align="right" valign="bottom"><img src="../images/corner-br.gif" width="8" height="8"></td>
  </tr>
</table>
</body>
</html>
