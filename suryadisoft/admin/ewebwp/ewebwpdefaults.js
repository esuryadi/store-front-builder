// Copyright 2000-2002, Ektron, Inc.
// Revision Date: 2002-Sept-20

/* Modify this file to set your preferred defaults. */

function eWebEditProDefaults()
{
	this.path = eWebWPPath; // from ewebwp.js

	// properties for eWebEditPro.parameters.popup
	this.popupUrl = this.path + "ewebwppopup.htm"; // parameters.popup.url
	this.popupWindowName = ""; // parameters.popup.windowName
	this.popupWindowFeatures = "width=600,height=480,scrollbars,status,resizable"; // parameters.popup.windowFeatures
	this.popupQuery = ""; // parameters.popup.query
	
	// properties for eWebEditPro.parameters.buttonTag
	// valid types: "inputbutton", "button", "image", "imagelink", "hyperlink", "custom"
	this.popupButtonTagType = "inputbutton"; // parameters.buttonTag.type
	this.popupButtonTagTagAttributes = ""; // parameters.buttonTag.tagAttributes
	
	//For a custom graphic for "image" or "imagelink", set the imageTag object's properties to IMG attributes.
	/*this.popupButtonTagImageTag = { src:"myimage.gif", width:40, height:20 }; // parameters.buttonTag.imageTag.src
	
	//For "custom", set start and end.
	//The string 'eWebEditPro.edit("the-element-name")' will be inserted between start and end.
	this.popupButtonTagStart = '...'; // parameters.buttonTag.start
	this.popupButtonTagEnd = '...'; // parameters.buttonTag.end*/
	
	
	this.maxContentSize = 65000;	// maximum number of characters of HTML content that can be saved.
	
	this.embedAttributes = "";
	this.objectAttributes = "";
	this.textareaAttributes = "";

	this.license = LicenseKeys; // from ewebwp.js
	
	this.srcPath = this.path;
	this.config = this.path + "config.xml";
	//this.xmlinfo = "";
	this.baseURL = "";
	this.charset = "";
	this.title = "";
	this.readOnly = "";
	
	// Arguments must be all lowercase.
	this.onexeccommand/*(strcmdname, strtextdata, ldata)*/ = "onExecCommandHandler(strcmdname, strtextdata, ldata)";
	
	//this.editorGetMethod = "getBodyHTML"; // "getBodyHTML" or "getDocument"
}

var eWebEditProDefaults = new eWebEditProDefaults;
