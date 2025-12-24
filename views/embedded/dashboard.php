<?php
// Get data for dashboard

$page_title = 'Dashboard';
ob_start();
?>

<style>
    .dashboard {
        padding: 5px 18px;
        width: 100%;
        margin: 0;
    }

    .welcome-banner {
        background: linear-gradient(135deg, #91ba5bff 0%, #337318ff 100%);
        color: white;
        padding: 30px;
        border-radius: 6px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .welcome-content h1 {
        margin: 0 0 10px 0;
        font-size: 28px;
        font-weight: 700;
    }

    .welcome-content p {
        margin: 0 0 20px 0;
        opacity: 0.9;
        font-size: 16px;
    }

    .setup-progress {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .progress-step {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.2);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        border:1px solid rgba(255,255,255,0.4);
    }

    .step-complete {
        background: rgba(177, 229, 196, 0.3);
    }

    .step-pending {
        background: rgba(251, 191, 36, 0.3);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        padding: 14px;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }

    .stat-card.featured {
        background: linear-gradient(135deg, #779d44, #1a8325ff);
        color: white;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-card.featured .stat-icon {
        background: rgba(255, 255, 255, 0.2);
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: #1f2937;
        text-align: center;
    }

    .stat-card.featured .stat-number {
        color: white;
    }

    .stat-label {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
        text-align: center;
    }

    .stat-card.featured .stat-label {
        color: rgba(255, 255, 255, 0.9);
    }

    .stat-trend {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        margin-top: 8px;
    }

    .trend-up {
        background: #dcfce7;
        color: #166534;
    }

    .trend-down {
        background: #fee2e2;
        color: #dc2626;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 30px;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    .dashboard-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        color: #1f2937;
        font-size: 18px;
        font-weight: 600;
    }

    .view-all {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }

    .view-all:hover {
        text-decoration: underline;
    }

    .card-content {
        padding: 0;
    }

    .automation-list, .event-list {
        padding: 0;
    }

    .automation-item, .event-item {
        display: flex;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #f3f4f6;
        transition: background-color 0.2s;
    }

    .automation-item:hover, .event-item:hover {
        background: #f9fafb;
    }

    .automation-item:last-child, .event-item:last-child {
        border-bottom: none;
    }

    .automation-icon, .event-icon {
        width: 40px;
        height: 40px;
        background: #eff6ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: #3b82f6;
    }

    .event-icon {
        background: #f0fdf4;
        color: #16a34a;
    }

    .automation-info, .event-info {
        flex: 1;
    }

    .automation-name, .event-name {
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 4px 0;
    }

    .automation-meta, .event-meta {
        font-size: 13px;
        color: #6b7280;
    }

    .automation-status, .event-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }

    .status-draft {
        background: #fef3c7;
        color: #92400e;
    }

    .status-paused {
        background: #f3f4f6;
        color: #6b7280;
    }

    .status-success {
        background: #dcfce7;
        color: #166534;
    }

    .status-processing {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-failed {
        background: #fee2e2;
        color: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .empty-state svg {
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-top: 30px;
    }

    .action-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        color: inherit;
    }

    .action-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        background: #eff6ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #3b82f6;
    }

    .action-title {
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 8px 0;
    }

    .action-description {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }

    .api-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        margin-left: 10px;
    }

    .api-connected {
        background: #dcfce7;
        color: #166534;
    }

    .api-disconnected {
        background: #fee2e2;
        color: #dc2626;
    }

    .event-time {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
    }
</style>

<div class="dashboard">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-content">
            <h1>Welcome to Sample App</h1>
            <p>Develop your sample app by editing inside views/</p>
        </div>
    </div>

    <!-- Key Stats Grid -->
    <div class="stats-grid">
        <!-- Total Automations -->
        <div class="stat-card featured">
            <div class="stat-number">0</div>
            <div class="stat-label">Total Products</div>

        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Recent Automations -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Your Sample Data</h3>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="card-content">
                <div class="automation-list">
                    
                </div>
            </div>
        </div>

        <!-- Recent Events -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Recent Webhooks Calls</h3>
            </div>
            <div class="card-content">
                <div class="event-list">
                        <div class="empty-state">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                            </svg>
                            <p>No events triggered yet</p>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$content = ob_get_clean();
include 'layout.php';

?>
