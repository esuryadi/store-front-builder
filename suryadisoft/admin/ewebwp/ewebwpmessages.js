// Copyright 2000-2002, Ektron, Inc.
// Revision Date: 2002-05-06

/* Modify this file to set your preferred messages in the language of your choice. */

var eWebEditProMessages =
{		
	popupButtonCaption: 	"Edit"
,	installPrompt:			"Click OK to install eWebEditPro."
,	waitingToLoad: 			"Waiting to load"
,	loading: 				"Loading"
,	doneLoading: 			"Done loading"
,	errorLoading: 			"Error loading"
,	saving: 				"Saving"
,	doneSaving: 			"Done saving"
,	querySave: 				"Click OK to preserve changes when moving to another page.\nClick Cancel to discard changes."
,	confirmAway: 			"Any changes will be lost."
,	saveFailed: 			"Unable to save. Continue and lose content?"
,	sizeExceeded: 			"Content is too large to save. Please reduce the size and try again."

,	clientInstallMessage:	'<br><font face="Arial" size=1 color=red>eWebEditPro is not installed. Click to <A href="' + eWebEditProDefaults.clientInstall + '">install eWebEditPro</A>.</font>'
,	clientAutoInstallMessage: '<font face="Arial" size=1 color=red> Try to <a href="javascript:eWebEditPro.autoInstallRefresh()">automatically download and install</a>.</font>'

,	elementNotFoundMessage:	'<br><font face="Arial" size=2 color=red><b>Unable to find content field (typically a hidden field) within a form.</b><br>Please check the following:<ul><li>Form tag is required<li>Content field is required and must match the name specified when creating the editor<li>Content field must be declared prior to creating the editor</ul>Name specified: </font>'
,	invalidFormMethodMessage:'<br><font face="Arial" size=2 color=red><b>The form method must be set to "post".</b> For example, &lt;form method="post"&gt;. The submit will fail using "get".</font>'
	
}

