<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Manage Flights</title>
    </head>
    <body id="manageFlights">

        <nav class="navbar">
            <a href="../controller/adminHomeController.php">Admin Home</a>
            <a href="../controller/logoutController.php">Logout</a>
        </nav>
        <div class="container">
            <div class="sff">
                <?php if (isset($_SESSION['addFlight'])): ?>
                    <strong><p style="color: green">Successfully Added Flight</p></strong>
                <?php endif; ?>

                <h1>Manage Flights to/from <?= $destination->destinationName ?></h1>
                <p>destination type <?= $destination->destTypeID ?>, <?= $destination->destinationType ?></p>

                <h2>Add Outgoing Flight</h2>

                <label>Schedule below:</label>
 
                <?php foreach ($outSchedule as $row): ?>
                    <p><?= "$row->day, $row->time" ?></p>
                <?php endforeach; ?>
                <form method="POST" action="../controller/adminProcessAddFlight.php">
                    <label>Choose date/time</label>
                    <input type="datetime-local" name="flightDateTime">
                    <input type="hidden" name="destID" value="<?= $destination->destID ?>">
                    <input type="hidden" name="flightTypeID" value="1">
                    <button>Add Outgoing Flight to <?= $destination->destinationName ?></button>
                </form>
                <h2>Add Return Flight</h2>

                <label>Schedule below:</label>

                <?php foreach ($returnSchedule as $row): ?>
                    <p><?= "$row->day, $row->time" ?></p>
                <?php endforeach; ?>
                <form method="POST" action="../controller/adminProcessAddFlight.php">
                    <label>Choose date/time</label>
                    <input type="datetime-local" name="flightDateTime">
                    <input type="hidden" name="destID" value="<?= $destination->destID ?>">
                    <input type="hidden" name="flightTypeID" value="2">
                    <button>Add Return Flight from <?= $destination->destinationName ?></button>
                </form>

                <h2>View flights</h2>
                <?php foreach ($destination->flights as $flight): ?>
                    <p><?= $flight->flightTypeDesc . ", " . $flight->getFormattedDate() ?></p>
                <?php endforeach; ?>

                <?php if (sizeof($destination->flights) === 0): ?>
                    <p>No results to show you</p>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
