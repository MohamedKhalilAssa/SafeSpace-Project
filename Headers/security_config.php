<?php



ini_set('session.use_only_cookies', 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
    "lifetime" => 60 * 60,
    "path" => "/",
    "httponly" => true,
    "secure" => true,
    "domain" => "localhost" //TODO: Change the hostname in case the website is live 
]);



if(!isset($_SESSION)){
    ob_start();
    session_start();
    if(!isset($_SESSION["countAttempts"]))
        $_SESSION["countAttempts"] = 0;
}


if (isset($_SESSION["userId"])){
    if (!isset($_SESSION["timePassed"])){
        regenerateSessionIn();
    }
    else {
        $interval = 59 * 60;
        if (time() - $_SESSION["timePassed"] >= $interval){
            regenerateSessionIn();
        }
    }
}
else {
    if (!isset($_SESSION["timePassed"])){
        regenerateSession();
    }
    else {
        $interval = 30 * 60;
        if (time() - $_SESSION["timePassed"] >= $interval){
            regenerateSession();
        }
    }
}

function regenerateSessionIn() {
    

    // $newSession = session_create_id();
    // $userId = $_SESSION["userId"];
    // $session_id = $newSession . "_" . $userId;
    // session_id($session_id);
    session_regenerate_id(true);

    $_SESSION["timePassed"] = time();
}
function regenerateSession() {
    session_regenerate_id(true);
    $_SESSION["timePassed"] = time();
}