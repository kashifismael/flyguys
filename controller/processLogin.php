<?php

session_start();
if (isset($_POST['cusEmail'])):
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    require_once '../model/DB.php';
    require_once '../model/Customer.php';

    $customer = new Customer();
    $customer->emailAddress = htmlentities($_POST['cusEmail']);
    $customer->password = htmlentities($_POST['cusPassword']);

    $instance = DB::getInstance();

    $authCustomer = $instance->authenticateCustomer($customer);

    if (isset($authCustomer)) {
        echo "User is authenticated";
        $_SESSION['custID'] = $authCustomer->customerID;
        $_SESSION['custFirstName'] = $authCustomer->firstName;
        $_SESSION['custLastName'] = $authCustomer->lastName;
        $_SESSION['custEmail'] = $authCustomer->emailAddress;
        header("Location: landingController.php");
    } else {
        echo "Wrong username/password";
    }
endif;

