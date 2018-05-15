<?php

if (!(isset($_POST['deleteDestinationList']))):
    return;
endif;

session_start();
require_once '../model/DB.php';

$instance = DB::getInstance();

$deletedDestinations = [];
$deleteList = json_decode($_POST['deleteDestinationList']);

foreach ($deleteList as $destination):
    $delete = $instance->deleteDestination($destination);
    if($delete === true):
        $deletedDestinations[] = $destination;
    endif;
endforeach;
    
echo json_encode($deletedDestinations);

