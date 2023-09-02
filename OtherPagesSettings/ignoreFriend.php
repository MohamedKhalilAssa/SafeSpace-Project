<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



    $clickedUser = $_POST["Id"];
    $connectedUser = $_SESSION["userId"];

    // echo "connected : $connectedUser \n";
    // echo "Clicked : $clickedUser";
    
    try{
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

        $sql = "DELETE FROM friendsTable WHERE sender_id = :sender AND receiver_id = :receiver;";
        $statement = $pdo->prepare($sql);
    
        $statement->bindValue(':sender',$clickedUser );
        $statement->bindValue(':receiver', $connectedUser);

        $statement->execute();
    
            $statement = null;
            $pdo = null;
        
        echo "done";
    
        die();
    }
    catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
    }
