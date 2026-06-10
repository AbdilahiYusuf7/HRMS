<?php
$pageTitle = "Attendance";
$activePage = "attendance";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_config.php';
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .attendance-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .attendance-analytics-grid {
        display: grid;
        grid-template-columns: minmax(360px, 0.95fr) minmax(480px, 1.25fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .attendance-chart-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.72), rgba(255, 255, 255, 0.92) 48%, rgba(255, 235, 244, 0.78));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 24px;
        overflow: hidden;
    }

    .attendance-chart-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 18px;
    }

    .attendance-chart-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.22rem;
        margin-bottom: 6px;
    }

    .attendance-chart-header p {
        color: var(--neutral-gray);
        font-size: 0.88rem;
        font-weight: 500;
    }

    .attendance-chart-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
    }

    .attendance-rate-chart {
        width: 100%;
        overflow: hidden;
    }

    .attendance-rate-chart svg {
        display: block;
        width: 100%;
        height: auto;
    }

    .attendance-rate-grid line {
        stroke: rgba(203, 213, 225, 0.86);
        stroke-width: 1;
    }

    .attendance-rate-axis text,
    .attendance-rate-days text {
        fill: #64748b;
        font-size: 14px;
        font-weight: 700;
    }

    .attendance-rate-fill {
        fill: url(#attendancePageArea);
    }

    .attendance-rate-line {
        fill: none;
        stroke: var(--secondary-color);
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .attendance-rate-points circle {
        fill: var(--neutral-white);
        stroke: var(--primary-color);
        stroke-width: 5;
    }

    .attendance-rate-kpis {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-top: 18px;
    }

    .attendance-rate-kpi {
        border: 1px solid rgba(191, 219, 254, 0.8);
        border-radius: var(--radius-sm);
        background-color: rgba(255, 255, 255, 0.74);
        padding: 12px;
    }

    .attendance-rate-kpi span {
        color: #64748b;
        display: block;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .attendance-rate-kpi strong {
        color: var(--neutral-darkest);
        display: block;
        font-size: 1.2rem;
    }

    .attendance-shift-panel {
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 28px;
        margin-bottom: 32px;
    }

    .attendance-shift-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(180px, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .attendance-shift-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
        padding: 20px;
    }

    .attendance-shift-card span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.76rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .attendance-shift-card strong {
        color: var(--neutral-darkest);
        display: block;
        font-size: 1.2rem;
        margin-bottom: 8px;
    }

    .attendance-shift-card p {
        color: var(--neutral-gray);
        font-size: 0.88rem;
        font-weight: 600;
        line-height: 1.45;
    }

    .attendance-ai-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.78), rgba(255, 255, 255, 0.92) 48%, rgba(255, 235, 244, 0.8));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 32px;
        margin-bottom: 32px;
    }

    .attendance-ai-header {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 28px;
    }

    .attendance-ai-header-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        color: var(--primary-color);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
    }

    .attendance-ai-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.35rem;
        margin-bottom: 6px;
    }

    .attendance-ai-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .attendance-ai-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(280px, 1fr));
        gap: 20px 24px;
        margin-bottom: 24px;
    }

    .attendance-ai-card {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.72), rgba(255, 241, 247, 0.72));
        padding: 24px;
    }

    .attendance-ai-card-top {
        display: grid;
        grid-template-columns: auto minmax(0, 1fr) auto;
        gap: 16px;
        align-items: center;
        margin-bottom: 18px;
    }

    .attendance-ai-card-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-md);
        background-color: rgba(239, 246, 255, 0.88);
        color: #3b82f6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .attendance-ai-card h3 {
        color: var(--neutral-darkest);
        font-size: 1.05rem;
        margin-bottom: 6px;
    }

    .attendance-ai-card p {
        color: var(--neutral-gray);
        font-size: 0.9rem;
        font-weight: 500;
        line-height: 1.45;
    }

    .attendance-ai-score {
        color: #10b981;
        font-size: 1.05rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .attendance-ai-progress {
        height: 10px;
        border-radius: 999px;
        background-color: rgba(203, 213, 225, 0.76);
        overflow: hidden;
    }

    .attendance-ai-progress span {
        display: block;
        width: var(--value);
        height: 100%;
        border-radius: inherit;
        background-color: var(--primary-color);
    }

    .attendance-ai-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(160px, 1fr));
        gap: 24px;
    }

    .attendance-ai-stat {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.86), rgba(255, 241, 247, 0.72));
        padding: 24px;
    }

    .attendance-ai-stat strong {
        color: #10b981;
        display: block;
        font-size: 1.8rem;
        margin-bottom: 8px;
    }

    .attendance-ai-stat.warning strong {
        color: #f59e0b;
    }

    .attendance-ai-stat.info strong {
        color: #3b82f6;
    }

    .attendance-ai-stat span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.9rem;
        font-weight: 700;
    }

    @media (max-width: 1024px) {
        .attendance-analytics-grid {
            grid-template-columns: 1fr;
        }

        .attendance-shift-grid {
            grid-template-columns: repeat(2, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .attendance-actions {
            justify-content: stretch;
        }

        .attendance-actions .btn {
            width: 100%;
        }

        .attendance-shift-grid {
            grid-template-columns: 1fr;
        }

        .attendance-chart-panel {
            padding: 22px;
        }

        .attendance-chart-header {
            align-items: center;
        }

        .attendance-rate-kpis {
            grid-template-columns: 1fr;
        }

        .attendance-ai-grid,
        .attendance-ai-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="hrm-page-title-row">
    <div>
        <h1>Attendance</h1>
        <p>Track employee check-ins, duty status, late arrivals, and daily attendance records.</p>
    </div>
    <div class="attendance-actions">
        <button type="button" class="btn btn-secondary">
            <span class="material-symbols-rounded" style="font-size: 18px;">download</span>
            <span>Export Report</span>
        </button>
    </div>
</div>

<div class="employee-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Present Today</h3>
            <strong>1,214</strong>
            <p>Employees checked in at <?php echo htmlspecialchars(hrmBranchName()); ?> today.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">how_to_reg</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>On Time</h3>
            <strong>1,082</strong>
            <p>Employees who checked in before shift start.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">task_alt</span>
        </div>
    </div>

    <div class="employee-insight-card leave">
        <div>
            <h3>Late Arrivals</h3>
            <strong>68</strong>
            <p>Employees marked late for the current duty window.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">schedule</span>
        </div>
    </div>

    <div class="employee-insight-card least-performing">
        <div>
            <h3>Absent</h3>
            <strong>44</strong>
            <p>Employees without attendance or approved leave.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">person_off</span>
        </div>
    </div>
</div>

<div class="attendance-analytics-grid">
    <section class="attendance-chart-panel">
        <div class="attendance-chart-header">
            <div>
                <h2>Department Attendance Overview</h2>
                <p>Today's attendance status by department.</p>
            </div>
            <button type="button" class="hrm-chart-menu" aria-label="Department overview options">
                <span class="material-symbols-rounded">more_vert</span>
            </button>
        </div>

        <div class="department-chart" aria-label="Department distribution chart">
            <svg class="department-nightingale-chart" viewBox="0 0 280 280" role="img">
                <circle class="nightingale-guide" cx="140" cy="140" r="42"></circle>
                <circle class="nightingale-guide" cx="140" cy="140" r="70"></circle>
                <circle class="nightingale-guide" cx="140" cy="140" r="98"></circle>
                <path class="department-slice it" data-chart-title="Human Resource" data-chart-value="2 present · 0 late · 0 absent" d="M140 140 L140 42 A98 98 0 0 1 233.2 109.7 Z"></path>
                <path class="department-slice hr" data-chart-title="Finance" data-chart-value="1 late · 1 absent · 1 out of window" d="M140 140 L220.8 113.7 A85 85 0 0 1 189.9 208.8 Z"></path>
                <path class="department-slice marketing" data-chart-title="Marketing" data-chart-value="1 late · 1 out of window" d="M140 140 L200.5 223.3 A103 103 0 0 1 79.5 223.3 Z"></path>
                <path class="department-slice finance" data-chart-title="Operations" data-chart-value="1 absent · attendance follow-up needed" d="M140 140 L86.5 213.7 A91 91 0 0 1 53.4 111.9 Z"></path>
                <path class="department-slice operations" data-chart-title="Information Technology" data-chart-value="1 late · 1 out of window" d="M140 140 L26.8 103.2 A119 119 0 0 1 140 21 Z"></path>
            </svg>
        </div>

        <div class="department-legend">
            <span><i style="background-color: var(--primary-color);"></i> Human Resource</span>
            <span><i style="background-color: var(--success-color);"></i> Finance</span>
            <span><i style="background-color: var(--warning-color);"></i> Marketing</span>
            <span><i style="background-color: var(--danger-color);"></i> Operations</span>
            <span><i style="background-color: var(--secondary-color);"></i> IT</span>
        </div>
    </section>

    <section class="attendance-chart-panel">
        <div class="attendance-chart-header">
            <div>
                <h2>Weekly Attendance Rate</h2>
                <p>Important attendance movement for the active week.</p>
            </div>
            <div class="attendance-chart-icon">
                <span class="material-symbols-rounded">show_chart</span>
            </div>
        </div>

        <div class="attendance-rate-chart" aria-label="Weekly attendance rate line chart">
            <svg viewBox="0 0 760 330" role="img">
                <defs>
                    <linearGradient id="attendancePageArea" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#4DA8DA" stop-opacity="0.26"></stop>
                        <stop offset="100%" stop-color="#4DA8DA" stop-opacity="0.03"></stop>
                    </linearGradient>
                </defs>
                <g class="attendance-rate-grid">
                    <line x1="56" y1="38" x2="732" y2="38"></line>
                    <line x1="56" y1="83" x2="732" y2="83"></line>
                    <line x1="56" y1="128" x2="732" y2="128"></line>
                    <line x1="56" y1="173" x2="732" y2="173"></line>
                    <line x1="56" y1="218" x2="732" y2="218"></line>
                    <line x1="56" y1="263" x2="732" y2="263"></line>
                </g>
                <g class="attendance-rate-axis">
                    <text x="20" y="42">96</text>
                    <text x="20" y="87">94</text>
                    <text x="20" y="132">92</text>
                    <text x="20" y="177">90</text>
                    <text x="20" y="222">88</text>
                    <text x="20" y="267">86</text>
                </g>
                <path class="attendance-rate-fill" d="M56 128 C96 144 116 207 158 218 C214 232 242 142 294 89 C336 46 386 42 438 62 C504 88 560 96 620 128 C668 154 700 207 732 250 L732 300 L56 300 Z"></path>
                <path class="attendance-rate-line" d="M56 128 C96 144 116 207 158 218 C214 232 242 142 294 89 C336 46 386 42 438 62 C504 88 560 96 620 128 C668 154 700 207 732 250"></path>
                <g class="attendance-rate-points">
                    <circle cx="56" cy="128" r="7" data-chart-title="Saturday" data-chart-value="92% attendance"></circle>
                    <circle cx="158" cy="218" r="7" data-chart-title="Sunday" data-chart-value="88% attendance"></circle>
                    <circle cx="294" cy="89" r="7" data-chart-title="Monday" data-chart-value="95% attendance"></circle>
                    <circle cx="438" cy="62" r="7" data-chart-title="Tuesday" data-chart-value="94% attendance"></circle>
                    <circle cx="620" cy="128" r="7" data-chart-title="Wednesday" data-chart-value="91% attendance"></circle>
                    <circle cx="732" cy="250" r="7" data-chart-title="Thursday" data-chart-value="85% attendance"></circle>
                </g>
                <g class="attendance-rate-days">
                    <text x="56" y="322">Sat</text>
                    <text x="158" y="322">Sun</text>
                    <text x="294" y="322">Mon</text>
                    <text x="438" y="322">Tue</text>
                    <text x="620" y="322">Wed</text>
                    <text x="732" y="322">Thu</text>
                </g>
            </svg>
        </div>

        <div class="attendance-rate-kpis">
            <div class="attendance-rate-kpi">
                <span>Best Day</span>
                <strong>Monday 95%</strong>
            </div>
            <div class="attendance-rate-kpi">
                <span>Needs Review</span>
                <strong>Thursday 85%</strong>
            </div>
            <div class="attendance-rate-kpi">
                <span>Weekly Avg</span>
                <strong>91.2%</strong>
            </div>
        </div>
    </section>
</div>

<section class="attendance-shift-panel">
    <div class="employee-records-header">
        <div>
            <h2>Duty Windows</h2>
            <p>Current shift windows used to evaluate check-in and late status.</p>
        </div>
    </div>

    <div class="attendance-shift-grid">
        <article class="attendance-shift-card">
            <span>Morning Shift</span>
            <strong>08:00 AM - 04:00 PM</strong>
            <p>Primary administrative and operations shift.</p>
        </article>
        <article class="attendance-shift-card">
            <span>Half Day</span>
            <strong>08:00 AM - 01:00 PM</strong>
            <p>Friday and approved short duty assignments.</p>
        </article>
        <article class="attendance-shift-card">
            <span>Evening Shift</span>
            <strong>04:00 PM - 12:00 AM</strong>
            <p>Late operations and coverage teams.</p>
        </article>
        <article class="attendance-shift-card">
            <span>Night Shift</span>
            <strong>12:00 AM - 08:00 AM</strong>
            <p>Overnight security and operations duty.</p>
        </article>
    </div>
</section>

<section class="attendance-ai-panel">
    <div class="attendance-ai-header">
        <div class="attendance-ai-header-icon">
            <span class="material-symbols-rounded">memory</span>
        </div>
        <div>
            <h2>Advanced AI Accuracy & Reliability</h2>
            <p>Deep-learning facial recognition performance across challenging conditions.</p>
        </div>
    </div>

    <div class="attendance-ai-grid">
        <article class="attendance-ai-card">
            <div class="attendance-ai-card-top">
                <div class="attendance-ai-card-icon">
                    <span class="material-symbols-rounded">light_mode</span>
                </div>
                <div>
                    <h3>Low Light Conditions</h3>
                    <p>Infrared-assisted recognition in dimly lit environments.</p>
                </div>
                <strong class="attendance-ai-score">96.8%</strong>
            </div>
            <div class="attendance-ai-progress"><span style="--value: 96.8%;"></span></div>
        </article>

        <article class="attendance-ai-card">
            <div class="attendance-ai-card-top">
                <div class="attendance-ai-card-icon">
                    <span class="material-symbols-rounded">eyeglasses</span>
                </div>
                <div>
                    <h3>Facial Changes</h3>
                    <p>Adaptive model handles accessories and grooming changes.</p>
                </div>
                <strong class="attendance-ai-score">95.2%</strong>
            </div>
            <div class="attendance-ai-progress"><span style="--value: 95.2%;"></span></div>
        </article>

        <article class="attendance-ai-card">
            <div class="attendance-ai-card-top">
                <div class="attendance-ai-card-icon">
                    <span class="material-symbols-rounded">undo</span>
                </div>
                <div>
                    <h3>Various Camera Angles</h3>
                    <p>Multi-angle deep learning for off-center face captures.</p>
                </div>
                <strong class="attendance-ai-score">94.7%</strong>
            </div>
            <div class="attendance-ai-progress"><span style="--value: 94.7%;"></span></div>
        </article>

        <article class="attendance-ai-card">
            <div class="attendance-ai-card-top">
                <div class="attendance-ai-card-icon">
                    <span class="material-symbols-rounded">visibility</span>
                </div>
                <div>
                    <h3>Aging & Appearance Drift</h3>
                    <p>Continuous model updates to track gradual facial changes.</p>
                </div>
                <strong class="attendance-ai-score">93.5%</strong>
            </div>
            <div class="attendance-ai-progress"><span style="--value: 93.5%;"></span></div>
        </article>
    </div>

    <div class="attendance-ai-stats">
        <div class="attendance-ai-stat">
            <strong>0.3%</strong>
            <span>False Rejection Rate</span>
        </div>
        <div class="attendance-ai-stat warning">
            <strong>4</strong>
            <span>Incorrect Records (Monthly)</span>
        </div>
        <div class="attendance-ai-stat info">
            <strong>7</strong>
            <span>HR Manual Corrections</span>
        </div>
        <div class="attendance-ai-stat">
            <strong>98.4%</strong>
            <span>Overall AI Accuracy</span>
        </div>
    </div>
</section>

<section class="employee-records-section">
    <div class="employee-records-header">
        <div>
            <h2>Attendance Records</h2>
            <p>Daily attendance records with check-in, check-out, and duty status.</p>
        </div>
    </div>

    <div class="employee-table-panel" data-attendance-page-table>
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button" data-attendance-page-sort-key="employee">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-attendance-page-sort-key="department">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-attendance-page-sort-key="branch">Branch <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-attendance-page-sort-key="checkIn">Check In <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-attendance-page-sort-key="checkOut">Check Out <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-attendance-page-sort-key="workHours">Work Hours <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-attendance-page-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-employee="Cabdiraxmaan Cali" data-number="EMP-0001" data-department="Human Resource" data-branch="Idaacada Branch" data-date="2026-04-24" data-check-in="08:01" data-check-out="17:12" data-work-hours="9.18" data-status="Present">
                        <td><div class="employee-table-name"><span class="employee-avatar">CC</span><div><strong>Cabdiraxmaan Cali</strong><span>EMP-0001</span></div></div></td>
                        <td>Human Resource</td><td>Idaacada Branch</td><td>08:01 AM</td><td>05:12 PM</td><td>09h 11m</td><td><span class="employee-status active">Present</span></td>
                    </tr>
                    <tr data-employee="Fadumo Xasan" data-number="EMP-0002" data-department="Finance" data-branch="Idaacada Branch" data-date="2026-04-24" data-check-in="08:18" data-check-out="17:05" data-work-hours="8.78" data-status="Late">
                        <td><div class="employee-table-name"><span class="employee-avatar">FX</span><div><strong>Fadumo Xasan</strong><span>EMP-0002</span></div></div></td>
                        <td>Finance</td><td>Idaacada Branch</td><td>08:18 AM</td><td>05:05 PM</td><td>08h 47m</td><td><span class="employee-status late">Late</span></td>
                    </tr>
                    <tr data-employee="Mahad Axmed" data-number="EMP-0003" data-department="Operations" data-branch="Idaacada Branch" data-date="2026-04-24" data-check-in="07:55" data-check-out="17:10" data-work-hours="9.25" data-status="Present">
                        <td><div class="employee-table-name"><span class="employee-avatar">MA</span><div><strong>Mahad Axmed</strong><span>EMP-0003</span></div></div></td>
                        <td>Operations</td><td>Idaacada Branch</td><td>07:55 AM</td><td>05:10 PM</td><td>09h 15m</td><td><span class="employee-status active">Present</span></td>
                    </tr>
                    <tr data-employee="Sahra Maxamed" data-number="EMP-0004" data-department="Marketing" data-branch="Idaacada Branch" data-date="2026-04-24" data-check-in="" data-check-out="" data-work-hours="0" data-status="Absent">
                        <td><div class="employee-table-name"><span class="employee-avatar">SM</span><div><strong>Sahra Maxamed</strong><span>EMP-0004</span></div></div></td>
                        <td>Marketing</td><td>Idaacada Branch</td><td>--</td><td>--</td><td>00h 00m</td><td><span class="employee-status inactive">Absent</span></td>
                    </tr>
                    <tr data-employee="Hodan Maxamed" data-number="EMP-0005" data-department="Finance" data-branch="Idaacada Branch" data-date="2026-04-24" data-check-in="" data-check-out="" data-work-hours="0" data-status="On Leave">
                        <td><div class="employee-table-name"><span class="employee-avatar">HM</span><div><strong>Hodan Maxamed</strong><span>EMP-0005</span></div></div></td>
                        <td>Finance</td><td>Idaacada Branch</td><td>--</td><td>--</td><td>On Leave</td><td><span class="employee-status leave">On Leave</span></td>
                    </tr>
                    <tr data-employee="Mustafe Cabdi" data-number="EMP-0006" data-department="Information Technology" data-branch="Idaacada Branch" data-date="2026-04-24" data-check-in="08:07" data-check-out="17:01" data-work-hours="8.9" data-status="Late">
                        <td><div class="employee-table-name"><span class="employee-avatar">MC</span><div><strong>Mustafe Cabdi</strong><span>EMP-0006</span></div></div></td>
                        <td>Information Technology</td><td>Idaacada Branch</td><td>08:07 AM</td><td>05:01 PM</td><td>08h 54m</td><td><span class="employee-status late">Late</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span data-attendance-page-table-summary>Showing 1-4 of 6 records</span>
            <div class="employee-pagination" data-attendance-page-pagination></div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tablePanel = document.querySelector('[data-attendance-page-table]');
    if (!tablePanel) return;

    var table = tablePanel.querySelector('.employee-data-table');
    var tbody = table ? table.querySelector('tbody') : null;
    var summary = tablePanel.querySelector('[data-attendance-page-table-summary]');
    var pagination = tablePanel.querySelector('[data-attendance-page-pagination]');
    var filters = document.querySelectorAll('[data-attendance-page-filter]');

    if (!table || !tbody || !summary || !pagination) return;

    var pageSize = 4;
    var allRows = Array.from(tbody.querySelectorAll('tr'));
    var currentPage = 1;
    var sortKey = '';
    var sortDirection = 'asc';

    function getFilter(name) {
        var filter = document.querySelector('[data-attendance-page-filter="' + name + '"]');
        return filter ? filter.value.trim().toLowerCase() : '';
    }

    function getRowValue(row, key) {
        return (row.dataset[key] || '').trim();
    }

    function timeToMinutes(value) {
        if (!value) return 0;

        var parts = value.split(':');
        return ((Number(parts[0]) || 0) * 60) + (Number(parts[1]) || 0);
    }

    function filterRows() {
        var department = getFilter('department');
        var status = getFilter('status');
        var date = getFilter('date');
        var search = getFilter('search');

        return allRows.filter(function (row) {
            var matchesDepartment = !department || getRowValue(row, 'department').toLowerCase() === department;
            var matchesStatus = !status || getRowValue(row, 'status').toLowerCase() === status;
            var matchesDate = !date || getRowValue(row, 'date') === date;
            var searchText = (getRowValue(row, 'employee') + ' ' + getRowValue(row, 'number')).toLowerCase();
            var matchesSearch = !search || searchText.indexOf(search) !== -1;

            return matchesDepartment && matchesStatus && matchesDate && matchesSearch;
        });
    }

    function sortRows(rows) {
        if (!sortKey) return rows;

        return rows.slice().sort(function (a, b) {
            var aValue = getRowValue(a, sortKey);
            var bValue = getRowValue(b, sortKey);

            if (['checkIn', 'checkOut'].indexOf(sortKey) !== -1) {
                var aMinutes = timeToMinutes(aValue);
                var bMinutes = timeToMinutes(bValue);

                return sortDirection === 'asc'
                    ? aMinutes - bMinutes
                    : bMinutes - aMinutes;
            }

            if (sortKey === 'workHours') {
                return sortDirection === 'asc'
                    ? Number(aValue || 0) - Number(bValue || 0)
                    : Number(bValue || 0) - Number(aValue || 0);
            }

            return sortDirection === 'asc'
                ? aValue.localeCompare(bValue, undefined, { numeric: true })
                : bValue.localeCompare(aValue, undefined, { numeric: true });
        });
    }

    function renderPagination(totalPages) {
        pagination.innerHTML = '';

        var previousButton = document.createElement('button');
        previousButton.type = 'button';
        previousButton.textContent = '<';
        previousButton.disabled = currentPage === 1;
        previousButton.addEventListener('click', function () {
            currentPage -= 1;
            renderTable();
        });
        pagination.appendChild(previousButton);

        for (var page = 1; page <= totalPages; page += 1) {
            var button = document.createElement('button');
            button.type = 'button';
            button.textContent = page;
            button.classList.toggle('active', page === currentPage);
            button.addEventListener('click', function () {
                currentPage = Number(this.textContent);
                renderTable();
            });
            pagination.appendChild(button);
        }

        var nextButton = document.createElement('button');
        nextButton.type = 'button';
        nextButton.textContent = '>';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', function () {
            currentPage += 1;
            renderTable();
        });
        pagination.appendChild(nextButton);
    }

    function renderTable() {
        var rows = sortRows(filterRows());
        var totalPages = Math.max(1, Math.ceil(rows.length / pageSize));

        if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        var start = (currentPage - 1) * pageSize;
        var pageRows = rows.slice(start, start + pageSize);

        allRows.forEach(function (row) {
            row.style.display = 'none';
        });

        pageRows.forEach(function (row) {
            row.style.display = '';
            tbody.appendChild(row);
        });

        var showingStart = rows.length ? start + 1 : 0;
        summary.textContent = 'Showing ' + showingStart + '-' + Math.min(start + pageSize, rows.length) + ' of ' + rows.length + ' records';
        renderPagination(totalPages);
    }

    filters.forEach(function (filter) {
        filter.addEventListener('input', function () {
            currentPage = 1;
            renderTable();
        });
        filter.addEventListener('change', function () {
            currentPage = 1;
            renderTable();
        });
    });

    table.querySelectorAll('[data-attendance-page-sort-key]').forEach(function (button) {
        button.addEventListener('click', function () {
            var nextSortKey = button.dataset.attendancePageSortKey;

            if (sortKey === nextSortKey) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortKey = nextSortKey;
                sortDirection = 'asc';
            }

            currentPage = 1;
            renderTable();
        });
    });

    renderTable();
});
</script>

<?php
include '../../includes/footer.php';
?>
