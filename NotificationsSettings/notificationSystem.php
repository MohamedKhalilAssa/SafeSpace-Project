<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



    $connectedUser = $_SESSION["userId"];

    // echo "connected : $connectedUser \n";

    try{
        
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");
    
        // query Notifications 
        
        $sql = "SELECT * FROM  notifications  WHERE receiver_id = :receiver ORDER BY timestamp DESC;";
        $statement = $pdo->prepare($sql);
    
        $statement->bindValue(':receiver', $connectedUser);

        $statement->execute();
    
        $result = $statement->fetchAll();
        
        
            foreach($result as $row){
                echo "<div class='notification'>
        
                <div class='text-container'>
                    <a href='usersPage.php?id=". $row["sender_id"] . "'  class='notif-title'> <span class='orange'>" . $row["title"]  . "</span></a>
                    <p class='details'>".  $row["details"] ."</p>
                    ";
                    if($row["is_read"] == 0){
                        echo " <div class='btn-container'>
                                    <button data-id=" .$row["id"] . " class='btn markAsRead'>Mark as read!</button>
                                 </div>";
                    }
                echo "</div>
                <div class='time'>
                    " .  $row["timestamp"]  . "
                </div>
                
                 </div>
                     "; 
                
            }

            $statement = null;
            $pdo = null;
        
        
        die();
    }
    catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
    }
