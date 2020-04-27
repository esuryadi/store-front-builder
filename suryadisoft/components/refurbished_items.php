<?php
$product = new Product();
if (!isset($SubCategory1))
	$SubCategory1 = "";
else
	$SubCategory1 = urldecode($SubCategory1);
if (!isset($SubCategory2))
	$SubCategory2 = "";
else
	$SubCategory2 = urldecode($SubCategory2);
$product->getRefurbishedItems((isset($user))?$user:"",$Category,$SubCategory1,$SubCategory2);
$product_type = "RefurbishedItems";

if ($position == "top") {
	$style = $top_content->getComponentStyle($n);
	$filename = $top_content->getComponentStyleFilename($top_content->getName($n),$top_content->getComponentStyle($n));
} else if ($position == "left") {
	$style = $left_content->getComponentStyle($n);
	$filename = $left_content->getComponentStyleFilename($left_content->getName($n),$left_content->getComponentStyle($n));
} else if ($position == "center") {
	$style = $middle_content->getComponentStyle($n);
	$filename = $middle_content->getComponentStyleFilename($middle_content->getName($n),$middle_content->getComponentStyle($n));
} else if ($position == "right") {
	$style = $right_content->getComponentStyle($n);
	$filename = $right_content->getComponentStyleFilename($right_content->getName($n),$right_content->getComponentStyle($n));
} else if ($position == "bottom") {
	$style = $bottom_content->getComponentStyle($n);
	$filename = $bottom_content->getComponentStyleFilename($bottom_content->getName($n),$bottom_content->getComponentStyle($n));	
}

echo "<p>";

include($filename);
?>