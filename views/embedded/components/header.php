    <style>
/* 1. Main Layout: Sidebar and Content */
.app-container {
    display: flex;
    min-height: 100vh;
    position: relative;
}

/* 2. Sidebar Styling (Left Column) */
.sidebar {
    width: 30%; /* Adjust width as needed */
    background-color: #ffffff;
    padding-top: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
    position: sticky;
    height: 100vh;
    top:20px;
}

.logo {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    padding: 0 20px 20px;
    border-bottom: 1px solid #eee;
}

.nav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap:0px;
}

.nav-menu li.active > a{
    background-color: #edf5e1ff; /* Light blue background for active item */
    color: #779d44; /* Blue text color */
    border-left: 3px solid #82af46ff;
    font-weight: bold;
}

.nav-menu li a {
    display: flex;
    align-items: center;
    border-left: 3px solid transparent;
    padding: 10px 10px;
    text-decoration: none;
    color: #555;
    transition: background-color 0.2s;
    width:100%;
    align-items: center;
    display: flex;
    justify-content: flex-start;
    border-bottom: 1px solid #f0f0f0;
    gap:6px;
}

/* 3. Main Content Area (Right Column) */
.main-content {
    flex-grow: 1;
    padding: 0px 0px 0px 20px;
}

/* 4. Automation Section (The main focus area) */
.automation-section {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

.automation-section h2 {
    font-size: 28px;
    font-weight: 300; /* Lighter font weight for the title */
    color: #333;
}

.automation-section .highlight {
    color: #1890ff; /* Blue color for 'boost revenue' */
    font-weight: bold;
}

.automation-section ol {
    padding-left: 20px;
    margin: 20px 0;
}

.automation-section li a{
    color: #779d44;
    text-decoration: none;
}
.automation-section li a:hover {
    color: #ffffffff;
    text-decoration: none;
}

/* Authkey Input Styling */
.authkey-label {
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 8px;
}

.authkey-input-group {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.authkey-input {
    flex-grow: 1;
    padding: 10px 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    max-width: 400px; /* Constraint input width */
}

.save-button {
    padding: 10px 20px;
    background-color: #1890ff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}

.help-link {
    display: block;
    color: #1890ff;
    text-decoration: none;
    margin-top: 5px;
}

.explore-links {
    margin-top: 50px;
    font-size: 14px;
    color: #777;
}

/* (You would also style stat-grid, welcome-card, etc., here) */
</style>

  <div class="sidebar">
    <div class="logo">Sample App</div>
      <nav>
        <ul class="nav-menu">
            <li class="<?php echo ($page ?? '') === 'dashboard' ? 'active' : ''; ?>"><a href="?page=dashboard" ><svg fill="#779d44" height="28px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#779d44"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M27 18.039L16 9.501 5 18.039V14.56l11-8.54 11 8.538v3.481zm-2.75-.31v8.251h-5.5v-5.5h-5.5v5.5h-5.5v-8.25L16 11.543l8.25 6.186z"></path></g></svg> Dashboard/a></li>
            
        
        </ul>
    </nav>

</div>
