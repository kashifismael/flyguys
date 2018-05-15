<?php
session_start();

require_once '../model/DB.php';
require_once '../model/Flight.php';

$customerID = 0;
if(isset($_SESSION['custID'])){
    $customerID = $_SESSION['custID'];
}

if (isset($_SESSION['custID'])):
    $userLoggedin = $_SESSION['custID'];
endif;

$instance = DB::getInstance();

$wishlist = $instance->getWishListFlights($customerID);

require_once '../view/wishList.php';
