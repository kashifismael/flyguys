$(".removeFlight").click(removeFromWishList);

function removeFromWishList(event) {
    event.preventDefault();
    var $element = $(event.target);
    var flightid = $element.closest('li[data-flightid]').data('flightid');

    $.ajax({
        method: 'POST',
        url: "../controller/processWishListRemoval.php",
        data: {
            removeFromWishList: flightid,
        },
        success: function (data) {
            console.log(data);
            var removedFlight = JSON.parse(data);
            $("#flight" + removedFlight).remove();
            $("#deleteMessage").fadeIn("slow").fadeOut();
        }
    });
}
