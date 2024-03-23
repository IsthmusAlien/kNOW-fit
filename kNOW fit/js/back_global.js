document.addEventListener("DOMContentLoaded", function() {

    var backDesTab = document.getElementById('back_passive');
    var backedDesTab = document.getElementById('back_active');

    backDesTab.addEventListener("mouseover", function() {
      backDesTab.style.display = "none";
      backedDesTab.style.display = "inline-block";
      backedDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });

    backDesTab.addEventListener("focus", function() {
      backDesTab.style.display = "none";
      backedDesTab.style.display = "inline-block";
      backedDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });

    backedDesTab.addEventListener("mouseout", function() {
      backedDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
    setTimeout(function() {
      backedDesTab.style.display = "none";
      backDesTab.style.display = "inline-block";
    }, 200);
    });

    backedDesTab.addEventListener("blur", function() {
      backedDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
    setTimeout(function() {
      backedDesTab.style.display = "none";
      backDesTab.style.display = "inline-block";
    }, 200);
    });

  });
  