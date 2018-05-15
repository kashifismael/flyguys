<?php
session_start();
if(!isset($_SESSION['custID'])):
    return;
endif;


if(isset($_POST['removeFromWishList'])):
    
    require_once '../model/DB.php';

    $instance = DB::getInstance();
    
    $delete = $instance->deleteFlightFromWishlist($_POST['removeFromWishList'], $_SESSION['custID']);
    
    if($delete === TRUE):
        echo json_encode($_POST['removeFromWishList']);
    endif;
     
    
endif;

