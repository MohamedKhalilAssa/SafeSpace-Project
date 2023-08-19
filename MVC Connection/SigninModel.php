<?php
require_once("../Headers/DBC.php");


class CheckWithDatabase2 extends DataBase{
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

    protected function passwordInDB(string $email){
        try{
            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $this->connect()->prepare($sql);
            $statement->bindParam(':email',$email);
    
            $statement->execute();

            $result = $statement->fetch();

            $HashedPass = $result["Passwords"];

            return $HashedPass;
        } catch(PDOException $e){
            return "Check Query Failed!" . $e->getMessage();
            die();
        }

    }
}