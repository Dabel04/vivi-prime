<?php
// backend/config/Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'vivi_prime';
    private $username = 'dabel';
    private $password = 'go uni1234';
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo json_encode(["error" => "Connection Error: " . $e->getMessage()]);
            exit;
        }

        return $this->conn;
    }
}