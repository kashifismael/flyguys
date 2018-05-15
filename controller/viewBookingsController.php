<?php

//require_once '../model/Flight.php';
session_start();

require_once '../model/DB.php';
require_once '../model/Flight.php';

if (!isset($_SESSION['custID'])) {
    echo "user not logged in";
    return;
} else {
    $userLoggedin = $_SESSION['custID'];
}

$instance = DB::getInstance();

$bookings = $instance->getCustomerBookings($_SESSION['custID']);

//echo "<pre>";
//print_r($bookings);
//echo "</pre>";

//foreach($bookings as $booking):
//    echo "booked on $booking->dateOfBooking <br>";
//endforeach;

require_once '../view/viewBookings.php';