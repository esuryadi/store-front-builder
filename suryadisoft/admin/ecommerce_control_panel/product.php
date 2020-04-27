<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Admin.php";
require_once("../config.php");
include "../ewebwp/ewebwp.php";
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
	
	mysql_select_db(_ADMIN_DATABASE);
	$query = "SELECT USER_ID FROM CLIENT_DATABASE WHERE DATABASE_NAME = '" . $HTTP_SESSION_VARS["selected_db"] . "'";
	$rs = mysql_fetch_row(mysql_query($query));
	$userid = $rs[0];
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	if (isset($display_option) && $display_option == "some")
		$limit = "LIMIT $num_of_products";
	else if (isset($display_option) && $display_option == "all")
		$limit = "";
	else
		$limit = "LIMIT 50";
	
	if (isset($sort_by) && $sort_by == "id")
		$sort_by = "product_id";
	else if (isset($sort_by) && $sort_by == "price")
		$sort_by = "product_price";
	else
		$sort_by = "product_name";
	
	if (isset($sort_order) && $sort_order == "desc")
		$sort_order = "DESC";
	else
		$sort_order = "";
		
	if (isset($keywords) && $keywords != "")
		$where = "WHERE product_name LIKE '%$keywords%'";
	else
		$where = "";
	
	if (isset($Action) && $Action == "Update")
		$query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
	else if ((isset($Action) && $Action == "Add") || isset($refresh_cat))
		$query = "SELECT * FROM PRODUCT";
	else
		$query = "SELECT product_id, product_name, product_quantity, product_price FROM PRODUCT $where ORDER BY $sort_by $sort_order $limit";	
	$query_result = mysql_query($query);
	
	if (!isset($refresh_cat))
		$refresh_cat = "false";
		
	if (isset($Action) && $Action == "Update") {
		$rs = mysql_fetch_row($query_result);
		if ($refresh_cat == "false") {
			$product_main_category = $rs[10];
			$product_sub_category_1 = $rs[11];
		}
	}
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$query2 = "SELECT categories_main FROM CATEGORIES GROUP BY categories_main";
	$query_result2 = mysql_query($query2);
	$main_categories = Array();
	while ($rs2 = mysql_fetch_row($query_result2))
		if (trim($rs2[0]) != "")
			$main_categories [] = $rs2[0];
	
	if (isset($product_main_category))
		$main_cat = $product_main_category;
	else if (isset($main_categories[0]))
		$main_cat = $main_categories[0];
	else
		$main_cat = "Home";
			
	$query3 = "SELECT categories_sub_1 FROM CATEGORIES WHERE categories_main = '$main_cat' GROUP BY categories_sub_1";
	$query_result3 = mysql_query($query3);
	$sub_categories_1 = Array();
	while ($rs3 = mysql_fetch_row($query_result3)) {
		if (trim($rs3[0]) != "")
			$sub_categories_1 [] = $rs3[0];
	}
		
	if (isset($product_sub_category_1))
		$sub_cat = $product_sub_category_1;
	else if (count($sub_categories_1) > 0)
		$sub_cat = $sub_categories_1[0];
	else
		$sub_cat = "";
		
	$query4 = "SELECT categories_sub_2 FROM CATEGORIES WHERE categories_main = '$main_cat' AND categories_sub_1 = '$sub_cat'";
	$query_result4 = mysql_query($query4);
	$sub_categories_2 = Array();
	while ($rs4 = mysql_fetch_row($query_result4))
		if (trim($rs4[0]) != "")
			$sub_categories_2 [] = $rs4[0];
			
	$query5 = "SELECT categories_main FROM CATEGORIES GROUP BY categories_main";
	$query_result5 = mysql_query($query5);
	$categories = Array();
	while ($rs5 = mysql_fetch_row($query_result5))
		if (trim($rs5[0]) != "")
			$categories [] = $rs5[0];
			
	$query6 = "SELECT categories_sub_1 FROM CATEGORIES GROUP BY categories_sub_1";
	$query_result6 = mysql_query($query6);
	while ($rs6 = mysql_fetch_row($query_result6))
		if (trim($rs6[0]) != "")
			$categories [] = $rs6[0];
			
	$query7 = "SELECT categories_sub_2 FROM CATEGORIES GROUP BY categories_sub_2";
	$query_result7 = mysql_query($query7);
	while ($rs7 = mysql_fetch_row($query_result7))
		if (trim($rs7[0]) != "")
			$categories [] = $rs7[0];
		
	$query8 = "SELECT product_id, product_name FROM PRODUCT ORDER BY product_name";
	$query_result8 = mysql_query($query8);
	$products = Array();
	while ($rs8 = mysql_fetch_row($query_result8)) {
		if (trim($rs8[0]) != "") {
			$product ["id"] = $rs8[0];
			$product ["name"] = $rs8[1];
			$item[$rs8[0]] = $rs8[1];
			$products[] = $product;
		}
	}
			
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Product/Inventory</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editProduct(id) {
	var url = "product.php?Action=Update&product_id=" + id;
	open(url,"_parent");
}

function deleteProduct() {
	document.deleteProductForm.submit();
}

function refreshCategory(form) {
	form.action="product.php?refresh_cat=true#cat";
	form.method="POST";
	form.submit();
}

function uploadImage(form,img_size) {
	form.action = "file_upload.php?file_type=product_image&page=product&img_size=" + img_size;
	form.method = "POST";
	form.submit();
}

function addCategory(form) {
	form.selected_categories.options[form.selected_categories.length] = new Option(form.categories.options[form.categories.selectedIndex].value);
	if (form.product_other_category.value == "")
		form.product_other_category.value = form.categories.options[form.categories.selectedIndex].value;
	else
		form.product_other_category.value = form.product_other_category.value + "," + form.categories.options[form.categories.selectedIndex].value;
}

function deleteCategory(form) {
	form.selected_categories.options[form.selected_categories.selectedIndex] = null;
	form.product_other_category.value = "";
	for(i=0;i<form.selected_categories.length;i++) {
		if (i == 0)
			form.product_other_category.value = form.selected_categories.options[i].value;
		else
			form.product_other_category.value = form.product_other_category.value + "," + form.selected_categories.options[i].value;
	}
}

function addItem(form) {
	form.selected_related_products.options[form.selected_related_products.length] = new Option(form.products.options[form.products.selectedIndex].text,form.products.options[form.products.selectedIndex].value);
	if (form.related_products.value == "")
		form.related_products.value = form.products.options[form.products.selectedIndex].value;
	else
		form.related_products.value = form.related_products.value + "," + form.products.options[form.products.selectedIndex].value;
}

function deleteItem(form) {
	form.selected_related_products.options[form.selected_related_products.selectedIndex] = null;
	form.related_products.value = "";
	for(i=0;i<form.selected_related_products.length;i++) {
		if (i == 0)
			form.related_products.value = form.selected_related_products.options[i].value;
		else
			form.related_products.value = form.related_products.value + "," + form.selected_related_products.options[i].value;
	}
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.product_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product Name is required\n";
	}

	if (form.product_quantity.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product Quantity is required\n";
	}
	if (form.product_price.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product Price is required\n";
	}
	if (form.product_weight.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product Weight is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}

</script>
</head>

<body vlink="00aeef">
<p>
  <? if (isset($Action)) {?>
</p>
<form action="product_result.php?" method="post" name="userForm" id="userForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
	<? if (isset($Mode) && $Mode == "wizard") {?>
	<input type="hidden" name="Mode" value="<?=$Mode?>">
	<input type="hidden" name="page_name" value="<?=$page_name?>">
	<input type="hidden" name="comp_type" value="<?=$comp_type?>">
	<input type="hidden" name="page_category" value="<?=$page_category?>">
	<input type="hidden" name="main_category" value="<?=$main_category?>">
	<? }?>
  <table cellpadding="5" cellspacing="5">
    <? for($i=0;$i<count($field_name);$i++) {?>
    <tr> 
      <? 
			if ($refresh_cat == "true") {
				eval("\$value = \"\$" . $field_name[$i] . "\";");
				$field_value = $value;
			} 
			?>
      <? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" valign="top" nowrap> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <? if ($field_name[$i] == "product_isbn") {?>
				Catalog No
				<? } else {?>
				<?=ucwords(str_replace("_"," ",$field_name[$i]))?>
				<? }?>
        :</font></td>
      <td valign="top"> 
        <? if ($field_name[$i] == "product_condition") {?>
					<? if (isset($comp_type) && $comp_type == "New Items") {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="New">New
					<? } else if (isset($comp_type) && $comp_type == "Used Items") {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="Used">Used
					<? } else if (isset($comp_type) && $comp_type == "Refurbished Items") {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="Refurbished">Refurbished
					<? } else {?>
					<select name="<?=$field_name[$i]?>">
						<option value="New" <? if (($refresh_cat == "true" && $field_value == "New") || ($Action == "Update" && $rs[$i] == "New")) {?>SELECTED<? }?>>New</option>
						<option value="Used" <? if (($refresh_cat == "true" && $field_value == "Used") || ($Action == "Update" && $rs[$i] == "Used")) {?>SELECTED<? }?>>Used</option>
						<option value="Refurbished" <? if (($refresh_cat == "true" && $field_value == "Refurbished") || ($Action == "Update" && $rs[$i] == "Refurbished")) {?>SELECTED<? }?>>Refurbished</option>
					</select> 
					<? }?>
        <? } else if ($field_name[$i] == "product_main_category") {?>
					<? if (isset($page_name) && $page_name == "ALL") $page_name = "Home";?>
					<? if (isset($page_name) && $page_category == "main") {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<?=urldecode($page_name)?>"><?=urldecode($page_name)?>
					<? } else if (isset($page_name) && $page_category == "sub") {?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<?=urldecode($main_category)?>"><?=urldecode($main_category)?>
					<? } else {?>
					<a name="cat"></a> <select name="<?=$field_name[$i]?>" onChange="refreshCategory(this.form);">
						<option value="">Select Main Category</option>
						<? for ($n=0;$n<count($main_categories);$n++) {?>
						<option value='<?=$main_categories[$n]?>' <? if ($refresh_cat == "true" && stripslashes($product_main_category) == $main_categories[$n]) {?>SELECTED<? } else if ($Action == "Update" && $rs[$i] == $main_categories[$n] && $refresh_cat == "false") {?>SELECTED<? }?>>
						<?=$main_categories[$n]?>
						</option>
						<? }?>
					</select> 
					<? }?>
        <? } else if ($field_name[$i] == "product_sub_category_1") {?>
					<? if (isset($page_name) && $page_category == "sub") {?>
						<input type="hidden" name="<?=$field_name[$i]?>" value="<?=urldecode($page_name)?>"><?=urldecode($page_name)?>
					<? } else {?>
						<? if (isset($Mode) && $Mode == "wizard") {?>
						<input type="hidden" name="<?=$field_name[$i]?>" value="">None
						<? } else {?>
						<select name="<?=$field_name[$i]?>" onChange="refreshCategory(this.form);">
							<option value="">Select Sub Category 1</option>
							<? for ($n=0;$n<count($sub_categories_1);$n++) {?>
							<option value='<?=$sub_categories_1[$n]?>' <? if ($refresh_cat == "true" && stripslashes($product_sub_category_1) == $sub_categories_1[$n]) {?>SELECTED<? } else if ($Action == "Update" && $rs[$i] == $sub_categories_1[$n] && $refresh_cat == "false") {?>SELECTED<? }?>>
							<?=$sub_categories_1[$n]?>
							</option>
							<? }?>
						</select>
						<? }?>
					<? }?> 
        <? } else if ($field_name[$i] == "product_sub_category_2") {?>
					<? if (isset($Mode) && $Mode == "wizard") {?>
						<input type="hidden" name="<?=$field_name[$i]?>" value="">None
					<? } else {?>
					<select name="<?=$field_name[$i]?>">
						<option value="">Select Sub Category 2</option>
						<? for ($n=0;$n<count($sub_categories_2);$n++) {?>
						<option value='<?=$sub_categories_2[$n]?>' <? if ($refresh_cat == "true" && stripslashes($product_sub_category_2) == $sub_categories_2[$n]) {?>SELECTED<? } else if ($Action == "Update" && $rs[$i] == $sub_categories_2[$n] && $refresh_cat == "false") {?>SELECTED<? }?>>
						<?=$sub_categories_2[$n]?>
						</option>
						<? }?>
					</select> 
					<? }?>
				<? } else if ($field_name[$i] == "product_other_category") {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
				<table>
				<tr>
					<td>
					<select name="categories" size="8">
					<? for ($n=0;$n<count($categories);$n++) {?>
					<option value="<?=$categories[$n]?>"><?=$categories[$n]?></option>
					<? }?>
          </select>
					</td>
					<td align="center">
					<input type="button" name="addButton" value="Add>>" onClick="addCategory(this.form);"><p>
					<input type="button" name="delButton" value="<<Remove" onClick="deleteCategory(this.form);">
					</td>
					<td>
					<select name="selected_categories" size="8">
					<? if ($Action == "Update" || $refresh_cat == "true") {?>
					<? if ($refresh_cat == "true")
							$selected_categories = explode(",",stripslashes($product_other_category));
						 else if ($Action == "Update")
						 	$selected_categories = explode(",",$rs[$i]);?>
					<? for ($n=0;$n<count($selected_categories);$n++) {?>
					<? if ($selected_categories[$n] != "") {?>
					<option value="<?=$selected_categories[$n]?>"><?=$selected_categories[$n]?></option>
					<? }?>
					<? }?>
					<? }?>
          </select>
					</td>
				</tr>
				</table>
				<? } else if ($field_name[$i] == "related_products") {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
				<table>
				<tr>
					<td>
					<select name="products" size="8">
					<? for ($n=0;$n<count($products);$n++) {?>
					<? $prod = $products[$n];?>
					<option value="<?=$prod["id"]?>"><?=$prod["name"]?></option>
					<? }?>
          </select>
					</td>
					<td align="center">
					<input type="button" name="addButton" value="Add>>" onClick="addItem(this.form);"><p>
					<input type="button" name="delButton" value="<<Remove" onClick="deleteItem(this.form);">
					</td>
					<td>
					<select name="selected_related_products" size="8">
					<? if ($Action == "Update" || $refresh_cat == "true") {?>
					<? $selected_related_products = Array();
						 if ($refresh_cat == "true")
							$selected_related_products = explode(",",stripslashes($related_products));
						 else if ($Action == "Update")
						 	$selected_related_products = explode(",",$rs[$i]);?>
					<? for ($n=0;$n<count($selected_related_products);$n++) {?>
					<? if ($selected_related_products[$n] != "") {?>
					<option value="<?=$selected_related_products[$n]?>"><?=$item[$selected_related_products[$n]]?></option>
					<? }?>
					<? }?>
					<? }?>
          </select>
					</td>
				</tr>
				</table>
        <? } else if ($field_name[$i] == "product_description") {?>
        <textarea name="<?=$field_name[$i]?>" cols="50" rows="10"><? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=stripslashes($rs[$i])?><? }?></textarea><br><script language="JavaScript">eWebWP.createButton("btnTest","<?=$field_name[$i]?>");</script> --> Click this button to launch HTML Editor
        <? } else if ($field_name[$i] == "product_color_choices") {?>
        <textarea name="<?=$field_name[$i]?>" cols="30" rows="5"><? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=stripslashes($rs[$i])?><? }?></textarea> 
        <? } else if ($field_name[$i] == "product_size_choices") {?>
        <textarea name="<?=$field_name[$i]?>" cols="30" rows="5"><? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=stripslashes($rs[$i])?><? }?></textarea> 
        <? } else if ($field_name[$i] == "product_other_choices") {?>
        <textarea name="<?=$field_name[$i]?>" cols="30" rows="5"><? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=stripslashes($rs[$i])?><? }?></textarea> 
        <? } else {?>
        <input name="<?=$field_name[$i]?>" type="text" value="<? if ($refresh_cat == "true") {?><?=stripslashes($field_value)?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? } else if ($field_name[$i] == "product_weight" || $field_name[$i] == "product_quantity" || $field_name[$i] == "product_price") {?>0<? }?>" <? if ($field_name[$i] == "product_name") {?>size="65"<? } else if ($field_name[$i] == "product_weight" || $field_name[$i] == "product_length" || $field_name[$i] == "product_width" || $field_name[$i] == "product_height") {?>size="1"<? }?>> 
        <? }?>
        <? if ($field_name[$i] == "product_image_small") {?>
        <input name="UploadButton" type="button" value="Upload Image" onClick="uploadImage(this.form,'<?=$field_name[$i]?>');">
        (75 pixels x 75 pixels) 
        <? } else if ($field_name[$i] == "product_image_medium") {?>
        <input name="UploadButton" type="button" value="Upload Image" onClick="uploadImage(this.form,'<?=$field_name[$i]?>');">
        (255 pixels x 255 pixels) 
        <? } else if ($field_name[$i] == "product_image_large") {?>
        <input name="UploadButton" type="button" value="Upload Image" onClick="uploadImage(this.form,'<?=$field_name[$i]?>');"> 
        <? } else if ($field_name[$i] == "product_color_choices") {?>
        <p>(each color is separated by comma, e.g. blue,red,green)</p>
        <? } else if ($field_name[$i] == "product_size_choices") {?>
        <p>(each size is separated by comma, e.g. small,large,extra large)</p>
        <? } else if ($field_name[$i] == "product_other_choices") {?>
        <p>(each choices is separated by comma, e.g. vanilla,jasmine,blueberry)</p>
        <? } else if ($field_name[$i] == "product_weight") {?>
        lbs. 
        <? } else if ($field_name[$i] == "product_length" || $field_name[$i] == "product_width" || $field_name[$i] == "product_height") {?>
        inches. 
        <? }?>
        <? if (substr($field_name[$i],0,13) == "product_image") {?>
        (e.g. images/product/myproduct.jpg) 
        <? }?>
      </td>
      <? } else {?>
      <input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($refresh_cat == "true") {?><?=$field_value?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
      <? }?>
    </tr>
    <? if ($refresh_cat == "true") session_unregister($field_name[$i]);?>
    <? }?>
    <? 
			if ($Action == "Update" || $refresh_cat == "true") {
				if ($refresh_cat == "false") {
					$HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query1 = "SELECT * FROM FEATURE_PRODUCT WHERE PRODUCT_ID = $rs[0]";
					$query2 = "SELECT * FROM NEW_RELEASE_PRODUCT WHERE PRODUCT_ID = $rs[0]";
					$query3 = "SELECT * FROM SALE_PRODUCT WHERE PRODUCT_ID = $rs[0]";
					$query_result1 = mysql_query($query1);
					$query_result2 = mysql_query($query2);
					$query_result3 = mysql_query($query3);
					$HTTP_SESSION_VARS["db_connect"]->close();
				}
			}
			?>
  </table>
  <p align="center"> 
			<input type="submit" name="Submit" value="<?=$Action?> Product" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
			<? if (isset($Mode) && $Mode == "wizard") {?>
      <input type="button" name="Submit2" value="Close Window" onClick="window.close();">
			<? }?>
		</p>
	</form>
<? } else {?>
<p align="center">
<form name="deleteProductForm" method="post" action="product_result.php" target="_parent">
<input type="hidden" name="Action" value="Delete">
<table border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
		<th>&nbsp;</th>
    <? for($i=0;$i<count($field_name);$i++) {?>
    <? if ($i != 0) {?>
		<th bgcolor="#999999"> <font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<?=ucwords(str_replace("_"," ",$field_name[$i]))?>
      </font> </th>
		<? }?>
    <? }?>
  </tr>
  <? for($n=0;$rs = mysql_fetch_row($query_result);$n++) { if ($n == 0) $id = $rs[0];?>
  <tr> 
		<td><input name="id[]" type="checkbox" value="<?=$rs[0]?>"></td>
    <? for($i=0;$i<count($rs);$i++) {?>
		<? if ($i != 0) {?>
    <td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>" valign="top"> 
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <? if ($field_name[$i] == "product_name") {?>
      <a href="product_info.php?product_id=<?=$rs[0]?>" target="rightFrame">
      <?=$rs[$i]?>
      </a> 
      <? } else {?>
      <? if ($field_name[$i] == "product_price") {?>$<? }?><?=$rs[$i]?>
      <? }?>
      </font> </td>
    <? }?>
		<? }?>
    <td valign="top"> <input name="Update" type="button" id="Update" value="Edit" onClick="editProduct('<?=$rs[0]?>');"></td>
  </tr>
  <? }?>
</table>
</form>
<script language="JavaScript">
<!--
open("product_info.php?product_id=<?=$id?>","rightFrame");
-->
</script>
<? }?>
</body>
</html>

