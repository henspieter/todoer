<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connect
 *
 * @author pieter
 */
class Connect {

    private $con;

    //put your code here
    public function __construct() {
        
        if ($_SERVER['SERVER_NAME'] == 'localhost' or true){
        $this->con = mysqli_connect("localhost", "root", "admin", "todoers");
        } else {
            $this->con = mysqli_connect("sql210.byethost8.com", "b8_15184816", "mahajara", "b8_15184816_inventaris");
        }
// Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    public function createdatabase() {


// Create database
        $sql = "CREATE DATABASE my_db";
        if (mysqli_query($this->con, $sql)) {
            echo "Database my_db created successfully";
        } else {
            echo "Error creating database: " . mysqli_error($this->con);
        }
    }

    public function create_dummy() {
        echo "<p>Database is creating dummy values</p>";

       // $token = rand(1, 1000);
       // $token = mysqli_real_escape_string($this->con, $token);
        $query = "INSERT INTO Tasks (Name, Description, Period, Mail, Visible)
VALUES ('bloemen', 'water geven',300,1, 1)";
        echo $query;
        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }
        
        echo "record is aangemaakt.";
    }

   
    public function close_database() {
        mysqli_close($this->con);
    }

   
}

?>
