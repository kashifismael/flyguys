<?php

if (isset($_POST['firstname'])) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    require_once '../model/DB.php';
    require_once '../model/Customer.php';

    $instance = DB::getInstance();

    if (!(Customer::doesPasswordsMatch($_POST['passwordOne'], $_POST['passwordTwo']))) {
        echo "the passwords dont match";
        return;
    }

    echo "this should echo if the passwords match";

    $customer = new Customer();
    $customer->firstName = htmlentities($_POST['firstname']);
    $customer->lastName = htmlentities($_POST['lastname']);
    $customer->emailAddress = htmlentities($_POST['emailAddress']);
    $customer->password = htmlentities($_POST['passwordOne']);

    if(!($instance->isUserUnique($customer))){
        echo "User Already exists";
        return;
    }   
    
    $insert = $instance->addCustomer($customer);
    
    if($insert === TRUE){
        echo "Customer Added Successfully";
        //redirect user, show success message
    } else {
        echo "Customer Insert Failed";
        //redirect back to register 
    }
    
}
