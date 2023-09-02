<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");



// getting users who are offline
try{
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    $sql = "SELECT id, Email, FullName, imageName FROM users WHERE LoginState = 'Online' AND id != :id;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id',$_SESSION["userId"]);
    $statement->execute();

   
    $result = $statement->fetchAll();
    


    foreach($result as $userRow){
        echo "<div class='user'>
        <div class='image-container'>
            <img src='Uploads/" . $userRow["imageName"] ."' alt='avatar'>
        </div>
        <div class='text-container'>
        <a href='usersPage.php?id=". $userRow["id"] ."'  class='Name'> " 
            .
                $userRow["FullName"]
            .
             "</a>
             <p class='email'>" .$userRow["Email"] . "</p>
        </div>
        <div class='stateInfo'>
            <p class='info'>Online</p>
            <img class='online-circle' src='assets/online.svg'>
        </div>
        </div>";
    }


    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}