likepassives = document.querySelectorAll('.like_passive_des');
likeactives = document.querySelectorAll('.like_active_des');
dislikepassives = document.querySelectorAll('.dislike_passive_des');
dislikeactives = document.querySelectorAll('.dislike_active_des');

likepassives.forEach(function(likepassive, index) {
    var likeactive = likeactives[index];
    var dislikepassive = dislikepassives[index];
    var dislikeactive = dislikeactives[index];

    likepassive.addEventListener("click", function() {
        this.style.display = "none";
        likeactive.style.display = "inline-block";
        dislikepassive.style.display = "inline-block";
        dislikeactive.style.display = "none";
    });

    likeactive.addEventListener("click", function() {
        this.style.display = "none";
        likepassive.style.display = "inline-block";
    });

    dislikepassive.addEventListener("click", function() {
        this.style.display = "none";
        dislikeactive.style.display = "inline-block";
        likepassive.style.display = "inline-block";
        likeactive.style.display = "none";
    });

    dislikeactive.addEventListener("click", function() {
        this.style.display = "none";
        dislikepassive.style.display = "inline-block";
    });

});

likepassives1 = document.querySelectorAll('.like_passive_mob');
likeactives1 = document.querySelectorAll('.like_active_mob');
dislikepassives1 = document.querySelectorAll('.dislike_passive_mob');
dislikeactives1 = document.querySelectorAll('.dislike_active_mob');

likepassives1.forEach(function(likepassive1, index) {
    var likeactive1 = likeactives1[index];
    var dislikepassive1 = dislikepassives1[index];
    var dislikeactive1 = dislikeactives1[index];

    likepassive1.addEventListener("click", function() {
        this.style.display = "none";
        likeactive1.style.display = "inline-block";
        dislikepassive1.style.display = "inline-block";
        dislikeactive1.style.display = "none";
    });

    likeactive1.addEventListener("click", function() {
        this.style.display = "none";
        likepassive1.style.display = "inline-block";
    });

    dislikepassive1.addEventListener("click", function() {
        this.style.display = "none";
        dislikeactive1.style.display = "inline-block";
        likepassive1.style.display = "inline-block";
        likeactive1.style.display = "none";
    });

    dislikeactive1.addEventListener("click", function() {
        this.style.display = "none";
        dislikepassive1.style.display = "inline-block";
    });


});

var subDesTabs = document.querySelectorAll('.s_dt');
var unsubDesTabs = document.querySelectorAll('.uns_dt');

var modal = document.getElementById("modal");

unsubDesTabs.forEach(function(unsubDesTab, index) {
  var subDesTab = subDesTabs[index];

  unsubDesTab.addEventListener("click", function() {
    unsubDesTab.style.display = "none";
    subDesTab.style.display = "inline-block";
  });

  subDesTab.addEventListener("click", function() {
    subDesTab.style.display = "none";
    unsubDesTab.style.display = "inline-block";
  });

});

var managecloseDesTabs = document.querySelectorAll('.m_c_dt');
var manageopenDesTabs = document.querySelectorAll('.m_o_dt');

managecloseDesTabs.forEach(function(managecloseDesTab, index) {
  var manageopenDesTab = manageopenDesTabs[index];

  managecloseDesTab.addEventListener("click", function() {
    managecloseDesTab.style.display = "none";
    manageopenDesTab.style.display = "inline-block";
    manageopenDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    modal.style.display = "block";
  });

  manageopenDesTab.addEventListener("click", function() {
    manageopenDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
    setTimeout(function() {
      manageopenDesTab.style.display = "none";
      managecloseDesTab.style.display = "inline-block";
      modal.style.display = "none";
    }, 200);
  });
});

var subMobs = document.querySelectorAll('.s_m');
var unsubMobs = document.querySelectorAll('.uns_m');

subMobs.forEach(function(subMob, index) {

  var unsubMob = unsubMobs[index];

  unsubMob.addEventListener("click", function() {
    unsubMob.style.display = "none";
    subMob.style.display = "inline-block";
  });

  subMob.addEventListener("click", function() {
    subMob.style.display = "none";
    unsubMob.style.display = "inline-block";
  });

});

var managecloseMobs = document.querySelectorAll('.m_c_m');
var manageopenMobs = document.querySelectorAll('.m_o_m');

managecloseMobs.forEach(function(managecloseMob, index) {
  var manageopenMob = manageopenMobs[index];

  managecloseMob.addEventListener("click", function() {
    managecloseMob.style.display = "none";
    manageopenMob.style.display = "inline-block";
    modal.style.display = "block";
  });

  manageopenMob.addEventListener("click", function() {
    modal.style.display = "none";
    manageopenMob.style.display = "none";
    managecloseMob.style.display = "inline-block";
  })

});