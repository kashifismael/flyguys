<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Login to FlyGuys</title>
    </head>
    <body id="signIn">
        <nav class="navbar">
            <a href="../controller/landingController.php">Home</a>
            <a href="../controller/viewBasketController.php">View Basket (<span id="basketsize">0</span>)</a>
            <a href="../controller/wishListController.php">View Wishlist</a>
            <a href="../controller/registerController.php">Register</a>
            <a href="../controller/loginController.php">Login</a>
        </nav>

        <div class="login-register-admin">
            <div class="hdr">
                <h1>Login</h1>
            </div>  
            <form method="POST" action="../controller/processLogin.php">
                <label>Email Address: </label><input type="email" id="username" name="cusEmail" required>
                <label>Password: </label><input type="password" id="password" name="cusPassword" required>
                <div class="center-btn">
                    <button class="btn-Hover"type="submit">Login</button>
                </div>
            </form> 
        </div>
    </body>
</html>
