<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$id = $_POST["rowId"];



try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // Delete 
    
    $sql = "DELETE FROM posts WHERE id = :id;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $id);

    $statement->execute();     
        
    
    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}