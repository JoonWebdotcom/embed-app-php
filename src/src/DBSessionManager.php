<?php
// lib/SessionManager.php
class SessionManager {
    private $db;
    
    public function __construct() {
        $this->db = (new Database())->connect();
    }
    
    public function startSession($site_domain, $token_data) {
        
        // Store in session
        $_SESSION['site_domain'] = $site_domain;
        $_SESSION['access_token'] = $token_data['access_token'];
        $_SESSION['scope'] = $token_data['scope'];
        $_SESSION['expires_at'] = time() + ($token_data['expires_in'] ?? 86400);
        
        // Store in database
        $this->storeSiteInDatabase($site_domain, $token_data);
      
        
        // Track installation
        $this->trackAnalytics($site_domain, 'app_installed');
    }
    public function isAuthenticated() {
        return isset($_SESSION['access_token']) && 
               isset($_SESSION['site_domain']) &&
               isset($_SESSION['expires_at']) &&
               $_SESSION['expires_at'] > time();
    }
    public function getAccessToken() {
        return $_SESSION['access_token'] ?? null;
    }
    public function getSiteDomain() {
        return $_SESSION['site_domain'] ?? null;
    }
    public function getUser() {
        return $_SESSION['user'] ?? null;
    }
    public function destroySession() {
        session_destroy();
    }
    public function isEmbeddedRequest() {
        return isset($_SERVER['HTTP_SEC_FETCH_DEST']) && 
               $_SERVER['HTTP_SEC_FETCH_DEST'] === 'iframe' ||
               (isset($_SERVER['HTTP_REFERER']) && 
                strpos($_SERVER['HTTP_REFERER'], 'joonweb.com') !== false);
    }
    
    
    private function storeSiteInDatabase($site_domain, $token_data) {
        $query = "INSERT INTO sites (site_domain, access_token, scope, installed_at, is_active) 
                  VALUES (:site_domain, :access_token, :scope, NOW(), 1)
                  ON DUPLICATE KEY UPDATE 
                  access_token = VALUES(access_token),
                  scope = VALUES(scope),
                  is_active = 1,
                  uninstalled_at = NULL,
                  updated_at = NOW()";
        
        $stmt = $this->db->prepare($query);
        $scope = is_array($token_data['scope']) ? implode(",", $token_data['scope']) : $token_data['scope'];
        $stmt->execute([
            ':site_domain' => $site_domain,
            ':access_token' => $token_data['access_token'],
            ':scope' => $scope
        ]);
    }
    
    public function trackAnalytics($site_domain, $event_type, $event_data = []) {
        $query = "INSERT INTO app_analytics (site_domain, event_type, event_data, user_agent, ip_address) 
                  VALUES (:site_domain, :event_type, :event_data, :user_agent, :ip_address)";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':site_domain' => $site_domain,
            ':event_type' => $event_type,
            ':event_data' => json_encode($event_data),
            ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? ''
        ]);
    }
    
    public function getSiteFromDatabase($site_domain) {
        $query = "SELECT * FROM sites WHERE site_domain = :site_domain AND is_active = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':site_domain' => $site_domain]);
        return $stmt->fetch();
    }
    
    public function saveAppData($site_domain, $key, $value) {
        $query = "INSERT INTO app_data (site_domain, data_key, data_value) 
                  VALUES (:site_domain, :data_key, :data_value)
                  ON DUPLICATE KEY UPDATE 
                  data_value = VALUES(data_value),
                  updated_at = NOW()";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':site_domain' => $site_domain,
            ':data_key' => $key,
            ':data_value' => json_encode($value)
        ]);
    }
    
    public function getAppData($site_domain, $key) {
        $query = "SELECT data_value FROM app_data WHERE site_domain = :site_domain AND data_key = :data_key";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':site_domain' => $site_domain,
            ':data_key' => $key
        ]);
        
        $result = $stmt->fetch();
        return $result ? json_decode($result['data_value'], true) : null;
    }
    
    // ... rest of existing methods
}
?>