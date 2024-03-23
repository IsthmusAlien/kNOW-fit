document.addEventListener("DOMContentLoaded", function() {

  var morepases = document.querySelectorAll('.more-passive');
  var moreactes = document.querySelectorAll('.more-active');
 
  morepases.forEach(function(morepas, index) {
    var moreact = moreactes[index];

    morepas.addEventListener("mouseover", function() {
      this.style.display = "none";
      moreact.style.display = "inline-block";
      moreact.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });
  
    moreact.addEventListener("mouseout", function() {
      this.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
      var self = this;
      setTimeout(function() {
        self.style.display = "none";
        morepases[index].style.display = "inline-block";
      }, 200);
    });
  });

    var subscribes = document.querySelectorAll('.subscribe');
    var unsubscribes = document.querySelectorAll('.unsubscribe');

    subscribes.forEach(function(subscribe, index) {
      var unsubscribe = unsubscribes[index];

    subscribe.addEventListener("click", function() {
        subscribe.style.display = "none";
        unsubscribe.style.display = "inline-block";
      });
    
      unsubscribe.addEventListener("click", function() {
        unsubscribe.style.display = "none";
        subscribe.style.display = "inline-block";
      });

    });
  });
  