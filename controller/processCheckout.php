<?php
session_start();

if (isset($_POST['flights'])) {
    $flights = $_POST['flights'];
    echo "<pre>";
    print_r($flights);
    echo "</pre>";
    
    require_once '../model/DB.php';
    
    $instance = DB::getInstance();
    
    $insertBookings = $instance->bookFlights($flights, $_SESSION['custID']);
    
    if($insertBookings === true){
        //echo "bookings added succesfully";
        //clear basket
        unset($_SESSION['basket']);
        //redirect with success message
        header("Location: landingController.php?addBookings=success");
    } else {
        echo "something went wrong";
    }
    
}