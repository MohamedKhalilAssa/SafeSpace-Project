<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");



$connectedUser = $_SESSION["userId"];

// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "UPDATE notifications  SET is_read = '1' WHERE receiver_id = :receiver ;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':receiver', $connectedUser);

    $statement->execute();     
        
   
        $statement = null;
        $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}