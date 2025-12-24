<?php
$page_title = 'Get Started';
// Set CRF Token:
$_SESSION['crfToken'] = bin2hex(random_bytes(32));
ob_start();
?>
<style>
    /* Modern Get Started Page Styles */
    .main-content {
        padding: 0;
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
    }
    .automation-section li a{
        color: #fff !important;
    }

    .automation-section {
        background: white;
        border-radius: 6px;
        padding: 25px;
        width:95%;
        border: 1px solid #e2e8f0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

  

    .automation-section h2 {
        color: #42b764;
        font-size: 32px;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 26px;
        letter-spacing: -0.5px;
        background: #42b764;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .automation-section h2 .highlight {
        background: #42b764;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .automation-section h2 .highlight::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #42b764, #91cca2ff);
        border-radius: 2px;
    }

    .steps-container {
        background: #fefffdff;
        border-radius: 20px;
        padding: 18px 25px;
        margin-bottom: 20px;
        border: 1px dashed #405446ff;
        position: relative;
    }

    .steps-container::before {
        content: 'Quick Start Guide';
        position: absolute;
        top: -12px;
        left: 24px;
        background: white;
        padding: 4px 16px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        color: #5b615dff;
        border: 2px solid #5b615dff;
        letter-spacing: 0.5px;
    }

    .steps-list {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
    }

    .steps-list li {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 24px;
        border-bottom: 1px solid #e2e8f0;
        position: relative;
    }

    .steps-list li:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }


    .step-content {
        flex: 1;
    }

    .step-content h3 {
        color: #3f3f3fff;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .step-content p {
        color: #727869ff;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .step-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background:  rgba(42, 159, 83, 1);
        text-decoration: none;
        padding: 8px 20px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        
        transition: all 0.3s ease;
    }

    .step-link:hover {
        background: rgba(44, 139, 77, 1);
    }

    .step-link svg {
        width: 16px;
        height: 16px;
    }

    .api-section {
        margin-top: 32px;
    }

    .authkey-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4a4a4aff;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
        text-align: left;
    }

 

    .authkey-input-group {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
        position: relative;
    }

    .authkey-input {
        flex: 1;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        font-size: 15px;
        color: #1e293b;
        background: #f8fafc;
        transition: all 0.3s ease;
    }

    .authkey-input:focus {
        outline: none;
        border-color: #42b764;
        background: white;
    }

    .authkey-input::placeholder {
        color: #94a3b8;
    }


    .input-icon {
        position: absolute;
        left: 20px;
        top: 55%;
        transform: translateY(-55%);
        color: #939b9f;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .authkey-input {
        padding-left: 48px;
    }

    .save-button {
        background: #42b764;
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .save-button:hover:not(:disabled) {
        background: #779d44
        transform: translateY(-2px);
    }

    .save-button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .save-button .spinner {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .save-button.saving .spinner {
        display: block;
    }

    .save-button.saving .button-text {
        display: none;
    }

    .help-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #779d44;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        margin-top: 16px;
        padding: 10px 16px;
        border-radius: 10px;
        background: #ecfdf5;
        border: 1px solid #a8c681ff;
        transition: all 0.3s ease;
    }

    .help-link:hover {
        background: #d1fae5;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
    }

    .help-link svg {
        width: 16px;
        height: 16px;
    }

    .api-info-box {
        background: linear-gradient(135deg, #f0f9ff 0%, #ecfdf5 100%);
        border-radius: 16px;
        padding: 20px;
        margin-top: 24px;
        border-left: 4px solid #779d44;
        text-align: left;
    }

    .api-info-box h4 {
        color: #779d44;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .api-info-box p {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
    }

    .success-message {
        display: none;
        background: linear-gradient(135deg, #779d44 0%, #9bc06aff 100%);
        color: white;
        padding: 16px 24px;
        border-radius: 16px;
        margin-top: 24px;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-message svg {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    /* Responsive Design */
    @media (max-width: 640px) {
        .automation-section {
            padding: 32px 24px;
            width: 95%;
        }

        .automation-section h2 {
            font-size: 24px;
        }

        .steps-container {
            padding: 24px 20px;
        }

        .authkey-input-group {
            flex-direction: column;
        }

        .save-button {
            width: 100%;
            justify-content: center;
        }
    }

    /* Feature Highlights */
    .feature-highlights {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 40px;
        padding-top: 40px;
        border-top: 1px solid #e2e8f0;
    }

    .feature-card {
        background: linear-gradient(135deg, #f8fafc 0%, #cfe1b6ff 100%);
        padding: 20px;
        border-radius: 16px;
        text-align: center;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.1);
        border-color: #a7f3d0;
    }

    .feature-card svg {
        width: 40px;
        height: 40px;
        color: #779d44;
        margin-bottom: 16px;
    }

    .feature-card h4 {
        color: #779d44;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .feature-card p {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
    }
</style>

<div class="main-content">
    <div class="automation-section">
        <h2>Welcome to Sample JoonWeb App</h2>
        
        <div class="steps-container">
        
        </div>


      
    </div>
</div>

<?php
$content = ob_get_clean();

?>
