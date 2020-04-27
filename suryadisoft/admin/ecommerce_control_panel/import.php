<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/XML.php";
require_once "../config.php";

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

$file = fopen($HTTP_POST_FILES['filename']['tmp_name'],"r");
if (isset($overwrite) && $overwrite == "yes") {
	if ($Table == "PRODUCT") {
		$query = "DELETE FROM PRODUCT";
		mysql_query($query) or die(mysql_error());
	} else if ($Table == "SHIPPING") {
		$query = "DELETE FROM SHIPPING";
		mysql_query($query);
	} else if ($Table == "CATEGORIES") {
		$query = "DELETE FROM CATEGORIES";
		mysql_query($query);
	}
}
if ($format == "xml") {
	$xml = new XML();
	$xml->parseXMLFile ($file, filesize($HTTP_POST_FILES['filename']['tmp_name']), $Table);
	$data = $xml->getData();
	for ($i=0;$i<count($data);$i++) {
		$rs = $data[$i];
		if ($Table == "PRODUCT") {
			$num_rows = mysql_num_rows(mysql_query("SELECT * FROM PRODUCT WHERE product_name = '" . $rs["product_name"] . "'"));			
			echo $include_id;
			if ($num_rows == 0) {
				if (isset($include_id) && $include_id == "yes")
					$query = "INSERT INTO PRODUCT (product_id,product_name,product_description,product_isbn,product_quantity,product_retail_price,product_price,product_image_small,product_image_medium,product_image_large,product_main_category,product_sub_category_1,product_sub_category_2,product_other_category,product_condition,product_color_choices,product_size_choices,product_other_choices,product_weight,product_length,product_width,product_height,related_products) " .
							 "VALUES ('" . $rs["product_id"] . "','" .$rs["product_name"] . "','" . $rs["product_description"] . "','" . $rs["product_isbn"] . "','" . $rs["product_quantity"] . "','" . $rs["product_retail_price"] . "','" . $rs["product_price"] . "','" . $rs["product_image_small"] . "','" . $rs["product_image_medium"] . "','" . $rs["product_image_large"] . "','" . $rs["product_main_category"] . "','" . $rs["product_sub_category_1"] . "','" . $rs["product_sub_category_2"] . "','" . $rs["product_other_category"] . "','" . $rs["product_condition"] . "','" . $rs["product_color_choices"] . "','" . $rs["product_size_choices"] . "','" . $rs["product_other_choices"] . "','" . $rs["product_weight"] . "','" . $rs["product_length"] . "','" . $rs["product_width"] . "','" . $rs["product_height"] . "','" . $rs["related_products"] . "')";				
				else 
					$query = "INSERT INTO PRODUCT (product_name,product_description,product_isbn,product_quantity,product_retail_price,product_price,product_image_small,product_image_medium,product_image_large,product_main_category,product_sub_category_1,product_sub_category_2,product_other_category,product_condition,product_color_choices,product_size_choices,product_other_choices,product_weight,product_length,product_width,product_height,related_products) " .
							 "VALUES ('" . $rs["product_name"] . "','" . $rs["product_description"] . "','" . $rs["product_isbn"] . "','" . $rs["product_quantity"] . "','" . $rs["product_retail_price"] . "','" . $rs["product_price"] . "','" . $rs["product_image_small"] . "','" . $rs["product_image_medium"] . "','" . $rs["product_image_large"] . "','" . $rs["product_main_category"] . "','" . $rs["product_sub_category_1"] . "','" . $rs["product_sub_category_2"] . "','" . $rs["product_other_category"] . "','" . $rs["product_condition"] . "','" . $rs["product_color_choices"] . "','" . $rs["product_size_choices"] . "','" . $rs["product_other_choices"] . "','" . $rs["product_weight"] . "','" . $rs["product_length"] . "','" . $rs["product_width"] . "','" . $rs["product_height"] . "','" . $rs["related_products"] . "')";				
			} else {
				if (isset($include_id) && $include_id == "yes")
					$query = "UPDATE PRODUCT SET product_id = '" . $rs["product_id"] .
							 "',product_name = '" . $rs["product_name"] . 
							 "',product_description = '" . $rs["product_description"] . 
							 "',product_isbn = '" . $rs["product_isbn"] . 
							 "',product_quantity = '" . $rs["product_quantity"] . 
							 "',product_retail_price = '" . $rs["product_retail_price"] . 
							 "',product_price = '" . $rs["product_price"] . 
							 "',product_image_small = '" . $rs["product_image_small"] . 
							 "',product_image_medium = '" . $rs["product_image_medium"] . 
							 "',product_image_large = '" . $rs["product_image_large"] . 
							 "',product_main_category = '" . $rs["product_main_category"] . 
							 "',product_sub_category_1 = '" . $rs["product_sub_category_1"] . 
							 "',product_sub_category_2 = '" . $rs["product_sub_category_2"] . 
							 "',product_other_category = '" . $rs["product_other_category"] . 
							 "',product_condition = '" . $rs["product_condition"] . 
							 "',product_color_choices = '" . $rs["product_color_choices"] . 
							 "',product_size_choices = '" . $rs["product_size_choices"] . 
							 "',product_other_choices = '" . $rs["product_other_choices"] . 
							 "',product_weight = '" . $rs["product_weight"] . 
							 "',product_length = '" . $rs["product_length"] . 
							 "',product_width = '" . $rs["product_width"] . 
							 "',product_height = '" . $rs["product_height"] . 
							 "',related_products = '" . $rs["related_products"] . 
							 "' WHERE product_name = '" . $rs["product_name"] . "'";
				else
					$query = "UPDATE PRODUCT SET product_name = '" . $rs["product_name"] . 
							 "',product_description = '" . $rs["product_description"] . 
							 "',product_isbn = '" . $rs["product_isbn"] . 
							 "',product_quantity = '" . $rs["product_quantity"] . 
							 "',product_retail_price = '" . $rs["product_retail_price"] . 
							 "',product_price = '" . $rs["product_price"] . 
							 "',product_image_small = '" . $rs["product_image_small"] . 
							 "',product_image_medium = '" . $rs["product_image_medium"] . 
							 "',product_image_large = '" . $rs["product_image_large"] . 
							 "',product_main_category = '" . $rs["product_main_category"] . 
							 "',product_sub_category_1 = '" . $rs["product_sub_category_1"] . 
							 "',product_sub_category_2 = '" . $rs["product_sub_category_2"] . 
							 "',product_other_category = '" . $rs["product_other_category"] . 
							 "',product_condition = '" . $rs["product_condition"] . 
							 "',product_color_choices = '" . $rs["product_color_choices"] . 
							 "',product_size_choices = '" . $rs["product_size_choices"] . 
							 "',product_other_choices = '" . $rs["product_other_choices"] . 
							 "',product_weight = '" . $rs["product_weight"] . 
							 "',product_length = '" . $rs["product_length"] . 
							 "',product_width = '" . $rs["product_width"] . 
							 "',product_height = '" . $rs["product_height"] . 
							 "',related_products = '" . $rs["related_products"] . 
							 "' WHERE product_name = '" . $rs["product_name"] . "'";
			}
			echo "<p>$query</p>";
			mysql_query($query) or die($query . "<br>" . mysql_error());
		} else if ($Table == "SHIPPING") {
			$query = "INSERT INTO SHIPPING_RATE (product_id,shipping_vendor,shipping_method,one_item_rate,additional_item_rate,state,city,zip,country) " .
			         "VALUES (". $rs["product_id"] . ",'" . $rs["shipping_vendor"] . "','" . $rs["shipping_method"] . "','" . $rs["one_item_rate"] . "','" . $rs["additional_item_rate"] . "','" . $rs["state"] . "','" . $rs["city"] . "','" . $rs["zip"] . "','" . $rs["country"] . "')";
			mysql_query($query);
		} else if ($Table == "CATEGORIES") {
			$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CATEGORIES WHERE categories_main = '" . $rs["categories_main"] . "' AND categories_sub_1 = '" . $rs["categories_sub_1"] . "' AND categories_sub_2 = '" . $rs["categories_sub_2"] . "'"));
			if ($num_rows == 0) {
				$query = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) " .
				         "VALUES ('" . $rs["categories_main"] . "','" . $rs["categories_sub_1"] . "','" .$rs["categories_sub_2"] . "')";
				mysql_query($query) or die($query . "<br>" . mysql_error());;
			}
		}
	}
} else {
	while(!feof($file)) {
		$str = fgets($file,10000);
		$field = explode($format,$str);
		if (trim($str) != "") {
			if ($Table == "PRODUCT") {
				$num_rows = mysql_num_rows(mysql_query("SELECT * FROM PRODUCT WHERE product_name = '" . addslashes(str_replace("~",$format,$field[0])) . "'"));			
				if ($num_rows == 0) {
					if (isset($include_id) && $include_id == "yes")
						$query = "INSERT INTO PRODUCT (product_id,product_name,product_description,product_isbn,product_quantity,product_retail_price,product_price,product_image_small,product_image_medium,product_image_large,product_main_category,product_sub_category_1,product_sub_category_2,product_other_category,product_condition,product_color_choices,product_size_choices,product_other_choices,product_weight,product_length,product_width,product_height,related_products) " .
								 "VALUES ('" . addslashes(str_replace("~",$format,$field[0])) . "','" . addslashes(str_replace("~",$format,$field[1])) . "','" . addslashes($field[2]) . "','" . $field[3] . "','" . $field[4] . "','" . $field[5] . "','" . addslashes($field[6]) . "','" . addslashes($field[7]) . "','" . addslashes($field[8]) . "','" . addslashes($field[9]) . "','" . addslashes($field[10]) . "','" . addslashes($field[11]) . "','" . addslashes($field[12]) . "','" . addslashes($field[13]) . "','" . addslashes($field[14]) . "','" . addslashes($field[15]) . "','" . addslashes($field[16]) . "','" . addslashes($field[17]) . "','" . addslashes($field[18]) . "','" . addslashes($field[19]) . "','" . addslashes($field[20]) . "','" . addslashes($field[21]) . "','" . addslashes($field[22]) . "')";				
					else 
						$query = "INSERT INTO PRODUCT (product_name,product_description,product_isbn,product_quantity,product_retail_price,product_price,product_image_small,product_image_medium,product_image_large,product_main_category,product_sub_category_1,product_sub_category_2,product_other_category,product_condition,product_color_choices,product_size_choices,product_other_choices,product_weight,product_length,product_width,product_height,related_products) " .
								 "VALUES ('" . addslashes(str_replace("~",$format,$field[0])) . "','" . addslashes(str_replace("~",$format,$field[1])) . "','" . addslashes($field[2]) . "','" . $field[3] . "','" . $field[4] . "','" . $field[5] . "','" . addslashes($field[6]) . "','" . addslashes($field[7]) . "','" . addslashes($field[8]) . "','" . addslashes($field[9]) . "','" . addslashes($field[10]) . "','" . addslashes($field[11]) . "','" . addslashes($field[12]) . "','" . addslashes($field[13]) . "','" . addslashes($field[14]) . "','" . addslashes($field[15]) . "','" . addslashes($field[16]) . "','" . addslashes($field[17]) . "','" . addslashes($field[18]) . "','" . addslashes($field[19]) . "','" . addslashes($field[20]) . "','" . addslashes($field[21]) . "')";				
				} else {
					if (isset($include_id) && $include_id == "yes")
						$query = "UPDATE PRODUCT SET product_id = '" . addslashes($field[0]) .
								 "',product_name = '" . addslashes(str_replace("~",$format,$field[1])) . 
								 "',product_description = '" . addslashes(str_replace("~",$format,$field[2])) . 
								 "',product_isbn = '" . addslashes($field[3]) . 
								 "',product_quantity = '" . $field[4] . 
								 "',product_retail_price = '" . $field[5] . 
								 "',product_price = '" . $field[6] . 
								 "',product_image_small = '" . addslashes($field[7]) . 
								 "',product_image_medium = '" . addslashes($field[8]) . 
								 "',product_image_large = '" . addslashes($field[9]) . 
								 "',product_main_category = '" . addslashes($field[10]) . 
								 "',product_sub_category_1 = '" . addslashes($field[11]) . 
								 "',product_sub_category_2 = '" . addslashes($field[12]) . 
								 "',product_other_category = '" . addslashes($field[13]) . 
								 "',product_condition = '" . addslashes($field[14]) . 
								 "',product_color_choices = '" . addslashes($field[15]) . 
								 "',product_size_choices = '" . addslashes($field[16]) . 
								 "',product_other_choices = '" . addslashes($field[17]) . 
								 "',product_weight = '" . addslashes($field[18]) . 
								 "',product_length = '" . addslashes($field[19]) . 
								 "',product_width = '" . addslashes($field[20]) . 
								 "',product_height = '" . addslashes($field[21]) . 
								 "',related_products = '" . addslashes($field[22]) . 
								 "' WHERE product_name = '" . addslashes($field[1]) . "'";
					else
						$query = "UPDATE PRODUCT SET product_name = '" . addslashes(str_replace("~",$format,$field[0])) . 
								 "',product_description = '" . addslashes(str_replace("~",$format,$field[1])) . 
								 "',product_isbn = '" . addslashes($field[2]) . 
								 "',product_quantity = '" . $field[3] . 
								 "',product_retail_price = '" . $field[4] . 
								 "',product_price = '" . $field[5] . 
								 "',product_image_small = '" . addslashes($field[6]) . 
								 "',product_image_medium = '" . addslashes($field[7]) . 
								 "',product_image_large = '" . addslashes($field[8]) . 
								 "',product_main_category = '" . addslashes($field[9]) . 
								 "',product_sub_category_1 = '" . addslashes($field[10]) . 
								 "',product_sub_category_2 = '" . addslashes($field[11]) . 
								 "',product_other_category = '" . addslashes($field[12]) . 
								 "',product_condition = '" . addslashes($field[13]) . 
								 "',product_color_choices = '" . addslashes($field[14]) . 
								 "',product_size_choices = '" . addslashes($field[15]) . 
								 "',product_other_choices = '" . addslashes($field[16]) . 
								 "',product_weight = '" . addslashes($field[17]) . 
								 "',product_length = '" . addslashes($field[18]) . 
								 "',product_width = '" . addslashes($field[19]) . 
								 "',product_height = '" . addslashes($field[20]) . 
								 "',related_products = '" . addslashes($field[21]) . 
								 "' WHERE product_name = '" . addslashes($field[0]) . "'";
				}
				mysql_query($query) or die(mysql_error());
			} else if ($Table == "SHIPPING") {
				$query = "INSERT INTO SHIPPING_RATE (product_id,shipping_vendor,shipping_method,one_item_rate,additional_item_rate,state,city,zip,country) VALUES ($field[0],'" . addslashes($field[1]) . "','" . addslashes($field[2]) . "','" . $field[3] . "','" . $field[4] . "','" . addslashes($field[5]) . "','" . addslashes($field[6]) . "','" . addslashes($field[7]) . "','" . addslashes($field[8]) . "')";
				mysql_query($query);
			} else if ($Table == "CATEGORIES") {
				$num_rows = mysql_num_rows(mysql_query("SELECT * FROM CATEGORIES WHERE categories_main = '" . addslashes($field[0]) . "' AND categories_sub_1 = '" . addslashes($field[1]) . "' AND categories_sub_2 = '" . addslashes($field[2]) . "'"));
				if ($num_rows == 0) {
					$query = "INSERT INTO CATEGORIES (categories_main,categories_sub_1,categories_sub_2) VALUES ('" . addslashes($field[0]) . "','" . addslashes($field[1]) . "','" . addslashes($field[2]) . "')";
					mysql_query($query);
				}
			}
		}
	}
}
fclose($file);
$HTTP_SESSION_VARS["db_connect"]->close();
?> 
<strong>Your catalog has been imported successfully.</strong>