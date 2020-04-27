<?php
// Ektron, Inc. Copyright 2003
	//
	//	File: ewebwp.php
	//

	// Insert the necessary Javascript include files for calling the editor
	// Pass the time to insure that the js lib is never servered from browser cache
	$randnum = time();
	echo "<script language=\"JavaScript1.2\" src=\"../ewebwp/ewebwp.js?$randnum\"></script>\n";

	// Javascript for calling popup windows
	echo "<script language=\"JavaScript1.2\">\n";
	echo "	function PopUpWindow (url, hWind, nHeight, nWidth, nScroll, nResize) {\n";
	echo "	var cToolBar = \"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=\" + nScroll + \",resizable=0,width=\" + nWidth + \",height=\" + nHeight;\n";
	echo "		var popupwin = window.open(url, hWind, cToolBar);\n";
	echo "	}\n";
	echo "</script>\n";

	// Function: eWebWPEditor
	// Purpose:  Insert the necessary Javascript to call the editor
	// Parameters:
	//		FieldName:		(String) The name of the hidden field that will be passed in the post
	//		Width:			(String) The physical width the editor in the content form
	//								 may be a number of percentage
	//		Height:			(String) The physical height the editor in the content form
	//								 may be a number of percentage
	//		ContentHTML:	(String) The HTML being loaded into the editor
	function eWebWPEditor ( $FieldName, $Width, $Height, $ContentHtml ) {
		$strContentHTML = htmlentities ($ContentHtml);
		echo "<input type=\"hidden\" name=\"$FieldName\" value=\"$strContentHTML\">";
		echo "<script language=\"JavaScript1.2\">";
		echo "		function ";
		echo $FieldName;
		echo "_onsubmit(){ return true; }";
		echo "			eWebWP.create(\"$FieldName\", \"$Width\", \"$Height\");";
		echo "</script>";
	}
	
	// Function: eWebWPPopupButton
	// Purpose:  Insert the necessary HTML to call the popup version of the editor
	// Parameters:
	//		ButtonName:		(String) The name of the onclick button
	//		FieldName:		(String) The name of the hidden field that will be passed in the post
	function eWebWPPopupButton  ( $ButtonName, $FieldName ) {
		echo "<script language=\"JavaScript1.2\">\n";
		echo "		eWebWP.createButton(\"$ButtonName\", \"$FieldName\")\n";
		echo "</script>\n";
	}
?>
