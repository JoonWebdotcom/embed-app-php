<?php
// Get data for dashboard
try {
    $products = $api->getProducts(1, 5);
    $orders = [];
} catch (Exception $e) {
    $products = ['products' => []];
    $orders = ['orders' => []];
}

$page_title = 'Dashboard';
ob_start();
?>
    <div class="dashboard">
        <div class="welcome-card">
            <h1>Welcome to <?php echo APP_NAME; ?></h1>
            <p>Connected to: <?php echo htmlspecialchars($site['site']['name']); ?></p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Recent Products</h3>
                <div class="stat-number"><?php echo count($products['products'] ?? []); ?></div>
                <a href="?page=products">View All Products</a>
            </div>
            
            <div class="stat-card">
                <h3>Open Orders</h3>
                <div class="stat-number"><?php echo count($orders['orders'] ?? []); ?></div>
                <a href="?page=orders">View All Orders</a>
            </div>
        </div>
        
        <!-- Rest of your dashboard content -->
    </div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>