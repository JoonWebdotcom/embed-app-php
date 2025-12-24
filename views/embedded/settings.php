<?php
$page_title = 'Settings';
ob_start();
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table tr {
        border-bottom: 1px solid #e5e7eb;
    }

    table th, table td {
        text-align: left;
        padding: 12px 8px;
        font-size: 15px;
    }

    table th {
        background: #f3f4f6;
        color: #374151;
        font-weight: 600;
    }

    table td {
        color: #1f2937;
    }

    tr:hover td {
        background: #f9fafb;
    }

    .empty-state {
        text-align: center;
        padding: 20px;
        color: #6b7280;
    }
    .main-content{
        padding: 5px 18px;
        width: 100%;
        margin: 0;
        text-align: left;
    }
    .save-button{
        background-color: #46b660;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .save-button:hover{
        background-color: #3ea153;
    }
</style>

<div class="main-content">
    <div class="stats-grid">
        <div class="stat-card">
            <h3 style="text-align:left;">Settings</h3>
            
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';

?>
