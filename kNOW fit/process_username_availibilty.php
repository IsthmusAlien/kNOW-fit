<?php

$host = "localhost";
$dbname = "main_db";
$user = "root";
$pass = "";

$conn = mysqli_connect(hostname: $host,
                        username: $user,
                        password: $pass,
                        database: $dbname);

if(mysqli_connect_errno()){
    die("Connection error: " . mysqli_connect_error());
}

$username = $_POST['username'];

$result = mysqli_query($conn, "SELECT * FROM local_backup WHERE username='$username'");

if (mysqli_num_rows($result) > 0) {
    echo '<span>Username not available</span>';
}
?>