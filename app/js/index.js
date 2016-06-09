'use strict';
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get modal dialog box
var modalDialogBox = document.getElementsByClassName("modal-dialog")[0];
var sideNavbar = document.getElementsByClassName("sidenav")[0];

var rowContent = document.getElementById("rowContent");

// Create function to resize
function resizeModal(){
  modalDialogBox.style['margin-top'] = (window.innerHeight - modalDialogBox.clientHeight)/2 + "px";
}

function resizeNav(){
  sideNavbar.style['height'] = window.innerHeight + "px";
}
function resizeRowContent(){
  rowContent.style['height'] = window.innerHeight + "px";
}


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


// When the user clicks the button, open the modal
window.onload = function() {
    resizeModal();
    resizeNav();
}
window.addEventListener("load",resizeNav);
window.addEventListener("resize", resizeModal);
window.addEventListener("resize",resizeNav);
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
loginButton.onclick = function() {
    modal.style.display = "block";
    resizeModal(modalDialogBox, 'margin-top');
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    /*if (event.target == modal) {
        modal.style.display = "none";
    }*/
}
