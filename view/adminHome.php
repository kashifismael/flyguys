<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/modalStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Admin Home</title>
    </head>
    <body id="main">
        <nav class="navbar">
            <a href="../controller/adminHomeController.php">Admin Home</a>
            <a href="../controller/logoutController.php">Logout</a>
        </nav>
        <div class="container">
            <h1 class="hdr1">Admin Home</h1>

            <?php if (isset($_SESSION['updateDestination'])): ?>
                <strong><p style="color: green">Successfully Updated Destination</p></strong>
            <?php endif; ?>

            <div class="sff">
                <table id="destTable">
                    <thead>
                        <tr>
                            <th>Destination name</th>
                            <th>Type</th>
                            <th>Flight Duration</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allDestinations as $destination): ?>
                            <tr data-destinationid="<?= $destination->destID ?>" id="dest<?= $destination->destID ?>">
                                <td class="destName"><?= $destination->destinationName ?></td>
                                <td><?= $destination->destinationType ?></td>
                                <td class="flightDuration"><?= $destination->flightDuration ?></td>
                                <td><a style="color: white;" href="../controller/adminManageFlightsController.php?destID=<?= $destination->destID ?>">Manage Flights</a></td>
                                <td>
                                    <div class="btn-Hover">
                                        <button class="editBtn">Edit</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-Hover">
                                        <button class="promoBtn">Promo</button>
                                    </div>
                                </td>
                                <td>
                                    <input class="destRadio" type="radio" name="row<?= $destination->destID ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--    <div>  -->
                <div class="btn-Hover" style="float:left; padding-right: 2%;">
                    <button id="myBtn">Add Destination</button>
                </div>
                <div class="btn-Hover" style="float:left; padding-right: 2%;">
                    <button id="deleteBtn" disabled>Delete Selected</button>
                </div>
                <div class="btn-Hover" >
                    <button id="resetBtn" disabled>Reset</button>
                </div>
                <!--     </div> -->
            </div>

            <p id="addMessage" style="display: none; color:green;">Successfully added Destination</p>
            <p id="deleteMessage" style="display: none; color:green;">Successfully deleted Destination</p>
            <p id="updateMessage" style="display: none; color:green;">Successfully Updated Destination</p>

            <div id="addDestModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span id="closeAdd" class="close">&times;</span>
                        <h2>Add Destination</h2>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div>
                                <label>Destination name:</label>
                                <input type="text" name="destName" id="destName" required>
                            </div>
                            <div>
                                <label>Flight Duration (in minutes):</label>
                                <input type="number" name="flightDuration" min="1" max="900" value="60" id="flightDuration">
                            </div>
                            <div>
                                <select name="destType" id="destType">
                                    <option value="1">Domestic</option>
                                    <option value="2">Europe</option>
                                </select>
                            </div>
                            <div>        
                                <button id="addDestBtn">Add Destination</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <h3>Modal Footer</h3>
                    </div>
                </div>
            </div> 

            <div id="editDestModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span id="closeEdit" class="close">&times;</span>
                        <h2>Edit Destination</h2>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div>
                                <label>Destination name:</label>
                                <input type="hidden" name="destID" id="editdestID">
                                <input type="text" name="destName" id="editdestName" required>
                            </div>
                            <div>
                                <label>Flight Duration (in minutes):</label>
                                <input type="number" name="flightDuration" min="1" max="900" value="60" id="editFlightDuration">
                            </div>
                            <div>        
                                <button id="editDestBtn">Edit Destination</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <h3>Modal Footer</h3>
                    </div>
                </div>
            </div> 
            <div id="promoModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span id="closePromo" class="close">&times;</span>
                        <h2>Create Promotion</h2>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div>
                                <label>Destination name: <span id="promodestName"></span></label>
                                <input type="hidden" name="destID" id="promodestID">
                            </div>
                            <div>
                                <label>Expiry date:</label>
                                <input type="date" name="expiryDate" id="expDate">
                            </div>
                            <div>        
                                <button id="createPromoBtn">Create Promotion</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <h3>Modal Footer</h3>
                    </div>
                </div>
            </div> 

        </div>
        <script src="../js/adminHome.js"></script>
        <script src="../js/modal.js"></script>
    </body>
</html>
