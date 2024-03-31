<?php

session_start();

$dbFile = 'local_database/main_db52.db';

$rem = 0;
$serview = 0;

if (isset($_GET['sername'])) {
  
  $username = $_GET['sername'];
  $serview = 1;

} else {

  if(isset($_COOKIE['userData'])) {

    $userData = json_decode($_COOKIE['userData'], true); 
    $username = $userData['user_id']; 

  } else{

    $username = $_SESSION['username'];

  }

}

try {

  $pdo = new PDO("sqlite:$dbFile");

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt1 = $pdo->prepare("SELECT guide_name,category,instagram_id,about FROM local_guideinfo WHERE username = :username");
  $stmt1->bindParam(':username', $username);
  $stmt1->execute();

  $result = $stmt1->fetch(PDO::FETCH_ASSOC);

  $guide_name = $result['guide_name'];
  $category = $result['category'];
  $instagram_id = $result['instagram_id'];
  $about = $result['about'];

  if ($result !== false) { 

    if ($result['guide_name'] !== "temp"){

      $rem = 1;

    } else {
      
      $rem = 0;

    }
  } else {

    $rem = 0;

  }
} catch (PDOException $e) {

  echo "Error: " . $e->getMessage();

}

$pdo = null;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kNOW fit</title>
    <link rel="stylesheet" href="css/guide_profile.css">
    <link rel="icon" sizes="180x180" href="imgs/tab_logo.png" type="image/png"> 
  </head>
  <body>
        <main>
          <form action="process-guide_profile.php" method="post" enctype="multipart/form-data">
            <div class="main_total_des_tab">
              <div class="main_buttons">
                <button type="submit"class="submit_btn hideable-button"><h2>Save</h2></button>
                <button type="button" id="register_click" class="def_button hideable-button"><h2>Delete Account</h2></button>
                <img onclick="window.history.back();" id="back_passive" class="back_btn-passive" src="imgs/backward_passive.png" alt="Back_button">
                <img onclick="window.history.back();" id="back_active" class="back_btn-active" src="imgs/backward_active.png" alt="Back_button" style="display: none;">
              </div>
              <div class="main_basic_info_des_tab">
                <div class="main_image_part_des_tab">
                  <img class="main_profile_picture_des_tab" id="profile-picture" src="imgs/default.jpg" alt="Profile_Picture">
                  <label for="file-input" class="noneable-box">
                    <img id="edit-image-passive" class="main_edit_image" src="imgs/edit-image-passive.png" alt="Change-Image">
                    <input type="file" name="profile_image" id="file-input" class=".viewable-inputs" style="display:none;" accept="image/png, image/jpeg">
                    <img id="edit-image-active" class="main_edited_image" src="imgs/edit-image-active.png" alt="Change-Image" style="display: none;">
                  </label>
                </div>
              </div>
              <div class="main_all_info_des_tab">
                <div class="info_div_up">
                  <h3 class="text info_cards">😊 Hello there, I am </h3>
                  <input id="guide_name" class="text viewable-inputs" type="text" name="guide_name" autocomplete="off" style="outline: none;" required oninvalid="this.setCustomValidity('Please enter name')" oninput="this.setCustomValidity('')">
                  <h3 class="text info_cards">Subscribe me to improve your</h3>
                  <input id="categoryInput" class="text viewable-inputs" list="category" name="category" style="outline: none;" required>
                  <datalist id="category">
                      <option value="Mental Health">
                      <option value="Yoga">
                      <option value="Cardio">
                      <option value="Physic">
                  </datalist>
                  <h3 class="text info_cards">Follow me on Instagram @</h3>
                  <input id="instagram_id" class="text viewable-inputs" type="text" name="instagram_id" autocomplete="off" style="outline: none;" required oninvalid="this.setCustomValidity('Please enter instagram id')" oninput="this.setCustomValidity('')">
                </div>
                <div>
                  <h2 class="text title">About Me</h2>
                  <textarea id="about" name="about" class="text info viewable-inputs" required oninvalid="this.setCustomValidity('Please fill about')" oninput="this.setCustomValidity('')"></textarea>
                </div>
              </div>
            </div>
            </form>
        </main>
        <div div id="modal" class="modal" style="display: none;">
          <div class="modal-content">
            <h3><a href="def-exit.php?user_guide=<?php echo $username; ?>">Confirm</a></h3>
          </div>
        </div>
  </body>
  <script>

        document.getElementById('file-input').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    var aspectRatio = img.width / img.height;
                    var targetAspectRatio = 8 / 3;
                    var minAspectRatio = targetAspectRatio * 0.90; 
                    var maxAspectRatio = targetAspectRatio * 1.10; 

                    if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
                        alert("Image aspect ratio should be within 10% deviation from 8:3.");
                    } else {
                        document.getElementById('profile-picture').src = e.target.result;
                    }
                };
            };

            reader.readAsDataURL(file);
        });
        
        var rem = parseInt("<?php echo $rem; ?>");

        if (rem == 0) {
          const input = document.getElementById("file-input"); 
          const url = "imgs/default.jpg"
          const dt = new DataTransfer();  
          const request = new XMLHttpRequest();   
          request.open("GET", url, true);
          request.responseType = "arraybuffer";
          const fileType = (url.substr(url.lastIndexOf(".") + 1));
          const mimeType =  ("image/" + fileType).replace("jpg", "jpeg"); 
          request.overrideMimeType(mimeType);
          request.onload = function (e) {
                      const blob = new Blob([this.response], {type: mimeType});  
                      const file = new File([blob], "default.jpg")      
                      dt.items.add(file);    
                      input.files = dt.files;     
          }
          request.send();

          const categoryInput = document.getElementById("categoryInput");
          const categoryOptions = Array.from(document.getElementById("category").options).map(option => option.value);

          categoryInput.addEventListener("change", function() {
              const enteredValue = categoryInput.value;
              if (!categoryOptions.includes(enteredValue)) {
                  categoryInput.setCustomValidity("Please select a valid category");
              } else {
                  categoryInput.setCustomValidity("");
              }
          });
      } else {

        window.onload = function() {
          changeImageSourceandMore();
        };

        function changeImageSourceandMore() {
          var newSrc = "guidedata/"+"<?php echo $username; ?>"+"/"+"profile_img"+"/"+"<?php echo $username; ?>"+"_pp.jpg";
          document.getElementById("profile-picture").src = newSrc;

          const input = document.getElementById("file-input"); 
          const url = "guidedata/"+"<?php echo $username; ?>"+"/"+"profile_img"+"/"+"<?php echo $username; ?>"+"_pp.jpg";
          const dt = new DataTransfer();  
          const request = new XMLHttpRequest();   
          request.open("GET", url, true);
          request.responseType = "arraybuffer";
          const fileType = (url.substr(url.lastIndexOf(".") + 1));
          const mimeType =  ("image/" + fileType).replace("jpg", "jpeg"); 
          request.overrideMimeType(mimeType);
          request.onload = function (e) {
                      const blob = new Blob([this.response], {type: mimeType});  
                      const file = new File([blob], "<?php echo $username; ?>"+"_pp.jpg")      
                      dt.items.add(file);    
                      input.files = dt.files;     
          }
          request.send();

          var guide_name_input = document.getElementById("guide_name");
          guide_name_input.value = "<?php echo $guide_name; ?>";
          var category_input = document.getElementById("categoryInput");
          category_input.value = "<?php echo $category; ?>";
          var instagram_id_input = document.getElementById("instagram_id");
          instagram_id_input.value = "<?php echo $instagram_id; ?>";
          var about_input = document.getElementById("about");
          about_input.value = "<?php echo $about; ?>";

          const categoryInput = document.getElementById("categoryInput");
          const categoryOptions = Array.from(document.getElementById("category").options).map(option => option.value);

          categoryInput.addEventListener("change", function() {
              const enteredValue = categoryInput.value;
              if (!categoryOptions.includes(enteredValue)) {
                  categoryInput.setCustomValidity("Please select a valid category");
              } else {
                  categoryInput.setCustomValidity("");
              }
            });

        }
      }

      var serview = parseInt("<?php echo $serview; ?>");

      if (serview == 1) {

        makeViewableOnlyandMore();

        function disableClick(event) {
            event.preventDefault();
            event.stopPropagation();
        }

        function makeViewableOnlyandMore() {
          var viewables = document.querySelectorAll('.viewable-inputs');
          var hideables = document.querySelectorAll('.hideable-button');
          var noneables = document.querySelector('.noneable-box');

          viewables.forEach(function(viewable, index) {
            viewable.disabled = true;
          });

          hideables.forEach(function(hideable, index) {
            hideable.addEventListener("click", disableClick);
            hideable.style.visibility = "hidden";
          });

          noneables.style.display = "none";
        }
      }
      
  </script>
  <script src="js/component_guide_profile.js"></script>
  <script src="js/back_global.js"></script>
</html>