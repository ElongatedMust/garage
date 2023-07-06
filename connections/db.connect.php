<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'projectgarage';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}

/*// Usage
$database = new Database();
$pdo = $database->getPDO();

// Use $pdo to perform database operations

$database->closeConnection();*/


