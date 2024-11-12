<?php
// $host = 'localhost';
// $dbname = 'authentication';
// $username = 'root';
// $password = '';

// $mysqli = new mysqli($host, $username, $password, $dbname);

// if ($mysqli->connect_error) {
//     die("Database connection failed: " . $mysqli->connect_error);
// }

class Database
{
    // protected $pdo = null; 
    public function connect()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=authentication";
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (Exception $e) {
            return null;
        }
    }


}
