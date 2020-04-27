<?php
if (isset($HTTP_COOKIE_VARS["user"])) {
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));
	$customer = new Customer($user->getUserId());
	if (isset($Action) && $Action == "Update") {
		$customer->setFirstName($FirstName);
		$customer->setMiddleInitial($MiddleInitial);
		$customer->setLastName($LastName);
		$customer->setAddress1($Address1);
		$customer->setAddress2($Address2);
		$customer->setCity($City);
		$customer->setState($State);
		$customer->setProvince($Province);
		$customer->setZip($Zip);
		$customer->setCountry($Country);
		$customer->setDayPhone($DayPhone);
		$customer->setEveningPhone($EveningPhone);
		$customer->setFax($Fax);
		$customer->setEmail($Email);
		$customer->storeCustomerData();
	}
	$customer->retrieveCustomerData();
	if (isset($Link) && $Link == "PurchaseHistory") {
		if (isset($Action) && $Action == "ViewOrder") {
			$transaction = new Transaction();
			$transaction->setCustomerId($customer->getCustomerId());
			$transaction->retrieveTransaction();
		} else if (isset($Action) && $Action == "ViewPurchase") {
			$purchase = new Purchase();
			$purchase->setTransactionId($transaction_id);
			$purchase->retrievePurchase();
		}
	}
}
?>
