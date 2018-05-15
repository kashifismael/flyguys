<?php
session_start();
require_once '../model/DB.php';
require_once '../model/Destination.php';
require_once '../model/Flight.php';

$dayofWeek = null;
if(isset($_GET['dayOfWeek']) && $_GET['dayOfWeek'] != "All"){
    $dayofWeek =  $_GET['dayOfWeek'];
}

$destID = 1;
if (isset($_GET['destination'])):
    $destID = $_GET['destination'];
endif;
 
$flightType = 1;
if (isset($_GET['flightType'])):
    $flightType = $_GET['flightType'];
endif;

if (isset($_SESSION['custID'])):
    $userLoggedin = $_SESSION['custID'];
endif;

$firstDate = $_GET['firstDate'];
$secondDate = $_GET['secondDate'];

$instance = DB::getInstance();

$destination = $instance->getOneDestination($destID);

if(isset($dayofWeek)){
    $destination->flights = $instance->viewFlightsOfDestinationFilterDay($destID,
        $flightType,$firstDate,$secondDate, $dayofWeek);
} else {
    $destination->flights = $instance->viewFlightsOfDestination($destID,
        $flightType,$firstDate,$secondDate);
}

require_once '../view/flightResults.php';
