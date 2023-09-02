<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$connectedUser = $_SESSION["userId"];

// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT id, image_name, Time FROM posts WHERE poster_id = :id ORDER BY Time DESC;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $connectedUser);

    $statement->execute();     
        
    $result = $statement->fetchAll(); 

    foreach($result as $row){
        echo "<div class='Post'>
                <img data-id='". $row["id"] ."' src='Posts/". $row["image_name"] ."' alt='Post'>
             </div>";
    }

    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}