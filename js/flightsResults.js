$(".addFlight").click(addToBasket);
$(".addWishList").click(addToWishList);

function addToBasket(event) {
    var $element = $(event.target);
    if (!$element.hasClass('addFlight')) {
        return;
    }

    var flightid = $element.closest('tr[data-flightid]').data('flightid');
    $.ajax({
        method: 'POST',
        url: "../controller/processAddToBasket.php",
        data: {
            addToBasket: flightid,
        },
        success: function (data) {
            $("#basketNotif").fadeIn("slow").fadeOut();
            $element.text("Added to Basket");
            document.getElementById("basketsize").innerHTML = data;
            $("#item" + flightid).removeClass("addFlight");
        }
    });
}

function addToWishList(event) {
    var $element = $(event.target);
    if (!$element.hasClass('addWishList')) {
        return;
    }

    var flightid = $element.closest('tr[data-flightid]').data('flightid');
    console.log(flightid);
    $.ajax({
        method: 'POST',
        url: "../controller/processAddToWishList.php",
        data: {
            addToWishList: flightid,
        },
        success: function (data) {
            //console.log(data);
            //
            var wishList = JSON.parse(data);
            console.log(wishList);

            $("#basketNotif").text("Added flight " + wishList.flightNo + " to Wishlist");
            $("#basketNotif").fadeIn("slow");
            $element.text("Added to Wishlist");
            $("#wishItem" + flightid).removeClass("addWishList");
        }
    });
}

$(document).ready(function () {
    //get current basket contents
    $.ajax({
        method: 'POST',
        url: "../controller/basketContentsController.php",
        data: {
            basketContentsRequest: true,
        },
        success: function (data) {
            console.log(data);
            var basket = JSON.parse(data);
            //console.log("basket is of type: " + typeof (basket));
//            basket.forEach(function (item) {
//                if ($("#item" + item).length) {
//                    $("#item" + item).html("Added to Basket").removeClass("addFlight");
//                }
//            });
//            Object.keys(basket).forEach(function (item) {
//                if ($("#item" + basket[item]).length) {
//                    $("#item" + basket[item]).html("Added to Basket").removeClass("addFlight");
//                }
//            });
            Object.keys(basket).forEach(function (key) {
                if ($("#item" + key).length) {
                    $("#item" + key).html("Added to Basket").removeClass("addFlight");
                }
            });
        }
    });

    //get wishlist of customer (if logged in)
    $.ajax({
        method: 'POST',
        url: "../controller/getWishListController.php",
        data: {
            getWishListRequest: true,
        },
        success: function (data) {
            var wishlist = JSON.parse(data);
            //console.log("wishlist is of type: "+ typeof(wishlist));
            wishlist.forEach(function (item) {
                if ($("#wishItem" + item).length) {
                    $("#wishItem" + item).html("Added to Wishlist").removeClass("addWishList");
                }
            });

        }
    });

});

