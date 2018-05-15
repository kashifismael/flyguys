<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script src="../js/scriptsWOLF.js"></script>
    </head>
    <body id="main">
        <nav class="navbar">
            <a href="../controller/adminLoginController.php">Admin</a>
            <a href="../controller/viewBasketController.php">View Basket (<span id="basketsize">0</span>)</a>
            <a href="../controller/wishListController.php">View Wishlist</a>
            <?php if (isset($userLoggedin)): ?>
                <a href="../controller/viewBookingsController.php">View Bookings</a>
                <a href="../controller/logoutController.php">Log out</a>
            <?php else: ?>
                <a href="../controller/registerController.php" >Register</a>
                <a href="../controller/loginController.php">Login</a>
            <?php endif; ?>
        </nav>

        <div class="landingContainer">

            <h1 class="hdr1">Welcome to Fly Guys</h1>

            <div class="sff">
                <h3>Search for Flights</h3>
                <form method="GET" action="../controller/flightResultsController.php">
                    <div class="destination-return-outgoing">
                        <label>Destination: </label>
                        <select name="destination">
                            <?php foreach ($allDestinations as $destination): ?>
                                <option value="<?= $destination->destID ?>"><?= $destination->destinationName ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="sff-return-outgoing">
                        <label>Return or Outgoing: </label>
                        <select name="flightType">
                            <option value="1">Outgoing</option>
                            <option value="2">Return</option>
                        </select>
                    </div>

                    <div class="sff-1date">
                        <label>From:</label>
                        <input type="date" name="firstDate">
                    </div>

                    <div class="sff-2date">
                        <label>To:</label>
                        <input type="date" name="secondDate"> 
                    </div>

                    <div class="sff-return-outgoing">
                        <label>Day of week: </label>
                        <select name="dayOfWeek">
                            <option value="All">Any</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>

                    <div class="sff-2date">
                        <button class="btn-Hover" type="submit">Search for Flights</button>
                    </div>
                </form>
            </div>
 
            <?php if ($addedBookings === true): ?>
                <h3 style="color: greenyellow">Bookings successfully added</h3>
            <?php endif; ?>

            <div class="view-destination">
                <h1>New Destinations</h1>
                <ul>
                    <?php foreach ($recentDestinations as $destination): ?>
                        <li><?= $destination->destinationName ?>, Added: <?= $destination->getFormattedDate() ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if (sizeof($recentDestinations) === 0): ?>
                    <p>No Destinations recently added</p>
                <?php endif; ?>
            </div>

            <div class="view-destination">
                <h1>Promoted</h1>
                <ul>
                    <?php foreach ($promotedDestinations as $destination): ?>
                        <li>Special offer for <?= $destination->destinationName ?>, Expires: <?= $destination->getFormattedExpiryDate() ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if (sizeof($promotedDestinations) === 0): ?>
                    <p>No Destinations recently added</p>
                <?php endif; ?>
            </div>


        </div>
    </body>
</html>
