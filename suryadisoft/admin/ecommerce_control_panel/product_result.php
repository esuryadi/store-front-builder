<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once("../config.php");

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

if ($Action == "Add")
	$query[] = "INSERT INTO PRODUCT (product_name,product_description,product_isbn,product_quantity,product_retail_price,product_price,product_image_small,product_image_medium,product_image_large,product_main_category,product_sub_category_1,product_sub_category_2,product_other_category,product_condition,product_color_choices,product_size_choices,product_other_choices,product_weight,product_length,product_width,product_height,related_products) VALUES ('$product_name','$product_description','$product_isbn','$product_quantity','$product_retail_price','$product_price','$product_image_small','$product_image_medium','$product_image_large','$product_main_category','$product_sub_category_1','$product_sub_category_2','$product_other_category','$product_condition','$product_color_choices','$product_size_choices','$product_other_choices',$product_weight,'$product_length','$product_width','$product_height','$related_products')";
else if ($Action == "Update")
	$query[] = "UPDATE PRODUCT SET product_name = '$product_name', product_description = '$product_description', product_isbn = '$product_isbn', product_quantity = $product_quantity, product_retail_price = '$product_retail_price', product_price = $product_price, product_image_small = '$product_image_small', product_image_medium = '$product_image_medium', product_image_large = '$product_image_large', product_main_category = '$product_main_category', product_sub_category_1 = '$product_sub_category_1', product_sub_category_2 = '$product_sub_category_2', product_other_category = '$product_other_category', product_condition = '$product_condition', product_color_choices = '$product_color_choices', product_size_choices = '$product_size_choices', product_other_choices = '$product_other_choices', product_weight = $product_weight, product_length = '$product_length', product_width = '$product_width', product_height = '$product_height', related_products = '$related_products' WHERE product_id = '$product_id'";
else if ($Action == "Delete") {
	for ($i=0;$i<count($id);$i++)
		$query[] = "DELETE FROM PRODUCT WHERE product_id = $id[$i]";
}

for ($i=0;$i<count($query);$i++) {
	$isSuccess = mysql_query($query[$i]);
	Log::write($query . "\n\n");
	if(!$isSuccess) {
		print("<h1>Data cannot be " . $Action . "d!</h1><p>\n");
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		print("<p>");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>
<?=$Action?>
Product Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
	<? if (isset($Mode) && $Mode == "wizard") {?>
	<!meta http-equiv="refresh" content="0;URL=product.php?Action=<?=$Action?>&Mode=<?=$Mode?>&page_name=<?=$page_name?>&comp_type=<?=$comp_type?>&page_category=<?=$page_category?>&main_category=<?=$main_category?>">
	<script language="javascript">
	<!--
		window.close();
	-->
	</script>
	<? } else {?>
	<script language="javascript">
	<!--
	if (window.opener != null)
		window.close();
	else
		window.open("product_frame.php","_self");
	-->
	</script>
	<? }?>
<? }?>
</head>

<body vlink="00aeef">

</body>
</html>
