<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");
require_once(dirname(__DIR__) . "/Headers/connectToDb.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_FILES["Image"])){
        $image= $_FILES["Image"];
        

        
        $sql = "SELECT * FROM users WHERE id = :id;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id',$_SESSION["userId"]);

        $statement->execute();

        $result = $statement->fetch();

        if($result){
            if($result["imageName"] !== "Default.png"){
                unlink(dirname(__DIR__) . "/Uploads/" . $result["imageName"]);
            }

            $fileName= explode(".",$image["name"]);
            $extension = strtolower(end($fileName));
            $acceptedExt= array("jpg","jpeg","png");
            if (in_array($extension,$acceptedExt)){   //? check extension in accepted Array
                if ($image["error"] == 0){   //? check for errors
                    if($image["size"] <= 1024 * 1024 * 20){   //?20mbs
                        $tmpName = $image["tmp_name"];
                        $newName = uniqid("",true) . "." . $extension;
                        $uploadPath = dirname(__DIR__) . "/Uploads/" . $newName;
                        move_uploaded_file($tmpName,$uploadPath);

                        $sql = "UPDATE users SET imageName = :new WHERE id = :id;";
                        $statement = $pdo->prepare($sql);
                        $statement->bindValue(':id',$_SESSION["userId"]);
                        $statement->bindValue(':new',$newName);

                        $statement->execute();

                        $_SESSION["imageName"] = $newName;
                        header("Location: ../ProfilePage.php?change=success");
                        die();
                    } else {
                        $_SESSION["ImageErrors"]["size"] = "Image should be below 20mbs!";
                        header("Location: ../changeData.php");
                        die();
                    }
                } else{
                    $_SESSION["ImageErrors"]["error"] = "An Error happened while Uploading!";
                    header("Location: ../changeData.php");
                    die();
                }
                
            } else {
                $_SESSION["ImageErrors"]["extension"] = "Image should be PNG, JPEG or JPG!";
                header("Location: ../changeData.php");
                die();
            }
        }
    }  else{
        $_SESSION["ImageErrors"]["Images"] = "Image Missing!";
        header("Location: ../changeData.php");
        die();
    }

} else {
    header("Location: ../index.php");
    die();
}

