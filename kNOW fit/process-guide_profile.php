<?php

session_start();

$guide_name = $_POST["guide_name"];
$category = $_POST["category"];
$instagram_id = $_POST["instagram_id"];
$about = $_POST["about"];

$karma = 0;
$posts = 0;

$dbFile = 'local_database/main_db52.db';

if(isset($_COOKIE['userData'])) {

    $userData = json_decode($_COOKIE['userData'], true); 
    $username = $userData['user_id']; 
    
} else {

    $username = $_SESSION['username'];
    
}

try {

    $pdo = new PDO("sqlite:$dbFile");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("UPDATE local_guideinfo SET guide_name = :guide_name, category = :category, instagram_id = :instagram_id, about = :about WHERE username = :username");
    
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':guide_name', $guide_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':instagram_id', $instagram_id);
    $stmt->bindParam(':about', $about);
    $stmt->execute();

    $stmt1 = $pdo->prepare("SELECT posts FROM local_searchinfo WHERE username = :username");

    $stmt1->bindParam(':username', $username);
    $stmt1->execute();

    $result = $stmt1->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) { 

        if ($result['posts'] === '' || (int)$result['posts'] === 0) {

            $stmt2 = $pdo->prepare("UPDATE local_searchinfo SET guide_name = :guide_name, category = :category, karma = :karma, posts = :posts WHERE username = :username");

            $stmt2->bindParam(':username', $username);
            $stmt2->bindParam(':guide_name', $guide_name);
            $stmt2->bindParam(':category', $category);
            $stmt2->bindParam(':karma', $karma);
            $stmt2->bindParam(':posts', $posts);
            $stmt2->execute();

        } else {

            $stmt2 = $pdo->prepare("UPDATE local_searchinfo SET guide_name = :guide_name, category = :category WHERE username = :username");

            $stmt2->bindParam(':username', $username);
            $stmt2->bindParam(':guide_name', $guide_name);
            $stmt2->bindParam(':category', $category);
            $stmt2->execute();
        }
    } else {
        $stmt2 = $pdo->prepare("INSERT INTO local_searchinfo (username, guide_name, category, karma, posts) VALUES (:username, :guide_name, :category, :karma, :posts)");

        $stmt2->bindParam(':username', $username);
        $stmt2->bindParam(':guide_name', $guide_name);
        $stmt2->bindParam(':category', $category);
        $stmt2->bindParam(':karma', $karma);
        $stmt2->bindParam(':posts', $posts);
        $stmt2->execute();
   }
} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();

}

$pdo = null;

if((int)$_FILES["profile_image"]["error"] != 4) {

    if((int)$_FILES["profile_image"]["error"] == 0) {

        $newFolder = "guidedata/".$username."/profile_img/";

        if (!file_exists($newFolder)) {

            mkdir($newFolder, 0777, true); 

        }

        $filename = $username."_pp.jpg";
        $uploadFile = $newFolder . '/' . $filename;

        if(move_uploaded_file($_FILES["profile_image"]["tmp_name"], $uploadFile)) {

            header("Location: http://localhost/kNOW-fit/kNOW%20fit/guide_dashboard.php", true, 301);  
            exit(); 

        } else {

            echo "Error uploading image."; 

        }
    } else {

        echo "Error uploading image. Debugging info: ";
        echo "Upload error code: " . $_FILES["profile_image"]["error"];

    }
} else {

    echo "No image uploaded or upload error.";

}

?>
