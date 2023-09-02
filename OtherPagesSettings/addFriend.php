<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



    $clickedUser = $_POST["Id"];
    $connectedUser = $_SESSION["userId"];
    var_dump($_SESSION);
    // echo "connected : $connectedUser \n";
    // echo "Clicked : $clickedUser";
    
    try{
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

        // Inserting into Friends table
        $sql1 = "INSERT INTO friendsTable (sender_id , receiver_id , friendship) VALUES (:senderId,:receiverId,'0');";
        $statement1 = $pdo->prepare($sql1);
    
        $statement1->bindValue(':senderId', $connectedUser);
        $statement1->bindValue(':receiverId', $clickedUser);

        $statement1->execute();
    
        
        // Insert into notifications
        $sql2 = "INSERT INTO notifications (receiver_id,sender_id , title,details) VALUES (:receiverId,:sender,'Friend Request',:name_sent_request);";
        $statement2 = $pdo->prepare($sql2);
    
        $statement2->bindValue(':receiverId', $clickedUser);
        $statement2->bindValue(':sender', $connectedUser);
        $statement2->bindValue(':name_sent_request', $_SESSION["Fullname"] . " sent you a friend request!");

        $statement2->execute();

        $statement1 = null;
        $statement2 = null;
        $pdo = null;
        
      
    
        die();
    }
    catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
    }
