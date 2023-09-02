<?php

require_once(dirname(__DIR__) . "/Headers/security_config.php");



$connectedUser = $_SESSION["userId"];


// echo "connected : $connectedUser \n";

try{
    
    require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

    // query Notifications 
    
    $sql = "SELECT sender_id, receiver_id, receiver.Fullname as name1,sender.Fullname  as name2, sender.LoginState  AS state2,receiver.LoginState  AS state1, receiver.imageName AS image1, sender.imageName AS image2 FROM friendstable as f JOIN users as sender ON sender.id = f.sender_id 
            JOIN users AS receiver ON   f.receiver_id = receiver.id  WHERE sender_id = :id OR receiver_id = :id  AND friendship = '1' ORDER BY state1 DESC;";
    $statement = $pdo->prepare($sql);

    $statement->bindValue(':id', $connectedUser);
    
    $statement->execute();     
        
    $result = $statement->fetchAll(); 
    $offlineFriends= [];

    if($result){
        
       foreach($result as $row){
            if($connectedUser == $row["sender_id"]){
                //! to avoid loading the connected user
                if($row["state1"] == 'Offline'){ // ? filter the offline friends to output them down
                    if(!in_array($row,$offlineFriends)){
                        array_push($offlineFriends,$row);
                    }
                } else {
                    echo "<div class='user' data-id= '".$row["receiver_id"] ."'>
                     <div data-id= '".$row["receiver_id"] ."' class='image-container'>
                        <img data-id= '".$row["receiver_id"] ."' src='Uploads/". $row["image1"] . "' alt='avatar' data-id= '".$row["receiver_id"] ."'>
                    </div>
                    <h1 class='name' data-id= '".$row["receiver_id"] ."'>". $row["name1"] ."</h1>
                    <div data-id= '".$row["receiver_id"] ."' class='stateInfo'>
                        <p data-id= '".$row["receiver_id"] ."' class='info'>Online</p>
                        <div data-id= '".$row["receiver_id"] ."' class='online-circle'></div>
                    </div>
                     </div>";
                }
            }else {
                if($row["state2"] == 'Offline'){
                    if(!in_array($row,$offlineFriends)){
                        array_push($offlineFriends,$row);
                    }
                        
                } else {
                    echo "<div class='user' data-id= '".$row["sender_id"] ."'>
                     <div data-id= '".$row["sender_id"] ."' class='image-container'>
                        <img  data-id= '".$row["sender_id"] ."' src='Uploads/". $row["image2"] . "' alt='avatar'>
                    </div>
                    <h1 data-id= '".$row["sender_id"] ."' class='name' >". $row["name2"] ."</h1>
                    <div data-id= '".$row["sender_id"] ."' class='stateInfo'>
                        <p data-id= '".$row["sender_id"] ."' class='info'>Online</p>
                        <div data-id= '".$row["sender_id"] ."' class='online-circle'></div>
                    </div>
                     </div>";
                }
            }
       }
       if($offlineFriends){
            foreach($offlineFriends as $friend){
                if($connectedUser === $friend["sender_id"]){
                    
                     echo "<div class='user' data-id= '".$friend["receiver_id"] ."'>
                         <div data-id= '".$friend["receiver_id"] ."' class='image-container'>
                        <img data-id= '".$friend["receiver_id"] ."' src='Uploads/". $friend["image1"] . "' alt='avatar'>
                        </div>
                        <h1 data-id= '".$friend["receiver_id"] ."' class='name' >". $friend["name1"] ."</h1>
                        <div data-id= '".$friend["receiver_id"] ."' class='stateInfo'>
                        <p data-id= '".$friend["receiver_id"] ."' class='info'>Offline</p>
                        <div data-id= '".$friend["receiver_id"] ."' class='offline-circle'></div>
                         </div>
                         </div>";
                } else {
    
                    echo "<div class='user' data-id= '".$friend["sender_id"] ."'>
                    <div data-id= '".$friend["sender_id"] ."' class='image-container'>
                   <img data-id= '".$friend["sender_id"] ."' src='Uploads/". $friend["image2"] . "' alt='avatar'>
                   </div>
                   <h1 data-id= '".$friend["sender_id"] ."' class='name' >". $friend["name2"] ."</h1>
                   <div data-id= '".$friend["sender_id"] ."' class='stateInfo'>
                   <p data-id= '".$friend["sender_id"] ."' class='info'>Offline</p>
                   <div data-id= '".$friend["sender_id"] ."' class='offline-circle'></div>
                    </div>
                    </div>";
                }
             }
       }
    }else {
        echo "You've got no Friends";
    }
    // var_dump($result);

    $statement = null;
    $pdo = null;
    
    
    die();
}
catch(PDOException $e){
    return "Connection Failed!" . $e->getMessage();
}