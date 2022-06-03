<?php

//made by Kervin Zoren Bonaobra 

    class dbModel{
        private $host = 'localhost';
        private $db_name = 'dios_db';
        private $username = 'root';
        private $password = '';
        private $conn;

        //DB Connect
        protected function connect(){

            $this->conn = null;

            try{
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;

        }
    }
    
?>