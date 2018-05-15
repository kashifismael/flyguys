<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <title>Wish list</title>
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
            <h1 class="hdr1">View WishList</h1>

            <ul>
                <?php foreach ($wishlist as $flight): ?>
                    <li data-flightid="<?= $flight->flightID ?>" id="flight<?= $flight->flightID ?>">
                        Flight <?= $flight->flightID ?>, <?= $flight->destinationName ?>
                        <div class="btn-Hover">
                            <button class="removeFlight wishlistBtn">Remove from Wishlist</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (sizeof($wishlist) === 0): ?>
                <p style="color: white;">No items in wishlist</p>
            <?php endif; ?>
        </div>

        <!--   <h2 id="deleteMessage" style="display: none; color:green;">Successfully removed flight from wishlist</h2>
        -->

        <footer id="deleteMessage">
            <p>Successfully Removed Flight</p>
        </footer>

        <script src="../js/wishList.js"></script>
    </body>
</html>
