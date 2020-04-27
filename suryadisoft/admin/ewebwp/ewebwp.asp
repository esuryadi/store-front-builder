<% 
'
' DO NOT CHANGE THIS CODE
' Copyright 2003, Ektron, Inc.
'
' Latest revision date: 20-Sept-2002
'
%>
<script language="JavaScript1.2" src="../../../ewebwp.js"></script>
<%

Function eWebWPEditor(FieldName, Width, Height, ContentHtml)
%>
<input type="hidden" name="<% =FieldName %>" value="<% =Server.HTMLEncode(ContentHtml) %>">
<script language="JavaScript1.2">
<!--
	<%	
	If TypeName(Width) = "String" Then
		Width = """" & Width & """"
	End If
	If TypeName(Height) = "String" Then
		Height = """" & Height & """"
	End If
	%>
	function <% =FieldName %>_onsubmit(){ return true; }
	eWebWP.create("<% =FieldName %>", <% =Width %>, <% =Height %>);
//-->
</script>
<%
End Function

Function eWebWPPopupButton(ButtonName, FieldName)
%>
<script language="JavaScript1.2">
<!--
	eWebWP.createButton("<% =ButtonName %>", "<% =FieldName %>");
//-->
</script>
<%
End Function
%>
