<?php
session_start();

require_once '../model/DB.php';
require_once '../model/Destination.php';

if (isset($_SESSION['custID'])):
    $userLoggedin = $_SESSION['custID'];
endif;

$addedBookings = isset($_GET['addBookings']) ? TRUE : FALSE;

$instance = DB::getInstance();

$allDestinations = $instance->getAllDestinations();
$recentDestinations = $instance->getAllRecentDestinations();
$promotedDestinations = $instance->getPromotedDestinations();

require_once '../view/landing.php';

