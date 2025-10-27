<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'YOUR_DB_NAME';
    private $username = 'YOUR_DB_USERNAME';
    private $password = 'YOUR DB PASSWORD';
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
