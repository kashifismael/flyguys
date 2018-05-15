<?php
require_once '../model/Flight.php';
session_start();
if (isset($_POST['flightsForRemoval'])):

    $removeFromBasket = json_decode($_POST['flightsForRemoval']);

    unset($_SESSION['basket'][$removeFromBasket]);

    echo json_encode([$removeFromBasket]);
endif;

