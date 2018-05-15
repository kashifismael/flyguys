<?php
//session_start();
if (isset($_POST['destName'])) {
    require_once '../model/DB.php';
    require_once '../model/Destination.php';
    
    $instance = DB::getInstance();
    
    $destination = new Destination();
    $destination->destinationName = htmlentities($_POST['destName']);
    $destination->flightDuration = htmlentities($_POST['flightDuration']);
    $destination->destinationType = htmlentities($_POST['destType']);
    
    $insert = $instance->addDestination($destination);
    
    if ($insert === true) {
        echo $instance->getLastInsertID();
    }
    
}