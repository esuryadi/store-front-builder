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
$name = "welcome" . $id . "_";
$component_properties = WebContent::getComponentProperties("Welcome");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$image_1 = (WebContent::getPropertyValue($name . "image_1") != "")?WebContent::getPropertyValue($name . "image_1"):$prop["image_1"];
$image_1_alt_text = (WebContent::getPropertyValue($name . "image1_alt_text") != "")?WebContent::getPropertyValue($name . "image1_alt_text"):$prop["image1_alt_text"];
$image_2 = (WebContent::getPropertyValue($name . "image_2") != "")?WebContent::getPropertyValue($name . "image_2"):$prop["image_2"];
$image_2_alt_text = (WebContent::getPropertyValue($name . "image2_alt_text") != "")?WebContent::getPropertyValue($name . "image2_alt_text"):$prop["image2_alt_text"];
$paragraph_1 = (WebContent::getPropertyValue($name . "paragraph_1") != "")?WebContent::getPropertyValue($name . "paragraph_1"):$prop["paragraph_1"];
$paragraph_2 = (WebContent::getPropertyValue($name . "paragraph_2") != "")?WebContent::getPropertyValue($name . "paragraph_2"):$prop["paragraph_2"];
$paragraph_3 = (WebContent::getPropertyValue($name . "paragraph_3") != "")?WebContent::getPropertyValue($name . "paragraph_3"):$prop["paragraph_3"];
$paragraph_4 = (WebContent::getPropertyValue($name . "paragraph_4") != "")?WebContent::getPropertyValue($name . "paragraph_4"):$prop["paragraph_4"];
?>
<? if (WebContent::getPropertyValue($name . "paragraph_1") == "") {?>
This is the <b>Welcome Component</b>. To edit or input some text for this component, you need to edit the settings of this component by clicking this <input name="editContentsButton" type="button" value="Edit" onClick="window.open('<?=_URLPATH?>admin/ecommerce_control_panel/login.php?Action=Update&component=other&selected_component=Welcome&id=<?=$id?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');"> button, then refresh this page; Or you can go to <b>Manage Store -> Store Components</b> page. Click on the <b>edit</b> button and click on the <b>Component Settings</b> button.
<? } else {?>
<? if ($paragraph_1 != "") {?>
<p><? if ($image_1 != "") {?><img src="<?=$image_1?>" alt="<?=$image_1_alt_text?>" border="0" align="left" hspace="10" vspace="5"><? }?><?=$paragraph_1?></p>
<? }?>
<? }?>
<? if ($paragraph_2 != "") {?>
<p><?=$paragraph_2?></p>
<? }?>
<? if ($paragraph_3 != "") {?>
<p><? if ($image_2 != "") {?><img src="<?=$image_2?>" alt="<?=$image_2_alt_text?>" border="0" align="right" hspace="10" vspace="5"><? }?><?=$paragraph_3?></p>
<? }?>
<? if ($paragraph_4 != "") {?>
<p><?=$paragraph_4?></p>
<? }?>
