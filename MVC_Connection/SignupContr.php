<?php
require_once("SignupModel.php");
require_once("../Headers/security_config.php");


class CheckInput extends CheckWithDatabase {
    public function isInputMissing(string $name,string $email,string $pass1 , string $pass2, ){
        if (empty($name) || empty($email) || empty($pass1) || empty($pass2)){
            return true;
        }
        else {
            return false;
        }
    }

    public function validateEmail(string $email){
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else {
            return false;
        }
    }

    public function isEmailTaken(string $email){
        if ($this->checkEmail($email)){
            return true;
        } else {
            return false;
        }
    }

        public function validatePassword(string $pass){
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

        public function typedPasswords(string $pass1, string $pass2){
            if ($pass1 === $pass2){
                return true;
            }
            else {
                return false;
            }
        }

        public function imageSize(array $file){
                if($file["size"] <= 1024 * 1024 * 20){   //?20mbs
                    return true;
                } else {
                    return false;
                }
        }
        public function isExtensionRight(array $file){

            $fileName= explode(".",$file["name"]);
            $extension = strtolower(end($fileName));
            $acceptedExt= array("jpg","jpeg","png");
            if (in_array($extension,$acceptedExt)){   //? check extension in accepted Array
                return true;
            } else {
                return false;
            }
        }   
        public function error(array $file){
            if ($file["error"] == 0){   //? check for errors
                return true;
            } else {
                return false;
            }
        }   
}

class UseInput extends QueryDatabase{
    public function SignUp(string $name,string $email,string $pass1){
        $this->setUser($name, $email, $pass1);
    } 
    public function uploadImage($file,$email){
        $tmpName = $file["tmp_name"];
        $name_arr = explode(".",$file["name"]);
        $extension = strtolower(end($name_arr));
        $newName = uniqid("",true) . "." . $extension;
        $uploadPath = dirname(__DIR__) . "/Uploads/" . $newName;

        $this->setImage($newName,$email);
        move_uploaded_file($tmpName,$uploadPath);
        
    }
}