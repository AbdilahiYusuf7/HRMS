<?php
$pageTitle = "Eligibility Reviews";
$activePage = "eligibility-reviews";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .eligibility-reviews-header {
        margin-bottom: 42px;
    }

    .eligibility-reviews-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .eligibility-reviews-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 1180px;
    }

    .eligibility-reviews-insights-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(280px, 1fr));
        gap: 24px;
    }

    .eligibility-reviews-insights-grid .employee-insight-card {
        min-height: 225px;
    }

    .eligibility-insight-ready {
        background-color: #d1fae5;
    }

    .eligibility-insight-ready .employee-insight-icon {
        background-color: rgba(16, 185, 129, 0.12);
        color: var(--success-hover);
    }

    .eligibility-insight-nearly {
        background-color: #bae6fd;
    }

    .eligibility-insight-nearly .employee-insight-icon {
        background-color: rgba(14, 165, 233, 0.12);
        color: #0284c7;
    }

    .eligibility-insight-qualification {
        background-color: #fecdd3;
    }

    .eligibility-insight-qualification .employee-insight-icon {
        background-color: rgba(239, 68, 68, 0.1);
        color: #e11d48;
    }

    .eligibility-insight-tenure {
        background-color: #fef3c7;
    }

    .eligibility-insight-tenure .employee-insight-icon {
        background-color: rgba(245, 158, 11, 0.14);
        color: var(--warning-hover);
    }

    .eligibility-insight-performance {
        background-color: #ede9fe;
    }

    .eligibility-insight-performance .employee-insight-icon {
        background-color: rgba(124, 58, 237, 0.1);
        color: #7c3aed;
    }

    .eligibility-analytics-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .eligibility-chart-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        min-height: 520px;
        overflow: hidden;
        padding: 28px;
    }

    .eligibility-chart-header {
        margin-bottom: 18px;
    }

    .eligibility-chart-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .eligibility-chart-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .eligibility-chart-svg {
        display: block;
        width: 100%;
        height: auto;
        overflow: visible;
    }

    .eligibility-chart-grid line {
        stroke: rgba(203, 213, 225, 0.78);
        stroke-width: 1;
    }

    .eligibility-chart-axis line {
        stroke: rgba(148, 163, 184, 0.72);
        stroke-width: 1.2;
    }

    .eligibility-chart-label {
        fill: #475569;
        font-size: 14px;
        font-weight: 700;
    }

    .eligibility-chart-label.department {
        font-size: 12px;
        text-anchor: middle;
    }

    .eligibility-chart-bar {
        fill: #7c7cf0;
        rx: 11;
        ry: 11;
        opacity: 0.94;
    }

    .eligibility-donut-segment {
        fill: none;
        stroke-width: 66;
    }

    .eligibility-chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px 24px;
        color: #475569;
        font-size: 0.9rem;
        font-weight: 800;
        margin-top: 12px;
    }

    .eligibility-chart-legend i {
        width: 14px;
        height: 14px;
        border-radius: var(--radius-full);
        display: inline-block;
        margin-right: 6px;
    }

    .eligibility-chart-legend span {
        display: inline-flex;
        align-items: center;
    }

    .eligibility-legend-qualification {
        background-color: #f85b78;
    }

    .eligibility-legend-tenure {
        background-color: #fbb12f;
    }

    .eligibility-legend-performance {
        background-color: #9568ef;
    }

    .eligibility-legend-review {
        background-color: #36b4e5;
    }

    .eligibility-filter-panel,
    .eligibility-review-table-section {
        margin-top: 32px;
    }

    .eligibility-filter-panel .employee-filter-grid {
        grid-template-columns: repeat(5, minmax(180px, 1fr));
    }

    .eligibility-review-table-section .employee-data-table {
        min-width: 1320px;
    }

    .eligibility-result {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 108px;
        padding: 7px 10px;
        font-size: 0.72rem;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
        white-space: normal;
    }

    .eligibility-result.eligible {
        background-color: var(--success-light);
        color: var(--success-hover);
    }

    .eligibility-result.nearly {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .eligibility-result.blocked {
        background-color: var(--warning-light);
        color: var(--warning-hover);
    }

    .eligibility-result.not-eligible {
        background-color: var(--danger-light);
        color: var(--danger-hover);
    }

    .eligibility-performance {
        font-weight: 900;
    }

    .eligibility-performance.high {
        color: var(--success-hover);
    }

    .eligibility-performance.medium {
        color: #1d4ed8;
    }

    .eligibility-performance.low {
        color: var(--danger-hover);
    }

    .eligibility-review-action {
        min-width: 86px;
        height: 38px;
        border: none;
        border-radius: var(--radius-sm);
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font: inherit;
        font-size: 0.78rem;
        font-weight: 900;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .eligibility-review-action:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .eligibility-review-action .material-symbols-rounded {
        font-size: 16px;
    }

    .eligibility-review-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .eligibility-review-modal.open {
        display: flex;
    }

    .eligibility-review-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .eligibility-review-dialog {
        position: relative;
        z-index: 1;
        width: min(1120px, 100%);
        max-height: min(820px, calc(100vh - 64px));
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .eligibility-review-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 32px 36px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .eligibility-review-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        margin-bottom: 8px;
    }

    .eligibility-review-modal-header p {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
    }

    .eligibility-review-close {
        width: 58px;
        height: 58px;
        border: none;
        border-radius: var(--radius-md);
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-fast);
        flex: 0 0 auto;
    }

    .eligibility-review-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .eligibility-review-modal-body {
        overflow: auto;
        padding: 36px;
        flex: 1 1 auto;
        max-height: calc(min(820px, calc(100vh - 64px)) - 124px);
    }

    .eligibility-review-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 20px;
    }

    .eligibility-review-detail-card {
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        padding: 22px;
        min-height: 104px;
    }

    .eligibility-review-detail-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .eligibility-review-detail-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.12rem;
        line-height: 1.3;
    }

    @media (max-width: 1180px) {
        .eligibility-reviews-insights-grid,
        .eligibility-analytics-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .eligibility-filter-panel .employee-filter-grid {
            grid-template-columns: repeat(3, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .eligibility-reviews-insights-grid,
        .eligibility-analytics-grid {
            grid-template-columns: 1fr;
        }

        .eligibility-filter-panel .employee-filter-grid {
            grid-template-columns: 1fr;
        }

        .eligibility-chart-panel {
            min-height: auto;
            padding: 22px;
        }

        .eligibility-review-modal {
            padding: 16px;
        }

        .eligibility-review-modal-header,
        .eligibility-review-modal-body {
            padding: 22px;
        }

        .eligibility-review-detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="eligibility-reviews-header">
    <h1>Eligibility Reviews</h1>
    <p>Track promotion readiness outcomes, blockers, qualification gaps, and next role recommendations across teams.</p>
</div>

<div class="eligibility-reviews-insights-grid">
    <div class="employee-insight-card eligibility-insight-ready">
        <div>
            <h3>Eligible Now</h3>
            <strong>2 Employees</strong>
            <p>Employees ready to move into promotion request routing.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">check_circle</span>
        </div>
    </div>

    <div class="employee-insight-card eligibility-insight-nearly">
        <div>
            <h3>Nearly Eligible</h3>
            <strong>2 Employees</strong>
            <p>Employees close to readiness with a small remaining gap.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">hourglass_top</span>
        </div>
    </div>

    <div class="employee-insight-card eligibility-insight-qualification">
        <div>
            <h3>Missing Qualification</h3>
            <strong>2 Employees</strong>
            <p>Employees blocked mainly by qualification evidence or credentials.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">school</span>
        </div>
    </div>

    <div class="employee-insight-card eligibility-insight-tenure">
        <div>
            <h3>Missing Tenure</h3>
            <strong>2 Employees</strong>
            <p>Employees who need more time in their current role.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">calendar_month</span>
        </div>
    </div>

    <div class="employee-insight-card eligibility-insight-performance">
        <div>
            <h3>Missing Performance</h3>
            <strong>2 Employees</strong>
            <p>Employees below the current promotion performance threshold.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">stacked_line_chart</span>
        </div>
    </div>
</div>

<div class="eligibility-analytics-grid">
    <section class="eligibility-chart-panel">
        <div class="eligibility-chart-header">
            <h2>Eligibility by Department</h2>
            <p>Current review outcomes grouped by department.</p>
        </div>

        <svg class="eligibility-chart-svg" viewBox="0 0 620 370" role="img" aria-label="Eligibility by department bar chart">
            <defs>
                <linearGradient id="eligibilityBarFill" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#6d79f5"></stop>
                    <stop offset="100%" stop-color="#8b7cf6"></stop>
                </linearGradient>
            </defs>
            <g class="eligibility-chart-grid">
                <line x1="64" y1="48" x2="590" y2="48"></line>
                <line x1="64" y1="152" x2="590" y2="152"></line>
                <line x1="64" y1="256" x2="590" y2="256"></line>
            </g>
            <g class="eligibility-chart-axis">
                <line x1="64" y1="48" x2="64" y2="256"></line>
                <line x1="64" y1="256" x2="590" y2="256"></line>
            </g>
            <g>
                <text class="eligibility-chart-label" x="36" y="52">2</text>
                <text class="eligibility-chart-label" x="36" y="156">1</text>
                <text class="eligibility-chart-label" x="36" y="260">0</text>
            </g>
            <g>
                <rect class="eligibility-chart-bar" x="82" y="48" width="58" height="208" fill="url(#eligibilityBarFill)" data-chart-title="Operations" data-chart-value="2 employees ready or nearly ready"></rect>
                <rect class="eligibility-chart-bar" x="172" y="128" width="58" height="128" fill="url(#eligibilityBarFill)" data-chart-title="Finance" data-chart-value="1 employee ready for review"></rect>
                <rect class="eligibility-chart-bar" x="262" y="92" width="58" height="164" fill="url(#eligibilityBarFill)" data-chart-title="Human Resource" data-chart-value="1 qualification gap and 1 readiness review"></rect>
                <rect class="eligibility-chart-bar" x="352" y="176" width="58" height="80" fill="url(#eligibilityBarFill)" data-chart-title="Administration" data-chart-value="1 tenure gap"></rect>
                <rect class="eligibility-chart-bar" x="442" y="150" width="58" height="106" fill="url(#eligibilityBarFill)" data-chart-title="Marketing" data-chart-value="1 performance threshold gap"></rect>
                <rect class="eligibility-chart-bar" x="532" y="112" width="58" height="144" fill="url(#eligibilityBarFill)" data-chart-title="Information Technology" data-chart-value="1 qualification gap and 1 nearly eligible employee"></rect>
            </g>
            <g>
                <text class="eligibility-chart-label department" x="111" y="302" transform="rotate(-20 111 302)">Operations</text>
                <text class="eligibility-chart-label department" x="201" y="302" transform="rotate(-20 201 302)">Finance</text>
                <text class="eligibility-chart-label department" x="291" y="302" transform="rotate(-20 291 302)">Human Resource</text>
                <text class="eligibility-chart-label department" x="381" y="302" transform="rotate(-20 381 302)">Administration</text>
                <text class="eligibility-chart-label department" x="471" y="302" transform="rotate(-20 471 302)">Marketing</text>
                <text class="eligibility-chart-label department" x="561" y="302" transform="rotate(-20 561 302)">Information Technology</text>
            </g>
        </svg>
    </section>

    <section class="eligibility-chart-panel">
        <div class="eligibility-chart-header">
            <h2>Block Reason Breakdown</h2>
            <p>Main reasons employees are not promotion-ready yet.</p>
        </div>

        <svg class="eligibility-chart-svg" viewBox="0 0 620 370" role="img" aria-label="Block reason breakdown donut chart">
            <g transform="translate(310 176)">
                <circle class="eligibility-donut-segment" r="112" stroke="#f85b78" stroke-dasharray="176 528" stroke-dashoffset="0" transform="rotate(-90)" data-chart-title="Qualification Gap" data-chart-value="2 employees need qualification evidence"></circle>
                <circle class="eligibility-donut-segment" r="112" stroke="#fbb12f" stroke-dasharray="176 528" stroke-dashoffset="-176" transform="rotate(-90)" data-chart-title="Tenure Gap" data-chart-value="2 employees need more time in role"></circle>
                <circle class="eligibility-donut-segment" r="112" stroke="#9568ef" stroke-dasharray="176 528" stroke-dashoffset="-352" transform="rotate(-90)" data-chart-title="Performance Threshold" data-chart-value="2 employees below the current threshold"></circle>
                <circle class="eligibility-donut-segment" r="112" stroke="#36b4e5" stroke-dasharray="176 528" stroke-dashoffset="-528" transform="rotate(-90)" data-chart-title="Readiness Review" data-chart-value="2 employees need review follow-up"></circle>
                <circle r="78" fill="rgba(255, 255, 255, 0.96)"></circle>
            </g>
        </svg>

        <div class="eligibility-chart-legend">
            <span><i class="eligibility-legend-qualification"></i>Qualification Gap</span>
            <span><i class="eligibility-legend-tenure"></i>Tenure Gap</span>
            <span><i class="eligibility-legend-performance"></i>Performance Threshold</span>
            <span><i class="eligibility-legend-review"></i>Readiness Review</span>
        </div>
    </section>
</div>

<section class="employee-filter-panel eligibility-filter-panel">
    <div class="employee-filter-grid">
        <label>
            <span>Department</span>
            <select class="form-control" data-eligibility-filter="department">
                <option value="">All Departments</option>
                <option value="Operations">Operations</option>
                <option value="Finance">Finance</option>
                <option value="Human Resource">Human Resource</option>
                <option value="Administration">Administration</option>
                <option value="Marketing">Marketing</option>
                <option value="Information Technology">Information Technology</option>
            </select>
        </label>

        <label>
            <span>Role</span>
            <select class="form-control" data-eligibility-filter="role">
                <option value="">All Roles</option>
                <option value="Officer">Officer</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Coordinator">Coordinator</option>
                <option value="Analyst">Analyst</option>
                <option value="Engineer">Engineer</option>
            </select>
        </label>

        <label>
            <span>Rank</span>
            <select class="form-control" data-eligibility-filter="rank">
                <option value="">All Ranks</option>
                <option value="Rank I">Rank I</option>
                <option value="Rank II">Rank II</option>
                <option value="Rank III">Rank III</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Senior Analyst">Senior Analyst</option>
            </select>
        </label>

        <label>
            <span>Eligibility Status</span>
            <select class="form-control" data-eligibility-filter="eligibility">
                <option value="">All</option>
                <option value="Eligible">Eligible</option>
                <option value="Nearly Eligible">Nearly Eligible</option>
                <option value="Blocked">Blocked</option>
                <option value="Not Eligible">Not Eligible</option>
            </select>
        </label>

        <label>
            <span>Qualification Status</span>
            <select class="form-control" data-eligibility-filter="qualification">
                <option value="">All</option>
                <option value="Verified">Verified</option>
                <option value="Pending Evidence">Pending Evidence</option>
                <option value="Missing">Missing</option>
            </select>
        </label>

        <label>
            <span>Training Completion</span>
            <select class="form-control" data-eligibility-filter="training">
                <option value="">All</option>
                <option value="Complete">Complete</option>
                <option value="In Progress">In Progress</option>
                <option value="Not Started">Not Started</option>
            </select>
        </label>

        <label>
            <span>Performance Range</span>
            <select class="form-control" data-eligibility-filter="performance">
                <option value="">All</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </label>
    </div>
</section>

<section class="employee-records-section eligibility-review-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Eligibility Review Queue</h2>
            <p>Operational table for readiness results, missing requirements, and suggested next role.</p>
        </div>
    </div>

    <div class="employee-table-panel" data-eligibility-review-table>
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button" data-eligibility-sort-key="employee">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-eligibility-sort-key="role">Current Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-eligibility-sort-key="rank">Rank <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-eligibility-sort-key="eligibility">Eligibility Result <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-eligibility-sort-key="missing">Missing Requirement <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-eligibility-sort-key="nextRole">Suggested Next Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-eligibility-sort-key="time">Estimated Time <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-employee="Amina Xasan" data-number="EMP-0001" data-department="Operations" data-role="Senior Officer" data-role-group="Officer" data-rank="Rank II" data-eligibility="Eligible" data-qualification="Verified" data-training="Complete" data-performance="High" data-missing="None" data-next-role="Branch Operations Supervisor" data-time="Ready">
                        <td><div class="employee-table-name"><span class="employee-avatar">AX</span><div><strong>Amina Xasan</strong><span>EMP-0001 · Operations</span></div></div></td>
                        <td>Senior Officer</td>
                        <td>Rank II</td>
                        <td><span class="eligibility-result eligible">Eligible</span></td>
                        <td>None</td>
                        <td>Branch Operations Supervisor</td>
                        <td>Ready</td>
                        <td><button type="button" class="eligibility-review-action" data-eligibility-review-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Fadumo Xasan" data-number="EMP-0002" data-department="Finance" data-role="Finance Officer" data-role-group="Officer" data-rank="Rank III" data-eligibility="Eligible" data-qualification="Verified" data-training="Complete" data-performance="High" data-missing="None" data-next-role="Finance Lead" data-time="Ready">
                        <td><div class="employee-table-name"><span class="employee-avatar">FX</span><div><strong>Fadumo Xasan</strong><span>EMP-0002 · Finance</span></div></div></td>
                        <td>Finance Officer</td>
                        <td>Rank III</td>
                        <td><span class="eligibility-result eligible">Eligible</span></td>
                        <td>None</td>
                        <td>Finance Lead</td>
                        <td>Ready</td>
                        <td><button type="button" class="eligibility-review-action" data-eligibility-review-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Mustafe Cabdi" data-number="EMP-0006" data-department="Information Technology" data-role="Systems Analyst" data-role-group="Analyst" data-rank="Senior Analyst" data-eligibility="Nearly Eligible" data-qualification="Pending Evidence" data-training="Complete" data-performance="High" data-missing="Certification evidence" data-next-role="Senior Systems Analyst" data-time="30 Days">
                        <td><div class="employee-table-name"><span class="employee-avatar">MC</span><div><strong>Mustafe Cabdi</strong><span>EMP-0006 · Information Technology</span></div></div></td>
                        <td>Systems Analyst</td>
                        <td>Senior Analyst</td>
                        <td><span class="eligibility-result nearly">Nearly Eligible</span></td>
                        <td>Certification evidence</td>
                        <td>Senior Systems Analyst</td>
                        <td>30 Days</td>
                        <td><button type="button" class="eligibility-review-action" data-eligibility-review-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Sahra Maxamed" data-number="EMP-0004" data-department="Marketing" data-role="Marketing Coordinator" data-role-group="Coordinator" data-rank="Rank I" data-eligibility="Blocked" data-qualification="Verified" data-training="In Progress" data-performance="Low" data-missing="Performance threshold" data-next-role="Senior Coordinator" data-time="90 Days">
                        <td><div class="employee-table-name"><span class="employee-avatar">SM</span><div><strong>Sahra Maxamed</strong><span>EMP-0004 · Marketing</span></div></div></td>
                        <td>Marketing Coordinator</td>
                        <td>Rank I</td>
                        <td><span class="eligibility-result blocked">Blocked</span></td>
                        <td>Performance threshold</td>
                        <td>Senior Coordinator</td>
                        <td>90 Days</td>
                        <td><button type="button" class="eligibility-review-action" data-eligibility-review-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Hodan Cali" data-number="EMP-0005" data-department="Administration" data-role="Admin Officer" data-role-group="Officer" data-rank="Rank II" data-eligibility="Blocked" data-qualification="Verified" data-training="Complete" data-performance="Medium" data-missing="Tenure gap" data-next-role="Administration Lead" data-time="60 Days">
                        <td><div class="employee-table-name"><span class="employee-avatar">HC</span><div><strong>Hodan Cali</strong><span>EMP-0005 · Administration</span></div></div></td>
                        <td>Admin Officer</td>
                        <td>Rank II</td>
                        <td><span class="eligibility-result blocked">Blocked</span></td>
                        <td>Tenure gap</td>
                        <td>Administration Lead</td>
                        <td>60 Days</td>
                        <td><button type="button" class="eligibility-review-action" data-eligibility-review-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Roda Jama" data-number="EMP-0007" data-department="Human Resource" data-role="Talent Officer" data-role-group="Officer" data-rank="Rank II" data-eligibility="Not Eligible" data-qualification="Missing" data-training="Not Started" data-performance="Medium" data-missing="Qualification gap" data-next-role="HR Business Partner" data-time="120 Days">
                        <td><div class="employee-table-name"><span class="employee-avatar">RJ</span><div><strong>Roda Jama</strong><span>EMP-0007 · Human Resource</span></div></div></td>
                        <td>Talent Officer</td>
                        <td>Rank II</td>
                        <td><span class="eligibility-result not-eligible">Not Eligible</span></td>
                        <td>Qualification gap</td>
                        <td>HR Business Partner</td>
                        <td>120 Days</td>
                        <td><button type="button" class="eligibility-review-action" data-eligibility-review-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="employee-table-footer">
            <span data-eligibility-review-summary>Showing 1-4 of 6 reviews</span>
            <div class="employee-pagination" data-eligibility-review-pagination></div>
        </div>
    </div>
</section>

<div class="eligibility-review-modal" id="eligibilityReviewDetailModal" aria-hidden="true">
    <div class="eligibility-review-backdrop" data-eligibility-review-close></div>
    <section class="eligibility-review-dialog" role="dialog" aria-modal="true" aria-labelledby="eligibilityReviewDetailTitle">
        <div class="eligibility-review-modal-header">
            <div>
                <h2 id="eligibilityReviewDetailTitle">Eligibility Review</h2>
                <p>Eligibility review detail</p>
            </div>
            <button type="button" class="eligibility-review-close" data-eligibility-review-close aria-label="Close eligibility review detail">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="eligibility-review-modal-body">
            <div class="eligibility-review-detail-grid">
                <article class="eligibility-review-detail-card">
                    <span>Employee ID</span>
                    <strong data-eligibility-detail-number></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Department</span>
                    <strong data-eligibility-detail-department></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Current Role</span>
                    <strong data-eligibility-detail-role></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Rank</span>
                    <strong data-eligibility-detail-rank></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Eligibility Result</span>
                    <strong data-eligibility-detail-result></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Missing Requirement</span>
                    <strong data-eligibility-detail-missing></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Suggested Next Role</span>
                    <strong data-eligibility-detail-next-role></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Estimated Time</span>
                    <strong data-eligibility-detail-time></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Qualification Status</span>
                    <strong data-eligibility-detail-qualification></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Training Completion</span>
                    <strong data-eligibility-detail-training></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Performance Range</span>
                    <strong data-eligibility-detail-performance></strong>
                </article>
                <article class="eligibility-review-detail-card">
                    <span>Block Reason</span>
                    <strong data-eligibility-detail-block></strong>
                </article>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var panel = document.querySelector('[data-eligibility-review-table]');
    if (!panel) return;

    var table = panel.querySelector('.employee-data-table');
    var tbody = table ? table.querySelector('tbody') : null;
    var summary = panel.querySelector('[data-eligibility-review-summary]');
    var pagination = panel.querySelector('[data-eligibility-review-pagination]');
    var filters = document.querySelectorAll('[data-eligibility-filter]');
    var modal = document.getElementById('eligibilityReviewDetailModal');
    var modalTitle = document.getElementById('eligibilityReviewDetailTitle');
    var modalFields = modal ? {
        number: modal.querySelector('[data-eligibility-detail-number]'),
        department: modal.querySelector('[data-eligibility-detail-department]'),
        role: modal.querySelector('[data-eligibility-detail-role]'),
        rank: modal.querySelector('[data-eligibility-detail-rank]'),
        result: modal.querySelector('[data-eligibility-detail-result]'),
        missing: modal.querySelector('[data-eligibility-detail-missing]'),
        nextRole: modal.querySelector('[data-eligibility-detail-next-role]'),
        time: modal.querySelector('[data-eligibility-detail-time]'),
        qualification: modal.querySelector('[data-eligibility-detail-qualification]'),
        training: modal.querySelector('[data-eligibility-detail-training]'),
        performance: modal.querySelector('[data-eligibility-detail-performance]'),
        block: modal.querySelector('[data-eligibility-detail-block]')
    } : {};

    if (!table || !tbody || !summary || !pagination) return;

    var pageSize = 4;
    var allRows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
    var currentPage = 1;
    var sortKey = '';
    var sortDirection = 'asc';

    function getFilterValue(name) {
        var filter = document.querySelector('[data-eligibility-filter="' + name + '"]');
        return filter ? filter.value.trim().toLowerCase() : '';
    }

    function getRowValue(row, key) {
        return (row.dataset[key] || '').trim();
    }

    function setModalField(field, value) {
        if (field) {
            field.textContent = value || '--';
        }
    }

    function openReviewModal(row) {
        if (!modal || !row) return;

        if (modalTitle) {
            modalTitle.textContent = getRowValue(row, 'employee') || 'Eligibility Review';
        }

        setModalField(modalFields.number, getRowValue(row, 'number'));
        setModalField(modalFields.department, getRowValue(row, 'department'));
        setModalField(modalFields.role, getRowValue(row, 'role'));
        setModalField(modalFields.rank, getRowValue(row, 'rank'));
        setModalField(modalFields.result, getRowValue(row, 'eligibility') === 'Eligible' ? 'Eligible Now' : getRowValue(row, 'eligibility'));
        setModalField(modalFields.missing, getRowValue(row, 'missing'));
        setModalField(modalFields.nextRole, getRowValue(row, 'nextRole'));
        setModalField(modalFields.time, getRowValue(row, 'time') === 'Ready' ? 'Ready now' : getRowValue(row, 'time'));
        setModalField(modalFields.qualification, getRowValue(row, 'qualification') === 'Verified' ? 'Complete' : getRowValue(row, 'qualification'));
        setModalField(modalFields.training, getRowValue(row, 'training') === 'Complete' ? 'Completed' : getRowValue(row, 'training'));
        setModalField(modalFields.performance, getRowValue(row, 'performance'));
        setModalField(modalFields.block, getRowValue(row, 'missing') === 'None' ? 'None' : getRowValue(row, 'missing'));

        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeReviewModal() {
        if (!modal) return;

        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function getFilteredRows() {
        var department = getFilterValue('department');
        var role = getFilterValue('role');
        var rank = getFilterValue('rank');
        var eligibility = getFilterValue('eligibility');
        var qualification = getFilterValue('qualification');
        var training = getFilterValue('training');
        var performance = getFilterValue('performance');

        return allRows.filter(function (row) {
            return (!department || getRowValue(row, 'department').toLowerCase() === department)
                && (!role || getRowValue(row, 'roleGroup').toLowerCase() === role)
                && (!rank || getRowValue(row, 'rank').toLowerCase() === rank)
                && (!eligibility || getRowValue(row, 'eligibility').toLowerCase() === eligibility)
                && (!qualification || getRowValue(row, 'qualification').toLowerCase() === qualification)
                && (!training || getRowValue(row, 'training').toLowerCase() === training)
                && (!performance || getRowValue(row, 'performance').toLowerCase() === performance);
        });
    }

    function sortRows(rows) {
        if (!sortKey) return rows;

        return rows.slice().sort(function (a, b) {
            var aValue = getRowValue(a, sortKey);
            var bValue = getRowValue(b, sortKey);

            return sortDirection === 'asc'
                ? aValue.localeCompare(bValue)
                : bValue.localeCompare(aValue);
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
            render();
        });
        pagination.appendChild(previousButton);

        for (var page = 1; page <= totalPages; page += 1) {
            var button = document.createElement('button');
            button.type = 'button';
            button.textContent = page;
            button.classList.toggle('active', page === currentPage);
            button.addEventListener('click', function () {
                currentPage = Number(this.textContent);
                render();
            });
            pagination.appendChild(button);
        }

        var nextButton = document.createElement('button');
        nextButton.type = 'button';
        nextButton.textContent = '>';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', function () {
            currentPage += 1;
            render();
        });
        pagination.appendChild(nextButton);
    }

    function render() {
        var filteredRows = sortRows(getFilteredRows());
        var totalPages = Math.max(1, Math.ceil(filteredRows.length / pageSize));

        if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        var start = (currentPage - 1) * pageSize;
        var pageRows = filteredRows.slice(start, start + pageSize);

        allRows.forEach(function (row) {
            row.style.display = 'none';
        });

        pageRows.forEach(function (row) {
            row.style.display = '';
            tbody.appendChild(row);
        });

        var from = filteredRows.length ? start + 1 : 0;
        var to = Math.min(start + pageSize, filteredRows.length);
        summary.textContent = 'Showing ' + from + '-' + to + ' of ' + filteredRows.length + ' reviews';
        renderPagination(totalPages);
    }

    table.querySelectorAll('[data-eligibility-sort-key]').forEach(function (button) {
        button.addEventListener('click', function () {
            var nextSortKey = button.dataset.eligibilitySortKey;

            if (sortKey === nextSortKey) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortKey = nextSortKey;
                sortDirection = 'asc';
            }

            currentPage = 1;
            render();
        });
    });

    filters.forEach(function (filter) {
        filter.addEventListener('input', function () {
            currentPage = 1;
            render();
        });

        filter.addEventListener('change', function () {
            currentPage = 1;
            render();
        });
    });

    table.addEventListener('click', function (event) {
        var viewButton = event.target.closest('[data-eligibility-review-view]');
        if (viewButton) {
            openReviewModal(viewButton.closest('tr'));
        }
    });

    if (modal) {
        modal.querySelectorAll('[data-eligibility-review-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeReviewModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('open')) {
                closeReviewModal();
            }
        });
    }

    render();
});
</script>

<?php include '../../includes/footer.php'; ?>
