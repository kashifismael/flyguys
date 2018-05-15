<?php
require_once '../model/Flight.php';
session_start();
if (isset($_POST['basketContentsRequest'])) {

    $basket = [];

    if (isset($_SESSION['basket'])) {
        $basket = $_SESSION['basket'];
    }
    
    echo json_encode($basket);
}