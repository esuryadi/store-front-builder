/*
	Specify license key(s) in file ewebwplicensekey.txt.
*/

// Copyright 2003, Ektron, Inc.
// Revision Date: 2002-Sept-20

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
}

