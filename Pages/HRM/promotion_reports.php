<?php
$pageTitle = "Reports & Insights";
$activePage = "promotion-reports";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .promotion-reports-header {
        margin-bottom: 42px;
    }

    .promotion-reports-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .promotion-reports-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 1280px;
    }

    .promotion-reports-insights-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(220px, 1fr));
        gap: 24px;
    }

    .promotion-reports-insights-grid .employee-insight-card {
        min-height: 280px;
    }

    .promotion-report-quarter {
        background-color: #d1fae5;
    }

    .promotion-report-quarter .employee-insight-icon {
        background-color: rgba(16, 185, 129, 0.12);
        color: var(--success-hover);
    }

    .promotion-report-year {
        background-color: #bae6fd;
    }

    .promotion-report-year .employee-insight-icon {
        background-color: rgba(14, 165, 233, 0.12);
        color: #0284c7;
    }

    .promotion-report-average {
        background-color: #fef3c7;
    }

    .promotion-report-average .employee-insight-icon {
        background-color: rgba(245, 158, 11, 0.14);
        color: var(--warning-hover);
    }

    .promotion-reports-chart-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        margin-top: 32px;
        overflow: hidden;
        padding: 28px;
    }

    .promotion-reports-chart-header {
        margin-bottom: 18px;
    }

    .promotion-reports-chart-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .promotion-reports-chart-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .promotion-reports-chart-svg {
        display: block;
        width: 100%;
        height: auto;
        overflow: visible;
    }

    .promotion-reports-chart-grid line {
        stroke: rgba(203, 213, 225, 0.8);
        stroke-width: 1;
    }

    .promotion-reports-chart-axis line {
        stroke: rgba(148, 163, 184, 0.72);
        stroke-width: 1.2;
    }

    .promotion-reports-chart-label {
        fill: #475569;
        font-size: 14px;
        font-weight: 700;
    }

    .promotion-reports-chart-bar {
        fill: url(#promotionReportsBarFill);
        rx: 12;
        ry: 12;
        opacity: 0.94;
    }

    .promotion-reports-analytics-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .promotion-reports-line {
        fill: none;
        stroke: #18a8e5;
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .promotion-reports-point {
        fill: #18a8e5;
    }

    .promotion-reports-pie-slice {
        opacity: 0.95;
    }

    .promotion-reports-area-fill {
        fill: url(#promotionReportsQualificationArea);
    }

    .promotion-reports-qualification-line {
        fill: none;
        stroke: #10b981;
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .promotion-reports-qualification-point {
        fill: #10b981;
    }

    .promotion-reports-bottleneck-line {
        fill: none;
        stroke: #f59e0b;
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .promotion-reports-bottleneck-point {
        fill: #f59e0b;
    }

    .promotion-reports-summary-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .promotion-reports-summary-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        min-height: 560px;
        overflow: hidden;
        padding: 28px;
    }

    .promotion-reports-summary-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 22px;
        margin-bottom: 30px;
    }

    .promotion-reports-summary-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .promotion-reports-summary-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
        max-width: 520px;
    }

    .promotion-reports-summary-pill {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        min-width: 118px;
        min-height: 58px;
        padding: 9px 18px;
        font-size: 0.9rem;
        font-weight: 900;
        line-height: 1.25;
        text-align: center;
        white-space: nowrap;
    }

    .promotion-reports-summary-pill strong {
        display: block;
        font-size: 0.96rem;
    }

    .promotion-reports-summary-pill.overdue {
        background-color: rgba(254, 226, 226, 0.82);
        color: #e11d48;
    }

    .promotion-reports-summary-pill.expiring {
        background-color: rgba(254, 243, 199, 0.84);
        color: #d97706;
    }

    .promotion-reports-summary-list {
        display: grid;
        gap: 18px;
    }

    .promotion-reports-summary-card {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.72), rgba(255, 241, 247, 0.72));
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        min-height: 110px;
        padding: 24px;
    }

    .promotion-reports-summary-card h3 {
        color: var(--neutral-dark);
        font-size: 1.12rem;
        line-height: 1.28;
        margin-bottom: 8px;
    }

    .promotion-reports-summary-card p {
        color: #94a3b8;
        font-size: 0.96rem;
        font-weight: 600;
        line-height: 1.35;
    }

    .promotion-reports-list-pill {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 118px;
        padding: 8px 16px;
        font-size: 0.82rem;
        font-weight: 900;
        line-height: 1.2;
        white-space: nowrap;
    }

    .promotion-reports-list-pill.late {
        background-color: rgba(254, 226, 226, 0.82);
        color: #e11d48;
    }

    .promotion-reports-list-pill.days {
        background-color: rgba(254, 243, 199, 0.84);
        color: #d97706;
    }

    .promotion-reports-chart-legend {
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

    .promotion-reports-chart-legend span {
        display: inline-flex;
        align-items: center;
    }

    .promotion-reports-chart-legend i {
        width: 14px;
        height: 14px;
        border-radius: var(--radius-full);
        display: inline-block;
        margin-right: 6px;
    }

    .promotion-reports-legend-idaacada {
        background-color: #6366f1;
    }

    .promotion-reports-legend-xero {
        background-color: #10b981;
    }

    .promotion-reports-legend-calaamada {
        background-color: #0ea5e9;
    }

    .promotion-reports-legend-masalaha {
        background-color: #f59e0b;
    }

    .promotion-reports-legend-jigjiga {
        background-color: #8b5cf6;
    }

    @media (max-width: 1180px) {
        .promotion-reports-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .promotion-reports-analytics-grid {
            grid-template-columns: 1fr;
        }

        .promotion-reports-summary-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .promotion-reports-insights-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="promotion-reports-header">
    <h1>Reports & Insights</h1>
    <p>Track promotion activity, qualification impact, review bottlenecks, and promotion readiness trends across the organization.</p>
</div>

<div class="promotion-reports-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Promotions This Month</h3>
            <strong>14</strong>
            <p>Completed promotion actions in the current month.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">calendar_month</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-report-quarter">
        <div>
            <h3>Promotions This Quarter</h3>
            <strong>37</strong>
            <p>Total promotions completed during the current quarter.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">monitoring</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-report-year">
        <div>
            <h3>Promotions This Year</h3>
            <strong>118</strong>
            <p>Year-to-date completed promotion records across departments.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">trending_up</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-report-average">
        <div>
            <h3>Avg Time to Promotion</h3>
            <strong>4.8 Months</strong>
            <p>Average time from request initiation to final promotion outcome.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">timer</span>
        </div>
    </div>
</div>

<section class="promotion-reports-chart-panel">
    <div class="promotion-reports-chart-header">
        <h2>Department Comparison</h2>
        <p>Promotion volumes by department in the current reporting window.</p>
    </div>

    <svg class="promotion-reports-chart-svg" viewBox="0 0 1320 460" role="img" aria-label="Department comparison promotion volume chart">
        <defs>
            <linearGradient id="promotionReportsBarFill" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#6d79f5"></stop>
                <stop offset="100%" stop-color="#8b7cf6"></stop>
            </linearGradient>
        </defs>
        <g class="promotion-reports-chart-grid">
            <line x1="64" y1="48" x2="1288" y2="48"></line>
            <line x1="64" y1="128" x2="1288" y2="128"></line>
            <line x1="64" y1="208" x2="1288" y2="208"></line>
            <line x1="64" y1="288" x2="1288" y2="288"></line>
            <line x1="64" y1="368" x2="1288" y2="368"></line>
        </g>
        <g class="promotion-reports-chart-axis">
            <line x1="64" y1="48" x2="64" y2="368"></line>
            <line x1="64" y1="368" x2="1288" y2="368"></line>
        </g>
        <g>
            <text class="promotion-reports-chart-label" x="28" y="52">25</text>
            <text class="promotion-reports-chart-label" x="28" y="132">20</text>
            <text class="promotion-reports-chart-label" x="28" y="212">15</text>
            <text class="promotion-reports-chart-label" x="28" y="292">10</text>
            <text class="promotion-reports-chart-label" x="36" y="372">0</text>
        </g>
        <g>
            <rect class="promotion-reports-chart-bar" x="136" y="64" width="62" height="304" data-chart-title="Operations" data-chart-value="24 promotions in this reporting window"></rect>
            <rect class="promotion-reports-chart-bar" x="340" y="144" width="62" height="224" data-chart-title="Finance" data-chart-value="19 promotions in this reporting window"></rect>
            <rect class="promotion-reports-chart-bar" x="544" y="176" width="62" height="192" data-chart-title="Human Resource" data-chart-value="17 promotions in this reporting window"></rect>
            <rect class="promotion-reports-chart-bar" x="748" y="208" width="62" height="160" data-chart-title="Administration" data-chart-value="15 promotions in this reporting window"></rect>
            <rect class="promotion-reports-chart-bar" x="952" y="272" width="62" height="96" data-chart-title="Marketing" data-chart-value="11 promotions in this reporting window"></rect>
            <rect class="promotion-reports-chart-bar" x="1156" y="304" width="62" height="64" data-chart-title="IT" data-chart-value="9 promotions in this reporting window"></rect>
        </g>
        <g>
            <text class="promotion-reports-chart-label" x="167" y="410" text-anchor="middle">Operations</text>
            <text class="promotion-reports-chart-label" x="371" y="410" text-anchor="middle">Finance</text>
            <text class="promotion-reports-chart-label" x="575" y="410" text-anchor="middle">Human Resource</text>
            <text class="promotion-reports-chart-label" x="779" y="410" text-anchor="middle">Administration</text>
            <text class="promotion-reports-chart-label" x="983" y="410" text-anchor="middle">Marketing</text>
            <text class="promotion-reports-chart-label" x="1187" y="410" text-anchor="middle">IT</text>
        </g>
    </svg>
</section>

<div class="promotion-reports-analytics-grid">
    <section class="promotion-reports-chart-panel">
        <div class="promotion-reports-chart-header">
            <h2>Completion Trend</h2>
            <p>Monthly line trend for completed promotions across the year.</p>
        </div>

        <svg class="promotion-reports-chart-svg" viewBox="0 0 620 440" role="img" aria-label="Monthly completed promotion trend chart">
            <g class="promotion-reports-chart-grid">
                <line x1="64" y1="54" x2="590" y2="54"></line>
                <line x1="64" y1="106" x2="590" y2="106"></line>
                <line x1="64" y1="158" x2="590" y2="158"></line>
                <line x1="64" y1="210" x2="590" y2="210"></line>
                <line x1="64" y1="262" x2="590" y2="262"></line>
                <line x1="64" y1="314" x2="590" y2="314"></line>
                <line x1="64" y1="366" x2="590" y2="366"></line>
            </g>
            <g class="promotion-reports-chart-axis">
                <line x1="64" y1="54" x2="64" y2="366"></line>
                <line x1="64" y1="366" x2="590" y2="366"></line>
            </g>
            <g>
                <text class="promotion-reports-chart-label" x="30" y="58">16</text>
                <text class="promotion-reports-chart-label" x="30" y="110">14</text>
                <text class="promotion-reports-chart-label" x="30" y="162">12</text>
                <text class="promotion-reports-chart-label" x="30" y="214">10</text>
                <text class="promotion-reports-chart-label" x="38" y="266">8</text>
                <text class="promotion-reports-chart-label" x="38" y="318">4</text>
                <text class="promotion-reports-chart-label" x="38" y="370">0</text>
            </g>
            <path class="promotion-reports-line" d="M64 314 L112 262 L160 236 L208 184 L256 158 L304 210 L352 262 L400 106 L448 158 L496 184 L544 132 L590 80"></path>
            <g>
                <circle class="promotion-reports-point" cx="64" cy="314" r="7" data-chart-title="January" data-chart-value="6 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="112" cy="262" r="7" data-chart-title="February" data-chart-value="8 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="160" cy="236" r="7" data-chart-title="March" data-chart-value="9 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="208" cy="184" r="7" data-chart-title="April" data-chart-value="11 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="256" cy="158" r="7" data-chart-title="May" data-chart-value="13 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="304" cy="210" r="7" data-chart-title="June" data-chart-value="12 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="352" cy="262" r="7" data-chart-title="July" data-chart-value="10 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="400" cy="106" r="7" data-chart-title="August" data-chart-value="14 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="448" cy="158" r="7" data-chart-title="September" data-chart-value="12 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="496" cy="184" r="7" data-chart-title="October" data-chart-value="11 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="544" cy="132" r="7" data-chart-title="November" data-chart-value="13 completed promotions"></circle>
                <circle class="promotion-reports-point" cx="590" cy="80" r="7" data-chart-title="December" data-chart-value="15 completed promotions"></circle>
            </g>
            <g>
                <text class="promotion-reports-chart-label" x="64" y="404" text-anchor="middle">Jan</text>
                <text class="promotion-reports-chart-label" x="112" y="404" text-anchor="middle">Feb</text>
                <text class="promotion-reports-chart-label" x="160" y="404" text-anchor="middle">Mar</text>
                <text class="promotion-reports-chart-label" x="208" y="404" text-anchor="middle">Apr</text>
                <text class="promotion-reports-chart-label" x="256" y="404" text-anchor="middle">May</text>
                <text class="promotion-reports-chart-label" x="304" y="404" text-anchor="middle">Jun</text>
                <text class="promotion-reports-chart-label" x="352" y="404" text-anchor="middle">Jul</text>
                <text class="promotion-reports-chart-label" x="400" y="404" text-anchor="middle">Aug</text>
                <text class="promotion-reports-chart-label" x="448" y="404" text-anchor="middle">Sep</text>
                <text class="promotion-reports-chart-label" x="496" y="404" text-anchor="middle">Oct</text>
                <text class="promotion-reports-chart-label" x="544" y="404" text-anchor="middle">Nov</text>
                <text class="promotion-reports-chart-label" x="590" y="404" text-anchor="middle">Dec</text>
            </g>
        </svg>
    </section>

    <section class="promotion-reports-chart-panel">
        <div class="promotion-reports-chart-header">
            <h2>Training Participation by Branch</h2>
            <p>Promotion-readiness training participation across branches.</p>
        </div>

        <svg class="promotion-reports-chart-svg" viewBox="0 0 620 440" role="img" aria-label="Training participation by branch pie chart">
            <g transform="translate(310 206)">
                <path class="promotion-reports-pie-slice" d="M0 0 L0 -150 A150 150 0 0 1 149.2 15.7 Z" fill="#6366f1" data-chart-title="Idaacada Branch" data-chart-value="26% training participation"></path>
                <path class="promotion-reports-pie-slice" d="M0 0 L149.2 15.7 A150 150 0 0 1 39.1 144.9 Z" fill="#10b981" data-chart-title="Xero Awr Branch" data-chart-value="18% training participation"></path>
                <path class="promotion-reports-pie-slice" d="M0 0 L39.1 144.9 A150 150 0 0 1 -121.4 88.2 Z" fill="#0ea5e9" data-chart-title="Calaamada Branch" data-chart-value="21% training participation"></path>
                <path class="promotion-reports-pie-slice" d="M0 0 L-121.4 88.2 A150 150 0 0 1 -142.7 -46.4 Z" fill="#f59e0b" data-chart-title="Masalaha Branch" data-chart-value="15% training participation"></path>
                <path class="promotion-reports-pie-slice" d="M0 0 L-142.7 -46.4 A150 150 0 0 1 0 -150 Z" fill="#8b5cf6" data-chart-title="Jigjiga Yar Branch" data-chart-value="20% training participation"></path>
            </g>
        </svg>

        <div class="promotion-reports-chart-legend">
            <span><i class="promotion-reports-legend-idaacada"></i>Idaacada Branch</span>
            <span><i class="promotion-reports-legend-xero"></i>Xero Awr Branch</span>
            <span><i class="promotion-reports-legend-calaamada"></i>Calaamada Branch</span>
            <span><i class="promotion-reports-legend-masalaha"></i>Masalaha Branch</span>
            <span><i class="promotion-reports-legend-jigjiga"></i>Jigjiga Yar Branch</span>
        </div>
    </section>
</div>

<div class="promotion-reports-analytics-grid">
    <section class="promotion-reports-chart-panel">
        <div class="promotion-reports-chart-header">
            <h2>Qualification Impact</h2>
            <p>How verified qualifications contribute to successful promotion movement.</p>
        </div>

        <svg class="promotion-reports-chart-svg" viewBox="0 0 620 440" role="img" aria-label="Qualification impact area chart">
            <defs>
                <linearGradient id="promotionReportsQualificationArea" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#10b981" stop-opacity="0.22"></stop>
                    <stop offset="100%" stop-color="#10b981" stop-opacity="0.06"></stop>
                </linearGradient>
            </defs>
            <g class="promotion-reports-chart-grid">
                <line x1="78" y1="54" x2="560" y2="54"></line>
                <line x1="78" y1="108" x2="560" y2="108"></line>
                <line x1="78" y1="162" x2="560" y2="162"></line>
                <line x1="78" y1="216" x2="560" y2="216"></line>
                <line x1="78" y1="270" x2="560" y2="270"></line>
                <line x1="78" y1="324" x2="560" y2="324"></line>
                <line x1="78" y1="378" x2="560" y2="378"></line>
            </g>
            <g class="promotion-reports-chart-axis">
                <line x1="78" y1="54" x2="78" y2="378"></line>
                <line x1="78" y1="378" x2="560" y2="378"></line>
            </g>
            <g>
                <text class="promotion-reports-chart-label" x="38" y="58">35</text>
                <text class="promotion-reports-chart-label" x="38" y="112">30</text>
                <text class="promotion-reports-chart-label" x="38" y="166">25</text>
                <text class="promotion-reports-chart-label" x="38" y="220">20</text>
                <text class="promotion-reports-chart-label" x="38" y="274">15</text>
                <text class="promotion-reports-chart-label" x="38" y="328">10</text>
                <text class="promotion-reports-chart-label" x="38" y="382">0</text>
            </g>
            <path class="promotion-reports-area-fill" d="M78 248 C116 232, 154 214, 190 184 S252 108, 306 92 S386 58, 424 60 S512 128, 560 150 L560 378 L78 378 Z"></path>
            <path class="promotion-reports-qualification-line" d="M78 248 C116 232, 154 214, 190 184 S252 108, 306 92 S386 58, 424 60 S512 128, 560 150"></path>
            <g>
                <circle class="promotion-reports-qualification-point" cx="78" cy="248" r="7" data-chart-title="Certificate" data-chart-value="12 successful promotion movements"></circle>
                <circle class="promotion-reports-qualification-point" cx="190" cy="184" r="7" data-chart-title="Diploma" data-chart-value="18 successful promotion movements"></circle>
                <circle class="promotion-reports-qualification-point" cx="306" cy="92" r="7" data-chart-title="Degree" data-chart-value="29 successful promotion movements"></circle>
                <circle class="promotion-reports-qualification-point" cx="424" cy="60" r="7" data-chart-title="Postgraduate" data-chart-value="34 successful promotion movements"></circle>
                <circle class="promotion-reports-qualification-point" cx="560" cy="150" r="7" data-chart-title="Professional License" data-chart-value="26 successful promotion movements"></circle>
            </g>
            <g>
                <text class="promotion-reports-chart-label" x="78" y="416" text-anchor="middle" transform="rotate(-14 78 416)">Certificate</text>
                <text class="promotion-reports-chart-label" x="190" y="416" text-anchor="middle" transform="rotate(-14 190 416)">Diploma</text>
                <text class="promotion-reports-chart-label" x="306" y="416" text-anchor="middle" transform="rotate(-14 306 416)">Degree</text>
                <text class="promotion-reports-chart-label" x="424" y="416" text-anchor="middle" transform="rotate(-14 424 416)">Postgraduate</text>
                <text class="promotion-reports-chart-label" x="560" y="416" text-anchor="middle" transform="rotate(-14 560 416)">Professional License</text>
            </g>
        </svg>
    </section>

    <section class="promotion-reports-chart-panel">
        <div class="promotion-reports-chart-header">
            <h2>Approval Bottlenecks</h2>
            <p>Average waiting time across each approval checkpoint.</p>
        </div>

        <svg class="promotion-reports-chart-svg" viewBox="0 0 620 440" role="img" aria-label="Approval bottlenecks line chart">
            <g class="promotion-reports-chart-grid">
                <line x1="74" y1="54" x2="590" y2="54"></line>
                <line x1="74" y1="108" x2="590" y2="108"></line>
                <line x1="74" y1="162" x2="590" y2="162"></line>
                <line x1="74" y1="216" x2="590" y2="216"></line>
                <line x1="74" y1="270" x2="590" y2="270"></line>
                <line x1="74" y1="324" x2="590" y2="324"></line>
                <line x1="74" y1="378" x2="590" y2="378"></line>
            </g>
            <g class="promotion-reports-chart-axis">
                <line x1="74" y1="54" x2="74" y2="378"></line>
                <line x1="74" y1="378" x2="590" y2="378"></line>
            </g>
            <g>
                <text class="promotion-reports-chart-label" x="42" y="58">6</text>
                <text class="promotion-reports-chart-label" x="42" y="112">5</text>
                <text class="promotion-reports-chart-label" x="42" y="166">4</text>
                <text class="promotion-reports-chart-label" x="42" y="220">3</text>
                <text class="promotion-reports-chart-label" x="42" y="274">2</text>
                <text class="promotion-reports-chart-label" x="42" y="328">1</text>
                <text class="promotion-reports-chart-label" x="42" y="382">0</text>
            </g>
            <path class="promotion-reports-bottleneck-line" d="M74 270 C104 232, 134 172, 178 162 S258 216, 306 216 S408 54, 458 54 S540 252, 590 270"></path>
            <g>
                <circle class="promotion-reports-bottleneck-point" cx="74" cy="270" r="7" data-chart-title="Manager Review" data-chart-value="2 days average wait"></circle>
                <circle class="promotion-reports-bottleneck-point" cx="178" cy="162" r="7" data-chart-title="Department Head" data-chart-value="4 days average wait"></circle>
                <circle class="promotion-reports-bottleneck-point" cx="306" cy="216" r="7" data-chart-title="HR Review" data-chart-value="3 days average wait"></circle>
                <circle class="promotion-reports-bottleneck-point" cx="458" cy="54" r="7" data-chart-title="Committee" data-chart-value="6 days average wait"></circle>
                <circle class="promotion-reports-bottleneck-point" cx="590" cy="270" r="7" data-chart-title="Final Approval" data-chart-value="2 days average wait"></circle>
            </g>
            <g>
                <text class="promotion-reports-chart-label" x="74" y="416" text-anchor="middle" transform="rotate(-14 74 416)">Manager Review</text>
                <text class="promotion-reports-chart-label" x="178" y="416" text-anchor="middle" transform="rotate(-14 178 416)">Department Head</text>
                <text class="promotion-reports-chart-label" x="306" y="416" text-anchor="middle" transform="rotate(-14 306 416)">HR Review</text>
                <text class="promotion-reports-chart-label" x="458" y="416" text-anchor="middle" transform="rotate(-14 458 416)">Committee</text>
                <text class="promotion-reports-chart-label" x="590" y="416" text-anchor="middle" transform="rotate(-14 590 416)">Final Approval</text>
            </g>
        </svg>
    </section>
</div>

<div class="promotion-reports-summary-grid">
    <section class="promotion-reports-summary-panel">
        <div class="promotion-reports-summary-header">
            <div>
                <h2>Overdue Mandatory Promotion Reviews</h2>
                <p>Employees whose mandatory review cycles are still overdue.</p>
            </div>
            <span class="promotion-reports-summary-pill overdue"><strong>4</strong>Overdue</span>
        </div>

        <div class="promotion-reports-summary-list">
            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Mahad Axmed</h3>
                    <p>Finance · Senior Finance Officer</p>
                </div>
                <span class="promotion-reports-list-pill late">12 Days Late</span>
            </article>

            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Sahra Cali</h3>
                    <p>Human Resource · Senior HR Officer</p>
                </div>
                <span class="promotion-reports-list-pill late">9 Days Late</span>
            </article>

            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Ifrah Maxamed</h3>
                    <p>Marketing · Marketing Lead</p>
                </div>
                <span class="promotion-reports-list-pill late">7 Days Late</span>
            </article>

            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Hodan Aadan</h3>
                    <p>Administration · Compliance Lead</p>
                </div>
                <span class="promotion-reports-list-pill late">5 Days Late</span>
            </article>
        </div>
    </section>

    <section class="promotion-reports-summary-panel">
        <div class="promotion-reports-summary-header">
            <div>
                <h2>Expiring Qualification Summary</h2>
                <p>Certificates and qualifications approaching expiry in the next review window.</p>
            </div>
            <span class="promotion-reports-summary-pill expiring"><strong>6</strong>Expiring</span>
        </div>

        <div class="promotion-reports-summary-list">
            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Leadership Certificate</h3>
                    <p>Operations Branch Supervisors</p>
                </div>
                <span class="promotion-reports-list-pill days">14 Days</span>
            </article>

            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Audit Compliance Renewal</h3>
                    <p>Finance and Administration Teams</p>
                </div>
                <span class="promotion-reports-list-pill days">18 Days</span>
            </article>

            <article class="promotion-reports-summary-card">
                <div>
                    <h3>HR Mediation Certification</h3>
                    <p>HR Officers and HR Business Partners</p>
                </div>
                <span class="promotion-reports-list-pill days">21 Days</span>
            </article>

            <article class="promotion-reports-summary-card">
                <div>
                    <h3>Systems Security Certificate</h3>
                    <p>IT Infrastructure Team</p>
                </div>
                <span class="promotion-reports-list-pill days">27 Days</span>
            </article>
        </div>
    </section>
</div>

<?php include '../../includes/footer.php'; ?>
