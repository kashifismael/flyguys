<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Admin</title>
    </head>
    <body id="admin-login">

        <ul class="signNavbar">
            <li>FlyGuys</li>
        </ul>
 
     <!--   <h1>Admin Login</h1>

        <form method="POST" action="../controller/processAdminLogin.php">
            <label>Username: </label><input type="text" id="username" name="username" required>
            <label>Password: </label><input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
        </form>
        -->

        <div class="login-register-admin">
            <div class="hdr"><h1>Admin Login</h1></div>
            <form method="POST" action="../controller/processAdminLogin.php">
                <label>Username: </label><input type="text" id="username" name="username" required>
                <label>Password: </label><input type="password" id="password" name="password" required>
                <div class="center-btn">
                    <button class="btn-Hover" type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>