<?php 
 require_once(dirname(__DIR__) . "/Headers/security_config.php");

$title = $_POST["Title"];
$description = $_POST["desc"];


$image = $_FILES["Image"];


if ($image["size"] == 0 || empty($description) || empty($title)){
    echo "A field is missing!\n";
    die();
}

if(isset($image)){
    if (!imageSize($image)){
        echo  "Size should be below 100mbs\n";
        die();
    }  else {
            if(!error($image)){
                echo "An error happened while Uploading!\n";
                die();
            } else {
                if (!isExtensionRight($image)){
                    echo "File should be PNG, JPEG, or JPG!\n";
                    die();
                }
             }
        } 
}

   



$connectedUser = $_SESSION["userId"];

 
try{
        
        require_once(dirname(__DIR__) . "/Headers/connectToDb.php");
    
        // store the image in the posts folder
        $tmpName = $image["tmp_name"];
        $name_arr = explode(".",$image["name"]);
        $extension = strtolower(end($name_arr));

        $newName = uniqid("",true) . "." . $extension;
        $uploadPath = dirname(__DIR__) . "/Posts/" . $newName;

        move_uploaded_file($tmpName,$uploadPath);


        $sql = "INSERT INTO posts(poster_id,Title,Description,image_name) VALUES(:id,:title,:desc,:image_name);";
        $statement = $pdo->prepare($sql);
    
        $statement->bindValue(':id',$connectedUser );
        $statement->bindValue(':title', $title);
        $statement->bindValue(':desc', $description);
        $statement->bindValue(':image_name', $newName);

        $statement->execute();

        echo "done";

        if($statement){
            //get friends 

            $sql2 = "SELECT * FROM friendstable WHERE friendship = '1' AND sender_id = :id OR receiver_id = :id;";
            $statement2 = $pdo->prepare($sql2);
        
            $statement2->bindValue(':id',$connectedUser );
            $statement2->execute();
            $result= $statement2->fetchAll();
            $ids = [];
            echo "done";
            
            if($result){
                foreach($result as $row){
                    if($row["sender_id"] != $connectedUser){
                        array_push($ids,$row["sender_id"]);
                    } else {
                        array_push($ids,$row["receiver_id"]);
                    }
                }
            } else {
                die();
            }
            //send notifications about posting
            foreach($ids as $id){
                $sql3 = "INSERT INTO notifications (receiver_id,sender_id , title,details) VALUES (:receiverId,:sender,'New Post!',:name_posted);";
                $statement3 = $pdo->prepare($sql3);
            
                $statement3->bindValue(':receiverId', $id);
                $statement3->bindValue(':sender', $connectedUser);
                $statement3->bindValue(':name_posted', $_SESSION["Fullname"] . " just posted!");
                $statement3->execute();
            }
            echo "done";
        }
        
        // turning off the connections
        
            $statement = null;
            $statement2 = null;
            $statement3 = null;
            $pdo = null;
        
        
        die();
}
catch(PDOException $e){
        return "Connection Failed!" . $e->getMessage();
}



function isExtensionRight($file) {
    $fileName= explode(".",$file["name"]);
    $extension = strtolower(end($fileName));
    $acceptedExt= array("jpg","jpeg","png");
    if (in_array($extension,$acceptedExt)){   //? check extension in accepted Array
        return true;
    } else {
        return false;
    }
}
function error($file){
    if ($file["error"] == 0){   //? check for errors
        return true;
    } else {
        return false;
    }
}
function imageSize($file){
    if($file["size"] <= 100 * 1024 * 1024){   //? 100mbs
        return true;
    } else {
        return false;
    }
}