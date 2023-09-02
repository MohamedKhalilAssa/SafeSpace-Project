<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");



    $clickedUser = $_POST["Id"];
    $connectedUser = $_SESSION["userId"];

    // echo "connected : $connectedUser \n";
    // echo "Clicked : $clickedUser";
    
    try{
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");
    
        $sql = "SELECT * FROM friendsTable WHERE (sender_id = :id1 AND receiver_id = :id2) OR (sender_id = :id2 AND receiver_id = :id1);";
        $statement = $pdo->prepare($sql);
    
        $statement->bindValue(':id1', $connectedUser);
        $statement->bindValue(':id2', $clickedUser);

        $statement->execute();
    
       
        $result = $statement->fetch();
        
        if($result){
            if($result["friendship"] == 1){
                echo "<button class='friends btn' name='Friends'>Friends</button>";
            } else {
                if($result["sender_id"] == $connectedUser){
                    echo "<button class='pending btn' name='pending'>Pending..</button>";
                } else {
                    echo "<button class='accept btn' name='Accept'>Accept!</button>
                            <button class='ignore btn' name='Accept'>Ignore..</button>";
                }
            }
        } else {
            echo "<button class='add btn' name='Adding'>Add Friend</button>";
        }
    
    
        die();
    }
    catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
    }

