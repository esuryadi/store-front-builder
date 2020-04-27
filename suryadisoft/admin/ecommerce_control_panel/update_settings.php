<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/Log.php";
require_once "../../class/Themes.php";
require_once("../config.php");

if ($Tab == "Themes") {
	$theme = new Themes();
	$properties = $theme->getProperties($selected_theme,$selected_color_scheme);
}

$HTTP_SESSION_VARS["db_connect"]->open();
mysql_select_db($HTTP_SESSION_VARS["selected_db"]);

if ($Tab == "General") {
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'site_title'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('site_title','$site_title')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$site_title' WHERE property_name = 'site_title'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'keywords'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('keywords','$keywords')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$keywords' WHERE property_name = 'keywords'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'description'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('description','$description')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$description' WHERE property_name = 'description'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'logo_img_src'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('logo_img_src','$logo_img_src')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$logo_img_src' WHERE property_name = 'logo_img_src'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'logo_img_alt_text'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('logo_img_alt_text','$logo_img_alt_text')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$logo_img_alt_text' WHERE property_name = 'logo_img_alt_text'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'logo_img_text'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('logo_img_text','$logo_img_text')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$logo_img_text' WHERE property_name = 'logo_img_text'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'show_logo_img_txt'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($show_logo_img_txt))
		$show_logo_img_txt = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_logo_img_txt','$show_logo_img_txt')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$show_logo_img_txt' WHERE property_name = 'show_logo_img_txt'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_cust_info'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($ask_cust_info))
		$ask_cust_info = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_cust_info','$ask_cust_info')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$ask_cust_info' WHERE property_name = 'ask_cust_info'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_info'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($ask_shipping_info))
		$ask_shipping_info = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_info','$ask_shipping_info')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_info' WHERE property_name = 'ask_shipping_info'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_info'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($ask_billing_info))
		$ask_billing_info = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_info','$ask_billing_info')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_info' WHERE property_name = 'ask_billing_info'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'show_review_order'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($show_review_order))
		$show_review_order = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_review_order','$show_review_order')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$show_review_order' WHERE property_name = 'show_review_order'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'email_cust_inv'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($email_cust_inv))
		$email_cust_inv = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('email_cust_inv','$email_cust_inv')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$email_cust_inv' WHERE property_name = 'email_cust_inv'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'cc_cust_inv_email'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($cc_cust_inv_email))
		$cc_cust_inv_email = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('cc_cust_inv_email','$cc_cust_inv_email')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$cc_cust_inv_email' WHERE property_name = 'cc_cust_inv_email'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'cc_user_reg_email'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($cc_user_reg_email))
		$cc_user_reg_email = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('cc_user_reg_email','$cc_user_reg_email')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$cc_user_reg_email' WHERE property_name = 'cc_user_reg_email'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'cc_shipped_order_email'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($cc_shipped_order_email))
		$cc_shipped_order_email = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('cc_shipped_order_email','$cc_shipped_order_email')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$cc_shipped_order_email' WHERE property_name = 'cc_shipped_order_email'";
	
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'user_account'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($user_account))
		$user_account = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('user_account','$user_account')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$user_account' WHERE property_name = 'user_account'";

	$query = "SELECT * FROM PROPERTY WHERE property_name = 'wish_list'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if (!isset($wish_list))
		$wish_list = "no";
	if ($num_rows == 0)
		$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list','$wish_list')";
	else
		$query2[] = "UPDATE PROPERTY SET property_value = '$wish_list' WHERE property_name = 'wish_list'";

	if ($setting_type == "advance") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'other_meta_tags'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('other_meta_tags','$other_meta_tags')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$other_meta_tags' WHERE property_name = 'other_meta_tags'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'showSubCat'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($showSubCat))
			$showSubCat = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('showSubCat','$showSubCat')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$showSubCat' WHERE property_name = 'showSubCat'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'showRetailPrice'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($showRetailPrice))
			$showRetailPrice = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('showRetailPrice','$showRetailPrice')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$showRetailPrice' WHERE property_name = 'showRetailPrice'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'showCatNum'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($showCatNum))
			$showCatNum = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('showCatNum','$showCatNum')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$showCatNum' WHERE property_name = 'showCatNum'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'showStockStatus'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($showStockStatus))
			$showStockStatus = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('showStockStatus','$showStockStatus')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$showStockStatus' WHERE property_name = 'showStockStatus'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'showCondition'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($showCondition))
			$showCondition = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('showCondition','$showCondition')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$showCondition' WHERE property_name = 'showCondition'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'LogoRemoved'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($LogoRemoved))
			$LogoRemoved = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('LogoRemoved','$LogoRemoved')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$LogoRemoved' WHERE property_name = 'LogoRemoved'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'HomeRemoved'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($HomeRemoved))
			$HomeRemoved = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('HomeRemoved','$HomeRemoved')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$HomeRemoved' WHERE property_name = 'HomeRemoved'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'TaxShipping'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($TaxShipping))
			$TaxShipping = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('TaxShipping','$TaxShipping')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$TaxShipping' WHERE property_name = 'TaxShipping'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'agreement'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($agreement))
			$agreement = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('agreement','$agreement')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$agreement' WHERE property_name = 'agreement'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'agreement_text'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('agreement_text','$agreement_text')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$agreement_text' WHERE property_name = 'agreement_text'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'button_status'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('button_status','$button_status')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$button_status' WHERE property_name = 'button_status'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'resize_sm_img'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('resize_sm_img','$resize_sm_img')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$resize_sm_img' WHERE property_name = 'resize_sm_img'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'resize_sm_img_value'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('resize_sm_img_value','$resize_sm_img_value')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$resize_sm_img_value' WHERE property_name = 'resize_sm_img_value'";
	
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'resize_md_img'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('resize_md_img','$resize_md_img')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$resize_md_img' WHERE property_name = 'resize_md_img'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'resize_md_img_value'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('resize_md_img_value','$resize_md_img_value')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$resize_md_img_value' WHERE property_name = 'resize_md_img_value'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'our_price_color'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('our_price_color','$our_price_color')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$our_price_color' WHERE property_name = 'our_price_color'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'shopping_cart_message'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('shopping_cart_message','$shopping_cart_message')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$shopping_cart_message' WHERE property_name = 'shopping_cart_message'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'bg_sound_src'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('bg_sound_src','$bg_sound_src')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$bg_sound_src' WHERE property_name = 'bg_sound_src'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'css_file'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('css_file','$css_file')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$css_file' WHERE property_name = 'css_file'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_middle_name'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_middle_name))
			$ask_middle_name = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_middle_name','$ask_middle_name')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_middle_name' WHERE property_name = 'ask_middle_name'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_address_2'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_address_2))
			$ask_address_2 = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_address_2','$ask_address_2')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_address_2' WHERE property_name = 'ask_address_2'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_state'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_state))
			$ask_state = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_state','$ask_state')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_state' WHERE property_name = 'ask_state'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_province'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_province))
			$ask_province = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_province','$ask_province')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_province' WHERE property_name = 'ask_province'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_country'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_country))
			$ask_country = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_country','$ask_country')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_country' WHERE property_name = 'ask_country'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_phone_2'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_phone_2))
			$ask_phone_2 = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_phone_2','$ask_phone_2')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_phone_2' WHERE property_name = 'ask_phone_2'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_fax'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_fax))
			$ask_fax = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_fax','$ask_fax')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_fax' WHERE property_name = 'ask_fax'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_email'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_email))
			$ask_email = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_email','$ask_email')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_email' WHERE property_name = 'ask_email'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_middle_name'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_shipping_middle_name))
			$ask_shipping_middle_name = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_middle_name','$ask_shipping_middle_name')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_middle_name' WHERE property_name = 'ask_shipping_middle_name'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_address_2'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_shipping_address_2))
			$ask_shipping_address_2 = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_address_2','$ask_shipping_address_2')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_address_2' WHERE property_name = 'ask_shipping_address_2'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_state'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_shipping_state))
			$ask_shipping_state = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_state','$ask_shipping_state')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_state' WHERE property_name = 'ask_shipping_state'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_province'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_shipping_state))
			$ask_shipping_state = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_province','$ask_shipping_province')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_province' WHERE property_name = 'ask_shipping_province'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_shipping_country'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_shipping_country))
			$ask_shipping_country = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_shipping_country','$ask_shipping_country')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_shipping_country' WHERE property_name = 'ask_shipping_country'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_middle_name'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_billing_middle_name))
			$ask_billing_middle_name = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_middle_name','$ask_billing_middle_name')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_middle_name' WHERE property_name = 'ask_billing_middle_name'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_address_2'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_billing_address_2))
			$ask_billing_address_2 = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_address_2','$ask_billing_address_2')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_address_2' WHERE property_name = 'ask_billing_address_2'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_state'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_billing_state))
			$ask_billing_state = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_state','$ask_billing_state')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_state' WHERE property_name = 'ask_billing_state'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_province'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_billing_province))
			$ask_billing_province = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_province','$ask_billing_province')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_province' WHERE property_name = 'ask_billing_province'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ask_billing_country'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if (!isset($ask_billing_country))
			$ask_billing_country = "no";
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_billing_country','$ask_billing_country')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_billing_country' WHERE property_name = 'ask_billing_country'";
	}
	
	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else if ($Tab == "Themes") {
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'selected_theme'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('selected_theme','$selected_theme')";
	else
		$query = "UPDATE PROPERTY SET property_value = '$selected_theme' WHERE property_name = 'selected_theme'";
	$isSuccess = mysql_query($query);	
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'selected_color_scheme'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('selected_color_scheme','$selected_color_scheme')";
	else
		$query = "UPDATE PROPERTY SET property_value = '$selected_color_scheme' WHERE property_name = 'selected_color_scheme'";
	$isSuccess = mysql_query($query);	
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	
	for ($i=0;$i<count($properties);$i++) {
		$theme_prop = $properties[$i];
		$name = $selected_theme . "_" . str_replace(" ","_",strtolower($theme_prop["name"]));
		if ($name != ($selected_theme . "_preview_images")) {
			eval("\$value = \$$name;");		
			$query1 = "SELECT * FROM PROPERTY WHERE property_name = '$name'";
			$num_rows = mysql_num_rows(mysql_query($query1));
			if ($num_rows == 0)
				$query2 = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('$name','$value')";
			else
				$query2 = "UPDATE PROPERTY SET property_value = '$value' WHERE property_name = '$name'";
	
			$isSuccess = mysql_query($query2);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2 . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		if (isset($AdvanceSettings) && $AdvanceSettings == "true") {
			$name = $selected_theme . "_bg_img";
			eval("\$value = \$$name;");
			$query1 = "SELECT * FROM PROPERTY WHERE property_name = '$name'";
			$num_rows = mysql_num_rows(mysql_query($query1));
			if ($num_rows == 0)
				$query2 = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('$name','$value')";
			else
				$query2 = "UPDATE PROPERTY SET property_value = '$value' WHERE property_name = '$name'";
		
			$isSuccess = mysql_query($query2);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2 . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	}
} else if ($Tab == "Shipping") {
	$query = "SELECT * FROM PROPERTY WHERE property_name = 'shipping_mode'";
	$num_rows = mysql_num_rows(mysql_query($query));
	if ($num_rows == 0)
		$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('shipping_mode','$shipping_mode')";
	else
		$query = "UPDATE PROPERTY SET property_value = '$shipping_mode' WHERE property_name = 'shipping_mode'";
	$isSuccess = mysql_query($query);	
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	if ($shipping_mode == "auto") {
		if (isset($origin_region)) {
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'origin_region'";
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('origin_region','$origin_region')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$origin_region' WHERE property_name = 'origin_region'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		if (isset($origin_state)) {
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'origin_state'";
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('origin_state','$origin_state')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$origin_state' WHERE property_name = 'origin_state'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'origin_zipcode'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('origin_zipcode','$origin_zipcode')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$origin_zipcode' WHERE property_name = 'origin_zipcode'";
		$isSuccess = mysql_query($query);	
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
		if (isset($shipping_method)) {
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'shipping_method'";
			$method = implode(",",$shipping_method);
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('shipping_method','$method')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$method' WHERE property_name = 'shipping_method'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		if (isset($international_shipping_method)) {
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'international_shipping_method'";
			$int_method = implode(",",$international_shipping_method);
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('international_shipping_method','$int_method')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$int_method' WHERE property_name = 'international_shipping_method'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		if (isset($additional_services)) {
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'additional_services'";
			$add_svc = implode(",",$additional_services);
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('additional_services','$add_svc')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$add_svc' WHERE property_name = 'additional_services'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		} else {
			$query = "UPDATE PROPERTY SET property_value = '' WHERE property_name = 'additional_services'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
		if (!isset($free_shipping))
			$free_shipping = "false";
			
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'free_shipping'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('free_shipping','$free_shipping')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$free_shipping' WHERE property_name = 'free_shipping'";
		$isSuccess = mysql_query($query);	
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
			
		if (isset($free_shipping)) {
			if (isset($free_shipping_category)) {
				if (!isset($group_shipping))
					$group_shipping = "false";
					
				$query = "SELECT * FROM PROPERTY WHERE property_name = 'group_shipping'";
				$num_rows = mysql_num_rows(mysql_query($query));
				if ($num_rows == 0)
					$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('group_shipping','$group_shipping')";
				else
					$query = "UPDATE PROPERTY SET property_value = '$group_shipping' WHERE property_name = 'group_shipping'";
				$isSuccess = mysql_query($query);	
				if(!$isSuccess) {
					echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
					Log::write($query . "\n\n");
					Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
		
				$query = "SELECT * FROM PROPERTY WHERE property_name = 'free_shipping_category'";
				$num_rows = mysql_num_rows(mysql_query($query));
				if ($num_rows == 0)
					$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('free_shipping_category','$free_shipping_category')";
				else
					$query = "UPDATE PROPERTY SET property_value = '$free_shipping_category' WHERE property_name = 'free_shipping_category'";
				$isSuccess = mysql_query($query);	
				if(!$isSuccess) {
					echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
					Log::write($query . "\n\n");
					Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
				
				if ($free_shipping_category == "by price") {
					$property_name = "free_shipping_price";
					$property_value = $price;
				} else if ($free_shipping_category == "by city") {
					$property_name = "free_shipping_city";
					$property_value = $city;
				} else if ($free_shipping_category == "by zip") {
					$property_name = "free_shipping_zip";
					$property_value = $zip1 . "-" . $zip2;
				}
				
				$query = "SELECT * FROM PROPERTY WHERE property_name = '$property_name'";
				$num_rows = mysql_num_rows(mysql_query($query));
				if ($num_rows == 0)
					$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('$property_name','$property_value')";
				else
					$query = "UPDATE PROPERTY SET property_value = '$property_value' WHERE property_name = '$property_name'";
				$isSuccess = mysql_query($query);	
				if(!$isSuccess) {
					echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
					Log::write($query . "\n\n");
					Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
			}
		}
		if (!isset($extra_shipping))
			$extra_shipping = "false";
			
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'extra_shipping'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('extra_shipping','$extra_shipping')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$extra_shipping' WHERE property_name = 'extra_shipping'";
		$isSuccess = mysql_query($query);	
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
		if (isset($extra_shipping)) {
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'extra_shipping_fee'";
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('extra_shipping_fee','$extra_shipping_fee')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$extra_shipping_fee' WHERE property_name = 'extra_shipping_fee'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
			
			if (isset($extra_shipping_category)) {
				$query = "SELECT * FROM PROPERTY WHERE property_name = 'extra_shipping_category'";
				$num_rows = mysql_num_rows(mysql_query($query));
				if ($num_rows == 0)
					$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('extra_shipping_category','$extra_shipping_category')";
				else
					$query = "UPDATE PROPERTY SET property_value = '$extra_shipping_category' WHERE property_name = 'extra_shipping_category'";
				$isSuccess = mysql_query($query);	
				if(!$isSuccess) {
					echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
					Log::write($query . "\n\n");
					Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
				
				if ($extra_shipping_category == "by weight") {
					$property_name = "extra_shipping_weight";
					$property_value = $weight;
				} else if ($extra_shipping_category == "by city") {
					$property_name = "extra_shipping_city";
					$property_value = $city;
				} else if ($extra_shipping_category == "by zip") {
					$property_name = "extra_shipping_zip";
					$property_value = $zip1 . "-" . $zip2;
				}
				
				$query = "SELECT * FROM PROPERTY WHERE property_name = '$property_name'";
				$num_rows = mysql_num_rows(mysql_query($query));
				if ($num_rows == 0)
					$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('$property_name','$property_value')";
				else
					$query = "UPDATE PROPERTY SET property_value = '$property_value' WHERE property_name = '$property_name'";
				$isSuccess = mysql_query($query);	
				if(!$isSuccess) {
					echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
					Log::write($query . "\n\n");
					Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
				}
			}
		}
	} else {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'ship_rate_calc_method'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ship_rate_calc_method','$ship_rate_calc_method')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$ship_rate_calc_method' WHERE property_name = 'ship_rate_calc_method'";
		$isSuccess = mysql_query($query);	
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
		
		if ($ship_rate_calc_method == "by total purchase") {
			if (!isset($express_checkout))
				$express_checkout = "no";
			
			$query = "SELECT * FROM PROPERTY WHERE property_name = 'express_checkout'";
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows == 0)
				$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('express_checkout','$express_checkout')";
			else
				$query = "UPDATE PROPERTY SET property_value = '$express_checkout' WHERE property_name = 'express_checkout'";
			$isSuccess = mysql_query($query);	
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	}
} else if ($Tab == "Messages") {
	if ($message_type == "Account Registration") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'user_account_email_from'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('user_account_email_from','$user_account_email_from')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$user_account_email_from' WHERE property_name = 'user_account_email_from'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'user_account_email_cc'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('user_account_email_cc','$user_account_email_cc')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$user_account_email_cc' WHERE property_name = 'user_account_email_cc'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'user_account_email_subject'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('user_account_email_subject','$user_account_email_subject')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$user_account_email_subject' WHERE property_name = 'user_account_email_subject'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'user_account_email_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('user_account_email_body','$user_account_email_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$user_account_email_body' WHERE property_name = 'user_account_email_body'";
	} else if ($message_type == "Customer Invoice") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'invoice_email_from'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('invoice_email_from','$invoice_email_from')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$invoice_email_from' WHERE property_name = 'invoice_email_from'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'invoice_email_cc'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('invoice_email_cc','$invoice_email_cc')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$invoice_email_cc' WHERE property_name = 'invoice_email_cc'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'invoice_email_subject'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('invoice_email_subject','$invoice_email_subject')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$invoice_email_subject' WHERE property_name = 'invoice_email_subject'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'invoice_email_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('invoice_email_body','$invoice_email_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$invoice_email_body' WHERE property_name = 'invoice_email_body'";
	} else if ($message_type == "Partial Shipped Order") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'partial_shipped_order_email_from'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('partial_shipped_order_email_from','$partial_shipped_order_email_from')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$partial_shipped_order_email_from' WHERE property_name = 'partial_shipped_order_email_from'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'partial_shipped_order_email_cc'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('partial_shipped_order_email_cc','$partial_shipped_order_email_cc')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$partial_shipped_order_email_cc' WHERE property_name = 'partial_shipped_order_email_cc'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'partial_shipped_order_email_subject'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('partial_shipped_order_email_subject','$partial_shipped_order_email_subject')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$partial_shipped_order_email_subject' WHERE property_name = 'partial_shipped_order_email_subject'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'partial_shipped_order_email_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('partial_shipped_order_email_body','$partial_shipped_order_email_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$partial_shipped_order_email_body' WHERE property_name = 'partial_shipped_order_email_body'";
	} else if ($message_type == "Complete Shipped Order") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'complete_shipped_order_email_from'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('complete_shipped_order_email_from','$complete_shipped_order_email_from')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$complete_shipped_order_email_from' WHERE property_name = 'complete_shipped_order_email_from'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'complete_shipped_order_email_cc'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('complete_shipped_order_email_cc','$complete_shipped_order_email_cc')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$complete_shipped_order_email_cc' WHERE property_name = 'complete_shipped_order_email_cc'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'complete_shipped_order_email_subject'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('complete_shipped_order_email_subject','$complete_shipped_order_email_subject')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$complete_shipped_order_email_subject' WHERE property_name = 'complete_shipped_order_email_subject'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'complete_shipped_order_email_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('complete_shipped_order_email_body','$complete_shipped_order_email_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$complete_shipped_order_email_body' WHERE property_name = 'complete_shipped_order_email_body'";
	} else if ($message_type == "Share Wish List") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'wish_list_email_from'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list_email_from','$wish_list_email_from')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$wish_list_email_from' WHERE property_name = 'wish_list_email_from'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'wish_list_email_cc'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list_email_cc','$wish_list_email_cc')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$wish_list_email_cc' WHERE property_name = 'wish_list_email_cc'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'wish_list_email_subject'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list_email_subject','$wish_list_email_subject')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$wish_list_email_subject' WHERE property_name = 'wish_list_email_subject'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'wish_list_email_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list_email_body','$wish_list_email_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$wish_list_email_body' WHERE property_name = 'wish_list_email_body'";
	} else if ($message_type == "Send Password") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'password_email_from'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('wish_list_email_from','$password_email_from')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$password_email_from' WHERE property_name = 'password_email_from'";
	
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'password_email_cc'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('password_email_cc','$password_email_cc')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$password_email_cc' WHERE property_name = 'password_email_cc'";

		$query = "SELECT * FROM PROPERTY WHERE property_name = 'password_email_subject'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('password_email_subject','$password_email_subject')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$password_email_subject' WHERE property_name = 'password_email_subject'";
		
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'password_email_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('password_email_body','$password_email_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$password_email_body' WHERE property_name = 'password_email_body'";
	} else if ($message_type == "Process Order") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'process_order_body'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('process_order_body','$process_order_body')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$process_order_body' WHERE property_name = 'process_order_body'";
	}
	
	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}	
} else if ($Tab == "PaymentServices") {
	mysql_select_db(_ADMIN_DATABASE);
	$query = "UPDATE CLIENT_PAYMENT_SERVICE SET payment_service = '$payment_service' WHERE user_id = '$user_id'";
	$isSuccess = mysql_query($query);		
	if(!$isSuccess) {
		echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
		Log::write($query . "\n\n");
		Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
	}
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	if ($payment_service == "PayPal") {
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'paypal_account'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('paypal_account','$paypal_account')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$paypal_account' WHERE property_name = 'paypal_account'";
		$isSuccess = mysql_query($query);		
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
		if (!isset($skip_to_paypal)) $skip_to_paypal = "no";
		$query = "SELECT * FROM PROPERTY WHERE property_name = 'skip_to_paypal'";
		$num_rows = mysql_num_rows(mysql_query($query));
		if ($num_rows == 0)
			$query = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('skip_to_paypal','$skip_to_paypal')";
		else
			$query = "UPDATE PROPERTY SET property_value = '$skip_to_paypal' WHERE property_name = 'skip_to_paypal'";
		$isSuccess = mysql_query($query);		
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	} else if ($payment_service == "VeriSign PayFlow Link") {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_method'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_method','$verisign_method')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_method' WHERE property_name = 'verisign_method'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_trxtype'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_trxtype','$verisign_trxtype')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_trxtype' WHERE property_name = 'verisign_trxtype'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_user_id'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_user_id','$verisign_user_id')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_user_id' WHERE property_name = 'verisign_user_id'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_partner'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_partner','$verisign_partner')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_partner' WHERE property_name = 'verisign_partner'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_order_form'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_order_form','$verisign_order_form')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_order_form' WHERE property_name = 'verisign_order_form'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_email_customer'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_email_customer','$verisign_email_customer')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_email_customer' WHERE property_name = 'verisign_email_customer'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_show_confirmation'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_show_confirmation','$verisign_show_confirmation')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_show_confirmation' WHERE property_name = 'verisign_show_confirmation'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'record_transaction'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('record_transaction','$record_transaction')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$record_transaction' WHERE property_name = 'record_transaction'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'use_ssl'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('use_ssl','$use_ssl')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$use_ssl' WHERE property_name = 'use_ssl'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'show_payment_button'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('show_payment_button','$show_payment_button')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$show_payment_button' WHERE property_name = 'show_payment_button'";

		for ($i=0;$i<count($query2);$i++) {
			$isSuccess = mysql_query($query2[$i]);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2[$i] . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	} else if ($payment_service == "VeriSign PayFlow Pro") {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_trxmode'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_trxmode','$verisign_trxmode')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_trxmode' WHERE property_name = 'verisign_trxmode'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_tender'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_tender','$verisign_tender')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_tender' WHERE property_name = 'verisign_tender'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_trxtype'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_trxtype','$verisign_trxtype')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_trxtype' WHERE property_name = 'verisign_trxtype'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_user_id'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_user_id','$verisign_user_id')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_user_id' WHERE property_name = 'verisign_user_id'";
		
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_password'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_password','$verisign_password')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_password' WHERE property_name = 'verisign_password'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_vendor'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_vendor','$verisign_vendor')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_vendor' WHERE property_name = 'verisign_vendor'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'verisign_partner'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('verisign_partner','$verisign_partner')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$verisign_partner' WHERE property_name = 'verisign_partner'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'use_ssl'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('use_ssl','$use_ssl')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$use_ssl' WHERE property_name = 'use_ssl'";

		for ($i=0;$i<count($query2);$i++) {
			$isSuccess = mysql_query($query2[$i]);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2[$i] . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	} else if ($payment_service == "Paradata") {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'paradata_trxmode'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('paradata_trxmode','$paradata_trxmode')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$paradata_trxmode' WHERE property_name = 'paradata_trxmode'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'paradata_trxtype'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('paradata_trxtype','$paradata_trxtype')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$paradata_trxtype' WHERE property_name = 'paradata_trxtype'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'token_id'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('token_id','$token_id')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$token_id' WHERE property_name = 'token_id'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'use_ssl'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('use_ssl','$use_ssl')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$use_ssl' WHERE property_name = 'use_ssl'";
	
		for ($i=0;$i<count($query2);$i++) {
			$isSuccess = mysql_query($query2[$i]);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2[$i] . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	} else if ($payment_service == "Authorize.Net") {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'login_id'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('login_id','$login_id')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$login_id' WHERE property_name = 'login_id'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'transaction_key'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('transaction_key','$transaction_key')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$transaction_key' WHERE property_name = 'transaction_key'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'transaction_method'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('transaction_method','$transaction_method')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$transaction_method' WHERE property_name = 'transaction_method'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'transaction_type'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('transaction_type','$transaction_type')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$transaction_type' WHERE property_name = 'transaction_type'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'email_customer'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('email_customer','$email_customer')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$email_customer' WHERE property_name = 'email_customer'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'use_ssl'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('use_ssl','$use_ssl')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$use_ssl' WHERE property_name = 'use_ssl'";

		for ($i=0;$i<count($query2);$i++) {
			$isSuccess = mysql_query($query2[$i]);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2[$i] . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	} else {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'payment_method'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('payment_method','$payment_method')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$payment_method' WHERE property_name = 'payment_method'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'payment_message'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('payment_message','$payment_message')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$payment_message' WHERE property_name = 'payment_message'";

		for ($i=0;$i<count($query2);$i++) {
			$isSuccess = mysql_query($query2[$i]);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2[$i] . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	}
	
	if (isset($payment_type)) {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'ask_cvv'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('ask_cvv','$ask_cvv')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$ask_cvv' WHERE property_name = 'ask_cvv'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'payment_type'";
		$type = implode(",",$payment_type);
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('payment_type','$type')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$type' WHERE property_name = 'payment_type'";
		
		for ($i=0;$i<count($query2);$i++) {
			$isSuccess = mysql_query($query2[$i]);
			if(!$isSuccess) {
				echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
				Log::write($query2[$i] . "\n\n");
				Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
			}
		}
	}
	if (isset($other_payment_type)) {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'other_payment_type'";
		$type = implode(",",$other_payment_type);
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('other_payment_type','$type')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$type' WHERE property_name = 'other_payment_type'";
		
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'paypal_account'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('paypal_account','$paypal_account')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$paypal_account' WHERE property_name = 'paypal_account'";

		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'check_message'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows == 0)
			$query2[] = "INSERT INTO PROPERTY (property_name,property_value) VALUES ('check_message','$check_message')";
		else
			$query2[] = "UPDATE PROPERTY SET property_value = '$check_message' WHERE property_name = 'check_message'";
	} else {
		$query1 = "SELECT * FROM PROPERTY WHERE property_name = 'other_payment_type'";
		$num_rows = mysql_num_rows(mysql_query($query1));
		if ($num_rows > 0)
			$query2[] = "UPDATE PROPERTY SET property_value = '' WHERE property_name = 'other_payment_type'";
	}
	for ($i=0;$i<count($query2);$i++) {
		$isSuccess = mysql_query($query2[$i]);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query2[$i] . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
} else if ($Tab == "AccountInfo") {
	mysql_select_db(_ADMIN_DATABASE);
	if (isset($Action) && $Action == "EditClientInfo") {
		$query1 = "UPDATE USER SET first_name = '$first_name', last_name = '$last_name' WHERE user_id = '$user_id'";
		$isSuccess = mysql_query($query1);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
		$query2 = "UPDATE CLIENTS SET company_name = '$company_name', company_address1 = '$company_address1', company_address2 = '$company_address2', company_city = '$company_city', company_state = '$company_state', company_zip = '$company_zip', company_country = '$company_country', company_phone = '$company_phone', company_fax = '$company_fax', company_email = '$company_email' WHERE user_id = '$user_id'";
		$isSuccess = mysql_query($query2);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	} else if (isset($Action) && $Action == "EditBillingInfo") {
		$cc_exp_date = $cc_exp_mm . $cc_exp_yyyy;
		$query = "UPDATE BILLING SET billing_first_name = '$billing_first_name', billing_last_name = '$billing_last_name', billing_address_1 = '$billing_address_1', billing_address_2 = '$billing_address_2', billing_city = '$billing_city', billing_state = '$billing_state', billing_zip = '$billing_zip', billing_country = '$billing_country', billing_phone = '$billing_phone', payment_type = '$payment_type', account_number = '$account_number', cc_exp_date = '$cc_exp_date' WHERE user_id = '$user_id'";
		$isSuccess = mysql_query($query);
		if(!$isSuccess) {
			echo "<b>MYSQL ERROR " . mysql_errno() . ":</b> " . mysql_error();
			Log::write($query . "\n\n");
			Log::write("ERROR " . mysql_errno() . ": " . mysql_error() . "\n\n");
		}
	}
}

$HTTP_SESSION_VARS["db_connect"]->close();
?>
<html>
<head>
<title>Update Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($isSuccess) {?>
	<? if ($Tab == "Messages") {?>
	<meta http-equiv="refresh" content="0;URL=settings.php?Tab=<?=$Tab?>&message_type=<?=$message_type?>">
	<? } else if ($Tab == "Themes") {?>
	<meta http-equiv="refresh" content="0;URL=settings.php?Tab=<?=$Tab?>&AdvanceSettings=<?=$AdvanceSettings?>">
	<? } else if (isset($Action) && $Action == "UploadImage") {?>
	<meta http-equiv="refresh" content="0;URL=file_upload.php?file_type=image&page=settings&Tab=<?=$Tab?>">
	<? } else if (isset($Action) && $Action == "UploadFile") {?>
	<meta http-equiv="refresh" content="0;URL=file_upload.php?file_type=<?=$file_type?>&setting_type=<?=$setting_type?>&page=settings&Tab=<?=$Tab?>">
	<? } else {?>
	<meta http-equiv="refresh" content="0;URL=settings.php?Tab=<?=$Tab?><? if(isset($setting_type)) {?>&setting_type=<?=$setting_type?><? }?>">
	<? }?>
<? }?>
</head>
<body vlink="00aeef">
</body>
</html>
