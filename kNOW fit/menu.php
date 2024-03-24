<?php 

  session_start();

  if(isset($_COOKIE['userData'])) {

    $userData = json_decode($_COOKIE['userData'], true); 
    $username = $userData['user_id']; 
    
  } else {
  
    $username = $_SESSION['username']; 
  
  }

  $CTvalid = 0;

  $dbFile = 'local_database/main_db52.db';

  try {

    $pdo = new PDO("sqlite:$dbFile");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM guide_subscriber_links WHERE subscriber = :subscriber");

    $stmt->bindParam(':subscriber', $username);
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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kNOW fit</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="icon" sizes="180x180" href="imgs/tab_logo.png" type="image/png"> 
  </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <body>
    <main>
      <div class="main_total_mob">
        <div class="main_view_part_mob">
          <div id="recallmob" class="main_parter_mob">
            <?php
            if ($valid == 1) {
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $guide_username = $_POST['guide_username'];

                  try {

                    $stmt1 = $pdo->prepare("SELECT * FROM {$guide_username}");
                    $stmt1->execute();
                
                    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (count($result1) != 0) {
                      $CTvalid = 1;
                    }
                
                  } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                  }
              ?>
            <div class="main_view_manage_mob">
            <div class="main_view_bookmark">
              <span>
                <img onclick="usScribe('<?php echo $username; ?>', '<?php echo $guide_username; ?>', 0);" class="main_unsubscribe_des_tab uns_m" src="imgs/unsubscribe.png" alt="Unsubscribe">
                <img onclick="usScribe('<?php echo $username; ?>', '<?php echo $guide_username; ?>', 1);" class="main_subscribe_des_tab s_m" src="imgs/subscribe.png" alt="Subscribe" style="display: none;">
              </span>
            </div>
            <div class="main_view_profile">
              <span>
                <img class="main_profile_picture_close_des_tab m_c_m" src="imgs/manage_close.png" alt="Account">
                <img class="main_profile_picture_open_des_tab m_o_m" src="imgs/manage_open.png" alt="Account" style="display: none;">
              </span>
            </div>
            </div>
            <div class="main_view_scroll_mob">
              <?php
              if ($CTvalid == 1) {
                foreach ($result1 as $row1) {
                  $checkimg = "guidedata/".$guide_username."/post_imgs/". $row1['id'].".jpg";
                ?>
              <div class="scroll_content">
              <h2 class="main_view_content_title"><?php echo $row1['title']; ?></h2>
              <h4 class="main_view_content_text">
              <?php echo $row1['content']; ?>
              </h4>
                <?php 
                    if (file_exists($checkimg)) {
                  ?>
                  <div class="container_mob">
                    <img id="image" class="main_view_content_image" src=<?php echo $checkimg; ?> alt="Image">
                  </div>
                  <?php
                    }
                  ?>
              <div class="main_view_content_reaction">
                <span class="content_span_mob">
                  <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',1);" class="content_controls_mob like_passive_mob" src="imgs/like_passive.png" alt="like">
                  <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',1);" class="content_controls_mob like_active_mob" src="imgs/like_active.png" alt="liked" style="display: none;">
                  <h2 class="<?php echo $row1['id'];?>_lk">
                        <?php echo $row1['likes']; ?>
                      </h2> 
                </span>
                <span class="content_span_mob">
                  <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',2);" class="content_controls_mob dislike_passive_mob" src="imgs/dislike_passive.png" alt="like">
                  <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',2);" class="content_controls_mob dislike_active_mob" src="imgs/dislike_active.png" alt="liked" style="display: none;">
                  <h2 class="<?php echo $row1['id'];?>_dlk">
                        <?php echo $row1['dislikes']; ?>
                      </h2> 
                </span>
                <span class="content_span_mob">
                  <img class="content_controls_mob star_passive_mob" src="imgs/star_passive.png" alt="like">
                  <img class="content_controls_mob star_active_mob" src="imgs/star_active.png" alt="liked" style="display: none;">
                </span>
              </div>
              </div>
              <?php
                  }
                } else {
                  ?>
          <div class="main_view_manage_mob">
            <div class="main_view_bookmark">
              <span>
              </span>
            </div>
            <div class="main_view_profile">
            </div>
          </div>
          <div class="main_view_scroll_mob" style="display:flex; align-items: center; flex-direction: column;">
          <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/no_posts.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Sorry, no posts here."</h3>
            </div>
          </div>
                <?php
                } }
                else {
                  ?>
                         <div class="main_view_manage_mob">
            <div class="main_view_bookmark">
              <span>
              </span>
            </div>
            <div class="main_view_profile">
              <span>
                <img class="main_profile_picture_close_des_tab m_c_m" src="imgs/manage_close.png" alt="Account">
                <img class="main_profile_picture_open_des_tab m_o_m" src="imgs/manage_open.png" alt="Account" style="display: none;">
              </span>
            </div>
          </div>
          <div class="main_view_scroll_mob" style="display:flex; align-items: center; flex-direction: column;">
          <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/menu_current.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Make each day your masterpiece."</h3>
            </div>
          </div>
                  <?php
                }

              } else {
                ?>
          <div class="main_view_manage_mob">
            <div class="main_view_bookmark">
              <span>
              </span>
            </div>
            <div class="main_view_profile">
              <span>
                <img class="main_profile_picture_close_des_tab m_c_m" src="imgs/manage_close.png" alt="Account">
                <img class="main_profile_picture_open_des_tab m_o_m" src="imgs/manage_open.png" alt="Account" style="display: none;">
              </span>
            </div>
          </div>
          <div class="main_view_scroll_mob" style="display:flex; align-items: center; flex-direction: column;">
          <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/menu_new.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Success is no accident. It is hard work, perseverance, learning, studying, sacrifice and most of all, love of what you are doing or learning to do."</h3>
            </div>
          </div>
                <?php
              }
              ?>
            </div>  
          <div class="main_select_part_mob">
            <div class="main_scroll_space_mob">
            <?php
                if ($valid == 1) {
                  foreach ($result as $row) {
            ?>
              <div class="main_scroll_content_mob" tabindex="0">
                 <img onclick="handleCTmob('<?php echo $row['guide_username']; ?>');" class="main_scroll_picture_mob" src="guidedata/<?php echo $row['guide_username']; ?>/profile_img/<?php echo $row['guide_username']; ?>_pp.jpg" alt="Another_Picture">
              </div>
            <?php
                  }
                } else {
              ?>
            <h3 class="temp_text">Click the Icon in the top right corner and head to Discover Tab to explore</h3>
            <?php
            }
            ?>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="main_total_des_tab">
        <div class="main_selection_part_des_tab">
          <div class="main_scroll">
          <?php
                if ($valid == 1) {
                  foreach ($result as $row) {
          ?>
            <div class="main_scroll_content_des_tab" tabindex="0">
              <img onclick="handleCT('<?php echo $row['guide_username']; ?>');" class="main_scroll_picture_des_tab" src="guidedata/<?php echo $row['guide_username']; ?>/profile_img/<?php echo $row['guide_username']; ?>_pp.jpg" alt="Profile_Picture">
            </div>
          <?php
                  }
                } else {
            ?>
              <h3 class="temp_text">Click the Icon in the top right corner and head to Discover Tab to explore</h3>
            <?php
                }
          ?>
          </div>
        </div>
        <div id="recall" class="main_view_part_des_tab">
        <?php
            if ($valid == 1) {
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $guide_username = $_POST['guide_username'];

                  try {

                    $stmt1 = $pdo->prepare("SELECT * FROM {$guide_username}");
                    $stmt1->execute();
                
                    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    if (count($result1) != 0) {
                      $CTvalid = 1;
                    }
                
                  } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                  }
              ?>
          <div class="main_view_profile_part">
            <div class="main_bookmarks_part">
              <span>
                <img onclick="usScribe('<?php echo $username; ?>', '<?php echo $row['guide_username']; ?>', 0);"   class="main_unsubscribe_des_tab uns_dt" src="imgs/unsubscribe.png" alt="Unsubscribe">
                <img onclick="usScribe('<?php echo $username; ?>', '<?php echo $row['guide_username']; ?>', 1);"   class="main_subscribe_des_tab s_dt" src="imgs/subscribe.png" alt="Subscribe" style="display: none;">
              </span>
            </div>
            <div class="main_profile_picture_part">
              <span>
                <img class="main_profile_picture_close_des_tab m_c_dt" src="imgs/manage_close.png" alt="Profile_Picture">
                <img class="main_profile_picture_open_des_tab m_o_dt" src="imgs/manage_open.png" alt="Profile_Picture" style="display: none;">
              </span>
            </div>
          </div>
          <div class="main_view_main_part_des_tab">
            <?php
            if ($CTvalid == 1) {
              foreach ($result1 as $row1) {
                $checkimg = "guidedata/".$guide_username."/post_imgs/". $row1['id'].".jpg";
              ?>
                <div class="main_view_content_des_tab">
                  <h2 class="main_view_content_title"><?php echo $row1['title']; ?></h2>
                  <h4 class="main_view_content_text">
                    <?php echo $row1['content']; ?>
                  </h4>
                  <?php 
                    if (file_exists($checkimg)) {
                  ?>
                  <div class="container">
                    <img id="image" class="main_view_content_image" src=<?php echo $checkimg; ?> alt="Image">
                  </div>
                  <?php
                    }
                  ?>
                  <div class="main_view_content_reaction">
                    <span class="content_span">
                      <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',1);" class="content_controls like_passive_des" src="imgs/like_passive.png" alt="like">
                      <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',1);" class="content_controls like_active_des" src="imgs/like_active.png" alt="liked" style="display: none;">
                      <h2 class="<?php echo $row1['id'];?>_lk">
                        <?php echo $row1['likes'];?>
                      </h2>
                    </span>
                    <span class="content_span">
                      <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',2);" class="content_controls dislike_passive_des" src="imgs/dislike_passive.png" alt="like">
                      <img onclick="chngedlb('<?php echo $row1['id'];?>','<?php echo $guide_username;?>',2);" class="content_controls dislike_active_des" src="imgs/dislike_active.png" alt="liked" style="display: none;">
                      <h2 class="<?php echo $row1['id'];?>_dlk">
                        <?php echo $row1['dislikes']; ?>
                      </h2> 
                    </span>
                    <span class="content_span">
                      <img class="content_controls star_passive_des" src="imgs/star_passive.png" alt="like">
                      <img class="content_controls star_active_des" src="imgs/star_active.png" alt="liked" style="display: none;">
                    </span>
                  </div>
                </div>
            <?php
                } 
              } else {
            ?>
          <div class="main_view_main_part_des_tab" style="display:flex; align-items: center; flex-direction: column;">
            <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/no_posts.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Sorry, no posts here."</h3>
            </div>
          </div>
            <?php
              } } else {
                ?>
          <div class="main_view_profile_part">
            <div class="main_bookmarks_part">
              <span>
              </span>
            </div>
            <div class="main_profile_picture_part">
              <span>
                <img class="main_profile_picture_close_des_tab m_c_dt" src="imgs/manage_close.png" alt="Profile_Picture">
                <img class="main_profile_picture_open_des_tab m_o_dt" src="imgs/manage_open.png" alt="Profile_Picture" style="display: none;">
              </span>
            </div>
          </div>
          <div class="main_view_main_part_des_tab" style="display:flex; align-items: center; flex-direction: column;">
          <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/menu_current.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Make each day your masterpiece."</h3>
            </div>
          </div>
                <?php
              }
              } else {
            ?>
          <div class="main_view_profile_part">
            <div class="main_bookmarks_part">
              <span>
              </span>
            </div>
            <div class="main_profile_picture_part">
              <span>
                <img class="main_profile_picture_close_des_tab m_c_dt" src="imgs/manage_close.png" alt="Profile_Picture">
                <img class="main_profile_picture_open_des_tab m_o_dt" src="imgs/manage_open.png" alt="Profile_Picture" style="display: none;">
              </span>
            </div>
          </div>
          <div class="main_view_main_part_des_tab" style="display:flex; align-items: center; flex-direction: column;">
            <div class="temp_screen">
                    <video autoplay loop muted class="main_subscriber_vid">
                      <source src="vids/menu_new.webm" type="video/webm">
                      Your browser does not support the video tag.
                    </video>
                    <h3>"Success is no accident. It is hard work, perseverance, learning, studying, sacrifice and most of all, love of what you are doing or learning to do."</h3>
            </div>
          </div>
            <?php
              }
            ?>
            </div>
          </div>
        </div>
    </main>
    <div div id="modal" class="modal" style="display: none;">
      <div class="modal-content">
        <h3><a href="search.php">Discover</a></h3>
        <h3><a href="exit.php">Logout</a></h3>
      </div>
    </div>
  </body>
  <script>

document.addEventListener('DOMContentLoaded', function () {
  document.body.addEventListener('click', function(event) {
    const imageContainer = event.target.closest('.container');
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

document.addEventListener('DOMContentLoaded', function () {
  document.body.addEventListener('click', function(event) {
    const imageContainer = event.target.closest('.container_mob');
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

function load_js() {
    var existingScript = document.querySelector('script[src="js/content_controls_menu.js"]');
    if (existingScript) {
        existingScript.parentNode.removeChild(existingScript);
    } else {
        console.log('No existing script found.');
    }

    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = 'js/content_controls_menu.js';
    head.appendChild(script);
}


function handleCT(guide_username) {
    $.ajax({
        url: 'menu.php', 
        type: 'POST',
        data: {
            guide_username: guide_username
        },
        success: function(response) {
          var $response = $(response);
          var recallContent = $response.find('#recall').html();
          $('#recall').html(recallContent);
          load_js();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function handleCTmob(guide_username) {
    $.ajax({
        url: 'menu.php', 
        type: 'POST',
        data: {
            guide_username: guide_username
        },
        success: function(response) {
          var $response = $(response);
          $response.find('.main_select_part_mob').remove();
          var recallContent = $response.find('#recallmob').html();
          $('#recallmob').html(recallContent);
          load_js();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function chngedlb(id, guide_username, work) {
    $.ajax({
        url: 'process-interactions.php',
        type: 'POST',
        data: {
            post_id: id,
            guide_username: guide_username,
            work: work
        },
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            var resdlb = parseInt(jsonResponse.res);
            if (resdlb === 0 || resdlb === 1) {
              var  elementId1 = jsonResponse.id + "_lk";
              var  elementId2 = jsonResponse.id + "_dlk";
            } else {
              var  elementId1 = jsonResponse.id + "_dlk";
              var  elementId2 = jsonResponse.id + "_lk";
            }
            $.ajax({
              url: 'menu.php',
              type: 'POST',
              data: {
                  guide_username: guide_username
              },
              success: function(response) {
                var $response = $(response);
                var recallContent1 = $response.find('.' + elementId1).html();
                $('.' + elementId1).html(recallContent1);
                var recallContent1 = $response.find('.' + elementId2).html();
                $('.' + elementId2).html(recallContent1);
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
              }
            });
            load_js();
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
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
  <script src="js/content_controls_menu.js"></script> 
</html>