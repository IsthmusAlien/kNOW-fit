<?php

$dbFile = 'local_database/main_db52.db';

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

if (isset($_GET['user_guide'])) {

$username=$_GET['user_guide'];

$directoryPath = 'guidedata/'.$username; 

if (deleteDirectory($directoryPath)) {
    echo "Directory deleted successfully.";
} else {
    echo "Failed to delete the directory.";
}

$host = "db4free.net";
$dbname = "main_db51";
$user = "tester51";
$pass = "opv20useless";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = "DELETE FROM local_main WHERE username = ?";

$sql2 = "DELETE FROM local_backup WHERE username = ?";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql1)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s",
                        $username);

mysqli_stmt_execute($stmt);

if(!mysqli_stmt_prepare($stmt, $sql2)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s",
                        $username);

mysqli_stmt_execute($stmt);

$stmt->close();
$conn->close();


try{
    $pdo = new PDO("sqlite:$dbFile");
        
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt1 = $pdo->prepare("SELECT subscriber FROM guide_subscriber_links WHERE guide_username = ?");
    $stmt1->execute([$username]);

    $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    if ($result !== false && count($result) != 0) {
        foreach ($result as $row) {

            $table = $row['subscriber'];
            $stmt2 = $pdo->prepare("DELETE FROM {$table} WHERE guide_username = ?");
            $stmt2->execute([$username]);

        }
    }

    $stmt = $pdo->prepare("DROP TABLE IF EXISTS {$username}"); 
    $stmt->execute();

    $stmt3 = $pdo->prepare("DELETE FROM guide_subscriber_links WHERE guide_username = ?"); 
    $stmt3->execute([$username]);

    
    $stmt4 = $pdo->prepare("DELETE FROM local_guideinfo WHERE username = ?"); 
    $stmt4->execute([$username]);

    
    $stmt5 = $pdo->prepare("DELETE FROM local_searchinfo WHERE username = ?"); 
    $stmt5->execute([$username]);

    $pdo = null;

    session_destroy();

    setcookie('userData', '', time() - 3600, "/", '.wuaze.com');

    header("Location: home.html", true, 301);  
    exit(); 

    } catch (PDOException $e) {

        echo "Error: " . $e->getMessage();
    }
}

?>