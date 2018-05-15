<?php

require_once '../model/Flight.php';
session_start();

if (isset($_POST['addToBasket'])) {
    $flightid = $_POST['addToBasket'];

    require_once '../model/DB.php';
    $instance = DB::getInstance();


    $flight = $instance->getOneFlight($flightid);
    $flight->flightID = $flightid;
    $_SESSION['basket'][$flightid] = $flight;

    echo sizeof($_SESSION['basket']);
} 
 
