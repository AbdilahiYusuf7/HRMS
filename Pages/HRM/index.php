<?php
$pageTitle = "HRM Analytics Dashboard";
$activePage = "hrm-dashboard";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_config.php';
include '../../includes/header_sidebar.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        zoom: 75%;
    }

    .hrm-suite {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .suite-panel,
    .suite-card {
        background: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
    }

    .suite-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        padding: 20px;
    }

    .suite-brand {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .suite-brand-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        background: var(--primary-color);
        color: var(--neutral-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 14px 26px rgba(15, 76, 129, 0.22);
    }

    .suite-brand h1 {
        margin: 0;
        font-size: 1.35rem;
        font-weight: 900;
        letter-spacing: -0.02em;
    }

    .suite-brand p {
        margin: 3px 0 0;
        color: var(--neutral-gray);
        font-size: 0.82rem;
        font-weight: 700;
    }

    .suite-filters {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .suite-select,
    .suite-btn {
        height: 40px;
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-sm);
        background: var(--neutral-light);
        color: var(--neutral-dark);
        font-size: 0.82rem;
        font-weight: 800;
        padding: 0 12px;
    }

    .suite-btn {
        cursor: pointer;
        background: var(--secondary-light);
        color: var(--primary-color);
    }

    .suite-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 12px 20px;
        border-top: 1px solid var(--neutral-border);
        background: var(--neutral-light);
    }

    .suite-tab {
        border: 0;
        border-radius: var(--radius-md);
        background: transparent;
        color: var(--neutral-gray);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        font-size: 0.82rem;
        font-weight: 900;
        white-space: nowrap;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .suite-tab:hover,
    .suite-tab.active {
        background: var(--primary-color);
        color: var(--neutral-white);
        box-shadow: var(--shadow-md);
    }

    .tab-content {
        display: none;
        flex-direction: column;
        gap: 18px;
    }

    .tab-content.active {
        display: flex;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(180px, 1fr));
        gap: 14px;
    }

    .summary-card {
        padding: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
    }

    .summary-card span {
        display: block;
        color: var(--neutral-gray);
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .summary-card strong {
        display: block;
        margin-top: 5px;
        color: var(--neutral-darkest);
        font-size: 1.6rem;
        font-weight: 900;
    }

    .summary-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--secondary-light);
        color: var(--primary-color);
    }

    .summary-icon.green {
        background: var(--success-light);
        color: var(--success-hover);
    }

    .summary-icon.orange {
        background: var(--warning-light);
        color: var(--warning-hover);
    }

    .summary-icon.red {
        background: var(--danger-light);
        color: var(--danger-hover);
    }

    .chart-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(280px, 1fr));
        gap: 16px;
    }

    .chart-card,
    .list-card {
        padding: 18px;
    }

    .chart-card.wide,
    .list-card.wide {
        grid-column: span 2;
    }

    .chart-card h3,
    .list-card h3 {
        margin: 0 0 4px;
        color: var(--neutral-darkest);
        font-size: 0.98rem;
        font-weight: 900;
    }

    .chart-card p,
    .list-card p {
        margin: 0 0 14px;
        color: var(--neutral-gray);
        font-size: 0.78rem;
        font-weight: 700;
    }

    .chart-holder {
        position: relative;
        height: 260px;
        width: 100%;
    }

    .list-card {
        overflow-x: auto;
    }

    .mini-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.82rem;
    }

    .mini-table th,
    .mini-table td {
        padding: 10px 9px;
        border-bottom: 1px solid var(--neutral-border);
        text-align: left;
        white-space: nowrap;
    }

    .mini-table th {
        color: var(--neutral-gray);
        background: var(--neutral-light);
        font-size: 0.7rem;
        font-weight: 900;
        text-transform: uppercase;
    }

    .metric-strip {
        display: grid;
        grid-template-columns: repeat(5, minmax(140px, 1fr));
        gap: 12px;
    }

    .metric-chip {
        padding: 14px;
        text-align: center;
        background: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
    }

    .metric-chip span {
        display: block;
        color: var(--neutral-gray);
        font-size: 0.68rem;
        font-weight: 900;
        text-transform: uppercase;
    }

    .metric-chip strong {
        display: block;
        margin-top: 5px;
        color: var(--primary-color);
        font-size: 0.95rem;
        font-weight: 900;
    }

    .chart-fallback {
        height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--neutral-gray);
        font-weight: 800;
        background: var(--neutral-light);
        border-radius: var(--radius-md);
        text-align: center;
        padding: 18px;
    }

    @media (max-width: 1280px) {
        .chart-grid {
            grid-template-columns: repeat(2, minmax(280px, 1fr));
        }

        .summary-grid {
            grid-template-columns: repeat(2, minmax(180px, 1fr));
        }
    }

    @media (max-width: 800px) {
        .chart-grid,
        .summary-grid,
        .metric-strip {
            grid-template-columns: 1fr;
        }

        .chart-card.wide,
        .list-card.wide {
            grid-column: auto;
        }
    }
</style>

<div class="hrm-suite">
    <div class="suite-panel">
        <div class="suite-topbar">
            <div class="suite-brand">
                <div class="suite-brand-icon">
                    <span class="material-symbols-rounded">analytics</span>
                </div>
                <div>
                    <h1>HR Analytics & Organizational Intelligence Suite</h1>
                    <p>Executive HRM dashboard for <?php echo htmlspecialchars(hrmBranchName()); ?> operations.</p>
                </div>
            </div>
            <div class="suite-filters">
                <select id="filter-dept" class="suite-select">
                    <option value="ALL">All Departments</option>
                </select>
                <button type="button" class="suite-btn" id="reset-filters">Reset</button>
            </div>
        </div>

        <div class="suite-tabs" id="suite-tabs">
            <button type="button" class="suite-tab active" data-tab="overview"><span class="material-symbols-rounded">dashboard</span>Overview</button>
            <button type="button" class="suite-tab" data-tab="departments"><span class="material-symbols-rounded">domain</span>Departments Intel</button>
            <button type="button" class="suite-tab" data-tab="attendance"><span class="material-symbols-rounded">schedule</span>Attendance</button>
            <button type="button" class="suite-tab" data-tab="performance"><span class="material-symbols-rounded">military_tech</span>Performance</button>
            <button type="button" class="suite-tab" data-tab="financial"><span class="material-symbols-rounded">payments</span>Payroll</button>
            <button type="button" class="suite-tab" data-tab="training"><span class="material-symbols-rounded">school</span>Training</button>
            <button type="button" class="suite-tab" data-tab="leaves"><span class="material-symbols-rounded">event_available</span>Leaves</button>
            <button type="button" class="suite-tab" data-tab="retirement"><span class="material-symbols-rounded">group_remove</span>Retirement</button>
            <button type="button" class="suite-tab" data-tab="employees"><span class="material-symbols-rounded">groups</span>Employees</button>
        </div>
    </div>

    <section id="tab-overview" class="tab-content active">
        <div class="summary-grid" id="overview-summary"></div>
        <div class="chart-grid">
            <div class="suite-card chart-card"><h3>Department Headcount Index</h3><p>Headcount distribution across departments.</p><div class="chart-holder"><canvas id="ovChart1"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Department Performance Profile</h3><p>Average employee performance by department.</p><div class="chart-holder"><canvas id="ovChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Department Payroll Footprint</h3><p>Payroll consumption by department.</p><div class="chart-holder"><canvas id="ovChart3"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Gender Distribution</h3><p>Employee gender split.</p><div class="chart-holder"><canvas id="ovChart4"></canvas></div></div>
            <div class="suite-card chart-card wide"><h3>Active Workforce Growth</h3><p>Projected workforce movement.</p><div class="chart-holder"><canvas id="ovChart5"></canvas></div></div>
        </div>
    </section>

    <section id="tab-departments" class="tab-content">
        <div class="metric-strip" id="department-matchboard"></div>
        <div class="chart-grid">
            <div class="suite-card chart-card"><h3>Gender Parity per Department</h3><p>Stacked workforce composition.</p><div class="chart-holder"><canvas id="deptChart1"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Departmental Payroll Spends</h3><p>Finance consumption per department.</p><div class="chart-holder"><canvas id="deptChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Dept Performance Ranking</h3><p>Polar department score comparison.</p><div class="chart-holder"><canvas id="deptChart3"></canvas></div></div>
            <div class="suite-card chart-card"><h3>At-Risk Ratios by Dept</h3><p>Attendance, performance, training, leave, retirement risk.</p><div class="chart-holder"><canvas id="deptChart4"></canvas></div></div>
            <div class="suite-card chart-card wide"><h3>Attendance Exceptions per Department</h3><p>Late, absent, out-of-window, and not registered events.</p><div class="chart-holder"><canvas id="deptChart5"></canvas></div></div>
        </div>
    </section>

    <section id="tab-attendance" class="tab-content">
        <div class="chart-grid">
            <div class="suite-card list-card wide"><h3>Employees With Highest Attendance Deductions</h3><p>Financial effect of attendance exceptions.</p><div id="att-deduction-list"></div></div>
            <div class="suite-card list-card"><h3>Top Attendance Employees</h3><p>Best attendance discipline.</p><div id="att-top-list"></div></div>
            <div class="suite-card chart-card"><h3>Attendance Exceptions Mix</h3><p>Out of window, absent, late, not registered.</p><div class="chart-holder"><canvas id="attChart1"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Deductions by Department</h3><p>Total attendance deductions by department.</p><div class="chart-holder"><canvas id="attChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Attendance Trend</h3><p>Weekly attendance rate movement.</p><div class="chart-holder"><canvas id="attChart3"></canvas></div></div>
        </div>
    </section>

    <section id="tab-performance" class="tab-content">
        <div class="chart-grid">
            <div class="suite-card list-card"><h3>Top Ten Performance Rank</h3><p>Highest scoring employees.</p><div id="perf-top-list"></div></div>
            <div class="suite-card list-card"><h3>Top Ten Improving Employees</h3><p>Highest improvement rate.</p><div id="perf-improve-list"></div></div>
            <div class="suite-card list-card"><h3>Underperforming Employees</h3><p>Lowest current performance scores.</p><div id="perf-under-list"></div></div>
            <div class="suite-card chart-card"><h3>Performance by Department</h3><p>Average department score.</p><div class="chart-holder"><canvas id="perfChart1"></canvas></div></div>
            <div class="suite-card chart-card wide"><h3>Performance vs Attendance</h3><p>Correlation between attendance and performance.</p><div class="chart-holder"><canvas id="perfChart2"></canvas></div></div>
        </div>
    </section>

    <section id="tab-financial" class="tab-content">
        <div class="summary-grid" id="financial-summary"></div>
        <div class="chart-grid">
            <div class="suite-card chart-card wide"><h3>Payroll & Deduction Trend</h3><p>Monthly gross payroll, deductions, and net pay movement.</p><div class="chart-holder"><canvas id="finChart1"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Gross Payroll by Department</h3><p>Department salary footprint before deductions.</p><div class="chart-holder"><canvas id="finChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Deductions by Department</h3><p>Attendance and payroll deductions by department.</p><div class="chart-holder"><canvas id="finChart3"></canvas></div></div>
            <div class="suite-card list-card"><h3>Highest Payroll Deductions</h3><p>Employees with the largest deduction totals.</p><div id="salary-high-list"></div></div>
            <div class="suite-card list-card"><h3>Net Pay Summary</h3><p>Gross salary after deductions.</p><div id="salary-low-list"></div></div>
        </div>
    </section>

    <section id="tab-training" class="tab-content">
        <div class="chart-grid">
            <div class="suite-card chart-card"><h3>Training Status</h3><p>Completed vs pending training.</p><div class="chart-holder"><canvas id="trnChart1"></canvas></div></div>
            <div class="suite-card list-card"><h3>Training Risk Employees</h3><p>Pending training exposure.</p><div id="trn-risk-list"></div></div>
            <div class="suite-card chart-card wide"><h3>Training by Department</h3><p>Completed training comparison.</p><div class="chart-holder"><canvas id="trnChart2"></canvas></div></div>
            <div class="suite-card list-card"><h3>Most Completed Trainings</h3><p>Top trained employees.</p><div id="trn-top-list"></div></div>
            <div class="suite-card list-card"><h3>Most Certificates</h3><p>Employees with most certificates.</p><div id="trn-cert-list"></div></div>
        </div>
    </section>

    <section id="tab-leaves" class="tab-content">
        <div class="chart-grid">
            <div class="suite-card chart-card"><h3>Leave Allocation Usage</h3><p>Allocated, used, and remaining days.</p><div class="chart-holder"><canvas id="lvsChart1"></canvas></div></div>
            <div class="suite-card list-card"><h3>Most Approved Leaves</h3><p>Highest used leave days.</p><div id="lvs-high-list"></div></div>
            <div class="suite-card chart-card wide"><h3>This Year vs Last Year</h3><p>Leave requests by month.</p><div class="chart-holder"><canvas id="lvsChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Department Leave Requests</h3><p>Leave demand by department.</p><div class="chart-holder"><canvas id="lvsChart3"></canvas></div></div>
            <div class="suite-card list-card"><h3>Least Leaves</h3><p>Lowest used leave days.</p><div id="lvs-low-list"></div></div>
        </div>
    </section>

    <section id="tab-retirement" class="tab-content">
        <div class="summary-grid" id="retirement-summary"></div>
        <div class="chart-grid">
            <div class="suite-card chart-card"><h3>Employee Retirement Ages</h3><p>Age band distribution.</p><div class="chart-holder"><canvas id="retChart1"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Projected Retirement Timeline</h3><p>Expected retirement movement.</p><div class="chart-holder"><canvas id="retChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Succession Readiness</h3><p>Ready internal successors vs gaps.</p><div class="chart-holder"><canvas id="retChart3"></canvas></div></div>
            <div class="suite-card list-card"><h3>Approaching Retirement & Succession</h3><p>Employees approaching retirement and successor matches.</p><div id="ret-succession-list"></div></div>
        </div>
    </section>

    <section id="tab-employees" class="tab-content">
        <div class="metric-strip" id="employee-champions"></div>
        <div class="chart-grid">
            <div class="suite-card chart-card"><h3>Male vs Female Employees</h3><p>Workforce gender split.</p><div class="chart-holder"><canvas id="empChart1"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Tenure Brackets</h3><p>Workforce service age.</p><div class="chart-holder"><canvas id="empChart2"></canvas></div></div>
            <div class="suite-card chart-card"><h3>Workforce by Department</h3><p>Employee density by department.</p><div class="chart-holder"><canvas id="empChart3"></canvas></div></div>
            <div class="suite-card list-card"><h3>Newly Joined Employees</h3><p>Newest employees.</p><div id="emp-new-list"></div></div>
            <div class="suite-card list-card"><h3>Longest Time Employees</h3><p>Most senior employees.</p><div id="emp-long-list"></div></div>
            <div class="suite-card list-card"><h3>At Risk Employees</h3><p>Risk from performance, training, attendance.</p><div id="emp-risk-list"></div></div>
        </div>
    </section>
</div>

<script>
    const colors = {
        primary: "#0F4C81",
        secondary: "#4DA8DA",
        success: "#10B981",
        warning: "#F59E0B",
        danger: "#EF4444",
        violet: "#8B5CF6",
        slate: "#64748B"
    };
    const palette = [colors.primary, colors.secondary, colors.success, colors.warning, colors.danger, colors.violet, "#14B8A6"];
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"];
    const chartRefs = {};

    const employees = [
        {id:"EMP-001", name:"Amina Hassan", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Operations", role:"Supervisor", salary:4200, attendance:98, late:1, absent:0, out:1, notRegistered:0, deductions:25, perfScore:96, improvementRate:9, trainings:8, pendingTraining:0, certificates:6, usedLeaves:3, remainingLeaves:17, leaveRequests:4, rejectedLeaves:0, age:34, tenureYears:12, retirementSchedule:"None"},
        {id:"EMP-002", name:"Mohamed Ali", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Finance", role:"Manager", salary:5200, attendance:91, late:4, absent:1, out:2, notRegistered:0, deductions:160, perfScore:88, improvementRate:4, trainings:6, pendingTraining:1, certificates:4, usedLeaves:5, remainingLeaves:15, leaveRequests:7, rejectedLeaves:1, age:46, tenureYears:14, retirementSchedule:"None"},
        {id:"EMP-003", name:"Fadumo Yusuf", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"HR", role:"Officer", salary:3100, attendance:94, late:2, absent:1, out:1, notRegistered:1, deductions:120, perfScore:91, improvementRate:11, trainings:7, pendingTraining:0, certificates:5, usedLeaves:6, remainingLeaves:14, leaveRequests:8, rejectedLeaves:0, age:39, tenureYears:10, retirementSchedule:"None"},
        {id:"EMP-004", name:"Abdirahman Jama", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Security", role:"Inspector", salary:2800, attendance:84, late:8, absent:3, out:5, notRegistered:2, deductions:510, perfScore:69, improvementRate:-3, trainings:4, pendingTraining:3, certificates:2, usedLeaves:2, remainingLeaves:18, leaveRequests:3, rejectedLeaves:1, age:58, tenureYears:23, retirementSchedule:"This Month"},
        {id:"EMP-005", name:"Khadar Omar", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Security", role:"Senior Officer", salary:3400, attendance:96, late:1, absent:1, out:0, notRegistered:0, deductions:65, perfScore:90, improvementRate:7, trainings:7, pendingTraining:1, certificates:5, usedLeaves:4, remainingLeaves:16, leaveRequests:5, rejectedLeaves:0, age:37, tenureYears:8, retirementSchedule:"None"},
        {id:"EMP-006", name:"Sahra Muse", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Training", role:"Coordinator", salary:3600, attendance:97, late:1, absent:0, out:1, notRegistered:0, deductions:25, perfScore:94, improvementRate:10, trainings:10, pendingTraining:0, certificates:8, usedLeaves:4, remainingLeaves:16, leaveRequests:5, rejectedLeaves:0, age:33, tenureYears:6, retirementSchedule:"None"},
        {id:"EMP-007", name:"Hassan Warsame", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Operations", role:"Controller", salary:4500, attendance:89, late:5, absent:2, out:3, notRegistered:1, deductions:300, perfScore:78, improvementRate:2, trainings:5, pendingTraining:2, certificates:3, usedLeaves:8, remainingLeaves:12, leaveRequests:10, rejectedLeaves:1, age:55, tenureYears:17, retirementSchedule:"This Year"},
        {id:"EMP-008", name:"Nimco Abdi", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Operations", role:"Controller", salary:3900, attendance:95, late:2, absent:0, out:1, notRegistered:0, deductions:35, perfScore:89, improvementRate:8, trainings:7, pendingTraining:1, certificates:4, usedLeaves:3, remainingLeaves:17, leaveRequests:4, rejectedLeaves:0, age:31, tenureYears:4, retirementSchedule:"None"},
        {id:"EMP-009", name:"Liban Farah", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Maintenance", role:"Engineer", salary:4100, attendance:86, late:7, absent:3, out:4, notRegistered:1, deductions:455, perfScore:73, improvementRate:-1, trainings:3, pendingTraining:4, certificates:2, usedLeaves:7, remainingLeaves:13, leaveRequests:9, rejectedLeaves:2, age:57, tenureYears:24, retirementSchedule:"This Year"},
        {id:"EMP-010", name:"Muna Ahmed", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Maintenance", role:"Engineer", salary:3700, attendance:93, late:3, absent:1, out:2, notRegistered:0, deductions:145, perfScore:86, improvementRate:6, trainings:6, pendingTraining:1, certificates:4, usedLeaves:4, remainingLeaves:16, leaveRequests:6, rejectedLeaves:1, age:35, tenureYears:7, retirementSchedule:"None"},
        {id:"EMP-011", name:"Ismail Noor", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Finance", role:"Accountant", salary:3300, attendance:92, late:4, absent:1, out:2, notRegistered:0, deductions:155, perfScore:82, improvementRate:5, trainings:5, pendingTraining:2, certificates:3, usedLeaves:6, remainingLeaves:14, leaveRequests:7, rejectedLeaves:1, age:42, tenureYears:11, retirementSchedule:"None"},
        {id:"EMP-012", name:"Hibo Said", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"HR", role:"Assistant", salary:2600, attendance:88, late:5, absent:2, out:3, notRegistered:2, deductions:380, perfScore:76, improvementRate:3, trainings:4, pendingTraining:3, certificates:2, usedLeaves:9, remainingLeaves:11, leaveRequests:12, rejectedLeaves:2, age:29, tenureYears:1, retirementSchedule:"None"},
        {id:"EMP-013", name:"Yasin Ahmed", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Training", role:"Instructor", salary:3500, attendance:99, late:0, absent:0, out:0, notRegistered:0, deductions:0, perfScore:95, improvementRate:12, trainings:9, pendingTraining:0, certificates:7, usedLeaves:1, remainingLeaves:19, leaveRequests:2, rejectedLeaves:0, age:36, tenureYears:9, retirementSchedule:"None"},
        {id:"EMP-014", name:"Rahma Osman", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Customer Service", role:"Officer", salary:2900, attendance:90, late:4, absent:2, out:2, notRegistered:1, deductions:260, perfScore:80, improvementRate:4, trainings:5, pendingTraining:2, certificates:3, usedLeaves:7, remainingLeaves:13, leaveRequests:9, rejectedLeaves:1, age:28, tenureYears:1, retirementSchedule:"None"},
        {id:"EMP-015", name:"Omar Barre", gender:"Male", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Customer Service", role:"Lead", salary:3600, attendance:93, late:2, absent:1, out:1, notRegistered:1, deductions:145, perfScore:85, improvementRate:6, trainings:6, pendingTraining:1, certificates:4, usedLeaves:5, remainingLeaves:15, leaveRequests:6, rejectedLeaves:0, age:49, tenureYears:15, retirementSchedule:"None"},
        {id:"EMP-016", name:"Deeqa Ibrahim", gender:"Female", branch:<?php echo json_encode(hrmBranchName()); ?>, department:"Finance", role:"Analyst", salary:3800, attendance:96, late:1, absent:0, out:1, notRegistered:0, deductions:30, perfScore:92, improvementRate:8, trainings:8, pendingTraining:0, certificates:5, usedLeaves:4, remainingLeaves:16, leaveRequests:5, rejectedLeaves:0, age:32, tenureYears:5, retirementSchedule:"None"}
    ];

    function money(value) {
        return "$" + Math.round(value).toLocaleString();
    }

    function uniq(key, data = filteredData()) {
        return [...new Set(data.map(item => item[key]))];
    }

    function sum(data, key) {
        return data.reduce((total, item) => total + Number(item[key] || 0), 0);
    }

    function avg(data, key) {
        return data.length ? Math.round(sum(data, key) / data.length) : 0;
    }

    function groups(key, data = filteredData()) {
        return uniq(key, data).map(name => ({ name, items: data.filter(item => item[key] === name) }));
    }

    function filteredData() {
        const dept = document.getElementById("filter-dept")?.value || "ALL";
        return employees.filter(emp => dept === "ALL" || emp.department === dept);
    }

    function riskScore(emp) {
        return emp.late * 4 + emp.absent * 12 + emp.out * 7 + emp.notRegistered * 10 + (100 - emp.perfScore) + emp.pendingTraining * 8;
    }

    function table(headers, rows) {
        return `<table class="mini-table"><thead><tr>${headers.map(header => `<th>${header}</th>`).join("")}</tr></thead><tbody>${rows.join("") || `<tr><td colspan="${headers.length}">No records found.</td></tr>`}</tbody></table>`;
    }

    function renderList(target, headers, rows) {
        document.getElementById(target).innerHTML = table(headers, rows);
    }

    function safeChartRender(id, config) {
        const canvas = document.getElementById(id);
        if (!canvas) return;
        if (chartRefs[id]) chartRefs[id].destroy();

        if (typeof Chart === "undefined") {
            canvas.parentElement.innerHTML = `<div class="chart-fallback">Chart.js could not load. Check network access to the CDN.</div>`;
            return;
        }

        const customOptions = config.options || {};
        const customPlugins = customOptions.plugins || {};
        const tooltipOptions = typeof window.hrmChartTooltipOptions === "function"
            ? window.hrmChartTooltipOptions(customPlugins.tooltip || {})
            : {
                backgroundColor: "#0f172a",
                titleColor: "#ffffff",
                bodyColor: "rgba(255, 255, 255, 0.72)",
                padding: 12,
                cornerRadius: 8
            };

        chartRefs[id] = new Chart(canvas, {
            ...config,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                ...customOptions,
                plugins: {
                    ...customPlugins,
                    legend: {
                        labels: { usePointStyle: true, boxWidth: 8, font: { weight: "700" } },
                        ...(customPlugins.legend || {})
                    },
                    tooltip: tooltipOptions
                }
            }
        });
    }

    function renderSummary(target, cards) {
        document.getElementById(target).innerHTML = cards.map(card => `
            <div class="suite-card summary-card">
                <div><span>${card.label}</span><strong>${card.value}</strong></div>
                <div class="summary-icon ${card.tone || ""}"><span class="material-symbols-rounded">${card.icon}</span></div>
            </div>
        `).join("");
    }

    function populateFilters() {
        const deptSelect = document.getElementById("filter-dept");
        uniq("department", employees).forEach(dept => deptSelect.insertAdjacentHTML("beforeend", `<option value="${dept}">${dept}</option>`));
    }

    function renderAll() {
        const data = filteredData();
        const deptGroups = groups("department", data);
        const roleGroups = groups("role", data);
        const totalPayroll = sum(data, "salary");

        renderSummary("overview-summary", [
            { label: "FTE Headcount", value: data.length, icon: "groups" },
            { label: "Active Departments", value: deptGroups.length, icon: "domain", tone: "green" },
            { label: "Home Branch", value: <?php echo json_encode(hrmBranchName()); ?>, icon: "apartment", tone: "orange" },
            { label: "Org Risk Score", value: avg(data.map(emp => ({ score: riskScore(emp) })), "score") > 80 ? "High" : "Medium", icon: "shield", tone: "red" }
        ]);

        renderOverview(data, deptGroups);
        renderDepartments(data, deptGroups);
        renderAttendance(data, deptGroups);
        renderPerformance(data, deptGroups);
        renderFinancial(data, deptGroups, roleGroups, totalPayroll);
        renderTraining(data, deptGroups);
        renderLeaves(data, deptGroups);
        renderRetirement(data, deptGroups);
        renderEmployees(data, deptGroups);
    }

    function renderOverview(data, deptGroups) {
        safeChartRender("ovChart1", { type: "line", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Headcount", data: deptGroups.map(g => g.items.length), borderColor: colors.primary, backgroundColor: "rgba(15,76,129,.12)", fill: true, tension: .35 }] } });
        safeChartRender("ovChart2", { type: "line", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Performance", data: deptGroups.map(g => avg(g.items, "perfScore")), borderColor: colors.success, backgroundColor: "rgba(16,185,129,.12)", fill: true, tension: .35 }] } });
        safeChartRender("ovChart3", { type: "doughnut", data: { labels: deptGroups.map(g => g.name), datasets: [{ data: deptGroups.map(g => sum(g.items, "salary")), backgroundColor: palette }] } });
        safeChartRender("ovChart4", { type: "pie", data: { labels: ["Male", "Female"], datasets: [{ data: [data.filter(e => e.gender === "Male").length, data.filter(e => e.gender === "Female").length], backgroundColor: [colors.primary, colors.secondary] }] } });
        safeChartRender("ovChart5", { type: "line", data: { labels: months, datasets: [{ label: "Active Workforce Growth", data: [12, 12, 13, 14, 14, 15, 15, data.length], borderColor: colors.primary, backgroundColor: "rgba(77,168,218,.18)", fill: true, tension: .35 }] } });
    }

    function renderDepartments(data, deptGroups) {
        const best = [...deptGroups].sort((a, b) => avg(b.items, "perfScore") - avg(a.items, "perfScore"))[0]?.name || "-";
        const late = [...deptGroups].sort((a, b) => sum(b.items, "late") - sum(a.items, "late"))[0]?.name || "-";
        const out = [...deptGroups].sort((a, b) => sum(b.items, "out") - sum(a.items, "out"))[0]?.name || "-";
        const absent = [...deptGroups].sort((a, b) => sum(b.items, "absent") - sum(a.items, "absent"))[0]?.name || "-";
        const retiring = [...deptGroups].sort((a, b) => b.items.filter(e => e.retirementSchedule !== "None").length - a.items.filter(e => e.retirementSchedule !== "None").length)[0]?.name || "-";
        document.getElementById("department-matchboard").innerHTML = [
            ["Best Performer", best], ["Most Late Staff", late], ["Most Out-of-Window", out], ["Most Absenteeism", absent], ["Most Retirements", retiring]
        ].map(item => `<div class="metric-chip"><span>${item[0]}</span><strong>${item[1]}</strong></div>`).join("");

        safeChartRender("deptChart1", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Male", data: deptGroups.map(g => g.items.filter(e => e.gender === "Male").length), backgroundColor: colors.primary }, { label: "Female", data: deptGroups.map(g => g.items.filter(e => e.gender === "Female").length), backgroundColor: colors.secondary }] }, options: { scales: { x: { stacked: true }, y: { stacked: true } } } });
        safeChartRender("deptChart2", { type: "doughnut", data: { labels: deptGroups.map(g => g.name), datasets: [{ data: deptGroups.map(g => sum(g.items, "salary")), backgroundColor: palette }] } });
        safeChartRender("deptChart3", { type: "polarArea", data: { labels: deptGroups.map(g => g.name), datasets: [{ data: deptGroups.map(g => avg(g.items, "perfScore")), backgroundColor: palette.map(c => c + "cc") }] } });
        safeChartRender("deptChart4", { type: "radar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Risk Ratio", data: deptGroups.map(g => avg(g.items.map(e => ({ risk: riskScore(e) })), "risk")), borderColor: colors.danger, backgroundColor: "rgba(239,68,68,.12)" }] } });
        safeChartRender("deptChart5", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Late", data: deptGroups.map(g => sum(g.items, "late")), backgroundColor: colors.warning }, { label: "Absent", data: deptGroups.map(g => sum(g.items, "absent")), backgroundColor: colors.danger }, { label: "Out Window", data: deptGroups.map(g => sum(g.items, "out")), backgroundColor: colors.violet }, { label: "Not Registered", data: deptGroups.map(g => sum(g.items, "notRegistered")), backgroundColor: colors.slate }] } });
    }

    function renderAttendance(data, deptGroups) {
        renderList("att-deduction-list", ["Employee", "Department", "Deduction"], [...data].sort((a, b) => b.deductions - a.deductions).slice(0, 8).map(e => `<tr><td>${e.name}</td><td>${e.department}</td><td>${money(e.deductions)}</td></tr>`));
        renderList("att-top-list", ["Employee", "Attendance"], [...data].sort((a, b) => b.attendance - a.attendance).slice(0, 8).map(e => `<tr><td>${e.name}</td><td>${e.attendance}%</td></tr>`));
        safeChartRender("attChart1", { type: "bar", data: { labels: ["Out Window", "Absent", "Late", "Not Registered"], datasets: [{ label: "Events", data: [sum(data, "out"), sum(data, "absent"), sum(data, "late"), sum(data, "notRegistered")], backgroundColor: [colors.violet, colors.danger, colors.warning, colors.slate] }] } });
        safeChartRender("attChart2", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Deductions", data: deptGroups.map(g => sum(g.items, "deductions")), backgroundColor: colors.danger }] }, options: { indexAxis: "y" } });
        safeChartRender("attChart3", { type: "line", data: { labels: ["Sat", "Sun", "Mon", "Tue", "Wed", "Thu"], datasets: [{ label: "Attendance Rate", data: [92, 88, 94, 95, 92, avg(data, "attendance")], borderColor: colors.primary, backgroundColor: "rgba(77,168,218,.18)", fill: true, tension: .4 }] } });
    }

    function renderPerformance(data, deptGroups) {
        renderList("perf-top-list", ["Employee", "Score"], [...data].sort((a, b) => b.perfScore - a.perfScore).slice(0, 10).map(e => `<tr><td>${e.name}</td><td>${e.perfScore}%</td></tr>`));
        renderList("perf-improve-list", ["Employee", "Improvement"], [...data].sort((a, b) => b.improvementRate - a.improvementRate).slice(0, 10).map(e => `<tr><td>${e.name}</td><td>+${e.improvementRate}%</td></tr>`));
        renderList("perf-under-list", ["Employee", "Score"], [...data].sort((a, b) => a.perfScore - b.perfScore).slice(0, 10).map(e => `<tr><td>${e.name}</td><td>${e.perfScore}%</td></tr>`));
        safeChartRender("perfChart1", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Performance", data: deptGroups.map(g => avg(g.items, "perfScore")), backgroundColor: colors.success }] } });
        safeChartRender("perfChart2", { type: "scatter", data: { datasets: [{ label: "Employees", data: data.map(e => ({ x: e.attendance, y: e.perfScore })), backgroundColor: colors.primary }] }, options: { scales: { x: { title: { display: true, text: "Attendance" } }, y: { title: { display: true, text: "Performance" } } } } });
    }

    function renderFinancial(data, deptGroups, roleGroups, totalPayroll) {
        const totalDeductions = sum(data, "deductions");
        const netPayroll = totalPayroll - totalDeductions;
        const payrollTrend = {
            gross: months.map((_, index) => Math.round(totalPayroll * (0.88 + index * 0.015))),
            deductions: months.map((_, index) => Math.round(totalDeductions * (0.85 + index * 0.018))),
            net: months.map((_, index) => Math.round(netPayroll * (0.87 + index * 0.016)))
        };

        renderSummary("financial-summary", [
            { label: "Gross Payroll", value: money(totalPayroll), icon: "payments" },
            { label: "Total Deductions", value: money(totalDeductions), icon: "receipt_long", tone: "orange" },
            { label: "Net Payroll", value: money(netPayroll), icon: "account_balance_wallet", tone: "green" },
            { label: "Avg Gross Salary", value: money(avg(data, "salary")), icon: "price_check", tone: "red" }
        ]);
        safeChartRender("finChart1", { type: "line", data: { labels: months, datasets: [{ label: "Gross Payroll", data: payrollTrend.gross, borderColor: colors.primary, tension: .35 }, { label: "Deductions", data: payrollTrend.deductions, borderColor: colors.danger, tension: .35 }, { label: "Net Payroll", data: payrollTrend.net, borderColor: colors.success, tension: .35 }] } });
        safeChartRender("finChart2", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Gross Payroll", data: deptGroups.map(g => sum(g.items, "salary")), backgroundColor: colors.primary }] } });
        safeChartRender("finChart3", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Deductions", data: deptGroups.map(g => sum(g.items, "deductions")), backgroundColor: colors.danger }] }, options: { indexAxis: "y" } });
        renderList("salary-high-list", ["Employee", "Deductions"], [...data].sort((a, b) => b.deductions - a.deductions).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${money(e.deductions)}</td></tr>`));
        renderList("salary-low-list", ["Employee", "Net Pay"], [...data].sort((a, b) => (b.salary - b.deductions) - (a.salary - a.deductions)).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${money(e.salary - e.deductions)}</td></tr>`));
    }

    function renderTraining(data, deptGroups) {
        safeChartRender("trnChart1", { type: "doughnut", data: { labels: ["Completed", "Pending"], datasets: [{ data: [sum(data, "trainings"), sum(data, "pendingTraining")], backgroundColor: [colors.success, colors.warning] }] } });
        safeChartRender("trnChart2", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Completed", data: deptGroups.map(g => sum(g.items, "trainings")), backgroundColor: colors.primary }, { label: "Pending", data: deptGroups.map(g => sum(g.items, "pendingTraining")), backgroundColor: colors.warning }] } });
        renderList("trn-top-list", ["Employee", "Completed"], [...data].sort((a, b) => b.trainings - a.trainings).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.trainings}</td></tr>`));
        renderList("trn-risk-list", ["Employee", "Pending"], [...data].sort((a, b) => b.pendingTraining - a.pendingTraining).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.pendingTraining}</td></tr>`));
        renderList("trn-cert-list", ["Employee", "Certificates"], [...data].sort((a, b) => b.certificates - a.certificates).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.certificates}</td></tr>`));
    }

    function renderLeaves(data, deptGroups) {
        const allocated = data.length * 20;
        safeChartRender("lvsChart1", { type: "bar", data: { labels: ["Allocated", "Used", "Remaining"], datasets: [{ label: "Days", data: [allocated, sum(data, "usedLeaves"), sum(data, "remainingLeaves")], backgroundColor: [colors.primary, colors.warning, colors.success] }] } });
        safeChartRender("lvsChart2", { type: "line", data: { labels: months, datasets: [{ label: "This Year", data: [10, 14, 18, 21, 26, 24, 28, sum(data, "leaveRequests")], borderColor: colors.primary, tension: .35 }, { label: "Last Year", data: [8, 12, 16, 19, 22, 21, 24, 27], borderColor: colors.slate, tension: .35 }] } });
        safeChartRender("lvsChart3", { type: "doughnut", data: { labels: deptGroups.map(g => g.name), datasets: [{ data: deptGroups.map(g => sum(g.items, "leaveRequests")), backgroundColor: palette }] } });
        renderList("lvs-high-list", ["Employee", "Used"], [...data].sort((a, b) => b.usedLeaves - a.usedLeaves).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.usedLeaves}</td></tr>`));
        renderList("lvs-low-list", ["Employee", "Used"], [...data].sort((a, b) => a.usedLeaves - b.usedLeaves).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.usedLeaves}</td></tr>`));
    }

    function renderRetirement(data, deptGroups) {
        const retirees = data.filter(e => e.retirementSchedule !== "None");
        const readyNow = retirees.filter(ret => data.some(e => e.department === ret.department && e.id !== ret.id && e.age < 55 && e.perfScore >= 80)).length;
        renderSummary("retirement-summary", [
            { label: "This Week", value: retirees.filter(e => e.retirementSchedule === "This Week").length, icon: "today" },
            { label: "This Month", value: retirees.filter(e => e.retirementSchedule === "This Month").length, icon: "calendar_month", tone: "orange" },
            { label: "This Year", value: retirees.filter(e => e.retirementSchedule === "This Year").length, icon: "date_range", tone: "red" },
            { label: "Ready Successors", value: readyNow, icon: "move_up", tone: "green" }
        ]);
        safeChartRender("retChart1", { type: "bar", data: { labels: ["<30", "30-39", "40-49", "50-59", "60+"], datasets: [{ label: "Employees", data: [data.filter(e => e.age < 30).length, data.filter(e => e.age >= 30 && e.age < 40).length, data.filter(e => e.age >= 40 && e.age < 50).length, data.filter(e => e.age >= 50 && e.age < 60).length, data.filter(e => e.age >= 60).length], backgroundColor: palette.slice(0, 5) }] } });
        safeChartRender("retChart2", { type: "line", data: { labels: months, datasets: [{ label: "Projected Retirements", data: [0, 1, 1, 2, 2, 3, 3, retirees.length], borderColor: colors.danger, backgroundColor: "rgba(239,68,68,.12)", fill: true, tension: .35 }] } });
        safeChartRender("retChart3", { type: "doughnut", data: { labels: ["Ready Now", "Needs Pipeline"], datasets: [{ data: [readyNow, Math.max(0, retirees.length - readyNow)], backgroundColor: [colors.success, colors.danger] }] } });
        renderList("ret-succession-list", ["Retiring", "Department", "Timeline", "Successor"], retirees.map(ret => {
            const successor = data.find(e => e.department === ret.department && e.id !== ret.id && e.age < 55 && e.perfScore >= 80);
            return `<tr><td>${ret.name}</td><td>${ret.department}</td><td>${ret.retirementSchedule}</td><td>${successor ? successor.name : "External candidate required"}</td></tr>`;
        }));
    }

    function renderEmployees(data, deptGroups) {
        const bestMale = [...data].filter(e => e.gender === "Male").sort((a, b) => b.perfScore - a.perfScore)[0];
        const bestFemale = [...data].filter(e => e.gender === "Female").sort((a, b) => b.perfScore - a.perfScore)[0];
        const bestOverall = [...data].sort((a, b) => b.perfScore - a.perfScore)[0];
        document.getElementById("employee-champions").innerHTML = [
            ["Gender Split", `${data.filter(e => e.gender === "Male").length} Male / ${data.filter(e => e.gender === "Female").length} Female`],
            ["Best Male", bestMale ? `${bestMale.name} (${bestMale.perfScore}%)` : "-"],
            ["Best Female", bestFemale ? `${bestFemale.name} (${bestFemale.perfScore}%)` : "-"],
            ["Overall Best", bestOverall ? `${bestOverall.name} (${bestOverall.perfScore}%)` : "-"],
            ["Total Employees", data.length]
        ].map(item => `<div class="metric-chip"><span>${item[0]}</span><strong>${item[1]}</strong></div>`).join("");
        safeChartRender("empChart1", { type: "pie", data: { labels: ["Male", "Female"], datasets: [{ data: [data.filter(e => e.gender === "Male").length, data.filter(e => e.gender === "Female").length], backgroundColor: [colors.primary, colors.secondary] }] } });
        safeChartRender("empChart2", { type: "doughnut", data: { labels: ["High > 8 yrs", "Standard 3-8 yrs", "Onboarding < 3 yrs"], datasets: [{ data: [data.filter(e => e.tenureYears > 8).length, data.filter(e => e.tenureYears >= 3 && e.tenureYears <= 8).length, data.filter(e => e.tenureYears < 3).length], backgroundColor: [colors.primary, colors.success, colors.warning] }] } });
        safeChartRender("empChart3", { type: "bar", data: { labels: deptGroups.map(g => g.name), datasets: [{ label: "Employees", data: deptGroups.map(g => g.items.length), backgroundColor: colors.primary }] } });
        renderList("emp-new-list", ["Employee", "Tenure"], [...data].sort((a, b) => a.tenureYears - b.tenureYears).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.tenureYears} yrs</td></tr>`));
        renderList("emp-long-list", ["Employee", "Tenure"], [...data].sort((a, b) => b.tenureYears - a.tenureYears).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${e.tenureYears} yrs</td></tr>`));
        renderList("emp-risk-list", ["Employee", "Risk"], [...data].sort((a, b) => riskScore(b) - riskScore(a)).slice(0, 6).map(e => `<tr><td>${e.name}</td><td>${riskScore(e)}</td></tr>`));
    }

    document.querySelectorAll(".suite-tab").forEach(button => {
        button.addEventListener("click", () => {
            document.querySelectorAll(".suite-tab").forEach(item => item.classList.remove("active"));
            document.querySelectorAll(".tab-content").forEach(section => section.classList.remove("active"));
            button.classList.add("active");
            document.getElementById(`tab-${button.dataset.tab}`).classList.add("active");
        });
    });

    document.getElementById("filter-dept").addEventListener("change", renderAll);
    document.getElementById("reset-filters").addEventListener("click", () => {
        document.getElementById("filter-dept").value = "ALL";
        renderAll();
    });

    document.addEventListener("DOMContentLoaded", function () {
        populateFilters();
        renderAll();
    });
</script>

<?php
include '../../includes/footer.php';
?>
