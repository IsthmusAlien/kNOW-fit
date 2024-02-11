document.addEventListener("DOMContentLoaded", function() {
  var commentPassive = document.getElementById('comment_passive');
  var commentActive = document.getElementById('comment_active');
  var likePassive = document.getElementById('like_passive');
  var likeActive = document.getElementById('like_active');
  var dislikePassive = document.getElementById('dislike_passive');
  var dislikeActive = document.getElementById('dislike_active');
  var starPassive = document.getElementById('star_passive');
  var starActive = document.getElementById('star_active');

  commentPassive.addEventListener("click", function() {
    commentPassive.style.display = "none";
    commentActive.style.display = "inline-block";
  });

  commentActive.addEventListener("click", function() {
    commentActive.style.display = "none";
    commentPassive.style.display = "inline-block";
  });

  starPassive.addEventListener("click", function() {
    starPassive.style.display = "none";
    starActive.style.display = "inline-block";
  });

  starActive.addEventListener("click", function() {
    starActive.style.display = "none";
    starPassive.style.display = "inline-block";
  });

  likePassive.addEventListener("click", function() {
    likePassive.style.display = "none";
    likeActive.style.display = "inline-block";
    dislikeActive.style.display = "none";
    dislikePassive.style.display = "inline-block";
  });

  likeActive.addEventListener("click", function() {
    likeActive.style.display = "none";
    likePassive.style.display = "inline-block";
  });

  dislikePassive.addEventListener("click", function() {
    dislikePassive.style.display = "none";
    dislikeActive.style.display = "inline-block";
    likeActive.style.display = "none";
    likePassive.style.display = "inline-block";
  });

  dislikeActive.addEventListener("click", function() {
    dislikeActive.style.display = "none";
    dislikePassive.style.display = "inline-block";
  });

});