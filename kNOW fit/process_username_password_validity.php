<?php

$host = "db4free.net";
$dbname = "main_db51";
$user = "tester51";
$pass = "opv20useless";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT password FROM local_backup WHERE username='$username'");

if (mysqli_num_rows($result) != 0) {

    $row = mysqli_fetch_assoc($result);
        
    $hash = $row['password'];
    
    if (password_verify($password, $hash)) {

        echo '';
        
    } else {

        echo '<span>Incorrect Password</span>';

    }

} else {

    echo '<span>Incorrect Username or Password</span>';

}
?>