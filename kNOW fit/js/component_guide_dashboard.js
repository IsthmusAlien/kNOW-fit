document.addEventListener("DOMContentLoaded", function() {
    var editimgDesTab = document.getElementById('add-img-passive');
    var editedimgDesTab = document.getElementById('add-img-active');
  
    editimgDesTab.addEventListener("mouseover", function() {
        editimgDesTab.style.display = "none";
        editedimgDesTab.style.display = "block";
        editedimgDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });
  
    editedimgDesTab.addEventListener("mouseout", function() {
        editedimgDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
      setTimeout(function() {
        editedimgDesTab.style.display = "none";
        editimgDesTab.style.display = "block";
      }, 200);
    });

    var manageimgDesTab = document.getElementById('manage_close');
    var managedimgDesTab = document.getElementById('manage_open');
  
    manageimgDesTab.addEventListener("mouseover", function() {
      manageimgDesTab.style.display = "none";
        managedimgDesTab.style.display = "inline-block";
        managedimgDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });
  
    managedimgDesTab.addEventListener("mouseout", function() {
      managedimgDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
      setTimeout(function() {
        managedimgDesTab.style.display = "none";
        manageimgDesTab.style.display = "inline-block";
      }, 200);
    });

  });