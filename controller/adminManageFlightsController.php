<?php
session_start();

if(!(isset($_SESSION['adminUsername']))){
    echo "You are not authorised to access this content";
    return;
}

require_once '../model/DB.php';
require_once '../model/Destination.php';
require_once '../model/Schedule.php';
require_once '../model/Flight.php';

$destID = 1;
if(isset($_GET['destID'])){
 $destID = $_GET['destID'];   
}

$instance = DB::getInstance();

$destination = $instance->getOneDestination($destID);
$outSchedule = $instance->getOutgoingSchedule($destination->destTypeID);
$returnSchedule = $instance->getReturnSchedule($destination->destTypeID);
$destination->flights = $instance->getFlightsOfDestination($destID);

require_once '../view/adminManageFlights.php';

if (isset($_SESSION['addFlight'])): 
    unset($_SESSION['addFlight']);
endif;