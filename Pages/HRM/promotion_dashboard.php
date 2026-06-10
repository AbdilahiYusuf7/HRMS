<?php
$pageTitle = "Promotion & Ranking Dashboard";
$activePage = "promotion-ranking";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .promotion-page-header {
        margin-bottom: 42px;
    }

    .promotion-page-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .promotion-page-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 980px;
    }

    .promotion-insights-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(260px, 1fr));
        gap: 24px;
    }

    .promotion-insights-grid .employee-insight-card {
        min-height: 220px;
    }

    .promotion-insight-rules {
        background-color: #bae6fd;
    }

    .promotion-insight-rules .employee-insight-icon {
        background-color: rgba(77, 168, 218, 0.16);
        color: #0284c7;
    }

    .promotion-analytics-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(360px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .promotion-chart-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 28px;
        overflow: hidden;
    }

    .promotion-chart-header {
        margin-bottom: 18px;
    }

    .promotion-chart-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .promotion-chart-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .promotion-chart-svg {
        display: block;
        width: 100%;
        height: auto;
        overflow: visible;
    }

    .promotion-chart-grid line {
        stroke: rgba(203, 213, 225, 0.8);
        stroke-width: 1;
    }

    .promotion-chart-axis line {
        stroke: rgba(148, 163, 184, 0.72);
        stroke-width: 1.2;
    }

    .promotion-chart-scale text,
    .promotion-chart-labels text {
        fill: #475569;
        font-size: 14px;
        font-weight: 700;
    }

    .promotion-chart-bar {
        fill: #4f46e5;
        rx: 9;
        ry: 9;
    }

    .promotion-rank-fill {
        fill: url(#promotionRankArea);
    }

    .promotion-rank-line {
        fill: none;
        stroke: var(--secondary-color);
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .promotion-rank-point {
        fill: var(--secondary-color);
    }

    .promotion-month-line {
        fill: none;
        stroke: #10b981;
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .promotion-month-point {
        fill: #10b981;
    }

    .promotion-radial-ring {
        fill: none;
        stroke: rgba(203, 213, 225, 0.58);
        stroke-width: 1.2;
    }

    .promotion-radial-axis {
        stroke: rgba(203, 213, 225, 0.72);
        stroke-width: 1.4;
    }

    .promotion-radial-label {
        fill: #64748b;
        font-size: 14px;
        font-weight: 800;
    }

    .promotion-radial-slice {
        opacity: 0.9;
    }

    .promotion-chart-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #334155;
        font-size: 0.86rem;
        font-weight: 900;
        margin-top: 12px;
    }

    .promotion-chart-legend i {
        width: 14px;
        height: 14px;
        display: inline-block;
    }

    .promotion-chart-legend i.solid {
        background-color: #4f46e5;
    }

    .promotion-chart-legend i.outline {
        border: 4px solid var(--secondary-color);
    }

    .promotion-chart-legend i.green-outline {
        border: 4px solid #10b981;
    }

    .promotion-chart-legend.wrap {
        flex-wrap: wrap;
        row-gap: 12px;
    }

    .promotion-chart-legend i.eligible {
        background-color: #7167e8;
    }

    .promotion-chart-legend i.review {
        background-color: #38bdf8;
    }

    .promotion-chart-legend i.nearing {
        background-color: #fbbf24;
    }

    .promotion-chart-legend i.deferred {
        background-color: #f87171;
    }

    .promotion-activity-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .promotion-activity-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 28px;
        min-height: 560px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .promotion-activity-header {
        margin-bottom: 24px;
    }

    .promotion-activity-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .promotion-activity-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.36;
    }

    .promotion-activity-list {
        display: grid;
        gap: 18px;
        overflow-y: auto;
        padding-right: 6px;
        max-height: 430px;
    }

    .promotion-activity-list::-webkit-scrollbar {
        width: 8px;
    }

    .promotion-activity-list::-webkit-scrollbar-track {
        background-color: rgba(226, 232, 240, 0.68);
        border-radius: var(--radius-full);
    }

    .promotion-activity-list::-webkit-scrollbar-thumb {
        background-color: rgba(148, 163, 184, 0.72);
        border-radius: var(--radius-full);
    }

    .promotion-activity-card {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.72), rgba(255, 241, 247, 0.72));
        padding: 22px;
    }

    .promotion-activity-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }

    .promotion-activity-top h3 {
        color: var(--neutral-dark);
        font-size: 1rem;
        line-height: 1.28;
        margin-bottom: 8px;
    }

    .promotion-activity-top p,
    .promotion-activity-card p,
    .promotion-activity-meta {
        color: var(--neutral-gray);
        font-size: 0.9rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .promotion-activity-role {
        color: #334155;
        font-size: 0.98rem;
        font-weight: 600;
        line-height: 1.42;
        margin-bottom: 14px;
    }

    .promotion-activity-role span {
        color: #94a3b8;
    }

    .promotion-activity-kicker {
        color: #94a3b8;
        display: block;
        font-size: 0.76rem;
        font-weight: 900;
        letter-spacing: 0.24em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .promotion-pill {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 88px;
        padding: 7px 12px;
        font-size: 0.78rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .promotion-pill.pending {
        background-color: var(--warning-light);
        color: var(--warning-hover);
    }

    .promotion-pill.percent {
        background-color: var(--secondary-light);
        color: #0284c7;
        min-width: 70px;
    }

    @media (max-width: 1180px) {
        .promotion-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .promotion-analytics-grid {
            grid-template-columns: 1fr;
        }

        .promotion-activity-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .promotion-insights-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="promotion-page-header">
    <h1>Promotion & Ranking Dashboard</h1>
    <p>Promotion pipeline overview, ranking spread, eligibility tracking, and recent movement across departments.</p>
</div>

<div class="promotion-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Total Promotions Made</h3>
            <strong>12 Cases</strong>
            <p>All promotion cases recorded in the dashboard sample set.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">trending_up</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>Approved Promotions</h3>
            <strong>7 Approved</strong>
            <p>Promotion requests approved and scheduled for effect.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">check_circle</span>
        </div>
    </div>

    <div class="employee-insight-card least-performing">
        <div>
            <h3>Rejected Promotions</h3>
            <strong>2 Rejected</strong>
            <p>Promotion requests declined after review.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">cancel</span>
        </div>
    </div>

    <div class="employee-insight-card leave">
        <div>
            <h3>Pending Promotions</h3>
            <strong>3 Pending</strong>
            <p>Promotion requests still awaiting a final decision.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">hourglass_top</span>
        </div>
    </div>

    <div class="employee-insight-card promotion-insight-rules">
        <div>
            <h3>Promotion Rules Addressed</h3>
            <strong>5 Rules</strong>
            <p>Distinct promotion rules referenced across current reviews.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">balance</span>
        </div>
    </div>
</div>

<div class="promotion-analytics-grid">
    <section class="promotion-chart-panel">
        <div class="promotion-chart-header">
            <h2>Promotions by Department</h2>
            <p>Column chart showing promotion request volume by department.</p>
        </div>

        <svg class="promotion-chart-svg" viewBox="0 0 620 370" role="img" aria-label="Promotions by department chart">
            <g class="promotion-chart-grid">
                <line x1="64" y1="48" x2="590" y2="48"></line>
                <line x1="64" y1="86" x2="590" y2="86"></line>
                <line x1="64" y1="124" x2="590" y2="124"></line>
                <line x1="64" y1="162" x2="590" y2="162"></line>
                <line x1="64" y1="200" x2="590" y2="200"></line>
                <line x1="64" y1="238" x2="590" y2="238"></line>
                <line x1="64" y1="276" x2="590" y2="276"></line>
                <line x1="64" y1="314" x2="590" y2="314"></line>
            </g>
            <g class="promotion-chart-axis">
                <line x1="64" y1="48" x2="64" y2="314"></line>
                <line x1="64" y1="314" x2="590" y2="314"></line>
            </g>
            <g class="promotion-chart-scale">
                <text x="36" y="53">8</text>
                <text x="36" y="91">7</text>
                <text x="36" y="129">6</text>
                <text x="36" y="167">5</text>
                <text x="36" y="205">4</text>
                <text x="36" y="243">3</text>
                <text x="36" y="281">2</text>
                <text x="36" y="319">0</text>
            </g>
            <rect class="promotion-chart-bar" x="86" y="48" width="64" height="266" data-chart-title="Human Resource" data-chart-value="8 promotion cases"></rect>
            <rect class="promotion-chart-bar" x="172" y="124" width="64" height="190" data-chart-title="Finance" data-chart-value="6 promotion cases"></rect>
            <rect class="promotion-chart-bar" x="258" y="162" width="64" height="152" data-chart-title="Operations" data-chart-value="5 promotion cases"></rect>
            <rect class="promotion-chart-bar" x="344" y="200" width="64" height="114" data-chart-title="Marketing" data-chart-value="4 promotion cases"></rect>
            <rect class="promotion-chart-bar" x="430" y="86" width="64" height="228" data-chart-title="Administration" data-chart-value="7 promotion cases"></rect>
            <rect class="promotion-chart-bar" x="516" y="238" width="64" height="76" data-chart-title="Information Technology" data-chart-value="3 promotion cases"></rect>
            <g class="promotion-chart-labels">
                <text x="118" y="350" text-anchor="middle" transform="rotate(-23 118 350)">Human Resource</text>
                <text x="204" y="350" text-anchor="middle" transform="rotate(-23 204 350)">Finance</text>
                <text x="290" y="350" text-anchor="middle" transform="rotate(-23 290 350)">Operations</text>
                <text x="376" y="350" text-anchor="middle" transform="rotate(-23 376 350)">Marketing</text>
                <text x="462" y="350" text-anchor="middle" transform="rotate(-23 462 350)">Administration</text>
                <text x="548" y="350" text-anchor="middle" transform="rotate(-23 548 350)">Information Technology</text>
            </g>
        </svg>

        <div class="promotion-chart-legend">
            <i class="solid"></i>
            <span>Promotion Cases</span>
        </div>
    </section>

    <section class="promotion-chart-panel">
        <div class="promotion-chart-header">
            <h2>Rank Distribution</h2>
            <p>Current employee spread across rank levels.</p>
        </div>

        <svg class="promotion-chart-svg" viewBox="0 0 620 370" role="img" aria-label="Rank distribution chart">
            <defs>
                <linearGradient id="promotionRankArea" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#0ea5e9" stop-opacity="0.22"></stop>
                    <stop offset="100%" stop-color="#0ea5e9" stop-opacity="0.04"></stop>
                </linearGradient>
            </defs>
            <g class="promotion-chart-grid">
                <line x1="64" y1="48" x2="590" y2="48"></line>
                <line x1="64" y1="90" x2="590" y2="90"></line>
                <line x1="64" y1="132" x2="590" y2="132"></line>
                <line x1="64" y1="174" x2="590" y2="174"></line>
                <line x1="64" y1="216" x2="590" y2="216"></line>
                <line x1="64" y1="258" x2="590" y2="258"></line>
                <line x1="64" y1="300" x2="590" y2="300"></line>
                <line x1="64" y1="326" x2="590" y2="326"></line>
            </g>
            <g class="promotion-chart-axis">
                <line x1="64" y1="48" x2="64" y2="326"></line>
                <line x1="64" y1="326" x2="590" y2="326"></line>
            </g>
            <g class="promotion-chart-scale">
                <text x="28" y="53">35</text>
                <text x="28" y="95">30</text>
                <text x="28" y="137">25</text>
                <text x="28" y="179">20</text>
                <text x="28" y="221">15</text>
                <text x="28" y="263">10</text>
                <text x="36" y="305">5</text>
                <text x="36" y="331">0</text>
            </g>
            <path class="promotion-rank-fill" d="M64 190 C102 118 120 52 170 58 C220 58 248 100 276 112 C318 134 330 178 380 200 C424 230 462 254 486 258 C526 266 552 294 590 300 L590 326 L64 326 Z"></path>
            <path class="promotion-rank-line" d="M64 190 C102 118 120 52 170 58 C220 58 248 100 276 112 C318 134 330 178 380 200 C424 230 462 254 486 258 C526 266 552 294 590 300"></path>
            <g>
                <circle class="promotion-rank-point" cx="64" cy="190" r="7" data-chart-title="Associate" data-chart-value="18 employees"></circle>
                <circle class="promotion-rank-point" cx="170" cy="58" r="7" data-chart-title="Officer I" data-chart-value="34 employees"></circle>
                <circle class="promotion-rank-point" cx="276" cy="112" r="7" data-chart-title="Officer II" data-chart-value="29 employees"></circle>
                <circle class="promotion-rank-point" cx="380" cy="200" r="7" data-chart-title="Senior Officer" data-chart-value="17 employees"></circle>
                <circle class="promotion-rank-point" cx="486" cy="258" r="7" data-chart-title="Lead" data-chart-value="10 employees"></circle>
                <circle class="promotion-rank-point" cx="590" cy="300" r="7" data-chart-title="Manager" data-chart-value="5 employees"></circle>
            </g>
            <g class="promotion-chart-labels">
                <text x="64" y="352" text-anchor="middle" transform="rotate(-13 64 352)">Associate</text>
                <text x="170" y="352" text-anchor="middle" transform="rotate(-13 170 352)">Officer I</text>
                <text x="276" y="352" text-anchor="middle" transform="rotate(-13 276 352)">Officer II</text>
                <text x="380" y="352" text-anchor="middle" transform="rotate(-13 380 352)">Senior Officer</text>
                <text x="486" y="352" text-anchor="middle" transform="rotate(-13 486 352)">Lead</text>
                <text x="590" y="352" text-anchor="middle" transform="rotate(-13 590 352)">Manager</text>
            </g>
        </svg>

        <div class="promotion-chart-legend">
            <i class="outline"></i>
            <span>Employees</span>
        </div>
    </section>
</div>

<div class="promotion-analytics-grid">
    <section class="promotion-chart-panel">
        <div class="promotion-chart-header">
            <h2>Monthly Promotion Trend</h2>
            <p>Line chart showing approved promotions across recent months.</p>
        </div>

        <svg class="promotion-chart-svg" viewBox="0 0 620 370" role="img" aria-label="Monthly promotion trend chart">
            <g class="promotion-chart-grid">
                <line x1="64" y1="58" x2="590" y2="58"></line>
                <line x1="64" y1="128" x2="590" y2="128"></line>
                <line x1="64" y1="198" x2="590" y2="198"></line>
                <line x1="64" y1="268" x2="590" y2="268"></line>
                <line x1="64" y1="338" x2="590" y2="338"></line>
            </g>
            <g class="promotion-chart-axis">
                <line x1="64" y1="58" x2="64" y2="338"></line>
                <line x1="64" y1="338" x2="590" y2="338"></line>
            </g>
            <g class="promotion-chart-scale">
                <text x="36" y="63">4</text>
                <text x="36" y="133">3</text>
                <text x="36" y="203">2</text>
                <text x="36" y="273">1</text>
                <text x="36" y="343">0</text>
            </g>
            <path class="promotion-month-line" d="M64 338 C94 240 124 92 170 58 C214 118 230 220 276 268 C318 272 338 210 380 198 C424 210 452 300 486 338 L590 338"></path>
            <g>
                <circle class="promotion-month-point" cx="64" cy="338" r="7" data-chart-title="January" data-chart-value="0 approved promotions"></circle>
                <circle class="promotion-month-point" cx="170" cy="58" r="7" data-chart-title="February" data-chart-value="4 approved promotions"></circle>
                <circle class="promotion-month-point" cx="276" cy="268" r="7" data-chart-title="March" data-chart-value="1 approved promotion"></circle>
                <circle class="promotion-month-point" cx="380" cy="198" r="7" data-chart-title="April" data-chart-value="2 approved promotions"></circle>
                <circle class="promotion-month-point" cx="486" cy="338" r="7" data-chart-title="May" data-chart-value="0 approved promotions"></circle>
                <circle class="promotion-month-point" cx="590" cy="338" r="7" data-chart-title="June" data-chart-value="0 approved promotions"></circle>
            </g>
            <g class="promotion-chart-labels">
                <text x="64" y="364" text-anchor="middle">Jan</text>
                <text x="170" y="364" text-anchor="middle">Feb</text>
                <text x="276" y="364" text-anchor="middle">Mar</text>
                <text x="380" y="364" text-anchor="middle">Apr</text>
                <text x="486" y="364" text-anchor="middle">May</text>
                <text x="590" y="364" text-anchor="middle">Jun</text>
            </g>
        </svg>

        <div class="promotion-chart-legend">
            <i class="green-outline"></i>
            <span>Approved Promotions</span>
        </div>
    </section>

    <section class="promotion-chart-panel">
        <div class="promotion-chart-header">
            <h2>Eligibility Breakdown</h2>
            <p>Radial view of employee eligibility review categories.</p>
        </div>

        <svg class="promotion-chart-svg" viewBox="0 0 620 370" role="img" aria-label="Eligibility breakdown radial chart">
            <g transform="translate(310 182)">
                <circle class="promotion-radial-ring" r="58"></circle>
                <circle class="promotion-radial-ring" r="104"></circle>
                <circle class="promotion-radial-ring" r="150"></circle>
                <line class="promotion-radial-axis" x1="0" y1="-150" x2="0" y2="150"></line>
                <line class="promotion-radial-axis" x1="-150" y1="0" x2="150" y2="0"></line>
                <text class="promotion-radial-label" x="-4" y="-150" text-anchor="middle">4</text>
                <text class="promotion-radial-label" x="-4" y="-104" text-anchor="middle">3</text>
                <text class="promotion-radial-label" x="-4" y="-58" text-anchor="middle">2</text>
                <text class="promotion-radial-label" x="-4" y="-18" text-anchor="middle">1</text>
                <path class="promotion-radial-slice" d="M0 0 L0 -104 A104 104 0 0 1 104 0 Z" fill="#7167e8" data-chart-title="Eligible Now" data-chart-value="3 employees"></path>
                <path class="promotion-radial-slice" d="M0 0 L104 0 A104 104 0 0 1 0 104 Z" fill="#38bdf8" data-chart-title="Under Review" data-chart-value="3 employees"></path>
                <path class="promotion-radial-slice" d="M0 0 L0 150 A150 150 0 0 1 -150 0 Z" fill="#fbbf24" data-chart-title="Nearing Eligibility" data-chart-value="4 employees"></path>
                <path class="promotion-radial-slice" d="M0 0 L-74 0 A74 74 0 0 1 0 -74 Z" fill="#f87171" data-chart-title="Deferred" data-chart-value="2 employees"></path>
            </g>
        </svg>

        <div class="promotion-chart-legend wrap">
            <i class="eligible"></i>
            <span>Eligible Now</span>
            <i class="review"></i>
            <span>Under Review</span>
            <i class="nearing"></i>
            <span>Nearing Eligibility</span>
            <i class="deferred"></i>
            <span>Deferred</span>
        </div>
    </section>
</div>

<div class="promotion-activity-grid">
    <section class="promotion-activity-panel">
        <div class="promotion-activity-header">
            <h2>Recent Promotion Activity</h2>
            <p>Latest promotion decisions and review updates.</p>
        </div>

        <div class="promotion-activity-list">
            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Amina Yusuf</h3>
                        <p>Human Resource · Idaacada Branch</p>
                    </div>
                    <span class="promotion-pill pending">Pending</span>
                </div>
                <div class="promotion-activity-role">Talent Officer <span>→</span> HR Business Partner</div>
                <p>Requested 2026-05-12 · Rule: Leadership Readiness</p>
            </article>

            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Mustafe Cabdi</h3>
                        <p>Information Technology · Idaacada Branch</p>
                    </div>
                    <span class="promotion-pill pending">Pending</span>
                </div>
                <div class="promotion-activity-role">Support Engineer <span>→</span> Systems Analyst</div>
                <p>Requested 2026-05-19 · Rule: Technical Competency</p>
            </article>

            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Fadumo Xasan</h3>
                        <p>Finance · Idaacada Branch</p>
                    </div>
                    <span class="employee-status active">Approved</span>
                </div>
                <div class="promotion-activity-role">Officer II <span>→</span> Lead Officer</div>
                <p>Approved 2026-04-28 · Rule: Service Tenure</p>
            </article>
        </div>
    </section>

    <section class="promotion-activity-panel">
        <div class="promotion-activity-header">
            <h2>Employees Nearing Eligibility</h2>
            <p>Employees approaching the next review window or required milestone.</p>
        </div>

        <div class="promotion-activity-list">
            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Amina Yusuf</h3>
                        <p>Human Resource</p>
                    </div>
                    <span class="promotion-pill percent">89%</span>
                </div>
                <span class="promotion-activity-kicker">Next Review Window</span>
                <div class="promotion-activity-role">2026-06-10</div>
            </article>

            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Nimco Abdi</h3>
                        <p>Operations</p>
                    </div>
                    <span class="promotion-pill percent">87%</span>
                </div>
                <span class="promotion-activity-kicker">Next Review Window</span>
                <div class="promotion-activity-role">2026-06-14</div>
            </article>

            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Ilwad Noor</h3>
                        <p>Information Technology</p>
                    </div>
                    <span class="promotion-pill percent">90%</span>
                </div>
                <span class="promotion-activity-kicker">Next Review Window</span>
                <div class="promotion-activity-role">2026-06-18</div>
            </article>
        </div>
    </section>

    <section class="promotion-activity-panel">
        <div class="promotion-activity-header">
            <h2>Pending Approvals</h2>
            <p>Promotion requests currently waiting for final approval.</p>
        </div>

        <div class="promotion-activity-list">
            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Fadumo Xasan</h3>
                        <p>Finance · Idaacada Branch</p>
                    </div>
                    <span class="promotion-pill pending">Pending</span>
                </div>
                <div class="promotion-activity-role">Officer II <span>→</span> Lead Officer</div>
                <p>Awaiting decision before 2026-05-20</p>
            </article>

            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Mustafe Cabdi</h3>
                        <p>Information Technology · Idaacada Branch</p>
                    </div>
                    <span class="promotion-pill pending">Pending</span>
                </div>
                <div class="promotion-activity-role">Support Engineer <span>→</span> Systems Analyst</div>
                <p>Awaiting decision before 2026-05-28</p>
            </article>

            <article class="promotion-activity-card">
                <div class="promotion-activity-top">
                    <div>
                        <h3>Mahad Axmed</h3>
                        <p>Operations · Idaacada Branch</p>
                    </div>
                    <span class="promotion-pill pending">Pending</span>
                </div>
                <div class="promotion-activity-role">Supervisor <span>→</span> Operations Lead</div>
                <p>Awaiting final branch review.</p>
            </article>
        </div>
    </section>
</div>

<?php
include '../../includes/footer.php';
?>
