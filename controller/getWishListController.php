<?php

session_start();

if (!isset($_POST['getWishListRequest'])):
    return;
endif;

$wishlist = [];

if (isset($_SESSION['custID'])):

    require_once '../model/DB.php';
    $instance = DB::getInstance();
    $wishlist = $instance->getCustomerWishListIDs($_SESSION['custID']);

endif;

echo json_encode($wishlist);
