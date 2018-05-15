<?php
session_start();
if (isset($_POST['destID'])) {
    require_once '../model/DB.php';
    require_once '../model/Destination.php';
    
    $instance = DB::getInstance();
    
    $destination = new Destination();
    $destination->destinationName = htmlentities($_POST['destName']);
    $destination->flightDuration = htmlentities($_POST['flightDuration']);
    $destination->destID = htmlentities($_POST['destID']);
    
    $update = $instance->updateDestination($destination);
    
    if ($update === true) {
        echo "Updated Successfully";
    }
}