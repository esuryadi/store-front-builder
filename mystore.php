<?php
require_once "config.php";
include(_COMPONENTPATH . "classes.php");

if (WebContent::getPropertyValue("selected_theme") == "custom") {
	include("custom_theme.php");
} else {
	$theme = new Themes();
	$themeDir = (WebContent::getPropertyValue("selected_theme") != "")?$theme->getDirectory(WebContent::getPropertyValue("selected_theme")):"classic";
	$themeFile = (WebContent::getPropertyValue("selected_theme") != "")?$theme->getFilename(WebContent::getPropertyValue("selected_theme")):"classic.php";
	include(_TEMPLATEPATH . $themeDir . "/" . $themeFile);
}
?>
