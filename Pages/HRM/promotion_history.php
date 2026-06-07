<?php
$pageTitle = "Promotion History";
$activePage = "promotion-history";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .promotion-history-header {
        margin-bottom: 42px;
    }

    .promotion-history-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .promotion-history-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .promotion-history-insights-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(220px, 1fr));
        gap: 24px;
    }

    .promotion-history-insights-grid .employee-insight-card {
        min-height: 250px;
    }

    .promotion-history-filter-panel,
    .promotion-history-table-section {
        margin-top: 32px;
    }

    .promotion-history-filter-panel .employee-filter-grid {
        grid-template-columns: repeat(5, minmax(180px, 1fr));
    }

    .promotion-history-table-section .employee-data-table {
        min-width: 1360px;
    }

    .promotion-history-view-btn {
        min-width: 76px;
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

    .promotion-history-view-btn:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .promotion-history-view-btn .material-symbols-rounded {
        font-size: 16px;
    }

    .promotion-history-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .promotion-history-modal.open {
        display: flex;
    }

    .promotion-history-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .promotion-history-dialog {
        position: relative;
        z-index: 1;
        width: min(1040px, 100%);
        max-height: min(820px, calc(100vh - 64px));
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .promotion-history-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 32px 36px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .promotion-history-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        margin-bottom: 8px;
    }

    .promotion-history-modal-header p {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
    }

    .promotion-history-close {
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

    .promotion-history-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .promotion-history-modal-body {
        overflow: auto;
        padding: 36px;
        flex: 1 1 auto;
        max-height: calc(min(820px, calc(100vh - 64px)) - 124px);
    }

    .promotion-history-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 20px;
    }

    .promotion-history-detail-card {
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        padding: 22px;
        min-height: 98px;
    }

    .promotion-history-detail-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .promotion-history-detail-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        line-height: 1.34;
    }

    .promotion-history-total {
        background-color: #ddd6fe;
    }

    .promotion-history-total .employee-insight-icon {
        background-color: rgba(79, 70, 229, 0.12);
        color: #4f46e5;
    }

    @media (max-width: 1180px) {
        .promotion-history-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .promotion-history-filter-panel .employee-filter-grid {
            grid-template-columns: repeat(3, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .promotion-history-insights-grid {
            grid-template-columns: 1fr;
        }

        .promotion-history-filter-panel .employee-filter-grid {
            grid-template-columns: 1fr;
        }

        .promotion-history-modal {
            padding: 16px;
        }

        .promotion-history-modal-header,
        .promotion-history-modal-body {
            padding: 22px;
        }

        .promotion-history-detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="promotion-history-header">
    <h1>Promotion History</h1>
    <p>Audit promotion changes, compare role movement, and review historical approval outcomes.</p>
</div>

<div class="promotion-history-insights-grid">
    <div class="employee-insight-card promotion-history-total">
        <div>
            <h3>Total Promotions</h3>
            <strong>10 Promotions</strong>
            <p>Historical promotions currently available in the register.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">trending_up</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>This Month</h3>
            <strong>2 Promotions</strong>
            <p>Promotions effective in the current sample month.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">event_available</span>
        </div>
    </div>

    <div class="employee-insight-card new-month">
        <div>
            <h3>This Year</h3>
            <strong>10 Promotions</strong>
            <p>Promotions effective during the current year.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">calendar_month</span>
        </div>
    </div>

    <div class="employee-insight-card leave">
        <div>
            <h3>Avg Promotion Time</h3>
            <strong>30 Months</strong>
            <p>Average months taken to reach the promotion milestone.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">hourglass_top</span>
        </div>
    </div>
</div>

<section class="employee-filter-panel promotion-history-filter-panel">
    <div class="employee-filter-header">
        <div>
            <h2>Filters</h2>
            <p>Refine promotion history by employee, department, role movement, date range, and reason.</p>
        </div>
        <button type="button" class="employee-filter-settings" aria-label="Filter settings">
            <span class="material-symbols-rounded">tune</span>
        </button>
    </div>

    <div class="employee-filter-grid">
        <label>
            <span>Employee</span>
            <input type="search" class="form-control" placeholder="Search employee">
        </label>

        <label>
            <span>Department</span>
            <select class="form-control">
                <option>All Departments</option>
                <option>Human Resource</option>
                <option>Finance</option>
                <option>Operations</option>
                <option>Marketing</option>
                <option>Administration</option>
            </select>
        </label>

        <label>
            <span>From Role</span>
            <select class="form-control">
                <option>All Roles</option>
                <option>Human Resource Officer</option>
                <option>Finance Officer</option>
                <option>Operations Supervisor</option>
                <option>Marketing Associate</option>
                <option>Administration Officer</option>
            </select>
        </label>

        <label>
            <span>To Role</span>
            <select class="form-control">
                <option>All Roles</option>
                <option>Senior Human Resource Officer</option>
                <option>Lead Finance Officer</option>
                <option>Branch Lead</option>
                <option>Marketing Coordinator</option>
                <option>Senior Administration Officer</option>
            </select>
        </label>

        <label>
            <span>Date Range</span>
            <input type="text" class="form-control" value="Apr 01, 2026 - Jun 30, 2026">
        </label>

        <label>
            <span>Promotion Reason</span>
            <select class="form-control">
                <option>All Reasons</option>
                <option>Performance based progression</option>
                <option>Leadership readiness</option>
                <option>Qualification upgrade</option>
                <option>Attendance threshold</option>
            </select>
        </label>
    </div>
</section>

<section class="employee-records-section promotion-history-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Promotion History Register</h2>
            <p>Compact historical list for audit and reporting views.</p>
        </div>
    </div>

    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Previous Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">New Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Previous Rank / Grade <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">New Rank / Grade <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Effective Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Reason <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Approved By <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Notes <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Cabdiraxmaan Cali</strong></td>
                        <td>Human Resource Officer</td>
                        <td>Senior Human Resource Officer</td>
                        <td>Officer II / G6</td>
                        <td>Officer III / G7</td>
                        <td>2026-04-12</td>
                        <td>Performance based progression</td>
                        <td>Asha Mohamed</td>
                        <td>Exceeded annual target and completed leadership training.</td>
                        <td><button type="button" class="promotion-history-view-btn" data-promotion-history-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Fadumo Xasan</strong></td>
                        <td>Finance Officer</td>
                        <td>Lead Finance Officer</td>
                        <td>Officer III / G7</td>
                        <td>Lead Officer / G8</td>
                        <td>2026-05-20</td>
                        <td>Leadership readiness</td>
                        <td>Mohamed Yusuf</td>
                        <td>Led branch controls review and mentoring program.</td>
                        <td><button type="button" class="promotion-history-view-btn" data-promotion-history-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Mahad Axmed</strong></td>
                        <td>Operations Supervisor</td>
                        <td>Branch Lead</td>
                        <td>Supervisor / G8</td>
                        <td>Lead / G9</td>
                        <td>2026-04-28</td>
                        <td>Performance based progression</td>
                        <td>Hodan Ali</td>
                        <td>Delivered branch readiness and emergency operations targets.</td>
                        <td><button type="button" class="promotion-history-view-btn" data-promotion-history-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Sahra Maxamed</strong></td>
                        <td>Marketing Associate</td>
                        <td>Marketing Coordinator</td>
                        <td>Associate / G4</td>
                        <td>Coordinator / G5</td>
                        <td>2026-05-08</td>
                        <td>Qualification upgrade</td>
                        <td>Ahmed Jama</td>
                        <td>Promotion recorded after qualification and campaign performance uplift.</td>
                        <td><button type="button" class="promotion-history-view-btn" data-promotion-history-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Hodan Ali</strong></td>
                        <td>Administration Officer</td>
                        <td>Senior Administration Officer</td>
                        <td>Officer I / G5</td>
                        <td>Officer II / G6</td>
                        <td>2026-04-18</td>
                        <td>Attendance threshold</td>
                        <td>Cali Maxamed</td>
                        <td>Maintained full compliance and branch coordination metrics.</td>
                        <td><button type="button" class="promotion-history-view-btn" data-promotion-history-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing 1-5 of 5 records</span>
            <div class="employee-pagination">
                <button type="button" disabled>&lt;</button>
                <button type="button" class="active">1</button>
                <button type="button" disabled>&gt;</button>
            </div>
        </div>
    </div>
</section>

<div class="promotion-history-modal" id="promotionHistoryDetailModal" aria-hidden="true">
    <div class="promotion-history-backdrop" data-promotion-history-close></div>
    <section class="promotion-history-dialog" role="dialog" aria-modal="true" aria-labelledby="promotionHistoryDetailTitle">
        <div class="promotion-history-modal-header">
            <div>
                <h2 id="promotionHistoryDetailTitle">Promotion History</h2>
                <p>Promotion history detail</p>
            </div>
            <button type="button" class="promotion-history-close" data-promotion-history-close aria-label="Close promotion history detail">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="promotion-history-modal-body">
            <div class="promotion-history-detail-grid">
                <article class="promotion-history-detail-card">
                    <span>Department</span>
                    <strong data-history-detail-department></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Previous Role</span>
                    <strong data-history-detail-previous-role></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>New Role</span>
                    <strong data-history-detail-new-role></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Previous Rank / Grade</span>
                    <strong data-history-detail-previous-rank></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>New Rank / Grade</span>
                    <strong data-history-detail-new-rank></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Effective Date</span>
                    <strong data-history-detail-date></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Reason</span>
                    <strong data-history-detail-reason></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Approved By</span>
                    <strong data-history-detail-approved-by></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Months To Promotion</span>
                    <strong data-history-detail-months></strong>
                </article>
                <article class="promotion-history-detail-card">
                    <span>Notes</span>
                    <strong data-history-detail-notes></strong>
                </article>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('promotionHistoryDetailModal');
    if (!modal) return;

    var title = document.getElementById('promotionHistoryDetailTitle');
    var fields = {
        department: modal.querySelector('[data-history-detail-department]'),
        previousRole: modal.querySelector('[data-history-detail-previous-role]'),
        newRole: modal.querySelector('[data-history-detail-new-role]'),
        previousRank: modal.querySelector('[data-history-detail-previous-rank]'),
        newRank: modal.querySelector('[data-history-detail-new-rank]'),
        date: modal.querySelector('[data-history-detail-date]'),
        reason: modal.querySelector('[data-history-detail-reason]'),
        approvedBy: modal.querySelector('[data-history-detail-approved-by]'),
        months: modal.querySelector('[data-history-detail-months]'),
        notes: modal.querySelector('[data-history-detail-notes]')
    };

    function textAt(cells, index) {
        return cells[index] ? cells[index].textContent.trim().replace(/\s+/g, ' ') : '';
    }

    function departmentFromRole(role) {
        if (role.indexOf('Human Resource') !== -1) return 'Human Resource';
        if (role.indexOf('Finance') !== -1 || role.indexOf('Financial') !== -1) return 'Finance';
        if (role.indexOf('Operations') !== -1 || role.indexOf('Branch') !== -1) return 'Operations';
        if (role.indexOf('Marketing') !== -1) return 'Marketing';
        if (role.indexOf('Administration') !== -1) return 'Administration';
        return 'General';
    }

    function monthsToPromotion(employee) {
        var months = {
            'Cabdiraxmaan Cali': '36 Months',
            'Fadumo Xasan': '42 Months',
            'Mahad Axmed': '58 Months',
            'Sahra Maxamed': '26 Months',
            'Hodan Ali': '34 Months'
        };
        return months[employee] || '30 Months';
    }

    function openModal(row) {
        var cells = row.querySelectorAll('td');
        var employee = textAt(cells, 0);
        var previousRole = textAt(cells, 1);
        title.textContent = employee;
        fields.department.textContent = departmentFromRole(previousRole);
        fields.previousRole.textContent = previousRole;
        fields.newRole.textContent = textAt(cells, 2);
        fields.previousRank.textContent = textAt(cells, 3);
        fields.newRank.textContent = textAt(cells, 4);
        fields.date.textContent = textAt(cells, 5);
        fields.reason.textContent = textAt(cells, 6);
        fields.approvedBy.textContent = textAt(cells, 7);
        fields.months.textContent = monthsToPromotion(employee);
        fields.notes.textContent = textAt(cells, 8);
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    document.querySelectorAll('[data-promotion-history-view]').forEach(function (button) {
        button.addEventListener('click', function () {
            var row = button.closest('tr');
            if (row) openModal(row);
        });
    });

    modal.querySelectorAll('[data-promotion-history-close]').forEach(function (trigger) {
        trigger.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('open')) {
            closeModal();
        }
    });
});
</script>

<?php
include '../../includes/footer.php';
?>
