<?php
$pageTitle = "Recruitment Dashboard";
$activePage = "recruitment-dashboard";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_recruitment_store.php';
require_once __DIR__ . '/../../includes/recruitment_shared.php';

$stats = hrmRecruitmentStats();
$vacancies = hrmRecruitmentVacancies();
$applicants = hrmRecruitmentApplicants();

$applicantsByStatus = [
    'Pending' => 0,
    'Shortlisted' => 0,
    'Rejected' => 0,
    'Selected' => 0,
];

foreach ($applicants as $applicant) {
    $status = $applicant['status'] ?? 'Pending';
    if (isset($applicantsByStatus[$status])) {
        $applicantsByStatus[$status]++;
    }
}

$deptCounts = [];
foreach ($vacancies as $vacancy) {
    if (($vacancy['status'] ?? '') !== 'Open') {
        continue;
    }
    $dept = $vacancy['department'] ?? 'Other';
    $deptCounts[$dept] = ($deptCounts[$dept] ?? 0) + 1;
}

include '../../includes/header_sidebar.php';
recruitmentPageZoomStyles();
?>
<style>
    .recruitment-page-header { margin-bottom: 42px; }
    .recruitment-page-header h1 { color: var(--neutral-darkest); font-size: 2.2rem; line-height: 1.12; margin-bottom: 8px; }
    .recruitment-page-header p { color: #475569; font-size: 1.05rem; font-weight: 500; line-height: 1.45; max-width: 980px; }
    .recruitment-insights-grid { display: grid; grid-template-columns: repeat(4, minmax(220px, 1fr)); gap: 24px; }
    .recruitment-insights-grid .employee-insight-card { min-height: 200px; }
    .recruitment-insight-purple { background-color: #ddd6fe; }
    .recruitment-insight-purple .employee-insight-icon { background-color: rgba(79, 70, 229, 0.12); color: #4f46e5; }
    .recruitment-analytics-grid { display: grid; grid-template-columns: repeat(2, minmax(360px, 1fr)); gap: 24px; margin-top: 32px; }
    .recruitment-chart-panel { background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76)); border: 1px solid var(--neutral-border); border-radius: var(--radius-md); box-shadow: var(--shadow-md); padding: 28px; overflow: hidden; }
    .recruitment-chart-header h2 { color: var(--neutral-darkest); font-size: 1.28rem; margin-bottom: 6px; }
    .recruitment-chart-header p { color: var(--neutral-gray); font-size: 0.92rem; font-weight: 500; line-height: 1.38; margin-bottom: 18px; }
    .recruitment-chart-svg { display: block; width: 100%; height: auto; overflow: visible; }
    .recruitment-chart-grid line { stroke: rgba(203, 213, 225, 0.8); stroke-width: 1; }
    .recruitment-chart-axis line { stroke: rgba(148, 163, 184, 0.72); stroke-width: 1.2; }
    .recruitment-chart-scale text, .recruitment-chart-labels text { fill: #475569; font-size: 14px; font-weight: 700; }
    .recruitment-activity-grid { display: grid; grid-template-columns: repeat(2, minmax(360px, 1fr)); gap: 24px; margin-top: 32px; }
    .recruitment-activity-panel { background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76)); border: 1px solid var(--neutral-border); border-radius: var(--radius-md); box-shadow: var(--shadow-md); padding: 28px; }
    .recruitment-activity-panel h2 { color: var(--neutral-darkest); font-size: 1.28rem; margin-bottom: 6px; }
    .recruitment-activity-panel > p { color: var(--neutral-gray); font-size: 0.92rem; font-weight: 500; margin-bottom: 22px; }
    .recruitment-activity-card { border: 1px solid rgba(191, 219, 254, 0.9); border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.72)); padding: 18px; margin-bottom: 14px; }
    .recruitment-activity-card h3 { color: var(--neutral-dark); font-size: 1rem; margin-bottom: 6px; }
    .recruitment-activity-card p { color: var(--neutral-gray); font-size: 0.88rem; font-weight: 500; }
    .recruitment-pill { border-radius: var(--radius-full); display: inline-flex; align-items: center; justify-content: center; min-width: 72px; padding: 6px 10px; font-size: 0.72rem; font-weight: 900; }
    .recruitment-pill.open { background-color: var(--success-light); color: var(--success-hover); }
    .recruitment-pill.pending { background-color: var(--warning-light); color: var(--warning-hover); }
    .recruitment-pill.shortlisted { background-color: var(--secondary-light); color: #0284c7; }
    @media (max-width: 1180px) { .recruitment-insights-grid { grid-template-columns: repeat(2, minmax(240px, 1fr)); } .recruitment-analytics-grid, .recruitment-activity-grid { grid-template-columns: 1fr; } }
    @media (max-width: 768px) { .recruitment-insights-grid { grid-template-columns: 1fr; } }
</style>

<div class="recruitment-page-header">
    <h1>Recruitment & Selection Dashboard</h1>
    <p>Overview of open vacancies, applicant pipeline, shortlisting progress, and selected candidates across departments.</p>
</div>

<div class="recruitment-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Open Vacancies</h3>
            <strong><?php echo (int) $stats['open_vacancies']; ?> Positions</strong>
            <p>Active job openings currently accepting applications.</p>
        </div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">work</span></div>
    </div>
    <div class="employee-insight-card active">
        <div>
            <h3>Total Applicants</h3>
            <strong><?php echo (int) $stats['total_applicants']; ?> Applicants</strong>
            <p>All candidates registered in the recruitment pipeline.</p>
        </div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">groups</span></div>
    </div>
    <div class="employee-insight-card leave">
        <div>
            <h3>Shortlisted Candidates</h3>
            <strong><?php echo (int) $stats['shortlisted']; ?> Shortlisted</strong>
            <p>Applicants advanced to interview stage.</p>
        </div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">how_to_reg</span></div>
    </div>
    <div class="employee-insight-card recruitment-insight-purple">
        <div>
            <h3>Selected Candidates</h3>
            <strong><?php echo (int) $stats['selected']; ?> Selected</strong>
            <p>Candidates approved after interview and ready for onboarding.</p>
        </div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">verified</span></div>
    </div>
</div>

<div class="recruitment-analytics-grid">
    <section class="recruitment-chart-panel">
        <div class="recruitment-chart-header">
            <h2>Applicants by Status</h2>
            <p>Distribution of candidates across recruitment stages.</p>
        </div>
        <svg class="recruitment-chart-svg" viewBox="0 0 620 350" role="img" aria-label="Applicants by status chart">
            <g class="recruitment-chart-grid">
                <line x1="58" y1="52" x2="590" y2="52"></line>
                <line x1="58" y1="134" x2="590" y2="134"></line>
                <line x1="58" y1="216" x2="590" y2="216"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <g class="recruitment-chart-axis">
                <line x1="58" y1="52" x2="58" y2="298"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <?php
            $maxCount = max(1, max($applicantsByStatus));
            $bars = [
                ['label' => 'Pending', 'count' => $applicantsByStatus['Pending'], 'color' => '#f59e0b', 'x' => 88],
                ['label' => 'Shortlisted', 'count' => $applicantsByStatus['Shortlisted'], 'color' => '#0ea5e9', 'x' => 208],
                ['label' => 'Rejected', 'count' => $applicantsByStatus['Rejected'], 'color' => '#f87171', 'x' => 328],
                ['label' => 'Selected', 'count' => $applicantsByStatus['Selected'], 'color' => '#10b981', 'x' => 448],
            ];
            foreach ($bars as $bar):
                $height = (int) round(($bar['count'] / $maxCount) * 220);
                $y = 298 - $height;
            ?>
            <rect x="<?php echo $bar['x']; ?>" y="<?php echo $y; ?>" width="76" height="<?php echo max($height, 4); ?>" fill="<?php echo $bar['color']; ?>" rx="9" ry="9" data-chart-title="<?php echo htmlspecialchars($bar['label']); ?>" data-chart-value="<?php echo (int) $bar['count']; ?> <?php echo (int) $bar['count'] === 1 ? 'applicant' : 'applicants'; ?>"></rect>
            <?php endforeach; ?>
            <g class="recruitment-chart-labels">
                <text x="126" y="332" text-anchor="middle">Pending</text>
                <text x="246" y="332" text-anchor="middle">Shortlisted</text>
                <text x="366" y="332" text-anchor="middle">Rejected</text>
                <text x="486" y="332" text-anchor="middle">Selected</text>
            </g>
        </svg>
    </section>

    <section class="recruitment-chart-panel">
        <div class="recruitment-chart-header">
            <h2>Open Vacancies by Department</h2>
            <p>Active vacancy count grouped by department.</p>
        </div>
        <svg class="recruitment-chart-svg" viewBox="0 0 620 350" role="img" aria-label="Open vacancies by department chart">
            <g class="recruitment-chart-grid">
                <line x1="58" y1="52" x2="590" y2="52"></line>
                <line x1="58" y1="175" x2="590" y2="175"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <g class="recruitment-chart-axis">
                <line x1="58" y1="52" x2="58" y2="298"></line>
                <line x1="58" y1="298" x2="590" y2="298"></line>
            </g>
            <?php
            $deptList = array_slice($deptCounts, 0, 5, true);
            $deptMax = max(1, max($deptList ?: [1]));
            $colors = ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#8b5cf6'];
            $x = 78;
            $i = 0;
            foreach ($deptList as $dept => $count):
                $height = (int) round(($count / $deptMax) * 220);
                $y = 298 - $height;
                $shortLabel = strlen($dept) > 10 ? substr($dept, 0, 8) . '..' : $dept;
            ?>
            <rect x="<?php echo $x; ?>" y="<?php echo $y; ?>" width="76" height="<?php echo max($height, 4); ?>" fill="<?php echo $colors[$i % 5]; ?>" rx="9" ry="9" data-chart-title="<?php echo htmlspecialchars($dept); ?>" data-chart-value="<?php echo (int) $count; ?> open <?php echo (int) $count === 1 ? 'vacancy' : 'vacancies'; ?>"></rect>
            <text x="<?php echo $x + 38; ?>" y="332" text-anchor="middle" class="recruitment-chart-labels"><?php echo htmlspecialchars($shortLabel); ?></text>
            <?php
                $x += 100;
                $i++;
            endforeach;
            ?>
        </svg>
    </section>
</div>

<div class="recruitment-activity-grid">
    <section class="recruitment-activity-panel">
        <h2>Recent Open Vacancies</h2>
        <p>Latest job openings in the recruitment pipeline.</p>
        <?php
        $openVacancies = array_filter($vacancies, function ($v) { return ($v['status'] ?? '') === 'Open'; });
        $openVacancies = array_slice(array_reverse($openVacancies, true), 0, 4);
        foreach ($openVacancies as $vacancy):
        ?>
        <article class="recruitment-activity-card">
            <h3><?php echo htmlspecialchars($vacancy['job_title']); ?> <span class="recruitment-pill open">Open</span></h3>
            <p><?php echo htmlspecialchars($vacancy['department']); ?> · <?php echo (int) $vacancy['positions']; ?> position(s) · Deadline <?php echo htmlspecialchars($vacancy['deadline']); ?></p>
        </article>
        <?php endforeach; ?>
    </section>

    <section class="recruitment-activity-panel">
        <h2>Recent Applicants</h2>
        <p>Latest candidate registrations and their current status.</p>
        <?php
        $recentApplicants = array_slice(array_reverse($applicants, true), 0, 4);
        foreach ($recentApplicants as $applicant):
            $statusClass = hrmRecruitmentApplicantStatusClass($applicant['status'] ?? 'Pending');
        ?>
        <article class="recruitment-activity-card">
            <h3><?php echo htmlspecialchars($applicant['name']); ?> <span class="recruitment-pill <?php echo $statusClass; ?>"><?php echo htmlspecialchars($applicant['status']); ?></span></h3>
            <p><?php echo htmlspecialchars($applicant['applied_position']); ?> · <?php echo htmlspecialchars($applicant['email']); ?></p>
        </article>
        <?php endforeach; ?>
    </section>
</div>

<?php include '../../includes/footer.php'; ?>
