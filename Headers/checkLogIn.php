<?php

if(isset($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"] && isset($_GET["login"]) && $_GET["login"] === "success"){
     echo "Welcome here Brother";
} else {
    header("Location: index.php");
    die();
}