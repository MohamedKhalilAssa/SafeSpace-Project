<?php
if(isset($_SESSION["LoggedIn"])){
    if($_SESSION["LoggedIn"]){
        header("Location: ProfilePage.php?loginState=Online");
        die();
    }    
} 