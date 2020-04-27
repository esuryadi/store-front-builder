<!--- ColdFusion Custom Tag --->
<!---
	Ektron, Inc.
	Revision Date: 2002-Sept-20
--->

<cfsetting enablecfoutputonly="Yes">

<cfparam name="Attributes.Path" default="/../ewebwp//">
<cfparam name="Attributes.Name" default="undefined">
<cfparam name="Attributes.EditorName" default="undefined"> <!--- alternative to Name --->
<cfparam name="Attributes.Width" default="550">
<cfparam name="Attributes.Height" default="400">
<cfparam name="Attributes.Value" default="">
<cfsetting enablecfoutputonly="No">

<cfif Attributes.EditorName neq "undefined">
<cfset Attributes.Name=Attributes.EditorName>
</cfif>

<cfoutput>

<script language="JavaScript1.2" src="#Attributes.Path#ewebwp.js"></script>


<!-- eWebWP content -->
<input type="hidden" name="#Attributes.Name#" value="#HTMLEditFormat(Attributes.Value)#">

<script language="JavaScript1.2">
<!--
function #Attributes.Name#_onsubmit(){ return true; }
eWebWP.create("#Attributes.Name#", "#Attributes.Width#", "#Attributes.Height#");

eWebWP.parameters.reset();
//-->
</script>

</cfoutput>
