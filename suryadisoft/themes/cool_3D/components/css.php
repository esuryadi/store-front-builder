<style type="text/css">
.cursor {
	cursor: hand
}

.menulink:link { color:<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>; text-decoration:none; padding:0 0 0 0 }
.menulink:visited { color:<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>; text-decoration:none; padding:0 0 0 0; }  
.menulink:active { color:<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>; text-decoration:none; padding:0 0 0 0; }
.menulink:hover { color:<?=WebContent::getPropertyValue("cool_3D_menu_font_color")?>; text-decoration:none; padding:0 0 0 0; }

body {  
	font-family: <?=WebContent::getPropertyValue("cool_3D_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("cool_3D_font_size")?>; 
	color: <?=WebContent::getPropertyValue("cool_3D_font_color")?>
}

td {  
	font-family: <?=WebContent::getPropertyValue("cool_3D_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("cool_3D_font_size")?>; 
	color: <?=WebContent::getPropertyValue("cool_3D_font_color")?>
}

.menufont {  
	font-family: <?=WebContent::getPropertyValue("cool_3D_tab_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue("cool_3D_tab_font_size")?>; 
	color: <?=WebContent::getPropertyValue("cool_3D_tab_font_color")?>
}

.tableheaderfont {  
	font-family: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_face")?>; 
	font-size: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_size")?>; 
	color: <?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>
}
</style>