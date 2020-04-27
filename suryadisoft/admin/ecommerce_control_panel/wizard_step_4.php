<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {
	$logout = true;
} else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	if (isset($Action) && $Action == "set component") {
		$query = Array();
		
		switch($position) {
			case "Top": $component_type = $top_component;
						break;
			case "Left": $component_type = $left_component;
						 break;
			case "Center": $component_type = $center_component;
						   break;
			case "Right": $component_type = $right_component;
						  break;
			case "Bottom": $component_type = $bottom_component;
						   break;
		}
		
		$query [] = "DELETE FROM WEB_CONTENT WHERE position = '$position' AND category = '$page_name'";
	
		if ($component_type == "Blank Page")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Blank Page','','blank_page.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "About Us")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('About Us','','about_us.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Contact Form")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Contact Form','','contact_form.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "All Products")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('All Products','','all_products.php','No Frame','$position','1','built-in','$page_name','Images List')";
		else if ($component_type == "Product Group")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Product Group','','product_group.php','No Frame','$position','1','built-in','$page_name','Images List')";
		else if ($component_type == "New Items")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('New Items','','new_items.php','No Frame','$position','1','built-in','$page_name','Images List')";
		else if ($component_type == "Used Items")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Used Items','','used_items.php','No Frame','$position','1','built-in','$page_name','Images List')";
		else if ($component_type == "Refurbished Items")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Refurbished Items','','refurbished_items.php','No Frame','$position','1','built-in','$page_name','Images List')";
		else if ($component_type == "Welcome")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Welcome','','welcome.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Affiliate")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Affiliate','','affiliate.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Browse")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Browse','','browse.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Search")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Search','','search_product.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Search Product 2")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Search Product 2','','search_product_2.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Image")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Image','','image.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Login")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Login','','login.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Clock Applet")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Clock Applet','','clock.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Ticker Applet")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Ticker Applet','','ticker.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Photo Viewer Applet")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Photo Viewer Applet','','photo_viewer.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Simple Clock")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Simple Clock','','simple_clock.htm','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "View Cart")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('View Cart','','view_cart.php','No Frame','$position','1','built-in','$page_name','Standard')";
		else if ($component_type == "Sub Category 2")
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Sub Category 2','','sub_category_2.php','No Frame','$position','1','built-in','$page_name','Standard')";
		
		for ($i=0;$i<count($query);$i++) {
			mysql_query($query[$i]) or die(mysql_error());
		}
		
		$query = "select id from WEB_CONTENT where category = '$page_name' and position = 'Top' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query));
		$comp_id ["Top"] = $rs[0];
			
		$query = "select id from WEB_CONTENT where category = '$page_name' and position = 'Left' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query));
		$comp_id ["Left"] = $rs[0];
			
		$query = "select id, component_name from WEB_CONTENT where category = '$page_name' and position = 'Center' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query));
		$comp_id ["Center"] = $rs[0];
		
		$query = "select id, component_name from WEB_CONTENT where category = '$page_name' and position = 'Right' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query));
		$comp_id ["Right"] = $rs[0];
			
		$query = "select id, component_name from WEB_CONTENT where category = '$page_name' and position = 'Bottom' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query));
		$comp_id ["Bottom"] = $rs[0];
	} else {
		if (isset($page_layout) && ($page_layout == "top, two columns" || $page_layout == "top, three columns" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {
			$query [] = "DELETE FROM WEB_CONTENT WHERE position = 'Top' AND category = '$page_name'";
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Ticker Applet','','ticker.php','No Frame','Top','1','built-in','$page_name','Standard')";
			$top_component = "Ticker Applet";
		}
		if (isset($page_layout) && ($page_layout == "two columns" || $page_layout == "three columns" || $page_layout == "top, two columns" || $page_layout == "top, three columns" ||  $page_layout == "two columns, bottom" || $page_layout == "three columns, bottom" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {
			$query [] = "DELETE FROM WEB_CONTENT WHERE position = 'Left' AND category = '$page_name'";
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Blank Page','','blank_page.php','No Frame','Left','1','built-in','$page_name','Standard')";
			$left_component = "Blank Page";
		}
		if (isset($page_layout) && ($page_layout == "one column" || $page_layout == "three columns" || $page_layout == "top, three columns" || $page_layout == "three columns, bottom" || $page_layout == "top, three columns, bottom")) {
			$query [] = "DELETE FROM WEB_CONTENT WHERE position = 'Center' AND category = '$page_name'";
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('All Products','','all_products.php','No Frame','Center','1','built-in','$page_name','Images List')";
			$center_component = "All Products";
		}
		if (isset($page_layout) && ($page_layout == "two columns" || $page_layout == "three columns" || $page_layout == "top, two columns" || $page_layout == "top, three columns" ||  $page_layout == "two columns, bottom" || $page_layout == "three columns, bottom" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {
			$query [] = "DELETE FROM WEB_CONTENT WHERE position = 'Right' AND category = '$page_name'";
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Blank Page','','blank_page.php','No Frame','Right','1','built-in','$page_name','Standard')";
			$right_component = "Blank Page";		
		}
		if (isset($page_layout) && ($page_layout == "two columns, bottom" || $page_layout == "three columns, bottom" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {
			$query [] = "DELETE FROM WEB_CONTENT WHERE position = 'Bottom' AND category = '$page_name'";
			$query [] = "INSERT INTO WEB_CONTENT (component_name,title,filename,type,position,sequence,component_type,category,style) VALUES ('Clock Applet','','clock.php','No Frame','Bottom','1','built-in','$page_name','Standard')";
			$bottom_component = "Clock Applet";	
		}
		for ($i=0;$i<count($query);$i++) {
			mysql_query($query[$i]) or die(mysql_error());
		}
		
		$query2 = "select id from WEB_CONTENT where category = '$page_name' and position = 'Top' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query2));
		$comp_id ["Top"] = $rs[0];
			
		$query2 = "select id from WEB_CONTENT where category = '$page_name' and position = 'Left' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query2));
		$comp_id ["Left"] = $rs[0];
			
		$query2 = "select id, component_name from WEB_CONTENT where category = '$page_name' and position = 'Center' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query2));
		$comp_id ["Center"] = $rs[0];
			
		$query2 = "select id, component_name from WEB_CONTENT where category = '$page_name' and position = 'Right' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query2));
		$comp_id ["Right"] = $rs[0];
			
		$query2 = "select id, component_name from WEB_CONTENT where category = '$page_name' and position = 'Bottom' order by sequence";
		$rs = mysql_fetch_row(mysql_query($query2));
		$comp_id ["Bottom"] = $rs[0];
	}
	
	$HTTP_SESSION_VARS["db_connect"]->close();
		
	$logout = false;
}
?>
<html>
<head>
<title>Online Store Builder Wizard - Step 4</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style1 {
	font-size: smaller;
	font-weight: bold;
	color: #FFFFFF;
}
.style2 {font-size: smaller}
.style4 {font-size: smaller; font-weight: bold; }
-->
</style>
</head>
<script language="javascript">
<!--
<? if ($logout) {?>
window.open("../login.php?Action=logout&session_out=true","_top");
<? }?>

	function setComponent(position,form) {
		form.action = "wizard_step_4.php?position=" + position;
		form.submit();
	}
-->
</script>
<body>
<form action="wizard_step_5.php" method="post" name="ComponentForm" id="ComponentForm">
<input type="hidden" name="Action" value="set component">
<input type="hidden" name="page_name" value="<?=$page_name?>">
<input type="hidden" name="page_category" value="<?=$page_category?>">
<input type="hidden" name="main_category" value="<?=$main_category?>">
<input type="hidden" name="page_layout" value="<?=$page_layout?>">
<table width="600" height="450" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="00AEEF">
<tr><td>
<table width="100%" height="100%" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
<tr>
  <td bgcolor="00AEEF" height="5%"><span class="style1">Online Store Builder Wizard - Step 4 </span></td>
</tr>
<tr><td height="90%">
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td><table width="100%" height="350" border="1" cellpadding="5" cellspacing="0" bordercolor="#4ACDFF">
      <tr>
        <td width="40%" valign="top" bgcolor="#CCF1FF">
        <? if (isset($component_type) && $component_type == "Blank Page") {?>
		<p class="style2"><strong>Blank Page Component:</strong></p>
		<p class="style2">Blank Page component allows you to compose your own page content using HTML code or our HTML Editor. This component gives you a freedom to put whatever contents you like inside the component. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Blank Page component.  </p>
		<? } else if (isset($component_type) && $component_type == "About Us") {?>
		<p class="style2"><strong>About Us Page Component:</strong></p>
		<p class="style2">About Us component is a pre-formatted blank page component that is divided into 6 paragraphs. It's normally used to describe your company mission,  vision and history. Just like blank page component you can manipulate each paragraph layout with HTML code or our HTML Editor. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your About Us component.  </p>
		<? } else if (isset($component_type) && $component_type == "Contact Form") {?>
		<p class="style2"><strong>Contact Form Component:</strong></p>
		<p class="style2">Contact Form component allows your customer to contact you or asking questions to you by filling-up the contact form in your web site. The submitted form will be sent to your company email. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Contact Form component.  </p>
		<? } else if (isset($component_type) && $component_type == "All Products") {?>
		<p class="style2"><strong>Product Component:</strong></p>
		<p class="style2">Product component allows you to show the list all your products/items for this category/page. Other products that belong to other category/page will not be shown in this page. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Product component.  </p>
		<? } else if (isset($component_type) && $component_type == "Product Group") {?>
		<p class="style2"><strong>Product Group Component:</strong></p>
		<p class="style2">Product group component allows you to show a selected group of products/items for this category/page. Instead of showing all the products, you can freely selected what products need to be shown in this product group component. However, other products that belong to other category/page, although selected in this product group component, will not be shown in this page. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Product Group component.  </p>
		<? } else if (isset($component_type) && $component_type == "New Items") {?>
		<p class="style2"><strong>New Product Component:</strong></p>
		<p class="style2">New Product Component allows you to show all your products/items which in new condition only. Other new products that belong to other category/page will not be shown in this page.</p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your New Product component.  </p>
		<? } else if (isset($component_type) && $component_type == "Used Items") {?>
		<p class="style2"><strong>Used Product Component:</strong></p>
		<p class="style2">Used Product Component allows you to show all your products/items which in used condition only. Other used products that belong to other category/page will not be shown in this page.</p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Used Product component.  </p>
		<? } else if (isset($component_type) && $component_type == "Refurbished Items") {?>
		<p class="style2"><strong>Refurbished Product Component:</strong></p>
		<p class="style2">Refurbished Product Component allows you to show all your products/items which in refurbished/re-manufactured condition only. Other refurbished products that belong to other category/page will not be shown in this page.</p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Refurbished Product component.  </p>
		<? } else if (isset($component_type) && $component_type == "Welcome") {?>
		<p class="style2"><strong>Welcome Page Component:</strong></p>
		<p class="style2">Welcome  component is a pre-formatted blank page component that combines images and paragraphs. It's normally used to give an introduction about your website. Just like blank page component you can manipulate each paragraph layout with HTML code or our HTML Editor. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Welcome component.  </p>
		<? } else if (isset($component_type) && $component_type == "Affiliate") {?>
		<p class="style2"><strong>Affiliate Component:</strong></p>
		<p class="style2">Affiliate  component is one of the effective marketing tool to bring potential buyers and direct traffic to your website. By adding the affiliate component, you allow visitors of your website to register as your affiliate and add the affiliate link to your website from their website. If the incoming traffic from your affiliat resulting a successful transaction, you can offer your affiliate a  commission fee. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Affiliate component.  </p>
		<? } else if (isset($component_type) && $component_type == "Browse") {?>
		<p class="style2"><strong>Browse Component:</strong></p>
		<p class="style2">Browse  component allows you to show the whole list of your pages and sub-pages in chronological order. Its function is similar to site map. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Browse component.  </p>
		<? } else if (isset($component_type) && $component_type == "Search") {?>
		<p class="style2"><strong>Search Component (ver 1):</strong></p>
		<p class="style2">Search  component allows your customer to search any products/items from your entire product database. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Search component.  </p>
		<? } else if (isset($component_type) && $component_type == "Search Product 2") {?>
		<p class="style2"><strong>Search Component (ver 2):</strong></p>
		<p class="style2">Search  component allows your customer to search any products/items from your entire product database. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Search component.  </p>
		<? } else if (isset($component_type) && $component_type == "Image") {?>
		<p class="style2"><strong>Image Component:</strong></p>
		<p class="style2">Image  component allows you to add an image into your page. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Image component.  </p>
		<? } else if (isset($component_type) && $component_type == "Login") {?>
		<p class="style2"><strong>User Login Component:</strong></p>
		<p class="style2">User Login   component allows you to add a user login section into your page, so your customer can login to their account using this component.</p>
		<p class="style2">You need to have a user account feature on your online store account in order to show this component.  </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your user login component.  </p>
		<? } else if (isset($component_type) && $component_type == "Clock Applet") {?>
		<p class="style2"><strong>Clock Applet Component:</strong></p>
		<p class="style2">Clock Applet   component is a Java Applet that allows you to show date and time to your customer in colorful appearance.</p>
		<p class="style2">You can adjust the font, size, and color of the clock from the Component Settingss. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Clock Applet component.  </p>
		<? } else if (isset($component_type) && $component_type == "Ticker Applet") {?>
		<p class="style2"><strong>Ticker Applet Component:</strong></p>
		<p class="style2">Ticker Applet   component is a Java Applet that allows you to show an animated moving messages or images on your website.</p>
		<p class="style2">You can adjust the font, size, and color of the ticker from the Component Settingss. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Ticker Applet component.  </p>
		<? } else if (isset($component_type) && $component_type == "Photo Viewer Applet") {?>
		<p class="style2"><strong>Photo Viewer Applet Component:</strong></p>
		<p class="style2">Photo Viewer  Applet   component is a Java Applet that allows you to show series of images like a sliding presentation.</p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Photo Viewer Applet component.  </p>
		<? } else if (isset($component_type) && $component_type == "Simple Clock") {?>
		<p class="style2"><strong>JavaScript Clock Component:</strong></p>
		<p class="style2">JavaScript Clock  component allows you to show time only to your customer in simple form. Nothing fancy, just text based. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your JavaScript Clock component.  </p>
		<? } else if (isset($component_type) && $component_type == "View Cart") {?>
		<p class="style2"><strong>Preview Cart Component:</strong></p>
		<p class="style2">Preview Cart    component allows your customer to preview the number of items in their shopping cart.</p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Preview Cart component.  </p>
		<? } else if (isset($component_type) && $component_type == "Sub Category 2") {?>
		<p class="style2"><strong>Sub Page Level 2  Component:</strong></p>
		<p class="style2">Sub Page Level 2     component allows you to show the sub page level 2 links. Normally, this sub page links will not displayed in your page unless you add this component. </p>
		<p class="style2">Click the <b>Component Settings</b> button to change the settings and appearances of your Sub Page Level 2 component.  </p>
		<? } else {?>
		<p><strong><span class="style2">What is store components?</span></strong></p>
		<p class="style2">A store component is a site content application that can be added or removed from your page layout section. For example, you can add a product catalog, image, your own html content, java  applet, etc. into your web page.</p>
		<p class="style2">If you don't select any components at this time, your page will come up blank. If you plan to add the components later to this page, you have to do it from <a href="menu_bottom.php?page=manage_store"><strong>Manage Store</strong></a> section. </p>
		<? }?>
		<? if (isset($component_type) && ($component_type == "All Products" || $component_type == "Product Group" || $component_type == "New Items" || $component_type == "Used Items" || $component_type == "Refurbished Items")) {?>
		<p class="style2">Click <b>Add Product</b> button to add your products for this component.</p>
		<? } else if (isset($component_type) && ($component_type == "Blank Page" || $component_type == "About Us" || $component_type == "Contact Form" || $component_type == "Welcome" || $component_type == "Image" || $component_type == "Clock Applet" || $component_type == "Ticker Applet" || $component_type == "Photo Viewer Applet")) {?>
		<p class="style2">Click <b>Edit Contents</b> button to modify the text or options of your components.</p>
		<? }?>
		</td>
	  </tr>
    </table>
	</td>
    <td width="60%" valign="top">
	<p class="style2"><strong>Page Name:</strong>	  <?=$page_name?></p>
	<? if (isset($page_layout) && ($page_layout == "top, two columns" || $page_layout == "top, three columns" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {?>
      <p><span class="style4">Select the store component on the top area:</span><br>
          <select name="top_component" id="top_component" onChange="setComponent('Top',this.form);">
            <option value="" <? if ((isset($top_component) && $top_component == "")) {?>selected<? }?>>No Contents for this page</option>
            <option value="All Products" <? if ((isset($top_component) && $top_component == "All Products")) {?>selected<? }?>>Product Component</option>
            <option value="Product Group" <? if ((isset($top_component) && $top_component == "Product Group")) {?>selected<? }?>>Product Group Component</option>
            <option value="New Items" <? if ((isset($top_component) && $top_component == "New Items")) {?>selected<? }?>>New Product Component</option>
            <option value="Used Items" <? if ((isset($top_component) && $top_component == "Used Items")) {?>selected<? }?>>Used Product Component</option>
            <option value="Refurbished Items" <? if ((isset($top_component) && $top_component == "Refurbished Items")) {?>selected<? }?>>Refurbished Product Component</option>
            <option value="Blank Page" <? if ((isset($top_component) && $top_component == "Blank Page")) {?>selected<? }?>>Blank Page Component</option>
            <option value="About Us" <? if ((isset($top_component) && $top_component == "About Us")) {?>selected<? }?>>About Us page Component</option>
            <option value="Contact Form" <? if ((isset($top_component) && $top_component == "Contact Form")) {?>selected<? }?>>Contact Form Component</option>
            <option value="Welcome" <? if ((isset($top_component) && $top_component == "Welcome")) {?>selected<? }?>>Welcome Page Component</option>
            <option value="Affiliate" <? if ((isset($top_component) && $top_component == "Affiliate")) {?>selected<? }?>>Affiliate Component</option>
            <option value="Browse" <? if ((isset($top_component) && $top_component == "Browse")) {?>selected<? }?>>Browse Component</option>
            <option value="Search" <? if ((isset($top_component) && $top_component == "Search")) {?>selected<? }?>>Search Component (ver 1)</option>
            <option value="Search Product 2" <? if ((isset($top_component) && $top_component == "Search Product 2")) {?>selected<? }?>>Search Component (ver 2)</option>
            <option value="Image" <? if ((isset($top_component) && $top_component == "Image")) {?>selected<? }?>>Image Component</option>
            <option value="Login" <? if ((isset($top_component) && $top_component == "Login")) {?>selected<? }?>>User Login Component</option>
            <option value="Clock Applet" <? if ((isset($top_component) && $top_component == "Clock Applet")) {?>selected<? }?>>Clock Applet Component</option>
            <option value="Ticker Applet" <? if ((isset($top_component) && $top_component == "Ticker Applet") || (!isset($top_component))) {?>selected<? }?>>Ticker Applet Component</option>
            <option value="Photo Viewer Applet" <? if ((isset($top_component) && $top_component == "Photo Viewer Applet")) {?>selected<? }?>>Photo Viewer Applet Component</option>
            <option value="Simple Clock" <? if ((isset($top_component) && $top_component == "Simple Clock")) {?>selected<? }?>>JavaScript Clock Component</option>
            <option value="View Cart" <? if ((isset($top_component) && $top_component == "View Cart")) {?>selected<? }?>>Preview Cart Component</option>
            <option value="Sub Category 2" <? if ((isset($top_component) && $top_component == "Sub Category 2")) {?>selected<? }?>>Sub Page Level 2 Component</option>
          </select>
          <br>
          <? if (isset($top_component) && $top_component != "") {?>
		  <input name="settingButton" type="button" id="settingButton" value="Component Settings" onClick="window.open('web_content.php?Action=Update&Mode=wizard&id=<?=$comp_id["Top"]?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>','component','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=0,left=120,width=700,height=720');">
		  <? if ($top_component == "All Products" || $top_component == "New Items" || $top_component == "Used Items" || $top_component == "Refurbished Items" || $top_component == "Product Group") {?>
		  <input name="addProductButton" type="button" value="Add Product" onClick="window.open('product.php?Action=Add&Mode=wizard&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<?=$top_component?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? } else if ($top_component == "Blank Page" || $top_component == "About Us" || $top_component == "Contact Form" || $top_component == "Welcome" || $top_component == "Image" || $top_component == "Clock Applet" || $top_component == "Ticker Applet" || $top_component == "Photo Viewer Applet") {?>
		  <input name="editContentsButton" type="button" value="Edit Contents" onClick="window.open('component_properties_frame.php?Action=Update&selected_component=<?=$top_component?>&id=<?=$comp_id["Top"]?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? }?>
		  <? }?>
</p>
      <? }?>
      <? if (isset($page_layout) && ($page_layout == "two columns" || $page_layout == "three columns" || $page_layout == "top, two columns" || $page_layout == "top, three columns" ||  $page_layout == "two columns, bottom" || $page_layout == "three columns, bottom" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {?>
      <p><span class="style4">Select the store component on the left area:</span><br>
          <select name="left_component" id="left_component" onChange="setComponent('Left',this.form);">
            <option value="" <? if ((isset($left_component) && $left_component == "")) {?>selected<? }?>>No Contents for this page</option>
            <option value="All Products" <? if ((isset($left_component) && $left_component == "All Products")) {?>selected<? }?>>Product Component</option>
            <option value="Product Group" <? if ((isset($left_component) && $left_component == "Product Group")) {?>selected<? }?>>Product Group Component</option>
            <option value="New Items" <? if ((isset($left_component) && $left_component == "New Items")) {?>selected<? }?>>New Product Component</option>
            <option value="Used Items" <? if ((isset($left_component) && $left_component == "Used Items")) {?>selected<? }?>>Used Product Component</option>
            <option value="Refurbished Items" <? if ((isset($left_component) && $left_component == "Refurbished Items")) {?>selected<? }?>>Refurbished Product Component</option>
            <option value="Blank Page" <? if ((isset($left_component) && $left_component == "Blank Page") || (!isset($left_component))) {?>selected<? }?>>Blank Page Component</option>
            <option value="About Us" <? if ((isset($left_component) && $left_component == "About Us")) {?>selected<? }?>>About Us page Component</option>
            <option value="Contact Form" <? if ((isset($left_component) && $left_component == "Contact Form")) {?>selected<? }?>>Contact Form Component</option>
            <option value="Welcome" <? if ((isset($left_component) && $left_component == "Welcome")) {?>selected<? }?>>Welcome Page Component</option>
            <option value="Affiliate" <? if ((isset($left_component) && $left_component == "Affiliate")) {?>selected<? }?>>Affiliate Component</option>
            <option value="Browse" <? if ((isset($left_component) && $left_component == "Browse")) {?>selected<? }?>>Browse Component</option>
            <option value="Search" <? if ((isset($left_component) && $left_component == "Search")) {?>selected<? }?>>Search Component (ver 1)</option>
            <option value="Search Product 2" <? if ((isset($left_component) && $left_component == "Search Product 2")) {?>selected<? }?>>Search Component (ver 2)</option>
            <option value="Image" <? if ((isset($left_component) && $left_component == "Image")) {?>selected<? }?>>Image Component</option>
            <option value="Login" <? if ((isset($left_component) && $left_component == "Login")) {?>selected<? }?>>User Login Component</option>
            <option value="Clock Applet" <? if ((isset($left_component) && $left_component == "Clock Applet")) {?>selected<? }?>>Clock Applet Component</option>
            <option value="Ticker Applet" <? if ((isset($left_component) && $left_component == "Ticker Applet")) {?>selected<? }?>>Ticker Applet Component</option>
            <option value="Photo Viewer Applet" <? if ((isset($left_component) && $left_component == "Photo Viewer Applet")) {?>selected<? }?>>Photo Viewer Applet Component</option>
            <option value="Simple Clock" <? if ((isset($left_component) && $left_component == "Simple Clock")) {?>selected<? }?>>JavaScript Clock Component</option>
            <option value="View Cart" <? if ((isset($left_component) && $left_component == "View Cart")) {?>selected<? }?>>Preview Cart Component</option>
            <option value="Sub Category 2" <? if ((isset($left_component) && $left_component == "Sub Category 2")) {?>selected<? }?>>Sub Page Level 2 Component</option>
          </select>
          <br>
          <? if (isset($left_component) && $left_component != "") {?>
		  <input name="settingButton2" type="button" id="settingButton2" value="Component Settings" onClick="window.open('web_content.php?Action=Update&Mode=wizard&id=<?=$comp_id["Left"]?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>','component','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=0,left=120,width=700,height=720');">
		  <? if ($left_component == "All Products" || $left_component == "New Items" || $left_component == "Used Items" || $left_component == "Refurbished Items" || $left_component == "Product Group") {?>
		  <input name="addProductButton" type="button" value="Add Product" onClick="window.open('product.php?Action=Add&Mode=wizard&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<?=$left_component?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? } else if ($left_component == "Blank Page" || $left_component == "About Us" || $left_component == "Contact Form" || $left_component == "Welcome" || $left_component == "Image" || $left_component == "Clock Applet" || $left_component == "Ticker Applet" || $left_component == "Photo Viewer Applet") {?>
		  <input name="editContentsButton" type="button" value="Edit Contents" onClick="window.open('component_properties_frame.php?Action=Update&selected_component=<?=$left_component?>&id=<?=$comp_id["Left"]?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? }?>
		  <? }?>
</p>
      <? }?>
      <? if (isset($page_layout) && ($page_layout == "one column" || $page_layout == "three columns" || $page_layout == "top, three columns" || $page_layout == "three columns, bottom" || $page_layout == "top, three columns, bottom")) {?>
      <p><span class="style4">Select the store component on the center area:</span><br>
          <select name="center_component" id="center_component" onChange="setComponent('Center',this.form);">
            <option value="" <? if ((isset($center_component) && $center_component == "")) {?>selected<? }?>>No Contents for this page</option>
            <option value="All Products" <? if ((isset($center_component) && $center_component == "All Products") || (!isset($center_component))) {?>selected<? }?>>Product Component</option>
            <option value="Product Group" <? if ((isset($center_component) && $center_component == "Product Group")) {?>selected<? }?>>Product Group Component</option>
            <option value="New Items" <? if ((isset($center_component) && $center_component == "New Items")) {?>selected<? }?>>New Product Component</option>
            <option value="Used Items" <? if ((isset($center_component) && $center_component == "Used Items")) {?>selected<? }?>>Used Product Component</option>
            <option value="Refurbished Items" <? if ((isset($center_component) && $center_component == "Refurbished Items")) {?>selected<? }?>>Refurbished Product Component</option>
            <option value="Blank Page" <? if ((isset($center_component) && $center_component == "Blank Page")) {?>selected<? }?>>Blank Page Component</option>
            <option value="About Us" <? if ((isset($center_component) && $center_component == "About Us")) {?>selected<? }?>>About Us page Component</option>
            <option value="Contact Form" <? if ((isset($center_component) && $center_component == "Contact Form")) {?>selected<? }?>>Contact Form Component</option>
            <option value="Welcome" <? if ((isset($center_component) && $center_component == "Welcome")) {?>selected<? }?>>Welcome Page Component</option>
            <option value="Affiliate" <? if ((isset($center_component) && $center_component == "Affiliate")) {?>selected<? }?>>Affiliate Component</option>
            <option value="Browse" <? if ((isset($center_component) && $center_component == "Browse")) {?>selected<? }?>>Browse Component</option>
            <option value="Search" <? if ((isset($center_component) && $center_component == "Search")) {?>selected<? }?>>Search Component (ver 1)</option>
            <option value="Search Product 2" <? if ((isset($center_component) && $center_component == "Search Product 2")) {?>selected<? }?>>Search Component (ver 2)</option>
            <option value="Image" <? if ((isset($center_component) && $center_component == "Image")) {?>selected<? }?>>Image Component</option>
            <option value="Login" <? if ((isset($center_component) && $center_component == "Login")) {?>selected<? }?>>User Login Component</option>
            <option value="Clock Applet" <? if ((isset($center_component) && $center_component == "Clock Applet")) {?>selected<? }?>>Clock Applet Component</option>
            <option value="Ticker Applet" <? if ((isset($center_component) && $center_component == "Ticker Applet")) {?>selected<? }?>>Ticker Applet Component</option>
            <option value="Photo Viewer Applet" <? if ((isset($center_component) && $center_component == "Photo Viewer Applet")) {?>selected<? }?>>Photo Viewer Applet Component</option>
            <option value="Simple Clock" <? if ((isset($center_component) && $center_component == "Simple Clock")) {?>selected<? }?>>JavaScript Clock Component</option>
            <option value="View Cart" <? if ((isset($center_component) && $center_component == "View Cart")) {?>selected<? }?>>Preview Cart Component</option>
            <option value="Sub Category 2" <? if ((isset($center_component) && $center_component == "Sub Category 2")) {?>selected<? }?>>Sub Page Level 2 Component</option>
          </select>
          <br>
          <? if (isset($center_component) && $center_component != "") {?>
		  <input name="settingButton3" type="button" id="settingButton3" value="Component Settings" onClick="window.open('web_content.php?Action=Update&Mode=wizard&id=<?=$comp_id["Center"]?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>','component','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=0,left=120,width=700,height=720');">
		  <? if ($center_component == "All Products" || $center_component == "New Items" || $center_component == "Used Items" || $center_component == "Refurbished Items" || $center_component == "Product Group") {?>
		  <input name="addProductButton" type="button" value="Add Product" onClick="window.open('product.php?Action=Add&Mode=wizard&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<?=$center_component?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? } else if ($center_component == "Blank Page" || $center_component == "About Us" || $center_component == "Contact Form" || $center_component == "Welcome" || $center_component == "Image" || $center_component == "Clock Applet" || $center_component == "Ticker Applet" || $center_component == "Photo Viewer Applet") {?>
		  <input name="editContentsButton" type="button" value="Edit Contents" onClick="window.open('component_properties_frame.php?Action=Update&selected_component=<?=$center_component?>&id=<?=$comp_id["Center"]?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? }?>
		  <? }?>
</p>
      <? }?>
      <? if (isset($page_layout) && ($page_layout == "two columns" || $page_layout == "three columns" || $page_layout == "top, two columns" || $page_layout == "top, three columns" ||  $page_layout == "two columns, bottom" || $page_layout == "three columns, bottom" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {?>
      <p><span class="style4">Select the store component on the right area:</span><br>
          <select name="right_component" id="right_component" onChange="setComponent('Right',this.form);">
            <option value="" <? if ((isset($right_component) && $right_component == "")) {?>selected<? }?>>No Contents for this page</option>
            <option value="All Products" <? if ((isset($right_component) && $right_component == "All Products")) {?>selected<? }?>>Product Component</option>
            <option value="Product Group" <? if ((isset($right_component) && $right_component == "Product Group")) {?>selected<? }?>>Product Group Component</option>
            <option value="New Items" <? if ((isset($right_component) && $right_component == "New Items")) {?>selected<? }?>>New Product Component</option>
            <option value="Used Items" <? if ((isset($right_component) && $right_component == "Used Items")) {?>selected<? }?>>Used Product Component</option>
            <option value="Refurbished Items" <? if ((isset($right_component) && $right_component == "Refurbished Items")) {?>selected<? }?>>Refurbished Product Component</option>
            <option value="Blank Page" <? if ((isset($right_component) && $right_component == "Blank Page") || (!isset($right_component))) {?>selected<? }?>>Blank Page Component</option>
            <option value="About Us" <? if ((isset($right_component) && $right_component == "About Us")) {?>selected<? }?>>About Us page Component</option>
            <option value="Contact Form" <? if ((isset($right_component) && $right_component == "Contact Form")) {?>selected<? }?>>Contact Form Component</option>
            <option value="Welcome" <? if ((isset($right_component) && $right_component == "Welcome")) {?>selected<? }?>>Welcome Page Component</option>
            <option value="Affiliate" <? if ((isset($right_component) && $right_component == "Affiliate")) {?>selected<? }?>>Affiliate Component</option>
            <option value="Browse" <? if ((isset($right_component) && $right_component == "Browse")) {?>selected<? }?>>Browse Component</option>
            <option value="Search" <? if ((isset($right_component) && $right_component == "Search")) {?>selected<? }?>>Search Component (ver 1)</option>
            <option value="Search Product 2" <? if ((isset($right_component) && $right_component == "Search Product 2")) {?>selected<? }?>>Search Component (ver 2)</option>
            <option value="Image" <? if ((isset($right_component) && $right_component == "Image")) {?>selected<? }?>>Image Component</option>
            <option value="Login" <? if ((isset($right_component) && $right_component == "Login")) {?>selected<? }?>>User Login Component</option>
            <option value="Clock Applet" <? if ((isset($right_component) && $right_component == "Clock Applet")) {?>selected<? }?>>Clock Applet Component</option>
            <option value="Ticker Applet" <? if ((isset($right_component) && $right_component == "Ticker Applet")) {?>selected<? }?>>Ticker Applet Component</option>
            <option value="Photo Viewer Applet" <? if ((isset($right_component) && $right_component == "Photo Viewer Applet")) {?>selected<? }?>>Photo Viewer Applet Component</option>
            <option value="Simple Clock" <? if ((isset($right_component) && $right_component == "Simple Clock")) {?>selected<? }?>>JavaScript Clock Component</option>
            <option value="View Cart" <? if ((isset($right_component) && $right_component == "View Cart")) {?>selected<? }?>>Preview Cart Component</option>
            <option value="Sub Category 2" <? if ((isset($right_component) && $right_component == "Sub Category 2")) {?>selected<? }?>>Sub Page Level 2 Component</option>
          </select>
          <br>
          <? if (isset($right_component) && $right_component != "") {?>
		  <input name="settingButton4" type="button" id="settingButton4" value="Component Settings" onClick="window.open('web_content.php?Action=Update&Mode=wizard&id=<?=$comp_id["Right"]?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>','component','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=0,left=120,width=700,height=720');">
		  <? if ($right_component == "All Products" || $right_component == "New Items" || $right_component == "Used Items" || $right_component == "Refurbished Items" || $right_component == "Product Group") {?>
		  <input name="addProductButton" type="button" value="Add Product" onClick="window.open('product.php?Action=Add&Mode=wizard&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<?=$right_component?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? } else if ($right_component == "Blank Page" || $right_component == "About Us" || $right_component == "Contact Form" || $right_component == "Welcome" || $right_component == "Image" || $right_component == "Clock Applet" || $right_component == "Ticker Applet" || $right_component == "Photo Viewer Applet") {?>
		  <input name="editContentsButton" type="button" value="Edit Contents" onClick="window.open('component_properties_frame.php?Action=Update&selected_component=<?=$right_component?>&id=<?=$comp_id["Right"]?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? }?>
		  <? }?>
</p>
      <? }?>
      <? if (isset($page_layout) && ($page_layout == "two columns, bottom" || $page_layout == "three columns, bottom" || $page_layout == "top, two columns, bottom" || $page_layout == "top, three columns, bottom")) {?>
      <p><span class="style2"><strong>Select the store component on the bottom area</strong>:</span><br>
          <select name="bottom_component" id="bottom_component" onChange="setComponent('Bottom',this.form);">
            <option value="" <? if ((isset($bottom_component) && $bottom_component == "")) {?>selected<? }?>>No Contents for this page</option>
            <option value="All Products" <? if ((isset($bottom_component) && $bottom_component == "All Products")) {?>selected<? }?>>Product Component</option>
            <option value="Product Group" <? if ((isset($bottom_component) && $bottom_component == "Product Group")) {?>selected<? }?>>Product Group Component</option>
            <option value="New Items" <? if ((isset($bottom_component) && $bottom_component == "New Items")) {?>selected<? }?>>New Product Component</option>
            <option value="Used Items" <? if ((isset($bottom_component) && $bottom_component == "Used Items")) {?>selected<? }?>>Used Product Component</option>
            <option value="Refurbished Items" <? if ((isset($bottom_component) && $bottom_component == "Refurbished Items")) {?>selected<? }?>>Refurbished Product Component</option>
            <option value="Blank Page" <? if ((isset($bottom_component) && $bottom_component == "Blank Page")) {?>selected<? }?>>Blank Page Component</option>
            <option value="About Us" <? if ((isset($bottom_component) && $bottom_component == "About Us")) {?>selected<? }?>>About Us page Component</option>
            <option value="Contact Form" <? if ((isset($bottom_component) && $bottom_component == "Contact Form")) {?>selected<? }?>>Contact Form Component</option>
            <option value="Welcome" <? if ((isset($bottom_component) && $bottom_component == "Welcome")) {?>selected<? }?>>Welcome Page Component</option>
            <option value="Affiliate" <? if ((isset($bottom_component) && $bottom_component == "Affiliate")) {?>selected<? }?>>Affiliate Component</option>
            <option value="Browse" <? if ((isset($bottom_component) && $bottom_component == "Browse")) {?>selected<? }?>>Browse Component</option>
            <option value="Search" <? if ((isset($bottom_component) && $bottom_component == "Search")) {?>selected<? }?>>Search Component (ver 1)</option>
            <option value="Search Product 2" <? if ((isset($bottom_component) && $bottom_component == "Search Product 2")) {?>selected<? }?>>Search Component (ver 2)</option>
            <option value="Image" <? if ((isset($bottom_component) && $bottom_component == "Image")) {?>selected<? }?>>Image Component</option>
            <option value="Login" <? if ((isset($bottom_component) && $bottom_component == "Login")) {?>selected<? }?>>User Login Component</option>
            <option value="Clock Applet" <? if ((isset($bottom_component) && $bottom_component == "Clock Applet") || (!isset($bottom_component))) {?>selected<? }?>>Clock Applet Component</option>
            <option value="Ticker Applet" <? if ((isset($bottom_component) && $bottom_component == "Ticker Applet")) {?>selected<? }?>>Ticker Applet Component</option>
            <option value="Photo Viewer Applet" <? if ((isset($bottom_component) && $bottom_component == "Photo Viewer Applet")) {?>selected<? }?>>Photo Viewer Applet Component</option>
            <option value="Simple Clock" <? if ((isset($bottom_component) && $bottom_component == "Simple Clock")) {?>selected<? }?>>JavaScript Clock Component</option>
            <option value="View Cart" <? if ((isset($bottom_component) && $bottom_component == "View Cart")) {?>selected<? }?>>Preview Cart Component</option>
            <option value="Sub Category 2" <? if ((isset($bottom_component) && $bottom_component == "Sub Category 2")) {?>selected<? }?>>Sub Page Level 2 Component</option>
          </select>
          <br>
          <? if (isset($bottom_component) && $bottom_component != "") {?>
		  <input name="settingButton5" type="button" id="settingButton5" value="Component Settings" onClick="window.open('web_content.php?Action=Update&Mode=wizard&id=<?=$comp_id["Bottom"]?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>','component','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=0,left=120,width=700,height=720');">
		  <? if ($bottom_component == "All Products" || $bottom_component == "New Items" || $bottom_component == "Used Items" || $bottom_component == "Refurbished Items" || $bottom_component == "Product Group") {?>
		  <input name="addProductButton" type="button" value="Add Product" onClick="window.open('product.php?Action=Add&Mode=wizard&page_name=<?=urlencode($page_name)?>&page_category=<?=$page_category?>&main_category=<?=urlencode($main_category)?>&comp_type=<?=$bottom_component?>','product','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? } else if ($bottom_component == "Blank Page" || $bottom_component == "About Us" || $bottom_component == "Contact Form" || $bottom_component == "Welcome" || $bottom_component == "Image" || $bottom_component == "Clock Applet" || $bottom_component == "Ticker Applet" || $bottom_component == "Photo Viewer Applet") {?>
		  <input name="editContentsButton" type="button" value="Edit Contents" onClick="window.open('component_properties_frame.php?Action=Update&selected_component=<?=$bottom_component?>&id=<?=$comp_id["Bottom"]?>','properties','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,top=30,left=150,width=700,height=690');">
		  <? }?>
		  <? }?>
</p>
      <? }?></td>
  </tr>
</table>
  </td>
</tr>
<tr>
  <td align="center" bgcolor="00AEEF" height="5%"><table width="100%"  border="0">
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;                </td>
      <td align="right">
		<input name="NextButton" type="submit" id="NextButton" value="Next &gt;&gt;">
        &nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table></td>
</tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>
