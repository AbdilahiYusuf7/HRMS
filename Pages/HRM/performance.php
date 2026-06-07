<?php
$pageTitle = "Performance";
$activePage = "performance";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .performance-header {
        align-items: flex-start;
        display: flex;
        gap: 24px;
        justify-content: space-between;
        margin-bottom: 42px;
    }

    .performance-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .performance-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .performance-smart-button {
        align-items: center;
        background-color: var(--primary-color);
        border: none;
        border-radius: var(--radius-md);
        box-shadow: 0 18px 38px rgba(15, 76, 129, 0.24);
        color: var(--neutral-white);
        cursor: pointer;
        display: inline-flex;
        flex: 0 0 auto;
        font: inherit;
        font-size: 0.98rem;
        font-weight: 900;
        gap: 10px;
        height: 60px;
        justify-content: center;
        min-width: 222px;
        padding: 0 26px;
        transition: var(--transition-fast);
    }

    .performance-smart-button:hover {
        background-color: var(--secondary-color);
        box-shadow: 0 20px 44px rgba(77, 168, 218, 0.32);
        transform: translateY(-2px);
    }

    .performance-smart-button .material-symbols-rounded {
        font-size: 22px;
    }

    .performance-insights-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
    }

    .performance-insights-grid .employee-insight-card {
        min-height: 236px;
    }

    .performance-improvement {
        background-color: #fef3c7;
    }

    .performance-improvement .employee-insight-icon {
        background-color: rgba(245, 158, 11, 0.14);
        color: var(--warning-hover);
    }

    .performance-completed {
        background-color: #e0f2fe;
    }

    .performance-completed .employee-insight-icon {
        background-color: rgba(15, 76, 129, 0.09);
        color: var(--primary-color);
    }

    .performance-workspace {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        margin-top: 32px;
        padding: 30px;
    }

    .performance-workspace-header {
        align-items: center;
        display: flex;
        gap: 20px;
        justify-content: space-between;
        margin-bottom: 32px;
    }

    .performance-tabs {
        background-color: rgba(255, 255, 255, 0.74);
        border: 4px solid rgba(77, 168, 218, 0.24);
        border-radius: var(--radius-md);
        display: inline-flex;
        overflow: hidden;
        padding: 4px;
    }

    .performance-tab {
        border: none;
        border-radius: var(--radius-sm);
        background-color: transparent;
        color: var(--neutral-darkest);
        cursor: pointer;
        font: inherit;
        font-size: 1rem;
        font-weight: 900;
        min-width: 150px;
        padding: 16px 24px;
        transition: var(--transition-fast);
    }

    .performance-tab.active,
    .performance-tab:hover {
        background-color: var(--secondary-light);
        color: var(--primary-color);
    }

    .performance-add-agenda {
        align-items: center;
        background-color: var(--primary-color);
        border: none;
        border-radius: var(--radius-md);
        color: var(--neutral-white);
        cursor: pointer;
        display: inline-flex;
        font: inherit;
        font-size: 1rem;
        font-weight: 900;
        gap: 10px;
        height: 58px;
        justify-content: center;
        min-width: 190px;
        padding: 0 24px;
        transition: var(--transition-fast);
    }

    .performance-add-agenda:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .performance-add-agenda .material-symbols-rounded {
        font-size: 22px;
    }

    .performance-tab-panel {
        display: none;
    }

    .performance-tab-panel.active {
        display: block;
    }

    .performance-agenda-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
    }

    .performance-agenda-card {
        background-color: rgba(77, 168, 218, 0.22);
        border: 1px solid rgba(186, 230, 253, 0.9);
        border-radius: var(--radius-md);
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.08);
        cursor: pointer;
        min-height: 236px;
        padding: 30px;
        transition: var(--transition-fast);
    }

    .performance-agenda-card:hover {
        border-color: var(--primary-color);
        box-shadow: 0 22px 46px rgba(15, 23, 42, 0.12);
        transform: translateY(-2px);
    }

    .performance-agenda-top {
        align-items: flex-start;
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .performance-agenda-owner {
        color: var(--primary-color);
        display: block;
        font-size: 0.9rem;
        font-weight: 900;
        letter-spacing: 0.03em;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .performance-agenda-card h3 {
        color: var(--neutral-darkest);
        font-size: 1.16rem;
        line-height: 1.32;
        margin-bottom: 30px;
    }

    .performance-agenda-card p {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        margin-bottom: 24px;
    }

    .performance-agenda-icon {
        align-items: center;
        background-color: rgba(15, 76, 129, 0.08);
        border-radius: var(--radius-md);
        color: var(--primary-color);
        display: inline-flex;
        flex: 0 0 auto;
        height: 58px;
        justify-content: center;
        width: 58px;
    }

    .performance-agenda-icon .material-symbols-rounded {
        font-size: 26px;
    }

    .performance-agenda-meta {
        align-items: center;
        color: #94a3b8;
        display: flex;
        font-size: 0.92rem;
        font-weight: 900;
        justify-content: space-between;
        line-height: 1.35;
    }

    .performance-review-panel {
        overflow: hidden;
    }

    .performance-review-header {
        margin-bottom: 26px;
    }

    .performance-review-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.36rem;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .performance-review-header p {
        color: #94a3b8;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .performance-review-table .employee-data-table {
        min-width: 1120px;
    }

    .performance-review-table .employee-data-table td {
        vertical-align: middle;
    }

    .performance-review-department strong,
    .performance-review-score strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.92rem;
        font-weight: 800;
        line-height: 1.32;
    }

    .performance-review-department span,
    .performance-review-score span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.72rem;
        font-weight: 600;
        line-height: 1.35;
        margin-top: 2px;
    }

    .performance-agenda-modal {
        align-items: center;
        display: none;
        inset: 0;
        justify-content: center;
        padding: 32px;
        position: fixed;
        z-index: 1400;
    }

    .performance-agenda-modal.open {
        display: flex;
    }

    .performance-agenda-backdrop {
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
        inset: 0;
        position: absolute;
    }

    .performance-agenda-dialog {
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        max-height: min(760px, calc(100vh - 64px));
        overflow: hidden;
        position: relative;
        width: min(1320px, 100%);
        z-index: 1;
    }

    .performance-agenda-modal-header {
        align-items: flex-start;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        display: flex;
        gap: 24px;
        justify-content: space-between;
        padding: 34px 38px 28px;
    }

    .performance-agenda-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        line-height: 1.2;
        margin-bottom: 8px;
    }

    .performance-agenda-modal-header p {
        color: #94a3b8;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.4;
    }

    .performance-agenda-modal-close {
        align-items: center;
        background-color: var(--primary-color);
        border: none;
        border-radius: var(--radius-md);
        color: var(--neutral-white);
        cursor: pointer;
        display: inline-flex;
        flex: 0 0 auto;
        height: 58px;
        justify-content: center;
        transition: var(--transition-fast);
        width: 58px;
    }

    .performance-agenda-modal-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .performance-agenda-modal-close .material-symbols-rounded {
        font-size: 26px;
    }

    .performance-agenda-modal-body {
        max-height: calc(min(760px, calc(100vh - 64px)) - 126px);
        overflow: auto;
        padding: 34px 38px 38px;
    }

    .performance-agenda-detail-card {
        background-color: rgba(255, 255, 255, 0.68);
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        padding: 28px;
    }

    .performance-agenda-detail-card h3,
    .performance-assignment-title {
        color: var(--neutral-dark);
        font-size: 1.16rem;
        font-weight: 900;
        line-height: 1.3;
        margin-bottom: 22px;
    }

    .performance-agenda-list {
        display: grid;
        gap: 16px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .performance-agenda-list li {
        align-items: center;
        color: #475569;
        display: flex;
        font-size: 1.05rem;
        font-weight: 600;
        gap: 16px;
    }

    .performance-agenda-list .material-symbols-rounded {
        color: var(--primary-color);
        flex: 0 0 auto;
        font-size: 22px;
        font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 24;
        line-height: 1;
    }

    .performance-assignment-title {
        margin: 34px 0 22px;
    }

    .performance-assignment-grid {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(2, minmax(280px, 1fr));
    }

    .performance-assignment-card {
        align-items: center;
        background-color: rgba(255, 255, 255, 0.66);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        display: flex;
        gap: 20px;
        justify-content: space-between;
        min-height: 104px;
        padding: 22px;
    }

    .performance-assignment-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        line-height: 1.3;
        margin-bottom: 8px;
    }

    .performance-assignment-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.4;
    }

    .performance-assignment-card .performance-assignment-check {
        accent-color: var(--secondary-color);
        appearance: none;
        background-color: rgba(255, 255, 255, 0.86);
        border: 2px solid var(--secondary-color);
        border-radius: 4px;
        cursor: pointer;
        flex: 0 0 auto;
        height: 22px;
        margin: 0;
        position: relative;
        width: 22px;
    }

    .performance-assignment-card .performance-assignment-check:checked {
        background-color: var(--secondary-color);
    }

    .performance-assignment-card .performance-assignment-check:checked::after {
        border-bottom: 3px solid var(--neutral-white);
        border-right: 3px solid var(--neutral-white);
        content: "";
        height: 10px;
        left: 6px;
        position: absolute;
        top: 2px;
        transform: rotate(45deg);
        width: 6px;
    }

    .performance-assignment-card .performance-assignment-check:focus-visible {
        box-shadow: 0 0 0 4px rgba(77, 168, 218, 0.22);
        outline: none;
    }

    .performance-review-modal {
        align-items: center;
        display: none;
        inset: 0;
        justify-content: center;
        padding: 32px;
        position: fixed;
        z-index: 1450;
    }

    .performance-review-modal.open {
        display: flex;
    }

    .performance-review-backdrop {
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
        inset: 0;
        position: absolute;
    }

    .performance-review-dialog {
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        max-height: min(900px, calc(100vh - 64px));
        overflow: hidden;
        position: relative;
        width: min(1120px, 100%);
        z-index: 1;
    }

    .performance-review-modal-header {
        align-items: flex-start;
        display: flex;
        gap: 24px;
        justify-content: space-between;
        padding: 34px 38px 24px;
    }

    .performance-review-modal-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        line-height: 1.2;
        margin-bottom: 8px;
    }

    .performance-review-modal-header p {
        color: #94a3b8;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.4;
    }

    .performance-review-modal-close {
        align-items: center;
        background-color: var(--primary-color);
        border: none;
        border-radius: var(--radius-md);
        color: var(--neutral-white);
        cursor: pointer;
        display: inline-flex;
        flex: 0 0 auto;
        height: 58px;
        justify-content: center;
        transition: var(--transition-fast);
        width: 58px;
    }

    .performance-review-modal-close:hover {
        background-color: var(--secondary-color);
    }

    .performance-review-modal-close .material-symbols-rounded {
        font-size: 26px;
    }

    .performance-review-modal-body {
        max-height: calc(min(900px, calc(100vh - 64px)) - 130px);
        overflow: auto;
        padding: 0 38px 38px;
    }

    .performance-review-summary-card {
        background-color: rgba(255, 255, 255, 0.68);
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(4, minmax(140px, 1fr));
        margin-bottom: 30px;
        padding: 24px;
    }

    .performance-review-summary-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .performance-review-summary-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.12rem;
        line-height: 1.35;
    }

    .performance-review-summary-card small {
        color: #64748b;
        display: block;
        font-size: 0.9rem;
        font-weight: 700;
        margin-top: 4px;
    }

    .performance-review-form {
        display: grid;
        gap: 20px;
    }

    [data-performance-review-items] {
        display: grid;
        gap: 20px;
    }

    .performance-review-item {
        align-items: center;
        background-color: rgba(255, 255, 255, 0.66);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        display: grid;
        gap: 20px;
        grid-template-columns: 1fr 190px;
        min-height: 112px;
        padding: 22px;
    }

    .performance-review-item label {
        align-items: flex-start;
        color: var(--neutral-dark);
        cursor: pointer;
        display: flex;
        gap: 16px;
        font-size: 1.08rem;
        font-weight: 900;
        line-height: 1.35;
    }

    .performance-review-check {
        accent-color: var(--secondary-color);
        appearance: none;
        background-color: rgba(255, 255, 255, 0.86);
        border: 2px solid var(--secondary-color);
        border-radius: 4px;
        cursor: pointer;
        flex: 0 0 auto;
        height: 22px;
        margin: 3px 0 0;
        position: relative;
        width: 22px;
    }

    .performance-review-check:checked {
        background-color: var(--secondary-color);
    }

    .performance-review-check:checked::after {
        border-bottom: 3px solid var(--neutral-white);
        border-right: 3px solid var(--neutral-white);
        content: "";
        height: 10px;
        left: 6px;
        position: absolute;
        top: 2px;
        transform: rotate(45deg);
        width: 6px;
    }

    .performance-review-item p {
        color: #94a3b8;
        font-size: 0.95rem;
        font-weight: 700;
        margin-top: 8px;
    }

    .performance-review-percent {
        align-items: center;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .performance-review-percent input {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-sm);
        color: var(--neutral-dark);
        font: inherit;
        font-size: 1.04rem;
        font-weight: 900;
        height: 54px;
        padding: 0 18px;
        width: 138px;
    }

    .performance-review-percent span {
        color: #475569;
        font-size: 1rem;
        font-weight: 900;
    }

    .performance-review-actions {
        display: flex;
        gap: 14px;
        justify-content: flex-end;
        padding-top: 16px;
    }

    .performance-review-actions button {
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        font: inherit;
        font-size: 1rem;
        font-weight: 900;
        min-width: 126px;
        padding: 15px 24px;
        transition: var(--transition-fast);
    }

    .performance-review-cancel {
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
    }

    .performance-review-submit {
        background-color: var(--primary-color);
        color: var(--neutral-white);
    }

    .performance-review-cancel:hover,
    .performance-review-submit:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    @media (max-width: 980px) {
        .performance-header {
            flex-direction: column;
        }

        .performance-smart-button {
            width: 100%;
        }

        .performance-insights-grid {
            grid-template-columns: 1fr;
        }

        .performance-workspace-header {
            align-items: stretch;
            flex-direction: column;
        }

        .performance-tabs,
        .performance-add-agenda {
            width: 100%;
        }

        .performance-tab {
            flex: 1 1 0;
            min-width: 0;
        }

        .performance-agenda-grid {
            grid-template-columns: 1fr;
        }

        .performance-agenda-modal {
            padding: 16px;
        }

        .performance-agenda-modal-header,
        .performance-agenda-modal-body {
            padding: 24px;
        }

        .performance-assignment-grid {
            grid-template-columns: 1fr;
        }

        .performance-review-modal {
            padding: 16px;
        }

        .performance-review-modal-header,
        .performance-review-modal-body {
            padding-left: 24px;
            padding-right: 24px;
        }

        .performance-review-summary-card,
        .performance-review-item {
            grid-template-columns: 1fr;
        }

        .performance-review-percent {
            justify-content: flex-start;
        }
    }
</style>

<div class="performance-header">
    <div>
        <h1>Performance</h1>
        <p>Manage departmental agendas and review employee performance.</p>
    </div>
</div>

<div class="performance-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Top Performers</h3>
            <strong>5</strong>
            <p>Employees with excellent review marks</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">workspace_premium</span>
        </div>
    </div>

    <div class="employee-insight-card performance-improvement">
        <div>
            <h3>Need Improvement</h3>
            <strong>2</strong>
            <p>Employees requiring follow-up action</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">moving</span>
        </div>
    </div>

    <div class="employee-insight-card performance-completed">
        <div>
            <h3>Reviews Completed</h3>
            <strong>9</strong>
            <p>Completed in the active review cycle</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">fact_check</span>
        </div>
    </div>
</div>

<section class="performance-workspace">
    <div class="performance-workspace-header">
        <div class="performance-tabs" role="tablist" aria-label="Performance workspace">
            <button type="button" class="performance-tab active" role="tab" aria-selected="true" data-performance-tab="agenda">Manage Agenda</button>
            <button type="button" class="performance-tab" role="tab" aria-selected="false" data-performance-tab="review">Review</button>
        </div>
        <button type="button" class="performance-add-agenda">
            <span class="material-symbols-rounded">add</span>
            <span>Add Agenda</span>
        </button>
    </div>

    <div class="performance-tab-panel active" data-performance-panel="agenda">
        <div class="performance-agenda-grid">
            <article class="performance-agenda-card" role="button" tabindex="0" data-performance-agenda-card="hr">
                <div class="performance-agenda-top">
                    <div>
                        <span class="performance-agenda-owner">Human Resource Manager</span>
                        <h3>Staff Follow Up</h3>
                    </div>
                    <div class="performance-agenda-icon">
                        <span class="material-symbols-rounded">checklist</span>
                    </div>
                </div>
                <p>Check staff attendance</p>
                <div class="performance-agenda-meta">
                    <span>3 agenda points</span>
                    <span>2 employees</span>
                </div>
            </article>

            <article class="performance-agenda-card" role="button" tabindex="0" data-performance-agenda-card="finance">
                <div class="performance-agenda-top">
                    <div>
                        <span class="performance-agenda-owner">Head Of Finances</span>
                        <h3>Audit Follow Up</h3>
                    </div>
                    <div class="performance-agenda-icon">
                        <span class="material-symbols-rounded">checklist</span>
                    </div>
                </div>
                <p>Check payment records</p>
                <div class="performance-agenda-meta">
                    <span>3 agenda points</span>
                    <span>2 employees</span>
                </div>
            </article>

            <article class="performance-agenda-card" role="button" tabindex="0" data-performance-agenda-card="operations">
                <div class="performance-agenda-top">
                    <div>
                        <span class="performance-agenda-owner">Operations Manager</span>
                        <h3>Branch Follow Up</h3>
                    </div>
                    <div class="performance-agenda-icon">
                        <span class="material-symbols-rounded">checklist</span>
                    </div>
                </div>
                <p>Check branch work</p>
                <div class="performance-agenda-meta">
                    <span>3 agenda points</span>
                    <span>2 employees</span>
                </div>
            </article>

            <article class="performance-agenda-card" role="button" tabindex="0" data-performance-agenda-card="marketing">
                <div class="performance-agenda-top">
                    <div>
                        <span class="performance-agenda-owner">Marketing Manager</span>
                        <h3>Customer Follow Up</h3>
                    </div>
                    <div class="performance-agenda-icon">
                        <span class="material-symbols-rounded">checklist</span>
                    </div>
                </div>
                <p>Call customers</p>
                <div class="performance-agenda-meta">
                    <span>3 agenda points</span>
                    <span>2 employees</span>
                </div>
            </article>

            <article class="performance-agenda-card" role="button" tabindex="0" data-performance-agenda-card="manager">
                <div class="performance-agenda-top">
                    <div>
                        <span class="performance-agenda-owner">Manager</span>
                        <h3>Office Work Follow Up</h3>
                    </div>
                    <div class="performance-agenda-icon">
                        <span class="material-symbols-rounded">checklist</span>
                    </div>
                </div>
                <p>Check office records</p>
                <div class="performance-agenda-meta">
                    <span>3 agenda points</span>
                    <span>2 employees</span>
                </div>
            </article>

            <article class="performance-agenda-card" role="button" tabindex="0" data-performance-agenda-card="it">
                <div class="performance-agenda-top">
                    <div>
                        <span class="performance-agenda-owner">IT Manager</span>
                        <h3>Computer And Website Check</h3>
                    </div>
                    <div class="performance-agenda-icon">
                        <span class="material-symbols-rounded">checklist</span>
                    </div>
                </div>
                <p>Diagnose website problems</p>
                <div class="performance-agenda-meta">
                    <span>3 agenda points</span>
                    <span>2 employees</span>
                </div>
            </article>
        </div>
    </div>

    <div class="performance-tab-panel" data-performance-panel="review">
        <div class="performance-review-panel">
            <div class="performance-review-header">
                <h2>Employee Performance Review</h2>
                <p>Review employees based on the agenda assigned to their department.</p>
            </div>

            <div class="employee-table-panel performance-review-table" data-performance-review-table>
                <div class="employee-table-scroll">
                    <table class="employee-data-table">
                        <thead>
                            <tr>
                                <th><button type="button" data-performance-review-sort-key="employee">Employee Name &amp; ID <span class="material-symbols-rounded">unfold_more</span></button></th>
                                <th><button type="button" data-performance-review-sort-key="department">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                                <th><button type="button" data-performance-review-sort-key="agenda">Agenda <span class="material-symbols-rounded">unfold_more</span></button></th>
                                <th><button type="button" data-performance-review-sort-key="score">System Performance <span class="material-symbols-rounded">unfold_more</span></button></th>
                                <th><button type="button" data-performance-review-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-employee="Cabdiraxmaan Cali" data-number="EMP-0001" data-role="Human Resource Officer" data-branch="Idaacada Branch" data-department="Human Resource Manager" data-agenda="Staff Follow Up" data-score="92" data-performance-label="Good" data-status="Top Performer">
                                <td>
                                    <div class="employee-table-name"><span class="employee-avatar">CC</span>
                                        <div><strong>Cabdiraxmaan Cali</strong><span>EMP-0001</span></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="performance-review-department">
                                        <strong>Human Resource Manager</strong>
                                        <span>Idaacada Branch</span>
                                    </div>
                                </td>
                                <td>Staff Follow Up</td>
                                <td>
                                    <div class="performance-review-score">
                                        <strong>92%</strong>
                                        <span>Good</span>
                                    </div>
                                </td>
                                <td><span class="employee-status active">Top Performer</span></td>
                                <td>
                                    <div class="employee-row-actions"><button type="button" aria-label="Review Cabdiraxmaan Cali" data-performance-review-open><span class="material-symbols-rounded">rate_review</span></button></div>
                                </td>
                            </tr>
                            <tr data-employee="Amina Yusuf" data-number="EMP-0008" data-role="Talent Officer" data-branch="Idaacada Branch" data-department="Human Resource Manager" data-agenda="Staff Follow Up" data-score="86" data-performance-label="Normal" data-status="Completed">
                                <td>
                                    <div class="employee-table-name"><span class="employee-avatar">AY</span>
                                        <div><strong>Amina Yusuf</strong><span>EMP-0008</span></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="performance-review-department">
                                        <strong>Human Resource Manager</strong>
                                        <span>Idaacada Branch</span>
                                    </div>
                                </td>
                                <td>Staff Follow Up</td>
                                <td>
                                    <div class="performance-review-score">
                                        <strong>86%</strong>
                                        <span>Normal</span>
                                    </div>
                                </td>
                                <td><span class="employee-status late">Completed</span></td>
                                <td>
                                    <div class="employee-row-actions"><button type="button" aria-label="Review Amina Yusuf" data-performance-review-open><span class="material-symbols-rounded">rate_review</span></button></div>
                                </td>
                            </tr>
                            <tr data-employee="Fadumo Xasan" data-number="EMP-0002" data-role="Finance Officer" data-branch="Xero Awr Branch" data-department="Head of Finances" data-agenda="Audit Follow Up" data-score="95" data-performance-label="Good" data-status="Top Performer">
                                <td>
                                    <div class="employee-table-name"><span class="employee-avatar">FX</span>
                                        <div><strong>Fadumo Xasan</strong><span>EMP-0002</span></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="performance-review-department">
                                        <strong>Head of Finances</strong>
                                        <span>Xero Awr Branch</span>
                                    </div>
                                </td>
                                <td>Audit Follow Up</td>
                                <td>
                                    <div class="performance-review-score">
                                        <strong>95%</strong>
                                        <span>Good</span>
                                    </div>
                                </td>
                                <td><span class="employee-status active">Top Performer</span></td>
                                <td>
                                    <div class="employee-row-actions"><button type="button" aria-label="Review Fadumo Xasan" data-performance-review-open><span class="material-symbols-rounded">rate_review</span></button></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="employee-table-footer">
                    <span data-performance-review-summary>Showing 1-3 of 3 records</span>
                    <div class="employee-pagination" data-performance-review-pagination></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="performance-agenda-modal" id="performanceAgendaModal" aria-hidden="true">
    <div class="performance-agenda-backdrop" data-performance-agenda-close></div>
    <section class="performance-agenda-dialog" role="dialog" aria-modal="true" aria-labelledby="performanceAgendaTitle">
        <div class="performance-agenda-modal-header">
            <div>
                <h2 id="performanceAgendaTitle" data-performance-agenda-title>Human Resource Manager</h2>
                <p data-performance-agenda-subtitle>Staff Follow Up | 2 employees under this department</p>
            </div>
            <button type="button" class="performance-agenda-modal-close" data-performance-agenda-close aria-label="Close agenda detail">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="performance-agenda-modal-body">
            <div class="performance-agenda-detail-card">
                <h3>Agenda</h3>
                <ul class="performance-agenda-list" data-performance-agenda-list>
                    <li><span class="material-symbols-rounded">check_circle</span>Check staff attendance</li>
                    <li><span class="material-symbols-rounded">check_circle</span>Follow up staff leave</li>
                    <li><span class="material-symbols-rounded">check_circle</span>Update employee files</li>
                </ul>
            </div>

            <h3 class="performance-assignment-title">Assign Agenda To Employees</h3>
            <div class="performance-assignment-grid" data-performance-assignment-list>
                <article class="performance-assignment-card">
                    <div>
                        <strong>Cabdiraxmaan Cali</strong>
                        <span>EMP-0001 | Human Resource Officer | Idaacada Branch</span>
                    </div>
                    <input type="checkbox" class="performance-assignment-check" checked aria-label="Assign agenda to Cabdiraxmaan Cali">
                </article>

                <article class="performance-assignment-card">
                    <div>
                        <strong>Amina Yusuf</strong>
                        <span>EMP-0008 | Talent Officer | Idaacada Branch</span>
                    </div>
                    <input type="checkbox" class="performance-assignment-check" checked aria-label="Assign agenda to Amina Yusuf">
                </article>
            </div>
        </div>
    </section>
</div>

<div class="performance-review-modal" id="performanceReviewModal" aria-hidden="true">
    <div class="performance-review-backdrop" data-performance-review-close></div>
    <section class="performance-review-dialog" role="dialog" aria-modal="true" aria-labelledby="performanceReviewTitle">
        <div class="performance-review-modal-header">
            <div>
                <h2 id="performanceReviewTitle" data-performance-review-title>Cabdiraxmaan Cali</h2>
                <p data-performance-review-subtitle>Human Resource Manager | Staff Follow Up</p>
            </div>
            <button type="button" class="performance-review-modal-close" data-performance-review-close aria-label="Close performance review">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="performance-review-modal-body">
            <div class="performance-review-summary-card">
                <div>
                    <span>System Performance</span>
                    <strong data-performance-review-score>92%</strong>
                    <small data-performance-review-score-label>Good</small>
                </div>
                <div>
                    <span>Employee ID</span>
                    <strong data-performance-review-number>EMP-0001</strong>
                </div>
                <div>
                    <span>Role</span>
                    <strong data-performance-review-role>Human Resource Officer</strong>
                </div>
                <div>
                    <span>Branch</span>
                    <strong data-performance-review-branch>Idaacada Branch</strong>
                </div>
            </div>

            <form class="performance-review-form" id="performanceReviewForm">
                <div data-performance-review-items></div>
                <div class="performance-review-actions">
                    <button type="button" class="performance-review-cancel" data-performance-review-close>Cancel</button>
                    <button type="submit" class="performance-review-submit">Submit Review</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tabs = Array.prototype.slice.call(document.querySelectorAll('[data-performance-tab]'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('[data-performance-panel]'));
    var agendaModal = document.getElementById('performanceAgendaModal');
    var agendaCards = Array.prototype.slice.call(document.querySelectorAll('[data-performance-agenda-card]'));
    var agendaTitle = agendaModal ? agendaModal.querySelector('[data-performance-agenda-title]') : null;
    var agendaSubtitle = agendaModal ? agendaModal.querySelector('[data-performance-agenda-subtitle]') : null;
    var agendaList = agendaModal ? agendaModal.querySelector('[data-performance-agenda-list]') : null;
    var assignmentList = agendaModal ? agendaModal.querySelector('[data-performance-assignment-list]') : null;
    var reviewTablePanel = document.querySelector('[data-performance-review-table]');
    var reviewModal = document.getElementById('performanceReviewModal');
    var reviewForm = document.getElementById('performanceReviewForm');
    var reviewTitle = reviewModal ? reviewModal.querySelector('[data-performance-review-title]') : null;
    var reviewSubtitle = reviewModal ? reviewModal.querySelector('[data-performance-review-subtitle]') : null;
    var reviewScore = reviewModal ? reviewModal.querySelector('[data-performance-review-score]') : null;
    var reviewScoreLabel = reviewModal ? reviewModal.querySelector('[data-performance-review-score-label]') : null;
    var reviewNumber = reviewModal ? reviewModal.querySelector('[data-performance-review-number]') : null;
    var reviewRole = reviewModal ? reviewModal.querySelector('[data-performance-review-role]') : null;
    var reviewBranch = reviewModal ? reviewModal.querySelector('[data-performance-review-branch]') : null;
    var reviewItems = reviewModal ? reviewModal.querySelector('[data-performance-review-items]') : null;
    var agendaDetails = {
        hr: {
            title: 'Human Resource Manager',
            subtitle: 'Staff Follow Up | 2 employees under this department',
            items: ['Check staff attendance', 'Follow up staff leave', 'Update employee files'],
            employees: [
                { name: 'Cabdiraxmaan Cali', meta: 'EMP-0001 | Human Resource Officer | Idaacada Branch' },
                { name: 'Amina Yusuf', meta: 'EMP-0008 | Talent Officer | Idaacada Branch' }
            ]
        },
        finance: {
            title: 'Head of Finances',
            subtitle: 'Audit Follow Up | 2 employees under this department',
            items: ['Check payment records', 'Follow up missing receipts', 'Prepare simple finance report'],
            employees: [
                { name: 'Fadumo Xasan', meta: 'EMP-0002 | Finance Officer | Xero Awr Branch' },
                { name: 'Roda Jama', meta: 'EMP-0007 | Financial Analyst | Xero Awr Branch' }
            ]
        },
        operations: {
            title: 'Operations Manager',
            subtitle: 'Branch Follow Up | 2 employees under this department',
            items: ['Check branch work', 'Follow up daily problems', 'Report unfinished tasks'],
            employees: [
                { name: 'Mahad Axmed', meta: 'EMP-0003 | Operations Supervisor | Togdheer Branch' },
                { name: 'Nimco Abdi', meta: 'EMP-0012 | Operations Officer | Togdheer Branch' }
            ]
        },
        marketing: {
            title: 'Marketing Manager',
            subtitle: 'Customer Follow Up | 2 employees under this department',
            items: ['Call customers', 'Share new offers', 'Write customer feedback'],
            employees: [
                { name: 'Sahra Maxamed', meta: 'EMP-0004 | Marketing Coordinator | Calaamada Branch' },
                { name: 'Ahmed Jama', meta: 'EMP-0009 | Marketing Associate | Calaamada Branch' }
            ]
        },
        manager: {
            title: 'Manager',
            subtitle: 'Office Work Follow Up | 2 employees under this department',
            items: ['Check office records', 'Arrange daily work', 'Follow up pending documents'],
            employees: [
                { name: 'Hodan Ali', meta: 'EMP-0005 | Administration Officer | Masalaha Branch' },
                { name: 'Mohamed Yusuf', meta: 'EMP-0010 | Records Coordinator | Masalaha Branch' }
            ]
        },
        it: {
            title: 'IT Manager',
            subtitle: 'Computer And Website Check | 2 employees under this department',
            items: ['Diagnose website problems', 'Fix computers', 'Help staff with system issues'],
            employees: [
                { name: 'Mustafe Cabdi', meta: 'EMP-0006 | Systems Support Engineer | Jigjiga Yar Branch' },
                { name: 'Ilwad Noor', meta: 'EMP-0011 | Software Developer | Jigjiga Yar Branch' }
            ]
        }
    };

    function renderAgendaDetail(detail) {
        if (!detail || !agendaTitle || !agendaSubtitle || !agendaList || !assignmentList) return;

        agendaTitle.textContent = detail.title;
        agendaSubtitle.textContent = detail.subtitle;
        agendaList.innerHTML = '';
        assignmentList.innerHTML = '';

        detail.items.forEach(function (item) {
            var listItem = document.createElement('li');
            var icon = document.createElement('span');
            icon.className = 'material-symbols-rounded';
            icon.textContent = 'check_circle';
            listItem.appendChild(icon);
            listItem.appendChild(document.createTextNode(item));
            agendaList.appendChild(listItem);
        });

        detail.employees.forEach(function (employee) {
            var card = document.createElement('article');
            var content = document.createElement('div');
            var name = document.createElement('strong');
            var meta = document.createElement('span');
            var check = document.createElement('input');

            card.className = 'performance-assignment-card';
            check.type = 'checkbox';
            check.className = 'performance-assignment-check';
            check.checked = true;
            check.setAttribute('aria-label', 'Assign agenda to ' + employee.name);
            name.textContent = employee.name;
            meta.textContent = employee.meta;

            content.appendChild(name);
            content.appendChild(meta);
            card.appendChild(content);
            card.appendChild(check);
            assignmentList.appendChild(card);
        });
    }

    function openAgendaModal(type) {
        if (!agendaModal) return;

        renderAgendaDetail(agendaDetails[type] || agendaDetails.hr);
        agendaModal.classList.add('open');
        agendaModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeAgendaModal() {
        if (!agendaModal) return;

        agendaModal.classList.remove('open');
        agendaModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function getRowValue(row, key) {
        return (row.dataset[key] || '').trim();
    }

    function getReviewAgendaItems(agenda) {
        var matchedKey = Object.keys(agendaDetails).filter(function (key) {
            return agendaDetails[key].subtitle.indexOf(agenda + ' |') === 0;
        })[0];

        return matchedKey ? agendaDetails[matchedKey].items : [];
    }

    function openReviewModal(row) {
        if (!reviewModal || !row || !reviewItems) return;

        var employee = getRowValue(row, 'employee');
        var department = getRowValue(row, 'department');
        var agenda = getRowValue(row, 'agenda');
        var items = getReviewAgendaItems(agenda);

        if (reviewTitle) reviewTitle.textContent = employee;
        if (reviewSubtitle) reviewSubtitle.textContent = department + ' | ' + agenda;
        if (reviewScore) reviewScore.textContent = getRowValue(row, 'score') + '%';
        if (reviewScoreLabel) reviewScoreLabel.textContent = getRowValue(row, 'performanceLabel');
        if (reviewNumber) reviewNumber.textContent = getRowValue(row, 'number');
        if (reviewRole) reviewRole.textContent = getRowValue(row, 'role');
        if (reviewBranch) reviewBranch.textContent = getRowValue(row, 'branch');

        reviewItems.innerHTML = '';
        items.forEach(function (item) {
            var wrapper = document.createElement('article');
            var label = document.createElement('label');
            var checkbox = document.createElement('input');
            var text = document.createElement('div');
            var title = document.createElement('strong');
            var description = document.createElement('p');
            var percent = document.createElement('div');
            var input = document.createElement('input');
            var suffix = document.createElement('span');

            wrapper.className = 'performance-review-item';
            checkbox.type = 'checkbox';
            checkbox.className = 'performance-review-check';
            title.textContent = item;
            description.textContent = 'Check if the employee worked on this agenda.';
            percent.className = 'performance-review-percent';
            input.type = 'number';
            input.min = '0';
            input.max = '100';
            input.value = '0';
            input.setAttribute('aria-label', item + ' score percentage');
            suffix.textContent = '%';

            text.appendChild(title);
            text.appendChild(description);
            label.appendChild(checkbox);
            label.appendChild(text);
            percent.appendChild(input);
            percent.appendChild(suffix);
            wrapper.appendChild(label);
            wrapper.appendChild(percent);
            reviewItems.appendChild(wrapper);
        });

        reviewModal.classList.add('open');
        reviewModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeReviewModal() {
        if (!reviewModal) return;

        reviewModal.classList.remove('open');
        reviewModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = tab.dataset.performanceTab;

            tabs.forEach(function (item) {
                var active = item === tab;
                item.classList.toggle('active', active);
                item.setAttribute('aria-selected', active ? 'true' : 'false');
            });

            panels.forEach(function (panel) {
                panel.classList.toggle('active', panel.dataset.performancePanel === target);
            });
        });
    });

    agendaCards.forEach(function (card) {
        card.addEventListener('click', function () {
            openAgendaModal(card.dataset.performanceAgendaCard);
        });

        card.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openAgendaModal(card.dataset.performanceAgendaCard);
            }
        });
    });

    if (agendaModal) {
        agendaModal.querySelectorAll('[data-performance-agenda-close]').forEach(function (button) {
            button.addEventListener('click', closeAgendaModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && agendaModal.classList.contains('open')) {
                closeAgendaModal();
            }
        });
    }

    if (reviewModal) {
        reviewModal.querySelectorAll('[data-performance-review-close]').forEach(function (button) {
            button.addEventListener('click', closeReviewModal);
        });

        if (reviewForm) {
            reviewForm.addEventListener('submit', function (event) {
                event.preventDefault();
                closeReviewModal();
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && reviewModal.classList.contains('open')) {
                closeReviewModal();
            }
        });
    }

    if (reviewTablePanel) {
        var reviewTable = reviewTablePanel.querySelector('.employee-data-table');
        var reviewTbody = reviewTable ? reviewTable.querySelector('tbody') : null;
        var reviewSummary = reviewTablePanel.querySelector('[data-performance-review-summary]');
        var reviewPagination = reviewTablePanel.querySelector('[data-performance-review-pagination]');
        var reviewRows = reviewTbody ? Array.prototype.slice.call(reviewTbody.querySelectorAll('tr')) : [];
        var reviewPageSize = 4;
        var reviewCurrentPage = 1;
        var reviewSortKey = '';
        var reviewSortDirection = 'asc';

        function getReviewRowValue(row, key) {
            return (row.dataset[key] || '').trim();
        }

        function sortReviewRows(rows) {
            if (!reviewSortKey) return rows;

            return rows.slice().sort(function (a, b) {
                var aValue = getReviewRowValue(a, reviewSortKey);
                var bValue = getReviewRowValue(b, reviewSortKey);

                if (reviewSortKey === 'score') {
                    return reviewSortDirection === 'asc'
                        ? Number(aValue) - Number(bValue)
                        : Number(bValue) - Number(aValue);
                }

                return reviewSortDirection === 'asc'
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
        }

        function renderReviewPagination(totalPages) {
            if (!reviewPagination) return;

            reviewPagination.innerHTML = '';

            var previousButton = document.createElement('button');
            previousButton.type = 'button';
            previousButton.textContent = '<';
            previousButton.disabled = reviewCurrentPage === 1;
            previousButton.addEventListener('click', function () {
                reviewCurrentPage -= 1;
                renderReviewTable();
            });
            reviewPagination.appendChild(previousButton);

            for (var page = 1; page <= totalPages; page += 1) {
                var button = document.createElement('button');
                button.type = 'button';
                button.textContent = page;
                button.classList.toggle('active', page === reviewCurrentPage);
                button.addEventListener('click', function () {
                    reviewCurrentPage = Number(this.textContent);
                    renderReviewTable();
                });
                reviewPagination.appendChild(button);
            }

            var nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.textContent = '>';
            nextButton.disabled = reviewCurrentPage === totalPages;
            nextButton.addEventListener('click', function () {
                reviewCurrentPage += 1;
                renderReviewTable();
            });
            reviewPagination.appendChild(nextButton);
        }

        function renderReviewTable() {
            if (!reviewTbody || !reviewSummary) return;

            var sortedRows = sortReviewRows(reviewRows);
            var totalPages = Math.max(1, Math.ceil(sortedRows.length / reviewPageSize));

            if (reviewCurrentPage > totalPages) {
                reviewCurrentPage = totalPages;
            }

            var start = (reviewCurrentPage - 1) * reviewPageSize;
            var pageRows = sortedRows.slice(start, start + reviewPageSize);

            reviewRows.forEach(function (row) {
                row.style.display = 'none';
            });

            pageRows.forEach(function (row) {
                row.style.display = '';
                reviewTbody.appendChild(row);
            });

            var from = sortedRows.length ? start + 1 : 0;
            var to = Math.min(start + reviewPageSize, sortedRows.length);
            reviewSummary.textContent = 'Showing ' + from + '-' + to + ' of ' + sortedRows.length + ' records';
            renderReviewPagination(totalPages);
        }

        if (reviewTable && reviewTbody && reviewSummary && reviewPagination) {
            reviewTable.addEventListener('click', function (event) {
                var reviewButton = event.target.closest('[data-performance-review-open]');
                if (!reviewButton) return;

                openReviewModal(reviewButton.closest('tr'));
            });

            reviewTable.querySelectorAll('[data-performance-review-sort-key]').forEach(function (button) {
                button.addEventListener('click', function () {
                    var nextSortKey = button.dataset.performanceReviewSortKey;

                    if (reviewSortKey === nextSortKey) {
                        reviewSortDirection = reviewSortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        reviewSortKey = nextSortKey;
                        reviewSortDirection = 'asc';
                    }

                    reviewCurrentPage = 1;
                    renderReviewTable();
                });
            });

            renderReviewTable();
        }
    }
});
</script>

<?php include '../../includes/footer.php'; ?>
