<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Basket</title>
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="../js/scriptsWOLF.js"></script>
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

        <form method="POST" action="../controller/processCheckout.php">
            <div class="display-basket" >
                <ul>
                    <?php
                    foreach ($shoppingBasket as $key => $flight):
                        ?>
                        <input type="hidden" name="flights[]" value="<?= $flight->flightID ?>">
                        <li data-flightid="<?= $flight->flightID ?>" id="flight<?= $flight->flightID ?>">
                            <?= $flight->destinationName ?>,
                            <?= $flight->flightTypeDesc ?> ,<?= $flight->getFormattedDate() ?>
                            <button class="removeFlight">Remove from Basket</button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <label class="logInput" style="color:white">Card number:</label><input name="cardNumber" required>

                <div>
                    <label style="color:white">Expiry Month:</label>
                    <select name="expMonth">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>

                <label style="color:white">Expiry Year:</label>
                <select name="expYear">
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                </select>

                <div class="emptyMessage">
                    <?php if (sizeof($shoppingBasket) === 0): ?>
                        <p>Your basket is empty</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="checkout">
                <?php if (sizeof($shoppingBasket) >= 1 && isset($_SESSION['custID'])): ?>
                    <button class="btn-Hover" id="checkoutSubmit" type="submit">Checkout items</button> 
                <?php endif; ?>

                <?php if (sizeof($shoppingBasket) >= 1 && !isset($_SESSION['custID'])): ?>
                    <a href="../controller/loginController.php" style="color: white">Log in to complete transaction</a>
                <?php endif; ?>
                <!--  </form> -->

                <!--?php if (sizeof($shoppingBasket) === 0): ?>
                    <p>Your basket is empty</p>
                <!!?php endif; ?-->
            </div> 
        </form>

        <footer id="deleteMessage">
            <p>Successfully Removed Flight</p>
        </footer>
        
        <script src="../js/viewBasket.js"></script>

    </body>
</html>
