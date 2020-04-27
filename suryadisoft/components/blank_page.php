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
$name = "blank_page" . $id . "_";
$component_properties = WebContent::getComponentProperties("Blank Page");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$contents = (WebContent::getPropertyValue($name . "contents") != "")?WebContent::getPropertyValue($name . "contents"):$prop["contents"];
?>
<? if (WebContent::getPropertyValue($name . "contents") == "") {?>
This is the <b>Blank Page Component</b>. To edit or input some text for this component, you need to edit the settings of this component by clicking this <input name="editContentsButton" type="button" value="Edit" onClick="window.open('<?=_URLPATH?>admin/ecommerce_control_panel/login.php?Action=Update&component=other&selected_component=Blank+Page&id=<?=$id?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');"> button, then refresh this page; Or you can go to <b>Manage Store -> Store Components</b> page. Click on the <b>edit</b> button and click on the <b>Component Settings</b> button.
<? } else {?>
<?=$contents?>
<? }?>