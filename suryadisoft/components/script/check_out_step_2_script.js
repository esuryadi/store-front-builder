<? if ($payment->getPaymentService(_USER) == "PayPal") {?>
function setAdditionalItemRate(form,index) {
	var extra_rate = new Array();
	<? for ($i=0;$i<count($shipping_rate);$i++) {
		$rate = $shipping_rate[$i];?>
	extra_rate [<?=$i?>] = "<? printf("%01.2f",$rate["extra_rate"]);?>";
	<? }?>
	form.shipping2.value = extra_rate[index];
}
<? }?>
function addCoupon(form) {
	form["coupons"].options[form["coupons"].length] = new Option(form["coupon"].value);
	if (form["prod_coupons"].value == "")
		form["prod_coupons"].value = form["coupon"].value;
	else
		form["prod_coupons"].value = form["prod_coupons"].value + ";" + form["coupon"].value;
	form["coupon"].value = "";
}

function deleteCoupon(form) {
	form["coupons"].options[form["coupons"].selectedIndex] = null;
	for(i=0;i<form["coupons"].length;i++) {
		if (i == 0)
			form["prod_coupons"].value = form["coupons"].options[i].value;
		else
			form["prod_coupons"].value = form["prod_coupons"].value + ";" + form["coupons"].options[i].value;
	}
}

function processOrder(form) {
	form.action = "mystore.php?Page=ReviewOrder&Action=ProcessOrder";
	form.submit();
}

function disableButton(form,status) {
	form.reviewOrderButton.disabled = status;
	form.processOrderButton.disabled = status;
}

<? if (WebContent::getPropertyValue("shipping_mode") == "manual" && WebContent::getPropertyValue("ship_rate_calc_method") == "by total purchase" && WebContent::getPropertyValue("express_checkout") == "yes") {?>
<? if (isset($Action) && $Action == "ReviewOrder") {?>
window.open("mystore.php?Page=ReviewOrder&ShippingMethod=<?=$ShippingMethod?>","_self");
<? } else {?>
window.open("mystore.php?Page=ReviewOrder&Action=ProcessOrder&ShippingMethod=<?=$ShippingMethod?>","_self");
<? }?>
<? }?>