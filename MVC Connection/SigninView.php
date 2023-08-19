<?php

function SigninErrors_view () {
    if(isset($_SESSION["SigninErrors"])){
        $errors = $_SESSION["SigninErrors"];
        unset($_SESSION["SigninErrors"]);

        foreach($errors as $error){
            echo "<p class='SignupError'>$error</p>";
        }
    }
}