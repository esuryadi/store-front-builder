<?php
$user_id = WebUser::retrieveUserId($FirstName,$LastName);
$wish_list = new WishList();
$found = $wish_list->isFound($user_id);
?>
