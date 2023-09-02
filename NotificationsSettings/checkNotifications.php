<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");



$connectedUser = $_SESSION["userId"];

// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT * FROM  notifications  WHERE receiver_id = :receiver AND is_read = '0';";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':receiver', $connectedUser);

    $statement->execute();

    $result = $statement->fetchAll();
    
    
       
        if($result){
            echo "
            <p class='count'>". count($result) ."</p>
            <a class='notif-link' href='Notifications.php'><img src='assets/bell_icon.svg' alr='bell'></a>
            ";
        }

        $statement = null;
        $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}