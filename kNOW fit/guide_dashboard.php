<?php

session_start();

if(isset($_COOKIE['userData'])) {

  $userData = json_decode($_COOKIE['userData'], true); 
  $username = $userData['user_id']; 
  
} else {

  $username = $_SESSION['username']; 

}

$dbFile = 'local_database/main_db52.db';

try {

  $pdo = new PDO("sqlite:$dbFile");

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt1 = $pdo->prepare("SELECT karma FROM local_searchinfo WHERE username = ?");
  $stmt1->execute([$username]);

  $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

  $stmt = $pdo->prepare("SELECT * FROM {$username}");
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($result) == 0) {
    $valid = 0;
  } else {
    $valid = 1;
  }


} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kNOW fit</title>
    <link rel="stylesheet" href="css/guide_dashboard.css">
    <link rel="icon" sizes="180x180" href="imgs/tab_logo.png" type="image/png"> 
  </head>
  <body>
    <main>
      <form action="process_guide_dashboard.php" method="post" enctype="multipart/form-data">
        <div class="main_total">
          <div class="main_current">
            <span class="top-post">
              <h2 class="part_title-sp">Create a post</h2>
              <label for="file-input">
                <img id="add-img-passive" class="add-img_passive" src="imgs/add-image_passive.png" alt="">
                <input type="file" name="post_image" id="file-input" style="display:none;" accept="image/png, image/jpeg">
                <img id="add-img-active" class="add-img_active" src="imgs/add-image_active.png" alt="" style="display:none;">
              </label>
              <button class="submit_btn" name="submit" value="Submit" type="submit"><h2>Post</h2></button>
            </span>
            <div class="crpost">
              <input name="title" class="title" type="text" placeholder="Title" required oninvalid="this.setCustomValidity('Please enter title')" oninput="this.setCustomValidity('')">
              <textarea name="content"  id="tr_imgch" class="text" placeholder="Content" required oninvalid="this.setCustomValidity('Please enter content')" oninput="this.setCustomValidity('')"></textarea>
              <div id="image_container" class="container" style="display:none;">
                  <img id="image" class="main_view_content_image" src="" alt="Image">
              </div>
            </div>
          </div>
          <div class="main_history">
            <span class="top-post">
              <h2 class="part_title-sp">My posts</h2>
              <h3 class="part_title-sp2">Karma <?php echo $result1['karma']; ?></h3>
              <img id="manage_close" class="main_manage_close" src="imgs/manage_close.png" alt="Profile_Picture">
              <img id="manage_open" class="main_manage_open" src="imgs/manage_open.png" alt="Profile_Picture" style="display: none;">
            </span>
            <div class="odpost">
              <?php
                if ($valid == 1) {
                  foreach ($result as $row) {
                      $checkimg = "guidedata/".$username."/post_imgs/". $row['id'].".jpg";
                    ?>
                       <div class="main_view_content">
                          <h2 class="main_view_content_title"><?php echo $row['title']; ?></h2>
                          <h4 class="main_view_content_text">
                            <?php echo $row['content']; ?>
                          </h4>
                          <?php 
                            if (file_exists($checkimg)) {
                          ?>
                          <div class="container_od">
                            <img id="image" class="main_view_content_image" src=<?php echo $checkimg; ?> alt="Image">
                          </div>
                          <?php
                            }
                          ?>
                          <div class="main_view_content_reaction">
                            <span class="content_span">
                              <img class="content_controls" src="imgs/like_active.png" alt="liked">
                              <h2><?php echo $row['likes'];?></h2>
                            </span>
                            <span class="content_span">
                              <img class="content_controls" src="imgs/dislike_active.png" alt="liked">
                              <h2><?php echo $row['dislikes'];?></h2>
                            </span>
                          </div>
                        </div>
                    <?php
                  }
                } else {
                  ?>
                  <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/posting.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Your posts will be displayed here."</h3>
                  </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
      </form>
    </main>
    <div div id="modal" class="modal" style="display: none;">
      <div class="modal-content">
        <h3><a href="guide_profile.php">Edit Profile</a></h3>
        <h3><a href="exit.php">Logout</a></h3>
      </div>
    </div>
  </body>
  <script>

document.addEventListener('DOMContentLoaded', function () {
  document.body.addEventListener('click', function(event) {
    const imageContainer = event.target.closest('.container_od');
    if (imageContainer) {
      const imageSrc = event.target.getAttribute('src');
      if (imageSrc) {
        const imagePopup = document.createElement('div');
        imagePopup.classList.add('image-popup');
        document.body.appendChild(imagePopup);

        const popupImage = document.createElement('img');
        popupImage.setAttribute('src', imageSrc);
        imagePopup.innerHTML = ''; 
        imagePopup.appendChild(popupImage);
        imagePopup.style.display = 'flex';

        imagePopup.addEventListener('click', function (event) {
          if (event.target === imagePopup) {
            imagePopup.style.display = 'none';
          }
        });
      }
    }
  });
});

    let popupTriggered = false; 

    function popup () {
        if (!popupTriggered) { 
            const imageContainer = document.querySelector('.container');
            const imageSrc = imageContainer.querySelector('img').getAttribute('src'); 
            const imagePopup = document.createElement('div');
            imagePopup.classList.add('image-popup');
            document.body.appendChild(imagePopup);

            function handleImageClick(event) {
                if (imageSrc) {
                    const imgSrc = event.target.getAttribute('src');
                    const popupImage = document.createElement('img');
                    popupImage.setAttribute('src', imgSrc);
                    imagePopup.innerHTML = ''; 
                    imagePopup.appendChild(popupImage);
                    imagePopup.style.display = 'flex';
                }
            }

            imageContainer.addEventListener('click', handleImageClick);

            imagePopup.addEventListener('click', function (event) {
                if (imageSrc) {
                    if (event.target === imagePopup) {
                        imagePopup.style.display = 'none';
                    }
                }
            });

            popupTriggered = true; 
        }
    }

    document.getElementById('file-input').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var img = new Image();
            img.src = e.target.result;
            img.onload = function() {

                document.getElementById('image').src = e.target.result;
                document.getElementById('image_container').style.display = "inline-block";
                document.getElementById('tr_imgch').style.height = "55%";
                popup(); 
            };
        };

        reader.readAsDataURL(file); 
    });
        
  </script>
  <script src="js/component_guide_dashboard.js"></script>
</html>