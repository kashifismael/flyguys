<?php

if (isset($_POST['destID'])):

//    echo "creating a promo for dest " . $_POST['destID'] .
//    " with a expiry date of " . $_POST['expiryDate'];

    require_once '../model/DB.php';
    require_once '../model/Destination.php';

    $instance = DB::getInstance();

    $destination = new Destination();
    $destination->expiryDate = htmlentities($_POST['expiryDate']);
    $destination->destID = htmlentities($_POST['destID']);

    $createdPromo = $instance->insertPromo($destination);

    if ($createdPromo === true) {
        echo "created promotion";
    }
    
    
endif;
