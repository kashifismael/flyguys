<?php

class Flight {

    private $flightID;
    private $flightTypeDesc;
    private $destID;
    private $dateOfFlight;
    private $destinationName;
    private $dayOfFlight;

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function getFormattedDate() {
        $datetime = new DateTime($this->dateOfFlight);
        return date_format($datetime, 'G:ia - D j M');
    }
    
    function getFormattedBookingDate(){
        $datetime = new DateTime($this->dateOfBooking);
        return date_format($datetime, 'G:ia - D j M');
    }
    
    function setDayOfFlight($postDateTime){
//        $datetime = new DateTime($postDateTime);
//        return date_format($datetime, 'l');
        $this->dayOfFlight = date_format(new DateTime($postDateTime), 'l');
    }

}
