<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$id = $_POST["rowId"];

// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT * FROM posts WHERE id = :id;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $id);

    $statement->execute();     
        
    $result = $statement->fetchAll(); 

    foreach($result as $row){
        echo "<div class='post-container'>
        <div class='overlay2'></div>
        <img src='assets/x.svg' alt='go-back icon' class='remove2'>
       <div class='wrapper'>
            <div class='image-container'>
                <img src='Posts/".$row["image_name"] . "' alt='post'>
            </div>
            <div class='post-desc'>
                <h1 class='post-name'>". $row["Title"] . "</h1>
                <p class='desc' >".  $row["Description"] . "</p>
            </div>
         </div> 
         </div>";
    }

    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}