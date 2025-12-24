<?php
namespace JoonWeb\EmbedApp;

class Fun extends SessionManager {
    
    public function __construct() {
        parent::__construct();

        if (!$this->db) {
            throw new \Exception("Database is not initialized in SessionManager.");
        }
        
        // Enable foreign keys for SQLite
        if (!$this->isMySQL) {
            $this->db->exec("PRAGMA foreign_keys = ON");
        }

    }
}

?>
