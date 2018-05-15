<?php

class Admin {
    
    private $username;
    private $password;
    private $firstName;
    private $lastName;

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

}
