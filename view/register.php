<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Register</title>
    </head>
    <body id="signUp">

        <nav class="navbar">
            <a href="../controller/landingController.php">Home</a>
            <a href="../controller/viewBasketController.php">View Basket (<span id="basketsize">0</span>)</a>
            <a href="../controller/wishListController.php">View Wishlist</a>
            <?php if (isset($userLoggedin)): ?>
                <a href="../controller/logoutController.php">Log out</a>
            <?php else: ?>
                <a href="../controller/registerController.php">Register</a>
                <a href="../controller/loginController.php">Login</a>
            <?php endif; ?>
        </nav>

        <div class="login-register-admin">
            <h1 class="hdr1">Register below</h1>
            <form method="POST" action="../controller/processRegister.php">
                <div class="logInput">
                    <label>First name: </label><input type="text" name="firstname" required>
                </div> 
                <div class="logInput">
                    <label>Last name: </label><input type="text" name="lastname" required>
                </div>
                <div class="logInput">
                    <label>Email Address: </label><input type="email" name="emailAddress" required>
                </div>
                <div class="logInput">
                    <label>Password: </label><input type="password" name="passwordOne" required>
                </div>
                <div class="logInput">
                    <label>Confirm Password: </label><input type="password" name="passwordTwo" required>
                </div>
                <div class="center-btn">
                    <button class="btn-Hover" type="submit">Register</button>
                </div>
            </form>
        </div>
    </body>
</html>
