<?php

class DataBase {
    private $host = "localhost"; //TODO: Change the hostname in case the website is live 
    private $dbname = "safespace"; 
    private $user = "root"; 
    private $pass = ""; 

    //! Connecting to the DB
    protected function connect() {
        
        try{
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);

            //*setting up the fetching and error mode 
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch(PDOException $e){
            return "Connection Failed!" . $e->getMessage();
        }

    }
}