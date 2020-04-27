// Copyright 2000-2002, Ektron, Inc.
// Revision Date: 2002-Sept-13

/* DO NOT modify this file. */
/*
	functions for browsers IE 4 and Mozilla:
	eWebEditProExecCommandHandlers[your_cmd_here] = function(sEditorName, strCmdName, strTextData, lData) { }
	function eWebEditProExecCommand(sEditorName, strCmdName, strTextData, lData) { }
	eWebEditPro.onexeccommand = your_custom_event_handler;
*/

function onExecCommandHandler(strCmdName, strTextData, lData)
{
/*
	Defer call to actual handler for two reasons:
	1. Avoid recursion in case an action results in this same event firing.
	2. Netscape cannot effectively access the methods in an event.
*/
	var sEditorName = eWebEditPro.event.srcName;
	strCmdName = strCmdName + ""; // ensure it is a string
	strTextData = strTextData + ""; // ensure it is a string
	lData = lData * 1; // ensure it is a number
	setTimeout('onExecCommandDeferred("' + sEditorName + '", "' + strCmdName + '", ' + toLiteral(strTextData) + ', ' + lData + ')', 1);
}

function onExecCommandDeferred(sEditorName, strCmdName, strTextData, lData)
{
	if ("ready" == strCmdName)
	{
		var objInstance = eWebEditPro.instances[sEditorName];
		objInstance.receivedEvent = true;
		if (objInstance.loadWhenReady)
		{
			eWebEditPro.load(objInstance);
		}

		if (objInstance.isReady())
		{
			if ("function" == typeof eWebEditProReady)
			{
				eWebEditProReady(sEditorName);
			}
			if (typeof eWebEditPro.onready != "undefined")
			{
				eWebEditPro.initEvent("onready");
				eWebEditPro.event.type = "ready"; 
				eWebEditPro.event.srcName = sEditorName;
				eWebEditPro.raiseEvent("onready");
			}
		}
		return;
	}
	
	var returnValue = true;
	if ("function" == typeof eWebEditProExecCommand)
	{
		returnValue = eWebEditProExecCommand(sEditorName, strCmdName, strTextData, lData);
	}
	
	if (returnValue != false)
	{
		var fnHandler = eWebEditProExecCommandHandlers[strCmdName];
		if ("function" == typeof fnHandler)
		{
			fnHandler(sEditorName, strCmdName, strTextData, lData);
		}
	}
		
	if (typeof eWebEditPro.onexeccommand != "undefined")
	{
		eWebEditPro.initEvent("onexeccommand");
		eWebEditPro.event.type = "execcommand"; 
		eWebEditPro.event.srcName = sEditorName;
		eWebEditPro.event.cmdName = strCmdName;
		eWebEditPro.event.textData = strTextData;
		eWebEditPro.event.data = lData;
		eWebEditPro.raiseEvent("onexeccommand");
	}
}

// global array of command handlers indexed by command name.
var eWebEditProExecCommandHandlers = new Array();

eWebEditProExecCommandHandlers["toolbarreset"] = function(sEditorName, strCmdName, strTextData, lData) 
{ 
	if (typeof eWebEditPro.ontoolbarreset != "undefined")
	{
		eWebEditPro.initEvent("ontoolbarreset");
		eWebEditPro.event.type = "toolbarreset"; 
		eWebEditPro.event.srcName = sEditorName;
		eWebEditPro.raiseEvent("ontoolbarreset");
	}
} 
