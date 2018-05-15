<?php
session_start();

if (isset($_POST['addToWishList'])) {

    $flightNo = $_POST['addToWishList'];
    $custNo = $_SESSION['custID'];
    
    require_once '../model/DB.php';
    
    $instance = DB::getInstance();
    
    $insert = $instance->addFlightToWishList($custNo, $flightNo);
    
    if($insert === TRUE){
        
        $data['custID'] = $custNo;
        $data['flightNo'] = $flightNo;
        
        echo json_encode($data);
    }
    
} 
 
