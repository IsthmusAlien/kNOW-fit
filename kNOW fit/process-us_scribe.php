<?php

$dbFile = 'local_database/main_db52.db';

if(isset($_GET['username']) && isset($_GET['guide_username']) && isset($_GET['work'])) {

    $username = $_GET['username'];
    $guide_username = $_GET['guide_username'];
    $work = $_GET['work'];

    $pdo = new PDO("sqlite:$dbFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($work == 1) {
      
        $stmt0 = $pdo->prepare("INSERT INTO guide_subscriber_links (guide_username, subscriber) VALUES (?, ?)");
        $stmt0->execute([$guide_username, $username]);

        $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='{$guide_username}';");

        $result = $stmt->fetch();
    
       if ($result !== false) {
        
            $stmt = $pdo->prepare("SELECT id FROM {$guide_username}");
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result !== false) { 
            
                foreach ($result as $row) {

                    $stmt1 = $pdo->prepare("INSERT INTO {$username} (interact_post_id, interact_like, interact_dislike, interact_bookmark, guide_username) VALUES (?, 0, 0, 0, ?)");
                    $stmt1->execute([$row['id'], $guide_username]);

                }
            } 
        }
        
    } else {

        $stmt1 = $pdo->prepare("SELECT interact_post_id, interact_like, interact_dislike, interact_bookmark FROM {$username} WHERE guide_username = ?"); 
        $stmt1->execute([$guide_username]);
        
        $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);       

        if ($result !== false) { 
        
            foreach ($result as $row) {

                if ($row['interact_like'] == 1) { 

                    $stmt2 = $pdo->prepare("UPDATE {$guide_username} SET likes = likes - 1 WHERE id = ?");
                    $stmt2->execute([$row['interact_post_id']]);

                }

                if ($row['interact_dislike'] == 1) { 

                    $stmt3 = $pdo->prepare("UPDATE {$guide_username} SET dislikes = dislikes - 1 WHERE id = ?");
                    $stmt3->execute([$row['interact_post_id']]);
                    
                }

            }
        }

        $stmt0 = $pdo->prepare("DELETE FROM guide_subscriber_links WHERE guide_username = ? AND subscriber = ?"); 
        $stmt0->execute([$guide_username, $username]);

        $stmt1 = $pdo->prepare("DELETE FROM {$username} WHERE guide_username = ?"); 
        $stmt1->execute([$guide_username]);

    }

} else {

    echo "Error: guide_name or work parameter is missing.";
}
?>