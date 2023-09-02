<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



    $clickedUser = $_POST["Id"];
    $connectedUser = $_SESSION["userId"];

    // echo "connected : $connectedUser \n";
    // echo "Clicked : $clickedUser";
    
    try{
        
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");
    
        // set friendship 
        
        $sql = "UPDATE friendsTable SET friendship = '1' WHERE sender_id = :sender AND receiver_id = :receiver;";
        $statement = $pdo->prepare($sql);
    
        $statement->bindValue(':sender',$clickedUser );
        $statement->bindValue(':receiver', $connectedUser);

        $statement->execute();
    
        // send notification 
        $sql2 = "INSERT INTO notifications (receiver_id,sender_id , title,details) VALUES (:receiverId,:sender,'Friend Request Accepted!',:name_sent_request);";
        $statement2 = $pdo->prepare($sql2);
    
        $statement2->bindValue(':receiverId', $clickedUser);
        $statement2->bindValue(':sender', $connectedUser);
        $statement2->bindValue(':name_sent_request', $_SESSION["Fullname"] . " just accepted your request!");

        $statement2->execute();

            $statement = null;
            $statement2 = null;
            $pdo = null;
        
        
        echo "done";
        die();
    }
    catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
    }
