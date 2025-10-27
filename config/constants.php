<?php
// Load environment variables
require_once __DIR__ . '/../src/EnvParser.php';

// Load the .env file - ADD THIS LINE
EnvParser::load(__DIR__ . '/../.env');

// App Configuration
define('APP_NAME', $_ENV['APP_NAME'] ?? 'My JoonWeb App');
define('APP_VERSION', $_ENV['APP_VERSION'] ?? '1.0.0');
define('APP_DEBUG', filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN));

// JoonWeb API Configuration
define('JOONWEB_CLIENT_ID', $_ENV['JOONWEB_CLIENT_ID'] ?? '');
define('JOONWEB_CLIENT_SECRET', $_ENV['JOONWEB_CLIENT_SECRET'] ?? '');
define('JOONWEB_REDIRECT_URI', $_ENV['JOONWEB_REDIRECT_URI'] ?? '');
define('JOONWEB_API_VERSION', $_ENV['JOONWEB_API_VERSION'] ?? '2024-01');
define('JOONWEB_API_SCOPES', $_ENV['JOONWEB_API_SCOPES'] ?? 'read_products');

// App Settings
define('PRODUCTS_PER_PAGE', $_ENV['PRODUCTS_PER_PAGE'] ?? 20);

// Validate required credentials
if (empty(JOONWEB_CLIENT_ID) || empty(JOONWEB_CLIENT_SECRET)) {
    die('Missing JoonWeb API credentials. Please check your .env file.');
}

// Error handling
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Enable error logging
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/../logs/error.log');
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Create logs directory if it doesn't exist
$log_dir = __DIR__ . '/../logs';
if (!is_dir($log_dir)) {
    mkdir($log_dir, 0755, true);
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}
?>