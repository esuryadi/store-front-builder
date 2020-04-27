		<? if (isset($isPasswordMailed) && $isPasswordMailed) {?>
<center>

  <p>&nbsp;</p><table width="500" border="0" cellpadding="10" cellspacing="0">

    <tr> 
      <td><font size="-1">Your Password has been mailed to you. 
		<? } else {?>
			<? if (isset($isPasswordMailed)) {?>
        <br>
        Your password cannot be found. Please make sure that you enter the correct 
        User Id. 
			<? } else {?>
        <br>
        <br>
        Forget Your Password? Please enter the following information:</font> 
			<? }?>
        <br> <form action="mystore.php?Page=ForgetPassword" method="post" name="forgetPasswordForm" id="forgetPasswordForm">
          <strong> <font size="-1"> 
          <input name="Action" type="hidden" id="Action" value="EmailPassword">
          User Id:</font> <font size="-1"> 
          <input name="UserId" type="text" id="UserId">
          <br>
          <br>
          </font></strong> <font size="-1"><strong> 
          <input type="submit" name="Submit" value="Email Password" onClick="validateForm(this.form);">
          <input name="Reset" type="reset" id="Reset" value="Reset">
          </strong></font> 
      </form>
			<? }?>      
      </td>
    </tr>
  </table>
</center>
