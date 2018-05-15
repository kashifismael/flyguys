var flightsToDelete = [];
$('#addDestBtn').click(addDestination);
$('#deleteBtn').click(deleteDestinations);
$('#resetBtn').click(resetRadioButtons);
$('#editDestBtn').click(updateDestination);
$('#createPromoBtn').click(submitPromo);
$('.destRadio').click(addToRubbishBin);
$('.editBtn').click(editDestination);
$('.promoBtn').click(createPromo);

function resetRadioButtons() {
    $('#resetBtn').prop("disabled", true);
    $('.destRadio').prop('checked', false);
}

function updateDestination(event) {
    event.preventDefault();
    var newDest = {
        "id": document.getElementById("editdestID").value,
        "newName": document.getElementById("editdestName").value,
        "newFlightDuration": document.getElementById("editFlightDuration").value
    }
    console.log(newDest);
    $.ajax({
        method: 'POST',
        url: "../controller/adminProcessEditDestination.php",
        data: {
            destName: newDest.newName,
            flightDuration: newDest.newFlightDuration,
            destID: newDest.id
        },
        success: function (data) {
            console.log(data);
            document.getElementById('editDestModal').style.display = "none";
            $("#updateMessage").fadeIn("slow").fadeOut();
            $("#dest" + newDest.id + " > td.destName").html(newDest.newName);
            $("#dest" + newDest.id + " > td.flightDuration").html(newDest.newFlightDuration);
        }
    });
}

function submitPromo(event) {
    event.preventDefault();
    $.ajax({
        method: 'POST',
        url: "../controller/processPromo.php",
        data: {
            expiryDate: document.getElementById("expDate").value,
            destID: document.getElementById("promodestID").value
        },
        success: function (data) {
            console.log(data);
            document.getElementById('promoModal').style.display = "none";
            //$("#updateMessage").fadeIn("slow");
        }
    });
}

function editDestination() {
    $("#editDestModal").css({
        "display": "block"
    });
    var $element = $(event.target);
    var destID = $element.closest('tr[data-destinationid]').data('destinationid');
    $.ajax({
        method: 'POST',
        url: "../controller/getDestinationController.php",
        data: {
            getdestination: destID
        },
        success: function (data) {
            var destination = JSON.parse(data);
            console.log(destination);
            document.getElementById("editdestID").value = destination.destID;
            document.getElementById("editdestName").value = destination.destinationName;
            document.getElementById("editFlightDuration").value = destination.flightDuration;
        }
    });
}

function createPromo() {
    $("#promoModal").css({
        "display": "block"
    });
    var $element = $(event.target);
    var destID = $element.closest('tr[data-destinationid]').data('destinationid');
    $.ajax({
        method: 'POST',
        url: "../controller/getDestinationController.php",
        data: {
            getdestination: destID
        },
        success: function (data) {
            var destination = JSON.parse(data);
            console.log(destination);
            document.getElementById("promodestID").value = destination.destID;
            document.getElementById("promodestName").innerHTML = destination.destinationName;
        }
    });
}


function addDestination(event) {
    event.preventDefault();
    var destName = $("#destName").val();
    var flightDuration = $("#flightDuration").val();
    var destType = $("#destType").val();
    $.ajax({
        method: 'POST',
        url: "../controller/adminProcessAddDestination.php",
        data: {
            destName: destName,
            flightDuration: flightDuration,
            destType: destType
        },
        success: function (data) {
            console.log("last insert id is " + data);
            var insertID = data;
            var destTypeName = "Europe";
            if (destType == 1) {
                destTypeName == "Domestic";
            }
            var newRow = '<tr data-destinationid="' + insertID + '" id="dest' + insertID + '">' +
                    '                <td class="destName">' + destName + '</td>' +
                    '                <td>' + destTypeName + '</td>' +
                    '                <td class="flightDuration">' + flightDuration + '</td>' +
                    '                <td>' +
                    '                    <a style="color: white;" href="../controller/adminManageFlightsController.php?destID=' + insertID + '">Manage Flights</a>' +
                    '                </td>' +
                    '                <td><div class="btn-Hover">' +
                    '                    <button class="editBtn">Edit</button></div>' +
                    '                </td>' +
                    '                <td><div class="btn-Hover">' +
                    '                    <button class="promoBtn">Promo</button></div>' +
                    '                </td>' +
                    '                <td>' +
                    '                    <input class="destRadio" type="radio" name="row' + insertID + '" value="' + insertID + '">' +
                    '                </td>' +
                    '            </tr>';
            document.getElementById('addDestModal').style.display = "none";
            $('#destTable tr:last').after(newRow);
            $("#addMessage").fadeIn("slow").fadeOut();
            $('.destRadio').click(addToRubbishBin);
            $('.editBtn').click(editDestination);
            document.getElementById("destName").innerHTML = "";
        }
    });
}

function addToRubbishBin(event) {
    $('#deleteBtn').prop("disabled", false);
    $('#resetBtn').prop("disabled", false);
    var $element = $(event.target);
    var dest = $element.closest('tr[data-destinationid]').data('destinationid');
    console.log(dest);
    flightsToDelete.push(dest);
}

function deleteDestinations() {
    var deleteList = JSON.stringify(flightsToDelete);
    $.ajax({
        method: 'POST',
        url: "../controller/adminProcessDeleteDestination.php",
        data: {
            deleteDestinationList: deleteList,
        },
        success: function (data) {
            var deleted = JSON.parse(data);
            deleted.forEach(function (element) {
                $("#dest" + element).remove();
            });
            $("#deleteMessage").fadeIn("slow").fadeOut();
            flightsToDelete = [];
            $('#deleteBtn').prop("disabled", true);
            $('#resetBtn').prop("disabled", true);
        }
    });
}
