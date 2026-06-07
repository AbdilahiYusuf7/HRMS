<?php
$pageTitle = "Promotion Rules";
$activePage = "promotion-rules";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .promotion-rules-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 42px;
    }

    .promotion-rules-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .promotion-rules-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .promotion-rules-header .btn {
        min-width: 260px;
        min-height: 64px;
        border-radius: 24px;
        font-size: 1rem;
        font-weight: 900;
        gap: 12px;
        box-shadow: 0 18px 42px rgba(77, 168, 218, 0.2);
    }

    .promotion-rules-header .btn .material-symbols-rounded {
        font-size: 26px;
    }

    .promotion-rules-insights-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(220px, 1fr));
        gap: 24px;
    }

    .promotion-rules-insights-grid .employee-insight-card {
        min-height: 280px;
    }

    .promotion-rule-department {
        background-color: #d1fae5;
    }

    .promotion-rule-department .employee-insight-icon {
        background-color: rgba(16, 185, 129, 0.12);
        color: #059669;
    }

    .promotion-rule-qualification {
        background-color: #e0f2fe;
    }

    .promotion-rule-qualification .employee-insight-icon {
        background-color: rgba(14, 165, 233, 0.1);
        color: #0284c7;
    }

    .promotion-rule-review {
        background-color: #fef3c7;
    }

    .promotion-rule-review .employee-insight-icon {
        background-color: rgba(245, 158, 11, 0.12);
        color: #d97706;
    }

    .promotion-rules-filter-panel {
        margin-top: 32px;
    }

    .promotion-rules-filter-panel .employee-filter-grid {
        grid-template-columns: repeat(5, minmax(180px, 1fr));
    }

    .promotion-rules-table-section {
        margin-top: 32px;
    }

    .promotion-rules-table-section .employee-data-table {
        min-width: 1340px;
    }

    .promotion-rule-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .promotion-rule-modal.open {
        display: flex;
    }

    .promotion-rule-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .promotion-rule-dialog {
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

    .promotion-rule-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 32px 36px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .promotion-rule-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        margin-bottom: 8px;
    }

    .promotion-rule-modal-header p {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
    }

    .promotion-rule-close {
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

    .promotion-rule-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .promotion-rule-modal-body {
        overflow: auto;
        padding: 36px;
        flex: 1 1 auto;
        max-height: calc(min(820px, calc(100vh - 64px)) - 124px);
    }

    .promotion-rule-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 20px;
    }

    .promotion-rule-detail-card {
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        padding: 22px;
        min-height: 104px;
    }

    .promotion-rule-detail-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .promotion-rule-detail-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.12rem;
        line-height: 1.3;
    }

    .promotion-rule-form-dialog {
        width: min(1180px, 100%);
        max-height: min(860px, calc(100vh - 64px));
    }

    .promotion-rule-form-body {
        padding: 28px 36px;
    }

    .promotion-rule-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 22px 28px;
    }

    .promotion-rule-form-field.full {
        grid-column: 1 / -1;
    }

    .promotion-rule-form-field span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.28em;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .promotion-rule-form-field .form-control {
        min-height: 58px;
        border-color: rgba(191, 219, 254, 0.92);
        border-radius: var(--radius-sm);
        background-color: rgba(255, 255, 255, 0.72);
        font-weight: 600;
    }

    .promotion-rule-form-field textarea.form-control {
        min-height: 132px;
        resize: vertical;
    }

    .promotion-rule-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 14px;
        padding: 28px 36px;
        border-top: 1px solid rgba(226, 232, 240, 0.72);
        background-color: rgba(255, 255, 255, 0.64);
        flex: 0 0 auto;
    }

    .promotion-rule-form-actions .btn {
        min-width: 118px;
        min-height: 54px;
        border-radius: var(--radius-md);
        font-weight: 900;
    }

    @media (max-width: 1180px) {
        .promotion-rules-header {
            align-items: stretch;
            flex-direction: column;
        }

        .promotion-rules-header .btn {
            width: fit-content;
        }

        .promotion-rules-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .promotion-rules-filter-panel .employee-filter-grid {
            grid-template-columns: repeat(3, minmax(180px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .promotion-rules-header .btn {
            width: 100%;
        }

        .promotion-rules-insights-grid,
        .promotion-rules-filter-panel .employee-filter-grid {
            grid-template-columns: 1fr;
        }

        .promotion-rule-modal {
            padding: 16px;
        }

        .promotion-rule-modal-header,
        .promotion-rule-modal-body {
            padding: 22px;
        }

        .promotion-rule-detail-grid {
            grid-template-columns: 1fr;
        }

        .promotion-rule-form-grid {
            grid-template-columns: 1fr;
        }

        .promotion-rule-form-body,
        .promotion-rule-form-actions {
            padding: 22px;
        }
    }
</style>

<div class="promotion-rules-header">
    <div>
        <h1>Promotion Rules</h1>
        <p>Review active promotion rules, qualification requirements, approval routing, and rules due for review.</p>
    </div>
    <button type="button" class="btn btn-primary" data-add-promotion-rule-open>
        <span class="material-symbols-rounded">add</span>
        <span>Add Promotion Rule</span>
    </button>
</div>

<div class="promotion-rules-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Active Rules</h3>
            <strong>5 Rules</strong>
            <p>Rules currently active in the mock promotion rules register.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">balance</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-rule-department">
        <div>
            <h3>Department Rules</h3>
            <strong>4 Rules</strong>
            <p>Rules focused on department-specific promotion criteria.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">business</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-rule-qualification">
        <div>
            <h3>Qualification Rules</h3>
            <strong>3 Rules</strong>
            <p>Rules that depend on formal qualifications or certification evidence.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">school</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-rule-review">
        <div>
            <h3>Rules Needing Review</h3>
            <strong>2 Rules</strong>
            <p>Rules flagged for policy update or review refresh.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">warning</span>
        </div>
    </div>
</div>

<section class="employee-filter-panel promotion-rules-filter-panel">
    <div class="employee-filter-header">
        <div>
            <h2>Filters</h2>
            <p>Refine promotion rules by department, role family, rank, rule type, and status.</p>
        </div>
        <button type="button" class="employee-filter-settings" aria-label="Filter settings">
            <span class="material-symbols-rounded">tune</span>
        </button>
    </div>

    <div class="employee-filter-grid">
        <label>
            <span>Department</span>
            <select class="form-control" data-promotion-rule-filter="department">
                <option value="">All Departments</option>
                <option value="Human Resource">Human Resource</option>
                <option value="Finance">Finance</option>
                <option value="Operations">Operations</option>
                <option value="Marketing">Marketing</option>
                <option value="Administration">Administration</option>
                <option value="Information Technology">Information Technology</option>
            </select>
        </label>

        <label>
            <span>Role Family</span>
            <select class="form-control" data-promotion-rule-filter="roleFamily">
                <option value="">All</option>
                <option value="Administrative">Administrative</option>
                <option value="Operational">Operational</option>
                <option value="Technical">Technical</option>
                <option value="Supervisory">Supervisory</option>
                <option value="Management">Management</option>
            </select>
        </label>

        <label>
            <span>Rank</span>
            <select class="form-control" data-promotion-rule-filter="rank">
                <option value="">All Ranks</option>
                <option value="Officer II">Officer II</option>
                <option value="Officer III">Officer III</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Senior Analyst">Senior Analyst</option>
                <option value="Manager">Manager</option>
            </select>
        </label>

        <label>
            <span>Rule Type</span>
            <select class="form-control" data-promotion-rule-filter="ruleType">
                <option value="">All</option>
                <option value="Department Rule">Department</option>
                <option value="Qualification Rule">Qualification</option>
                <option value="Tenure Rule">Tenure</option>
                <option value="Performance Rule">Performance</option>
                <option value="Approval Routing">Approval Routing</option>
            </select>
        </label>

        <label>
            <span>Status</span>
            <select class="form-control" data-promotion-rule-filter="status">
                <option value="">All</option>
                <option value="Active">Active</option>
                <option value="Draft">Draft</option>
                <option value="Needs Review">Needs Review</option>
                <option value="Inactive">Inactive</option>
            </select>
        </label>
    </div>
</section>

<section class="employee-records-section promotion-rules-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Promotion Rule Register</h2>
            <p>Promotion rules are static mock UI records and ready for future backend wiring.</p>
        </div>
    </div>

    <div class="employee-table-panel" data-promotion-rule-table>
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button" data-promotion-rule-sort-key="name">Rule Name <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-promotion-rule-sort-key="department">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-promotion-rule-sort-key="roleRank">Applies To Role / Rank <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-promotion-rule-sort-key="ruleType">Rule Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-promotion-rule-sort-key="condition">Condition Summary <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-promotion-rule-sort-key="approvalFlow">Approval Flow <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-promotion-rule-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-code="PR-001" data-name="HR Senior Progression Rule" data-department="Human Resource" data-role-family="Administrative" data-rank="Officer II" data-role-rank="Human Resource Officer / Officer II" data-rule-type="Qualification Rule" data-condition="Minimum 24 months in role, Bachelor Degree, and performance score above 85%." data-approval-flow="Manager > HR Director > Promotion Committee" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">HR</span>
                                <div><strong>HR Senior Progression Rule</strong><span>PR-001</span></div>
                            </div>
                        </td>
                        <td>Human Resource</td>
                        <td>Human Resource Officer / Officer II</td>
                        <td>Qualification Rule</td>
                        <td>Minimum 24 months in role, Bachelor Degree, and performance score above 85%.</td>
                        <td>Manager &gt; HR Director &gt; Promotion Committee</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><button type="button" data-promotion-rule-view aria-label="View HR Senior Progression Rule"><span class="material-symbols-rounded">visibility</span></button><button type="button" aria-label="Edit HR Senior Progression Rule"><span class="material-symbols-rounded">edit_square</span></button><button type="button" aria-label="Disable HR Senior Progression Rule"><span class="material-symbols-rounded">block</span></button></div>
                        </td>
                    </tr>
                    <tr data-code="PR-002" data-name="Finance Lead Readiness Rule" data-department="Finance" data-role-family="Management" data-rank="Officer III" data-role-rank="Finance Officer / Officer III" data-rule-type="Department Rule" data-condition="Requires audit readiness ownership, 2 successful review cycles, and leadership recommendation." data-approval-flow="Finance Lead > Director > Promotion Committee" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">FL</span>
                                <div><strong>Finance Lead Readiness Rule</strong><span>PR-002</span></div>
                            </div>
                        </td>
                        <td>Finance</td>
                        <td>Finance Officer / Officer III</td>
                        <td>Department Rule</td>
                        <td>Requires audit readiness ownership, 2 successful review cycles, and leadership recommendation.</td>
                        <td>Finance Lead &gt; Director &gt; Promotion Committee</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><button type="button" data-promotion-rule-view aria-label="View Finance Lead Readiness Rule"><span class="material-symbols-rounded">visibility</span></button><button type="button" aria-label="Edit Finance Lead Readiness Rule"><span class="material-symbols-rounded">edit_square</span></button><button type="button" aria-label="Disable Finance Lead Readiness Rule"><span class="material-symbols-rounded">block</span></button></div>
                        </td>
                    </tr>
                    <tr data-code="PR-003" data-name="Operations Supervisor Track" data-department="Operations" data-role-family="Supervisory" data-rank="Supervisor" data-role-rank="Operations Coordinator / Supervisor" data-rule-type="Performance Rule" data-condition="Requires operational incident clearance, duty roster ownership, and score above 88%." data-approval-flow="Operations Manager > Director > HR Review" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">OS</span>
                                <div><strong>Operations Supervisor Track</strong><span>PR-003</span></div>
                            </div>
                        </td>
                        <td>Operations</td>
                        <td>Operations Coordinator / Supervisor</td>
                        <td>Performance Rule</td>
                        <td>Requires operational incident clearance, duty roster ownership, and score above 88%.</td>
                        <td>Operations Manager &gt; Director &gt; HR Review</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><button type="button" data-promotion-rule-view aria-label="View Operations Supervisor Track"><span class="material-symbols-rounded">visibility</span></button><button type="button" aria-label="Edit Operations Supervisor Track"><span class="material-symbols-rounded">edit_square</span></button><button type="button" aria-label="Disable Operations Supervisor Track"><span class="material-symbols-rounded">block</span></button></div>
                        </td>
                    </tr>
                    <tr data-code="PR-004" data-name="Technical Certification Rule" data-department="Information Technology" data-role-family="Technical" data-rank="Senior Analyst" data-role-rank="Systems Analyst / Senior Analyst" data-rule-type="Qualification Rule" data-condition="Requires current certification evidence, 18 months in role, and systems availability target." data-approval-flow="IT Manager > HR Director > Promotion Committee" data-status="Needs Review">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">TC</span>
                                <div><strong>Technical Certification Rule</strong><span>PR-004</span></div>
                            </div>
                        </td>
                        <td>Information Technology</td>
                        <td>Systems Analyst / Senior Analyst</td>
                        <td>Qualification Rule</td>
                        <td>Requires current certification evidence, 18 months in role, and systems availability target.</td>
                        <td>IT Manager &gt; HR Director &gt; Promotion Committee</td>
                        <td><span class="employee-status leave">Needs Review</span></td>
                        <td>
                            <div class="employee-row-actions"><button type="button" data-promotion-rule-view aria-label="View Technical Certification Rule"><span class="material-symbols-rounded">visibility</span></button><button type="button" aria-label="Edit Technical Certification Rule"><span class="material-symbols-rounded">edit_square</span></button><button type="button" aria-label="Disable Technical Certification Rule"><span class="material-symbols-rounded">block</span></button></div>
                        </td>
                    </tr>
                    <tr data-code="PR-005" data-name="Administration Grade Review" data-department="Administration" data-role-family="Administrative" data-rank="Officer II" data-role-rank="Admin Officer / Officer II" data-rule-type="Tenure Rule" data-condition="Requires 30 months in grade, clean disciplinary record, and manager endorsement." data-approval-flow="Admin Lead > HR Director > Director General" data-status="Needs Review">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">AG</span>
                                <div><strong>Administration Grade Review</strong><span>PR-005</span></div>
                            </div>
                        </td>
                        <td>Administration</td>
                        <td>Admin Officer / Officer II</td>
                        <td>Tenure Rule</td>
                        <td>Requires 30 months in grade, clean disciplinary record, and manager endorsement.</td>
                        <td>Admin Lead &gt; HR Director &gt; Director General</td>
                        <td><span class="employee-status leave">Needs Review</span></td>
                        <td>
                            <div class="employee-row-actions"><button type="button" data-promotion-rule-view aria-label="View Administration Grade Review"><span class="material-symbols-rounded">visibility</span></button><button type="button" aria-label="Edit Administration Grade Review"><span class="material-symbols-rounded">edit_square</span></button><button type="button" aria-label="Disable Administration Grade Review"><span class="material-symbols-rounded">block</span></button></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="employee-table-footer">
            <span data-promotion-rule-table-summary>Showing 1-4 of 5 rules</span>
            <div class="employee-pagination" data-promotion-rule-pagination></div>
        </div>
    </div>
</section>

<div class="promotion-rule-modal" id="promotionRuleDetailModal" aria-hidden="true">
    <div class="promotion-rule-backdrop" data-promotion-rule-close></div>
    <section class="promotion-rule-dialog" role="dialog" aria-modal="true" aria-labelledby="promotionRuleDetailTitle">
        <div class="promotion-rule-modal-header">
            <div>
                <h2 id="promotionRuleDetailTitle">Promotion Rule</h2>
                <p>Promotion rule detail</p>
            </div>
            <button type="button" class="promotion-rule-close" data-promotion-rule-close aria-label="Close promotion rule detail">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="promotion-rule-modal-body">
            <div class="promotion-rule-detail-grid">
                <article class="promotion-rule-detail-card">
                    <span>Department</span>
                    <strong data-rule-detail-department></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Role Family</span>
                    <strong data-rule-detail-role-family></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Applies To Role / Rank</span>
                    <strong data-rule-detail-role-rank></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Rule Type</span>
                    <strong data-rule-detail-type></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Condition Summary</span>
                    <strong data-rule-detail-condition></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Approval Flow</span>
                    <strong data-rule-detail-approval-flow></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Status</span>
                    <strong data-rule-detail-status></strong>
                </article>
                <article class="promotion-rule-detail-card">
                    <span>Register Code</span>
                    <strong data-rule-detail-code></strong>
                </article>
            </div>
        </div>
    </section>
</div>

<div class="promotion-rule-modal" id="addPromotionRuleModal" aria-hidden="true">
    <div class="promotion-rule-backdrop" data-promotion-rule-form-close></div>
    <section class="promotion-rule-dialog promotion-rule-form-dialog" role="dialog" aria-modal="true" aria-labelledby="addPromotionRuleTitle">
        <div class="promotion-rule-modal-header">
            <div>
                <h2 id="addPromotionRuleTitle">Add Promotion Rule</h2>
                <p>Create a new mock promotion rule record that updates the rule register instantly.</p>
            </div>
            <button type="button" class="promotion-rule-close" data-promotion-rule-form-close aria-label="Close add promotion rule form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <form id="addPromotionRuleForm">
            <div class="promotion-rule-modal-body promotion-rule-form-body">
                <div class="promotion-rule-form-grid">
                    <label class="promotion-rule-form-field">
                        <span>Rule Name</span>
                        <input type="text" class="form-control" name="rule_name" placeholder="Enter rule name" required>
                    </label>

                    <label class="promotion-rule-form-field">
                        <span>Department</span>
                        <select class="form-control" name="department" required>
                            <option>Human Resource</option>
                            <option>Finance</option>
                            <option>Operations</option>
                            <option>Marketing</option>
                            <option>Administration</option>
                            <option>Information Technology</option>
                        </select>
                    </label>

                    <label class="promotion-rule-form-field">
                        <span>Role Family</span>
                        <input type="text" class="form-control" name="role_family" placeholder="Enter role family" required>
                    </label>

                    <label class="promotion-rule-form-field">
                        <span>Rank</span>
                        <input type="text" class="form-control" name="rank" placeholder="Enter rank" required>
                    </label>

                    <label class="promotion-rule-form-field">
                        <span>Rule Type</span>
                        <select class="form-control" name="rule_type" required>
                            <option>Department Rule</option>
                            <option>Qualification Rule</option>
                            <option>Tenure Rule</option>
                            <option>Performance Rule</option>
                            <option>Approval Routing</option>
                        </select>
                    </label>

                    <label class="promotion-rule-form-field">
                        <span>Status</span>
                        <select class="form-control" name="status" required>
                            <option>Active</option>
                            <option>Draft</option>
                            <option>Needs Review</option>
                            <option>Inactive</option>
                        </select>
                    </label>

                    <label class="promotion-rule-form-field full">
                        <span>Applies To Role / Rank</span>
                        <input type="text" class="form-control" name="role_rank" placeholder="Example: Finance Officer / Officer III" required>
                    </label>

                    <label class="promotion-rule-form-field full">
                        <span>Condition Summary</span>
                        <textarea class="form-control" name="condition" placeholder="Enter rule condition summary" required></textarea>
                    </label>

                    <label class="promotion-rule-form-field full">
                        <span>Approval Flow</span>
                        <input type="text" class="form-control" name="approval_flow" placeholder="Example: Manager > Director > Committee" required>
                    </label>
                </div>
            </div>

            <div class="promotion-rule-form-actions">
                <button type="button" class="btn btn-secondary" data-promotion-rule-form-close>Cancel</button>
                <button type="reset" class="btn btn-outline">Clear</button>
                <button type="submit" class="btn btn-primary">Save Rule</button>
            </div>
        </form>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tablePanel = document.querySelector('[data-promotion-rule-table]');
    if (!tablePanel) return;

    var table = tablePanel.querySelector('.employee-data-table');
    var tbody = table ? table.querySelector('tbody') : null;
    var summary = tablePanel.querySelector('[data-promotion-rule-table-summary]');
    var pagination = tablePanel.querySelector('[data-promotion-rule-pagination]');
    var filters = document.querySelectorAll('[data-promotion-rule-filter]');
    var modal = document.getElementById('promotionRuleDetailModal');
    var modalTitle = document.getElementById('promotionRuleDetailTitle');
    var addModal = document.getElementById('addPromotionRuleModal');
    var addForm = document.getElementById('addPromotionRuleForm');
    var addOpenButton = document.querySelector('[data-add-promotion-rule-open]');
    var modalFields = modal ? {
        department: modal.querySelector('[data-rule-detail-department]'),
        roleFamily: modal.querySelector('[data-rule-detail-role-family]'),
        roleRank: modal.querySelector('[data-rule-detail-role-rank]'),
        ruleType: modal.querySelector('[data-rule-detail-type]'),
        condition: modal.querySelector('[data-rule-detail-condition]'),
        approvalFlow: modal.querySelector('[data-rule-detail-approval-flow]'),
        status: modal.querySelector('[data-rule-detail-status]'),
        code: modal.querySelector('[data-rule-detail-code]')
    } : {};

    if (!table || !tbody || !summary || !pagination) return;

    var pageSize = 4;
    var allRows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
    var currentPage = 1;
    var sortKey = '';
    var sortDirection = 'asc';

    function getFilterValue(name) {
        var filter = document.querySelector('[data-promotion-rule-filter="' + name + '"]');
        return filter ? filter.value.trim().toLowerCase() : '';
    }

    function getRowValue(row, key) {
        return (row.dataset[key] || '').trim();
    }

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function getStatusClass(status) {
        if (status === 'Active') return 'active';
        if (status === 'Inactive') return 'inactive';
        return 'leave';
    }

    function getInitials(value) {
        return String(value)
            .split(/\s+/)
            .filter(Boolean)
            .map(function (part) {
                return part.charAt(0);
            })
            .join('')
            .slice(0, 2)
            .toUpperCase() || 'PR';
    }

    function getNextRuleCode() {
        var maxCode = allRows.reduce(function (max, row) {
            var number = parseInt((getRowValue(row, 'code').match(/\d+/) || ['0'])[0], 10);
            return number > max ? number : max;
        }, 0);

        return 'PR-' + String(maxCode + 1).padStart(3, '0');
    }

    function setModalField(field, value) {
        if (field) {
            field.textContent = value || '--';
        }
    }

    function openRuleModal(row) {
        if (!modal || !row) return;

        if (modalTitle) {
            modalTitle.textContent = getRowValue(row, 'name') || 'Promotion Rule';
        }

        setModalField(modalFields.department, getRowValue(row, 'department'));
        setModalField(modalFields.roleFamily, getRowValue(row, 'roleFamily'));
        setModalField(modalFields.roleRank, getRowValue(row, 'roleRank'));
        setModalField(modalFields.ruleType, getRowValue(row, 'ruleType'));
        setModalField(modalFields.condition, getRowValue(row, 'condition'));
        setModalField(modalFields.approvalFlow, getRowValue(row, 'approvalFlow'));
        setModalField(modalFields.status, getRowValue(row, 'status'));
        setModalField(modalFields.code, getRowValue(row, 'code'));

        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeRuleModal() {
        if (!modal) return;

        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function openAddModal() {
        if (!addModal || !addForm) return;

        addModal.classList.add('open');
        addModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');

        var firstInput = addForm.querySelector('input, select, textarea');
        if (firstInput) {
            firstInput.focus();
        }
    }

    function closeAddModal() {
        if (!addModal) return;

        addModal.classList.remove('open');
        addModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function createRuleRow(rule) {
        var row = document.createElement('tr');
        row.dataset.code = rule.code;
        row.dataset.name = rule.name;
        row.dataset.department = rule.department;
        row.dataset.roleFamily = rule.roleFamily;
        row.dataset.rank = rule.rank;
        row.dataset.roleRank = rule.roleRank;
        row.dataset.ruleType = rule.ruleType;
        row.dataset.condition = rule.condition;
        row.dataset.approvalFlow = rule.approvalFlow;
        row.dataset.status = rule.status;

        row.innerHTML =
            '<td>' +
                '<div class="employee-table-name"><span class="employee-avatar">' + escapeHtml(getInitials(rule.name)) + '</span>' +
                    '<div><strong>' + escapeHtml(rule.name) + '</strong><span>' + escapeHtml(rule.code) + '</span></div>' +
                '</div>' +
            '</td>' +
            '<td>' + escapeHtml(rule.department) + '</td>' +
            '<td>' + escapeHtml(rule.roleRank) + '</td>' +
            '<td>' + escapeHtml(rule.ruleType) + '</td>' +
            '<td>' + escapeHtml(rule.condition) + '</td>' +
            '<td>' + escapeHtml(rule.approvalFlow) + '</td>' +
            '<td><span class="employee-status ' + escapeHtml(getStatusClass(rule.status)) + '">' + escapeHtml(rule.status) + '</span></td>' +
            '<td>' +
                '<div class="employee-row-actions"><button type="button" data-promotion-rule-view aria-label="View ' + escapeHtml(rule.name) + '"><span class="material-symbols-rounded">visibility</span></button><button type="button" aria-label="Edit ' + escapeHtml(rule.name) + '"><span class="material-symbols-rounded">edit_square</span></button><button type="button" aria-label="Disable ' + escapeHtml(rule.name) + '"><span class="material-symbols-rounded">block</span></button></div>' +
            '</td>';

        return row;
    }

    function getFilteredRows() {
        var department = getFilterValue('department');
        var roleFamily = getFilterValue('roleFamily');
        var rank = getFilterValue('rank');
        var ruleType = getFilterValue('ruleType');
        var status = getFilterValue('status');

        return allRows.filter(function (row) {
            return (!department || getRowValue(row, 'department').toLowerCase() === department)
                && (!roleFamily || getRowValue(row, 'roleFamily').toLowerCase() === roleFamily)
                && (!rank || getRowValue(row, 'rank').toLowerCase() === rank)
                && (!ruleType || getRowValue(row, 'ruleType').toLowerCase() === ruleType)
                && (!status || getRowValue(row, 'status').toLowerCase() === status);
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
        summary.textContent = 'Showing ' + from + '-' + to + ' of ' + filteredRows.length + ' rules';
        renderPagination(totalPages);
    }

    table.querySelectorAll('[data-promotion-rule-sort-key]').forEach(function (button) {
        button.addEventListener('click', function () {
            var nextSortKey = button.dataset.promotionRuleSortKey;

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
        var viewButton = event.target.closest('[data-promotion-rule-view]');
        if (viewButton) {
            openRuleModal(viewButton.closest('tr'));
        }
    });

    if (modal) {
        modal.querySelectorAll('[data-promotion-rule-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeRuleModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('open')) {
                closeRuleModal();
            }
        });
    }

    if (addOpenButton) {
        addOpenButton.addEventListener('click', openAddModal);
    }

    if (addModal) {
        addModal.querySelectorAll('[data-promotion-rule-form-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeAddModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && addModal.classList.contains('open')) {
                closeAddModal();
            }
        });
    }

    if (addForm) {
        addForm.addEventListener('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(addForm);
            var rule = {
                code: getNextRuleCode(),
                name: formData.get('rule_name') || '',
                department: formData.get('department') || '',
                roleFamily: formData.get('role_family') || '',
                rank: formData.get('rank') || '',
                ruleType: formData.get('rule_type') || '',
                status: formData.get('status') || '',
                roleRank: formData.get('role_rank') || '',
                condition: formData.get('condition') || '',
                approvalFlow: formData.get('approval_flow') || ''
            };

            var row = createRuleRow(rule);
            allRows.push(row);
            tbody.appendChild(row);
            currentPage = Math.ceil(allRows.length / pageSize);
            closeAddModal();
            addForm.reset();
            render();
        });
    }

    render();
});
</script>

<?php include '../../includes/footer.php'; ?>
