<?php
$host = "localhost"; //TODO: Change the hostname in case the website is live 
$dbname = "safespace";
$name = "root";
$pass = "";
$dsn = "mysql:host=$host;dbname=$dbname";

$pdo = new PDO($dsn,$name,$pass);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    