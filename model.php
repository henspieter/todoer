<?php

require_once 'database/connect.php';

class Model {

    private $connection;
 

    private $message;


    public function __construct() {

        $this->connection = new Connect();
       
    }
    
    public function create_dummy () {
        $this->connection->create_dummy();
    }

  

    public function createdatabase() {
        $this->connection->createdatabase();
    }

    
    public function close_database() {
        $this->connection->close_database();
    }

   

}