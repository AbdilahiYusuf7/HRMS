<?php
$pageTitle = "Promotion Requests";
$activePage = "promotion-requests";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .promotion-requests-header {
        margin-bottom: 42px;
    }

    .promotion-requests-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .promotion-requests-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .promotion-requests-insights-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(220px, 1fr));
        gap: 24px;
    }

    .promotion-requests-insights-grid .employee-insight-card {
        min-height: 260px;
    }

    .promotion-requests-filter-panel {
        margin-top: 32px;
    }

    .promotion-requests-filter-panel .employee-filter-grid {
        grid-template-columns: repeat(5, minmax(180px, 1fr));
    }

    .promotion-requests-table-section {
        margin-top: 32px;
    }

    .promotion-requests-table-section .employee-data-table {
        min-width: 1420px;
    }

    .promotion-request-status {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 88px;
        padding: 7px 10px;
        font-size: 0.72rem;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
        white-space: normal;
    }

    .promotion-request-status.approved {
        background-color: var(--success-light);
        color: var(--success-hover);
    }

    .promotion-request-status.review {
        background-color: var(--warning-light);
        color: var(--warning-hover);
    }

    .promotion-request-status.rejected {
        background-color: var(--danger-light);
        color: var(--danger-hover);
    }

    .promotion-request-view-btn {
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

    .promotion-request-view-btn:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .promotion-request-view-btn .material-symbols-rounded {
        font-size: 16px;
    }

    .promotion-request-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .promotion-request-modal.open {
        display: flex;
    }

    .promotion-request-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .promotion-request-dialog {
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

    .promotion-request-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 32px 36px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .promotion-request-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        margin-bottom: 8px;
    }

    .promotion-request-modal-header p {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
    }

    .promotion-request-close {
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

    .promotion-request-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .promotion-request-modal-body {
        overflow: auto;
        padding: 36px;
        flex: 1 1 auto;
        max-height: calc(min(820px, calc(100vh - 64px)) - 124px);
    }

    .promotion-request-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 20px;
    }

    .promotion-request-detail-card {
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        padding: 22px;
        min-height: 104px;
    }

    .promotion-request-detail-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .promotion-request-detail-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.12rem;
        line-height: 1.3;
    }

    .promotion-request-purple {
        background-color: #ddd6fe;
    }

    .promotion-request-purple .employee-insight-icon {
        background-color: rgba(79, 70, 229, 0.12);
        color: #4f46e5;
    }

    @media (max-width: 1180px) {
        .promotion-requests-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .promotion-requests-filter-panel .employee-filter-grid {
            grid-template-columns: repeat(3, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .promotion-requests-insights-grid {
            grid-template-columns: 1fr;
        }

        .promotion-requests-filter-panel .employee-filter-grid {
            grid-template-columns: 1fr;
        }

        .promotion-request-modal {
            padding: 16px;
        }

        .promotion-request-modal-header,
        .promotion-request-modal-body {
            padding: 22px;
        }

        .promotion-request-detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="promotion-requests-header">
    <h1>Promotion Requests</h1>
    <p>Track submitted requests, approval routing, rank changes, and effective promotion dates.</p>
</div>

<div class="promotion-requests-insights-grid">
    <div class="employee-insight-card promotion-request-purple">
        <div>
            <h3>Total Requests</h3>
            <strong>12 Requests</strong>
            <p>All promotion requests currently listed in the queue.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">stacks</span>
        </div>
    </div>

    <div class="employee-insight-card leave">
        <div>
            <h3>Under Review</h3>
            <strong>4 Requests</strong>
            <p>Requests still passing through one or more approval steps.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">hourglass_top</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>Approved</h3>
            <strong>5 Requests</strong>
            <p>Requests approved for implementation or already applied.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">check_circle</span>
        </div>
    </div>

    <div class="employee-insight-card least-performing">
        <div>
            <h3>Rejected</h3>
            <strong>2 Requests</strong>
            <p>Requests declined after review.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">cancel</span>
        </div>
    </div>
</div>

<section class="employee-filter-panel promotion-requests-filter-panel">
    <div class="employee-filter-header">
        <div>
            <h2>Filters</h2>
            <p>Refine promotion requests by status, department, role changes, date range, requester, and approval stage.</p>
        </div>
        <button type="button" class="employee-filter-settings" aria-label="Filter settings">
            <span class="material-symbols-rounded">tune</span>
        </button>
    </div>

    <div class="employee-filter-grid">
        <label>
            <span>Request Status</span>
            <select class="form-control">
                <option>All</option>
                <option>Under Review</option>
                <option>Approved</option>
                <option>Rejected</option>
                <option>Draft</option>
            </select>
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
                <option>Information Technology</option>
            </select>
        </label>

        <label>
            <span>Current Role</span>
            <select class="form-control">
                <option>All Roles</option>
                <option>Officer</option>
                <option>Supervisor</option>
                <option>Coordinator</option>
                <option>Analyst</option>
                <option>Engineer</option>
            </select>
        </label>

        <label>
            <span>Proposed Role</span>
            <select class="form-control">
                <option>All Roles</option>
                <option>Lead Officer</option>
                <option>Senior Coordinator</option>
                <option>Systems Analyst</option>
                <option>HR Business Partner</option>
            </select>
        </label>

        <label>
            <span>Rank Change</span>
            <select class="form-control">
                <option>All</option>
                <option>Officer I to Officer II</option>
                <option>Officer II to Lead</option>
                <option>Coordinator to Senior Coordinator</option>
                <option>Engineer I to Analyst</option>
            </select>
        </label>

        <label>
            <span>Effective Date Range</span>
            <input type="text" class="form-control" value="Apr 01, 2026 - Jun 30, 2026">
        </label>

        <label>
            <span>Requested By</span>
            <select class="form-control">
                <option>All</option>
                <option>HR Office</option>
                <option>Department Head</option>
                <option>Branch Manager</option>
                <option>Employee Request</option>
            </select>
        </label>

        <label>
            <span>Approval Stage</span>
            <select class="form-control">
                <option>All</option>
                <option>HR Review</option>
                <option>Department Approval</option>
                <option>Executive Approval</option>
                <option>Completed</option>
            </select>
        </label>
    </div>
</section>

<section class="employee-records-section promotion-requests-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Promotion Request Queue</h2>
            <p>UI-only approval queue for draft, submitted, reviewed, approved, rejected, and implemented requests.</p>
        </div>
    </div>

    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Current Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Proposed Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Current Rank / Grade <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">New Rank / Grade <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Basis <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Effective Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Requested By <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Approval Stage <span class="material-symbols-rounded">unfold_more</span></button></th>
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
                        <td>Performance review + qualification evidence</td>
                        <td>2026-04-12</td>
                        <td>Asha Mohamed</td>
                        <td><span class="promotion-request-status approved">Approved</span></td>
                        <td>Committee Approved</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Fadumo Xasan</strong></td>
                        <td>Finance Officer</td>
                        <td>Lead Finance Officer</td>
                        <td>Officer III / G7</td>
                        <td>Lead Officer / G8</td>
                        <td>Leadership readiness</td>
                        <td>2026-05-20</td>
                        <td>Mohamed Yusuf</td>
                        <td><span class="promotion-request-status review">Under Review</span></td>
                        <td>Director Review</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Mahad Axmed</strong></td>
                        <td>Operations Supervisor</td>
                        <td>Branch Lead</td>
                        <td>Supervisor / G8</td>
                        <td>Lead / G9</td>
                        <td>Performance review + qualification evidence</td>
                        <td>2026-04-28</td>
                        <td>Hodan Ali</td>
                        <td><span class="promotion-request-status approved">Approved</span></td>
                        <td>Implemented</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Sahra Maxamed</strong></td>
                        <td>Marketing Coordinator</td>
                        <td>Senior Marketing Coordinator</td>
                        <td>Coordinator / G5</td>
                        <td>Officer I / G6</td>
                        <td>Qualification upgrade</td>
                        <td>2026-05-08</td>
                        <td>Ahmed Jama</td>
                        <td><span class="promotion-request-status rejected">Rejected</span></td>
                        <td>Committee Review</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Hodan Ali</strong></td>
                        <td>Administration Officer</td>
                        <td>Senior Administration Officer</td>
                        <td>Officer I / G5</td>
                        <td>Officer II / G6</td>
                        <td>Tenure and attendance threshold</td>
                        <td>2026-04-18</td>
                        <td>Cali Maxamed</td>
                        <td><span class="promotion-request-status approved">Approved</span></td>
                        <td>Implemented</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Mustafe Cabdi</strong></td>
                        <td>Systems Support Engineer</td>
                        <td>Systems Analyst</td>
                        <td>Engineer I / G6</td>
                        <td>Engineer II / G7</td>
                        <td>Certification completion</td>
                        <td>2026-06-02</td>
                        <td>Ilwad Noor</td>
                        <td><span class="promotion-request-status review">Under Review</span></td>
                        <td>HR Review</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><strong>Roda Jama</strong></td>
                        <td>Financial Analyst</td>
                        <td>Senior Financial Analyst</td>
                        <td>Analyst II / G6</td>
                        <td>Senior Analyst / G7</td>
                        <td>Performance review + qualification evidence</td>
                        <td>2026-04-26</td>
                        <td>Mohamed Yusuf</td>
                        <td><span class="promotion-request-status approved">Approved</span></td>
                        <td>Implemented</td>
                        <td><button type="button" class="promotion-request-view-btn" data-promotion-request-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing 1-7 of 7 records</span>
            <div class="employee-pagination">
                <button type="button" disabled>&lt;</button>
                <button type="button" class="active">1</button>
                <button type="button" disabled>&gt;</button>
            </div>
        </div>
    </div>
</section>

<div class="promotion-request-modal" id="promotionRequestDetailModal" aria-hidden="true">
    <div class="promotion-request-backdrop" data-promotion-request-close></div>
    <section class="promotion-request-dialog" role="dialog" aria-modal="true" aria-labelledby="promotionRequestDetailTitle">
        <div class="promotion-request-modal-header">
            <div>
                <h2 id="promotionRequestDetailTitle">Promotion Request</h2>
                <p>Promotion request detail</p>
            </div>
            <button type="button" class="promotion-request-close" data-promotion-request-close aria-label="Close promotion request detail">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="promotion-request-modal-body">
            <div class="promotion-request-detail-grid">
                <article class="promotion-request-detail-card">
                    <span>Department</span>
                    <strong data-request-detail-department></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Current Role</span>
                    <strong data-request-detail-current-role></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Proposed Role</span>
                    <strong data-request-detail-proposed-role></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Current Rank / Grade</span>
                    <strong data-request-detail-current-rank></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>New Rank / Grade</span>
                    <strong data-request-detail-new-rank></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Basis</span>
                    <strong data-request-detail-basis></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Effective Date</span>
                    <strong data-request-detail-date></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Requested By</span>
                    <strong data-request-detail-requested-by></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Status</span>
                    <strong data-request-detail-status></strong>
                </article>
                <article class="promotion-request-detail-card">
                    <span>Approval Stage</span>
                    <strong data-request-detail-stage></strong>
                </article>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('promotionRequestDetailModal');
    if (!modal) return;

    var title = document.getElementById('promotionRequestDetailTitle');
    var fields = {
        department: modal.querySelector('[data-request-detail-department]'),
        currentRole: modal.querySelector('[data-request-detail-current-role]'),
        proposedRole: modal.querySelector('[data-request-detail-proposed-role]'),
        currentRank: modal.querySelector('[data-request-detail-current-rank]'),
        newRank: modal.querySelector('[data-request-detail-new-rank]'),
        basis: modal.querySelector('[data-request-detail-basis]'),
        date: modal.querySelector('[data-request-detail-date]'),
        requestedBy: modal.querySelector('[data-request-detail-requested-by]'),
        status: modal.querySelector('[data-request-detail-status]'),
        stage: modal.querySelector('[data-request-detail-stage]')
    };

    function textAt(cells, index) {
        return cells[index] ? cells[index].textContent.trim().replace(/\s+/g, ' ') : '';
    }

    function openModal(row) {
        var cells = row.querySelectorAll('td');
        title.textContent = textAt(cells, 0);
        fields.department.textContent = textAt(cells, 1).split(' ')[0] === 'Human' ? 'Human Resource' : textAt(cells, 1).replace(' Officer', '').replace(' Supervisor', '').replace(' Coordinator', '').replace(' Engineer', '').replace(' Analyst', '');
        fields.currentRole.textContent = textAt(cells, 1);
        fields.proposedRole.textContent = textAt(cells, 2);
        fields.currentRank.textContent = textAt(cells, 3);
        fields.newRank.textContent = textAt(cells, 4);
        fields.basis.textContent = textAt(cells, 5);
        fields.date.textContent = textAt(cells, 6);
        fields.requestedBy.textContent = textAt(cells, 7);
        fields.status.textContent = textAt(cells, 8);
        fields.stage.textContent = textAt(cells, 9);
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    document.querySelectorAll('[data-promotion-request-view]').forEach(function (button) {
        button.addEventListener('click', function () {
            var row = button.closest('tr');
            if (row) openModal(row);
        });
    });

    modal.querySelectorAll('[data-promotion-request-close]').forEach(function (trigger) {
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
