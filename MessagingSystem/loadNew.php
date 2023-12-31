<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$connectedUser = $_SESSION["userId"];
$sendTo = $_POST["sendTo"];

// echo "connected : $connectedUser \n";

try{

    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT  * FROM messages WHERE (sender_id = :id AND receiver_id = :id2)  OR (receiver_id = :id AND sender_id = :id2) ORDER BY MessageTime DESC LIMIT 1;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $connectedUser);
    $statement->bindValue(':id2', $sendTo);

    $statement->execute();     
        
    $result = $statement->fetch(); 
   
    if($result){
            if($result["sender_id"] == $connectedUser){
                echo "<div class='sent'>". $result["message"] ." <p class='date'>". $result["MessageTime"] . " </p></div>";
            } else {
              echo " <div class='received'>". $result["message"] ." <p class='date'>". $result["MessageTime"] . " </p></div>";
            }
    }
       
    
      

    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}