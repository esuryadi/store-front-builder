<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Admin.php";
require_once("config.php");

$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT COUNT(*) AS total_sales, SUM(monthly_fee) AS total_commission FROM BILLING WHERE sales_id = '" . $HTTP_SESSION_VARS["admin_user"]->getUserId() . "' GROUP BY monthly_fee";	
$query_result = mysql_query($query);
$rs = mysql_fetch_array($query_result);

$query2 = "SELECT COUNT(*) AS total_sales, SUM(recurring_monthly_fee) AS total_commission FROM WEB_HOSTING_ORDER WHERE sales_id = '" . $HTTP_SESSION_VARS["admin_user"]->getUserId() . "' GROUP BY recurring_monthly_fee";	
$query_result2 = mysql_query($query2);
$rs2 = mysql_fetch_array($query_result2);

$db_connect->close();
?>
<html>
<head>
<title>Billing Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: smaller;
}
-->
</style>
</head>



<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Sales Commission</strong></font> 
<blockquote> 
  <table border="0" cellspacing="0" cellpadding="5">
    <tr> 
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><strong>Online Store Builder</strong></td>
      <td bgcolor="#CCCCCC"><strong>Website Builder</strong></td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <td><b>Total Sales:</b></td>
      <td align="right"> 
        <?=$rs["total_sales"]?>
      </td>
      <td align="right"> 
        <?=$rs2["total_sales"]?>
      </td>
    </tr>
    <tr bgcolor="#FFFFCC"> 
      <td><strong>Total Sales Revenue:</strong></td>
      <td align="right">$<? printf("%01.2f",$rs["total_commission"]/2);?>/month</td>
      <td align="right">$<? printf("%01.2f",$rs2["total_commission"]/2);?>/month</td>
    </tr>
    <tr bgcolor="#FFFF00"> 
      <td><b>Your Monthly Commissions:</b></td>
      <td colspan="2" align="right">$<? printf("%01.2f",($rs["total_commission"] + $rs2["total_commission"])/2);?>/month</td>
    </tr>
  </table>
  <p>&nbsp; </p>
</blockquote>    
</body>
</html>
