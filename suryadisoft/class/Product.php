<?php
class Product
{
	var $dbconnect;
	var $category;
	var $keyword;
	var $product_id;
	var $product_name;
	var $product_description;
	var $product_retail_price;
	var $product_price;
	var $product_quantity;
	var $product_condition;
	var $product_isbn;
	var $product_image_small;
	var $product_image_medium;
	var $product_image_large;
	var $product_main_category;
	var $product_sub_category_1;
	var $product_sub_category_2;
	var $product_other_category;
	var $product_price;
	var $product_colors;
	var $product_sizes;
	var $product_choices;
	var $user = "";
	var $count = 0;
	
	function Product()
	{
		$this->dbconnect = new DBConnect(_HOST,_USERID,_PASSWORD);
	}
	
	function setMainCategory($main_category)
	{
		$this->main_category = $main_category;
	}
	
	function setKeyword($keyword)
	{
		$this->keyword = split("or",$keyword);
	}
	
	function getProductId($i)
	{
		return $this->product_id[$i];
	}
	
	function getProductName($i) 
	{
		return $this->product_name[$i];
	}

	function getProductDescription($i)
	{
		return $this->product_description[$i];
	}

	function getSmallImage($i)
	{
		return $this->product_image_small[$i];
	}
	
	function getMediumImage($i)
	{
		return $this->product_image_medium[$i];
	}
	
	function getLargeImage($i)
	{
		return $this->product_image_large[$i];
	}
	
	function getMainCategory($i)
	{
		return $this->product_main_category[$i];
	}
	
	function getSubCategory1($i)
	{
		return $this->product_sub_category_1[$i];
	}
	
	function getSubCategory2($i)
	{
		return $this->product_sub_category_2[$i];
	}
	
	function getOtherCategory($i)
	{
		return $this->product_other_category[$i];
	}
	
	function getPrice($i)
	{
		return $this->product_price[$i];
	}
	
	function getRetailPrice($i)
	{
		return $this->product_retail_price[$i];
	}
	
	function getColors($i)
	{
		return $this->product_colors[$i];
	}
	
	function getSizes($i)
	{
		return $this->product_sizes[$i];
	}
	
	function getChoices($i)
	{
		return $this->product_choices[$i];
	}
		
	function getCount()
	{
		return $this->count;
	}
	
	function setUser($user)
	{
		$this->user = $user;
	}
			
	function getProductSpecialPrice($user,$product_id) 
	{
		if ($user != "") {
			$user_id = $user->getUserId();
			$query = "SELECT product_price FROM SPECIAL_PRICING WHERE user_id = '$user_id' AND product_id = $product_id";
			$this->dbconnect->open();
			mysql_select_db(_DATABASE);
			$query_result = mysql_query($query);
			if (mysql_num_rows($query_result) > 0) {
				$rs = mysql_fetch_row($query_result);
				return $rs[0];
			} else {
				return "";
			}
			$this->dbconnect->close();
		} else {
			return "";
		}
	}
	
	function getProductGroup($user,$title,$main_category,$sub_category_1,$sub_category_2)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		if ($main_category != "ALL") {
			$where_clause = " AND (PRODUCT_MAIN_CATEGORY = '$main_category' OR PRODUCT_OTHER_CATEGORY LIKE '%$main_category%') ";
			if ($sub_category_1 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_1 = '$sub_category_1' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_1%') ";
			if ($sub_category_2 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_2 = '$sub_category_2' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_2%') ";
		} else
			$where_clause = "";
		$product_group_table = strtoupper(str_replace(" ","_",$title));
		$product_group_table = strtoupper(str_replace("(","",$product_group_table));
		$product_group_table = strtoupper(str_replace(")","",$product_group_table));
		$product_group_table = strtoupper(str_replace("&","",$product_group_table));
		$product_group_table = strtoupper(str_replace("'","",$product_group_table));
		$product_group_table = strtoupper(str_replace("\\","",$product_group_table));
		$product_group_table = strtoupper(str_replace("?","",$product_group_table));
		$product_group_table = strtoupper(str_replace("!","",$product_group_table));
		$query = "SELECT PRODUCT.PRODUCT_ID, PRODUCT.PRODUCT_NAME, PRODUCT.PRODUCT_DESCRIPTION, PRODUCT.PRODUCT_IMAGE_SMALL, PRODUCT.PRODUCT_IMAGE_MEDIUM, PRODUCT.PRODUCT_IMAGE_LARGE, PRODUCT_MAIN_CATEGORY, PRODUCT_SUB_CATEGORY_1, PRODUCT_SUB_CATEGORY_2, PRODUCT_OTHER_CATEGORY, PRODUCT_PRICE, PRODUCT_COLOR_CHOICES, PRODUCT_SIZE_CHOICES, PRODUCT_OTHER_CHOICES, PRODUCT_RETAIL_PRICE FROM $product_group_table, PRODUCT WHERE " . $product_group_table . ".PRODUCT_ID = PRODUCT.PRODUCT_ID $where_clause ORDER BY " . $product_group_table . ".SEQUENCE";	
		$query_result = mysql_query($query);
		if ($query_result) {
			for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
				$this->product_id [] = $rs[0];
				$this->product_name [] = $rs[1];
				$this->product_description [] = $rs[2];
				$this->product_image_small [] = $rs[3];
				$this->product_image_medium [] = $rs[4];
				$this->product_image_large [] = $rs[5];
				$this->product_main_category [] = $rs[6];
				$this->product_sub_category_1 [] = $rs[7];
				$this->product_sub_category_2 [] = $rs[8];
				$this->product_other_category [] = $rs[9];
				$this->product_price [] = ($this->getProductSpecialPrice($user,$rs[0]) == "")?$rs[10]:$this->getProductSpecialPrice($user,$rs[0]);
				$this->product_colors [] = $rs[11];
				$this->product_sizes [] = $rs[12];
				$this->product_choices [] = $rs[13];
				$this->product_retail_price [] = $rs[14];
				$this->count = $i + 1;
			}		
		}
		$this->dbconnect->close();
	}
	
	function getAllProducts($user,$main_category,$sub_category_1,$sub_category_2)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		if ($main_category != "ALL") {
			$where_clause = " WHERE (PRODUCT_MAIN_CATEGORY = '$main_category' OR PRODUCT_OTHER_CATEGORY LIKE '%$main_category%') ";
			if ($sub_category_1 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_1 = '$sub_category_1' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_1%') ";
			if ($sub_category_2 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_2 = '$sub_category_2' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_2%') ";
		} else
			$where_clause = "";
		$query = "SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE_SMALL, PRODUCT.PRODUCT_IMAGE_MEDIUM, PRODUCT.PRODUCT_IMAGE_LARGE, PRODUCT_MAIN_CATEGORY, PRODUCT_SUB_CATEGORY_1, PRODUCT_SUB_CATEGORY_2, PRODUCT_OTHER_CATEGORY, PRODUCT_PRICE, PRODUCT_COLOR_CHOICES, PRODUCT_SIZE_CHOICES, PRODUCT_OTHER_CHOICES, PRODUCT_RETAIL_PRICE FROM PRODUCT $where_clause";	
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$this->product_id [] = $rs[0];
			$this->product_name [] = $rs[1];
			$this->product_description [] = $rs[2];
			$this->product_image_small [] = $rs[3];
			$this->product_image_medium [] = $rs[4];
			$this->product_image_large [] = $rs[5];
			$this->product_main_category [] = $rs[6];
			$this->product_sub_category_1 [] = $rs[7];
			$this->product_sub_category_2 [] = $rs[8];
			$this->product_other_category [] = $rs[9];
			$this->product_price [] = ($this->getProductSpecialPrice($user,$rs[0]) == "")?$rs[10]:$this->getProductSpecialPrice($user,$rs[0]);
			$this->product_colors [] = $rs[11];
			$this->product_sizes [] = $rs[12];
			$this->product_choices [] = $rs[13];
			$this->product_retail_price [] = $rs[14];
			$this->count = $i + 1;
		}		
		$this->dbconnect->close();
	}
	
	function getNewItems($user,$main_category,$sub_category_1,$sub_category_2)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		if ($main_category != "ALL") {
			$where_clause = " AND (PRODUCT_MAIN_CATEGORY = '$main_category' OR PRODUCT_OTHER_CATEGORY LIKE '%$main_category%') ";
			if ($sub_category_1 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_1 = '$sub_category_1' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_1%') ";
			if ($sub_category_2 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_2 = '$sub_category_2' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_2%') ";
		} else
			$where_clause = "";
		$query = "SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE_SMALL, PRODUCT.PRODUCT_IMAGE_MEDIUM, PRODUCT.PRODUCT_IMAGE_LARGE, PRODUCT_MAIN_CATEGORY, PRODUCT_SUB_CATEGORY_1, PRODUCT_SUB_CATEGORY_2, PRODUCT_OTHER_CATEGORY, PRODUCT_PRICE, PRODUCT_COLOR_CHOICES, PRODUCT_SIZE_CHOICES, PRODUCT_OTHER_CHOICES, PRODUCT_RETAIL_PRICE FROM PRODUCT WHERE PRODUCT_CONDITION = 'New' $where_clause";	
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$this->product_id [] = $rs[0];
			$this->product_name [] = $rs[1];
			$this->product_description [] = $rs[2];
			$this->product_image_small [] = $rs[3];
			$this->product_image_medium [] = $rs[4];
			$this->product_image_large [] = $rs[5];
			$this->product_main_category [] = $rs[6];
			$this->product_sub_category_1 [] = $rs[7];
			$this->product_sub_category_2 [] = $rs[8];
			$this->product_other_category [] = $rs[9];
			$this->product_price [] = ($this->getProductSpecialPrice($user,$rs[0]) == "")?$rs[10]:$this->getProductSpecialPrice($user,$rs[0]);
			$this->product_colors [] = $rs[11];
			$this->product_sizes [] = $rs[12];
			$this->product_choices [] = $rs[13];
			$this->product_retail_price [] = $rs[14];
			$this->count = $i + 1;
		}		
		$this->dbconnect->close();
	}
	
	function getUsedItems($user,$main_category,$sub_category_1,$sub_category_2)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		if ($main_category != "ALL") {
			$where_clause = " AND (PRODUCT_MAIN_CATEGORY = '$main_category' OR PRODUCT_OTHER_CATEGORY LIKE '%$main_category%') ";
			if ($sub_category_1 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_1 = '$sub_category_1' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_1%') ";
			if ($sub_category_2 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_2 = '$sub_category_2' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_2%') ";
		} else
			$where_clause = "";
		$query = "SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE_SMALL, PRODUCT.PRODUCT_IMAGE_MEDIUM, PRODUCT.PRODUCT_IMAGE_LARGE, PRODUCT_MAIN_CATEGORY, PRODUCT_SUB_CATEGORY_1, PRODUCT_SUB_CATEGORY_2, PRODUCT_OTHER_CATEGORY, PRODUCT_PRICE, PRODUCT_COLOR_CHOICES, PRODUCT_SIZE_CHOICES, PRODUCT_OTHER_CHOICES, PRODUCT_RETAIL_PRICE FROM PRODUCT WHERE PRODUCT_CONDITION = 'Used' $where_clause";	
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$this->product_id [] = $rs[0];
			$this->product_name [] = $rs[1];
			$this->product_description [] = $rs[2];
			$this->product_image_small [] = $rs[3];
			$this->product_image_medium [] = $rs[4];
			$this->product_image_large [] = $rs[5];
			$this->product_main_category [] = $rs[6];
			$this->product_sub_category_1 [] = $rs[7];
			$this->product_sub_category_2 [] = $rs[8];
			$this->product_other_category [] = $rs[9];
			$this->product_price [] = ($this->getProductSpecialPrice($user,$rs[0]) == "")?$rs[10]:$this->getProductSpecialPrice($user,$rs[0]);
			$this->product_colors [] = $rs[11];
			$this->product_sizes [] = $rs[12];
			$this->product_choices [] = $rs[13];
			$this->product_retail_price [] = $rs[14];
			$this->count = $i + 1;
		}		
		$this->dbconnect->close();
	}
	
	function getRefurbishedItems($user,$main_category,$sub_category_1,$sub_category_2)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		if ($main_category != "ALL") {
			$where_clause = " AND (PRODUCT_MAIN_CATEGORY = '$main_category' OR PRODUCT_OTHER_CATEGORY LIKE '%$main_category%') ";
			if ($sub_category_1 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_1 = '$sub_category_1' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_1%') ";
			if ($sub_category_2 != "")
				$where_clause = $where_clause . "AND (PRODUCT_SUB_CATEGORY_2 = '$sub_category_2' OR PRODUCT_OTHER_CATEGORY LIKE '%$sub_category_2%') ";
		} else
			$where_clause = "";
		$query = "SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE_SMALL, PRODUCT.PRODUCT_IMAGE_MEDIUM, PRODUCT.PRODUCT_IMAGE_LARGE, PRODUCT_MAIN_CATEGORY, PRODUCT_SUB_CATEGORY_1, PRODUCT_SUB_CATEGORY_2, PRODUCT_OTHER_CATEGORY, PRODUCT_PRICE, PRODUCT_COLOR_CHOICES, PRODUCT_SIZE_CHOICES, PRODUCT_OTHER_CHOICES, PRODUCT_RETAIL_PRICE FROM PRODUCT WHERE PRODUCT_CONDITION = 'Refurbished' $where_clause";	
		$query_result = mysql_query($query);
		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$this->product_id [] = $rs[0];
			$this->product_name [] = $rs[1];
			$this->product_description [] = $rs[2];
			$this->product_image_small [] = $rs[3];
			$this->product_image_medium [] = $rs[4];
			$this->product_image_large [] = $rs[5];
			$this->product_main_category [] = $rs[6];
			$this->product_sub_category_1 [] = $rs[7];
			$this->product_sub_category_2 [] = $rs[8];
			$this->product_other_category [] = $rs[9];
			$this->product_price [] = ($this->getProductSpecialPrice($user,$rs[0]) == "")?$rs[10]:$this->getProductSpecialPrice($user,$rs[0]);
			$this->product_colors [] = $rs[11];
			$this->product_sizes [] = $rs[12];
			$this->product_choices [] = $rs[13];
			$this->product_retail_price [] = $rs[14];
			$this->count = $i + 1;
		}		
		$this->dbconnect->close();
	}
	
	function search($user)
	{				
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		if ($this->main_category != "ALL")
			$where_clause = " (PRODUCT_MAIN_CATEGORY = '$this->main_category' OR PRODUCT_OTHER_CATEGORY LIKE '%$main_category%') ";
		else
			$where_clause = "";
		
		for ($i=0;$i<count($this->keyword);$i++) {
			if ($i == 0)
				$str = "PRODUCT_NAME LIKE '%" . trim($this->keyword[$i]) . "%' OR PRODUCT_DESCRIPTION LIKE '%" . trim($this->keyword[$i]) . "%'";
			else
				$str = $str . " OR " . "PRODUCT_NAME LIKE '%" . trim($this->keyword[$i]) ."%' OR PRODUCT_DESCRIPTION LIKE '%" . trim($this->keyword[$i]) . "%'";
		}
		
		if (count($this->keyword) > 0) {
			if ($where_clause != "")
				$where_clause = $where_clause . "AND (" . $str . ") ";
			else
				$where_clause = $str;
		}
				
		$query = "SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_DESCRIPTION, PRODUCT_IMAGE_SMALL, PRODUCT.PRODUCT_IMAGE_MEDIUM, PRODUCT.PRODUCT_IMAGE_LARGE, PRODUCT_MAIN_CATEGORY, PRODUCT_SUB_CATEGORY_1, PRODUCT_SUB_CATEGORY_2, PRODUCT_OTHER_CATEGORY, PRODUCT_PRICE, PRODUCT_COLOR_CHOICES, PRODUCT_SIZE_CHOICES, PRODUCT_OTHER_CHOICES, PRODUCT_RETAIL_PRICE FROM PRODUCT WHERE $where_clause ORDER BY PRODUCT_NAME";	
		$query_result = mysql_query($query);

		for ($i=0;$rs = mysql_fetch_row($query_result);$i++) {
			$this->product_id [] = $rs[0];
			$this->product_name [] = $rs[1];
			$this->product_description [] = $rs[2];
			$this->product_image_small [] = $rs[3];
			$this->product_image_medium [] = $rs[4];
			$this->product_image_large [] = $rs[5];
			$this->product_main_category [] = $rs[6];
			$this->product_sub_category_1 [] = $rs[7];
			$this->product_sub_category_2 [] = $rs[8];
			$this->product_other_category [] = $rs[9];
			$this->product_price [] = ($this->getProductSpecialPrice($user,$rs[0]) == "")?$rs[10]:$this->getProductSpecialPrice($user,$rs[0]);
			$this->product_colors [] = $rs[11];
			$this->product_sizes [] = $rs[12];
			$this->product_choices [] = $rs[13];
			$this->product_retail_price [] = $rs[14];
			$this->count = $i + 1;
		}		
		$this->dbconnect->close();
	}
	
	function getProduct($product_id) 
	{
		$this->dbconnect->open();
		if(defined("_DATABASE"))
			$database = _DATABASE;
		else 
			$database = _DB;
		mysql_select_db($database);
		$query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
		$query_result = mysql_query($query);
		$product = Array();
		while($rs = mysql_fetch_row($query_result)) {
			$product["id"] = $rs[0];
			$product["name"] = $rs[1];
			$product["desc"] = $rs[2];
			$product["isbn"] = $rs[3];
			$product["qty"] = $rs[4];
			$product["retail_price"] = $rs[5];
			$product["price"] = ($this->getProductSpecialPrice($this->user,$rs[0]) == "")?$rs[6]:$this->getProductSpecialPrice($this->user,$rs[0]);
			$product["img_sm"] = $rs[7];
			$product["img_md"] = $rs[8];
			$product["img_lg"] = $rs[9];
			$product["main_cat"] = $rs[10];
			$product["sub_cat_1"] = $rs[11];
			$product["sub_cat_2"] = $rs[12];
			$product["other_cat"] = $rs[13];
			$product["cond"] = $rs[14];
			$product["color"] = $rs[15];
			$product["size"] = $rs[16];
			$product["choices"] = $rs[17];
			$product["weight"] = $rs[18];
			$product["length"] = $rs[19];
			$product["width"] = $rs[20];
			$product["height"] = $rs[21];
			$product["related_products"] = $rs[22];
		}
		$this->dbconnect->close();
	
		return $product;
	}
	
	function getCoupons($coupon_id) 
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT * FROM PRODUCT_COUPON WHERE COUPON_ID = '$coupon_id'";
		$query_result = mysql_query($query);
		$coupon = Array();
		while($rs = mysql_fetch_row($query_result)) {
			$coupon["coupon_id"] = $rs[0];
			$coupon["product_id"] = $rs[1];
			$coupon["discount_type"] = $rs[2];
			$coupon["coupon_value"] = $rs[3];
			$coupon["exp_date"] = $rs[4];
		}
		$this->dbconnect->close();
	
		return $coupon;
	}
	
	function deleteCoupons($coupons) 
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		for ($i=0;$i<count($coupons);$i++) {
			$query = "SELECT EXP_DATE FROM PRODUCT_COUPON WHERE COUPON_ID = '" . $coupons[$i] . "'";
			$rs = mysql_fetch_row(mysql_query($query));
			if ($rs[0] == "0000-00-00" || strtotime(date("Y-m-d")) > strtotime($rs[0])) {
				$query = "DELETE FROM PRODUCT_COUPON WHERE COUPON_ID = '" . $coupons[$i] . "'";
				mysql_query($query);
			}
		}
		$this->dbconnect->close();
	}
	
	function getProductImagesGallery($id)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		$query = "SELECT product_image_src FROM PRODUCT_IMAGES_GALLERY WHERE product_id = '$id'";
		$query_result = mysql_query($query);
		$images = Array();
		while ($rs = mysql_fetch_row($query_result))
			$images [] = $rs[0];
		$this->dbconnect->close();
		
		return $images;
	}
	
	function getVolumeDiscount($total_purchase,$total_quantity)
	{
		$this->dbconnect->open();
		mysql_select_db(_DATABASE);
		
		$query1 = "SELECT discount_type, discount_rate FROM VOLUME_DISCOUNT WHERE discount_by = 'total purchase' AND volume_low <= $total_purchase AND volume_high >= $total_purchase";
		$query_result1 = mysql_query($query1);
		$query2 = "SELECT discount_type, discount_rate FROM VOLUME_DISCOUNT WHERE discount_by = 'total quantity' AND volume_low <= $total_quantity AND volume_high >= $total_quantity";
		$query_result2 = mysql_query($query2);

		$discount1 = 0;		
		if (mysql_num_rows($query_result1) > 0) {
			$rs1 = mysql_fetch_row($query_result1);
			if ($rs1[0] == "percentage")
				$discount1 = $total_purchase * $rs1[1];
			else
				$discount1 = $rs1[1];			
		}
		
		$discount2 = 0;
		if (mysql_num_rows($query_result2) > 0) {
			$rs = mysql_fetch_row($query_result2);
			if ($rs2[0] == "percentage")
				$discount2 = $total_purchase * $rs2[1];
			else
				$discount2 = $rs2[1];			
		}
		
		$this->dbconnect->close();
		
		return ($discount1 + $discount2);
	}
}
?>
