<script language="JavaScript" src="../../../ewebwp.js"></script>

<% String szODBCNAME = "ewebwp"; %>
<%@ page import="java.sql.*" %>
<%! 
	public String eWebWPEditor(String FieldName, String Width, String Height, String ContentHtml)
	{
	String strHtml = eWebEditEscape(ContentHtml);
	String test = "<input type='hidden' name='" + FieldName + "' value =\"" + strHtml + "\">";
	test = test + "\n<script language='JavaScript1.2'>";
	test = test + "\n<!--";
	test = test + "\nfunction " + FieldName + "_onsubmit(){ return true; }";
	test = test + "\neWebWP.create('" + FieldName + "','" + Width + "','" + Height + "');";
	test = test + "\n//-->";
	test = test + "\n</script>";
		
	return(test);
} 

public String eWebWPButton(String ButtonName, String FieldName)
	{
    String test = "<script language='JavaScript1.2'>";
	test = test + "\n<!--";
	test = test + "\neWebWP.createButton('" + ButtonName + "','" + FieldName + "');";
	test = test + "\n//-->";
	test = test + "\n</script>";
		
	return(test);
}

public String replaceString(String str, String pattern, String replace) {
   int s = 0;
   int e = 0;
 StringBuffer result = new StringBuffer();
    
  while ((e = str.indexOf(pattern, s)) >= 0) {
    result.append(str.substring(s, e));
    result.append(replace);
    s = e+pattern.length();
      }
    result.append(str.substring(s));
    return result.toString();
    }

public String eWebEditEscape(String html) {
	    String szContent = html;
	  	   return replaceString(replaceString(replaceString(replaceString(szContent,"&", "&amp;"),"<", "&lt;"),"\"", "&quot;"),">","&gt;");
    }



public String actionDatabase(String ODBCName, String fieldName, String sqlString, String action)
	{
	String strString = "ok";
   	Connection con = null;
	Statement stmt = null;
	ResultSet rs = null;
	ResultSetMetaData rsmd = null;
	
	try {
		// Load the jdbc driver
		Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		// Connect to the database
		con = DriverManager.getConnection("jdbc:odbc:"+ODBCName);
		// Create a statement object
		stmt = con.createStatement();
		// Execute query	
		String sqlquery = sqlString; 
		rs = stmt.executeQuery(sqlquery);
		// Display result set
		if (action == "read"){
			rsmd = rs.getMetaData();
			while (rs.next()) {
						// 1 is the first Column
						strString = rs.getString(fieldName);
			}
		}
	}
	catch (ClassNotFoundException cnfe) {
		return "Could not find database " + ODBCName;
	}
	catch (SQLException sqle) {
	return "SQL Error with database " + ODBCName + " : " + sqlString;
		}
	finally {
		try {
			if (rs != null) rs.close();
			if (stmt != null) stmt.close();
			if (con != null) con.close();
		}
		catch (SQLException e) {
			// ignore
		}
	}
	return strString;
}

public String getContent(String ODBCName, String id)
{
	String strSQL = "SELECT edit_html FROM wysiwyg_tbl WHERE edit_id = " + id;
	String strContent = actionDatabase(ODBCName, "edit_html", strSQL, "read");
	return strContent;
}

public String getTitle(String ODBCName, String id)
{
	String strSQL = "SELECT edit_title FROM wysiwyg_tbl WHERE edit_id = " + id;
	String strTitle = actionDatabase(ODBCName, "edit_title", strSQL, "read");
	return strTitle;
}
%>
