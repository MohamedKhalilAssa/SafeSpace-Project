<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");
require_once(dirname(__DIR__) . "/Headers/connectToDb.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["Fullname"])){
        $name=strip_tags($_POST["Fullname"]);
        

        $sql = "UPDATE users SET FullName = :newName WHERE id = :id;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id',$_SESSION["userId"]);
        $statement->bindValue(':newName',$name);

        $statement->execute();

        $_SESSION["Fullname"] = $name;

         header("Location: ../ProfilePage.php?change=success");
        die();
    }  else{
        $_SESSION["ChangingErrors"]["name"] = "Input Missing!";
        header("Location: ../changeData.php");
        die();
    }

} else {
    header("Location: ../index.php");
    die();
}

