<?php

if (isset($_POST['getdestination'])):
    require_once '../model/DB.php';
    require_once '../model/Destination.php';

    $instance = DB::getInstance();
    
    $destination = $instance->getOneDestination($_POST['getdestination']);
    
    echo json_encode($destination);
endif;

