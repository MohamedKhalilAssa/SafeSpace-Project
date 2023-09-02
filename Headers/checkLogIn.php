<?php


if(!isset($_SESSION["LoggedIn"]) || !$_SESSION["LoggedIn"]){
    
    
    try{
        require_once(dirname(__DIR__) . "/MVC_Connection/SigninContr.php");

        $newContr = new CheckSigninInput();

        if(isset($_COOKIE["user_id"])){
            $newContr->Offline($_COOKIE["user_id"]);
            unset($_COOKIE['user_id']); 
            setcookie("user_id", "", time() - 3600, "/");
        }
        
        header("Location: index.php?loginState=Offline");
        die();
    } catch(PDOException $e){
        return "Check Query Failed!" . $e->getMessage();
        die();
    }
    
} 