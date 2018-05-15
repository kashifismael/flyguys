<?php
require_once '../model/Flight.php';
session_start();


if (isset($_SESSION['custID'])):
    $userLoggedin = $_SESSION['custID'];
endif;

require_once '../model/DB.php';

$shoppingBasket = [];
if (isset($_SESSION['basket'])) {
    $shoppingBasket = $_SESSION['basket'];
}

require_once '../view/viewBasket.php';
