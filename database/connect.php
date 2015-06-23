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
        
        if ($_SERVER['SERVER_NAME'] == 'localhost'){
        $this->con = mysqli_connect("localhost", "root", "admin", "Inventaris");
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

        $token = rand(1, 1000);
        $token = mysqli_real_escape_string($this->con, $token);
        $query = "INSERT INTO Product (Name, Description, Token)
VALUES ('Wijn1', 'zoete wijn','$token')";
        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }

        $result = mysqli_query($this->con, "SELECT id FROM Product
WHERE token='$token'");

        while ($row = mysqli_fetch_array($result)) {
            $pid = $row['id'];
        }

        $query = "INSERT INTO Wine (PID, Type, Year, Year_finish, Year_start, Picture, Origin, Gift, Country, Region, Grape) 
VALUES ($pid, 'White', 2014, 2015, 2016, 'picture.jpg', 'Bordeaux', 'Nina', 'Frankrijk', 'Bordeaux', 'Pinot Noir')";
        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }
    }

    public function getpreviouswine($uid) {
        $result = mysqli_query($this->con, "SELECT * FROM Product p join Wine w on p.id = w.pid 
                                            where uid='$uid' order by p.id desc limit 1");
        $lastwine = array();
        while ($row = mysqli_fetch_array($result)) {
            $lastwine = array('name' => $row['Name'],
                'description' => $row['Description'],
                'datein' => $row['Date_in'],
                'token' => $row['Token'],
                'pid' => $row['PID'],
                'type' => $row['Type'],
                'year' => $row['Year'],
                'yearfinish' => $row['Year_finish'],
                'yearstart' => $row['Year_start'],
                'picture' => $row['Picture'],
                'origin' => $row['Origin'],
                'gift' => $row['Gift'],
                'region' => $row['Region'],
                'country' => $row['Country'],
                'grape' => $row['Grape'],
                'rating' => $row['Rating'],
                'cellar' => $row['Cellar'],
                'price' => $row['Price']);
        }
        return $lastwine;
    }

    public function getwine($uid, $token) {
        // echo "connect: token = $token";
        $wine = array();
        $result = mysqli_query($this->con, "SELECT * FROM Product p
                                            join Wine w on p.id = w.pid
                                            WHERE token='$token' and uid = '$uid'");

        while ($row = mysqli_fetch_array($result)) {
            $wine = array('name' => $row['Name'],
                'description' => $row['Description'],
                'datein' => $row['Date_in'],
                'token' => $row['Token'],
                'pid' => $row['PID'],
                'type' => $row['Type'],
                'year' => $row['Year'],
                'yearfinish' => $row['Year_finish'],
                'yearstart' => $row['Year_start'],
                'picture' => $row['Picture'],
                'origin' => $row['Origin'],
                'gift' => $row['Gift'],
                'region' => $row['Region'],
                'country' => $row['Country'],
                'grape' => $row['Grape'],
                'rating' => $row['Rating'],
                'cellar' => $row['Cellar'],
                'price' => $row['Price']
            );
        }
        return $wine;
    }

    public function removeWine($uid, $token) {
        //echo "connect: removing wine";
        $date = date('Y-m-d H:i:s');
        $result = mysqli_query($this->con, "UPDATE Product SET status=0, Date_out='$date'  WHERE token='$token' and uid='$uid'");
    }

    public function checkWine($uid,$token) {

        $exist = FALSE;
        $result = mysqli_query($this->con, "SELECT * FROM Product
                                            WHERE token='$token' and uid='$uid'");

        while ($row = mysqli_fetch_array($result)) {
            if ($row['Status'] == 1) {
                // echo "<p>connect: wijn bestaat</p>";
                $exist = TRUE;
            }
        }
        return $exist;
    }

    public function createWine($uid, $wine) {
        $token = $wine['token'];
        $token = mysqli_real_escape_string($this->con, $token);
        $name = $wine['name'];
        $name = mysqli_real_escape_string($this->con, $name);
        $description = $wine['description'];
        $description = mysqli_real_escape_string($this->con, $description);
        $uid = mysqli_real_escape_string($this->con, $uid);
        $query = "INSERT INTO Product (uid, Name, Description, Token)
VALUES ('$uid','$name', '$description','$token')";
        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }

        $result = mysqli_query($this->con, "SELECT id FROM Product
WHERE token='$token' and uid='$uid'");

        while ($row = mysqli_fetch_array($result)) {
            $pid = $row['id'];
        }
        $type = $wine['type'];
        $type = mysqli_real_escape_string($this->con, $type);
        $year = $wine['year'];
        $year = mysqli_real_escape_string($this->con, $year);
        $yearfinish = $wine['yearfinish'];
        $yearfinish = mysqli_real_escape_string($this->con, $yearfinish);
        $yearstart = $wine['yearstart'];
        $yearstart = mysqli_real_escape_string($this->con, $yearstart);
        $picture = $wine['picture'];
        $picture = mysqli_real_escape_string($this->con, $picture);
        $origin = $wine['origin'];
        $origin = mysqli_real_escape_string($this->con, $origin);
        $gift = $wine['gift'];
        $gift = mysqli_real_escape_string($this->con, $gift);
        $country = $wine['country'];
        $country = mysqli_real_escape_string($this->con, $country);
        $region = $wine['region'];
        $region = mysqli_real_escape_string($this->con, $region);
        $grape = $wine['grape'];
        $grape = mysqli_real_escape_string($this->con, $grape);
        $rating = $wine['rating'];
        $rating = mysqli_real_escape_string($this->con, $rating);
        $cellar = $wine['cellar'];
        $cellar = mysqli_real_escape_string($this->con, $cellar);
        $price = $wine['price'];
        $price = mysqli_real_escape_string($this->con, $price);
        $query = "INSERT INTO Wine (PID, Type, Year, Year_finish, Year_start, Picture, Origin, Gift, Country, Region, Grape, Rating, Price, Cellar) 
VALUES ($pid, '$type', '$year', '$yearfinish', '$yearstart', '$picture', '$origin', '$gift', '$country', '$region', '$grape','$rating','$price', '$cellar')";
        if (!mysqli_query($this->con, $query)) {
            die('Error: ' . mysqli_error($this->con));
        }
    }

    function getWines($uid,$param = NULL) {
        if ($param == NULL) {
            $query = "select token, status, name, type, count(1) as amount from Product p join Wine w on p.id = w.pid where status = 1 and uid = $uid  group by type, name";
        } else {
            $query = "select token, status, name, type, count(1) as amount from Product p join Wine w on p.id = w.pid where status = 1 and $param and uid = $uid group by type, name";
        }
        // echo $query;
        $result = mysqli_query($this->con, $query);
        $wines = array();

        while ($row = mysqli_fetch_array($result)) {
            $type = $row['type'];
            //TODO:notices verwijderen, denkt nu dat index niet bestaat, eerst op controleren
            if (!isset($wines[$type]) || !is_array($wines[$type])) {
                $wines[$type] = array();
            }
            array_push($wines[$type], array($row['name'], $row['amount'], $row['token']));
        }
        return $wines;
    }

    public function close_database() {
        mysqli_close($this->con);
    }

    public function editWine($uid,$wine) {
        $token = $wine['token'];
        $token = mysqli_real_escape_string($this->con, $token);
        $name = $wine['name'];
        $name = mysqli_real_escape_string($this->con, $name);
        $description = $wine['description'];
        $description = mysqli_real_escape_string($this->con, $description);
        $query = "UPDATE Product SET Name='$name',Description='$description' WHERE token = '$token' and uid ='$uid'";
        if (!mysqli_query($this->con, $query)) {
            die('Error update: ' . mysqli_error($this->con));
        }

        $result = mysqli_query($this->con, "SELECT id FROM Product
WHERE token='$token' and uid='$uid'");

        while ($row = mysqli_fetch_array($result)) {
            $pid = $row['id'];
        }
        $type = $wine['type'];
        $type = mysqli_real_escape_string($this->con, $type);
        $year = $wine['year'];
        $year = mysqli_real_escape_string($this->con, $year);
        $yearfinish = $wine['yearfinish'];
        $yearfinish = mysqli_real_escape_string($this->con, $yearfinish);
        $yearstart = $wine['yearstart'];
        $yearstart = mysqli_real_escape_string($this->con, $yearstart);
        $picture = $wine['picture'];
        $picture = mysqli_real_escape_string($this->con, $picture);
        $origin = $wine['origin'];
        $origin = mysqli_real_escape_string($this->con, $origin);
        $gift = $wine['gift'];
        $gift = mysqli_real_escape_string($this->con, $gift);
        $country = $wine['country'];
        $country = mysqli_real_escape_string($this->con, $country);
        $region = $wine['region'];
        $region = mysqli_real_escape_string($this->con, $region);
        $grape = $wine['grape'];
        $grape = mysqli_real_escape_string($this->con, $grape);
        $rating = $wine['rating'];
        $rating = mysqli_real_escape_string($this->con, $rating);
        $cellar = $wine['cellar'];
        $cellar = mysqli_real_escape_string($this->con, $cellar);
        $price = $wine['price'];
        $price = mysqli_real_escape_string($this->con, $price);
        $query = "UPDATE Wine SET Type='$type',Year='$year',Year_finish='$yearfinish',Year_start='$yearstart',Picture='$picture',Origin='$origin',Gift='$gift',Country='$country',Region='$region',Grape='$grape',Rating='$rating', Price='$price', Cellar='$cellar' WHERE pid='$pid'";
        if (!mysqli_query($this->con, $query)) {
            die('Error2: ' . mysqli_error($this->con));
        }
    }

    function existuser($user) {
        $result = mysqli_query($this->con, "SELECT id FROM Users
WHERE name='$user'");
        $uid = 0;
        while ($row = mysqli_fetch_array($result)) {
            $uid = $row['id'];
        }
        return $uid;
    }
    
    function getTotalWine(){
        
         $result = mysqli_query($this->con, "SELECT count(1) as total FROM Product where status = 1");

        while ($row = mysqli_fetch_array($result)) {
            $total = $row['total']; 
        }
        return $total;
        
    }

}

?>
