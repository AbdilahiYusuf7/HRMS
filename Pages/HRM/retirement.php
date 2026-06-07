<?php
$pageTitle = "Retirement";
$activePage = "retirement";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .retirement-header {
        margin-bottom: 42px;
    }

    .retirement-header h1 {
        color: var(--neutral-darkest);
        font-size: 2.2rem;
        line-height: 1.12;
        margin-bottom: 8px;
    }

    .retirement-header p {
        color: #475569;
        font-size: 1.05rem;
        font-weight: 500;
        line-height: 1.45;
        max-width: 1320px;
    }

    .retirement-insights-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(220px, 1fr));
        gap: 24px;
    }

    .retirement-insights-grid .employee-insight-card {
        min-height: 280px;
    }

    .retirement-insight-eligible {
        background-color: #d1fae5;
    }

    .retirement-insight-eligible .employee-insight-icon {
        background-color: rgba(16, 185, 129, 0.12);
        color: var(--success-hover);
    }

    .retirement-insight-five-months {
        background-color: #bae6fd;
    }

    .retirement-insight-five-months .employee-insight-icon {
        background-color: rgba(14, 165, 233, 0.12);
        color: #0284c7;
    }

    .retirement-insight-one-month {
        background-color: #fef3c7;
    }

    .retirement-insight-one-month .employee-insight-icon {
        background-color: rgba(245, 158, 11, 0.14);
        color: var(--warning-hover);
    }

    .retirement-dropdown-panel {
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        margin-top: 32px;
        overflow: hidden;
    }

    .retirement-dropdown-header {
        width: 100%;
        border: none;
        border-bottom: 1px solid rgba(203, 213, 225, 0.72);
        background: transparent;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 36px;
        text-align: left;
        cursor: pointer;
    }

    .retirement-dropdown-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.28rem;
        margin-bottom: 6px;
    }

    .retirement-dropdown-header p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.38;
    }

    .retirement-dropdown-meta {
        display: inline-flex;
        align-items: center;
        gap: 16px;
        flex: 0 0 auto;
    }

    .retirement-dropdown-count {
        border-radius: var(--radius-full);
        background-color: rgba(255, 255, 255, 0.9);
        color: #4f46e5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 150px;
        padding: 8px 18px;
        font-size: 0.92rem;
        font-weight: 900;
        box-shadow: var(--shadow-sm);
    }

    .retirement-dropdown-arrow {
        color: #64748b;
        font-size: 26px;
        transition: var(--transition-fast);
    }

    .retirement-dropdown-panel.collapsed .retirement-dropdown-arrow {
        transform: rotate(180deg);
    }

    .retirement-dropdown-body {
        display: grid;
        grid-template-columns: repeat(3, minmax(240px, 1fr));
        gap: 24px;
        padding: 32px 36px;
    }

    .retirement-dropdown-panel.collapsed .retirement-dropdown-body {
        display: none;
    }

    .retirement-upcoming-card {
        border: 1px solid rgba(191, 219, 254, 0.9);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.72), rgba(255, 241, 247, 0.72));
        min-height: 230px;
        padding: 24px;
    }

    .retirement-upcoming-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 28px;
    }

    .retirement-upcoming-top h3 {
        color: var(--neutral-dark);
        font-size: 1.12rem;
        line-height: 1.28;
        margin-bottom: 6px;
    }

    .retirement-upcoming-top p {
        color: #94a3b8;
        font-size: 0.92rem;
        font-weight: 600;
        line-height: 1.35;
    }

    .retirement-status-pill {
        border-radius: var(--radius-full);
        background-color: var(--success-light);
        color: var(--success-hover);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 128px;
        padding: 8px 14px;
        font-size: 0.82rem;
        font-weight: 900;
        line-height: 1.2;
        white-space: nowrap;
    }

    .retirement-upcoming-meta {
        display: grid;
        gap: 14px;
    }

    .retirement-upcoming-row {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 12px;
        align-items: start;
    }

    .retirement-upcoming-row span {
        color: #94a3b8;
        font-size: 1rem;
        font-weight: 600;
    }

    .retirement-upcoming-row strong {
        color: var(--neutral-dark);
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.32;
        text-align: right;
    }

    .retirement-approaching-section {
        margin-top: 42px;
    }

    .retirement-approaching-header {
        margin-bottom: 26px;
    }

    .retirement-approaching-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.34rem;
        letter-spacing: 0.01em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .retirement-approaching-header p {
        color: var(--neutral-gray);
        font-size: 1.02rem;
        font-weight: 500;
        line-height: 1.45;
    }

    .retirement-approaching-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(320px, 460px));
        gap: 28px;
    }

    .retirement-employee-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76));
        box-shadow: var(--shadow-md);
        min-height: 560px;
        overflow: hidden;
        padding: 36px;
    }

    .retirement-employee-top {
        display: grid;
        grid-template-columns: 92px 1fr 28px;
        gap: 28px;
        align-items: start;
        border-bottom: 1px solid rgba(226, 232, 240, 0.72);
        padding-bottom: 44px;
        margin-bottom: 34px;
    }

    .retirement-employee-photo {
        width: 92px;
        height: 92px;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        background-color: var(--secondary-light);
    }

    .retirement-employee-photo img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .retirement-employee-top h3 {
        color: var(--neutral-darkest);
        font-size: 2.08rem;
        line-height: 1.18;
        margin-bottom: 12px;
    }

    .retirement-employee-top p {
        color: #94a3b8;
        font-size: 1.06rem;
        font-weight: 600;
        line-height: 1.35;
    }

    .retirement-employee-menu {
        border: none;
        background: transparent;
        color: var(--primary-color);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        padding: 0;
    }

    .retirement-employee-menu .material-symbols-rounded {
        font-size: 28px;
    }

    .retirement-employee-meta {
        display: grid;
        gap: 24px;
        margin-bottom: 38px;
    }

    .retirement-employee-row {
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 14px;
        align-items: start;
    }

    .retirement-employee-row span {
        color: #94a3b8;
        font-size: 1.08rem;
        font-weight: 600;
    }

    .retirement-employee-row strong {
        color: var(--neutral-dark);
        font-size: 1.08rem;
        font-weight: 800;
        line-height: 1.32;
        text-align: right;
    }

    .retirement-employee-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
    }

    .retirement-employee-pill {
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 184px;
        padding: 10px 18px;
        font-size: 0.95rem;
        font-weight: 900;
        line-height: 1.2;
    }

    .retirement-employee-pill.window {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .retirement-employee-pill.remaining {
        background-color: rgba(241, 245, 249, 0.86);
        color: #64748b;
    }

    .retirement-register-section {
        margin-top: 42px;
    }

    .retirement-register-section .employee-records-header {
        align-items: flex-start;
    }

    .retirement-register-section .employee-records-header h2 {
        text-transform: uppercase;
    }

    .retirement-register-section .employee-data-table {
        min-width: 1180px;
    }

    .retirement-register-action {
        min-width: 86px;
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

    .retirement-register-action:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .retirement-register-action .material-symbols-rounded {
        font-size: 16px;
    }

    .retirement-detail-modal {
        position: fixed;
        inset: 0;
        z-index: 1400;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .retirement-detail-modal.open {
        display: flex;
    }

    .retirement-detail-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(6px);
    }

    .retirement-detail-dialog {
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

    .retirement-detail-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 32px 36px;
        border-bottom: 1px solid rgba(203, 213, 225, 0.75);
        flex: 0 0 auto;
    }

    .retirement-detail-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.55rem;
        margin-bottom: 8px;
    }

    .retirement-detail-header p {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
    }

    .retirement-detail-close {
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

    .retirement-detail-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .retirement-detail-body {
        overflow: auto;
        padding: 36px;
        flex: 1 1 auto;
        max-height: calc(min(820px, calc(100vh - 64px)) - 124px);
    }

    .retirement-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 20px;
    }

    .retirement-detail-card {
        border: 1px solid rgba(226, 232, 240, 0.72);
        border-radius: var(--radius-md);
        background-color: rgba(255, 255, 255, 0.72);
        padding: 22px;
        min-height: 104px;
    }

    .retirement-detail-card span {
        color: #94a3b8;
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    .retirement-detail-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.12rem;
        line-height: 1.3;
    }

    @media (max-width: 1180px) {
        .retirement-insights-grid {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .retirement-dropdown-body {
            grid-template-columns: repeat(2, minmax(240px, 1fr));
        }

        .retirement-approaching-grid {
            grid-template-columns: repeat(2, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .retirement-insights-grid {
            grid-template-columns: 1fr;
        }

        .retirement-dropdown-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 24px;
        }

        .retirement-dropdown-body {
            grid-template-columns: 1fr;
            padding: 24px;
        }

        .retirement-approaching-grid {
            grid-template-columns: 1fr;
        }

        .retirement-employee-card {
            min-height: auto;
            padding: 24px;
        }

        .retirement-employee-top {
            grid-template-columns: 72px 1fr 24px;
            gap: 18px;
            padding-bottom: 30px;
        }

        .retirement-employee-photo {
            width: 72px;
            height: 72px;
        }

        .retirement-employee-top h3 {
            font-size: 1.55rem;
        }

        .retirement-employee-row {
            grid-template-columns: 1fr;
            gap: 6px;
        }

        .retirement-employee-row strong {
            text-align: left;
        }

        .retirement-detail-modal {
            padding: 16px;
        }

        .retirement-detail-header,
        .retirement-detail-body {
            padding: 22px;
        }

        .retirement-detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="retirement-header">
    <h1>Retirement</h1>
    <p>Monitor retirement readiness, upcoming retirement dates, and employees currently moving through retirement tracking.</p>
</div>

<div class="retirement-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Employees Tracked</h3>
            <strong>10 Employees</strong>
            <p>Employees currently included in the retirement tracking register.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">groups</span>
        </div>
    </div>

    <div class="employee-insight-card retirement-insight-eligible">
        <div>
            <h3>Eligible Now</h3>
            <strong>3 Employees</strong>
            <p>Employees reaching retirement during the current month.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">person_check</span>
        </div>
    </div>

    <div class="employee-insight-card retirement-insight-five-months">
        <div>
            <h3>Within 5 Months</h3>
            <strong>9 Employees</strong>
            <p>Employees retiring within the next five months from today.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">hourglass_top</span>
        </div>
    </div>

    <div class="employee-insight-card retirement-insight-one-month">
        <div>
            <h3>Within 1 Month</h3>
            <strong>5 Employees</strong>
            <p>Employees retiring within the next 30 days.</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">calendar_month</span>
        </div>
    </div>
</div>

<section class="retirement-dropdown-panel" data-retirement-dropdown>
    <button type="button" class="retirement-dropdown-header" data-retirement-dropdown-toggle aria-expanded="true">
        <div>
            <h2>Upcoming Retirements This Month</h2>
            <p>Employees whose retirement dates fall within April 2026.</p>
        </div>
        <div class="retirement-dropdown-meta">
            <span class="retirement-dropdown-count">3 Employees</span>
            <span class="material-symbols-rounded retirement-dropdown-arrow">expand_less</span>
        </div>
    </button>

    <div class="retirement-dropdown-body">
        <article class="retirement-upcoming-card">
            <div class="retirement-upcoming-top">
                <div>
                    <h3>Mohamed Nuur</h3>
                    <p>IT Administrator</p>
                </div>
                <span class="retirement-status-pill">Eligible Now</span>
            </div>
            <div class="retirement-upcoming-meta">
                <div class="retirement-upcoming-row"><span>Department</span><strong>Information Technology</strong></div>
                <div class="retirement-upcoming-row"><span>Retirement Date</span><strong>2026-04-28</strong></div>
                <div class="retirement-upcoming-row"><span>Remaining</span><strong>2 days left</strong></div>
            </div>
        </article>

        <article class="retirement-upcoming-card">
            <div class="retirement-upcoming-top">
                <div>
                    <h3>Hodan Maxamed</h3>
                    <p>Senior Accountant</p>
                </div>
                <span class="retirement-status-pill">Eligible Now</span>
            </div>
            <div class="retirement-upcoming-meta">
                <div class="retirement-upcoming-row"><span>Department</span><strong>Finance</strong></div>
                <div class="retirement-upcoming-row"><span>Retirement Date</span><strong>2026-04-29</strong></div>
                <div class="retirement-upcoming-row"><span>Remaining</span><strong>3 days left</strong></div>
            </div>
        </article>

        <article class="retirement-upcoming-card">
            <div class="retirement-upcoming-top">
                <div>
                    <h3>Fadumo Cabdi</h3>
                    <p>HR Business Partner</p>
                </div>
                <span class="retirement-status-pill">Eligible Now</span>
            </div>
            <div class="retirement-upcoming-meta">
                <div class="retirement-upcoming-row"><span>Department</span><strong>Human Resource</strong></div>
                <div class="retirement-upcoming-row"><span>Retirement Date</span><strong>2026-04-30</strong></div>
                <div class="retirement-upcoming-row"><span>Remaining</span><strong>4 days left</strong></div>
            </div>
        </article>
    </div>
</section>

<section class="retirement-approaching-section">
    <div class="retirement-approaching-header">
        <h2>Employees Approaching Retirement</h2>
        <p>Monitor employees in retirement assessment sequence over the next 3 months.</p>
    </div>

    <div class="retirement-approaching-grid">
        <article class="retirement-employee-card">
            <div class="retirement-employee-top">
                <div class="retirement-employee-photo">
                    <img src="<?php echo $assetPath; ?>/images/login-bg.png" alt="Ayan Cali profile photo">
                </div>
                <div>
                    <h3>Ayan Cali</h3>
                    <p>Senior Marketing Officer</p>
                </div>
                <button type="button" class="retirement-employee-menu" aria-label="Ayan Cali retirement options">
                    <span class="material-symbols-rounded">more_vert</span>
                </button>
            </div>

            <div class="retirement-employee-meta">
                <div class="retirement-employee-row"><span>Department</span><strong>Marketing</strong></div>
                <div class="retirement-employee-row"><span>Location</span><strong>Calaamada Branch</strong></div>
            </div>

            <div class="retirement-employee-pills">
                <span class="retirement-employee-pill window">Within 5 Months</span>
                <span class="retirement-employee-pill remaining">1.8 months left</span>
            </div>
        </article>

        <article class="retirement-employee-card">
            <div class="retirement-employee-top">
                <div class="retirement-employee-photo">
                    <img src="<?php echo $assetPath; ?>/images/login-bg.png" alt="Maxamed Faarax profile photo">
                </div>
                <div>
                    <h3>Maxamed Faarax</h3>
                    <p>Procurement Specialist</p>
                </div>
                <button type="button" class="retirement-employee-menu" aria-label="Maxamed Faarax retirement options">
                    <span class="material-symbols-rounded">more_vert</span>
                </button>
            </div>

            <div class="retirement-employee-meta">
                <div class="retirement-employee-row"><span>Department</span><strong>Administration</strong></div>
                <div class="retirement-employee-row"><span>Location</span><strong>Masalaha Branch</strong></div>
            </div>

            <div class="retirement-employee-pills">
                <span class="retirement-employee-pill window">Within 5 Months</span>
                <span class="retirement-employee-pill remaining">2.5 months left</span>
            </div>
        </article>
    </div>
</section>

<section class="employee-records-section retirement-register-section">
    <div class="employee-records-header">
        <div>
            <h2>Retirement Register</h2>
            <p>Detailed list of employee retirement assessment data.</p>
        </div>
    </div>

    <div class="employee-table-panel" data-retirement-register-table>
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button" data-retirement-sort-key="employee">Employee <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-retirement-sort-key="department">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-retirement-sort-key="location">Location <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-retirement-sort-key="age">Age <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-retirement-sort-key="date">Retirement Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-retirement-sort-key="remaining">Remaining <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-retirement-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-employee="Mohamed Nuur" data-number="EMP-0011" data-role="IT Administrator" data-department="Information Technology" data-location="Jigjiga Yar Branch" data-age="59" data-date="2026-04-28" data-remaining="2" data-remaining-label="2 days left" data-status="Eligible Now">
                        <td><div class="employee-table-name"><span class="employee-avatar">MN</span><div><strong>Mohamed Nuur</strong><span>EMP-0011 · IT Administrator</span></div></div></td>
                        <td>Information Technology</td>
                        <td>Jigjiga Yar Branch</td>
                        <td>59</td>
                        <td>2026-04-28</td>
                        <td>2 days left</td>
                        <td><span class="employee-status active">Eligible Now</span></td>
                        <td><button type="button" class="retirement-register-action" data-retirement-register-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Hodan Maxamed" data-number="EMP-0012" data-role="Senior Accountant" data-department="Finance" data-location="Xero Awr Branch" data-age="60" data-date="2026-04-29" data-remaining="3" data-remaining-label="3 days left" data-status="Eligible Now">
                        <td><div class="employee-table-name"><span class="employee-avatar">HM</span><div><strong>Hodan Maxamed</strong><span>EMP-0012 · Senior Accountant</span></div></div></td>
                        <td>Finance</td>
                        <td>Xero Awr Branch</td>
                        <td>60</td>
                        <td>2026-04-29</td>
                        <td>3 days left</td>
                        <td><span class="employee-status active">Eligible Now</span></td>
                        <td><button type="button" class="retirement-register-action" data-retirement-register-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Fadumo Cabdi" data-number="EMP-0013" data-role="HR Business Partner" data-department="Human Resource" data-location="Idaacada Branch" data-age="60" data-date="2026-04-30" data-remaining="4" data-remaining-label="4 days left" data-status="Eligible Now">
                        <td><div class="employee-table-name"><span class="employee-avatar">FC</span><div><strong>Fadumo Cabdi</strong><span>EMP-0013 · HR Business Partner</span></div></div></td>
                        <td>Human Resource</td>
                        <td>Idaacada Branch</td>
                        <td>60</td>
                        <td>2026-04-30</td>
                        <td>4 days left</td>
                        <td><span class="employee-status active">Eligible Now</span></td>
                        <td><button type="button" class="retirement-register-action" data-retirement-register-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Ayan Cali" data-number="EMP-0014" data-role="Senior Marketing Officer" data-department="Marketing" data-location="Calaamada Branch" data-age="58" data-date="2026-07-18" data-remaining="54" data-remaining-label="1.8 months left" data-status="Within 5 Months">
                        <td><div class="employee-table-name"><span class="employee-avatar">AC</span><div><strong>Ayan Cali</strong><span>EMP-0014 · Senior Marketing Officer</span></div></div></td>
                        <td>Marketing</td>
                        <td>Calaamada Branch</td>
                        <td>58</td>
                        <td>2026-07-18</td>
                        <td>1.8 months left</td>
                        <td><span class="employee-status late">Within 5 Months</span></td>
                        <td><button type="button" class="retirement-register-action" data-retirement-register-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                    <tr data-employee="Maxamed Faarax" data-number="EMP-0015" data-role="Procurement Specialist" data-department="Administration" data-location="Masalaha Branch" data-age="59" data-date="2026-08-10" data-remaining="75" data-remaining-label="2.5 months left" data-status="Within 5 Months">
                        <td><div class="employee-table-name"><span class="employee-avatar">MF</span><div><strong>Maxamed Faarax</strong><span>EMP-0015 · Procurement Specialist</span></div></div></td>
                        <td>Administration</td>
                        <td>Masalaha Branch</td>
                        <td>59</td>
                        <td>2026-08-10</td>
                        <td>2.5 months left</td>
                        <td><span class="employee-status late">Within 5 Months</span></td>
                        <td><button type="button" class="retirement-register-action" data-retirement-register-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="employee-table-footer">
            <span data-retirement-register-summary>Showing 1-4 of 5 records</span>
            <div class="employee-pagination" data-retirement-register-pagination></div>
        </div>
    </div>
</section>

<div class="retirement-detail-modal" id="retirementTrackingDetailModal" aria-hidden="true">
    <div class="retirement-detail-backdrop" data-retirement-detail-close></div>
    <section class="retirement-detail-dialog" role="dialog" aria-modal="true" aria-labelledby="retirementTrackingDetailTitle">
        <div class="retirement-detail-header">
            <div>
                <h2 id="retirementTrackingDetailTitle">Retirement Tracking</h2>
                <p>Retirement tracking detail</p>
            </div>
            <button type="button" class="retirement-detail-close" data-retirement-detail-close aria-label="Close retirement tracking detail">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="retirement-detail-body">
            <div class="retirement-detail-grid">
                <article class="retirement-detail-card">
                    <span>Employee ID</span>
                    <strong data-retirement-detail-number></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Role</span>
                    <strong data-retirement-detail-role></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Department</span>
                    <strong data-retirement-detail-department></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Location</span>
                    <strong data-retirement-detail-location></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Age</span>
                    <strong data-retirement-detail-age></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Retirement Date</span>
                    <strong data-retirement-detail-date></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Remaining</span>
                    <strong data-retirement-detail-remaining></strong>
                </article>
                <article class="retirement-detail-card">
                    <span>Status</span>
                    <strong data-retirement-detail-status></strong>
                </article>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var panel = document.querySelector('[data-retirement-dropdown]');
    var toggle = document.querySelector('[data-retirement-dropdown-toggle]');

    if (!panel || !toggle) return;

    toggle.addEventListener('click', function () {
        var collapsed = panel.classList.toggle('collapsed');
        toggle.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var panel = document.querySelector('[data-retirement-register-table]');
    if (!panel) return;

    var table = panel.querySelector('.employee-data-table');
    var tbody = table ? table.querySelector('tbody') : null;
    var summary = panel.querySelector('[data-retirement-register-summary]');
    var pagination = panel.querySelector('[data-retirement-register-pagination]');
    var detailModal = document.getElementById('retirementTrackingDetailModal');
    var detailTitle = document.getElementById('retirementTrackingDetailTitle');

    if (!table || !tbody || !summary || !pagination) return;

    var pageSize = 4;
    var allRows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
    var currentPage = 1;
    var sortKey = '';
    var sortDirection = 'asc';

    function getRowValue(row, key) {
        return (row.dataset[key] || '').trim();
    }

    function setDetailValue(selector, value) {
        var field = detailModal ? detailModal.querySelector(selector) : null;
        if (field) {
            field.textContent = value || 'Not set';
        }
    }

    function openRetirementDetail(row) {
        if (!detailModal || !row) return;

        if (detailTitle) {
            detailTitle.textContent = getRowValue(row, 'employee');
        }

        setDetailValue('[data-retirement-detail-number]', getRowValue(row, 'number'));
        setDetailValue('[data-retirement-detail-role]', getRowValue(row, 'role'));
        setDetailValue('[data-retirement-detail-department]', getRowValue(row, 'department'));
        setDetailValue('[data-retirement-detail-location]', getRowValue(row, 'location'));
        setDetailValue('[data-retirement-detail-age]', getRowValue(row, 'age'));
        setDetailValue('[data-retirement-detail-date]', getRowValue(row, 'date'));
        setDetailValue('[data-retirement-detail-remaining]', getRowValue(row, 'remainingLabel'));
        setDetailValue('[data-retirement-detail-status]', getRowValue(row, 'status'));

        detailModal.classList.add('open');
        detailModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeRetirementDetail() {
        if (!detailModal) return;

        detailModal.classList.remove('open');
        detailModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function sortRows(rows) {
        if (!sortKey) return rows;

        return rows.slice().sort(function (a, b) {
            var aValue = getRowValue(a, sortKey);
            var bValue = getRowValue(b, sortKey);

            if (sortKey === 'age' || sortKey === 'remaining') {
                return sortDirection === 'asc'
                    ? Number(aValue) - Number(bValue)
                    : Number(bValue) - Number(aValue);
            }

            if (sortKey === 'date') {
                return sortDirection === 'asc'
                    ? new Date(aValue) - new Date(bValue)
                    : new Date(bValue) - new Date(aValue);
            }

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
        var sortedRows = sortRows(allRows);
        var totalPages = Math.max(1, Math.ceil(sortedRows.length / pageSize));

        if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        var start = (currentPage - 1) * pageSize;
        var pageRows = sortedRows.slice(start, start + pageSize);

        allRows.forEach(function (row) {
            row.style.display = 'none';
        });

        pageRows.forEach(function (row) {
            row.style.display = '';
            tbody.appendChild(row);
        });

        var from = sortedRows.length ? start + 1 : 0;
        var to = Math.min(start + pageSize, sortedRows.length);
        summary.textContent = 'Showing ' + from + '-' + to + ' of ' + sortedRows.length + ' records';
        renderPagination(totalPages);
    }

    table.querySelectorAll('[data-retirement-sort-key]').forEach(function (button) {
        button.addEventListener('click', function () {
            var nextSortKey = button.dataset.retirementSortKey;

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

    table.addEventListener('click', function (event) {
        var viewButton = event.target.closest('[data-retirement-register-view]');
        if (!viewButton) return;

        openRetirementDetail(viewButton.closest('tr'));
    });

    if (detailModal) {
        detailModal.querySelectorAll('[data-retirement-detail-close]').forEach(function (button) {
            button.addEventListener('click', closeRetirementDetail);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && detailModal.classList.contains('open')) {
                closeRetirementDetail();
            }
        });
    }

    render();
});
</script>

<?php include '../../includes/footer.php'; ?>
