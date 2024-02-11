document.addEventListener("DOMContentLoaded", function() {
    var bookmarkDesTab = document.querySelector('.main_bookmark_des_tab');
    var bookmarkedDesTab = document.querySelector('.main_bookmarked_des_tab');
  
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
  });
  