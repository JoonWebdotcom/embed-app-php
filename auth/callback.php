<?php
require_once '../config/constants.php';
require_once '../src/JoonWebAPI.php';
require_once '../src/DBSessionManager.php';
require_once __DIR__ . '/../config/database.php';

$session = new SessionManager();
$api = new JoonWebAPI();

// Verify HMAC
function verifyHmac($params) {
    $hmac = $params['hmac'];
    unset($params['hmac']);
    
    ksort($params);
    $message = http_build_query($params);
    $calculated_hmac = hash_hmac('sha256', $message, JOONWEB_CLIENT_SECRET);
    
    return hash_equals($hmac, $calculated_hmac);
}

if (!verifyHmac($_GET)) {
    die('Invalid HMAC signature');
}

try {
    // Exchange code for access token
    $token_data = $api->exchangeCodeForToken($_GET['code'], $_GET['site']);
    
    // Start session AND store in database
    $session->startSession($_GET['site'], $token_data);
    
    // Get Site info and store it
    $api->setAccessToken($token_data['access_token']);
    $api->setSiteDomain($_GET['site']);
    $site_info = $api->getSite();
    
    // Save Site info to database
    $session->saveAppData($_GET['site'], 'site_info', $site_info['site']);
    
    // Track successful installation
    $session->trackAnalytics($_GET['site'], 'installation_completed', [
        'site_name' => $site_info['site']['name'],
        'email' => $site_info['site']['email']
    ]);

    // Redirect back to JoonWeb embed URL instead of your embedded.php
    $embed_url = buildJoonWebEmbedUrl($site_domain);
    header("Location: " . $embed_url);
    exit;
    
} catch (Exception $e) {
    error_log("OAuth callback error: " . $e->getMessage());
    
    // Track failed installation
    if (isset($_GET['site'])) {
        $session->trackAnalytics($_GET['site'], 'installation_failed', [
            'error' => $e->getMessage()
        ]);
    }
    
    die('Installation failed. Please try again.');
}

function buildJoonWebEmbedUrl($site_domain) {
    // This should be the URL where JoonWeb will embed your app
    // You need to get this from JoonWeb documentation or developer portal
    $base_url = "https://accounts.joonweb.com/site/";
    $base_url = $base_url . '?sitehash=' . ($_GET['site_hash'] ?? '') . '&apps&jambed-app';
  
    
    return $base_url;
}
?>