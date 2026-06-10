<?php
$pageTitle = "Employee Ranking";
$activePage = "employee-ranking";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .ranking-page-header {
        margin-bottom: 42px;
    }

    .ranking-page-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .ranking-page-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .ranking-insights-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
        gap: 24px;
    }

    .ranking-insights-grid .employee-insight-card {
        min-height: 220px;
    }

    .ranking-records-section {
        margin-top: 32px;
    }

    .ranking-records-section .employee-data-table {
        min-width: 1480px;
    }

    .ranking-employee-cell strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.9rem;
        line-height: 1.28;
    }

    .ranking-employee-cell span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        line-height: 1.3;
        margin-top: 4px;
    }

    .ranking-performance {
        font-weight: 900;
    }

    .ranking-performance.high {
        color: var(--success-hover);
    }

    .ranking-performance.medium {
        color: #1d4ed8;
    }

    .ranking-performance.low {
        color: var(--danger-hover);
    }

    .ranking-eligibility {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 86px;
        padding: 7px 10px;
        font-size: 0.72rem;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
        white-space: normal;
    }

    .ranking-eligibility.eligible {
        background-color: var(--success-light);
        color: var(--success-hover);
    }

    .ranking-eligibility.nearly {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .ranking-eligibility.review {
        background-color: var(--warning-light);
        color: var(--warning-hover);
    }

    .ranking-eligibility.not-eligible {
        background-color: var(--danger-light);
        color: var(--danger-hover);
    }

    .ranking-action-trigger {
        min-width: 92px;
        height: 40px;
        border: none;
        border-radius: var(--radius-sm);
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font: inherit;
        font-size: 0.86rem;
        font-weight: 900;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .ranking-action-trigger:hover,
    .ranking-action-trigger[aria-expanded="true"] {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .ranking-action-trigger .material-symbols-rounded {
        font-size: 18px;
    }

    .ranking-action-menu {
        position: fixed;
        z-index: 1300;
        width: 270px;
        display: none;
        border: 1px solid rgba(191, 219, 254, 0.94);
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.98), rgba(255, 255, 255, 0.98) 50%, rgba(255, 241, 247, 0.98));
        box-shadow: 0 22px 54px rgba(15, 23, 42, 0.18);
        padding: 10px;
        transform-origin: top center;
    }

    .ranking-action-menu.open {
        display: grid;
        gap: 4px;
    }

    .ranking-action-menu::before {
        content: "";
        position: absolute;
        top: -7px;
        left: var(--ranking-menu-arrow-left, 34px);
        width: 14px;
        height: 14px;
        border-left: 1px solid rgba(191, 219, 254, 0.94);
        border-top: 1px solid rgba(191, 219, 254, 0.94);
        background: rgba(240, 249, 255, 0.98);
        transform: rotate(45deg);
    }

    .ranking-action-menu button {
        width: 100%;
        min-height: 48px;
        border: none;
        border-radius: 12px;
        background: transparent;
        color: var(--neutral-darkest);
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        font: inherit;
        font-size: 0.92rem;
        font-weight: 850;
        text-align: left;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .ranking-action-menu button:hover {
        background-color: rgba(186, 230, 253, 0.68);
        color: var(--primary-color);
    }

    .ranking-action-menu button .material-symbols-rounded {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background-color: var(--secondary-light);
        color: var(--primary-color);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        font-size: 18px;
    }

    .ranking-action-menu button.review .material-symbols-rounded {
        background-color: #ede9fe;
        color: #6d28d9;
    }

    .ranking-promotion-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .ranking-promotion-modal.open {
        display: flex;
    }

    .ranking-promotion-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .ranking-promotion-dialog {
        position: relative;
        z-index: 1;
        width: min(1020px, 100%);
        max-height: min(840px, calc(100vh - 64px));
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .ranking-promotion-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .ranking-promotion-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 8px;
    }

    .ranking-promotion-header p {
        color: var(--neutral-gray);
        font-size: 0.98rem;
        font-weight: 500;
    }

    .ranking-promotion-close {
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
        transition: var(--transition-fast);
        flex: 0 0 auto;
    }

    .ranking-promotion-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .ranking-promotion-body {
        overflow: auto;
        padding: 32px;
        flex: 1 1 auto;
        max-height: calc(min(840px, calc(100vh - 64px)) - 112px);
    }

    .ranking-promotion-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px 24px;
    }

    .ranking-promotion-field.full {
        grid-column: 1 / -1;
    }

    .ranking-promotion-field span {
        color: #94a3b8;
        display: block;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.24em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .ranking-promotion-field textarea {
        min-height: 126px;
        resize: vertical;
    }

    .ranking-promotion-upload {
        min-height: 54px;
        border: 1px dashed rgba(77, 168, 218, 0.52);
        border-radius: var(--radius-sm);
        background-color: rgba(255, 255, 255, 0.55);
        color: var(--neutral-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.86rem;
        font-weight: 800;
        cursor: pointer;
        text-align: center;
        transition: var(--transition-fast);
    }

    .ranking-promotion-upload:hover {
        border-color: var(--secondary-color);
        background-color: rgba(186, 230, 253, 0.42);
        color: var(--primary-color);
    }

    .ranking-promotion-upload input {
        display: none;
    }

    .ranking-promotion-divider {
        border: 0;
        border-top: 1px solid rgba(203, 213, 225, 0.62);
        margin: 28px 0;
    }

    .ranking-promotion-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .ranking-qualification-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .ranking-qualification-modal.open {
        display: flex;
    }

    .ranking-qualification-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .ranking-qualification-dialog {
        position: relative;
        z-index: 1;
        width: min(920px, 100%);
        max-height: min(780px, calc(100vh - 64px));
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .ranking-qualification-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .ranking-qualification-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 8px;
    }

    .ranking-qualification-header p {
        color: var(--neutral-gray);
        font-size: 0.98rem;
        font-weight: 500;
    }

    .ranking-qualification-close {
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
        transition: var(--transition-fast);
        flex: 0 0 auto;
    }

    .ranking-qualification-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .ranking-qualification-body {
        overflow: auto;
        padding: 32px;
        flex: 1 1 auto;
        max-height: calc(min(780px, calc(100vh - 64px)) - 112px);
    }

    .ranking-qualification-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px 24px;
    }

    .ranking-qualification-field.full {
        grid-column: 1 / -1;
    }

    .ranking-qualification-field span {
        color: #94a3b8;
        display: block;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.24em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .ranking-qualification-field textarea {
        min-height: 110px;
        resize: vertical;
    }

    .ranking-qualification-upload {
        min-height: 54px;
        border: 1px dashed rgba(77, 168, 218, 0.52);
        border-radius: var(--radius-sm);
        background-color: rgba(255, 255, 255, 0.55);
        color: var(--neutral-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.86rem;
        font-weight: 800;
        cursor: pointer;
        text-align: center;
        transition: var(--transition-fast);
    }

    .ranking-qualification-upload:hover {
        border-color: var(--secondary-color);
        background-color: rgba(186, 230, 253, 0.42);
        color: var(--primary-color);
    }

    .ranking-qualification-upload input {
        display: none;
    }

    .ranking-qualification-divider {
        border: 0;
        border-top: 1px solid rgba(203, 213, 225, 0.62);
        margin: 28px 0;
    }

    .ranking-qualification-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .ranking-eligibility-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .ranking-eligibility-modal.open {
        display: flex;
    }

    .ranking-eligibility-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .ranking-eligibility-dialog {
        position: relative;
        z-index: 1;
        width: min(960px, 100%);
        max-height: min(760px, calc(100vh - 64px));
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .ranking-eligibility-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .ranking-eligibility-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 8px;
    }

    .ranking-eligibility-header p {
        color: var(--neutral-gray);
        font-size: 0.98rem;
        font-weight: 500;
    }

    .ranking-eligibility-close {
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
        transition: var(--transition-fast);
        flex: 0 0 auto;
    }

    .ranking-eligibility-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .ranking-eligibility-body {
        overflow: auto;
        padding: 32px;
        flex: 1 1 auto;
        max-height: calc(min(760px, calc(100vh - 64px)) - 112px);
    }

    .ranking-eligibility-summary {
        display: grid;
        gap: 0;
        margin-bottom: 28px;
    }

    .ranking-eligibility-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 16px 0;
        border-bottom: 1px solid rgba(226, 232, 240, 0.62);
    }

    .ranking-eligibility-row span {
        color: var(--neutral-gray);
        font-size: 0.82rem;
        font-weight: 900;
    }

    .ranking-eligibility-row strong {
        color: var(--neutral-darkest);
        font-size: 0.9rem;
        font-weight: 900;
        text-align: right;
    }

    .ranking-eligibility-note {
        border: 1px solid rgba(191, 219, 254, 0.8);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.74);
        padding: 20px;
        margin-bottom: 18px;
    }

    .ranking-eligibility-note h3 {
        color: var(--neutral-darkest);
        font-size: 0.98rem;
        margin-bottom: 10px;
    }

    .ranking-eligibility-note p {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
        line-height: 1.45;
    }

    .ranking-eligibility-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
    }

    .ranking-review-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .ranking-review-modal.open {
        display: flex;
    }

    .ranking-review-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .ranking-review-dialog {
        position: relative;
        z-index: 1;
        width: min(650px, 100%);
        max-height: min(820px, calc(100vh - 64px));
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .ranking-review-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 24px 26px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .ranking-review-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .ranking-review-header p {
        color: var(--neutral-gray);
        font-size: 0.84rem;
        font-weight: 500;
    }

    .ranking-review-close {
        width: 46px;
        height: 46px;
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

    .ranking-review-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .ranking-review-body {
        overflow: auto;
        padding: 26px;
        flex: 1 1 auto;
        max-height: calc(min(820px, calc(100vh - 64px)) - 96px);
    }

    .ranking-review-employee {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.74);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 18px;
        margin-bottom: 22px;
    }

    .ranking-review-person {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .ranking-review-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background-color: #4f46e5;
        color: var(--neutral-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 900;
        flex: 0 0 auto;
    }

    .ranking-review-person strong {
        color: var(--neutral-darkest);
        display: block;
        font-size: 0.94rem;
        margin-bottom: 4px;
    }

    .ranking-review-person span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .ranking-review-section-title {
        color: #94a3b8;
        display: block;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.08em;
        margin: 18px 0 12px;
        text-transform: uppercase;
    }

    .ranking-review-metrics {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
    }

    .ranking-review-metric {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.68);
        padding: 14px;
        text-align: center;
    }

    .ranking-review-metric span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .ranking-review-metric strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1rem;
    }

    .ranking-review-metric strong.score {
        color: #4f46e5;
    }

    .ranking-review-requirements {
        display: grid;
        gap: 10px;
    }

    .ranking-review-requirement {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-sm);
        background-color: rgba(255, 255, 255, 0.72);
        color: #047857;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        font-size: 0.86rem;
        font-weight: 850;
    }

    .ranking-review-requirement .material-symbols-rounded {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: #10b981;
        color: var(--neutral-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex: 0 0 auto;
    }

    .ranking-review-note {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.86), rgba(255, 241, 247, 0.72));
        padding: 16px;
        margin-top: 22px;
    }

    .ranking-review-note span {
        color: var(--warning-hover);
        display: block;
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .ranking-review-note p {
        color: var(--warning-hover);
        font-size: 0.86rem;
        font-weight: 600;
        line-height: 1.45;
    }

    .ranking-review-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
    }

    @media (max-width: 1180px) {
        .ranking-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .ranking-insights-grid {
            grid-template-columns: 1fr;
        }

        .ranking-promotion-modal {
            padding: 16px;
        }

        .ranking-promotion-header,
        .ranking-promotion-body {
            padding: 22px;
        }

        .ranking-promotion-form-grid {
            grid-template-columns: 1fr;
        }

        .ranking-promotion-actions {
            flex-direction: column-reverse;
        }

        .ranking-qualification-modal {
            padding: 16px;
        }

        .ranking-qualification-header,
        .ranking-qualification-body {
            padding: 22px;
        }

        .ranking-qualification-form-grid {
            grid-template-columns: 1fr;
        }

        .ranking-qualification-actions {
            flex-direction: column-reverse;
        }

        .ranking-eligibility-modal {
            padding: 16px;
        }

        .ranking-eligibility-header,
        .ranking-eligibility-body {
            padding: 22px;
        }

        .ranking-eligibility-row {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
        }

        .ranking-eligibility-row strong {
            text-align: left;
        }

        .ranking-eligibility-actions {
            flex-direction: column-reverse;
        }

        .ranking-review-modal {
            padding: 16px;
        }

        .ranking-review-header,
        .ranking-review-body {
            padding: 22px;
        }

        .ranking-review-employee {
            align-items: flex-start;
            flex-direction: column;
        }

        .ranking-review-metrics {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ranking-review-actions {
            flex-direction: column-reverse;
        }
    }
</style>

<div class="ranking-page-header">
    <h1>Employee Ranking</h1>
    <p>Rank employees by role, grade, qualification, and promotion readiness across the organization.</p>
</div>

<div class="ranking-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Total Employee</h3>
            <strong>12 Employees</strong>
            <p>All employees available in the ranking register.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">groups</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>Eligible For Promotion Request</h3>
            <strong>5 Employees</strong>
            <p>Employees currently eligible to submit promotion requests.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">check_circle</span>
        </div>
    </div>

    <div class="employee-insight-card new-month">
        <div>
            <h3>Nearly Eligible</h3>
            <strong>3 Employees</strong>
            <p>Employees close to the eligibility threshold.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">hourglass_top</span>
        </div>
    </div>

    <div class="employee-insight-card least-performing">
        <div>
            <h3>Not Eligible</h3>
            <strong>2 Employees</strong>
            <p>Employees who have not yet met the promotion criteria.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">cancel</span>
        </div>
    </div>
</div>

<section class="employee-filter-panel">
    <div class="employee-filter-header">
        <div>
            <h2>Filters</h2>
            <p>Refine employee ranking by department, role, rank, grade, and eligibility.</p>
        </div>
        <button type="button" class="employee-filter-settings" aria-label="Filter settings">
            <span class="material-symbols-rounded">tune</span>
        </button>
    </div>

    <div class="employee-filter-grid">
        <label>
            <span>Search By Name Or Number</span>
            <div class="form-control-wrapper">
                <span class="form-control-icon material-symbols-rounded">search</span>
                <input type="search" class="form-control" placeholder="Search employee...">
            </div>
        </label>

        <label>
            <span>Organization</span>
            <select class="form-control">
                <option>All Organizations</option>
                <option>Egal International Airport</option>
                <option>Operations Directorate</option>
            </select>
        </label>

        <label>
            <span>Department</span>
            <select class="form-control">
                <option>All Departments</option>
                <option>Human Resource</option>
                <option>Finance</option>
                <option>Operations</option>
                <option>Information Technology</option>
                <option>Administration</option>
            </select>
        </label>

        <label>
            <span>Team</span>
            <select class="form-control">
                <option>All Teams</option>
                <option>Talent Desk</option>
                <option>Reporting</option>
                <option>Helpdesk</option>
                <option>Records Desk</option>
            </select>
        </label>

        <label>
            <span>Role</span>
            <select class="form-control">
                <option>All Roles</option>
                <option>Officer</option>
                <option>Lead Officer</option>
                <option>Supervisor</option>
                <option>Analyst</option>
            </select>
        </label>

        <label>
            <span>Current Rank</span>
            <select class="form-control">
                <option>All Ranks</option>
                <option>Associate</option>
                <option>Officer I</option>
                <option>Officer II</option>
                <option>Senior Officer</option>
                <option>Lead</option>
            </select>
        </label>

        <label>
            <span>Current Grade</span>
            <select class="form-control">
                <option>All Grades</option>
                <option>Grade A</option>
                <option>Grade B</option>
                <option>Grade C</option>
                <option>Grade D</option>
            </select>
        </label>

        <label>
            <span>Eligibility Status</span>
            <select class="form-control">
                <option>All</option>
                <option>Eligible</option>
                <option>Nearly Eligible</option>
                <option>Not Eligible</option>
            </select>
        </label>
    </div>
</section>

<section class="employee-records-section ranking-records-section">
    <div class="employee-records-header">
        <div>
            <h2>Employee Ranking Register</h2>
            <p>Operational list of employee ranking, grades, qualifications, and eligibility status.</p>
        </div>
    </div>

    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Employee ID <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Current Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Rank <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Grade <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Date Joined <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Years In Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Performance <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Qualification <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Eligibility <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Cabdiraxmaan Cali</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0001</td>
                        <td>Human Resource</td>
                        <td>Human Resource Director</td>
                        <td>Director I</td>
                        <td>G9</td>
                        <td>2021-01-12</td>
                        <td>4 Years</td>
                        <td><span class="ranking-performance high">92%</span></td>
                        <td>Master Degree</td>
                        <td><span class="ranking-eligibility eligible">Eligible</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Cabdiraxmaan Cali" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Fadumo Xasan</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0002</td>
                        <td>Finance</td>
                        <td>Finance Officer</td>
                        <td>Officer III</td>
                        <td>G7</td>
                        <td>2020-11-07</td>
                        <td>4 Years</td>
                        <td><span class="ranking-performance high">95%</span></td>
                        <td>Bachelor Degree</td>
                        <td><span class="ranking-eligibility eligible">Eligible</span></td>
                        <td>On Leave</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Fadumo Xasan" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Mahad Axmed</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0003</td>
                        <td>Operations</td>
                        <td>Operations Supervisor</td>
                        <td>Supervisor</td>
                        <td>G8</td>
                        <td>2019-08-16</td>
                        <td>5 Years</td>
                        <td><span class="ranking-performance high">90%</span></td>
                        <td>Advanced Diploma</td>
                        <td><span class="ranking-eligibility eligible">Eligible</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Mahad Axmed" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Sahra Maxamed</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0004</td>
                        <td>Marketing</td>
                        <td>Marketing Coordinator</td>
                        <td>Coordinator</td>
                        <td>G5</td>
                        <td>2023-03-03</td>
                        <td>2 Years</td>
                        <td><span class="ranking-performance medium">76%</span></td>
                        <td>Bachelor Degree</td>
                        <td><span class="ranking-eligibility nearly">Nearly Eligible</span></td>
                        <td>Inactive</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Sahra Maxamed" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Hodan Ali</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0005</td>
                        <td>Administration</td>
                        <td>Administration Officer</td>
                        <td>Officer I</td>
                        <td>G5</td>
                        <td>2022-05-18</td>
                        <td>3 Years</td>
                        <td><span class="ranking-performance medium">84%</span></td>
                        <td>Diploma</td>
                        <td><span class="ranking-eligibility nearly">Nearly Eligible</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Hodan Ali" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Mustafe Cabdi</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0006</td>
                        <td>Information Technology</td>
                        <td>Systems Support Engineer</td>
                        <td>Engineer I</td>
                        <td>G6</td>
                        <td>2024-01-09</td>
                        <td>1 Years</td>
                        <td><span class="ranking-performance medium">81%</span></td>
                        <td>Bachelor Degree</td>
                        <td><span class="ranking-eligibility review">Under Review</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Mustafe Cabdi" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Roda Jama</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0007</td>
                        <td>Finance</td>
                        <td>Financial Analyst</td>
                        <td>Analyst II</td>
                        <td>G6</td>
                        <td>2022-09-27</td>
                        <td>3 Years</td>
                        <td><span class="ranking-performance high">88%</span></td>
                        <td>Bachelor Degree</td>
                        <td><span class="ranking-eligibility eligible">Eligible</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Roda Jama" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Amina Yusuf</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0008</td>
                        <td>Human Resource</td>
                        <td>Talent Officer</td>
                        <td>Officer II</td>
                        <td>G6</td>
                        <td>2023-02-14</td>
                        <td>2 Years</td>
                        <td><span class="ranking-performance medium">86%</span></td>
                        <td>Bachelor Degree</td>
                        <td><span class="ranking-eligibility review">Under Review</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Amina Yusuf" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Ahmed Jama</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0009</td>
                        <td>Marketing</td>
                        <td>Marketing Associate</td>
                        <td>Associate</td>
                        <td>G4</td>
                        <td>2024-02-11</td>
                        <td>1 Years</td>
                        <td><span class="ranking-performance low">69%</span></td>
                        <td>Diploma</td>
                        <td><span class="ranking-eligibility not-eligible">Not Eligible</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Ahmed Jama" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr>
                        <td><div class="ranking-employee-cell"><strong>Mohamed Yusuf</strong><span>Idaacada Branch</span></div></td>
                        <td>EMP-0010</td>
                        <td>Administration</td>
                        <td>Records Coordinator</td>
                        <td>Coordinator</td>
                        <td>G5</td>
                        <td>2021-10-04</td>
                        <td>3 Years</td>
                        <td><span class="ranking-performance medium">83%</span></td>
                        <td>Bachelor Degree</td>
                        <td><span class="ranking-eligibility nearly">Nearly Eligible</span></td>
                        <td>Active</td>
                        <td><button type="button" class="ranking-action-trigger" data-ranking-action-toggle data-employee-name="Mohamed Yusuf" aria-expanded="false"><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing 1-10 of 10 records</span>
            <div class="employee-pagination">
                <button type="button" disabled>&lt;</button>
                <button type="button" class="active">1</button>
                <button type="button" disabled>&gt;</button>
            </div>
        </div>
    </div>
</section>

<div class="ranking-promotion-modal" id="rankingPromotionModal" aria-hidden="true">
    <div class="ranking-promotion-backdrop" data-ranking-promotion-close></div>
    <section class="ranking-promotion-dialog" role="dialog" aria-modal="true" aria-labelledby="rankingPromotionTitle">
        <div class="ranking-promotion-header">
            <div>
                <h2 id="rankingPromotionTitle">New Promotion Request</h2>
                <p>Create promotion requests without backend submission logic.</p>
            </div>
            <button type="button" class="ranking-promotion-close" data-ranking-promotion-close aria-label="Close promotion request">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <form class="ranking-promotion-body" data-ranking-promotion-form>
            <div class="ranking-promotion-form-grid">
                <label class="ranking-promotion-field">
                    <span>Employee</span>
                    <select class="form-control" name="employee" data-promotion-employee>
                        <option>Cabdiraxmaan Cali</option>
                        <option>Fadumo Xasan</option>
                        <option>Mahad Axmed</option>
                        <option>Sahra Maxamed</option>
                        <option>Hodan Ali</option>
                        <option>Mustafe Cabdi</option>
                        <option>Roda Jama</option>
                        <option>Amina Yusuf</option>
                        <option>Ahmed Jama</option>
                        <option>Mohamed Yusuf</option>
                    </select>
                </label>

                <label class="ranking-promotion-field">
                    <span>Current Department</span>
                    <input type="text" class="form-control" name="current_department" data-promotion-current-department>
                </label>

                <label class="ranking-promotion-field">
                    <span>Current Role</span>
                    <input type="text" class="form-control" name="current_role" data-promotion-current-role>
                </label>

                <label class="ranking-promotion-field">
                    <span>Current Rank / Grade</span>
                    <input type="text" class="form-control" name="current_rank_grade" data-promotion-current-rank-grade>
                </label>

                <label class="ranking-promotion-field">
                    <span>Proposed Department</span>
                    <select class="form-control" name="proposed_department" data-promotion-proposed-department>
                        <option>Human Resource</option>
                        <option>Finance</option>
                        <option>Operations</option>
                        <option>Marketing</option>
                        <option>Administration</option>
                        <option>Information Technology</option>
                    </select>
                </label>

                <label class="ranking-promotion-field">
                    <span>Proposed Role</span>
                    <input type="text" class="form-control" name="proposed_role" data-promotion-proposed-role>
                </label>

                <label class="ranking-promotion-field">
                    <span>Proposed Rank / Grade</span>
                    <input type="text" class="form-control" name="proposed_rank_grade" data-promotion-proposed-rank-grade>
                </label>

                <label class="ranking-promotion-field">
                    <span>Effective Date</span>
                    <input type="date" class="form-control" name="effective_date" value="2026-06-09">
                </label>

                <label class="ranking-promotion-field">
                    <span>Promotion Reason</span>
                    <select class="form-control" name="promotion_reason">
                        <option>Performance based progression</option>
                        <option>Leadership readiness</option>
                        <option>Technical competency growth</option>
                        <option>Qualification upgrade</option>
                    </select>
                </label>

                <label class="ranking-promotion-field">
                    <span>Basis Of Promotion</span>
                    <input type="text" class="form-control" name="basis" value="Performance review + qualification evidence">
                </label>

                <label class="ranking-promotion-field full">
                    <span>Notes</span>
                    <textarea class="form-control" name="notes" data-promotion-notes></textarea>
                </label>

                <label class="ranking-promotion-field">
                    <span>Salary Impact Placeholder</span>
                    <input type="text" class="form-control" name="salary_impact" value="To be connected by payroll rules later">
                </label>

                <label class="ranking-promotion-field">
                    <span>Supporting Document Upload</span>
                    <span class="ranking-promotion-upload">
                        <input type="file" name="supporting_document">
                        Upload placeholder
                    </span>
                </label>
            </div>

            <hr class="ranking-promotion-divider">

            <div class="ranking-promotion-actions">
                <button type="button" class="btn btn-secondary" data-ranking-promotion-close>Cancel</button>
                <button type="button" class="btn btn-secondary" data-ranking-promotion-close>Save Draft</button>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>
    </section>
</div>

<div class="ranking-qualification-modal" id="rankingQualificationModal" aria-hidden="true">
    <div class="ranking-qualification-backdrop" data-ranking-qualification-close></div>
    <section class="ranking-qualification-dialog" role="dialog" aria-modal="true" aria-labelledby="rankingQualificationTitle">
        <div class="ranking-qualification-header">
            <div>
                <h2 id="rankingQualificationTitle">Record Qualification</h2>
                <p>Add or update employee qualification evidence for ranking and eligibility review.</p>
            </div>
            <button type="button" class="ranking-qualification-close" data-ranking-qualification-close aria-label="Close qualification form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <form class="ranking-qualification-body" data-ranking-qualification-form>
            <div class="ranking-qualification-form-grid">
                <label class="ranking-qualification-field">
                    <span>Employee</span>
                    <select class="form-control" name="employee" data-qualification-employee>
                        <option>Cabdiraxmaan Cali</option>
                        <option>Fadumo Xasan</option>
                        <option>Mahad Axmed</option>
                        <option>Sahra Maxamed</option>
                        <option>Hodan Ali</option>
                        <option>Mustafe Cabdi</option>
                        <option>Roda Jama</option>
                        <option>Amina Yusuf</option>
                        <option>Ahmed Jama</option>
                        <option>Mohamed Yusuf</option>
                    </select>
                </label>

                <label class="ranking-qualification-field">
                    <span>Department</span>
                    <input type="text" class="form-control" name="department" data-qualification-department>
                </label>

                <label class="ranking-qualification-field">
                    <span>Qualification Type</span>
                    <select class="form-control" name="qualification_type">
                        <option>Degree</option>
                        <option>Diploma</option>
                        <option>Certificate</option>
                        <option>Professional License</option>
                        <option>Training Completion</option>
                    </select>
                </label>

                <label class="ranking-qualification-field">
                    <span>Qualification Title</span>
                    <input type="text" class="form-control" name="qualification_title" data-qualification-title>
                </label>

                <label class="ranking-qualification-field">
                    <span>Institution / Provider</span>
                    <input type="text" class="form-control" name="institution" value="University of Hargeisa">
                </label>

                <label class="ranking-qualification-field">
                    <span>Qualification Level</span>
                    <select class="form-control" name="qualification_level" data-qualification-level>
                        <option>Master Degree</option>
                        <option>Bachelor Degree</option>
                        <option>Advanced Diploma</option>
                        <option>Diploma</option>
                        <option>Certificate</option>
                    </select>
                </label>

                <label class="ranking-qualification-field">
                    <span>Awarded Date</span>
                    <input type="date" class="form-control" name="awarded_date" value="2026-06-03">
                </label>

                <label class="ranking-qualification-field">
                    <span>Verification Status</span>
                    <select class="form-control" name="verification_status">
                        <option>Verified</option>
                        <option>Pending Review</option>
                        <option>Needs Evidence</option>
                    </select>
                </label>

                <label class="ranking-qualification-field full">
                    <span>Qualification Notes</span>
                    <textarea class="form-control" name="notes" data-qualification-notes></textarea>
                </label>

                <label class="ranking-qualification-field full">
                    <span>Supporting Document Upload</span>
                    <span class="ranking-qualification-upload">
                        <input type="file" name="qualification_document">
                        Upload qualification document placeholder
                    </span>
                </label>
            </div>

            <hr class="ranking-qualification-divider">

            <div class="ranking-qualification-actions">
                <button type="button" class="btn btn-secondary" data-ranking-qualification-close>Cancel</button>
                <button type="button" class="btn btn-secondary" data-ranking-qualification-close>Save Draft</button>
                <button type="submit" class="btn btn-primary">Save Qualification</button>
            </div>
        </form>
    </section>
</div>

<div class="ranking-eligibility-modal" id="rankingEligibilityModal" aria-hidden="true">
    <div class="ranking-eligibility-backdrop" data-ranking-eligibility-close></div>
    <section class="ranking-eligibility-dialog" role="dialog" aria-modal="true" aria-labelledby="rankingEligibilityTitle">
        <div class="ranking-eligibility-header">
            <div>
                <h2 id="rankingEligibilityTitle">Eligibility Review</h2>
                <p>Static review result panel for promotion readiness checks.</p>
            </div>
            <button type="button" class="ranking-eligibility-close" data-ranking-eligibility-close aria-label="Close eligibility review">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="ranking-eligibility-body">
            <div class="ranking-eligibility-summary">
                <div class="ranking-eligibility-row">
                    <span>Employee</span>
                    <strong data-eligibility-employee></strong>
                </div>
                <div class="ranking-eligibility-row">
                    <span>Current Role / Rank</span>
                    <strong data-eligibility-role-rank></strong>
                </div>
                <div class="ranking-eligibility-row">
                    <span>Performance Score</span>
                    <strong data-eligibility-performance></strong>
                </div>
                <div class="ranking-eligibility-row">
                    <span>Tenure</span>
                    <strong data-eligibility-tenure></strong>
                </div>
                <div class="ranking-eligibility-row">
                    <span>Qualifications</span>
                    <strong data-eligibility-qualification></strong>
                </div>
            </div>

            <article class="ranking-eligibility-note">
                <h3>Missing Conditions</h3>
                <p data-eligibility-missing>None. All mock rule conditions are met for the next promotion cycle.</p>
            </article>

            <article class="ranking-eligibility-note">
                <h3>Recommendation</h3>
                <p data-eligibility-recommendation>Move forward with promotion request preparation and department approval routing.</p>
            </article>

            <div class="ranking-eligibility-actions">
                <button type="button" class="btn btn-secondary" data-ranking-eligibility-close>Close</button>
                <button type="button" class="btn btn-secondary" data-ranking-eligibility-record>Record Qualification</button>
                <button type="button" class="btn btn-primary" data-ranking-eligibility-promote>Start Promotion</button>
            </div>
        </div>
    </section>
</div>

<div class="ranking-review-modal" id="rankingReviewModal" aria-hidden="true">
    <div class="ranking-review-backdrop" data-ranking-review-close></div>
    <section class="ranking-review-dialog" role="dialog" aria-modal="true" aria-labelledby="rankingReviewTitle">
        <div class="ranking-review-header">
            <div>
                <h2 id="rankingReviewTitle">Performance Review</h2>
                <p>Detailed performance assessment and promotion requirements.</p>
            </div>
            <button type="button" class="ranking-review-close" data-ranking-review-close aria-label="Close performance review">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="ranking-review-body">
            <article class="ranking-review-employee">
                <div class="ranking-review-person">
                    <span class="ranking-review-avatar" data-review-initials>C</span>
                    <div>
                        <strong data-review-employee>Cabdiraxmaan Cali</strong>
                        <span data-review-subtitle>Human Resource Director · EMP-0001</span>
                    </div>
                </div>
                <span class="ranking-eligibility eligible" data-review-eligibility>Eligible</span>
            </article>

            <span class="ranking-review-section-title">Performance Metrics</span>
            <div class="ranking-review-metrics">
                <article class="ranking-review-metric">
                    <span>Score</span>
                    <strong class="score" data-review-score>92%</strong>
                </article>
                <article class="ranking-review-metric">
                    <span>Tenure</span>
                    <strong data-review-tenure>4 yrs</strong>
                </article>
                <article class="ranking-review-metric">
                    <span>Rank</span>
                    <strong data-review-rank>Director I</strong>
                </article>
                <article class="ranking-review-metric">
                    <span>Grade</span>
                    <strong data-review-grade>G9</strong>
                </article>
            </div>

            <span class="ranking-review-section-title">Promotion Requirements</span>
            <div class="ranking-review-requirements">
                <div class="ranking-review-requirement"><span class="material-symbols-rounded">check</span><span>Minimum 2 years in current role</span></div>
                <div class="ranking-review-requirement"><span class="material-symbols-rounded">check</span><span>Performance score &gt;= 75%</span></div>
                <div class="ranking-review-requirement"><span class="material-symbols-rounded">check</span><span>Qualification on file</span></div>
                <div class="ranking-review-requirement"><span class="material-symbols-rounded">check</span><span>Active employment status</span></div>
                <div class="ranking-review-requirement"><span class="material-symbols-rounded">check</span><span>No pending disciplinary cases</span></div>
            </div>

            <article class="ranking-review-note">
                <span>Reviewer Notes</span>
                <p data-review-notes>None. All mock rule conditions are met for the next promotion cycle.</p>
            </article>

            <div class="ranking-review-actions">
                <button type="button" class="btn btn-secondary" data-ranking-review-close>Close</button>
                <button type="button" class="btn btn-secondary" data-ranking-review-reject>
                    <span class="material-symbols-rounded" style="font-size: 18px;">close</span>
                    <span>Reject</span>
                </button>
                <button type="button" class="btn btn-primary" data-ranking-review-approve>
                    <span class="material-symbols-rounded" style="font-size: 18px;">check</span>
                    <span>Approve</span>
                </button>
            </div>
        </div>
    </section>
</div>

<div class="ranking-action-menu" id="rankingActionMenu" aria-hidden="true">
    <button type="button" data-ranking-action="profile">
        <span class="material-symbols-rounded">account_circle</span>
        <span>View Profile</span>
    </button>
    <button type="button" data-ranking-action="promotion">
        <span class="material-symbols-rounded">trending_up</span>
        <span>Start Promotion</span>
    </button>
    <button type="button" data-ranking-action="qualification">
        <span class="material-symbols-rounded">workspace_premium</span>
        <span>Record Qualification</span>
    </button>
    <button type="button" data-ranking-action="history">
        <span class="material-symbols-rounded">history</span>
        <span>View History</span>
    </button>
    <button type="button" data-ranking-action="eligibility">
        <span class="material-symbols-rounded">fact_check</span>
        <span>Check Eligibility</span>
    </button>
    <button type="button" class="review" data-ranking-action="review">
        <span class="material-symbols-rounded">star</span>
        <span>Review</span>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var menu = document.getElementById('rankingActionMenu');
    var promotionModal = document.getElementById('rankingPromotionModal');
    var qualificationModal = document.getElementById('rankingQualificationModal');
    var eligibilityModal = document.getElementById('rankingEligibilityModal');
    var reviewModal = document.getElementById('rankingReviewModal');
    var activeTrigger = null;
    var lastActionTrigger = null;

    if (!menu) return;

    function closeMenu() {
        menu.classList.remove('open');
        menu.setAttribute('aria-hidden', 'true');
        if (activeTrigger) {
            activeTrigger.setAttribute('aria-expanded', 'false');
            activeTrigger = null;
        }
    }

    function openMenu(trigger) {
        var rect = trigger.getBoundingClientRect();
        var pageZoom = parseFloat(window.getComputedStyle(document.body).zoom) || 1;
        var menuWidth = 270 * pageZoom;
        var viewportPadding = 18;
        var top = rect.bottom + 10;
        var triggerCenter = rect.left + (rect.width / 2);
        var desiredLeft = triggerCenter - (menuWidth / 2);
        var left = Math.min(Math.max(viewportPadding, desiredLeft), window.innerWidth - menuWidth - viewportPadding);
        var arrowLeft = Math.min(Math.max(22, (triggerCenter - left) / pageZoom - 7), 270 - 36);

        closeMenu();
        activeTrigger = trigger;
        trigger.setAttribute('aria-expanded', 'true');
        menu.style.top = (top / pageZoom) + 'px';
        menu.style.left = (left / pageZoom) + 'px';
        menu.style.setProperty('--ranking-menu-arrow-left', arrowLeft + 'px');
        menu.classList.add('open');
        menu.setAttribute('aria-hidden', 'false');
    }

    function nextRole(currentRole) {
        var roleMap = {
            'Human Resource Director': 'Senior Human Resource Director',
            'Finance Officer': 'Lead Finance Officer',
            'Operations Supervisor': 'Operations Lead',
            'Marketing Coordinator': 'Senior Marketing Coordinator',
            'Administration Officer': 'Senior Administration Officer',
            'Systems Support Engineer': 'Systems Analyst',
            'Financial Analyst': 'Senior Financial Analyst',
            'Talent Officer': 'HR Business Partner',
            'Marketing Associate': 'Marketing Coordinator',
            'Records Coordinator': 'Records Officer'
        };

        return roleMap[currentRole] || ('Senior ' + currentRole);
    }

    function nextRankGrade(rank, grade) {
        var gradeNumber = parseInt(String(grade || '').replace(/\D/g, ''), 10);
        var nextGrade = gradeNumber ? 'G' + (gradeNumber + 1) : grade;
        return 'Senior ' + rank + ' / ' + nextGrade;
    }

    function selectedRowData(trigger) {
        var row = trigger ? trigger.closest('tr') : null;
        var cells = row ? row.querySelectorAll('td') : [];
        var employeeName = trigger ? (trigger.getAttribute('data-employee-name') || '') : '';
        var department = cells[2] ? cells[2].textContent.trim() : '';
        var role = cells[3] ? cells[3].textContent.trim() : '';
        var rank = cells[4] ? cells[4].textContent.trim() : '';
        var grade = cells[5] ? cells[5].textContent.trim() : '';
        var tenure = cells[7] ? cells[7].textContent.trim() : '';
        var performance = cells[8] ? cells[8].textContent.trim() : '';
        var qualification = cells[9] ? cells[9].textContent.trim() : '';
        var eligibility = cells[10] ? cells[10].textContent.trim() : '';
        var status = cells[11] ? cells[11].textContent.trim() : '';
        var employeeId = cells[1] ? cells[1].textContent.trim() : '';

        return {
            employee: employeeName,
            department: department,
            role: role,
            rank: rank,
            grade: grade,
            tenure: tenure,
            performance: performance,
            eligibility: eligibility,
            qualification: qualification,
            status: status,
            employeeId: employeeId
        };
    }

    function openPromotionModal(trigger) {
        if (!promotionModal) return;

        var data = selectedRowData(trigger);
        var employee = promotionModal.querySelector('[data-promotion-employee]');
        var currentDepartment = promotionModal.querySelector('[data-promotion-current-department]');
        var currentRole = promotionModal.querySelector('[data-promotion-current-role]');
        var currentRankGrade = promotionModal.querySelector('[data-promotion-current-rank-grade]');
        var proposedDepartment = promotionModal.querySelector('[data-promotion-proposed-department]');
        var proposedRole = promotionModal.querySelector('[data-promotion-proposed-role]');
        var proposedRankGrade = promotionModal.querySelector('[data-promotion-proposed-rank-grade]');
        var notes = promotionModal.querySelector('[data-promotion-notes]');

        if (employee) employee.value = data.employee;
        if (currentDepartment) currentDepartment.value = data.department;
        if (currentRole) currentRole.value = data.role;
        if (currentRankGrade) currentRankGrade.value = data.rank + ' / ' + data.grade;
        if (proposedDepartment) proposedDepartment.value = data.department;
        if (proposedRole) proposedRole.value = nextRole(data.role);
        if (proposedRankGrade) proposedRankGrade.value = nextRankGrade(data.rank, data.grade);
        if (notes) notes.value = data.employee + ' meets the current cycle threshold for performance, tenure, and readiness indicators.';

        promotionModal.classList.add('open');
        promotionModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closePromotionModal() {
        if (!promotionModal) return;
        promotionModal.classList.remove('open');
        promotionModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function openQualificationModal(trigger) {
        if (!qualificationModal) return;

        var data = selectedRowData(trigger);
        var employee = qualificationModal.querySelector('[data-qualification-employee]');
        var department = qualificationModal.querySelector('[data-qualification-department]');
        var title = qualificationModal.querySelector('[data-qualification-title]');
        var level = qualificationModal.querySelector('[data-qualification-level]');
        var notes = qualificationModal.querySelector('[data-qualification-notes]');

        if (employee) employee.value = data.employee;
        if (department) department.value = data.department;
        if (title) title.value = data.qualification + ' - Promotion Ranking Evidence';
        if (level) level.value = data.qualification;
        if (notes) notes.value = data.employee + ' qualification record is being updated for ranking, grade review, and promotion eligibility verification.';

        qualificationModal.classList.add('open');
        qualificationModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeQualificationModal() {
        if (!qualificationModal) return;
        qualificationModal.classList.remove('open');
        qualificationModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function openEligibilityModal(trigger) {
        if (!eligibilityModal) return;

        var data = selectedRowData(trigger);
        var employee = eligibilityModal.querySelector('[data-eligibility-employee]');
        var roleRank = eligibilityModal.querySelector('[data-eligibility-role-rank]');
        var performance = eligibilityModal.querySelector('[data-eligibility-performance]');
        var tenure = eligibilityModal.querySelector('[data-eligibility-tenure]');
        var qualification = eligibilityModal.querySelector('[data-eligibility-qualification]');
        var missing = eligibilityModal.querySelector('[data-eligibility-missing]');
        var recommendation = eligibilityModal.querySelector('[data-eligibility-recommendation]');

        if (employee) employee.textContent = data.employee;
        if (roleRank) roleRank.textContent = data.role + ' / ' + data.rank;
        if (performance) performance.textContent = data.performance ? data.performance.replace('%', '') / 20 + ' / 5' : '4.8 / 5';
        if (tenure) tenure.textContent = data.tenure.toLowerCase();
        if (qualification) qualification.textContent = data.qualification;

        if (data.eligibility === 'Not Eligible') {
            if (missing) missing.textContent = 'Performance score and tenure threshold require additional review before this employee can move into a promotion request.';
            if (recommendation) recommendation.textContent = 'Schedule development review and record updated qualification evidence before starting promotion routing.';
        } else if (data.eligibility === 'Under Review') {
            if (missing) missing.textContent = 'Final HR validation is still required before routing the promotion request.';
            if (recommendation) recommendation.textContent = 'Complete eligibility validation, then proceed with promotion request preparation if approved.';
        } else {
            if (missing) missing.textContent = 'None. All mock rule conditions are met for the next promotion cycle.';
            if (recommendation) recommendation.textContent = 'Move forward with promotion request preparation and department approval routing.';
        }

        lastActionTrigger = trigger;
        eligibilityModal.classList.add('open');
        eligibilityModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeEligibilityModal() {
        if (!eligibilityModal) return;
        eligibilityModal.classList.remove('open');
        eligibilityModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function initials(name) {
        return String(name || '')
            .split(/\s+/)
            .filter(Boolean)
            .slice(0, 2)
            .map(function (part) { return part.charAt(0); })
            .join('')
            .toUpperCase() || 'E';
    }

    function openReviewModal(trigger) {
        if (!reviewModal) return;

        var data = selectedRowData(trigger);
        var avatar = reviewModal.querySelector('[data-review-initials]');
        var employee = reviewModal.querySelector('[data-review-employee]');
        var subtitle = reviewModal.querySelector('[data-review-subtitle]');
        var eligibility = reviewModal.querySelector('[data-review-eligibility]');
        var score = reviewModal.querySelector('[data-review-score]');
        var tenure = reviewModal.querySelector('[data-review-tenure]');
        var rank = reviewModal.querySelector('[data-review-rank]');
        var grade = reviewModal.querySelector('[data-review-grade]');
        var notes = reviewModal.querySelector('[data-review-notes]');

        if (avatar) avatar.textContent = initials(data.employee);
        if (employee) employee.textContent = data.employee;
        if (subtitle) subtitle.textContent = data.role + ' · ' + data.employeeId;
        if (eligibility) {
            eligibility.textContent = data.eligibility;
            eligibility.className = 'ranking-eligibility ' + (data.eligibility === 'Eligible' ? 'eligible' : (data.eligibility === 'Not Eligible' ? 'not-eligible' : (data.eligibility === 'Under Review' ? 'review' : 'nearly')));
        }
        if (score) score.textContent = data.performance;
        if (tenure) tenure.textContent = data.tenure.replace('Years', 'yrs');
        if (rank) rank.textContent = data.rank;
        if (grade) grade.textContent = data.grade;
        if (notes) {
            notes.textContent = data.eligibility === 'Not Eligible'
                ? 'Review required. Some mock rule conditions need attention before the next promotion cycle.'
                : 'None. All mock rule conditions are met for the next promotion cycle.';
        }

        lastActionTrigger = trigger;
        reviewModal.classList.add('open');
        reviewModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeReviewModal() {
        if (!reviewModal) return;
        reviewModal.classList.remove('open');
        reviewModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    document.querySelectorAll('[data-ranking-action-toggle]').forEach(function (trigger) {
        trigger.addEventListener('click', function (event) {
            event.stopPropagation();
            if (activeTrigger === trigger && menu.classList.contains('open')) {
                closeMenu();
                return;
            }
            openMenu(trigger);
        });
    });

    menu.addEventListener('click', function (event) {
        event.stopPropagation();
        var action = event.target.closest('[data-ranking-action]');
        var trigger = activeTrigger;
        if (!action) return;
        closeMenu();

        if (action.getAttribute('data-ranking-action') === 'promotion') {
            openPromotionModal(trigger);
        }

        if (action.getAttribute('data-ranking-action') === 'qualification') {
            openQualificationModal(trigger);
        }

        if (action.getAttribute('data-ranking-action') === 'eligibility') {
            openEligibilityModal(trigger);
        }

        if (action.getAttribute('data-ranking-action') === 'review') {
            openReviewModal(trigger);
        }
    });

    document.addEventListener('click', closeMenu);
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMenu();
            closePromotionModal();
            closeQualificationModal();
            closeEligibilityModal();
            closeReviewModal();
        }
    });
    window.addEventListener('resize', closeMenu);
    window.addEventListener('scroll', closeMenu, true);

    if (promotionModal) {
        promotionModal.querySelectorAll('[data-ranking-promotion-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closePromotionModal);
        });

        var promotionForm = promotionModal.querySelector('[data-ranking-promotion-form]');
        if (promotionForm) {
            promotionForm.addEventListener('submit', function (event) {
                event.preventDefault();
                closePromotionModal();
            });
        }
    }

    if (qualificationModal) {
        qualificationModal.querySelectorAll('[data-ranking-qualification-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeQualificationModal);
        });

        var qualificationForm = qualificationModal.querySelector('[data-ranking-qualification-form]');
        if (qualificationForm) {
            qualificationForm.addEventListener('submit', function (event) {
                event.preventDefault();
                closeQualificationModal();
            });
        }
    }

    if (eligibilityModal) {
        eligibilityModal.querySelectorAll('[data-ranking-eligibility-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeEligibilityModal);
        });

        var eligibilityRecord = eligibilityModal.querySelector('[data-ranking-eligibility-record]');
        if (eligibilityRecord) {
            eligibilityRecord.addEventListener('click', function () {
                closeEligibilityModal();
                openQualificationModal(lastActionTrigger);
            });
        }

        var eligibilityPromote = eligibilityModal.querySelector('[data-ranking-eligibility-promote]');
        if (eligibilityPromote) {
            eligibilityPromote.addEventListener('click', function () {
                closeEligibilityModal();
                openPromotionModal(lastActionTrigger);
            });
        }
    }

    if (reviewModal) {
        reviewModal.querySelectorAll('[data-ranking-review-close], [data-ranking-review-reject], [data-ranking-review-approve]').forEach(function (trigger) {
            trigger.addEventListener('click', closeReviewModal);
        });
    }
});
</script>

<?php
include '../../includes/footer.php';
?>
