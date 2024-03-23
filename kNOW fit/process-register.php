<?php

session_start();

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);
$remember = isset($_POST["remember"]) ? 1 : 0;
$hash = password_hash($password, PASSWORD_DEFAULT);

$_SESSION['username'] = $username;

$host = "db4free.net";
$dbname = "main_db51";
$user = "tester51";
$pass = "opv20useless";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = "INSERT INTO local_main (username, email, password, type) VALUES (?, ?, ?, ?)";

$sql2 = "INSERT INTO local_backup (username, email, password, type) VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql1)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssi",
                        $username,
                        $email,
                        $hash,
                        $type);

mysqli_stmt_execute($stmt);

if(!mysqli_stmt_prepare($stmt, $sql2)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssi",
                        $username,
                        $email,
                        $hash,
                        $type);

mysqli_stmt_execute($stmt);

if ($remember == 1) {
    $data = array(
        'user_id' => $username,
        'user_remember' => $remember
    );


$json_data = json_encode($data);

setcookie('userData', $json_data, time() + (86400 * 30), "/"); 

}

$stmt->close();
$conn->close();

$dbFile = 'local_database/main_db52.db';

if ($type == 0) {

    $pdo = new PDO("sqlite:$dbFile");
        
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    $stmt = $pdo->prepare("CREATE TABLE {$username} (
        interact_post_id	INTEGER,
        interact_like	INTEGER,
        interact_dislike	INTEGER,
        interact_bookmark	INTEGER,
        guide_username	TEXT
    )");

    $stmt->execute();

    header("Location: http://localhost/kNOW-fit/kNOW%20fit/menu.php", true, 301);  
    exit(); 
    
} else {

    try {
        $guide_name = "temp";
        $category = "temp";
        $instagram_id = "temp";
        $about = "temp";
    
        $pdo = new PDO("sqlite:$dbFile");
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("INSERT INTO local_guideinfo (username, guide_name, category, instagram_id, about) VALUES (:username, :guide_name, :category, :instagram_id, :about)");
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':guide_name', $guide_name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':instagram_id', $instagram_id);
        $stmt->bindParam(':about', $about);
        $stmt->execute();

        $stmt2 = $pdo->prepare("CREATE TABLE {$username} (
            title TEXT,
            content TEXT,
            likes INTEGER,
            dislikes INTEGER,
            id INTEGER UNIQUE
        )");
    
        $stmt2->execute();
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $pdo = null;

    header("Location: http://localhost/kNOW-fit/kNOW%20fit/guide_profile.php", true, 301);  
    exit(); 
} 

?>