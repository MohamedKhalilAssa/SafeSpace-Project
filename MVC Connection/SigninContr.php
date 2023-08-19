<?php

require_once("SigninModel.php");
require_once("../Headers/security_config.php");



class CheckSigninInput extends CheckWithDatabase2 {

    public function getUser(string $email){
        $result = $this->checkEmail($email);
        if($result){
            return $result;
        }
    }
    public function isInputMissing(string $email,string $pass1 ){
        if (empty($email) || empty($pass1)){
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

    public function passwordCheck(string $pass,string $email) {
        $newPass = strip_tags($pass);

        if(password_verify($newPass,$this->passwordInDB($email))){
            return true;
        } else {
            return false;
        }

    }
}