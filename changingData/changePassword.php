<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");
require_once(dirname(__DIR__) . "/Headers/connectToDb.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["password1"]) && !empty($_POST["password2"]) && !empty($_POST["password3"])){
        $actualPass=$_POST["password1"];
        $pass1=strip_tags($_POST["password2"]);
        $pass2=$_POST["password3"];
        

        $sql = "SELECT * FROM users WHERE id = :id;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id',$_SESSION["userId"]);

        $statement->execute();

        $result = $statement->fetch();

        if($result){
            if(password_verify($actualPass,$result["Passwords"])){
                if($pass1 === $pass2 ){
                            // Validate password strength
                    $uppercase = preg_match('/[A-Z]/', $pass1);
                    $lowercase = preg_match('/[a-z]/', $pass1);
                    $specialChars = preg_match('/[^\w]/', $pass1);
        
                    if($uppercase && $lowercase && $specialChars && strlen($pass1) >= 6) {
                        $sql = "UPDATE users SET Passwords = :newPass WHERE id = :id;";
                        $statement = $pdo->prepare($sql);
                        $statement->bindValue(':id',$_SESSION["userId"]);
                        $statement->bindValue(':newPass',password_hash($pass2,PASSWORD_DEFAULT));

                        $statement->execute();

                        header("Location: ../ProfilePage.php?change=success");
                        die();
                    }  else{
                        $_SESSION["ChangingErrors"]["validatePass"] = "Password should contain at least one capital and special char!";
                        header("Location: ../changeData.php");
                        die();
                    }
                } else {
                    $_SESSION["ChangingErrors"]["match"] = "Passwords do not match!";
                    header("Location: ../changeData.php");
                    die();
                }
            } else {
                $_SESSION["ChangingErrors"]["Password"] = "Incorrect Password!";
                header("Location: ../changeData.php");
                die();
            }
        }
    } else {
        $_SESSION["ChangingErrors"]["input"] = "Input Missing!";
        header("Location: ../changeData.php");
        die();
    }

} else {
    header("Location: ../index.php");
    die();
}

