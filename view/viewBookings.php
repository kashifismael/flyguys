<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <title>View Bookings</title>
    </head>
    <body id="viewBasket">
        <nav class="navbar">
            <a href="../controller/landingController.php">Home</a>
            <a href="../controller/viewBasketController.php">View Basket (<span id="basketsize">0</span>)</a>
            <a href="../controller/wishListController.php">View Wishlist</a>
            <?php if (isset($userLoggedin)): ?>
                <a href="../controller/viewBookingsController.php">View Bookings</a>
                <a href="../controller/logoutController.php">Log out</a>
            <?php else: ?>
                <a href="../controller/registerController.php">Register</a>
                <a href="../controller/loginController.php">Login</a>
            <?php endif; ?>
        </nav> 

        <div class="display-basket">
            <h1>View Bookings</h1>

            <ul>
                <?php foreach ($bookings as $flight): ?>
                    <li data-flightid="<?= $flight->flightID ?>" id="flight<?= $flight->flightID ?>">
                        Flight No.<?= $flight->flightID ?>, Destination: <?= $flight->destinationName ?>,
                        <?= $flight->flightTypeDesc ?> ,<?= $flight->getFormattedDate() ?> - 
                        Booked on: <?= $flight->getFormattedBookingDate() ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (sizeof($bookings) === 0): ?>
                <p style="color: white;">No bookings made</p>
            <?php endif; ?>
        </div>

    </body>
</html>
