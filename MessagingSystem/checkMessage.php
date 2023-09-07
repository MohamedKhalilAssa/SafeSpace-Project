<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$receiver = $_SESSION["userId"];
$sentBy = $_POST["sentBy"];

// echo "connected : $connectedUser \n";

try{

    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT * FROM messages WHERE receiver_id = :receiver AND sender_id = :sender AND is_read = '0';";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':receiver', $receiver);
    $statement->bindValue(':sender', $sentBy);

    $statement->execute();     
    
    $result = $statement->fetch();

    if($result){
        echo "<div class='unread'></div>";
    }

    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}