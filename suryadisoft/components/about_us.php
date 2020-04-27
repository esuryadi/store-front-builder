<?php
switch($position) {
	case "top": $id = $top_content->getID($n);
							break;
	case "left": $id = $left_content->getID($n);
							 break;
	case "center": $id = $middle_content->getID($n);
								 break;
	case "right": $id = $right_content->getID($n);
								break;
	case "bottom": $id = $bottom_content->getID($n);
								 break;
}
$name = "about_us" . $id . "_";
$component_properties = WebContent::getComponentProperties("About Us");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$title = (WebContent::getPropertyValue($name . "title") != "")?WebContent::getPropertyValue($name . "title"):$prop["title"];
$paragraph_1 = (WebContent::getPropertyValue($name . "paragraph_1") != "")?WebContent::getPropertyValue($name . "paragraph_1"):$prop["paragraph_1"];
$paragraph_2 = (WebContent::getPropertyValue($name . "paragraph_2") != "")?WebContent::getPropertyValue($name . "paragraph_2"):$prop["paragraph_2"];
$paragraph_3 = (WebContent::getPropertyValue($name . "paragraph_3") != "")?WebContent::getPropertyValue($name . "paragraph_3"):$prop["paragraph_3"];
$paragraph_4 = (WebContent::getPropertyValue($name . "paragraph_4") != "")?WebContent::getPropertyValue($name . "paragraph_4"):$prop["paragraph_4"];
$paragraph_5 = (WebContent::getPropertyValue($name . "paragraph_5") != "")?WebContent::getPropertyValue($name . "paragraph_5"):$prop["paragraph_5"];
$paragraph_6 = (WebContent::getPropertyValue($name . "paragraph_6") != "")?WebContent::getPropertyValue($name . "paragraph_6"):$prop["paragraph_6"];
?>
<h1 align="center"><?=$title?></h1>
<? if (WebContent::getPropertyValue($name . "paragraph_1") == "") {?>
This is the <b>About Us Component</b>. To edit or input some text for this component, you need to edit the settings of this component by clicking this <input name="editContentsButton" type="button" value="Edit" onClick="window.open('<?=_URLPATH?>admin/ecommerce_control_panel/login.php?Action=Update&component=other&selected_component=About+Us&id=<?=$id?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');"> button, then refresh this page; Or you can go to <b>Manage Store -> Store Components</b> page. Click on the <b>edit</b> button and click on the <b>Component Settings</b> button.
<? } else {?>
<? if ($paragraph_1 != "") {?>
<p><?=$paragraph_1?></p><br>
<? }?>
<? }?>
<? if ($paragraph_2 != "") {?>
<p><?=$paragraph_2?></p><br>
<? }?>
<? if ($paragraph_3 != "") {?>
<p><?=$paragraph_3?></p><br>
<? }?>
<? if ($paragraph_4 != "") {?>
<p><?=$paragraph_4?></p><br>
<? }?>
<? if ($paragraph_5 != "") {?>
<p><?=$paragraph_5?></p><br>
<? }?>
<? if ($paragraph_6 != "") {?>
<p><?=$paragraph_6?></p>
<? }?>
