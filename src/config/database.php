<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'u636894263_jambed';
    private $username = 'u636894263_jambed';
    private $password = '7=fP/b4PrZ';
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ✅ fixed
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            return false;
        }
        return $this->conn;
    }
}
?>
