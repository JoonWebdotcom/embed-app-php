<?php
// This header is included in all main views
// App Bridge script is loaded in the main view, not here
?>

<header class="app-nav">
    <nav>
        <ul class="nav-menu">
            <li><a href="?page=dashboard" class="<?php echo ($page ?? '') === 'dashboard' ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="?page=products" class="<?php echo ($page ?? '') === 'products' ? 'active' : ''; ?>">Products</a></li>
            <li><a href="?page=settings" class="<?php echo ($page ?? '') === 'settings' ? 'active' : ''; ?>">Settings</a></li>
        </ul>
    </nav>
</header>