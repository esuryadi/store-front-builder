<?php
require_once "../config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Import 
  Catalog </strong></font> </p>
<form action="import.php" method="post" enctype="multipart/form-data" name="ExportForm" id="ExportForm">
  <table border="0" cellpadding="5">
    <tr> 
      <td align="right"><strong>Catalog:</strong></td>
      <td><select name="Table" id="Table" onChange="window.open('import_form.php?Table=' + this.value,'_self');">
          <option value="PRODUCT" <? if (!isset($Table) || (isset($Table) && $Table == "PRODUCT")) {?>selected<? }?>>PRODUCT</option>
          <option value="SHIPPING_RATE" <? if (isset($Table) && $Table == "SHIPPING_RATE") {?>selected<? }?>>SHIPPING</option>
          <option value="CATEGORIES" <? if (isset($Table) && $Table == "CATEGORIES") {?>selected<? }?>>CATEGORIES</option>
        </select></td>
    </tr>
    <tr> 
      <td align="right"><strong>Filename:</strong> </td>
      <td> <input name="filename" type="file" id="filename" size="40"></td>
    </tr>
    <tr> 
      <td align="right"><strong>File Format:</strong></td>
      <td><select name="format" id="format">
          <option value=";">Semi Colon Separated Value</option>
          <option value=",">Comma Separated Value (*.csv)</option>
          <option value="\t">Tab Delimited</option>
		  <option value="xml">XML</option>
        </select></td>
    </tr>
    <tr align="left"> 
      <td colspan="2"><input name="overwrite" type="checkbox" id="overwrite" value="yes">
        Delete all current data and replace with the new one (<strong>This Action 
        is irreversible! Please be careful!</strong>)</td>
    </tr>
	<? if (!isset($Table) || (isset($Table) && $Table == "PRODUCT")) {?>
	<tr align="left"> 
      <td colspan="2"><input name="include_id" type="checkbox" id="include_id" value="yes" onClick="window.open('import_form.php?Table=PRODUCT&include_id=' + this.checked,'_self');" <? if (isset($include_id) && $include_id == "true") {?>checked<? }?>>
        Include Product ID (<strong>Product ID must be unique if you check this option!</strong>)</td>
    </tr>
	<? }?>
  </table>
  <p align="center"> 
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
<p><strong>Important Notes:</strong></p>
<blockquote> 
  <? if (!isset($Table) || (isset($Table) && $Table == "PRODUCT")) {?>
	<p>Make sure that your product catalog contains the following column and in 
    the following order<? if (!isset($include_id) || (isset($include_id) && $include_id == "false")) {?> (Please remove the product id column if your file contains 
    one)<? }?>:</p>
  <ul>
  	<? if (isset($include_id) && $include_id == "true") {?>
	<li>product_id</li>
	<? }?>
    <li>product_name</li>
    <li>product_description</li>
    <li>product_isbn</li>
    <li>product_quantity</li>
    <li>product_retail_price</li>
    <li>product_price</li>
    <li>product_image_small</li>
    <li>product_image_medium</li>
    <li>product_image_large</li>
    <li>product_main_category</li>
    <li>product_sub_category_1</li>
    <li>product_sub_category_2</li>
    <li>product_other_category</li>
    <li>product_condition</li>
    <li>product_color_choices</li>
    <li>product_size_choices</li>
    <li>product_other_choices</li>
    <li>product_weight</li>
    <li>product_length</li>
    <li>product_width</li>
    <li>product_height</li>
    <li>related_products</li>
  </ul>
	<? } else if (isset($Table) && $Table == "SHIPPING_RATE") {?>
  <p>Make sure that your shipping catalog contains the following column and in 
    the following order (Please remove the shipping id column if your file contains 
    one):</p>
  <ul>
    <li>product_id</li>
    <li>shipping_vendor</li>
    <li>shipping_method</li>
    <li>one_item_rate</li>
    <li>additional_item_rate</li>
    <li>state</li>
		<li>city</li>
		<li>zip</li>
    <li>country</li>
  </ul>
	<? } else if (isset($Table) && $Table == "CATEGORIES") {?>
  <p>Make sure that your categories catalog contains the following column and 
    in the following order (Please remove the categories id column if your file 
    contains one):</p>
  <ul>
    <li>categories_main</li>
    <li>categories_sub_1</li>
    <li>categories_sub_2</li>
  </ul>
	<? }?>
</blockquote>
</body>
</html>
