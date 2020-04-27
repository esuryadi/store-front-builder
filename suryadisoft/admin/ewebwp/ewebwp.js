// Copyright 2003, Ektron, Inc.
// Revision Date: 2002-Sept-20

/*
	Specify path to this file in eWebWPPath.
	The path must be relative to the hostname.

	IMPORTANT: the path MUST end with a "/" character.

*/
var eWebWPPath = "../ewebwp/";


if (typeof(eWebWPIncludes) == "undefined")
{
	// Include license key(s) that are in file ewebwplicensekey.txt.
	document.writeln('<script type="text/javascript" language="JavaScript1.2" src="' + 
						eWebWPPath + 'ewebwplicensekey.txt"></script>');
	
	var eWebWPIncludes = [	
		"ewebwpevents.js",
		"ewebwpdefaults.js",
		"ewebwpmessages.js",
		"ewep.js"];
	
	for (var i = 0; i < eWebWPIncludes.length; i++)
	{
		document.writeln('<script type="text/javascript" language="JavaScript1.2" src="' + 
						eWebWPPath + eWebWPIncludes[i] + '"></script>');
	}
	
	// Prevent Detecting the onbeforeunload Event 
	window.eWebEditProUnloadHandled=true;
}
