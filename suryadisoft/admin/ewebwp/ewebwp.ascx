<%@ Control Language="vb" AutoEventWireup="false" %>

<!--  
	Copyright 2003,	Ektron Inc.  Amherst NH  
	Latest Revision: 20-Sept-2002
-->

<script language="VB" runat="server">
	Public Width As String
	Public Height As String
	Public Property Text As String
 	 	Get
 			Return _Value
		End Get
		Set
	   		_Value = Value
		End Set
	End Property
	Public Property Value As String
 	 	Get
 			Return _Value
		End Get
		Set
	   		_Value = Value
		End Set
	End Property
	
	Private _Value as String = ""
</script>

<script language="JavaScript1.2" src="../../../ewebwp.js"></script>

<input type="hidden" name="<% =id %>" value="<% =Server.HTMLEncode(_Value) %>"> 

<script language="JavaScript1.2">
<!--
	function <%= id %>_onsubmit(){ return true; }
	eWebWP.create("<% =id %>", "<% =Width %>", "<% =Height %>");
//-->
</script>






	
