<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="../js/scriptsWOLF.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Search Results</title>

    </head>
    <body id="main">

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
        <div class="container">
            <div class="sub">
                <h1>Available Flights</h1>

                <?php if ($flightType == 1): ?>
                    <h3>Flights from Standsted to <?= $destination->destinationName ?></h3>
                <?php endif; ?>

                <?php if ($flightType == 2): ?>
                    <h3>Flights from <?= $destination->destinationName ?> to Standsted</h3>
                <?php endif; ?>

                <p><strong>Duration: </strong><?= $destination->flightDuration ?> minutes</p>

            </div>

            <div class="sff">

                <table>
                    <thead>
                        <tr>
                            <th>Flight Type</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($destination->flights as $flight): ?>
                            <tr data-flightid="<?= $flight->flightID ?>">
                                <td><?= $flight->flightTypeDesc ?></td>
                                <td><?= $flight->getFormattedDate() ?></td>
                                <td>
                                    <div class="btn-Hover">
                                        <button class="addFlight btn-Hover" id="item<?= $flight->flightID ?>" >Add to Basket</button>
                                    </div>
                                </td>
                                <td>
                                    <?php if (isset($_SESSION['custID'])): ?> 
                                        <div class="btn-Hover">
                                            <button class="addWishList" id="wishItem<?= $flight->flightID ?>">Add to Wishlist</button>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (sizeof($destination->flights) === 0): ?>
                    <p>There are no results to show you</p>
                <?php endif; ?> 

            </div>

        </div>

        <footer id="basketNotif">
            <p>Added to Basket</p>
        </footer>

        <script src="../js/flightsResults.js"></script>
    </body>
</html>
