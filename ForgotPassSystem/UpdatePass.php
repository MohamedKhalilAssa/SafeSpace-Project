<?php
require_once(dirname(__DIR__) . "/Headers/security_config.php");
require_once(dirname(__DIR__) . "/Headers/connectToDb.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pass1=$_POST["password1"];
    $pass2=$_POST["password2"];

    // ! bloc for error handling
    if(!empty($pass1) && !empty($pass2)){
        if(validatePassword($pass1) || validatePassword($pass2)){
            if(!typedPasswords( $pass1,  $pass2)){
                $_SESSION["createNewPassError"]["matching"] = "Passwords don't match!";
                header("Location: createNewPassPage.php?selector=". $selector . "&validator=". $validator ."&error=true");
                die();
            }
        } else{
            $_SESSION["createNewPassError"]["strength"] = "Password should contain at least one capital and special char!";
            header("Location:  createNewPassPage.php?selector=". $selector . "&validator=". $validator ."&error=true");
            die();
        }

    } else {
        $_SESSION["createNewPassError"]["empty"] = "A field is missing!";
        header("Location:  createNewPassPage.php?selector=". $selector . "&validator=". $validator ."&error=true");
        die();
    }

    //Interractions with DB

    $currently = date("U");

    $sql = "SELECT * FROM resetpassword WHERE selector = :selector AND ExpireDate >= :date";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':selector',$selector);
    $statement->bindValue(':date',$currently);
    $statement->execute();

    $result = $statement->fetch();

    if($result){    
        $tokenToBinary = hex2bin($validator);
        $Authentif = password_verify($tokenToBinary,$result["Token"]);

        if(!$Authentif){
            $_SESSION["createNewPassError"]["error"] = "You need to Re-Submit your request!";
            header("Location:  createNewPassPage.php?selector=". $selector . "&validator=". $validator ."&error=true");
            die();
        } else if ($Authentif){

            // Update The password after making sure the token is right and error handling
            $sql= "UPDATE users SET Passwords = :pass WHERE Email = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':email',$result["ResetEmail"]);
            $statement->bindValue(':pass',password_hash($pass1,PASSWORD_DEFAULT));

            $statement->execute();
            
            //now We Delete the token to avoid security breaches

            $sql= "DELETE FROM resetpassword WHERE ResetEmail = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':email',$result["ResetEmail"]);

            $statement->execute();

            header("Location:  ../index.php?password=updated");
            die();
        }

    } else {
        $_SESSION["createNewPassError"]["error"] = "You need to Re-Submit your request!";
        header("Location:  createNewPassPage.php?selector=". $selector . "&validator=". $validator ."&error=true");
        die();
    }

} else {
    header("Location: ../index.php");
    die();
}



function validatePassword(string $pass){
    $password =  strip_tags($pass);

    // Validate password strength
    $uppercase = preg_match('/[A-Z]/', $password);
    $lowercase = preg_match('/[a-z]/', $password);
    $specialChars = preg_match('/[^\w]/', $password);

    if(!$uppercase || !$lowercase || !$specialChars || strlen($password) < 6) {
        return false;
    }  
    else{
        return true;
    }
}

function typedPasswords(string $pass1, string $pass2){
    if ($pass1 === $pass2){
        return true;
    }
    else {
        return false;
    }
}