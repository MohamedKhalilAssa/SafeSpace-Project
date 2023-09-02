<?php

function imageErrors(){
    if(isset($_SESSION["ImageErrors"])){
        $imageErrors = $_SESSION["ImageErrors"];
        unset($_SESSION["ImageErrors"]);
    
        foreach($imageErrors as $error){
            echo "<p class='text-center SignupError'>$error</p>";
        }
    }
}
