<?php

class Database {
    private $host = "localhost";
    private $user = "admin";
    private $pass = "123456";
    private $dbname = "bookstore";
    private $conn = null;

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->conn = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
        return $this->conn; // Trả về kết nối
    }

    public function closeConnection() {
        $this->conn = null; // Đóng kết nối bằng cách gán null
    }
}
?>
