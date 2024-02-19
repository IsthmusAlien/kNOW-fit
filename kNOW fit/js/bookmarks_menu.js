document.addEventListener("DOMContentLoaded", function() {
    var bookmarkDesTab = document.getElementById('bookmark_close_des');
    var bookmarkedDesTab = document.getElementById('bookmark_open_des');
  
    bookmarkDesTab.addEventListener("mouseover", function() {
      bookmarkDesTab.style.display = "none";
      bookmarkedDesTab.style.display = "inline-block";
      bookmarkedDesTab.style.animation = "scaleAnimation 0.2s ease-in-out forwards";
    });
  
    bookmarkedDesTab.addEventListener("mouseout", function() {
      bookmarkedDesTab.style.animation = "scaleAnimationReverse 0.2s ease-in-out forwards";
      setTimeout(function() {
        bookmarkedDesTab.style.display = "none";
        bookmarkDesTab.style.display = "inline-block";
      }, 200);
    });

    var bookmarkMob = document.getElementById('bookmark_close_mob');
    var bookmarkedMob = document.getElementById('bookmark_open_mob');

    bookmarkMob.addEventListener("click", function() {
      bookmarkMob.style.display = "none";
      bookmarkedMob.style.display = "inline-block";
    });
  
    bookmarkedMob.addEventListener("click", function() {
      bookmarkedMob.style.display = "none";
      bookmarkMob.style.display = "inline-block";
    })
  });
  