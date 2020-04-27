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
$product_type = "ProductGroup";

if ($position == "top") {
	$title = $top_content->getTitle($n);
	$style = $top_content->getComponentStyle($n);
	$filename = $top_content->getComponentStyleFilename($top_content->getName($n),$top_content->getComponentStyle($n));
} else if ($position == "left") {
	$title = $left_content->getTitle($n);
	$style = $left_content->getComponentStyle($n);
	$filename = $left_content->getComponentStyleFilename($left_content->getName($n),$left_content->getComponentStyle($n));
} else if ($position == "center") {
	$title = $middle_content->getTitle($n);
	$style = $middle_content->getComponentStyle($n);
	$filename = $middle_content->getComponentStyleFilename($middle_content->getName($n),$middle_content->getComponentStyle($n));
} else if ($position == "right") {
	$title = $right_content->getTitle($n);
	$style = $right_content->getComponentStyle($n);
	$filename = $right_content->getComponentStyleFilename($right_content->getName($n),$right_content->getComponentStyle($n));
} else if ($position == "bottom") {
	$title = $bottom_content->getTitle($n);
	$style = $bottom_content->getComponentStyle($n);
	$filename = $bottom_content->getComponentStyleFilename($bottom_content->getName($n),$bottom_content->getComponentStyle($n));	
}

$product->getProductGroup((isset($user))?$user:"",$title,$Category,$SubCategory1,$SubCategory2);

echo "<p>";

include($filename);
?>