<?php



// function inputFields() {
//     if(isset($_SESSION["SignupInfo"]["Fullname"]) && !empty($_SESSION["SignupInfo"]["Fullname"])) {
//         $fullname = $_SESSION["SignupInfo"]["Fullname"];

//         echo "<div class='input-field signup-fields'>
//                      <img class='icons' src = 'assets/user-icon.svg' alt='User Icon'>
//                     <input id='name-input' class='input' type='text' name= 'Fullname' maxlength='50' placeholder='Fullname' value='$fullname' >
//               </div>";
//         unset($_SESSION["SignupInfo"]["Fullname"]);
//     }else {
//         echo "<div class='input-field signup-fields'>
//                      <img class='icons' src = 'assets/user-icon.svg' alt='User Icon'>
//                     <input id='name-input' class='input' type='text' name= 'Fullname' maxlength='50' placeholder='Fullname' >
//              </div>";
//         unset($_SESSION["SignupInfo"]["Fullname"]);
//     }
//     if (isset($_SESSION["SignupInfo"]["email"]) && !isset($_SESSION["SignupErrors"]["emailRegistered"]) && !isset($_SESSION["SignupErrors"]["validateEmail"])){
//         $email = $_SESSION["SignupInfo"]["email"];
//         echo "<div class='input-field'>
//                      <img class='icons' src = 'assets/email.svg' alt='User Icon'>
//                  <input class='input' type='email' name= 'email'  placeholder='Email' value='$email' required>
//                 </div>";
//         unset($_SESSION["SignupInfo"]["email"]);
//     }
//     else {
//         echo "<div class='input-field'>
//                      <img class='icons' src = 'assets/email.svg' alt='User Icon'>
//                  <input class='input' type='email' name= 'email'  placeholder='Email' required>
//                 </div>";
//         unset($_SESSION["SignupInfo"]["email"]);
//     }              
// }

function errors_view () {
    if(isset($_SESSION["SignupErrors"])){
        $errors = $_SESSION["SignupErrors"];
        unset($_SESSION["SignupErrors"]);

        foreach($errors as $error){
            echo "<p class='SignupError'>$error</p>";
        }
    }
    if (isset($_GET["signup"]) && $_GET["signup"] == "success" && isset($_SESSION["signup"])){
        echo "<p class='success'>Sign Up successful!</p>";
        unset($_SESSION["signup"]);
    }
}
