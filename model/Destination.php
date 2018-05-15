<?php

class Destination implements JsonSerializable {

    private $destID;
    private $destinationName;
    private $flightDuration;
    private $destinationType;
    private $destTypeID;
    private $dateAdded;
    private $expiryDate;
    private $flights = [];

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function getFormattedDate() {
        $datetime = new DateTime($this->dateAdded);
        return date_format($datetime, 'G:ia - D j M');
    }

    function getFormattedExpiryDate() {
        $datetime = new DateTime($this->expiryDate);
        return date_format($datetime, 'D j M');
    }

    function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

}
