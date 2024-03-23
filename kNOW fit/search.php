<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kNOW fit</title>
    <link rel="stylesheet" href="css/search.css">
    <link rel="icon" sizes="180x180" href="imgs/tab_logo.png" type="image/png"> 
  </head>
  <?php
  
  session_start();

  if(isset($_COOKIE['userData'])) {

    $userData = json_decode($_COOKIE['userData'], true); 
    $username = $userData['user_id']; 
    
  } else {
  
    $username = $_SESSION['username']; 
  
  }

  $valid = 0;
  $scribe = 0;
  $pgfrsh = 1;
  $dispas = "inline-block;";
  $disact = "none;";

  $row['username'] = "temp";

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])) {

    $dbFile = 'local_database/main_db52.db';

    $category = $_POST['category'];

    try {

      $pdo = new PDO("sqlite:$dbFile");

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      if ($pgfrsh == 1) {

        $stmt1 = $pdo->prepare("SELECT guide_username FROM guide_subscriber_links WHERE subscriber = ?");
        $stmt1->execute([$username]);

      $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

      if ($result1 !== false) {
        $scribe = 1;
      }

      $pgfrsh = 0;
      }

      $stmt = $pdo->prepare("SELECT * FROM local_searchinfo WHERE category = :category");

      $stmt->bindParam(':category', $category);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($result === false) {
        echo json_encode(['error' => 'Failed to retrieve data']);
        $valid = 0;
      } else {
  
      $valid = 1;
      }

    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  ?>
  <body>
    <main>
      <form id="form"  action="search.php" method="post">
        <div class="main_total">
          <div class="main_part">
              <div class="search_space">
                  <input id="category_input" list="category" name="category" style="outline: none;" placeholder="Search">
                    <datalist id="category">
                        <option value="Mental Health">
                        <option value="Yoga">
                        <option value="Cardio">
                        <option value="Physic">
                    </datalist>
                  <a class="back_anchor" href="menu.php">
                    <img id="back_passive" class="back_btn-passive" src="imgs/backward_passive.png" alt="Back_button">
                    <img id="back_active" class="back_btn-active" src="imgs/backward_active.png" alt="Back_button" style="display: none;">
                  </a>
              </div>
              <div class="search_result_space">
                <?php
                if ($valid == 1) {
                  foreach ($result as $row) {
                      $disact = 'display: none;';
                      $dispas = 'display: inline-block;';      
                      if ($scribe == 1) {
                          foreach ($result1 as $row1) {
                              if (strval($row['username']) == strval($row1['guide_username'])) {
                                  $disact = 'display: inline-block;';
                                  $dispas = 'display: none;';
                              }
                          }
                      }
                  ?>
                  <div class="content_box flexer">
                      <div class="content_image">
                          <img id="pp_<?php echo $row['username']; ?>" class="profile_image" src="guidedata/<?php echo $row['username']; ?>/profile_img/<?php echo $row['username']; ?>_pp.jpg" alt="Profile_Picture">
                      </div>
                      <div class="content_info">
                          <p class="content_text"><?php echo $row['guide_name']; ?></p>
                          <p class="content_text">Posts <?php echo $row['posts']; ?></p>
                          <p class="content_text">Karma <?php echo $row['karma']; ?></p>
                      </div>
                      <div class="content_controls flexer">
                          <span>
                              <a href="guide_profile.php?sername=<?php echo $row['username']; ?>">
                                  <img class="more-passive" src="imgs/more_passive.png" alt="More" >
                                  <img class="more-active" src="imgs/more_active.png" alt="More" style="display: none;">
                              </a>
                          </span>
                          <span>
                              <img onclick="usScribe('<?php echo $username; ?>', '<?php echo $row['username']; ?>', 1);" class="subscribe" src="imgs/subscribe.png" alt="Subscribe" style="<?php echo $dispas; ?>">
                              <img onclick="usScribe('<?php echo $username; ?>', '<?php echo $row['username']; ?>', 0);" class="unsubscribe" src="imgs/unsubscribe.png" alt="Unsubscribe" style="<?php echo $disact; ?>">
                          </span>
                      </div>
                  </div>
                  <?php
                  }                  
                } else {
                  ?>
                  <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/search.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"It's only after you've stepped outside your comfort zone that you begin to change, grow, and transform."</h3>
                  </div>
                  <?php
                }
                ?>
              </div>
          </div>
        </div>
      </form>
    </main>
  </body>
  <script>

    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }

    document.getElementById('category_input').addEventListener('input', clickHandler);

    function clickHandler() {
      var search = document.querySelector("input[name='category']").value;      
      if (search === "Mental Health" || search === "Yoga" || search === "Cardio" || search === "Physic") {
        let form = document.getElementById("form"); 
        form.submit(); 
    }
  }
  
  function usScribe(username, guide_username, work) {
    var xhr = new XMLHttpRequest();
    var url = 'process-us_scribe.php?username=' + encodeURIComponent(username) + '&guide_username=' + encodeURIComponent(guide_username) + '&work=' + encodeURIComponent(work);
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send();
}

  </script>
  <script src="js/back_global.js"></script>
  <script src="js/component_search.js"></script>
</html>