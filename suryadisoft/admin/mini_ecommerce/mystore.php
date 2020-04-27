<?php
require_once "config.php";
include(_COMPONENTPATH . "classes.php");

if (WebContent::getPropertyValue("selected_theme") == "custom") {
	if (file_exists("custom_theme.php"))
		include("custom_theme.php");
	else
		echo "<h2 align=\"center\">Currently you do not have custom store front design. Please select other design themes.</h2>";
} else {
	$theme = new Themes();
	$themeDir = (WebContent::getPropertyValue("selected_theme") != "")?$theme->getDirectory(WebContent::getPropertyValue("selected_theme")):"classic";
	$themeFile = (WebContent::getPropertyValue("selected_theme") != "")?$theme->getFilename(WebContent::getPropertyValue("selected_theme")):"classic.php";
	include(_TEMPLATEPATH . $themeDir . "/" . $themeFile);
}
?>
