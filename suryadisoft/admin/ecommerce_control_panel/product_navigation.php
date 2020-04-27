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
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
  Product/Inventory</strong></font></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center" nowrap>
			<form name="displayForm" method="post" action="product.php" target="leftFrame">
			<strong>DISPLAY:</strong> 
      <input type="radio" name="display_option" value="all">
      <font size="-2">All</font> 
      <input name="display_option" type="radio" value="some" checked> 
      <input name="num_of_products" type="text" id="num_of_products" value="50" size="2">
        <font size="-2">Products</font>&nbsp;&nbsp; <strong>SORT BY: </strong> 
        <input type="radio" name="sort_by" value="id">
      <font size="-2">ID</font> 
        <input name="sort_by" type="radio" value="name" checked>
      <font size="-2">Name</font> 
        <input type="radio" name="sort_by" value="price">
      <font size="-2">Price</font> 
      <input name="sort_order" type="radio" value="asc" checked>
      <font size="-2">asc</font> 
      <input type="radio" name="sort_order" value="desc">
        <font size="-2">desc&nbsp;&nbsp;</font> <strong>KEYWORDS:</strong> 
        <input name="keywords" type="text" id="keywords" size="10"> 
      <input type="submit" name="Button" value="Go">
			</form>
		</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
