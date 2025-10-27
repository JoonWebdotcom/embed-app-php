<?php
class JoonWebAPI {
    private $access_token;
    private $site_domain;
    
    public function setAccessToken($token) {
        $this->access_token = $token;
    }
    
    public function setSiteDomain($domain) {
        $this->site_domain = $domain;
    }
    
    public function exchangeCodeForToken($code, $site_domain) {
        $url = "https://{$site_domain}/api/admin/26.0/oauth/access_token";
        
        $payload = [
            'client_id' => JOONWEB_CLIENT_ID,
            'client_secret' => JOONWEB_CLIENT_SECRET,
            'code' => $code
        ];
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'User-Agent: ' . APP_NAME . '/v' . APP_VERSION
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => true
        ]);
     
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code === 200) {
            return json_decode($response, true);
        }
        
        throw new Exception("Token exchange failed: HTTP {$http_code}");
    }
    
    public function api($endpoint, $method = 'GET', $data = []) {
        if (!$this->access_token || !$this->site_domain) {
            throw new Exception("API client not properly configured");
        }
        
        $url = "https://{$this->site_domain}/api/admin/" . JOONWEB_API_VERSION . $endpoint;
        
        $headers = [
            'Content-Type: application/json',
            'X-JoonWeb-Access-Token: ' . $this->access_token,
            'X-JoonWeb-API-Version: ' . APP_VERSION,
            'User-Agent: ' . APP_NAME . '/v' . APP_VERSION
        ];
        
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => true
        ]);
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $result = json_decode($response, true);

        if ($http_code >= 400) {
            echo $url;
            throw new Exception("API error {$http_code}: " . ($result['error'] ?? 'Unknown error'));
        }
        
        return $result;
    }
    
    // Convenience methods
    public function getSite() {
        return $this->api('/site.json');
    }
    
    public function getProducts($page = 1, $limit = null) {
        $limit = $limit ?: PRODUCTS_PER_PAGE;
        return $this->api("/products.json");
    }
    
    public function getOrders($status = 'any', $limit = 50) {
        return $this->api("/orders.json?status={$status}&limit={$limit}");
    }
    
    public function getCustomers($limit = 50) {
        return $this->api("/customers.json?limit={$limit}");
    }
    
    public function createProduct($product_data) {
        return $this->api('/products.json', 'POST', ['product' => $product_data]);
    }
    
    public function updateProduct($product_id, $product_data) {
        return $this->api("/products/{$product_id}.json", 'PUT', ['product' => $product_data]);
    }
}
?>