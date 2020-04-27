<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
  Transaction</font></strong></font></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center" nowrap>
			<form name="displayForm" method="post" action="transaction.php" target="leftFrame">
			<strong>DISPLAY:</strong> 
      <input type="radio" name="display_option" value="all">
      <font size="-2">All</font> 
      <input name="display_option" type="radio" value="some" checked> 
        <input name="num_of_transactions" type="text" id="num_of_transactions" value="50" size="2">
        <font size="-2">Transactions</font>&nbsp;&nbsp; <strong>SORT BY: </strong> 
        <input name="sort_by" type="radio" value="date" checked>
        <font size="-2">Date</font> 
        <input name="sort_by" type="radio" value="status">
        <font size="-2">Status</font> 
        <input type="radio" name="sort_by" value="charge">
        <font size="-2">Charge</font> 
        <input name="sort_order" type="radio" value="asc">
      <font size="-2">asc</font> 
        <input name="sort_order" type="radio" value="desc" checked>
        <font size="-2">desc&nbsp;&nbsp;</font> <strong> Name:</strong> 
        <input name="name" type="text" id="name" size="10"> 
      <input type="submit" name="Button" value="Go">
			</form>
		</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
