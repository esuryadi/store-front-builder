<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#eeeeee">
  <tr> 
    <td> <form action="<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$adminuser->getCompanyURL()?>/<? }?>mystore.php?Page=Home" method="post" name="LoginForm" id="LoginForm">
									<input type="hidden" name="Action" value="login">
									<table width="100%" border="0" cellspacing="0" cellpadding="3">
										<tr> 
            <td width="37%" align="right">user id:</td>
											<td width="63%"><input name="UserId" type="text" id="UserId" size="10"></td>
										</tr>
										<tr> 
            <td align="right">password:</td>
											<td><input name="Password" type="password" id="Password" size="10"></td>
										</tr>
										<tr> 
											<td colspan="2"><div align="center">
													<input name="Login" type="submit" id="Login" value="Login" onClick="validateForm(this.form);">
													<input name="Reset" type="reset" id="Reset" value="Reset">
												</div></td>
										</tr>
									</table>
      </form></td>
  </tr>
</table>
