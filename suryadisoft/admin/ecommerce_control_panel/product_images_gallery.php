<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
define("_DB",$HTTP_SESSION_VARS["selected_db"]);
?>
<html>
<head>
<?php
if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	if (isset($Action) && $Action == "Update")
		$query = "SELECT PRODUCT_IMAGES_GALLERY.id AS id, PRODUCT.product_name AS product_name, PRODUCT_IMAGES_GALLERY.product_image_src AS product_image_src FROM PRODUCT_IMAGES_GALLERY, PRODUCT WHERE PRODUCT.product_id = PRODUCT_IMAGES_GALLERY.product_id AND ID = $id";
	else
		$query = "SELECT PRODUCT_IMAGES_GALLERY.id AS id, PRODUCT.product_name AS product_name, PRODUCT_IMAGES_GALLERY.product_image_src AS product_image_src FROM PRODUCT_IMAGES_GALLERY, PRODUCT WHERE PRODUCT.product_id = PRODUCT_IMAGES_GALLERY.product_id ORDER BY PRODUCT.product_name";
	$query_result = mysql_query($query);
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Special Pricing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editProductImagesGallery(id) {
	var url = "product_images_gallery.php?Action=Update&id=" + id;
	open(url,"_self");
}

function deleteProductImagesGallery(id) {
	var url = "product_images_gallery_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function uploadImage(form) {
	var url = "file_upload.php?Action=<? if(isset($Action)) {?><?=$Action?><? }?><? if (isset($Action) && $Action == "Update") {?>&id=<?=id?><? }?>&product_id=" + form.product_id.value + "&file_type=product_images_gallery";
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.product_image_src.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product image source is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p>
<font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Manage Product Images Gallery</strong>
</font> 
</p>
<p align="right">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#special_pricing','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>  
<? if (isset($Action)) {?>
<form action="product_images_gallery_result.php?" method="post" name="productImagesGalleryForm" id="productImagesGalleryForm">
  <input type="hidden" name="Action" value="<?=$Action?>"> 
  <? if ($Action == "Update")
		$rs = mysql_fetch_row($query_result);?>
  <input type="hidden" name="id" value="<? if ($Action == "Update") {?><?=$rs[0]?><? }?>">
	<table cellpadding="5" cellspacing="5">
		<tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Name:</font></td>
      <td> 
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="product_id">
          <? $HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT PRODUCT_ID, PRODUCT_NAME FROM PRODUCT ORDER BY product_name";
					$query_result = mysql_query($query);
					while ($result = mysql_fetch_row($query_result)) {?>
          <option value="<?=$result[0]?>" <? if ($Action == "Update" && $result[1] == $rs[1] || isset($product_id) && $product_id == $result[0]) {?>selected<? }?>> 
          <?=$result[1]?>
          </option>
          <? }
					$HTTP_SESSION_VARS["db_connect"]->close();?>
        </select>
        </font>
			</td>
    </tr>
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Image Src:</font></td>
      <td> 
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="product_image_src" type="text" value="<? if (isset($product_image_src)) {?><?=$product_image_src?><? } else if ($Action == "Update") {?><?=$rs[2]?><? }?>">
        </font> <input name="UploadImageButton" type="button" id="UploadImageButton" value="Upload Image" onClick="uploadImage(this.form)">
        (make sure that your image size is less than 255 pixels x 255 pixels)</td>
    </tr>
  </table>
	<p>&nbsp;</p>
  <p> 
		<input type="submit" name="Submit" value="<?=$Action?> Image" onClick="validateForm(this.form);">
		<input name="Reset" type="reset" id="Reset" value="Reset">
	</p>
</form>
<? } else {?>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="118" nowrap><a href="product_images_gallery.php?Action=Add">New Product Images Gallery</a></td>
  </tr>
</table>
<br>
<center>
<table border="0" cellpadding="8" cellspacing="0">
	<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
    <th bgcolor="#999999"> 
			<font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <strong><?=strtoupper(str_replace("_"," ",$field_name[$i]))?></strong> 
			</font>
		</th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
    <td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"> 
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<?=$rs[$i]?>
      </font>
		</td>
		<? }?>
    <td>
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="Update" type="button" id="Update" value="Edit" onClick="editProductImagesGallery('<?=$rs[0]?>');">
      </font>
		</td>
    <td>
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteProductImagesGallery('<?=$rs[0]?>');">
      </font>
		</td>
	</tr>
	<? }?>
</table>
</center>
<p>
<center>
	<table border="0" align="center" cellpadding="0" cellspacing="0">
		<tr> 
			<td nowrap width="118"><a href="product_images_gallery.php?Action=Add">New Product Images Gallery</a></td>
		</tr>
	</table>
</center>
</p>
<? }?>
</body>
</html>
