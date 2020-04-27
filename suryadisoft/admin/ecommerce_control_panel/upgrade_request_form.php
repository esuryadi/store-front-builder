<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Pricing.php";
require_once("../config.php");

$pricing = new Pricing();
$disk_space = 0;
$mail_quota = 0;
$db_quota = 0;
$user_account = 0;
$wish_list = 0;
$web_promotion = 0;
$total = 0;
$one_time_fee = 0;
$recurring_fee = 0;

if (isset($UpgradeDiskSpace)) {
	$disk_space = $disk_space + $pricing->getPrice("Disk Spaces",$DiskSpace);
	$disk_space = $disk_space + ($ExtraDiskSpace * $pricing->getPrice("Disk Spaces","Extra/MB"));
}

if (isset($UpgradeMailQuota)) {
	$mail_quota = $mail_quota + $pricing->getPrice("Disk Spaces",$MailQuota);
	$mail_quota = $mail_quota + ($ExtraMailQuota * $pricing->getPrice("Disk Spaces","Extra/MB"));
}

if (isset($UpgradeDBQuota)) {
	$db_quota = $db_quota + $pricing->getPrice("Disk Spaces",$DBQuota);
	$db_quota = $db_quota + ($ExtraDBQuota * $pricing->getPrice("Disk Spaces","Extra/MB"));
}

if (isset($UserAccount)) 
	$user_account = $pricing->getPrice("eCommerce Components","User Account");
	
if (isset($WishList)) 
	$wish_list = $pricing->getPrice("eCommerce Components","Wish List");
	
$total = $disk_space + $mail_quota + $db_quota + $user_account + $wish_list;
$recurring_fee = $disk_space + $mail_quota + $db_quota + $user_account + $wish_list;
?>
<html>
<head>
<title>Upgrade Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

	function calculateSubTotal(form) {
		form.action = "upgrade_request_form.php";
		form.method = "POST";
		form.submit();
	}

	function checkPaymentService(form) {
			calculateSubTotal(form);
	}
	
	function checkUserAccount(form) {
		if (form.UserAccount.checked == false)
			alert('You need a User Account component to run Wish List')
	}
		
</script>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Upgrade Request</strong></font> 
<form name="upgradeRequestForm" method="post" action="upgrade_request_form_result.php">
	<table width="100%" cellspacing="0" cellpadding="5" border="0" bordercolor="#CCCCCC">
    <tr>
      <th bgcolor="#CCCCCC"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Upgrade 
        Options</font></th>
      <th bgcolor="#CCCCCC"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Sub 
        Total</font></th>
	</tr>
	<tr>
      <td> <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Additional 
          Spaces:</b></font></p></td>
	</tr>
	<tr>
      <td> <blockquote> 
          <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
					<input type="checkbox" name="UpgradeDiskSpace" value="UpgradeDiskSpace" <? if (isset($UpgradeDiskSpace) && $UpgradeDiskSpace == "UpgradeDiskSpace") {?>checked<? }?> onClick="calculateSubTotal(this.form,this.name);">
					Disk Spaces: 
					<select name="DiskSpace" onChange="calculateSubTotal(this.form);">
						<option value="0" <? if (isset($DiskSpace) && $DiskSpace == "0") {?>selected<? }?>>None</option>
              <option value="25 MB" <? if (isset($DiskSpace) && $DiskSpace == "25 MB") {?>selected<? }?>>25 
              MB ($10/month)</option>
              <option value="50 MB" <? if (isset($DiskSpace) && $DiskSpace == "50 MB") {?>selected<? }?>>50 
              MB ($17/month)</option>
              <option value="100 MB" <? if (isset($DiskSpace) && $DiskSpace == "100 MB") {?>selected<? }?>>100 
              MB ($30/month)</option>
              <option value="250 MB" <? if (isset($DiskSpace) && $DiskSpace == "250 MB") {?>selected<? }?>>250 
              MB ($55/month)</option>
              <option value="500 MB" <? if (isset($DiskSpace) && $DiskSpace == "500 MB") {?>selected<? }?>>500 
              MB ($95/month)</option>
					</select>
					+ Extra: 
					<input type="text" name="ExtraDiskSpace" value="<? if (isset($ExtraDiskSpace)) {?><?=$ExtraDiskSpace?><? } else {?>0<? }?>" size="4" onChange="calculateSubTotal(this.form,this.name);">
            MB (50 cents/MB/month)</font></p>
        </blockquote></td>
      <td align="right" valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        $ <? printf("%01.2f",$disk_space);?> </font></td>
	</tr>
	<tr>
      <td> <blockquote> 
          <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
					<input type="checkbox" name="UpgradeMailQuota" value="UpgradeMailQuota" <? if (isset($UpgradeMailQuota) && $UpgradeMailQuota == "UpgradeMailQuota") {?>checked<? }?> onClick="calculateSubTotal(this.form,this.name);">
					Mail Quota: 
					<select name="MailQuota" onChange="calculateSubTotal(this.form);">
						<option value="0" <? if (isset($MailQuota) && $MailQuota == "0") {?>selected<? }?>>None</option>
              <option value="25 MB" <? if (isset($MailQuota) && $MailQuota == "25 MB") {?>selected<? }?>>25 
              MB ($10/month)</option>
              <option value="50 MB" <? if (isset($MailQuota) && $MailQuota == "50 MB") {?>selected<? }?>>50 
              MB ($17/month)</option>
              <option value="100 MB" <? if (isset($MailQuota) && $MailQuota == "100 MB") {?>selected<? }?>>100 
              MB ($30/month)</option>
              <option value="250 MB" <? if (isset($MailQuota) && $MailQuota == "250 MB") {?>selected<? }?>>250 
              MB ($55/month)</option>
              <option value="500 MB" <? if (isset($MailQuota) && $MailQuota == "500 MB") {?>selected<? }?>>500 
              MB ($95/month)</option>
					</select>
					+ Extra: 
					<input type="text" name="ExtraMailQuota" value="<? if (isset($ExtraMailQuota)) {?><?=$ExtraMailQuota?><? } else {?>0<? }?>" size="4" onChange="calculateSubTotal(this.form,this.name);">
            MB (50 cents/MB/month)</font></p>
        </blockquote></td>
      <td align="right" valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        $ <? printf("%01.2f",$mail_quota);?> </font></td>
	</tr>
	<tr>
      <td> <blockquote> 
          <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
					<input type="checkbox" name="UpgradeDBQuota" value="UpgradeDBQuota" <? if (isset($UpgradeDBQuota) && $UpgradeDBQuota == "UpgradeDBQuota") {?>checked<? }?> onClick="calculateSubTotal(this.form,this.name);">
					Database Quota: 
					<select name="DBQuota" onChange="calculateSubTotal(this.form);">
						<option value="0" <? if (isset($DBQuota) && $DBQuota == "0") {?>selected<? }?>>None</option>
              <option value="25 MB" <? if (isset($DBQuota) && $DBQuota == "25 MB") {?>selected<? }?>>25 
              MB ($10/month)</option>
              <option value="50 MB" <? if (isset($DBQuota) && $DBQuota == "50 MB") {?>selected<? }?>>50 
              MB ($17/month)</option>
              <option value="100 MB" <? if (isset($DBQuota) && $DBQuota == "100 MB") {?>selected<? }?>>100 
              MB ($30/month)</option>
              <option value="250 MB" <? if (isset($DBQuota) && $DBQuota == "250 MB") {?>selected<? }?>>250 
              MB ($55/month)</option>
              <option value="500 MB" <? if (isset($DBQuota) && $DBQuota == "500 MB") {?>selected<? }?>>500 
              MB ($95/month)</option>
					</select>
					+ Extra: 
            <input type="text" name="ExtraDBQuota" value="<? if (isset($ExtraDBQuota)) {?><?=$ExtraDBQuota?><? } else {?>0<? }?>" size="4">
            MB (50 cents/MB/month)</font></p>
        </blockquote></td>
      <td align="right" valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        $ <? printf("%01.2f",$db_quota);?> </font></td>
	</tr>
	<tr>
      <td> <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>eCommerce 
          Components:</b></font></p></td>
	</tr>
	<tr>
      <td> <blockquote> 
          <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <input type="checkbox" name="UserAccount" value="User Account" onClick="unselectWishList(this.form);calculateSubTotal(this.form);" <? if (isset($UserAccount)) {?>checked<? }?>>
            User Account ($10/month)</font></p>
        </blockquote></td>
      <td align="right" valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        $ <? printf("%01.2f",$user_account);?> </font></td>
	</tr>
	<tr>
      <td> <blockquote> 
          <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <input type="checkbox" name="WishList" value="Wish List" onClick="selectUserAccount(this.form);calculateSubTotal(this.form);" <? if (isset($WishList)) {?>checked<? }?>>
            Wish List ($5/month)</font></p>
        </blockquote></td>
      <td align="right" valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        $ <? printf("%01.2f",$wish_list);?> </font></td>
	</tr>
	<tr>
      <td> <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Web 
          Promotion:</b></font></p>
			<blockquote> 
          <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> For 
            Web Promotion, please visit our partner <a href="http://www.submitnet.net/affiliates.asp?aid=109&pid=1">SubmitNet, 
            inc</a>. They can help you to submit your site to 200 different search 
            engines and provide you with the Search Engine Optimization Tool, 
            so your website could achieve rank in major search engine like google, 
            excite, alta vista, etc. </font></p>
          </blockquote></td>
      <td align="right" valign="top"></td>
	</tr>
	<tr>
      <td bgcolor="#CCCCCC"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Total</font></td>
      <td align="right" valign="top" bgcolor="#CCCCCC"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">$ 
        <? printf("%01.2f",$total);?> </font></td>
	</tr>
	</table>
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
	<input type="hidden" name="total_fee" value="<?=$total?>">
	<input type="hidden" name="one_time_fee" value="<?=$one_time_fee?>">
	<input type="hidden" name="recurring_fee" value="<?=$recurring_fee?>">
  </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <p><font size="-1">One Time Upgrade Fee: $ <? printf("%01.2f",$one_time_fee);?></font></p>
  <p><font size="-1">Recurring Fee: $ <? printf("%01.2f",$recurring_fee);?></font></p>
  </font> 
  <p align="center"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <input type="submit" name="Submit" value="Send Request">
		<input type="reset" name="Submit2" value="Reset">
    </font></p>
</form>
<p align="left">&nbsp;</p>
</body>
</html>
