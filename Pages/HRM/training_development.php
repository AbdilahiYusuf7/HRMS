<?php
$pageTitle = "Training & Development";
$activePage = "training-development";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_config.php';
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .training-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 28px;
        margin-bottom: 44px;
    }

    .training-page-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .training-page-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 850px;
    }

    .training-page-actions {
        display: flex;
        justify-content: flex-end;
        flex: 0 0 auto;
    }

    .training-insights-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
        gap: 24px;
    }

    .training-insights-grid .employee-insight-card {
        min-height: 220px;
    }

    .training-analytics-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .training-chart-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 28px;
        overflow: hidden;
    }

    .training-chart-header {
        margin-bottom: 18px;
    }

    .training-chart-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .training-chart-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .training-chart-svg {
        display: block;
        width: 100%;
        height: auto;
        overflow: visible;
    }

    .training-chart-grid line {
        stroke: rgba(203, 213, 225, 0.8);
        stroke-width: 1;
    }

    .training-chart-axis line {
        stroke: rgba(148, 163, 184, 0.72);
        stroke-width: 1.2;
    }

    .training-chart-scale text,
    .training-chart-labels text {
        fill: #475569;
        font-size: 14px;
        font-weight: 700;
    }

    .training-trend-fill {
        fill: url(#trainingCompletionArea);
    }

    .training-trend-line {
        fill: none;
        stroke: #4f46e5;
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .training-trend-point {
        fill: #4f46e5;
    }

    .training-type-bar {
        rx: 9;
        ry: 9;
    }

    .training-chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #334155;
        font-size: 0.86rem;
        font-weight: 900;
        margin-top: 12px;
    }

    .training-chart-legend i {
        width: 14px;
        height: 14px;
        border: 4px solid #4f46e5;
        display: inline-block;
    }

    .training-followup-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .training-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 28px;
        overflow: hidden;
    }

    .training-panel-header {
        margin-bottom: 26px;
    }

    .training-panel-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .training-panel-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .training-session-list {
        display: grid;
        gap: 18px;
    }

    .training-session-card {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.72), rgba(255, 241, 247, 0.72));
        padding: 22px;
    }

    .training-session-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .training-session-top h3 {
        color: var(--neutral-darkest);
        font-size: 1.05rem;
        margin-bottom: 8px;
    }

    .training-session-top p,
    .training-session-meta {
        color: var(--neutral-gray);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .training-session-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .training-status {
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 112px;
        padding: 8px 14px;
        font-size: 0.82rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .training-status.progress {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .training-status.scheduled {
        background-color: #fef3c7;
        color: #92400e;
    }

    .training-compliance-list {
        display: grid;
        gap: 24px;
    }

    .training-compliance-label {
        color: #94a3b8;
        font-size: 0.82rem;
        font-weight: 900;
        letter-spacing: 0.24em;
        text-transform: uppercase;
    }

    .training-compliance-row {
        display: grid;
        gap: 10px;
    }

    .training-compliance-row-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .training-compliance-row-header strong {
        color: var(--neutral-darkest);
        font-size: 1.05rem;
    }

    .training-compliance-row-header span,
    .training-compliance-row p {
        color: var(--neutral-gray);
        font-size: 0.9rem;
        font-weight: 800;
    }

    .training-compliance-track {
        height: 10px;
        border-radius: 999px;
        background-color: rgba(226, 232, 240, 0.78);
        overflow: hidden;
    }

    .training-compliance-track span {
        display: block;
        width: var(--value);
        height: 100%;
        border-radius: inherit;
        background-color: #6366f1;
    }

    .training-insight-purple {
        background-color: #ddd6fe;
    }

    .training-insight-purple .employee-insight-icon {
        background-color: rgba(79, 70, 229, 0.12);
        color: #4f46e5;
    }

    .training-insight-violet {
        background-color: #ede9fe;
    }

    .training-insight-violet .employee-insight-icon {
        background-color: rgba(124, 58, 237, 0.12);
        color: #7c3aed;
    }

    .training-table-section {
        margin-top: 32px;
    }

    .training-table-note {
        color: var(--neutral-gray);
        font-size: 0.86rem;
        font-weight: 800;
        line-height: 1.4;
        text-align: right;
    }

    .training-table-section .employee-data-table {
        min-width: 1240px;
    }

    .training-title-cell strong {
        display: block;
        color: var(--neutral-dark);
        font-size: 0.92rem;
        line-height: 1.32;
    }

    .training-title-cell span {
        display: block;
        color: var(--neutral-gray);
        font-size: 0.72rem;
        font-weight: 700;
        margin-top: 4px;
    }

    .training-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 88px;
        padding: 7px 12px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .training-badge.optional {
        background-color: var(--secondary-light);
        color: #0369a1;
    }

    .training-badge.mandatory {
        background-color: #ede9fe;
        color: #6d28d9;
    }

    .training-status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 108px;
        padding: 7px 12px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .training-status-pill.progress {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .training-status-pill.scheduled {
        background-color: #fef3c7;
        color: #92400e;
    }

    .training-status-pill.completed {
        background-color: var(--success-light);
        color: var(--success-hover);
    }

    .training-trainees-btn {
        min-width: 64px;
        height: 38px;
        border: none;
        border-radius: var(--radius-sm);
        background-color: var(--secondary-light);
        color: var(--neutral-dark);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 900;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .training-trainees-btn:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .training-trainees-btn .material-symbols-rounded {
        font-size: 18px;
    }

    .training-trainees-modal {
        position: fixed;
        inset: 0;
        z-index: 1200;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 34px;
    }

    .training-trainees-modal.open {
        display: flex;
    }

    .training-trainees-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .training-trainees-dialog {
        position: relative;
        z-index: 1;
        width: min(1120px, 100%);
        max-height: min(760px, calc(100vh - 68px));
        overflow: hidden;
        border: 1px solid rgba(191, 219, 254, 0.92);
        border-radius: 28px;
        background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.98) 48%, rgba(255, 241, 247, 0.96));
        box-shadow: 0 28px 70px rgba(15, 23, 42, 0.24);
    }

    .training-trainees-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 32px 34px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.7);
    }

    .training-trainees-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.34rem;
        margin-bottom: 8px;
    }

    .training-trainees-header p {
        color: #64748b;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .training-trainees-close {
        width: 58px;
        height: 58px;
        border: none;
        border-radius: 18px;
        background-color: var(--secondary-light);
        color: var(--neutral-darkest);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex: 0 0 auto;
        transition: var(--transition-fast);
    }

    .training-trainees-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .training-trainees-body {
        padding: 34px;
        overflow: auto;
        max-height: calc(100vh - 236px);
    }

    .training-trainees-table-panel {
        overflow: hidden;
    }

    .training-trainees-table-panel .employee-data-table {
        min-width: 980px;
    }

    .training-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(240px, 1fr));
        gap: 18px;
    }

    .training-form-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .training-form-field.full {
        grid-column: 1 / -1;
    }

    .training-form-field label {
        color: var(--neutral-darkest);
        font-size: 0.82rem;
        font-weight: 900;
    }

    .training-form-field input,
    .training-form-field select,
    .training-form-field textarea {
        width: 100%;
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-sm);
        background-color: rgba(255, 255, 255, 0.88);
        color: var(--neutral-dark);
        font: inherit;
        font-size: 0.92rem;
        font-weight: 600;
        padding: 12px 14px;
        outline: none;
        transition: var(--transition-fast);
    }

    .training-form-field textarea {
        min-height: 96px;
        resize: vertical;
    }

    .training-form-field input:focus,
    .training-form-field select:focus,
    .training-form-field textarea:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 4px rgba(77, 168, 218, 0.14);
    }

    .training-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 22px;
        border-top: 1px solid rgba(203, 213, 225, 0.7);
    }

    @media (max-width: 1180px) {
        .training-page-header {
            flex-direction: column;
        }

        .training-page-actions {
            justify-content: flex-start;
            width: 100%;
        }

        .training-analytics-grid {
            grid-template-columns: 1fr;
        }

        .training-followup-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .training-insights-grid {
            grid-template-columns: 1fr;
        }

        .training-page-actions .btn {
            width: 100%;
        }

        .training-chart-panel {
            padding: 22px;
        }

        .training-panel {
            padding: 22px;
        }

        .training-session-meta,
        .training-session-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .training-table-note {
            text-align: left;
        }

        .training-trainees-modal {
            padding: 18px;
        }

        .training-trainees-header,
        .training-trainees-body {
            padding: 24px;
        }

        .training-form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="training-page-header">
    <div>
        <h1>Training & Development</h1>
        <p>Track training coverage, completion momentum, upcoming sessions, and team compliance.</p>
    </div>
    <div class="training-page-actions">
        <button type="button" class="btn btn-primary" id="openTrainingModal">
            <span class="material-symbols-rounded" style="font-size: 18px;">add</span>
            <span>Add Training</span>
        </button>
    </div>
</div>

<div class="training-insights-grid">
    <div class="employee-insight-card training-insight-purple">
        <div>
            <h3>Courses Created</h3>
            <strong>12 Courses</strong>
            <p>All courses created in the training module.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">stacks</span>
        </div>
    </div>

    <div class="employee-insight-card training-insight-violet">
        <div>
            <h3>Mandatory Training</h3>
            <strong>7 Sessions</strong>
            <p>Mandatory sessions that teams are expected to complete.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">error</span>
        </div>
    </div>

    <div class="employee-insight-card new-month">
        <div>
            <h3>Optional Training</h3>
            <strong>5 Sessions</strong>
            <p>Elective programs for development and upskilling.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">emoji_objects</span>
        </div>
    </div>

    <div class="employee-insight-card leave">
        <div>
            <h3>In Progress</h3>
            <strong>3 Sessions</strong>
            <p>Sessions currently being delivered or actively attended.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">progress_activity</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>Completed</h3>
            <strong>6 Sessions</strong>
            <p>Trainings already completed in the current sample set.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">check_circle</span>
        </div>
    </div>
</div>

<div class="training-analytics-grid">
    <section class="training-chart-panel">
        <div class="training-chart-header">
            <h2>Completion Trend</h2>
            <p>Monthly training completions across the current sample period.</p>
        </div>

        <svg class="training-chart-svg" viewBox="0 0 620 350" role="img" aria-label="Completion trend chart">
            <defs>
                <linearGradient id="trainingCompletionArea" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#4f46e5" stop-opacity="0.22"></stop>
                    <stop offset="100%" stop-color="#4f46e5" stop-opacity="0.04"></stop>
                </linearGradient>
            </defs>
            <g class="training-chart-grid">
                <line x1="58" y1="52" x2="590" y2="52"></line>
                <line x1="58" y1="175" x2="590" y2="175"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <g class="training-chart-axis">
                <line x1="58" y1="52" x2="58" y2="298"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <g class="training-chart-scale">
                <text x="30" y="57">2</text>
                <text x="30" y="180">1</text>
                <text x="30" y="303">0</text>
            </g>
            <path class="training-trend-fill" d="M58 52 L164 52 C214 76 218 142 270 175 C314 202 338 168 376 175 C426 188 438 270 482 298 L590 298 L590 326 L58 326 Z"></path>
            <path class="training-trend-line" d="M58 52 L164 52 C214 76 218 142 270 175 C314 202 338 168 376 175 C426 188 438 270 482 298 L590 298"></path>
            <g>
                <circle class="training-trend-point" cx="58" cy="52" r="7" data-chart-title="January" data-chart-value="2 completed trainings"></circle>
                <circle class="training-trend-point" cx="164" cy="52" r="7" data-chart-title="February" data-chart-value="2 completed trainings"></circle>
                <circle class="training-trend-point" cx="270" cy="175" r="7" data-chart-title="March" data-chart-value="1 completed training"></circle>
                <circle class="training-trend-point" cx="376" cy="175" r="7" data-chart-title="April" data-chart-value="1 completed training"></circle>
                <circle class="training-trend-point" cx="482" cy="298" r="7" data-chart-title="May" data-chart-value="0 completed trainings"></circle>
                <circle class="training-trend-point" cx="590" cy="298" r="7" data-chart-title="June" data-chart-value="0 completed trainings"></circle>
            </g>
            <g class="training-chart-labels">
                <text x="58" y="332" text-anchor="middle">Jan</text>
                <text x="164" y="332" text-anchor="middle">Feb</text>
                <text x="270" y="332" text-anchor="middle">Mar</text>
                <text x="376" y="332" text-anchor="middle">Apr</text>
                <text x="482" y="332" text-anchor="middle">May</text>
                <text x="590" y="332" text-anchor="middle">Jun</text>
            </g>
        </svg>

        <div class="training-chart-legend">
            <i></i>
            <span>Completed Trainings</span>
        </div>
    </section>

    <section class="training-chart-panel">
        <div class="training-chart-header">
            <h2>Training Types</h2>
            <p>Column chart showing training counts by type category.</p>
        </div>

        <svg class="training-chart-svg" viewBox="0 0 620 350" role="img" aria-label="Training types chart">
            <g class="training-chart-grid">
                <line x1="58" y1="52" x2="590" y2="52"></line>
                <line x1="58" y1="134" x2="590" y2="134"></line>
                <line x1="58" y1="216" x2="590" y2="216"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <g class="training-chart-axis">
                <line x1="58" y1="52" x2="58" y2="298"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <g class="training-chart-scale">
                <text x="30" y="57">3</text>
                <text x="30" y="139">2</text>
                <text x="30" y="221">1</text>
                <text x="30" y="303">0</text>
            </g>
            <rect class="training-type-bar" x="88" y="134" width="76" height="164" fill="#4f46e5" data-chart-title="Safety" data-chart-value="2 trainings"></rect>
            <rect class="training-type-bar" x="198" y="134" width="76" height="164" fill="#0ea5e9" data-chart-title="Finance" data-chart-value="2 trainings"></rect>
            <rect class="training-type-bar" x="308" y="52" width="76" height="246" fill="#10b981" data-chart-title="Leadership" data-chart-value="3 trainings"></rect>
            <rect class="training-type-bar" x="418" y="134" width="76" height="164" fill="#f59e0b" data-chart-title="Technical" data-chart-value="2 trainings"></rect>
            <rect class="training-type-bar" x="528" y="52" width="76" height="246" fill="#8b5cf6" data-chart-title="Compliance" data-chart-value="3 trainings"></rect>
            <g class="training-chart-labels">
                <text x="126" y="332" text-anchor="middle">Safety</text>
                <text x="236" y="332" text-anchor="middle">Finance</text>
                <text x="346" y="332" text-anchor="middle">Leadership</text>
                <text x="456" y="332" text-anchor="middle">Technical</text>
                <text x="566" y="332" text-anchor="middle">Compliance</text>
            </g>
        </svg>

        <div class="training-chart-legend">
            <i></i>
            <span>Training Count</span>
        </div>
    </section>
</div>

<div class="training-followup-grid">
    <section class="training-panel">
        <div class="training-panel-header">
            <h2>Upcoming Training</h2>
            <p>Next scheduled sessions and in-progress training activities.</p>
        </div>

        <div class="training-session-list">
            <article class="training-session-card">
                <div class="training-session-top">
                    <div>
                        <h3>Compliance Policy Update</h3>
                        <p>Administration · Office Operations</p>
                    </div>
                    <span class="training-status progress">In Progress</span>
                </div>
                <div class="training-session-meta">
                    <span>2026-03-19</span>
                    <span>Idaacada Branch</span>
                </div>
            </article>

            <article class="training-session-card">
                <div class="training-session-top">
                    <div>
                        <h3>Incident Response Drill</h3>
                        <p>Operations · Branch Response</p>
                    </div>
                    <span class="training-status progress">In Progress</span>
                </div>
                <div class="training-session-meta">
                    <span>2026-04-11</span>
                    <span>Idaacada Branch</span>
                </div>
            </article>

            <article class="training-session-card">
                <div class="training-session-top">
                    <div>
                        <h3>HR Interview Calibration</h3>
                        <p>Human Resource · Talent Desk</p>
                    </div>
                    <span class="training-status scheduled">Scheduled</span>
                </div>
                <div class="training-session-meta">
                    <span>2026-05-02</span>
                    <span>Idaacada Branch</span>
                </div>
            </article>
        </div>
    </section>

    <section class="training-panel">
        <div class="training-panel-header">
            <h2>Department & Team Compliance</h2>
            <p>Mandatory training completion rate by department and by team.</p>
        </div>

        <div class="training-compliance-list">
            <span class="training-compliance-label">Departments</span>

            <div class="training-compliance-row">
                <div class="training-compliance-row-header">
                    <strong>Finance</strong>
                    <span>1/1 complete</span>
                </div>
                <div class="training-compliance-track"><span style="--value: 100%;"></span></div>
                <p>100% compliance</p>
            </div>

            <div class="training-compliance-row">
                <div class="training-compliance-row-header">
                    <strong>Information Technology</strong>
                    <span>1/1 complete</span>
                </div>
                <div class="training-compliance-track"><span style="--value: 100%;"></span></div>
                <p>100% compliance</p>
            </div>

            <div class="training-compliance-row">
                <div class="training-compliance-row-header">
                    <strong>Operations</strong>
                    <span>1/2 complete</span>
                </div>
                <div class="training-compliance-track"><span style="--value: 50%;"></span></div>
                <p>50% compliance</p>
            </div>

            <div class="training-compliance-row">
                <div class="training-compliance-row-header">
                    <strong>Administration</strong>
                    <span>0/2 complete</span>
                </div>
                <div class="training-compliance-track"><span style="--value: 0%;"></span></div>
                <p>0% compliance</p>
            </div>
        </div>
    </section>
</div>

<section class="employee-records-section training-table-section">
    <div class="employee-records-header">
        <div>
            <h2>Training List</h2>
            <p>Training catalogue with type, provider, department, team, branch, and current completion status.</p>
        </div>
        <p class="training-table-note">New records added from the modal are appended to this list immediately.</p>
    </div>

    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button">Training <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Category <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Team <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Branch <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Provider <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Trainees</th>
                    </tr>
                </thead>
                <tbody id="trainingTableBody">
                    <tr>
                        <td>
                            <div class="training-title-cell">
                                <strong>Helpdesk Service Excellence</strong>
                                <span>TRN-012</span>
                            </div>
                        </td>
                        <td><span class="training-badge optional">Optional</span></td>
                        <td>Leadership</td>
                        <td>Information Technology</td>
                        <td>Helpdesk</td>
                        <td>Idaacada Branch</td>
                        <td>Service Lab</td>
                        <td>2026-05-22</td>
                        <td><span class="training-status-pill progress">In Progress</span></td>
                        <td><button type="button" class="training-trainees-btn" aria-label="View Helpdesk Service Excellence trainees" data-training-trainees-view data-training-title="Helpdesk Service Excellence" data-training-code="TRN-012" data-training-count="2" data-trainees="Mustafe Cabdi|EMP-0006|Information Technology|Idaacada Branch|2026-04-26|In Progress;Ilwad Noor|EMP-0011|Information Technology|Idaacada Branch|2026-04-27|In Progress"><span class="material-symbols-rounded">visibility</span><span>2</span></button></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="training-title-cell">
                                <strong>Records Management Basics</strong>
                                <span>TRN-011</span>
                            </div>
                        </td>
                        <td><span class="training-badge mandatory">Mandatory</span></td>
                        <td>Compliance</td>
                        <td>Administration</td>
                        <td>Records Desk</td>
                        <td>Idaacada Branch</td>
                        <td>Policy Center</td>
                        <td>2026-05-15</td>
                        <td><span class="training-status-pill scheduled">Scheduled</span></td>
                        <td><button type="button" class="training-trainees-btn" aria-label="View Records Management Basics trainees" data-training-trainees-view data-training-title="Records Management Basics" data-training-code="TRN-011" data-training-count="1" data-trainees="Hodan Ali|EMP-0005|Administration|Idaacada Branch|2026-04-19|Scheduled"><span class="material-symbols-rounded">visibility</span><span>1</span></button></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="training-title-cell">
                                <strong>Customer Journey Analytics</strong>
                                <span>TRN-010</span>
                            </div>
                        </td>
                        <td><span class="training-badge optional">Optional</span></td>
                        <td>Technical</td>
                        <td>Marketing</td>
                        <td>Insights</td>
                        <td>Idaacada Branch</td>
                        <td>Data Sense</td>
                        <td>2026-05-09</td>
                        <td><span class="training-status-pill scheduled">Scheduled</span></td>
                        <td><button type="button" class="training-trainees-btn" aria-label="View Customer Journey Analytics trainees" data-training-trainees-view data-training-title="Customer Journey Analytics" data-training-code="TRN-010" data-training-count="2" data-trainees="Sahra Maxamed|EMP-0004|Marketing|Idaacada Branch|2026-04-16|Scheduled;Nimco Warsame|EMP-0014|Marketing|Idaacada Branch|2026-04-17|Scheduled"><span class="material-symbols-rounded">visibility</span><span>2</span></button></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="training-title-cell">
                                <strong>HR Interview Calibration</strong>
                                <span>TRN-009</span>
                            </div>
                        </td>
                        <td><span class="training-badge mandatory">Mandatory</span></td>
                        <td>Compliance</td>
                        <td>Human Resource</td>
                        <td>Talent Desk</td>
                        <td>Idaacada Branch</td>
                        <td>People First</td>
                        <td>2026-05-02</td>
                        <td><span class="training-status-pill scheduled">Scheduled</span></td>
                        <td><button type="button" class="training-trainees-btn" aria-label="View HR Interview Calibration trainees" data-training-trainees-view data-training-title="HR Interview Calibration" data-training-code="TRN-009" data-training-count="2" data-trainees="Cabdiraxmaan Cali|EMP-0001|Human Resource|Idaacada Branch|2026-04-12|Scheduled;Asha Mohamed|EMP-0010|Human Resource|Idaacada Branch|2026-04-13|Scheduled"><span class="material-symbols-rounded">visibility</span><span>2</span></button></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="training-title-cell">
                                <strong>Advanced Excel for Finance</strong>
                                <span>TRN-008</span>
                            </div>
                        </td>
                        <td><span class="training-badge optional">Optional</span></td>
                        <td>Finance</td>
                        <td>Finance</td>
                        <td>Reporting</td>
                        <td>Idaacada Branch</td>
                        <td>SkillBridge</td>
                        <td>2026-04-18</td>
                        <td><span class="training-status-pill completed">Completed</span></td>
                        <td><button type="button" class="training-trainees-btn" aria-label="View Advanced Excel for Finance trainees" data-training-trainees-view data-training-title="Advanced Excel for Finance" data-training-code="TRN-008" data-training-count="2" data-trainees="Fadumo Xasan|EMP-0002|Finance|Idaacada Branch|2026-03-28|Completed;Khadar Jama|EMP-0012|Finance|Idaacada Branch|2026-03-29|Completed"><span class="material-symbols-rounded">visibility</span><span>2</span></button></td>
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

<div class="training-trainees-modal" id="addTrainingModal" aria-hidden="true">
    <div class="training-trainees-backdrop" data-add-training-close></div>
    <section class="training-trainees-dialog" role="dialog" aria-modal="true" aria-labelledby="addTrainingTitle">
        <div class="training-trainees-header">
            <div>
                <h2 id="addTrainingTitle">Add Training</h2>
                <p>Create a new training catalogue record and append it to the training list.</p>
            </div>
            <button type="button" class="training-trainees-close" data-add-training-close aria-label="Close add training form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="training-trainees-body">
            <form id="addTrainingForm">
                <div class="training-form-grid">
                    <div class="training-form-field">
                        <label for="trainingName">Training Name</label>
                        <input type="text" id="trainingName" name="trainingName" required placeholder="e.g. Safety Induction">
                    </div>
                    <div class="training-form-field">
                        <label for="trainingType">Type</label>
                        <select id="trainingType" name="trainingType" required>
                            <option value="Mandatory">Mandatory</option>
                            <option value="Optional">Optional</option>
                        </select>
                    </div>
                    <div class="training-form-field">
                        <label for="trainingCategory">Category</label>
                        <select id="trainingCategory" name="trainingCategory" required>
                            <option value="Safety">Safety</option>
                            <option value="Finance">Finance</option>
                            <option value="Leadership">Leadership</option>
                            <option value="Technical">Technical</option>
                            <option value="Compliance">Compliance</option>
                        </select>
                    </div>
                    <div class="training-form-field">
                        <label for="trainingDepartment">Department</label>
                        <select id="trainingDepartment" name="trainingDepartment" required>
                            <option value="Administration">Administration</option>
                            <option value="Finance">Finance</option>
                            <option value="Human Resource">Human Resource</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Operations">Operations</option>
                        </select>
                    </div>
                    <div class="training-form-field">
                        <label for="trainingTeam">Team</label>
                        <input type="text" id="trainingTeam" name="trainingTeam" required placeholder="e.g. Branch Response">
                    </div>
                    <div class="training-form-field">
                        <label for="trainingBranch">Branch</label>
                        <input type="text" id="trainingBranch" name="trainingBranch" value="<?php echo htmlspecialchars(hrmBranchName()); ?>" readonly required>
                    </div>
                    <div class="training-form-field">
                        <label for="trainingProvider">Provider</label>
                        <input type="text" id="trainingProvider" name="trainingProvider" required placeholder="e.g. Training Center">
                    </div>
                    <div class="training-form-field">
                        <label for="trainingDate">Training Date</label>
                        <input type="date" id="trainingDate" name="trainingDate" required>
                    </div>
                    <div class="training-form-field">
                        <label for="trainingStatus">Status</label>
                        <select id="trainingStatus" name="trainingStatus" required>
                            <option value="Scheduled">Scheduled</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="training-form-field">
                        <label for="trainingTraineeCount">Trainees</label>
                        <input type="number" id="trainingTraineeCount" name="trainingTraineeCount" min="0" value="0" required>
                    </div>
                    <div class="training-form-field full">
                        <label for="trainingDescription">Description</label>
                        <textarea id="trainingDescription" name="trainingDescription" placeholder="Optional notes for this training."></textarea>
                    </div>
                </div>

                <div class="training-form-actions">
                    <button type="button" class="btn btn-secondary" data-add-training-close>Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-rounded" style="font-size: 18px;">add</span>
                        <span>Save Training</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="training-trainees-modal" id="trainingTraineesModal" aria-hidden="true">
    <div class="training-trainees-backdrop" data-training-trainees-close></div>
    <section class="training-trainees-dialog" role="dialog" aria-modal="true" aria-labelledby="trainingTraineesTitle">
        <div class="training-trainees-header">
            <div>
                <h2 id="trainingTraineesTitle">Registered Trainees</h2>
                <p id="trainingTraineesSubtitle">Training trainee list.</p>
            </div>
            <button type="button" class="training-trainees-close" data-training-trainees-close aria-label="Close registered trainees">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="training-trainees-body">
            <div class="employee-table-panel training-trainees-table-panel">
                <div class="employee-table-scroll">
                    <table class="employee-data-table">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Branch</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="trainingTraineesRows"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('trainingTraineesModal');
    if (!modal) return;

    var addTrainingModal = document.getElementById('addTrainingModal');
    var openTrainingModalButton = document.getElementById('openTrainingModal');
    var addTrainingForm = document.getElementById('addTrainingForm');
    var trainingTableBody = document.getElementById('trainingTableBody');
    var title = document.getElementById('trainingTraineesTitle');
    var subtitle = document.getElementById('trainingTraineesSubtitle');
    var rows = document.getElementById('trainingTraineesRows');

    function escapeHtml(value) {
        return String(value || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function statusClass(status) {
        var normalized = String(status || '').toLowerCase();
        if (normalized === 'completed') return 'completed';
        if (normalized === 'scheduled') return 'scheduled';
        return 'progress';
    }

    function parseTrainees(value) {
        if (!value) return [];
        return value.split(';').map(function (item) {
            var parts = item.split('|');
            return {
                name: parts[0] || '',
                code: parts[1] || '',
                department: parts[2] || '',
                branch: parts[3] || '',
                date: parts[4] || '',
                status: parts[5] || ''
            };
        });
    }

    function openModal(button) {
        var trainees = parseTrainees(button.getAttribute('data-trainees'));
        var trainingTitle = button.getAttribute('data-training-title') || 'Training';
        var trainingCode = button.getAttribute('data-training-code') || '';
        var count = button.getAttribute('data-training-count') || trainees.length;

        title.textContent = 'Registered Trainees';
        subtitle.textContent = trainingTitle + ' (' + trainingCode + ') - ' + count + ' trainee' + (String(count) === '1' ? '' : 's');
        rows.innerHTML = trainees.map(function (trainee) {
            return '<tr>' +
                '<td><div class="training-title-cell"><strong>' + escapeHtml(trainee.name) + '</strong><span>' + escapeHtml(trainee.code) + '</span></div></td>' +
                '<td>' + escapeHtml(trainee.department) + '</td>' +
                '<td>' + escapeHtml(trainee.branch) + '</td>' +
                '<td>' + escapeHtml(trainee.date) + '</td>' +
                '<td><span class="training-status-pill ' + statusClass(trainee.status) + '">' + escapeHtml(trainee.status) + '</span></td>' +
            '</tr>';
        }).join('');

        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function openAddTrainingModal() {
        if (!addTrainingModal) return;
        addTrainingModal.classList.add('open');
        addTrainingModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeAddTrainingModal() {
        if (!addTrainingModal) return;
        addTrainingModal.classList.remove('open');
        addTrainingModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function createTrainingCode() {
        var currentCount = trainingTableBody ? trainingTableBody.querySelectorAll('tr').length : 0;
        return 'TRN-' + String(currentCount + 13).padStart(3, '0');
    }

    function appendTrainingRow(form) {
        if (!trainingTableBody) return;

        var name = form.trainingName.value.trim();
        var type = form.trainingType.value;
        var category = form.trainingCategory.value;
        var department = form.trainingDepartment.value;
        var team = form.trainingTeam.value.trim();
        var branch = form.trainingBranch.value;
        var provider = form.trainingProvider.value.trim();
        var date = form.trainingDate.value;
        var status = form.trainingStatus.value;
        var count = form.trainingTraineeCount.value || '0';
        var code = createTrainingCode();
        var typeClass = type.toLowerCase() === 'mandatory' ? 'mandatory' : 'optional';
        var statusClassName = statusClass(status);

        trainingTableBody.insertAdjacentHTML('afterbegin',
            '<tr>' +
                '<td><div class="training-title-cell"><strong>' + escapeHtml(name) + '</strong><span>' + escapeHtml(code) + '</span></div></td>' +
                '<td><span class="training-badge ' + typeClass + '">' + escapeHtml(type) + '</span></td>' +
                '<td>' + escapeHtml(category) + '</td>' +
                '<td>' + escapeHtml(department) + '</td>' +
                '<td>' + escapeHtml(team) + '</td>' +
                '<td>' + escapeHtml(branch) + '</td>' +
                '<td>' + escapeHtml(provider) + '</td>' +
                '<td>' + escapeHtml(date) + '</td>' +
                '<td><span class="training-status-pill ' + statusClassName + '">' + escapeHtml(status) + '</span></td>' +
                '<td><button type="button" class="training-trainees-btn" aria-label="View ' + escapeHtml(name) + ' trainees" data-training-trainees-view data-training-title="' + escapeHtml(name) + '" data-training-code="' + escapeHtml(code) + '" data-training-count="' + escapeHtml(count) + '" data-trainees=""><span class="material-symbols-rounded">visibility</span><span>' + escapeHtml(count) + '</span></button></td>' +
            '</tr>'
        );
    }

    if (openTrainingModalButton) {
        openTrainingModalButton.addEventListener('click', openAddTrainingModal);
    }

    if (addTrainingModal) {
        addTrainingModal.querySelectorAll('[data-add-training-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeAddTrainingModal);
        });
    }

    if (addTrainingForm) {
        addTrainingForm.addEventListener('submit', function (event) {
            event.preventDefault();
            appendTrainingRow(addTrainingForm);
            addTrainingForm.reset();
            document.getElementById('trainingTraineeCount').value = '0';
            closeAddTrainingModal();
        });
    }

    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-training-trainees-view]');
        if (button) {
            openModal(button);
        }
    });

    modal.querySelectorAll('[data-training-trainees-close]').forEach(function (trigger) {
        trigger.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('open')) {
            closeModal();
        }
        if (event.key === 'Escape' && addTrainingModal && addTrainingModal.classList.contains('open')) {
            closeAddTrainingModal();
        }
    });
});
</script>

<?php
include '../../includes/footer.php';
?>
