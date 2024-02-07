<?php

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);

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

$sql1 = "INSERT INTO local_main (username, email, password, type) VALUES (?, ?, ?, ?)";

$sql2 = "INSERT INTO local_backup (username, email, password, type) VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql1)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssi",
                        $username,
                        $email,
                        $password,
                        $type);

mysqli_stmt_execute($stmt);

if(!mysqli_stmt_prepare($stmt, $sql2)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssi",
                        $username,
                        $email,
                        $password,
                        $type);

mysqli_stmt_execute($stmt);

echo "Successfull";

?>