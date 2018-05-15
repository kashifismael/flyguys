<?php

class DB {

    private static $instance = null;
    private $dbconn;
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "flyguys";

    private function __construct() {
        try {
            $this->dbconn = new PDO(
                    "mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            //echo "I'm here, all good";
        } catch (PDOException $ex) {
            print "Error!: " . $ex->getMessage() . "<br/>";
            die();
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->dbconn;
    }

    function getLastInsertID() {
        return $this->dbconn->lastInsertId();
    }

    function getCustomerBookings($customerid) {
        $sql = "SELECT * FROM `Booking` "
                . "INNER JOIN Flight ON Booking.flightID = Flight.flightID "
                . "INNER JOIN FlightType ON FlightType.flightTypeID = Flight.flightTypeID "
                . "INNER JOIN Destination ON Flight.destID = Destination.destID "
                . "WHERE Booking.customerID = ? ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$customerid]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Flight");
    }

    function getCustomerWishListIDs($customerID) {
        $sql = "SELECT `flightID` FROM `WishList` WHERE `customerID` = ? ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$customerID]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function deleteFlightFromWishlist($flightid, $customerid) {
        $sql = "DELETE FROM WishList WHERE `flightID` = ? AND `customerID` = ? ";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([$flightid, $customerid]);
    }

    function getAllDestinations() {
        $sql = "SELECT * FROM `Destination` INNER JOIN DestinationType ON Destination.destTypeID = DestinationType.destTypeID";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Destination");
    }

    function getAllRecentDestinations() {
        $sql = "SELECT * FROM `Destination` INNER JOIN DestinationType ON Destination.destTypeID = DestinationType.destTypeID"
                . " WHERE dateAdded > NOW() - INTERVAL 10 DAY "
                . "ORDER BY dateAdded DESC";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Destination");
    }

    function getPromotedDestinations() {
        $sql = "SELECT * FROM Destination
                INNER JOIN Promotion ON Promotion.destID = Destination.destID
                WHERE Promotion.expiryDate > NOW()";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Destination");
    }

    function getOneDestination($destID) {
        $sql = "SELECT * FROM `Destination` INNER JOIN DestinationType ON Destination.destTypeID = DestinationType.destTypeID WHERE Destination.destID = ? ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$destID]);
        return $stmt->fetchObject("Destination");
    }

    function updateDestination($destination) {
        $sql = "UPDATE Destination SET destinationName = :destName ,flightDuration = :flightduration  WHERE destID = :destID";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([
                    ':destName' => $destination->destinationName,
                    ':flightduration' => $destination->flightDuration,
                    ':destID' => $destination->destID]);
    }

    function addDestination($destination) {
        $sql = "INSERT INTO Destination (destTypeID, destinationName, flightDuration)"
                . " VALUES (:destTypeID, :destName, :flightDuration)";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([
                    ':destName' => $destination->destinationName,
                    ':flightDuration' => $destination->flightDuration,
                    ':destTypeID' => $destination->destinationType]);
    }

    function insertPromo($destination) {
        $sql = "INSERT INTO Promotion (destID, expiryDate)"
                . " VALUES (:destID, :expDate)";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([
                    ':expDate' => $destination->expiryDate,
                    ':destID' => $destination->destID]);
    }

    function deleteDestination($destID) {
        $sql = "DELETE FROM Destination WHERE destID = ?";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([$destID]);
    }

    function getOutgoingSchedule($destTypeID) {
        $sql = "SELECT * 
                FROM `Schedule`
                WHERE Schedule.flightTypeID = 1 
                AND Schedule.destTypeID = ? ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$destTypeID]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Schedule");
    }

    function getReturnSchedule($destTypeID) {
        $sql = "SELECT * 
                FROM `Schedule`
                WHERE Schedule.flightTypeID = 2 
                AND Schedule.destTypeID = ? ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$destTypeID]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Schedule");
    }

    function addFlight($flight) {
        $sql = "INSERT INTO Flight (destID, flightTypeID, dateOfFlight, dayOfFlight)"
                . " VALUES (:destID, :flightTypeID, :dateOfFlight, :dayOfFlight)";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([
                    ':destID' => $flight->destID,
                    ':flightTypeID' => $flight->flightTypeDesc,
                    ':dateOfFlight' => $flight->dateOfFlight,
                    ':dayOfFlight' => $flight->dayOfFlight]);
    }

    function addFlightToWishList($customerID, $flightID) {
        $sql = "INSERT INTO WishList (flightID, customerID) VALUES (:flightid, :custid)";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([
                    ':flightid' => $flightID,
                    ':custid' => $customerID]);
    }

    function getWishListFlights($customerID) {
        $sql = "SELECT * FROM `WishList`
                    INNER JOIN Flight ON Flight.flightID = WishList.flightID
                    INNER JOIN Destination ON Flight.destID = Destination.destID
                    WHERE WishList.customerID = ? ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$customerID]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Flight");
    }

    function viewFlightsOfDestination($destID, $flightType, $firstDate, $secondDate) {
        $query = "SELECT * FROM `Flight` 
                    INNER JOIN FlightType ON Flight.flightTypeID = FlightType.flightTypeID
                    WHERE Flight.destID = :destination
                    AND Flight.flightTypeID = :flightType
                    AND Flight.dateOfFlight BETWEEN :firstDate AND :lastDate";
        $stmt = $this->dbconn->prepare($query);
        $stmt->execute([
            ':destination' => $destID,
            ':flightType' => $flightType,
            ':firstDate' => $firstDate,
            ':lastDate' => $secondDate]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Flight");
    }

    function viewFlightsOfDestinationFilterDay($destID, $flightType, $firstDate, $secondDate, $dayOfWeek) {
        $query = "SELECT * FROM `Flight` 
                    INNER JOIN FlightType ON Flight.flightTypeID = FlightType.flightTypeID
                    WHERE Flight.destID = :destination
                    AND Flight.flightTypeID = :flightType
                    AND Flight.dateOfFlight BETWEEN :firstDate AND :lastDate 
                    AND Flight.dayOfFlight = :dayOfWeek ";
        $stmt = $this->dbconn->prepare($query);
        $stmt->execute([
            ':destination' => $destID,
            ':flightType' => $flightType,
            ':firstDate' => $firstDate,
            ':lastDate' => $secondDate,
            ':dayOfWeek' => $dayOfWeek]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Flight");
    }

    function getFlightsOfDestination($destID) {
        $query = "SELECT * FROM `Flight` 
                    INNER JOIN FlightType ON Flight.flightTypeID = FlightType.flightTypeID
                    WHERE Flight.destID = :destination";
        $stmt = $this->dbconn->prepare($query);
        $stmt->execute([
            ':destination' => $destID]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Flight");
    }

    function getOneFlight($flightid) {
        $query = "SELECT * FROM `Flight` 
                    INNER JOIN FlightType ON Flight.flightTypeID = FlightType.flightTypeID 
                    INNER JOIN Destination ON Flight.destID = Destination.destID
                    WHERE Flight.flightID = ? ";
        $stmt = $this->dbconn->prepare($query);
        $stmt->execute([$flightid]);
        return $stmt->fetchObject("Flight");
    }

    function getShoppingBasketFlights($flightIdArray) {
        $shoppingBasket = [];
        foreach ($flightIdArray as $flightId) {
            $stmt = $this->dbconn->prepare(
                    "SELECT * FROM `Flight` 
                    INNER JOIN FlightType ON Flight.flightTypeID = FlightType.flightTypeID 
                    INNER JOIN Destination ON Flight.destID = Destination.destID
                    WHERE Flight.flightID = ?");
            $stmt->execute([$flightId]);
            $shoppingBasket[] = $stmt->fetchObject("Flight");
        }
        return $shoppingBasket;
    }

    function addCustomer($customer) {
        $sql = "INSERT INTO Customer (firstName, lastName, emailAddress, password)"
                . "VALUES (:fname, :lname, :email, :pass)";
        $stmt = $this->dbconn->prepare($sql);
        return $stmt->execute([
                    ':fname' => $customer->firstName,
                    ':lname' => $customer->lastName,
                    ':email' => $customer->emailAddress,
                    ':pass' => $this->encrypt("theSecretKeyInit", $customer->password)]);
    }

    function encrypt($key, $plain) {
        $plain = hash('md5', $plain, false);
        $plain = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plain, MCRYPT_MODE_ECB);
        $plain = base64_encode($plain);
        return substr($plain, 0, 44);
    }

    function isUserUnique($newCustomer) {
        $unique = false;
        $sql = "SELECT * FROM Customer WHERE emailAddress = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$newCustomer->emailAddress]);
        $result = $stmt->fetchAll();
        if (sizeof($result) === 0) {
            //user is unique
            $unique = true;
        }
        return $unique;
    }

    function authenticateAdmin($admin) {
        $authenticate = false;
        $sql = "SELECT * FROM Admin "
                . "WHERE username = :user AND password = :pass";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([
            ':user' => $admin->username,
            ':pass' => $this->encrypt("theSecretKeyInit", $admin->password)]);
        $result = $stmt->fetchAll();
        if (sizeof($result) === 1) {
            $authenticate = true;
            //return true;
        }
        return $authenticate;
    }

    function authenticateCustomer($customer) {
        //$authenticate = false;
        $authCustomer = null;
        $sql = "SELECT * FROM Customer "
                . "WHERE emailAddress = :email AND password = :pass ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([
            ':email' => $customer->emailAddress,
            ':pass' => $this->encrypt("theSecretKeyInit", $customer->password)]);
        $result = $stmt->fetchAll();
        if (sizeof($result) === 1) {
            // update last login
            //$authenticate = true;
            $authCustomer = $this->getOneCustomer($customer);
        }
        //return $authenticate;
        return $authCustomer;
    }

    private function getOneCustomer($customer) {
        $sql = "SELECT * FROM Customer "
                . "WHERE emailAddress = :email ";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([
            ':email' => $customer->emailAddress]);
        return $stmt->fetchObject("Customer");
    }

    function bookFlights($flights, $customerID) {
        $insert = false;
        foreach ($flights as $flight) {
            $sql = "INSERT INTO Booking (customerID, flightID)"
                    . "VALUES (:custid, :flightid)";
            $stmt = $this->dbconn->prepare($sql);
            $insert = $stmt->execute([
                ':custid' => $customerID,
                ':flightid' => $flight
            ]);
        }
        return $insert;
    }

}
