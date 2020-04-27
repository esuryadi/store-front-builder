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
<script language="javascript">
<!--
function changeFileType(file_type,form) {
	if (file_type == ";")
		form.filename.value = "export/" + form.Table.value.toLowerCase() + ".txt";
	else if (file_type == ",")
		form.filename.value = "export/" + form.Table.value.toLowerCase() + ".csv";
	else if (file_type == "xml")
		form.filename.value = "export/" + form.Table.value.toLowerCase() + ".xml";
}

function changeFileName(file_name,form) {
	if (form.format.value == ";")
		form.filename.value = "export/" + file_name.toLowerCase() + ".txt";
	else if (form.format.value == ",")
		form.filename.value = "export/" + file_name.toLowerCase() + ".csv";
	else if (form.format.value == "xml")
		form.filename.value = "export/" + file_name.toLowerCase() + ".xml";
}
-->
</script>
<body>
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Export 
  Catalog </strong></font> </p>
<form action="export.php" method="post" enctype="multipart/form-data" name="ExportForm" id="ExportForm">
  <table border="0" cellpadding="5">
    <tr>
      <td align="right"><strong>Catalog:</strong></td>
      <td><select name="Table" id="Table" onChange="changeFileName(this.value,this.form);">
          <option value="PRODUCT" selected>PRODUCT</option>
          <option value="SHIPPING_RATE">SHIPPING</option>
          <option value="CATEGORIES">CATEGORIES</option>
					<option value="CUSTOMER">CUSTOMER</option>
					<option value="TRANSACTION">TRANSACTION</option>
        </select></td>
    </tr>
    <tr> 
      <td align="right"><strong>Filename:</strong> </td>
      <td> <input name="filename" type="text" id="filename" value="export/product.txt"></td>
    </tr>
    <tr> 
      <td align="right"><strong>File Format:</strong></td>
      <td><select name="format" id="format" onChange="changeFileType(this.value,this.form);">
          <option value=";">Semi Colon Separated Value</option>
          <option value=",">Comma Separated Value (*.csv)</option>
					<option value="xml">XML (eXtended Markup Language)</option>
        </select></td>
    </tr>
  </table>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Note:</strong> 
    Character &quot;;&quot; or &quot;,&quot; (depend on what file format you choose) 
    inside your catalog column will be replaced with &quot;~&quot;, so you can 
    open the file in MS-Excel for example in correct number of columns.</font></p>
  <p align="center"> 
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
</body>
</html>
