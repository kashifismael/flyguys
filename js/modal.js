// from w3schools

// Get the modal
var modal = document.getElementById('addDestModal');

// Get the button that opens the modal
var addBtn = document.getElementById("myBtn");
//var editBtn = $(".editBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];
var addSpan = document.getElementById("closeAdd");
//var editSpan = $("#closeEdit");

// When the user clicks on the button, open the modal 
addBtn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
addSpan.onclick = function() {
    modal.style.display = "none";
}



var editModal = document.getElementById('editDestModal');
var editSpan = document.getElementById("closeEdit");

var promoModal = document.getElementById('promoModal');
var promoSpan = document.getElementById("closePromo");
//$(".editBtn").click(function(){ 
//    $("#editDestModal").css({
//        "display" : "block"
//    });
//});
//make all edit buttons "open" the modal

editSpan.onclick = function() {
    editModal.style.display = "none";
}

promoSpan.onclick = function() {
    promoModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } else if(event.target == editModal){
        editModal.style.display = "none";
    } else if(event.target == promoModal){
        promoModal.style.display = "none";
    }
}
