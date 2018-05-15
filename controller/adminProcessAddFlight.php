<?php

session_start();
if (isset($_POST['destID'])):

    require_once '../model/DB.php';
    require_once '../model/Flight.php';

    $instance = DB::getInstance();

    $flight = new Flight();
    $flight->destID = htmlentities($_POST['destID']);
    $flight->flightTypeDesc = htmlentities($_POST['flightTypeID']);
    $flight->dateOfFlight = htmlentities($_POST['flightDateTime']);
    $flight->setDayOfFlight(htmlentities($_POST['flightDateTime']));

    $insert = $instance->addflight($flight);

    if ($insert === true) {
        $destID = $_POST['destID'];
        $_SESSION['addFlight'] = "success";
        header("Location: adminManageFlightsController.php?destID=$destID");
    }
endif;
