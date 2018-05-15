<?php
session_start();
if (isset($_POST['username'])):

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    require_once '../model/DB.php';
    require_once '../model/Admin.php';

    $admin = new Admin();
    $admin->username = htmlentities($_POST['username']);
    $admin->password = htmlentities($_POST['password']);

    $instance = DB::getInstance();
    
    $isAuthorised = $instance->authenticateAdmin($admin);
    
    if($isAuthorised === true){
        $_SESSION['adminUsername'] = $admin->username;
        header("Location: adminHomeController.php");
    } else {
        echo "Incorrect username/password";
    }

endif;


