<?php
session_start();
if(!(isset($_SESSION['adminUsername']))){
    echo "You are not authorised to access this content";
    return;
}

require_once '../model/DB.php';
require_once '../model/Destination.php';

$instance = DB::getInstance();

$allDestinations = $instance->getAllDestinations();

require_once '../view/adminHome.php';

if (isset($_SESSION['updateDestination'])): 
    unset($_SESSION['updateDestination']);
endif;
if (isset($_SESSION['addDestination'])): 
    unset($_SESSION['addDestination']);
endif;
if (isset($_SESSION['deleteDestination'])): 
    unset($_SESSION['deleteDestination']);
endif;


