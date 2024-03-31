<?php

  session_start();

  if(isset($_COOKIE['userData'])) {

    $userData = json_decode($_COOKIE['userData'], true); 
    $username = $userData['user_id']; 
    
  } else {
  
    $username = $_SESSION['username']; 
  
  }

  $dbFile = 'local_database/main_db52.db';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $post_id = $_POST['post_id'];
    $guide_username = $_POST['guide_username'];
    $work = $_POST['work'];

    try {
        
      $pdo = new PDO("sqlite:$dbFile");  

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
      $stmt2 = $pdo->prepare("SELECT interact_like,interact_dislike FROM {$username} WHERE interact_post_id = ?");
      $stmt2->execute([$post_id]);

      $result = $stmt2->fetch();

      if ($work == 1) {

        if ($result['interact_like'] != 1) {

            $stmt1 = $pdo->prepare("UPDATE {$username} SET interact_like = 1 WHERE interact_post_id = ?");
            $stmt1->execute([$post_id]);

            
            $stmt = $pdo->prepare("UPDATE local_searchinfo SET karma = karma + 1 WHERE username = ?");
            $stmt->execute([$guide_username]);
          
            $stmt0 = $pdo->prepare("UPDATE {$guide_username} SET likes = likes + 1 WHERE id = ?");
            $stmt0->execute([$post_id]);

            if ($result['interact_dislike'] == 1) {

                $stmt1 = $pdo->prepare("UPDATE {$username} SET interact_dislike = 0 WHERE interact_post_id = ?");
                $stmt1->execute([$post_id]);

                $stmt = $pdo->prepare("UPDATE local_searchinfo SET karma = karma + 1 WHERE username = ?");
                $stmt->execute([$guide_username]);

                $stmt0 = $pdo->prepare("UPDATE {$guide_username} SET dislikes = dislikes - 1 WHERE id = ?");
                $stmt0->execute([$post_id]);

            }

            $response = array("id" => $post_id, "res" => 0);
            echo json_encode($response);

        } else {

            $stmt1 = $pdo->prepare("UPDATE {$username} SET interact_like = 0 WHERE interact_post_id = ?");
            $stmt1->execute([$post_id]);

            $stmt = $pdo->prepare("UPDATE local_searchinfo SET karma = karma - 1 WHERE username = ?");
            $stmt->execute([$guide_username]);
    
            $stmt0 = $pdo->prepare("UPDATE {$guide_username} SET likes = likes - 1 WHERE id = ?");
            $stmt0->execute([$post_id]);

            $response = array("id" => $post_id, "res" => 1);
            echo json_encode($response);
        }

      } elseif ($work == 2) {

        if ($result['interact_dislike'] != 1) {

            $stmt1 = $pdo->prepare("UPDATE {$username} SET interact_dislike = 1 WHERE interact_post_id = ?");
            $stmt1->execute([$post_id]);

            $stmt = $pdo->prepare("UPDATE local_searchinfo SET karma = karma - 1 WHERE username = ?");
            $stmt->execute([$guide_username]);

            $stmt0 = $pdo->prepare("UPDATE {$guide_username} SET dislikes = dislikes + 1 WHERE id = ?");
            $stmt0->execute([$post_id]);

            if ($result['interact_like'] == 1) {

                $stmt1 = $pdo->prepare("UPDATE {$username} SET interact_like = 0 WHERE interact_post_id = ?");
                $stmt1->execute([$post_id]);

                $stmt = $pdo->prepare("UPDATE local_searchinfo SET karma = karma - 1 WHERE username = ?");
                $stmt->execute([$guide_username]);

                $stmt0 = $pdo->prepare("UPDATE {$guide_username} SET likes = likes - 1 WHERE id = ?");
                $stmt0->execute([$post_id]);
            }

            $response = array("id" => $post_id, "res" => 2);
            echo json_encode($response);

        } else {

            $stmt1 = $pdo->prepare("UPDATE {$username} SET interact_dislike = 0 WHERE interact_post_id = ?");
            $stmt1->execute([$post_id]);

            $stmt = $pdo->prepare("UPDATE local_searchinfo SET karma = karma + 1 WHERE username = ?");
            $stmt->execute([$guide_username]);

            $stmt0 = $pdo->prepare("UPDATE {$guide_username} SET dislikes = dislikes - 1 WHERE id = ?");
            $stmt0->execute([$post_id]);
            
            $response = array("id" => $post_id, "res" => 3);
            echo json_encode($response);
        }
      }
  
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

  }

?>