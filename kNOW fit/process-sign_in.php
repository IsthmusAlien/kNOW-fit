<?php

session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$remember = isset($_POST["remember"]) ? 1 : 0;

if ($remember == 1) {
    $data = array(
        'user_id' => $username,
        'user_remember' => $remember
    );


$json_data = json_encode($data);

setcookie('userData', $json_data, time() + (86400 * 30), "/"); 

}

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

$result = mysqli_query($conn, "SELECT password,type FROM local_backup WHERE username='$username'");

if (mysqli_num_rows($result) > 0) {
    
    $row = mysqli_fetch_assoc($result);
        
    $hash = $row['password'];

    if (password_verify($password, $hash)) {
        
        $conn->close();
        $redirect = (int)$row['type'];

        if ($redirect == 0) {

            header("Location: http://localhost/kNOW-fit/kNOW%20fit/menu.php", true, 301);  
            exit(); 

        } else {

            header("Location: http://localhost/kNOW-fit/kNOW%20fit/guide_dashboard.php", true, 301);  
            exit(); 

        }

    }

}

?>