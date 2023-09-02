<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$sendToId = $_POST["sendTo"];
$message = $_POST["message"];
$connected = $_SESSION["userId"];
// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "INSERT INTO messages(sender_id,receiver_id,message) VALUES (:send, :receive, :message);";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':send', $connected);
    $statement->bindValue(':receive', $sendToId);
    $statement->bindValue(':message', $message);

    $statement->execute();     

    // $sql2 = "INSERT INTO notifications (receiver_id,sender_id , title,details) VALUES (:receiverId,:sender,'Received Message',:send_notif);";
    // $statement2 = $pdo->prepare($sql2);

    // $statement2->bindValue(':sender', $connected);
    // $statement2->bindValue(':receiverId', $sendToId);
    // $statement2->bindValue(':send_notif', $_SESSION["Fullname"] . " just sent you a message!");

    // $statement2->execute();     
 
    $statement = null;
    
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}