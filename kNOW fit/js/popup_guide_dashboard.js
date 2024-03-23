var modal = document.getElementById("modal");

var btn1 = document.getElementById("manage_close");
var btn2 = document.getElementById("manage_open");

if(btn1){
    btn1.onclick = function() {
    modal.style.display = "block";
    }
}

if(btn2){
    btn2.onclick = function() {
    modal.style.display = "block";
    }
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}