document.addEventListener("DOMContentLoaded", function() {
    var editimgDesTab = document.getElementById('edit-image-passive');
    var editedimgDesTab = document.getElementById('edit-image-active');
  
    editimgDesTab.addEventListener("mouseover", function() {
        editimgDesTab.style.display = "none";
        editedimgDesTab.style.display = "inline-block";
        editedimgDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });
  
    editedimgDesTab.addEventListener("mouseout", function() {
        editedimgDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
      setTimeout(function() {
        editedimgDesTab.style.display = "none";
        editimgDesTab.style.display = "inline-block";
      }, 200);
    });

var modal = document.getElementById("modal");
var btn1 = document.getElementById("register_click");

btn1.onclick = function() {

  if (modal.style.display == "block") {

    modal.style.display = "none";

  } else {

    modal.style.display = "block";

  }
}

  });
  