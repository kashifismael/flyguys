$(".removeFlight").click(removeFromBasket);

function removeFromBasket(event) {
    event.preventDefault();
    var $element = $(event.target);
    var flightid = $element.closest('li[data-flightid]').data('flightid');
    //var flightsForRemoval = [flightid];
    var flightsForRemoval = flightid;

    $.ajax({
        method: 'POST',
        url: "../controller/processBasketRemoval.php",
        data: {
            flightsForRemoval: JSON.stringify(flightsForRemoval),
        },
        success: function (data) {
            var removedFlights = JSON.parse(data);
            removedFlights.forEach(function (element) {
                $("#flight" + element).remove();
            });
            getBasketSize();
            $("#deleteMessage").fadeIn("slow").fadeOut();
        }
    });

    $.ajax({
        method: 'POST',
        url: "../controller/basketSizeController.php",
        data: {
            basketSizeRequest: true,
        },
        success: function (data) {
            console.log("the basket size is "+data);
            //console.log(typeof(data));
            if(data == 0){
                console.log("the basket is empty");
                document.getElementById("checkoutSubmit").style.display = "none";
            }
        }
    });

}

