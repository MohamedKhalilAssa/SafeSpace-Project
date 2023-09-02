<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$connectedUser = $_SESSION["userId"];
$clickedUser = $_POST["clicked"];
// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT * FROM friendstable WHERE (sender_id = :id AND receiver_id = :id2) OR (receiver_id = :id AND sender_id = :id2) AND friendship = '1';";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $connectedUser);
    $statement->bindValue(':id2', $clickedUser);

    $statement->execute();     
        
    $result = $statement->fetch(); 

    if($result){
        $sql2 = "SELECT id, image_name, Time FROM posts WHERE poster_id = :id2 ORDER BY Time DESC;";
        $statement2 = $pdo->prepare($sql2);
    
        $statement2->bindValue(':id2', $clickedUser);
    
        $statement2->execute();     
            
        $result2 = $statement2->fetchAll(); 
        if($result2){
            foreach($result2 as $row){
                echo "<div class='Post'>
                        <img data-id='". $row["id"] ."' src='Posts/". $row["image_name"] ."' alt='Post'>
                     </div>";
            }
        } else{
            echo "<div class='noPost'>
                <h1>There are no posts yet</h1>
            </div>";
        }
        
    } else {
        echo "<div class='noPost'>
                <h1>Only friends can see each other's posts</h1>
            </div>";
    }

    $statement = null;
    $statement2 = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}