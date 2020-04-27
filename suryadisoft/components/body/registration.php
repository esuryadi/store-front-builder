      <br><br>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr> 
    <td> 
      <? if (isset($Status) && $Status == "failed") {?>
      <font size="-1">Sorry, The User Id<strong> &quot; 
<?=$UserId?>
&quot; </strong>has been taken. Please choose different User Id.</font> <font size="-1">
        <? }?>
</font>
<center>
  <form action="mystore.php?Page=RegistrationResult" method="post" name="registrationForm" id="registrationForm">
    <table border="0" cellpadding="0" cellspacing="1" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_border_color")?>">
          <tr> 
        <td><table border="0" cellpadding="5" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
            <tr> 
              <td align="center" <? if (strstr(WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background"),".gif")) {?>background="<?=(_URLPATH . "themes/" . WebContent::getPropertyValue("selected_theme") . "/")?>images/<? } else {?>bgcolor="<? }?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?>"> <font color="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_font_color")?>" size="-1"><strong>New 
                User Registration</strong></font></td>
          </tr>
          <tr> 
              <td><table border="0" cellpadding="10" cellspacing="0" bgcolor="<?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_background")?>">
          <tr> 
                    <td width="221"><table width="352" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr> 
                          <td width="168" align="right"><font size="-1">First 
                            Name:</font></td>
                          <td width="149"> <font size="-1">
                            <input name="FirstName" type="text" id="FirstName">
                            </font></td>
          </tr>
          <tr> 
                          <td align="right"><font size="-1">Last Name:</font></td>
                          <td><font size="-1">
                            <input name="LastName" type="text" id="LastName">
                            </font></td>
          </tr>
          <tr> 
                          <td align="right"><font size="-1">Email Address:</font></td>
                          <td><font size="-1">
                            <input name="Email" type="text" id="Email">
                            </font></td>
          </tr>
          <tr> 
                          <td align="right"><font size="-1">User Id:</font></td>
                          <td><font size="-1">
                            <input name="UserId" type="text" id="UserId">
                            </font></td>
                        </tr>
                        <tr> 
                          <td align="right"><font size="-1">Password:</font></td>
                          <td><font size="-1">
                            <input name="Password" type="password" id="Password">
                            </font></td>
                        </tr>
                        <tr> 
                          <td align="right"><font size="-1">Re-Enter Password:</font></td>
                          <td><font size="-1">
                            <input name="Password2" type="password" id="Password2">
                            </font></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr> 
                    <td align="center"><font size="-1">
                <input type="submit" name="Submit" value="Register" onClick="validateForm(this.form);">
                <input name="Reset" type="reset" id="Reset" value="Reset">
                      </font></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
          </tr>
        </table>
      </form>
      </center></td>
  </tr>
</table>
