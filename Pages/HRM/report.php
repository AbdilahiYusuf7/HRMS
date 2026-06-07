<?php
$pageTitle = "Report";
$activePage = "report";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .report-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(4, minmax(220px, 1fr));
    }

    .report-card {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        min-height: 610px;
        padding: 30px;
    }

    .report-icon {
        align-items: center;
        background-color: var(--primary-light);
        border-radius: var(--radius-md);
        color: var(--primary-color);
        display: inline-flex;
        height: 58px;
        justify-content: center;
        margin-bottom: 42px;
        width: 58px;
    }

    .report-icon .material-symbols-rounded {
        font-size: 27px;
        font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 24;
    }

    .report-card.performance .report-icon {
        background-color: var(--secondary-light);
        color: var(--primary-color);
    }

    .report-card.payroll .report-icon {
        background-color: var(--warning-light);
        color: var(--warning-hover);
    }

    .report-card.management .report-icon {
        background-color: var(--success-light);
        color: var(--success-hover);
    }

    .report-card h2 {
        color: var(--neutral-darkest);
        font-size: 1.36rem;
        line-height: 1.2;
        margin-bottom: 26px;
    }

    .report-list {
        display: grid;
        gap: 14px;
    }

    .report-link {
        align-items: center;
        background-color: var(--primary-light);
        border: 1px solid transparent;
        border-radius: var(--radius-sm);
        color: var(--neutral-darkest);
        display: flex;
        font-size: 0.96rem;
        font-weight: 800;
        min-height: 62px;
        padding: 0 24px;
        text-decoration: none;
        transition: var(--transition-fast);
    }

    .report-link:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        color: var(--neutral-white);
        transform: translateY(-1px);
    }

    .report-document {
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        display: none;
        margin-top: 32px;
        padding: 36px;
    }

    .report-document.open {
        display: block;
    }

    .report-document-header {
        align-items: flex-start;
        border-bottom: 2px solid var(--neutral-border);
        display: flex;
        gap: 24px;
        justify-content: space-between;
        padding-bottom: 28px;
    }

    .report-document-title h1 {
        color: var(--neutral-darkest);
        font-size: 2rem;
        line-height: 1.15;
        margin-bottom: 10px;
    }

    .report-document-brand {
        align-items: flex-start;
        display: flex;
        gap: 18px;
    }

    .report-logo-placeholder {
        align-items: center;
        background-color: var(--primary-light);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-sm);
        color: var(--primary-color);
        display: inline-flex;
        flex: 0 0 auto;
        font-size: 0.8rem;
        font-weight: 900;
        height: 72px;
        justify-content: center;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        width: 72px;
    }

    .report-document-title p,
    .report-document-meta p,
    .report-document-note {
        color: #475569;
        font-size: 1.02rem;
        font-weight: 500;
        line-height: 1.45;
    }

    .report-document-meta {
        min-width: 320px;
        text-align: right;
    }

    .report-document-meta strong {
        color: var(--neutral-dark);
        font-weight: 900;
    }

    .report-document-stats {
        display: grid;
        gap: 18px;
        grid-template-columns: repeat(3, minmax(180px, 1fr));
        margin: 28px 0;
    }

    .report-document-stat {
        background-color: var(--primary-light);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-sm);
        padding: 20px;
    }

    .report-document-stat span {
        color: var(--neutral-darkest);
        display: block;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .report-document-stat strong {
        color: var(--neutral-darkest);
        display: block;
        font-size: 1.36rem;
        line-height: 1.2;
    }

    .report-document-table-wrap {
        overflow-x: auto;
    }

    .report-document-table {
        border-collapse: collapse;
        min-width: 980px;
        width: 100%;
    }

    .report-document-table th,
    .report-document-table td {
        border: 1px solid #d8e2ee;
        color: var(--neutral-darkest);
        padding: 16px 18px;
        text-align: left;
    }

    .report-document-table th {
        background-color: var(--primary-light);
        color: var(--neutral-dark);
        font-size: 0.92rem;
        font-weight: 900;
    }

    .report-document-table td {
        font-size: 0.98rem;
    }

    .report-document-note {
        margin-top: 26px;
    }

    .report-document-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    .report-document-actions button {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-sm);
        cursor: pointer;
        font: inherit;
        font-size: 0.96rem;
        font-weight: 700;
        min-width: 150px;
        padding: 13px 20px;
        transition: var(--transition-fast);
    }

    .report-print-button {
        background-color: var(--primary-color);
        color: var(--neutral-white);
    }

    .report-print-button:hover {
        background-color: var(--secondary-color);
    }

    .report-close-button {
        background-color: var(--neutral-white);
        color: var(--neutral-dark);
    }

    .report-close-button:hover {
        border-color: var(--secondary-color);
        color: var(--primary-color);
    }

    @media (max-width: 1100px) {
        .report-grid {
            grid-template-columns: repeat(2, minmax(260px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .report-grid {
            grid-template-columns: 1fr;
        }

        .report-card {
            min-height: auto;
        }

        .report-document-header {
            flex-direction: column;
        }

        .report-document-brand {
            flex-direction: column;
        }

        .report-document-meta {
            min-width: 0;
            text-align: left;
        }

        .report-document-stats {
            grid-template-columns: 1fr;
        }
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 14mm 13mm;
        }

        html,
        body {
            background: #fff !important;
            margin: 0 !important;
            padding: 0 !important;
            zoom: 100%;
        }

        body * {
            visibility: hidden !important;
        }

        .report-document,
        .report-document * {
            visibility: visible !important;
        }

        .report-document {
            border: none;
            border-radius: 0;
            box-shadow: none;
            display: block;
            margin: 0;
            padding: 0;
            position: fixed;
            inset: 0;
            width: 100%;
            z-index: 99999;
        }

        .report-logo-placeholder {
            display: none;
        }

        .report-document-header {
            align-items: flex-start;
            border-bottom: 2px solid #d8e2ee;
            display: flex;
            flex-direction: row;
            gap: 18px;
            justify-content: space-between;
            padding-bottom: 16px;
        }

        .report-document-brand {
            display: block;
        }

        .report-document-title h1 {
            font-size: 18pt;
            margin-bottom: 5px;
        }

        .report-document-title p,
        .report-document-meta p,
        .report-document-note {
            font-size: 10pt;
            line-height: 1.35;
        }

        .report-document-meta {
            min-width: 210px;
            text-align: right;
        }

        .report-document-stats {
            display: grid;
            gap: 8px;
            grid-template-columns: repeat(3, 1fr);
            margin: 16px 0 14px;
        }

        .report-document-stat {
            background-color: #f3f7fb !important;
            border: 1px solid #d8e2ee;
            border-radius: 7px;
            padding: 10px 12px;
        }

        .report-document-stat span {
            font-size: 9pt;
            margin-bottom: 4px;
        }

        .report-document-stat strong {
            font-size: 14pt;
        }

        .report-document-table {
            min-width: 0;
            width: 100%;
        }

        .report-document-table th,
        .report-document-table td {
            border: 1px solid #d8e2ee;
            font-size: 8.2pt;
            line-height: 1.25;
            padding: 8px 9px;
        }

        .report-document-table th {
            background-color: #eef4fa !important;
            font-size: 8.4pt;
        }

        .report-document-note {
            margin-top: 14px;
        }

        .report-document-actions {
            display: none;
        }

        .report-grid {
            display: none;
        }
    }
</style>

<section class="report-grid" aria-label="HRM reports">
    <article class="report-card employee">
        <div class="report-icon">
            <span class="material-symbols-rounded">person</span>
        </div>
        <h2>Employee</h2>
        <div class="report-list">
            <a href="#report-document" class="report-link" data-report-key="employee-info">Employee Info</a>
            <a href="#report-document" class="report-link" data-report-key="attendance-reports">Attendance Reports</a>
            <a href="#report-document" class="report-link" data-report-key="leave-reports">Leave Reports</a>
            <a href="#report-document" class="report-link" data-report-key="retirement-reports">Retirement Reports</a>
            <a href="#report-document" class="report-link" data-report-key="training-reports">Training Reports</a>
            <a href="#report-document" class="report-link" data-report-key="employee-ranking">Employee Ranking</a>
        </div>
    </article>

    <article class="report-card performance">
        <div class="report-icon">
            <span class="material-symbols-rounded">monitoring</span>
        </div>
        <h2>Performance</h2>
        <div class="report-list">
            <a href="#report-document" class="report-link" data-report-key="agenda-reports">Agenda Reports</a>
            <a href="#report-document" class="report-link" data-report-key="employee-review-reports">Employee Review Reports</a>
            <a href="#report-document" class="report-link" data-report-key="top-performers">Top Performers</a>
            <a href="#report-document" class="report-link" data-report-key="need-improvement">Need Improvement</a>
            <a href="#report-document" class="report-link" data-report-key="promotion-requests">Promotion Requests</a>
            <a href="#report-document" class="report-link" data-report-key="promotion-history">Promotion History</a>
        </div>
    </article>

    <article class="report-card payroll">
        <div class="report-icon">
            <span class="material-symbols-rounded">request_quote</span>
        </div>
        <h2>Payroll</h2>
        <div class="report-list">
            <a href="#report-document" class="report-link" data-report-key="salary-reports">Salary Reports</a>
            <a href="#report-document" class="report-link" data-report-key="paid-payroll">Paid Payroll</a>
            <a href="#report-document" class="report-link" data-report-key="total-deductions">Total Deductions</a>
            <a href="#report-document" class="report-link" data-report-key="absence-deductions">Absence Deductions</a>
            <a href="#report-document" class="report-link" data-report-key="performance-deductions">Performance Deductions</a>
            <a href="#report-document" class="report-link" data-report-key="outstanding-payroll">Outstanding Payroll</a>
        </div>
    </article>

    <article class="report-card management">
        <div class="report-icon">
            <span class="material-symbols-rounded">account_balance</span>
        </div>
        <h2>Management</h2>
        <div class="report-list">
            <a href="#report-document" class="report-link" data-report-key="dashboard-summary">Dashboard Summary</a>
            <a href="#report-document" class="report-link" data-report-key="branch-attendance">Branch Attendance</a>
            <a href="#report-document" class="report-link" data-report-key="training-summary">Training Summary</a>
            <a href="#report-document" class="report-link" data-report-key="leave-summary">Leave Summary</a>
            <a href="#report-document" class="report-link" data-report-key="retirement-summary">Retirement Summary</a>
            <a href="#report-document" class="report-link" data-report-key="promotion-summary">Promotion Summary</a>
        </div>
    </article>
</section>

<section class="report-document" id="report-document" aria-live="polite">
    <div class="report-document-header">
        <div class="report-document-brand">
            <div class="report-logo-placeholder">Logo</div>
            <div class="report-document-title">
                <h1 data-report-title>Employee Info</h1>
                <p data-report-description>Employee report sample generated from HRMS modules.</p>
            </div>
        </div>
        <div class="report-document-meta">
            <p><strong>Generated:</strong> <span data-report-generated>May 1, 2026</span></p>
            <p><strong>Branch:</strong> <span data-report-branch>All Hargeisa Branches</span></p>
            <p><strong>Module:</strong> <span data-report-module>Employee</span></p>
        </div>
    </div>

    <div class="report-document-stats" data-report-stats></div>

    <div class="report-document-table-wrap">
        <table class="report-document-table">
            <thead data-report-table-head></thead>
            <tbody data-report-table-body></tbody>
        </table>
    </div>

    <p class="report-document-note" data-report-note>This is sample report data for UI testing.</p>

    <div class="report-document-actions">
        <button type="button" class="report-print-button" data-report-print>Print Document</button>
        <button type="button" class="report-close-button" data-report-close>Close</button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var reportDocument = document.getElementById('report-document');
    var title = document.querySelector('[data-report-title]');
    var description = document.querySelector('[data-report-description]');
    var generated = document.querySelector('[data-report-generated]');
    var branch = document.querySelector('[data-report-branch]');
    var module = document.querySelector('[data-report-module]');
    var stats = document.querySelector('[data-report-stats]');
    var tableHead = document.querySelector('[data-report-table-head]');
    var tableBody = document.querySelector('[data-report-table-body]');
    var note = document.querySelector('[data-report-note]');
    var printButton = document.querySelector('[data-report-print]');
    var closeButton = document.querySelector('[data-report-close]');

    function employeeReport(titleText, metrics, rows) {
        return {
            title: titleText,
            module: 'Employee',
            description: 'Employee report sample generated from HRMS modules.',
            stats: metrics,
            columns: ['#', 'Employee', 'Branch', 'Department', 'Designation', 'Status'],
            rows: rows,
            note: 'This is sample employee report data for UI testing.'
        };
    }

    function performanceReport(titleText, metrics, rows) {
        return {
            title: titleText,
            module: 'Performance',
            description: 'Performance report sample generated from agenda and review records.',
            stats: metrics,
            columns: ['#', 'Employee', 'Department', 'Agenda', 'Score', 'Status'],
            rows: rows,
            note: 'This is sample performance report data for UI testing.'
        };
    }

    function payrollReport(titleText, metrics, rows) {
        return {
            title: titleText,
            module: 'Payroll',
            description: 'Payroll report sample generated from salary and deduction records.',
            stats: metrics,
            columns: ['#', 'Employee', 'Branch', 'Original Salary', 'Deduction', 'Net Salary'],
            rows: rows,
            note: 'This is sample payroll report data for UI testing.'
        };
    }

    function managementReport(titleText, metrics, rows) {
        return {
            title: titleText,
            module: 'Management',
            description: 'Management report sample generated from HRMS operational modules.',
            stats: metrics,
            columns: ['#', 'Area', 'Branch', 'Metric', 'Value', 'Status'],
            rows: rows,
            note: 'This is sample management report data for UI testing.'
        };
    }

    var employeeRows = [
        ['1', 'Cabdiraxmaan Cali (EMP-0001)', 'Idaacada Branch', 'Human Resource', 'Human Resource Director', 'Active'],
        ['2', 'Fadumo Xasan (EMP-0002)', 'Xero Awr Branch', 'Finance', 'Finance Officer', 'On Leave'],
        ['3', 'Mahad Axmed (EMP-0003)', 'Togdheer Branch', 'Operations', 'Operations Supervisor', 'Active'],
        ['4', 'Sahra Maxamed (EMP-0004)', 'Calaamada Branch', 'Marketing', 'Marketing Coordinator', 'Inactive']
    ];

    var reports = {
        'employee-info': employeeReport('Employee Info', [['Total Employees', '1,420'], ['Active Employees', '1,284'], ['On Leave Employees', '46']], employeeRows),
        'attendance-reports': employeeReport('Attendance Reports', [['Present Today', '1,187'], ['Late Arrivals', '34'], ['Absent Employees', '28']], [
            ['1', 'Cabdiraxmaan Cali (EMP-0001)', 'Idaacada Branch', 'Human Resource', 'HR Officer', 'Present'],
            ['2', 'Fadumo Xasan (EMP-0002)', 'Xero Awr Branch', 'Finance', 'Finance Officer', 'Late'],
            ['3', 'Mahad Axmed (EMP-0003)', 'Togdheer Branch', 'Operations', 'Operations Supervisor', 'Present'],
            ['4', 'Sahra Maxamed (EMP-0004)', 'Calaamada Branch', 'Marketing', 'Marketing Coordinator', 'Absent']
        ]),
        'leave-reports': employeeReport('Leave Reports', [['Total Requests', '42'], ['Approved', '31'], ['Pending', '8']], [
            ['1', 'Fadumo Xasan (EMP-0002)', 'Xero Awr Branch', 'Finance', 'Finance Officer', 'Approved'],
            ['2', 'Amina Yusuf (EMP-0008)', 'Idaacada Branch', 'Human Resource', 'Talent Officer', 'Pending'],
            ['3', 'Mohamed Yusuf (EMP-0010)', 'Masalaha Branch', 'Administration', 'Records Coordinator', 'Approved'],
            ['4', 'Ilwad Noor (EMP-0011)', 'Jigjiga Yar Branch', 'IT', 'Software Developer', 'Rejected']
        ]),
        'retirement-reports': employeeReport('Retirement Reports', [['Tracked Employees', '10'], ['Eligible Now', '3'], ['Within 5 Months', '9']], [
            ['1', 'Mohamed Nuur (EMP-0011)', 'Jigjiga Yar Branch', 'Information Technology', 'IT Administrator', 'Eligible Now'],
            ['2', 'Hodan Maxamed (EMP-0012)', 'Xero Awr Branch', 'Finance', 'Senior Accountant', 'Eligible Now'],
            ['3', 'Fadumo Cabdi (EMP-0013)', 'Idaacada Branch', 'Human Resource', 'HR Business Partner', 'Eligible Now'],
            ['4', 'Ayan Cali (EMP-0014)', 'Calaamada Branch', 'Marketing', 'Senior Marketing Officer', 'Within 5 Months']
        ]),
        'training-reports': employeeReport('Training Reports', [['Active Trainings', '7'], ['Completed', '18'], ['Pending Staff', '23']], [
            ['1', 'Mustafe Cabdi (EMP-0006)', 'Jigjiga Yar Branch', 'Information Technology', 'Systems Support Engineer', 'Completed'],
            ['2', 'Roda Jama (EMP-0007)', 'Xero Awr Branch', 'Finance', 'Financial Analyst', 'In Progress'],
            ['3', 'Amina Yusuf (EMP-0008)', 'Idaacada Branch', 'Human Resource', 'Talent Officer', 'Completed'],
            ['4', 'Ahmed Jama (EMP-0009)', 'Calaamada Branch', 'Marketing', 'Marketing Associate', 'Pending']
        ]),
        'employee-ranking': employeeReport('Employee Ranking', [['Top Ranked', '5'], ['Average Score', '86%'], ['Needs Review', '2']], employeeRows),

        'agenda-reports': performanceReport('Agenda Reports', [['Total Agendas', '6'], ['Agenda Points', '18'], ['Assigned Employees', '12']], [
            ['1', 'Cabdiraxmaan Cali', 'Human Resource Manager', 'Staff Follow Up', '92%', 'Open'],
            ['2', 'Fadumo Xasan', 'Head of Finances', 'Audit Follow Up', '95%', 'Open'],
            ['3', 'Mahad Axmed', 'Operations Manager', 'Branch Follow Up', '88%', 'Open'],
            ['4', 'Sahra Maxamed', 'Marketing Manager', 'Customer Follow Up', '69%', 'Needs Review']
        ]),
        'employee-review-reports': performanceReport('Employee Review Reports', [['Reviews Completed', '9'], ['Top Performers', '5'], ['Need Improvement', '2']], [
            ['1', 'Cabdiraxmaan Cali', 'Human Resource Manager', 'Staff Follow Up', '92%', 'Top Performer'],
            ['2', 'Amina Yusuf', 'Human Resource Manager', 'Staff Follow Up', '86%', 'Completed'],
            ['3', 'Fadumo Xasan', 'Head of Finances', 'Audit Follow Up', '95%', 'Top Performer'],
            ['4', 'Sahra Maxamed', 'Marketing Manager', 'Customer Follow Up', '69%', 'Need Improvement']
        ]),
        'top-performers': performanceReport('Top Performers', [['Top Performers', '5'], ['Highest Score', '95%'], ['Average Top Score', '91%']], [
            ['1', 'Fadumo Xasan', 'Head of Finances', 'Audit Follow Up', '95%', 'Top Performer'],
            ['2', 'Cabdiraxmaan Cali', 'Human Resource Manager', 'Staff Follow Up', '92%', 'Top Performer'],
            ['3', 'Mahad Axmed', 'Operations Manager', 'Branch Follow Up', '88%', 'Top Performer'],
            ['4', 'Amina Yusuf', 'Human Resource Manager', 'Staff Follow Up', '86%', 'Completed']
        ]),
        'need-improvement': performanceReport('Need Improvement', [['Need Improvement', '2'], ['Lowest Score', '64%'], ['Follow Ups', '4']], [
            ['1', 'Sahra Maxamed', 'Marketing Manager', 'Customer Follow Up', '69%', 'Need Improvement'],
            ['2', 'Hodan Ali', 'Manager', 'Office Work Follow Up', '64%', 'Need Improvement'],
            ['3', 'Ahmed Jama', 'Marketing Manager', 'Customer Follow Up', '72%', 'Monitoring'],
            ['4', 'Mohamed Yusuf', 'Manager', 'Office Work Follow Up', '74%', 'Monitoring']
        ]),
        'promotion-requests': performanceReport('Promotion Requests', [['Open Requests', '6'], ['Approved', '3'], ['Pending', '2']], [
            ['1', 'Amina Xasan', 'Operations', 'Branch Lead Request', '92%', 'Approved'],
            ['2', 'Fadumo Xasan', 'Finance', 'Finance Lead Request', '95%', 'Approved'],
            ['3', 'Mustafe Cabdi', 'Information Technology', 'Senior Analyst Request', '88%', 'Pending'],
            ['4', 'Sahra Maxamed', 'Marketing', 'Senior Coordinator Request', '69%', 'Review']
        ]),
        'promotion-history': performanceReport('Promotion History', [['Promotions This Year', '118'], ['This Quarter', '37'], ['This Month', '14']], [
            ['1', 'Cabdiraxmaan Cali', 'Human Resource', 'Senior Progression', '92%', 'Completed'],
            ['2', 'Fadumo Xasan', 'Finance', 'Lead Readiness', '95%', 'Completed'],
            ['3', 'Mahad Axmed', 'Operations', 'Supervisor Track', '88%', 'Completed'],
            ['4', 'Amina Yusuf', 'Human Resource', 'Talent Track', '86%', 'Completed']
        ]),

        'salary-reports': payrollReport('Salary Reports', [['Gross Salary', '$3,300'], ['Net Salary', '$3,175'], ['Employees', '4']], [
            ['1', 'Cabdiraxmaan Cali', 'Idaacada Branch', '$850', '$15', '$835'],
            ['2', 'Fadumo Xasan', 'Xero Awr Branch', '$920', '$20', '$900'],
            ['3', 'Mahad Axmed', 'Togdheer Branch', '$880', '$35', '$845'],
            ['4', 'Sahra Maxamed', 'Calaamada Branch', '$650', '$55', '$595']
        ]),
        'paid-payroll': payrollReport('Paid Payroll', [['Paid Employees', '38'], ['Paid Amount', '$32,450'], ['Pending', '$2,100']], [
            ['1', 'Cabdiraxmaan Cali', 'Idaacada Branch', '$850', '$15', '$835'],
            ['2', 'Fadumo Xasan', 'Xero Awr Branch', '$920', '$20', '$900'],
            ['3', 'Mahad Axmed', 'Togdheer Branch', '$880', '$35', '$845'],
            ['4', 'Amina Yusuf', 'Idaacada Branch', '$760', '$0', '$760']
        ]),
        'total-deductions': payrollReport('Total Deductions', [['Total Deductions', '$405'], ['Absence', '$260'], ['Performance', '$145']], [
            ['1', 'Cabdiraxmaan Cali', 'Idaacada Branch', '$850', '$15', '$835'],
            ['2', 'Fadumo Xasan', 'Xero Awr Branch', '$920', '$20', '$900'],
            ['3', 'Mahad Axmed', 'Togdheer Branch', '$880', '$35', '$845'],
            ['4', 'Sahra Maxamed', 'Calaamada Branch', '$650', '$55', '$595']
        ]),
        'absence-deductions': payrollReport('Absence Deductions', [['Absence Deductions', '$260'], ['Affected Staff', '12'], ['Highest Deduction', '$35']], [
            ['1', 'Mahad Axmed', 'Togdheer Branch', '$880', '$35', '$845'],
            ['2', 'Sahra Maxamed', 'Calaamada Branch', '$650', '$25', '$595'],
            ['3', 'Fadumo Xasan', 'Xero Awr Branch', '$920', '$20', '$900'],
            ['4', 'Cabdiraxmaan Cali', 'Idaacada Branch', '$850', '$15', '$835']
        ]),
        'performance-deductions': payrollReport('Performance Deductions', [['Performance Deductions', '$145'], ['Affected Staff', '5'], ['Highest Deduction', '$30']], [
            ['1', 'Sahra Maxamed', 'Calaamada Branch', '$650', '$30', '$595'],
            ['2', 'Hodan Ali', 'Masalaha Branch', '$700', '$25', '$675'],
            ['3', 'Ahmed Jama', 'Calaamada Branch', '$620', '$20', '$600'],
            ['4', 'Mohamed Yusuf', 'Masalaha Branch', '$680', '$15', '$665']
        ]),
        'outstanding-payroll': payrollReport('Outstanding Payroll', [['Outstanding Payroll', '$2,100'], ['Employees Pending', '3'], ['Oldest Pending', '9 Days']], [
            ['1', 'Mustafe Cabdi', 'Jigjiga Yar Branch', '$810', '$0', '$810'],
            ['2', 'Ilwad Noor', 'Jigjiga Yar Branch', '$790', '$0', '$790'],
            ['3', 'Roda Jama', 'Xero Awr Branch', '$500', '$0', '$500'],
            ['4', 'Amina Yusuf', 'Idaacada Branch', '$760', '$0', '$760']
        ]),

        'dashboard-summary': managementReport('Dashboard Summary', [['Employees', '1,420'], ['Active Branches', '5'], ['Open Reviews', '17']], [
            ['1', 'Employee Operations', 'All Branches', 'Active Employees', '1,284', 'Stable'],
            ['2', 'Attendance', 'All Branches', 'Present Today', '1,187', 'Stable'],
            ['3', 'Payroll', 'All Branches', 'Current Run', '$32,450', 'Open'],
            ['4', 'Promotion', 'All Branches', 'Pending Requests', '2', 'Review']
        ]),
        'branch-attendance': managementReport('Branch Attendance', [['Present Today', '1,187'], ['Late', '34'], ['Absent', '28']], [
            ['1', 'Attendance', 'Idaacada Branch', 'Present', '312', 'Stable'],
            ['2', 'Attendance', 'Xero Awr Branch', 'Present', '284', 'Stable'],
            ['3', 'Attendance', 'Togdheer Branch', 'Late', '11', 'Watch'],
            ['4', 'Attendance', 'Calaamada Branch', 'Absent', '8', 'Review']
        ]),
        'training-summary': managementReport('Training Summary', [['Completed', '18'], ['In Progress', '7'], ['Pending', '23']], [
            ['1', 'Safety Training', 'Idaacada Branch', 'Completed', '8', 'Stable'],
            ['2', 'Compliance Training', 'Xero Awr Branch', 'In Progress', '4', 'Open'],
            ['3', 'Systems Training', 'Jigjiga Yar Branch', 'Completed', '6', 'Stable'],
            ['4', 'Leadership Training', 'Masalaha Branch', 'Pending', '5', 'Review']
        ]),
        'leave-summary': managementReport('Leave Summary', [['Total Requests', '42'], ['Approved', '31'], ['Pending', '8']], [
            ['1', 'Annual Leave', 'All Branches', 'Requests', '12', 'Open'],
            ['2', 'Sick Leave', 'All Branches', 'Requests', '9', 'Open'],
            ['3', 'Emergency Leave', 'All Branches', 'Requests', '6', 'Open'],
            ['4', 'Study Leave', 'All Branches', 'Requests', '3', 'Stable']
        ]),
        'retirement-summary': managementReport('Retirement Summary', [['Tracked', '10'], ['Eligible Now', '3'], ['Within 5 Months', '9']], [
            ['1', 'Retirement', 'Jigjiga Yar Branch', 'Eligible Now', '1', 'Action'],
            ['2', 'Retirement', 'Xero Awr Branch', 'Eligible Now', '1', 'Action'],
            ['3', 'Retirement', 'Idaacada Branch', 'Eligible Now', '1', 'Action'],
            ['4', 'Retirement', 'Calaamada Branch', 'Within 5 Months', '1', 'Watch']
        ]),
        'promotion-summary': managementReport('Promotion Summary', [['This Month', '14'], ['This Quarter', '37'], ['This Year', '118']], [
            ['1', 'Promotion', 'Operations', 'Completed', '24', 'High'],
            ['2', 'Promotion', 'Finance', 'Completed', '19', 'Stable'],
            ['3', 'Promotion', 'Human Resource', 'Completed', '17', 'Stable'],
            ['4', 'Promotion', 'Marketing', 'Completed', '11', 'Watch']
        ])
    };

    function renderReport(key) {
        var report = reports[key] || reports['employee-info'];
        title.textContent = report.title;
        description.textContent = report.description;
        generated.textContent = 'May 1, 2026';
        branch.textContent = 'All Hargeisa Branches';
        module.textContent = report.module;
        note.textContent = report.note;
        stats.innerHTML = '';
        tableHead.innerHTML = '';
        tableBody.innerHTML = '';

        report.stats.forEach(function (stat) {
            var card = document.createElement('div');
            var label = document.createElement('span');
            var value = document.createElement('strong');
            card.className = 'report-document-stat';
            label.textContent = stat[0];
            value.textContent = stat[1];
            card.appendChild(label);
            card.appendChild(value);
            stats.appendChild(card);
        });

        var headerRow = document.createElement('tr');
        report.columns.forEach(function (column) {
            var th = document.createElement('th');
            th.textContent = column;
            headerRow.appendChild(th);
        });
        tableHead.appendChild(headerRow);

        report.rows.forEach(function (row) {
            var tr = document.createElement('tr');
            row.forEach(function (cell) {
                var td = document.createElement('td');
                td.textContent = cell;
                tr.appendChild(td);
            });
            tableBody.appendChild(tr);
        });

        reportDocument.classList.add('open');
        reportDocument.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    document.querySelectorAll('[data-report-key]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            renderReport(link.dataset.reportKey);
        });
    });

    if (printButton) {
        printButton.addEventListener('click', function () {
            window.print();
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            reportDocument.classList.remove('open');
        });
    }
});
</script>

<?php include '../../includes/footer.php'; ?>
