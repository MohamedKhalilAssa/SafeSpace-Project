<?php
require_once("../Headers/DBC.php");


class CheckWithDatabase extends DataBase{
    
    protected function checkEmail(string $email){
        try{
            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $this->connect()->prepare($sql);
            $statement->bindParam(':email',$email);
    
            $statement->execute();

            $result = $statement->fetch();

            return $result;
        } catch(PDOException $e){
            return "Check Query Failed!" . $e->getMessage();
            die();
        }

    }
}

class QueryDatabase extends DataBase{
    
    protected function setUser(string $name,string $email,string $pass1){
        try{
            //? Preparing the Query 
            $sql = "INSERT INTO users(Email, FullName, Passwords) VALUES (:email, :FullName, :pass)";
            $statement = $this->connect()->prepare($sql);

            //? Validating / Hashing the input
            $newName = strip_tags($name);
            $newPass = strip_tags($pass1);
            $newPass = password_hash($newPass, PASSWORD_DEFAULT,['cost' => 12]);

            $statement->bindParam(':email',$email);
            $statement->bindParam(':FullName',$newName);
            $statement->bindParam(':pass',$newPass);
    
            $statement->execute();

            $statement = null;
        } catch(PDOException $e){
            return "Insert Query Failed!" . $e->getMessage();
            die();
        }

    }
}