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

$result = mysqli_query($conn, "SELECT * FROM local_backup WHERE username='$username'");

if (mysqli_num_rows($result) > 0) {
    echo '<span>Username not available</span>';
}
?>