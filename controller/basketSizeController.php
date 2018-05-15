<?php

require_once '../model/Flight.php';
session_start();
if (isset($_POST['basketSizeRequest'])) {

    $basketSize = 0;
    if (isset($_SESSION['basket'])) {
        $basketSize = sizeof($_SESSION['basket']);
    }

    echo $basketSize;
}

