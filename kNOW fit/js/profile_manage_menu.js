document.addEventListener("DOMContentLoaded", function() {
    var managecloseDesTab = document.getElementById('manage_close_des');
    var manageopenDesTab = document.getElementById('manage_open_des');
  
    managecloseDesTab.addEventListener("mouseover", function() {
      managecloseDesTab.style.display = "none";
      manageopenDesTab.style.display = "inline-block";
      manageopenDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });
  
    manageopenDesTab.addEventListener("mouseout", function() {
      manageopenDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
      setTimeout(function() {
        manageopenDesTab.style.display = "none";
        managecloseDesTab.style.display = "inline-block";
      }, 200);
    });

    var managecloseMob = document.getElementById('manage_close_mob');
    var manageopenMob = document.getElementById('manage_open_mob');

    managecloseMob.addEventListener("click", function() {
      managecloseMob.style.display = "none";
      manageopenMob.style.display = "inline-block";
    });
  
    manageopenMob.addEventListener("click", function() {
      manageopenMob.style.display = "none";
      managecloseMob.style.display = "inline-block";
    })
  });
  