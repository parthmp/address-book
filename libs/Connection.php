<?php

    namespace Libs;    

    class Connection{
            
        protected $connection;
        
        protected function connect(){
            
            try{
                $this->connection = new \PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch(\PDOException $e){
                die();
            }
        }
        
        protected function disconnect(){
            $this->connection = null;
        }
        
        public function lastID(){
            return $this->connection->lastInsertId();
        }
        
        protected function query($string, $bind_ray = []){
            
            $this->connect();
            
            $query = $this->connection->prepare($string);
            
            if(!empty($bind_ray)){
                foreach($bind_ray as $key => &$val){
                    $query->bindParam($key, $val);
                }
            }
            
            $query->execute();
            
            return $query;
            
        }
        
    }