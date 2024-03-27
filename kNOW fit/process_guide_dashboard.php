<?php
session_start();

$time = microtime(true);
$milliseconds = round($time * 1000000000);
$id = (int)$milliseconds;
$likes = 0;
$dislikes = 0;

$dbFile = 'local_database/main_db52.db';

if(isset($_COOKIE['userData'])) {

  $userData = json_decode($_COOKIE['userData'], true); 
  $username = $userData['user_id']; 
  
} else {

  $username = $_SESSION['username']; 

}

$title = $_POST['title'];
$content = $_POST['content'];

try {

    $pdo = new PDO("sqlite:$dbFile");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='{$username}';");

    $result = $stmt->fetch();

   if ($result !== false) {

   $stmt2 = $pdo->prepare("INSERT INTO {$username} (title, content, likes, dislikes, id) VALUES (:title, :content, :likes, :dislikes, :id)");

   $stmt2->bindParam(':title', $title);
   $stmt2->bindParam(':content', $content);
   $stmt2->bindParam(':likes', $likes);
   $stmt2->bindParam(':dislikes', $dislikes);
   $stmt2->bindParam(':id', $id);
   $stmt2->execute();

   $stmt = $pdo->prepare("UPDATE local_searchinfo SET posts = posts + 1 WHERE username = :username");

   $stmt->bindParam(':username', $username);
   $stmt->execute();

   } else {

    $stmt2 = $pdo->prepare("CREATE TABLE {$username} (
        title TEXT,
        content TEXT,
        likes INTEGER,
        dislikes INTEGER,
        id INTEGER UNIQUE
    )");

    $stmt2->execute();

    $stmt1 = $pdo->prepare("INSERT INTO {$username} (title, content, likes, dislikes , id) VALUES (:title, :content, :likes, :dislikes, :id)");

    $stmt1->bindParam(':title', $title);
    $stmt1->bindParam(':content', $content);
    $stmt1->bindParam(':likes', $likes);
    $stmt1->bindParam(':dislikes', $dislikes);
    $stmt1->bindParam(':id', $id);
    $stmt1->execute();
    
    $stmt = $pdo->prepare("UPDATE local_searchinfo SET posts = posts + 1 WHERE username = :username");

    $stmt->bindParam(':username', $username);
    $stmt->execute();

   }


} catch (PDOException $e) {

  header("Location: guide_dashboard.php", true, 301);  
  exit(); 
    echo "Error: " . $e->getMessage();

}

$stmt4 = $pdo->prepare("SELECT subscriber FROM guide_subscriber_links WHERE guide_username = ?");
$stmt4->execute([$username]);

$result = $stmt4->fetchAll(PDO::FETCH_ASSOC);

if ($result !== false) { 
  
    foreach ($result as $row) {

        $stmt1 = $pdo->prepare("INSERT INTO {$row['subscriber']} (interact_post_id, interact_like, interact_dislike, interact_bookmark, guide_username) VALUES (?, 0, 0, 0, ?)");
        $stmt1->execute([$id, $username]); 

    }
}

$pdo = null;

if ((int)$_FILES["post_image"]["error"] != 4) {

  if((int)$_FILES["post_image"]["error"] == 0) {

      $newFolder = "guidedata/".$username."/post_imgs/";

      if (!file_exists($newFolder)) {

          mkdir($newFolder, 0777, true); 

      }

      $filename = strval($id).".jpg";
      $uploadFile = $newFolder . '/' . $filename;

      if(move_uploaded_file($_FILES["post_image"]["tmp_name"], $uploadFile)) {

        header("Location: guide_dashboard.php", true, 301);  
        exit(); 

      } else {

        header("Location: guide_dashboard.php", true, 301);  
        exit(); 
          echo "Error uploading image."; 

      }

  } else {

    header("Location: guide_dashboard.php", true, 301);  
    exit(); 
      echo "Error uploading image. Debugging info: ";
      echo "Upload error code: " . $_FILES["post_image"]["error"];

  }
  
} else {

  header("Location: guide_dashboard.php", true, 301);  
  exit(); 

}

?>