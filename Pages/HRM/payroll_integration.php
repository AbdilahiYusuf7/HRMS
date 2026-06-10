<?php
$pageTitle = "Payroll Integration";
$activePage = "payroll-integration";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .payroll-header {
        margin-bottom: 42px;
    }

    .payroll-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .payroll-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .payroll-insights-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
    }

    .payroll-insights-grid .employee-insight-card {
        min-height: 236px;
    }

    .payroll-absence {
        background-color: var(--warning-light);
    }

    .payroll-absence .employee-insight-icon {
        background-color: rgba(245, 158, 11, 0.14);
        color: var(--warning-hover);
    }

    .payroll-performance {
        background-color: var(--danger-light);
    }

    .payroll-performance .employee-insight-icon {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger-hover);
    }

    .payroll-deductions-section {
        margin-top: 32px;
    }

    .payroll-deductions-header {
        padding: 28px 28px 24px;
    }

    .payroll-deductions-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.32rem;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .payroll-deductions-header p {
        color: var(--neutral-gray);
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .payroll-deductions-table .employee-data-table {
        min-width: 1220px;
    }

    .payroll-money {
        color: var(--neutral-darkest);
        font-weight: 900;
    }

    .payroll-money.absence {
        color: var(--warning-hover);
    }

    .payroll-money.performance {
        color: var(--danger-hover);
    }

    .payroll-money.net {
        color: var(--success-hover);
    }

    @media (max-width: 980px) {
        .payroll-insights-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="payroll-header">
    <h1>Payroll Integration</h1>
    <p>Payroll integration workspace.</p>
</div>

<div class="payroll-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Total Deductions</h3>
            <strong>$405</strong>
            <p>All deductions for this payroll run</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">receipt_long</span>
        </div>
    </div>

    <div class="employee-insight-card payroll-absence">
        <div>
            <h3>Absence Deductions</h3>
            <strong>$260</strong>
            <p>Deductions from absence and late attendance</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">person_alert</span>
        </div>
    </div>

    <div class="employee-insight-card payroll-performance">
        <div>
            <h3>Performance Deductions</h3>
            <strong>$145</strong>
            <p>Deductions from low performance reviews</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">trending_down</span>
        </div>
    </div>
</div>

<section class="payroll-deductions-section">
    <div class="employee-table-panel payroll-deductions-table">
        <div class="payroll-deductions-header">
            <h2>Employee Payroll Deductions</h2>
            <p>Employee salary list with absence and performance deductions.</p>
        </div>

        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Employee Name &amp; ID <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Branch <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Original Salary <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Absence Deduction <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Performance Deduction <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Total Deduction <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Net Salary <span class="material-symbols-rounded">unfold_more</span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">CC</span>
                                <div><strong>Cabdiraxmaan Cali</strong><span>EMP-0001</span></div>
                            </div>
                        </td>
                        <td>Human Resource Manager</td>
                        <td>Idaacada Branch</td>
                        <td><span class="payroll-money">$850</span></td>
                        <td><span class="payroll-money absence">$15</span></td>
                        <td><span class="payroll-money performance">$0</span></td>
                        <td><span class="payroll-money">$15</span></td>
                        <td><span class="payroll-money net">$835</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">FX</span>
                                <div><strong>Fadumo Xasan</strong><span>EMP-0002</span></div>
                            </div>
                        </td>
                        <td>Head of Finances</td>
                        <td>Idaacada Branch</td>
                        <td><span class="payroll-money">$920</span></td>
                        <td><span class="payroll-money absence">$20</span></td>
                        <td><span class="payroll-money performance">$0</span></td>
                        <td><span class="payroll-money">$20</span></td>
                        <td><span class="payroll-money net">$900</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">MA</span>
                                <div><strong>Mahad Axmed</strong><span>EMP-0003</span></div>
                            </div>
                        </td>
                        <td>Operations Manager</td>
                        <td>Idaacada Branch</td>
                        <td><span class="payroll-money">$880</span></td>
                        <td><span class="payroll-money absence">$35</span></td>
                        <td><span class="payroll-money performance">$0</span></td>
                        <td><span class="payroll-money">$35</span></td>
                        <td><span class="payroll-money net">$845</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">SM</span>
                                <div><strong>Sahra Maxamed</strong><span>EMP-0004</span></div>
                            </div>
                        </td>
                        <td>Marketing Manager</td>
                        <td>Idaacada Branch</td>
                        <td><span class="payroll-money">$650</span></td>
                        <td><span class="payroll-money absence">$25</span></td>
                        <td><span class="payroll-money performance">$30</span></td>
                        <td><span class="payroll-money">$55</span></td>
                        <td><span class="payroll-money net">$595</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing 1-4 of 4 payroll records</span>
            <div class="employee-pagination">
                <button type="button" disabled>&lt;</button>
                <button type="button" class="active">1</button>
                <button type="button" disabled>&gt;</button>
            </div>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
