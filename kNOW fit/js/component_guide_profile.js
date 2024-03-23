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

  });
  