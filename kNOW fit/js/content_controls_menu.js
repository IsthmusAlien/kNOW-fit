document.addEventListener("DOMContentLoaded", function() {
  var commentPassive = document.getElementById('comment_passive_des');
  var commentActive = document.getElementById('comment_active_des');
  var likePassive = document.getElementById('like_passive_des');
  var likeActive = document.getElementById('like_active_des');
  var dislikePassive = document.getElementById('dislike_passive_des');
  var dislikeActive = document.getElementById('dislike_active_des');
  var starPassive = document.getElementById('star_passive_des');
  var starActive = document.getElementById('star_active_des');

  var commentPassive1 = document.getElementById('comment_passive_mob');
  var commentActive1 = document.getElementById('comment_active_mob');
  var likePassive1 = document.getElementById('like_passive_mob');
  var likeActive1 = document.getElementById('like_active_mob');
  var dislikePassive1 = document.getElementById('dislike_passive_mob');
  var dislikeActive1 = document.getElementById('dislike_active_mob');
  var starPassive1 = document.getElementById('star_passive_mob');
  var starActive1 = document.getElementById('star_active_mob');

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

  commentPassive1.addEventListener("click", function() {
    commentPassive1.style.display = "none";
    commentActive1.style.display = "inline-block";
  });

  commentActive1.addEventListener("click", function() {
    commentActive1.style.display = "none";
    commentPassive1.style.display = "inline-block";
  });

  starPassive1.addEventListener("click", function() {
    starPassive1.style.display = "none";
    starActive1.style.display = "inline-block";
  });

  starActive1.addEventListener("click", function() {
    starActive1.style.display = "none";
    starPassive1.style.display = "inline-block";
  });

  likePassive1.addEventListener("click", function() {
    likePassive1.style.display = "none";
    likeActive1.style.display = "inline-block";
    dislikeActive1.style.display = "none";
    dislikePassive1.style.display = "inline-block";
  });

  likeActive1.addEventListener("click", function() {
    likeActive1.style.display = "none";
    likePassive1.style.display = "inline-block";
  });

  dislikePassive1.addEventListener("click", function() {
    dislikePassive1.style.display = "none";
    dislikeActive1.style.display = "inline-block";
    likeActive1.style.display = "none";
    likePassive1.style.display = "inline-block";
  });

  dislikeActive1.addEventListener("click", function() {
    dislikeActive1.style.display = "none";
    dislikePassive1.style.display = "inline-block";
  });

});