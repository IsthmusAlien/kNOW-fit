var modal = document.getElementById("modal");

var btn1 = document.getElementById("register_click");

var btn2 = document.getElementById("register_box");

btn1.onclick = function() {
  modal.style.display = "block";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}