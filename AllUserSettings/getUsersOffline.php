<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");


// getting users who are online
try{
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    $sql = "SELECT id, Email, FullName, imageName FROM users WHERE LoginState = 'Offline'";
    $statement = $pdo->prepare($sql);
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
                        <p class='info'>Offline</p>
                        <div class='offline-circle' ></div>
                    </div>
        </div>";
    }


    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}