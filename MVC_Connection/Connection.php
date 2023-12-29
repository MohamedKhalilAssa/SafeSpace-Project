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
            $image_errors =[];
            $imageFound = false;
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

            // ? image error handling 
            if(isset($_FILES["Image"])){
                $file = $_FILES["Image"];
                
                if($file["size"] > 10){
                    $imageFound = true;
                    if (!$Controller->isExtensionRight($file)){
                        $image_errors["extension"] = "File should be PNG, JPEG, or JPG!";
                        
                    } else {
                        if(!$Controller->error($file)){
                            $image_errors["error"] = "An error happened while Uploading!";
                        } else {
                            if (!$Controller->imageSize($file)){
                                $image_errors["Size"] = "Size should be below 20mbs";
                            }
                        }
                    }
                }
            }
            
                
            require_once("../Headers/security_config.php");

            if ($errors){
                $_SESSION["SignupErrors"] = $errors;

                $_SESSION["SignupInfo"] = [
                    "Fullname" => strip_tags($_POST["Fullname"]),
                    "email" => $_POST["email"]
                ];

                header("Location: ../index.php");
                if(empty($image_errors) ){
                    die();
                }
              
            }
            if($image_errors){
                $_SESSION["ImageErrors"] = $image_errors;

                header("Location:../index.php?imageUpload=failed");
                die();
            }

            //! Sign up 
            $Controller2 = new UseInput();

            $Controller2->SignUp($_POST["Fullname"], $_POST["email"], $_POST["password1"]);
            
            if($imageFound){
                $Controller2->uploadImage($_FILES["Image"],$_POST["email"]);
            }
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
                        $_SESSION["countAttempts"]+=1;
                    }
                }
             }
             


            if ($errors){
                if($_SESSION["countAttempts"] == 3){                    
                    header("Location: ../index.php?attempts=3");
                    die();
                }
                $_SESSION["SigninErrors"] = $errors;
                
                header("Location: ../index.php");
                die();
            }

                //? Session starting File
            require_once(dirname(__DIR__) . "/Headers/security_config.php");

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
            setcookie("user_id",  $_SESSION["userId"], 0, "/");
            $_SESSION["Fullname"] = $result["FullName"];
            $_SESSION["imageName"] = $result["imageName"];
            $_SESSION["LoggedIn"] = true;
            
            if(isset($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"] ){
                $SigninController->Online($_SESSION["email"]);
            } 

            header("Location: ../ProfilePage.php?login=success&id=" . $_SESSION["userId"]);
            unset($_POST["SignIn"]);

            die();
        }  
        catch(PDOException $e){
            return "SignIn Failed! Please try again!" . $e->getMessage();
            die();
        }
    } 
}   
else {
    header("Location: ../index.php");
    die();
}
 
    
