<?php

class Customer {

    private $customerID;
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $password;

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function doesPasswordsMatch($passwordOne, $passwordTwo) {
        if ($passwordOne === $passwordTwo) {
            return true;
        } else {
            return false;
        }
    }

}
