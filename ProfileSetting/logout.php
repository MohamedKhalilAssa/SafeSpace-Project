<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");

if(!isset($_SESSION)){
    session_start();
}


try{
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    $sql = "UPDATE users SET LoginState = 'Offline' WHERE id = :id;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $_SESSION["userId"]);
    $statement->execute();

   
  

    session_unset();
    session_destroy();

    $statement = null;
    $pdo = null;
    
    
    echo "Logout Successful";
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}


