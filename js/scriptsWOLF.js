$(document).ready(function () {
    getBasketSize();
});

function getBasketSize() {
    //console.log( "getting shopping basket size" );
    $.ajax({
        method: 'POST',
        url: "../controller/basketSizeController.php",
        data: {
            basketSizeRequest: true,
        },
        success: function (data) {
            //console.log(data);
            document.getElementById("basketsize").innerHTML = data;
        }
    });
}