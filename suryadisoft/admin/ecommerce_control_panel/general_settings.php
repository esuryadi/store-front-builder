<form name="updateSettings" enctype="multipart/form-data" method="post" action="update_settings.php?Tab=<?=$Tab?>">
  <input type="hidden" name="setting_type" value="<?=$setting_type?>">
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><strong>Web 
    site title:</strong> 
    <input name="site_title" type="text" value="<? if (isset($prop["site_title"])) {?><?=$prop["site_title"]?><? } else {?><?=$admin->getCompanyName()?><? }?>" size="50">
    </font></p>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>META 
        Keywords:</strong></font></td>
      <td>&nbsp;<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <textarea name="keywords" cols="40" rows="3" id="textarea2"><? if (isset($prop["keywords"])) {?><?=$prop["keywords"]?><? }?></textarea>
        </font></td>
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;separated 
        by comma</font></td>
    </tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>META 
        Description:</strong></font></td>
      <td>&nbsp;<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <textarea name="description" cols="50" rows="5" id="keywords2"><? if (isset($prop["description"])) {?><?=$prop["description"]?><? }?></textarea>
        </font></td>
    </tr>
  </table>
  <? if (isset($setting_type) && $setting_type == "advance") {?>
  <br>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td valign="top"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Other 
        META Tags :</strong></font></td>
      <td>&nbsp;<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <textarea name="other_meta_tags" cols="50" rows="5" id="other_meta_tags"><? if (isset($prop["other_meta_tags"])) {?><?=$prop["other_meta_tags"]?><? }?></textarea>
        </font></td>
    </tr>
  </table>
  <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Background 
    Sound/Music: 
    <input name="bg_sound_src" type="text" id="bg_sound_src" value="<? if (isset($bg_sound_src)) {?><?=$bg_sound_src?><? } else if (isset($prop["bg_sound_src"])) {?><?=$prop["bg_sound_src"]?><? }?>">
    <input name="UploadFileButton" type="button" id="UploadFileButton" value="Upload File" onClick="uploadFile(this.form,'sound_file');">
    </font></strong></p>
  <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Cascading 
    Style Sheet (CSS): 
    <input name="css_file" type="text" id="css_file" value="<? if (isset($css_file)) {?><?=$css_file?><? } else if (isset($prop["css_file"])) {?><?=$prop["css_file"]?><? }?>">
    <input name="UploadFileButton" type="button" id="UploadFileButton" value="Upload File" onClick="uploadFile(this.form,'css_file');">
    </font></strong></p>
  <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product 
    Description:</font></strong></p>
  <blockquote> 
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="showSubCat" type="checkbox" id="showSubCat" value="yes" <? if ((!isset($prop["showSubCat"]) || $prop["showSubCat"] == "yes")) {?>checked<? }?>>
      Show Sub Category</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="showRetailPrice" type="checkbox" id="showRetailPrice" value="yes" <? if ((!isset($prop["showRetailPrice"]) || $prop["showRetailPrice"] == "yes")) {?>checked<? }?>>
      Show Retail Price</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="showCondition" type="checkbox" id="showCondition" value="yes" <? if ((!isset($prop["showCondition"]) || $prop["showCondition"] == "yes")) {?>checked<? }?>>
      Show Condition</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="showCatNum" type="checkbox" id="showCatNum" value="yes" <? if ((!isset($prop["showCatNum"]) || $prop["showCatNum"] == "yes")) {?>checked<? }?>>
      Show Catalog Number</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="showStockStatus" type="checkbox" id="showStockStatus" value="yes" <? if (!isset($prop["showStockStatus"]) || $prop["showStockStatus"] == "yes") {?>checked<? }?>>
      Show Stock Status</font></strong></p>
  </blockquote>
  <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product 
    Image Resize:</font></strong></p>
  <blockquote> 
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Resize 
      Small Image based on: 
      <input type="radio" name="resize_sm_img" value="width" <? if ($prop["resize_sm_img"] == "width") {?>checked<? }?>>
      Width 
      <input name="resize_sm_img" type="radio" value="height" <? if (!isset($prop["resize_sm_img"]) || $prop["resize_sm_img"] == "height") {?>checked<? }?>>
      Height 
      <input type="radio" name="resize_sm_img" value="noresize" <? if ($prop["resize_sm_img"] == "noresize") {?>checked<? }?>>
      No Resize</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Resize 
      Value: 
      <input name="resize_sm_img_value" type="text" id="resize_sm_img_value" value="<? if (isset($prop["resize_sm_img_value"])) {?><?=$prop["resize_sm_img_value"]?><? } else {?>75<? }?>" size="3" maxlength="3">
      </font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Resize 
      Medium Image based on: 
      <input name="resize_md_img" type="radio" value="width" <? if (!isset($prop["resize_md_img"]) || $prop["resize_md_img"] == "width") {?>checked<? }?>>
      Width 
      <input type="radio" name="resize_md_img" value="height" <? if ($prop["resize_sm_img"] == "height") {?>checked<? }?>>
      Height 
      <input type="radio" name="resize_md_img" value="No Resize" <? if ($prop["resize_sm_img"] == "noresize") {?>checked<? }?>>
      No Resize</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Resize 
      Value: 
      <input name="resize_md_img_value" type="text" id="resize_md_img_value" value="<? if (isset($prop["resize_md_img_value"])) {?><?=$prop["resize_md_img_value"]?><? } else {?>255<? }?>" size="3" maxlength="3">
      </font></strong></p>
  </blockquote>
  <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Other:</font></strong></p>
  <blockquote> 
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="LogoRemoved" type="checkbox" id="LogoRemoved" value="yes" <? if ((isset($prop["LogoRemoved"]) && $prop["LogoRemoved"] == "yes")) {?>checked<? }?>>
      Remove SuryadiSoft Logo</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="HomeRemoved" type="checkbox" id="HomeRemoved" value="yes" <? if ((isset($prop["HomeRemoved"]) && $prop["HomeRemoved"] == "yes")) {?>checked<? }?>>
      Remove the default Home Category</font></strong></p>
	 <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="TaxShipping" type="checkbox" id="TaxShipping" value="yes" <? if ((isset($prop["TaxShipping"]) && $prop["TaxShipping"] == "yes")) {?>checked<? }?>>
      Tax the shipping charges</font></strong></p>
    <p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Our 
      Price Color: 
      <input name="our_price_color" type="text" id="our_price_color" value="<? if (isset($prop["our_price_color"])) {?><?=$prop["our_price_color"]?><? } else {?>#FF0000<? }?>" size="6">
      </font></strong></p>
	<p><strong><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Back to the last item message (on shopping cart):<br> 
      <input name="shopping_cart_message" type="text" id="shopping_cart_message" value="<? if (isset($prop["shopping_cart_message"])) {?><?=$prop["shopping_cart_message"]?><? } else {?>Click Here - To add additional size/color combinations of the last item placed in the shopping cart.<? }?>" size="100">
</font></strong></p>
	<p>
	  <strong>
<input name="agreement" type="checkbox" id="agreement" value="yes" <? if ((isset($prop["agreement"]) && $prop["agreement"] == "yes")) {?>checked<? }?>>
Add an Agreement Statement:</strong></p>
	<blockquote>
	  <p>
	    <textarea name="agreement_text" cols="60" rows="5" id="agreement_text"><? if (isset($prop["agreement_text"])) {?><?=$prop["agreement_text"]?><? }?>
	    </textarea>
        </p>
	  <p>
	    <input name="button_status" type="radio" value="disabled" <? if (!isset($prop["button_status"]) || (isset($prop["button_status"]) && $prop["button_status"] == "disabled")) {?>checked<? }?>> 
	    Your customer cannot process order without agreeing your terms<br>
	    <input name="button_status" type="radio" value="enabled" <? if ((isset($prop["button_status"]) && $prop["button_status"] == "enabled")) {?>checked<? }?>>
Your	customer can process order regardless </p>
    </blockquote>
  </blockquote>
  <? }?>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Logo 
    Image Src:</strong> 
    <input type="text" name="logo_img_src" value="<? if (isset($logo_img_src)) {?><?=$logo_img_src?><? } else if (isset($prop["logo_img_src"])) {?><?=$prop["logo_img_src"]?><? }?>">
    <strong>Alt Text:</strong> 
    <input name="logo_img_alt_text" type="text" id="logo_img_alt_text" size="10" value="<? if (isset($logo_img_alt_text)) {?><?=$logo_img_alt_text?><? } else if (isset($prop["logo_img_alt_text"])) {?><?=$prop["logo_img_alt_text"]?><? }?>">
    <input name="UploadButton" type="button" value="Upload Image" onClick="uploadImage(this.form);">
    </font></p>
  <blockquote>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Logo Text:</strong> 
      <input name="logo_img_text" type="text" id="logo_img_text" size="70" value="<? if (isset($logo_img_text)) {?><?=$logo_img_text?><? } else if (isset($prop["logo_img_text"])) {?><?=$prop["logo_img_text"]?><? }?>">
      </font> </p>
    <p> 
      <input name="show_logo_img_txt" type="checkbox" id="show_logo_img_txt" value="yes" <? if (isset($prop["show_logo_img_txt"]) && $prop["show_logo_img_txt"] == "yes") {?>checked<? }?>>
      Show Both Logo Image and Text</p>
  </blockquote>
  <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Check-Out 
    Process:</strong></font></p>
  <blockquote> 
    <p> 
      <input name="ask_cust_info" type="checkbox" id="ask_cust_info" value="yes" <? if ((isset($prop["ask_cust_info"]) && $prop["ask_cust_info"] == "yes") || !isset($prop["ask_cust_info"])) {?>checked<? }?>>
      Ask Customer Information</p>
	<? if (isset($setting_type) && $setting_type == "advance") {?>
    <blockquote>
      <p>
        <input name="ask_middle_name" type="checkbox" id="ask_middle_name" value="yes" <? if ((isset($prop["ask_middle_name"]) && $prop["ask_middle_name"] == "yes") || !isset($prop["ask_middle_name"])) {?>checked<? }?>>
        Ask Middle Name<br>
        <input name="ask_address_2" type="checkbox" id="ask_address_2" value="yes" <? if ((isset($prop["ask_address_2"]) && $prop["ask_address_2"] == "yes") || !isset($prop["ask_address_2"])) {?>checked<? }?>>
        Ask Address 2<br>
        <input name="ask_state" type="checkbox" id="ask_state" value="yes" <? if ((isset($prop["ask_state"]) && $prop["ask_state"] == "yes") || !isset($prop["ask_state"])) {?>checked<? }?>>
        Ask US States<br>
        <input name="ask_province" type="checkbox" id="ask_province" value="yes" <? if ((isset($prop["ask_province"]) && $prop["ask_province"] == "yes") || !isset($prop["ask_province"])) {?>checked<? }?>>
        Ask Province<br>
        <input name="ask_country" type="checkbox" id="ask_country" value="yes" <? if ((isset($prop["ask_country"]) && $prop["ask_country"] == "yes") || !isset($prop["ask_country"])) {?>checked<? }?>>
        Ask Country<br>
		<input name="ask_phone_2" type="checkbox" id="ask_phone_2" value="yes" <? if ((isset($prop["ask_phone_2"]) && $prop["ask_phone_2"] == "yes") || !isset($prop["ask_phone_2"])) {?>checked<? }?>>
        Ask Second Phone<br>
		<input name="ask_fax" type="checkbox" id="ask_fax" value="yes" <? if ((isset($prop["ask_fax"]) && $prop["ask_fax"] == "yes") || !isset($prop["ask_fax"])) {?>checked<? }?>>
        Ask Fax<br>
		<input name="ask_email" type="checkbox" id="ask_email" value="yes" <? if ((isset($prop["ask_email"]) && $prop["ask_email"] == "yes") || !isset($prop["ask_email"])) {?>checked<? }?>>
        Ask Email </p>
    </blockquote>
	<? }?>
    <p><input name="ask_shipping_info" type="checkbox" id="ask_shipping_info" value="yes" <? if ((isset($prop["ask_shipping_info"]) && $prop["ask_shipping_info"] == "yes") || !isset($prop["ask_shipping_info"])) {?>checked<? }?>>
      Ask Shipping Information</p>
	<? if (isset($setting_type) && $setting_type == "advance") {?>
    <blockquote>
      <p>
        <input name="ask_shipping_middle_name" type="checkbox" id="ask_shipping_middle_name" value="yes" <? if ((isset($prop["ask_shipping_middle_name"]) && $prop["ask_shipping_middle_name"] == "yes") || !isset($prop["ask_shipping_middle_name"])) {?>checked<? }?>>
        Ask Shipping Middle Name<br>
        <input name="ask_shipping_address_2" type="checkbox" id="ask_shipping_address_2" value="yes" <? if ((isset($prop["ask_shipping_address_2"]) && $prop["ask_shipping_address_2"] == "yes") || !isset($prop["ask_shipping_address_2"])) {?>checked<? }?>>
        Ask Shipping Address 2<br>
        <input name="ask_shipping_state" type="checkbox" id="ask_shipping_state" value="yes" <? if ((isset($prop["ask_shipping_state"]) && $prop["ask_shipping_state"] == "yes") || !isset($prop["ask_shipping_state"])) {?>checked<? }?>>
        Ask Shipping US States<br>
        <input name="ask_shipping_province" type="checkbox" id="ask_shipping_province" value="yes" <? if ((isset($prop["ask_shipping_province"]) && $prop["ask_shipping_province"] == "yes") || !isset($prop["ask_shipping_province"])) {?>checked<? }?>>
        Ask Shipping Province<br>
        <input name="ask_shipping_country" type="checkbox" id="ask_shipping_country" value="yes" <? if ((isset($prop["ask_shipping_country"]) && $prop["ask_shipping_country"] == "yes") || !isset($prop["ask_shipping_country"])) {?>checked<? }?>>
        Ask Shipping Country </p>
    </blockquote>
	<? }?>
	<p> 
      <input name="ask_billing_info" type="checkbox" id="ask_billing_info" value="yes" <? if ((isset($prop["ask_billing_info"]) && $prop["ask_billing_info"] == "yes") || !isset($prop["ask_billing_info"])) {?>checked<? }?>>
      Ask Billing Information</p>
	<? if (isset($setting_type) && $setting_type == "advance") {?>
    <blockquote>
      <p>
        <input name="ask_billing_middle_name" type="checkbox" id="ask_billing_middle_name" value="yes" <? if ((isset($prop["ask_billing_middle_name"]) && $prop["ask_billing_middle_name"] == "yes") || !isset($prop["ask_billing_middle_name"])) {?>checked<? }?>>
        Ask Billing Middle Name<br>
        <input name="ask_billing_address_2" type="checkbox" id="ask_billing_address_2" value="yes" <? if ((isset($prop["ask_billing_address_2"]) && $prop["ask_billing_address_2"] == "yes") || !isset($prop["ask_billing_address_2"])) {?>checked<? }?>>
        Ask Billing Address 2<br>
        <input name="ask_billing_state" type="checkbox" id="ask_billing_state" value="yes" <? if ((isset($prop["ask_billing_state"]) && $prop["ask_billing_state"] == "yes") || !isset($prop["ask_billing_state"])) {?>checked<? }?>>
        Ask Billing US States<br>
        <input name="ask_billing_province" type="checkbox" id="ask_billing_province" value="yes" <? if ((isset($prop["ask_billing_province"]) && $prop["ask_billing_province"] == "yes") || !isset($prop["ask_billing_province"])) {?>checked<? }?>>
        Ask Billing Province<br>
        <input name="ask_billing_country" type="checkbox" id="ask_billing_country" value="yes" <? if ((isset($prop["ask_billing_country"]) && $prop["ask_billing_country"] == "yes") || !isset($prop["ask_billing_country"])) {?>checked<? }?>>
        Ask Billing Country </p>
    </blockquote>
	<? }?>
	<p> 
      <input name="show_review_order" type="checkbox" id="show_review_order" value="yes" <? if ((isset($prop["show_review_order"]) && $prop["show_review_order"] == "yes") || !isset($prop["show_review_order"])) {?>checked<? }?>>
      Show Review Order Page</p>
  </blockquote>
  <p><strong>Email Messages:</strong></p>
  <blockquote> 
    <p> 
      <input name="email_cust_inv" type="checkbox" id="email_cust_inv" value="yes" <? if (!isset($prop["email_cust_inv"]) || (isset($prop["email_cust_inv"]) && $prop["email_cust_inv"] == "yes")) {?>checked<? }?>>
      Email invoice to your customer</p>
	<p> 
      <input name="cc_cust_inv_email" type="checkbox" id="cc_cust_inv_email" value="yes" <? if (isset($prop["cc_cust_inv_email"]) && $prop["cc_cust_inv_email"] == "yes") {?>checked<? }?>>
      Send the copy of customer invoice email to you</p>
    <? if (array_search("User Account",$admin->getComponent($userid)) > -1) {?>
    <p> 
      <input name="cc_user_reg_email" type="checkbox" id="cc_user_reg_email" value="yes" <? if (isset($prop["cc_user_reg_email"]) && $prop["cc_user_reg_email"] == "yes") {?>checked<? }?>>
      Send the copy of user registration email to you</p>
    <? }?>
    <p> 
      <input name="cc_shipped_order_email" type="checkbox" id="cc_shipped_order_email" value="yes" <? if (isset($prop["cc_shipped_order_email"]) && $prop["cc_shipped_order_email"] == "yes") {?>checked<? }?>>
      Send the copy of shipped order email to you</p>
  </blockquote>
  <? if (array_search("User Account",$admin->getComponent($userid)) > -1 || array_search("Wish List",$admin->getComponent($userid)) > -1) {?>
  <p><strong>E-Store Components:</strong></p>
  <blockquote> 
    <? if (array_search("User Account",$admin->getComponent($userid)) > -1) {?>
    <p align="left"> 
      <input name="user_account" type="checkbox" id="user_account" value="yes" onClick="unselectWishList(this.form);" <? if ((isset($prop["user_account"]) && $prop["user_account"] == "yes") || !isset($prop["user_account"])) {?>checked<? }?>>
      Show User Account</p>
    <? }?>
    <? if (array_search("Wish List",$admin->getComponent($userid)) > -1) {?>
    <p align="left"> 
      <input name="wish_list" type="checkbox" id="wish_list" value="yes" onClick="selectUserAccount(this.form);" <? if ((isset($prop["wish_list"]) && $prop["wish_list"] == "yes") || !isset($prop["wish_list"])) {?>checked<? }?>>
      Show Wish List</p>
    <? }?>
  </blockquote>
  <? }?>
  <p align="center"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <input type="submit" name="UpdateSettingsButton" value="Update Settings">
    <input type="reset" name="Reset" value="Reset">
    <? if(isset($setting_type) && $setting_type == "advance") {?>
    <input name="BasicSettingsButton" type="button" id="BasicSettingsButton" value="Basic Settings" onClick="changeSettingType('basic');">
    <? } else {?>
    <input name="AdvanceSettingsButton" type="button" id="AdvanceSettingsButton" value="Advance Settings" onClick="changeSettingType('advance');">
    <? }?>
    <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#general_setting','help');">
    </font></p>
</form>
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font>
