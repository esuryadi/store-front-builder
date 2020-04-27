<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript">
<!--
function addNewProduct() {
	open('product.php?Action=Add','_parent');
}
function deleteProduct() {
	window.parent.frames[1].deleteProduct();
}
-->
</script>
<body>
<div align="center">
  <input type="button" name="Button" value="Add New Product" onClick="addNewProduct();">
  <input type="button" name="Button2" value="Delete Product" onClick="deleteProduct();">
  <input type="button" name="Button" value="Help" onClick="window.open('help/help.htm?#products','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</div>
</body>
</html>
