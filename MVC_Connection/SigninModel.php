<?php
require_once(dirname(__DIR__) . "/Headers/DB.php");
 


class CheckWithDatabase2 extends DataBase{
    protected function checkEmail(string $email){
        try{
            $sql = "SELECT * FROM users WHERE email LIKE :email;";
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
            $sql = "SELECT * FROM users WHERE email LIKE :email;";
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
    protected function onlineState(string $email){
        try{
            $sql = "UPDATE users SET LoginState = 'Online'  WHERE email LIKE :email;";
            $statement = $this->connect()->prepare($sql);
            $statement->bindParam(':email',$email);
    
            $statement->execute();

           
        } catch(PDOException $e){
            return "Check Query Failed!" . $e->getMessage();
            die();
        }

    }
    protected function offlineState(int $id){
        try{
            $sql = "UPDATE users SET LoginState = 'Offline'  WHERE id = :id;";
            $statement = $this->connect()->prepare($sql);
            $statement->bindParam(':id',$id);
    
            $statement->execute();

           
        } catch(PDOException $e){
            return "Check Query Failed!" . $e->getMessage();
            die();
        }

    }
}