<?php
    class dbconnect{
        private $host;
        private $dbname;
        private $pass;
        private $user;
        function connect(){
            
            $this->host = "localhost";
            $this->dbname = "mobile_shop";
            $this->pass = "123";
            $this->user = "roxo";
            
            try{
                $dsn = "mysql:host=". $this->host ."; dbname=". $this->dbname;
                $pdo = new PDO($dsn, $this->user , $this->pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
    }
    $con = new dbconnect();
?>