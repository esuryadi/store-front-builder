<? if ($found) {?>
function goToWishList() {
	var url = "mystore.php?Page=WishList&Action=Find&UserId=<?=$user_id?>&FirstName=<?=$FirstName?>&LastName=<?=$LastName?>";
	open(url,"_self");
}
<? }?>
