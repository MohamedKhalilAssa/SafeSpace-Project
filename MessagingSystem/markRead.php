<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$receiver = $_SESSION["userId"];
$sentBy = $_POST["sentBy"];

// echo "connected : $connectedUser \n";

try{

    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "UPDATE messages SET is_read = '1' WHERE receiver_id = :receiver AND sender_id = :sender;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':receiver', $receiver);
    $statement->bindValue(':sender', $sentBy);

    $statement->execute();     
    

    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}