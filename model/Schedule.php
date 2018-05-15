<?php

class Schedule {

    private $day;
    private $time;

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

}
