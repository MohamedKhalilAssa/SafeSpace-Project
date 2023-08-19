<?php 


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // ! Signing up Configurations
    if(isset($_POST["SignUp"])){
        try{
            require_once("SignupModel.php");
            require_once("SignupContr.php");

            //*Error Handling
            $Controller = new CheckInput();
            $errors = [];
            if($Controller->isInputMissing($_POST["Fullname"], $_POST["email"], $_POST["password1"],$_POST["password2"])){
                $errors["missingInput"] = "A Field is missing!";
            }
            if(!$Controller->validateEmail($_POST["email"])){ 
                $errors["validateEmail"] = "Invalid Email!";
            }
            if ($Controller->isEmailTaken($_POST["email"])){
                $errors["emailRegistered"] = "Email registered!";
            }
            if (!$Controller->typedPasswords($_POST["password1"],$_POST["password2"])) {
                $errors["ConfirmPassword"] = "Passwords don't match!";
            }
            if  (!$Controller->validatePassword($_POST["password1"])){
                $errors["validatePass"] = "Password should contain at least one capital and special char!";
            }
            require_once("../Headers/security_config.php");

            if ($errors){
                $_SESSION["SignupErrors"] = $errors;

                $_SESSION["SignupInfo"] = [
                    "Fullname" => strip_tags($_POST["Fullname"]),
                    "email" => $_POST["email"]
                ];

                header("Location: ../index.php");
                die();
            }

            //! Sign up 
            $Controller2 = new UseInput();

            $Controller2->SignUp($_POST["Fullname"], $_POST["email"], $_POST["password1"]);

            header("Location: ../index.php?signup=success");
            $_SESSION["signup"] = true;
            unset($_POST["SignUp"]);

            die();
        } catch(PDOException $e){
            return "SignUp Failed! Please try again!" . $e->getMessage();
            die();
        }
    }
    //! Signing in Config 
    else if (isset($_POST["SignIn"])){
        $email = $_POST["email"];
        $password = $_POST["password1"];
        try {
            require_once("SigninModel.php");
            require_once("SigninContr.php");
            
             //*Error Handling
             $SigninController = new CheckSigninInput();
             $errors = [];

             if($SigninController->isInputMissing($email,$password)){
                 $errors["missingInput"] = "A Field is missing!";
             } else {
                if (!$SigninController->isEmailTaken($email)){
                    $errors["emailRegistered"] = "Email not registered!";
                } else {
                    if (!$SigninController->passwordCheck($password, $email)){
                        $errors["passwordCheck"] = "Incorrect Password!";
                    }
                }
             }
             


            if ($errors){
                $_SESSION["SigninErrors"] = $errors;


                header("Location: ../index.php");
                die();
            }

                //? creating a session using User ID
            require_once("../Headers/security_config.php");

            $newSession = session_create_id();
            $result = $SigninController->getUser($email);

            $userId = $result["id"];
            $session_id = $newSession . "_" . $userId;
            session_id($session_id);
            session_regenerate_id(true);

            $_SESSION["timePassed"] = time();

            //? Setting the necessary Variables
            $_SESSION["userId"] =  $userId;
            $_SESSION["email"] = $result["Email"];
            $_SESSION["Fullname"] = $result["FullName"];
            $_SESSION["LoggedIn"] = true;


            header("Location: ../homePage.php?login=success");
            unset($_POST["SignIn"]);

            die();
        }  
        catch(PDOException $e){
            return "SignUp Failed! Please try again!" . $e->getMessage();
            die();
        }
    } 
}   
else {
    header("Location: ../index.php");
    die();
}
 
    
