<?php
$currentPage = isset($activePage) ? $activePage : '';
?>

<li class="sidebar-menu-item <?php echo $currentPage === 'hrm-dashboard' ? 'active' : ''; ?>">
    <a href="index.php">
        <span class="material-symbols-rounded">dashboard</span>
        <span>Dashboard</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'employees' ? 'active' : ''; ?>">
    <a href="employees.php">
        <span class="material-symbols-rounded">groups</span>
        <span>Employees</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'attendance' ? 'active' : ''; ?>">
    <a href="attendance.php">
        <span class="material-symbols-rounded">event_available</span>
        <span>Attendance</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'leave-management' ? 'active' : ''; ?>">
    <a href="leave_management.php">
        <span class="material-symbols-rounded">beach_access</span>
        <span>Leave Management</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'training-development' ? 'active' : ''; ?>">
    <a href="training_development.php">
        <span class="material-symbols-rounded">school</span>
        <span>Training & Development</span>
    </a>
</li>

<li class="sidebar-menu-item has-submenu <?php echo in_array($currentPage, ['recruitment-dashboard', 'recruitment-vacancies', 'recruitment-applicants', 'recruitment-interviews', 'recruitment-selected']) ? 'active' : ''; ?>">
    <a href="#recruitment-selection" class="submenu-toggle" aria-expanded="false">
        <span class="material-symbols-rounded">person_search</span>
        <span>Recruitment & Selection</span>
        <span class="material-symbols-rounded submenu-arrow">expand_less</span>
    </a>
    <ul class="sidebar-submenu">
        <li class="<?php echo $currentPage === 'recruitment-dashboard' ? 'active' : ''; ?>"><a href="recruitment_dashboard.php">Dashboard</a></li>
        <li class="<?php echo $currentPage === 'recruitment-vacancies' ? 'active' : ''; ?>"><a href="recruitment_vacancies.php">Job Vacancies</a></li>
        <li class="<?php echo $currentPage === 'recruitment-applicants' ? 'active' : ''; ?>"><a href="recruitment_applicants.php">Applicants</a></li>
        <li class="<?php echo $currentPage === 'recruitment-interviews' ? 'active' : ''; ?>"><a href="recruitment_interviews.php">Interviews</a></li>
        <li class="<?php echo $currentPage === 'recruitment-selected' ? 'active' : ''; ?>"><a href="recruitment_selected.php">Selected Candidates</a></li>
    </ul>
</li>

<li class="sidebar-menu-item has-submenu <?php echo in_array($currentPage, ['promotion-ranking', 'employee-ranking', 'promotion-requests', 'promotion-history', 'promotion-rules', 'eligibility-reviews', 'promotion-reports']) ? 'active' : ''; ?>">
    <a href="#promotion-ranking" class="submenu-toggle" aria-expanded="false">
        <span class="material-symbols-rounded">workspace_premium</span>
        <span>Promotion & Ranking</span>
        <span class="material-symbols-rounded submenu-arrow">expand_less</span>
    </a>
    <ul class="sidebar-submenu">
        <li class="<?php echo $currentPage === 'promotion-ranking' ? 'active' : ''; ?>"><a href="promotion_dashboard.php">Dashboard</a></li>
        <li class="<?php echo $currentPage === 'employee-ranking' ? 'active' : ''; ?>"><a href="employee_ranking.php">Employee Ranking</a></li>
        <li class="<?php echo $currentPage === 'promotion-requests' ? 'active' : ''; ?>"><a href="promotion_requests.php">Promotion Requests</a></li>
        <li class="<?php echo $currentPage === 'promotion-history' ? 'active' : ''; ?>"><a href="promotion_history.php">Promotion History</a></li>
        <li class="<?php echo $currentPage === 'promotion-rules' ? 'active' : ''; ?>"><a href="promotion_rules.php">Promotion Rules</a></li>
        <li class="<?php echo $currentPage === 'eligibility-reviews' ? 'active' : ''; ?>"><a href="eligibility_reviews.php">Eligibility Reviews</a></li>
        <li class="<?php echo $currentPage === 'promotion-reports' ? 'active' : ''; ?>"><a href="promotion_reports.php">Reports & Insights</a></li>
    </ul>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'retirement' ? 'active' : ''; ?>">
    <a href="retirement.php">
        <span class="material-symbols-rounded">group_remove</span>
        <span>Retirement</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'performance' ? 'active' : ''; ?>">
    <a href="performance.php">
        <span class="material-symbols-rounded">monitoring</span>
        <span>Performance</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'payroll-integration' ? 'active' : ''; ?>">
    <a href="payroll_integration.php">
        <span class="material-symbols-rounded">price_check</span>
        <span>Payroll Integration</span>
    </a>
</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'report' ? 'active' : ''; ?>">
    <a href="report.php">
        <span class="material-symbols-rounded">bar_chart</span>
        <span>Report</span>
    </a>
</li>

<li class="sidebar-menu-section-label">Support</li>

<li class="sidebar-menu-item <?php echo $currentPage === 'settings' ? 'active' : ''; ?>">
    <a href="#settings">
        <span class="material-symbols-rounded">settings</span>
        <span>Settings</span>
    </a>
</li>

<li class="sidebar-menu-item">
    <a href="../../Auth/login.php" style="color: var(--danger-color);">
        <span class="material-symbols-rounded">logout</span>
        <span>Logout</span>
    </a>
</li>
