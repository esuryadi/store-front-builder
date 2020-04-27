<!--- ColdFusion Custom Tag --->
<!---
	Ektron, Inc.
	Revision Date: 2002-Dec-23
--->

<cfsetting enablecfoutputonly="Yes">

<cfparam name="Attributes.Path" default="/ewebwp/">
<cfparam name="Attributes.ButtonName">
<cfparam name="Attributes.FieldName">

<cfsetting enablecfoutputonly="No">

<cfoutput>
<script language="JavaScript1.2" src="#Attributes.Path#ewebwp.js"></script>

<script language="JavaScript1.2">
<!--
eWebWP.createButton("#Attributes.ButtonName#", "#Attributes.FieldName#");
//-->
</script>

</cfoutput>
