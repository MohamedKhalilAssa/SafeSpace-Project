<?php






    $id = $_POST["Id"];
    
    try{
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");
    
        $sql = "SELECT id, Email, FullName, imageName FROM users WHERE id = :id";
        $statement = $pdo->prepare($sql);
    
        $statement->bindValue(':id', $id);
    
        $statement->execute();
    
       
        $result = $statement->fetch();
        
    
    
        
            echo " <div class='image'>
            <img src ='Uploads/". $result["imageName"]. "' alt='avatar'>
        </div>
        <div class='text-container'>
            <h2 id='Name'>
            ".$result["FullName"] ."
            </h2>
            <p class='email'>".$result["Email"] . "</p>
        </div>";
        
    
    
        die();
    }
    catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
    }

