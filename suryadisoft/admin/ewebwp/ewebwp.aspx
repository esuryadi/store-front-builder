<script language="JavaScript1.2" src="/ewebwp/ewebwp.js"></script>

<%@ Page aspcompat="true" Debug=false trace="false" %>
<script language="vb" runat="server">
' DO NOT CHANGE THIS CODE
' Copyright 2003, Ektron, Inc.
'
' Latest revision date: 18-Oct-02

Function eWebWPEditor(FieldName, Width, Height, ContentHtml)
response.write("<input type=""hidden"" name=""" & FieldName & """ value=""" & Server.HTMLEncode(ContentHtml) & """>") 
response.write("<script language=""JavaScript1.2"">" & VBCrLf)
response.write("<!--" & VBCrLf)
	If TypeName(Width) = "String" Then
		Width = """" & Width & """"
	End If
	If TypeName(Height) = "String" Then
		Height = """" & Height & """"
	End If
response.write("function " & FieldName & "_onsubmit(){ return true; }" & VBCrLf)
response.write("eWebWP.create(""" & FieldName & """, " & Width & ", " & Height & ");" & VBCrLf)
response.write("//-->" & VBCrLf)
response.write("</scr")
response.write("ipt>")
End Function

Function eWebWPPopupButton(ButtonName, FieldName)
response.write("<script language=""JavaScript1.2"">" & VBCrLf)
response.write("<!--" & VBCrLf)
response.write("eWebWP.createButton(""" & ButtonName & """, """ & FieldName & """);" & VBCrLf)
response.write("//-->" & VBCrLf)
response.write("</scr")
response.write("ipt>")
End Function
</script>