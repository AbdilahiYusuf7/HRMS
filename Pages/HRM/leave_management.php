<?php
$pageTitle = "Leave Management";
$activePage = "leave-management";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .leave-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 44px;
    }

    .leave-page-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .leave-page-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 540px;
    }

    .leave-action-grid {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
        min-width: min(720px, 100%);
    }

    .leave-action-card {
        width: 64px;
        min-height: 64px;
        border: 1px solid rgba(191, 219, 254, 0.82);
        border-radius: var(--radius-md);
        background-color: #bae6fd;
        color: var(--neutral-darkest);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        padding: 10px;
        font-size: 1rem;
        font-weight: 900;
        line-height: 1.35;
        text-align: left;
        cursor: pointer;
        overflow: hidden;
        white-space: nowrap;
        transition: width 260ms ease, transform 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
    }

    .leave-action-card:hover,
    .leave-action-card:focus-visible {
        width: 220px;
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        outline: none;
    }

    .leave-action-card.primary {
        background-color: var(--primary-color);
        color: var(--neutral-white);
        box-shadow: 0 18px 34px rgba(15, 76, 129, 0.22);
    }

    .leave-action-icon {
        order: 2;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.42);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
    }

    .leave-action-card:not(.primary) .leave-action-icon {
        background-color: rgba(255, 255, 255, 0.55);
        color: var(--primary-color);
    }

    .leave-action-icon .material-symbols-rounded {
        font-size: 21px;
    }

    .leave-action-text {
        order: 1;
        display: block;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        transform: translateX(10px);
        transition: max-width 260ms ease, opacity 180ms ease, transform 260ms ease;
    }

    .leave-action-text strong {
        display: block;
        color: inherit;
        font-size: 0.92rem;
        line-height: 1.25;
    }

    .leave-action-text span {
        color: rgba(15, 23, 42, 0.62);
        display: block;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        line-height: 1.25;
        margin-top: 2px;
    }

    .leave-action-card.primary .leave-action-text span {
        color: rgba(255, 255, 255, 0.72);
    }

    .leave-action-card:hover .leave-action-text,
    .leave-action-card:focus-visible .leave-action-text {
        max-width: 150px;
        opacity: 1;
        transform: translateX(0);
    }

    .leave-insights-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .leave-insights-grid .employee-insight-card {
        min-height: 200px;
    }

    .leave-analytics-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
    }

    .leave-chart-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 28px;
        overflow: hidden;
    }

    .leave-chart-header {
        margin-bottom: 18px;
    }

    .leave-chart-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .leave-chart-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .leave-chart-svg {
        display: block;
        width: 100%;
        height: auto;
        overflow: visible;
    }

    .leave-chart-grid line {
        stroke: rgba(203, 213, 225, 0.8);
        stroke-width: 1;
    }

    .leave-chart-axis line {
        stroke: rgba(148, 163, 184, 0.7);
        stroke-width: 1.2;
    }

    .leave-chart-scale text {
        fill: #475569;
        font-size: 14px;
        font-weight: 700;
    }

    .leave-chart-bar {
        rx: 8;
        ry: 8;
        transition: opacity 180ms ease;
    }

    .leave-chart-bar:hover {
        opacity: 0.82;
    }

    .leave-chart-categories {
        display: grid;
        gap: 10px;
        margin: 12px 0 18px 58px;
    }

    .leave-chart-categories.stack {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }

    .leave-chart-categories.department {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }

    .leave-chart-categories span {
        color: #475569;
        display: block;
        font-size: 0.78rem;
        font-weight: 800;
        line-height: 1.18;
        text-align: center;
    }

    .leave-chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .leave-chart-legend span {
        color: #334155;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.86rem;
        font-weight: 800;
    }

    .leave-chart-legend i {
        width: 13px;
        height: 13px;
        border-radius: 3px;
        display: inline-block;
    }

    .leave-table-section {
        margin-top: 32px;
    }

    .leave-rule-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 0;
        border-radius: 999px;
        padding: 7px 14px;
        font-size: 0.78rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .leave-rule-badge.paid {
        background-color: #dcfce7;
        color: #166534;
    }

    .leave-rule-badge.unpaid {
        background-color: #f1f5f9;
        color: #475569;
    }

    .leave-rule-badge.approval {
        background-color: #fef3c7;
        color: #92400e;
    }

    .leave-request-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .leave-request-action {
        min-height: 42px;
        border: none;
        border-radius: var(--radius-sm);
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 14px;
        font-size: 0.82rem;
        font-weight: 900;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .leave-request-action.icon-only {
        width: 44px;
        padding: 10px;
    }

    .leave-request-action:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
        transform: translateY(-2px);
    }

    .leave-request-action.approve {
        background-color: #dcfce7;
        color: #166534;
    }

    .leave-request-action.approve:hover {
        background-color: #16a34a;
        color: var(--neutral-white);
    }

    .leave-request-action.reject {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .leave-request-action.reject:hover {
        background-color: #ef4444;
        color: var(--neutral-white);
    }

    .leave-request-action .material-symbols-rounded {
        font-size: 18px;
    }

    .leave-modal {
        position: fixed;
        inset: 0;
        z-index: 700;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .leave-modal.open {
        display: flex;
    }

    .leave-modal-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .leave-modal-dialog {
        position: relative;
        width: min(960px, 100%);
        max-height: min(760px, calc(100vh - 64px));
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .leave-modal-dialog.narrow {
        width: min(780px, 100%);
    }

    .leave-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
    }

    .leave-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 8px;
    }

    .leave-modal-header p {
        color: var(--neutral-gray);
        font-size: 0.98rem;
        font-weight: 500;
    }

    .leave-modal-close {
        width: 54px;
        height: 54px;
        border: none;
        border-radius: var(--radius-md);
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex: 0 0 auto;
        transition: var(--transition-fast);
    }

    .leave-modal-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .leave-modal-body {
        overflow: auto;
        padding: 32px;
    }

    .leave-modal-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px 24px;
    }

    .leave-modal-field.full {
        grid-column: 1 / -1;
    }

    .leave-modal-field span {
        color: #475569;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .leave-modal-field textarea {
        min-height: 126px;
        resize: vertical;
    }

    .leave-modal-divider {
        border: 0;
        border-top: 1px solid rgba(203, 213, 225, 0.62);
        margin: 28px 0;
    }

    .leave-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .leave-modal-insights {
        display: grid;
        grid-template-columns: repeat(3, minmax(160px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .leave-modal-insight {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.78);
        padding: 18px;
    }

    .leave-modal-insight span {
        color: #64748b;
        display: block;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .leave-modal-insight strong {
        color: var(--neutral-darkest);
        display: block;
        font-size: 1.45rem;
    }

    .leave-modal-note-card {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.86), rgba(255, 241, 247, 0.72));
        padding: 20px;
    }

    .leave-modal-note-card h3 {
        color: var(--neutral-darkest);
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .leave-modal-note-card p {
        color: var(--neutral-gray);
        font-size: 0.9rem;
        font-weight: 500;
        line-height: 1.45;
    }

    .leave-supporting-layout {
        display: grid;
        grid-template-columns: minmax(260px, 0.8fr) minmax(420px, 2.15fr);
        gap: 24px;
    }

    .leave-proof-notes,
    .leave-proof-preview {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.88), rgba(248, 250, 252, 0.74), rgba(255, 241, 247, 0.72));
        min-height: 420px;
        padding: 28px;
    }

    .leave-proof-notes span {
        color: #64748b;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.18em;
        margin-bottom: 22px;
        text-transform: uppercase;
    }

    .leave-proof-notes p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.55;
    }

    .leave-proof-preview {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        text-align: left;
    }

    .leave-proof-preview > strong {
        color: #475569;
        display: block;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .leave-evidence-document {
        background-color: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(191, 219, 254, 0.92);
        border-radius: var(--radius-md);
        box-shadow: 0 18px 46px rgba(15, 23, 42, 0.08);
        color: var(--neutral-darkest);
        min-height: 360px;
        padding: 26px;
    }

    .leave-evidence-document-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 18px;
        margin-bottom: 22px;
    }

    .leave-evidence-seal {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background-color: var(--primary-color);
        color: var(--neutral-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
    }

    .leave-evidence-document-header h3 {
        color: var(--neutral-darkest);
        font-size: 1.08rem;
        margin-bottom: 5px;
    }

    .leave-evidence-document-header p,
    .leave-evidence-meta {
        color: #64748b;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .leave-evidence-document-body h4 {
        color: var(--neutral-darkest);
        font-size: 1.18rem;
        margin-bottom: 14px;
    }

    .leave-evidence-document-body p {
        color: #475569;
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.62;
        margin-bottom: 16px;
    }

    .leave-evidence-fields {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin: 18px 0;
    }

    .leave-evidence-field {
        border: 1px solid rgba(203, 213, 225, 0.75);
        border-radius: var(--radius-sm);
        padding: 12px;
    }

    .leave-evidence-field span {
        color: #64748b;
        display: block;
        font-size: 0.7rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .leave-evidence-field strong {
        color: var(--neutral-darkest);
        display: block;
        font-size: 0.9rem;
    }

    .leave-evidence-signature {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
        margin-top: 28px;
    }

    .leave-evidence-signature div {
        border-top: 1px solid #334155;
        color: #64748b;
        font-size: 0.76rem;
        font-weight: 800;
        padding-top: 8px;
        text-align: center;
    }

    @media (max-width: 1180px) {
        .leave-page-header {
            flex-direction: column;
        }

        .leave-action-grid {
            min-width: 100%;
        }

        .leave-analytics-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .leave-action-grid,
        .leave-insights-grid {
            grid-template-columns: 1fr;
        }

        .leave-action-card {
            width: 60px;
            min-height: 60px;
        }

        .leave-action-card:hover,
        .leave-action-card:focus-visible {
            width: 210px;
        }

        .leave-chart-panel {
            padding: 22px;
        }

        .leave-chart-categories {
            margin-left: 0;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .leave-chart-categories.stack {
            grid-template-columns: repeat(5, 92px);
        }

        .leave-chart-categories.department {
            grid-template-columns: repeat(6, 96px);
        }

        .leave-modal {
            padding: 16px;
        }

        .leave-modal-header,
        .leave-modal-body {
            padding: 22px;
        }

        .leave-modal-form-grid,
        .leave-modal-insights,
        .leave-supporting-layout {
            grid-template-columns: 1fr;
        }

        .leave-proof-notes,
        .leave-proof-preview {
            min-height: auto;
        }

        .leave-modal-actions {
            flex-direction: column-reverse;
        }
    }
</style>

<div class="leave-page-header">
    <div>
        <h1>Leave Management</h1>
        <p>Overview of leave allowances, approval flow, and employee leave requests.</p>
    </div>

    <div class="leave-action-grid">
        <button type="button" class="leave-action-card" aria-label="Leave Type" data-leave-modal-target="leaveTypeModal">
            <span class="leave-action-icon"><span class="material-symbols-rounded">add</span></span>
            <span class="leave-action-text"><strong>Leave Type</strong><span>Configure rules</span></span>
        </button>
        <button type="button" class="leave-action-card" aria-label="New Leave" data-leave-modal-target="newLeaveModal">
            <span class="leave-action-icon"><span class="material-symbols-rounded">add_circle</span></span>
            <span class="leave-action-text"><strong>New Leave</strong><span>Create request</span></span>
        </button>
    </div>
</div>

<div class="leave-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Total Allowed Leaves</h3>
            <strong>40 Days</strong>
            <p>Maximum allowance is 5 days per employee</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">calendar_month</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>Total Leaves Approved</h3>
            <strong>5 Requests</strong>
            <p>Requests approved in the current sample set</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">check_circle</span>
        </div>
    </div>

    <div class="employee-insight-card least-performing">
        <div>
            <h3>Total Leaves Rejected</h3>
            <strong>3 Requests</strong>
            <p>Requests rejected in the current sample set</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">cancel</span>
        </div>
    </div>
</div>

<div class="leave-analytics-grid">
    <section class="leave-chart-panel">
        <div class="leave-chart-header">
            <h2>Leave Type Request Stack</h2>
            <p>Stacked request totals by leave type with approved, rejected, and pending counts.</p>
        </div>

        <svg class="leave-chart-svg" viewBox="0 0 620 282" role="img" aria-label="Leave type request stack chart">
            <g class="leave-chart-grid">
                <line x1="58" y1="42" x2="592" y2="42"></line>
                <line x1="58" y1="78.7" x2="592" y2="78.7"></line>
                <line x1="58" y1="115.3" x2="592" y2="115.3"></line>
                <line x1="58" y1="152" x2="592" y2="152"></line>
                <line x1="58" y1="188.7" x2="592" y2="188.7"></line>
                <line x1="58" y1="225.3" x2="592" y2="225.3"></line>
                <line x1="58" y1="262" x2="592" y2="262"></line>
            </g>
            <g class="leave-chart-axis">
                <line x1="58" y1="42" x2="58" y2="262"></line>
                <line x1="58" y1="262" x2="592" y2="262"></line>
            </g>
            <g class="leave-chart-scale">
                <text x="30" y="47">6</text>
                <text x="30" y="84">5</text>
                <text x="30" y="120">4</text>
                <text x="30" y="157">3</text>
                <text x="30" y="194">2</text>
                <text x="30" y="230">1</text>
                <text x="30" y="267">0</text>
            </g>

            <g>
                <rect class="leave-chart-bar" x="88" y="152" width="80" height="110" fill="#4f46e5" data-chart-title="Annual Leave" data-chart-value="3 total requests"></rect>
                <rect class="leave-chart-bar" x="88" y="78.7" width="80" height="73.3" fill="#10b981" data-chart-title="Annual Leave" data-chart-value="2 approved"></rect>
                <rect class="leave-chart-bar" x="88" y="42" width="80" height="36.7" fill="#f59e0b" data-chart-title="Annual Leave" data-chart-value="1 pending"></rect>

                <rect class="leave-chart-bar" x="198" y="152" width="80" height="110" fill="#4f46e5" data-chart-title="Sick Leave" data-chart-value="3 total requests"></rect>
                <rect class="leave-chart-bar" x="198" y="115.3" width="80" height="36.7" fill="#10b981" data-chart-title="Sick Leave" data-chart-value="1 approved"></rect>
                <rect class="leave-chart-bar" x="198" y="78.7" width="80" height="36.7" fill="#ef4444" data-chart-title="Sick Leave" data-chart-value="1 rejected"></rect>
                <rect class="leave-chart-bar" x="198" y="42" width="80" height="36.7" fill="#f59e0b" data-chart-title="Sick Leave" data-chart-value="1 pending"></rect>

                <rect class="leave-chart-bar" x="308" y="188.7" width="80" height="73.3" fill="#4f46e5" data-chart-title="Emergency Leave" data-chart-value="2 total requests"></rect>
                <rect class="leave-chart-bar" x="308" y="152" width="80" height="36.7" fill="#10b981" data-chart-title="Emergency Leave" data-chart-value="1 approved"></rect>
                <rect class="leave-chart-bar" x="308" y="115.3" width="80" height="36.7" fill="#f59e0b" data-chart-title="Emergency Leave" data-chart-value="1 pending"></rect>

                <rect class="leave-chart-bar" x="418" y="152" width="80" height="110" fill="#4f46e5" data-chart-title="Casual Leave" data-chart-value="3 total requests"></rect>
                <rect class="leave-chart-bar" x="418" y="115.3" width="80" height="36.7" fill="#10b981" data-chart-title="Casual Leave" data-chart-value="1 approved"></rect>
                <rect class="leave-chart-bar" x="418" y="78.7" width="80" height="36.7" fill="#ef4444" data-chart-title="Casual Leave" data-chart-value="1 rejected"></rect>
                <rect class="leave-chart-bar" x="418" y="42" width="80" height="36.7" fill="#f59e0b" data-chart-title="Casual Leave" data-chart-value="1 pending"></rect>

                <rect class="leave-chart-bar" x="528" y="225.3" width="80" height="36.7" fill="#4f46e5" data-chart-title="Study Leave" data-chart-value="1 total request"></rect>
                <rect class="leave-chart-bar" x="528" y="188.7" width="80" height="36.7" fill="#ef4444" data-chart-title="Study Leave" data-chart-value="1 rejected"></rect>
            </g>

        </svg>

        <div class="leave-chart-categories stack" aria-label="Leave type chart categories">
            <span>Annual Leave</span>
            <span>Sick Leave</span>
            <span>Emergency Leave</span>
            <span>Casual Leave</span>
            <span>Study Leave</span>
        </div>

        <div class="leave-chart-legend">
            <span><i style="background-color: #4f46e5;"></i>Total Requests</span>
            <span><i style="background-color: #10b981;"></i>Approved</span>
            <span><i style="background-color: #ef4444;"></i>Rejected</span>
            <span><i style="background-color: #f59e0b;"></i>Pending</span>
        </div>
    </section>

    <section class="leave-chart-panel">
        <div class="leave-chart-header">
            <h2>Department Leave Comparison</h2>
            <p>Grouped bars showing requests, approved, and rejected counts by department.</p>
        </div>

        <svg class="leave-chart-svg" viewBox="0 0 620 292" role="img" aria-label="Department leave comparison chart">
            <g class="leave-chart-grid">
                <line x1="58" y1="52" x2="592" y2="52"></line>
                <line x1="58" y1="125.3" x2="592" y2="125.3"></line>
                <line x1="58" y1="198.7" x2="592" y2="198.7"></line>
                <line x1="58" y1="272" x2="592" y2="272"></line>
            </g>
            <g class="leave-chart-axis">
                <line x1="58" y1="52" x2="58" y2="272"></line>
                <line x1="58" y1="272" x2="592" y2="272"></line>
            </g>
            <g class="leave-chart-scale">
                <text x="30" y="57">3</text>
                <text x="30" y="130">2</text>
                <text x="30" y="204">1</text>
                <text x="30" y="277">0</text>
            </g>

            <g>
                <rect class="leave-chart-bar" x="78" y="125.3" width="20" height="146.7" fill="#4f46e5" data-chart-title="Human Resource" data-chart-value="2 requests"></rect>
                <rect class="leave-chart-bar" x="104" y="198.7" width="20" height="73.3" fill="#10b981" data-chart-title="Human Resource" data-chart-value="1 approved"></rect>
                <rect class="leave-chart-bar" x="130" y="198.7" width="20" height="73.3" fill="#ef4444" data-chart-title="Human Resource" data-chart-value="1 rejected"></rect>

                <rect class="leave-chart-bar" x="166" y="52" width="20" height="220" fill="#4f46e5" data-chart-title="Finance" data-chart-value="3 requests"></rect>
                <rect class="leave-chart-bar" x="192" y="52" width="20" height="220" fill="#10b981" data-chart-title="Finance" data-chart-value="3 approved"></rect>

                <rect class="leave-chart-bar" x="254" y="125.3" width="20" height="146.7" fill="#4f46e5" data-chart-title="Operations" data-chart-value="2 requests"></rect>

                <rect class="leave-chart-bar" x="342" y="125.3" width="20" height="146.7" fill="#4f46e5" data-chart-title="Marketing" data-chart-value="2 requests"></rect>
                <rect class="leave-chart-bar" x="394" y="125.3" width="20" height="146.7" fill="#ef4444" data-chart-title="Marketing" data-chart-value="2 rejected"></rect>

                <rect class="leave-chart-bar" x="430" y="198.7" width="20" height="73.3" fill="#4f46e5" data-chart-title="Administration" data-chart-value="1 request"></rect>
                <rect class="leave-chart-bar" x="456" y="198.7" width="20" height="73.3" fill="#10b981" data-chart-title="Administration" data-chart-value="1 approved"></rect>

                <rect class="leave-chart-bar" x="518" y="125.3" width="20" height="146.7" fill="#4f46e5" data-chart-title="Information Technology" data-chart-value="2 requests"></rect>
            </g>

        </svg>

        <div class="leave-chart-categories department" aria-label="Department chart categories">
            <span>Human Resource</span>
            <span>Finance</span>
            <span>Operations</span>
            <span>Marketing</span>
            <span>Administration</span>
            <span>Information Technology</span>
        </div>

        <div class="leave-chart-legend">
            <span><i style="background-color: #4f46e5;"></i>Requests</span>
            <span><i style="background-color: #10b981;"></i>Approved</span>
            <span><i style="background-color: #ef4444;"></i>Rejected</span>
        </div>
    </section>
</div>

<section class="employee-records-section leave-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Leave Types & Rules</h2>
            <p>Configured leave types with yearly limits, paid status, and approval requirements.</p>
        </div>
    </div>

    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Leave Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Max Days / Year <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Paid Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Approval Rule <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Description <span class="material-symbols-rounded">unfold_more</span></button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Annual Leave</strong></td>
                        <td>30 Days</td>
                        <td><span class="leave-rule-badge paid">Paid</span></td>
                        <td><span class="leave-rule-badge approval">Needs Approval</span></td>
                        <td>Standard yearly leave allowance for active employees.</td>
                    </tr>
                    <tr>
                        <td><strong>Sick Leave</strong></td>
                        <td>14 Days</td>
                        <td><span class="leave-rule-badge paid">Paid</span></td>
                        <td><span class="leave-rule-badge approval">Needs Approval</span></td>
                        <td>Medical note required when requested by HR.</td>
                    </tr>
                    <tr>
                        <td><strong>Emergency Leave</strong></td>
                        <td>5 Days</td>
                        <td><span class="leave-rule-badge paid">Paid</span></td>
                        <td><span class="leave-rule-badge approval">Needs Approval</span></td>
                        <td>Urgent personal or family emergency leave.</td>
                    </tr>
                    <tr>
                        <td><strong>Casual Leave</strong></td>
                        <td>7 Days</td>
                        <td><span class="leave-rule-badge paid">Paid</span></td>
                        <td><span class="leave-rule-badge approval">Needs Approval</span></td>
                        <td>Short planned leave subject to branch coverage.</td>
                    </tr>
                    <tr>
                        <td><strong>Study Leave</strong></td>
                        <td>10 Days</td>
                        <td><span class="leave-rule-badge unpaid">Unpaid</span></td>
                        <td><span class="leave-rule-badge approval">Needs Approval</span></td>
                        <td>Education-related absence after manager review.</td>
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

<section class="employee-records-section leave-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Employee Leave Requests</h2>
            <p>Recent leave requests across branches with mixed approval statuses.</p>
        </div>
    </div>

    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Branch <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Leave Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Days <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Dates <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Submitted <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="employee-table-name"><span class="employee-avatar">CC</span><div><strong>Cabdiraxmaan Cali</strong><span>EMP-0001</span></div></div></td>
                        <td>Human Resource</td>
                        <td>Idaacada Branch</td>
                        <td>Annual Leave</td>
                        <td>4</td>
                        <td>2026-04-28 to 2026-05-01</td>
                        <td>2026-04-20</td>
                        <td><span class="employee-status active">Approved</span></td>
                        <td>
                            <div class="leave-request-actions">
                                <button type="button" class="leave-request-action icon-only" aria-label="View Cabdiraxmaan Cali leave request" data-leave-request-view data-employee="Cabdiraxmaan Cali" data-number="EMP-0001" data-department="Human Resource" data-branch="Idaacada Branch" data-type="Annual Leave" data-days="4" data-dates="2026-04-28 to 2026-05-01" data-submitted="2026-04-20" data-status="Approved"><span class="material-symbols-rounded">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="employee-table-name"><span class="employee-avatar">FX</span><div><strong>Fadumo Xasan</strong><span>EMP-0002</span></div></div></td>
                        <td>Finance</td>
                        <td>Xero Awr Branch</td>
                        <td>Sick Leave</td>
                        <td>2</td>
                        <td>2026-04-26 to 2026-04-27</td>
                        <td>2026-04-24</td>
                        <td><span class="employee-status active">Approved</span></td>
                        <td>
                            <div class="leave-request-actions">
                                <button type="button" class="leave-request-action icon-only" aria-label="View Fadumo Xasan leave request" data-leave-request-view data-employee="Fadumo Xasan" data-number="EMP-0002" data-department="Finance" data-branch="Xero Awr Branch" data-type="Sick Leave" data-days="2" data-dates="2026-04-26 to 2026-04-27" data-submitted="2026-04-24" data-status="Approved"><span class="material-symbols-rounded">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="employee-table-name"><span class="employee-avatar">MA</span><div><strong>Mahad Axmed</strong><span>EMP-0003</span></div></div></td>
                        <td>Operations</td>
                        <td>Togdheer Branch</td>
                        <td>Emergency Leave</td>
                        <td>1</td>
                        <td>2026-04-29 to 2026-04-29</td>
                        <td>2026-04-25</td>
                        <td><span class="leave-rule-badge approval">Pending</span></td>
                        <td>
                            <div class="leave-request-actions">
                                <button type="button" class="leave-request-action icon-only" aria-label="View Mahad Axmed leave request" data-leave-request-view data-employee="Mahad Axmed" data-number="EMP-0003" data-department="Operations" data-branch="Togdheer Branch" data-type="Emergency Leave" data-days="1" data-dates="2026-04-29 to 2026-04-29" data-submitted="2026-04-25" data-status="Pending"><span class="material-symbols-rounded">visibility</span></button>
                                <button type="button" class="leave-request-action icon-only approve" aria-label="Approve Mahad Axmed leave request"><span class="material-symbols-rounded">check</span></button>
                                <button type="button" class="leave-request-action icon-only reject" aria-label="Reject Mahad Axmed leave request"><span class="material-symbols-rounded">close</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="employee-table-name"><span class="employee-avatar">SM</span><div><strong>Sahra Maxamed</strong><span>EMP-0004</span></div></div></td>
                        <td>Marketing</td>
                        <td>Calaamada Branch</td>
                        <td>Casual Leave</td>
                        <td>3</td>
                        <td>2026-05-03 to 2026-05-05</td>
                        <td>2026-04-22</td>
                        <td><span class="employee-status inactive">Rejected</span></td>
                        <td>
                            <div class="leave-request-actions">
                                <button type="button" class="leave-request-action icon-only" aria-label="View Sahra Maxamed leave request" data-leave-request-view data-employee="Sahra Maxamed" data-number="EMP-0004" data-department="Marketing" data-branch="Calaamada Branch" data-type="Casual Leave" data-days="3" data-dates="2026-05-03 to 2026-05-05" data-submitted="2026-04-22" data-status="Rejected"><span class="material-symbols-rounded">visibility</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="employee-table-name"><span class="employee-avatar">HA</span><div><strong>Hodan Ali</strong><span>EMP-0005</span></div></div></td>
                        <td>Administration</td>
                        <td>Masalaha Branch</td>
                        <td>Annual Leave</td>
                        <td>5</td>
                        <td>2026-05-10 to 2026-05-14</td>
                        <td>2026-04-23</td>
                        <td><span class="employee-status active">Approved</span></td>
                        <td>
                            <div class="leave-request-actions">
                                <button type="button" class="leave-request-action icon-only" aria-label="View Hodan Ali leave request" data-leave-request-view data-employee="Hodan Ali" data-number="EMP-0005" data-department="Administration" data-branch="Masalaha Branch" data-type="Annual Leave" data-days="5" data-dates="2026-05-10 to 2026-05-14" data-submitted="2026-04-23" data-status="Approved"><span class="material-symbols-rounded">visibility</span></button>
                            </div>
                        </td>
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

<div class="leave-modal" id="leaveAnalyticsModal" aria-hidden="true">
    <div class="leave-modal-backdrop" data-leave-modal-close></div>
    <section class="leave-modal-dialog narrow" role="dialog" aria-modal="true" aria-labelledby="leaveAnalyticsTitle">
        <div class="leave-modal-header">
            <div>
                <h2 id="leaveAnalyticsTitle">Smart Leave Analytics</h2>
                <p>AI-assisted leave risk, approval flow, and staffing impact indicators.</p>
            </div>
            <button type="button" class="leave-modal-close" data-leave-modal-close aria-label="Close leave analytics">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div class="leave-modal-body">
            <div class="leave-modal-insights">
                <div class="leave-modal-insight">
                    <span>Approval Load</span>
                    <strong>8 Open</strong>
                </div>
                <div class="leave-modal-insight">
                    <span>Coverage Risk</span>
                    <strong>Low</strong>
                </div>
                <div class="leave-modal-insight">
                    <span>Avg Response</span>
                    <strong>1.4 Days</strong>
                </div>
            </div>
            <div class="leave-modal-note-card">
                <h3>Recommended HR Focus</h3>
                <p>Finance has the highest approved leave concentration this week. Review duty coverage before approving additional overlapping requests.</p>
            </div>
        </div>
    </section>
</div>

<div class="leave-modal" id="leaveRequestDetailModal" aria-hidden="true">
    <div class="leave-modal-backdrop" data-leave-modal-close></div>
    <section class="leave-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="leaveRequestDetailTitle">
        <div class="leave-modal-header">
            <div>
                <h2 id="leaveRequestDetailTitle">Leave Supporting Document</h2>
                <p data-leave-detail-subtitle>Review submitted leave request and supporting proof.</p>
            </div>
            <button type="button" class="leave-modal-close" data-leave-modal-close aria-label="Close leave request details">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div class="leave-modal-body">
            <div class="leave-supporting-layout">
                <aside class="leave-proof-notes">
                    <span>Proof Notes</span>
                    <p data-leave-proof-note></p>
                </aside>
                <div class="leave-proof-preview">
                    <article class="leave-evidence-document">
                        <div class="leave-evidence-document-header">
                            <div>
                                <h3 data-leave-proof-title>Supporting Document</h3>
                                <p>HR Leave Management Evidence</p>
                            </div>
                            <div class="leave-evidence-seal">
                                <span class="material-symbols-rounded" data-leave-proof-icon>description</span>
                            </div>
                        </div>
                        <div class="leave-evidence-document-body">
                            <p class="leave-evidence-meta" data-leave-proof-file></p>
                            <h4 data-leave-evidence-heading>Leave Evidence Summary</h4>
                            <p data-leave-evidence-body></p>
                            <div class="leave-evidence-fields">
                                <div class="leave-evidence-field">
                                    <span>Employee</span>
                                    <strong data-leave-evidence-employee></strong>
                                </div>
                                <div class="leave-evidence-field">
                                    <span>Leave Type</span>
                                    <strong data-leave-evidence-type></strong>
                                </div>
                                <div class="leave-evidence-field">
                                    <span>Duration</span>
                                    <strong data-leave-evidence-duration></strong>
                                </div>
                                <div class="leave-evidence-field">
                                    <span>Status</span>
                                    <strong data-leave-evidence-status></strong>
                                </div>
                            </div>
                            <div class="leave-evidence-signature">
                                <div>Employee Signature</div>
                                <div>HR Office</div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="leave-modal" id="leaveTypeModal" aria-hidden="true">
    <div class="leave-modal-backdrop" data-leave-modal-close></div>
    <section class="leave-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="leaveTypeTitle">
        <div class="leave-modal-header">
            <div>
                <h2 id="leaveTypeTitle">Create Leave Type</h2>
                <p>Define the leave allowance and approval rule.</p>
            </div>
            <button type="button" class="leave-modal-close" data-leave-modal-close aria-label="Close leave type form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form class="leave-modal-body" data-leave-modal-form>
            <div class="leave-modal-form-grid">
                <label class="leave-modal-field full">
                    <span>Leave Type Name</span>
                    <input type="text" class="form-control" name="leave_type_name" placeholder="Example: Maternity Leave">
                </label>
                <label class="leave-modal-field">
                    <span>Max Days Per Year</span>
                    <input type="number" class="form-control" name="max_days" placeholder="30">
                </label>
                <label class="leave-modal-field">
                    <span>Paid Status</span>
                    <select class="form-control" name="paid_status">
                        <option>Paid</option>
                        <option>Unpaid</option>
                        <option>Partially Paid</option>
                    </select>
                </label>
                <label class="leave-modal-field">
                    <span>Approval Rule</span>
                    <select class="form-control" name="approval_rule">
                        <option>Needs Approval</option>
                        <option>Auto Approved</option>
                        <option>Manager + HR Approval</option>
                    </select>
                </label>
                <label class="leave-modal-field">
                    <span>Description</span>
                    <input type="text" class="form-control" name="description" placeholder="Short rule note">
                </label>
            </div>
            <hr class="leave-modal-divider">
            <div class="leave-modal-actions">
                <button type="button" class="btn btn-secondary" data-leave-modal-close>Cancel</button>
                <button type="submit" class="btn btn-primary">Save Leave Type</button>
            </div>
        </form>
    </section>
</div>

<div class="leave-modal" id="newLeaveModal" aria-hidden="true">
    <div class="leave-modal-backdrop" data-leave-modal-close></div>
    <section class="leave-modal-dialog narrow" role="dialog" aria-modal="true" aria-labelledby="newLeaveTitle">
        <div class="leave-modal-header">
            <div>
                <h2 id="newLeaveTitle">New Leave Request</h2>
                <p>Issue a new leave on behalf of an employee.</p>
            </div>
            <button type="button" class="leave-modal-close" data-leave-modal-close aria-label="Close new leave form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form class="leave-modal-body" data-leave-modal-form>
            <div class="leave-modal-form-grid">
                <label class="leave-modal-field full">
                    <span>Employee</span>
                    <select class="form-control" name="employee">
                        <option>Select employee...</option>
                        <option>Cabdiraxmaan Cali - HR</option>
                        <option>Fadumo Xasan - Finance</option>
                        <option>Mahad Axmed - Operations</option>
                        <option>Sahra Maxamed - Marketing</option>
                    </select>
                </label>
                <label class="leave-modal-field full">
                    <span>Leave Type</span>
                    <select class="form-control" name="leave_type">
                        <option>Annual Leave</option>
                        <option>Sick Leave</option>
                        <option>Emergency Leave</option>
                        <option>Casual Leave</option>
                        <option>Study Leave</option>
                    </select>
                </label>
                <label class="leave-modal-field">
                    <span>Start Date</span>
                    <input type="date" class="form-control" name="start_date">
                </label>
                <label class="leave-modal-field">
                    <span>End Date</span>
                    <input type="date" class="form-control" name="end_date">
                </label>
                <label class="leave-modal-field full">
                    <span>Reason</span>
                    <textarea class="form-control" name="reason" placeholder="Brief reason for the leave request..."></textarea>
                </label>
            </div>
            <hr class="leave-modal-divider">
            <div class="leave-modal-actions">
                <button type="button" class="btn btn-secondary" data-leave-modal-close>Cancel</button>
                <button type="submit" class="btn btn-primary">Create Leave</button>
            </div>
        </form>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modalTriggers = document.querySelectorAll('[data-leave-modal-target]');
    var modals = document.querySelectorAll('.leave-modal');
    var requestViewButtons = document.querySelectorAll('[data-leave-request-view]');
    var requestDetailModal = document.getElementById('leaveRequestDetailModal');

    var proofTemplates = {
        'Annual Leave': {
            title: 'Annual Leave Approval Form',
            file: 'annual-leave-approval-form.pdf',
            note: 'Leave balance approval form signed by the HR branch lead and annual travel booking confirmation for the requested days.',
            body: 'This sample annual leave evidence confirms that the employee has sufficient leave balance, manager coverage has been reviewed, and HR has acknowledged the requested absence dates.',
            icon: 'approval_delegation'
        },
        'Sick Leave': {
            title: 'Medical Certificate',
            file: 'medical-certificate-sick-leave.pdf',
            note: 'Medical certificate from a registered clinic confirming the sick leave period and recommending rest before returning to duty.',
            body: 'This sample medical certificate confirms clinical review, recommended rest dates, and expected return to duty after the approved sick leave period.',
            icon: 'clinical_notes'
        },
        'Emergency Leave': {
            title: 'Emergency Leave Statement',
            file: 'family-emergency-statement.pdf',
            note: 'Emergency statement documenting urgent family circumstances, supervisor acknowledgement, and expected return date.',
            body: 'This sample emergency leave statement records the urgent reason, supervisor acknowledgement, and the employee commitment to return after the emergency date.',
            icon: 'emergency'
        },
        'Casual Leave': {
            title: 'Casual Leave Request Note',
            file: 'casual-leave-request-note.pdf',
            note: 'Casual leave request note with short planned absence reason and branch coverage confirmation.',
            body: 'This sample casual leave note confirms the planned absence reason, branch coverage arrangement, and HR review trail.',
            icon: 'event_note'
        },
        'Study Leave': {
            title: 'Study Leave Evidence',
            file: 'training-admission-letter.pdf',
            note: 'Training or course admission letter showing enrollment dates and employee development relevance.',
            body: 'This sample study leave evidence confirms course enrollment, training dates, and relevance to employee development.',
            icon: 'school'
        }
    };

    function closeModal(modal) {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function openModal(modal) {
        modals.forEach(closeModal);
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');

        var firstField = modal.querySelector('input, select, textarea, button');
        if (firstField) {
            firstField.focus();
        }
    }

    modalTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            var modal = document.getElementById(trigger.dataset.leaveModalTarget);
            if (modal) {
                openModal(modal);
            }
        });
    });

    requestViewButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            if (!requestDetailModal) return;

            var proof = proofTemplates[button.dataset.type] || {
                title: 'Leave Supporting Document',
                file: 'leave-supporting-document.pdf',
                note: 'Sample supporting document attached to this leave request.',
                body: 'This sample supporting document summarizes the evidence attached to the selected leave request.',
                icon: 'description'
            };

            requestDetailModal.querySelector('[data-leave-detail-subtitle]').textContent = button.dataset.employee + ' (' + button.dataset.number + ') - ' + button.dataset.type;
            requestDetailModal.querySelector('[data-leave-proof-title]').textContent = proof.title;
            requestDetailModal.querySelector('[data-leave-proof-file]').textContent = proof.file;
            requestDetailModal.querySelector('[data-leave-proof-note]').textContent = proof.note;
            requestDetailModal.querySelector('[data-leave-proof-icon]').textContent = proof.icon;
            requestDetailModal.querySelector('[data-leave-evidence-heading]').textContent = proof.title;
            requestDetailModal.querySelector('[data-leave-evidence-body]').textContent = proof.body;
            requestDetailModal.querySelector('[data-leave-evidence-employee]').textContent = button.dataset.employee + ' (' + button.dataset.number + ')';
            requestDetailModal.querySelector('[data-leave-evidence-type]').textContent = button.dataset.type;
            requestDetailModal.querySelector('[data-leave-evidence-duration]').textContent = button.dataset.days + ' day(s) · ' + button.dataset.dates;
            requestDetailModal.querySelector('[data-leave-evidence-status]').textContent = button.dataset.status;

            openModal(requestDetailModal);
        });
    });

    modals.forEach(function (modal) {
        modal.querySelectorAll('[data-leave-modal-close]').forEach(function (closeTrigger) {
            closeTrigger.addEventListener('click', function () {
                closeModal(modal);
            });
        });

        modal.querySelectorAll('[data-leave-modal-form]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                closeModal(modal);
                form.reset();
            });
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') return;

        modals.forEach(function (modal) {
            if (modal.classList.contains('open')) {
                closeModal(modal);
            }
        });
    });
});
</script>

<?php
include '../../includes/footer.php';
?>
