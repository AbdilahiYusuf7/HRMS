<?php
$pageTitle = "Selected Candidates";
$activePage = "recruitment-selected";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_recruitment_store.php';
require_once __DIR__ . '/../../includes/recruitment_shared.php';

$flashMessage = '';
$flashError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!hrmRecruitmentVerifyCsrf($_POST['csrf_token'] ?? '')) {
            throw new RuntimeException('Security token expired. Please try again.');
        }

        if (($_POST['recruitment_action'] ?? '') === 'convert_employee') {
            $applicantId = hrmRecruitmentConvertToEmployee($_POST['applicant_id'] ?? '');
            $applicant = hrmRecruitmentFindApplicant($applicantId);
            header('Location: recruitment_selected.php?converted=1&name=' . rawurlencode($applicant['name']));
            exit;
        }
    } catch (Throwable $exception) {
        $flashError = $exception->getMessage();
    }
}

if (isset($_GET['converted'])) {
    $name = $_GET['name'] ?? 'Candidate';
    $flashMessage = htmlspecialchars($name) . ' has been successfully converted to employee. (Demo — no backend integration.)';
}

$selected = array_filter(hrmRecruitmentApplicants(), function ($a) {
    return ($a['status'] ?? '') === 'Selected';
});

include '../../includes/header_sidebar.php';
?>
<style>
    body { zoom: 75%; }
    .recruitment-page-header { margin-bottom: 42px; }
    .recruitment-page-header h1 { color: var(--neutral-darkest); font-size: 2.2rem; line-height: 1.12; margin-bottom: 8px; }
    .recruitment-page-header p { color: #475569; font-size: 1.05rem; font-weight: 500; line-height: 1.45; max-width: 980px; }
    .recruitment-insights-grid { display: grid; grid-template-columns: repeat(3, minmax(260px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .recruitment-insights-grid .employee-insight-card { min-height: 200px; }
    .recruitment-insight-purple { background-color: #ddd6fe; }
    .recruitment-insight-purple .employee-insight-icon { background-color: rgba(79, 70, 229, 0.12); color: #4f46e5; }
    .recruitment-table-section .employee-data-table { min-width: 1080px; }
    .recruitment-convert-btn { min-width: 160px; height: 38px; border: none; border-radius: var(--radius-sm); background-color: var(--primary-color); color: var(--neutral-white); display: inline-flex; align-items: center; justify-content: center; gap: 8px; font: inherit; font-size: 0.78rem; font-weight: 900; cursor: pointer; transition: var(--transition-fast); }
    .recruitment-convert-btn:hover { background-color: var(--primary-hover); }
    .recruitment-convert-btn .material-symbols-rounded { font-size: 16px; }
    .employee-registration-message { border-radius: var(--radius-md); font-weight: 800; margin-bottom: 18px; padding: 14px 16px; }
    .employee-registration-message.success { background-color: var(--success-light); color: var(--success-hover); }
    .employee-registration-message.error { background-color: var(--danger-light); color: var(--danger-hover); }
    .recruitment-workflow-panel { background: linear-gradient(135deg, rgba(224, 247, 255, 0.74), rgba(255, 255, 255, 0.94) 48%, rgba(255, 235, 244, 0.76)); border: 1px solid var(--neutral-border); border-radius: var(--radius-md); box-shadow: var(--shadow-md); padding: 28px; margin-bottom: 32px; }
    .recruitment-workflow-panel h2 { color: var(--neutral-darkest); font-size: 1.28rem; margin-bottom: 12px; }
    .recruitment-workflow-steps { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; color: #475569; font-size: 0.92rem; font-weight: 700; }
    .recruitment-workflow-steps span { background-color: var(--secondary-light); border-radius: var(--radius-full); padding: 8px 14px; }
    .recruitment-workflow-steps .material-symbols-rounded { font-size: 18px; vertical-align: middle; color: var(--secondary-color); }
    @media (max-width: 1180px) { .recruitment-insights-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .recruitment-insights-grid { grid-template-columns: 1fr; } }
</style>

<?php if ($flashMessage): ?>
<div class="employee-registration-message success"><?php echo $flashMessage; ?></div>
<?php endif; ?>
<?php recruitmentRenderMessage($flashError, 'error'); ?>

<div class="recruitment-page-header">
    <h1>Selected Candidates</h1>
    <p>Candidates approved after interview. Convert selected candidates to employees to complete the recruitment workflow.</p>
</div>

<section class="recruitment-workflow-panel">
    <h2>Recruitment Workflow</h2>
    <div class="recruitment-workflow-steps">
        <span>Create Vacancy</span>
        <span class="material-symbols-rounded">arrow_forward</span>
        <span>Add Applicants</span>
        <span class="material-symbols-rounded">arrow_forward</span>
        <span>Shortlist Applicant</span>
        <span class="material-symbols-rounded">arrow_forward</span>
        <span>Record Interview</span>
        <span class="material-symbols-rounded">arrow_forward</span>
        <span>Select Candidate</span>
        <span class="material-symbols-rounded">arrow_forward</span>
        <span>Convert to Employee</span>
    </div>
</section>

<div class="recruitment-insights-grid">
    <div class="employee-insight-card recruitment-insight-purple">
        <div><h3>Selected Candidates</h3><strong><?php echo count($selected); ?></strong><p>Ready for employee onboarding.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">verified</span></div>
    </div>
    <div class="employee-insight-card active">
        <div><h3>Departments</h3><strong><?php
            $depts = array_unique(array_map(function ($a) { return $a['applied_position']; }, $selected));
            echo count($depts);
        ?></strong><p>Distinct positions filled from selection.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">domain</span></div>
    </div>
    <div class="employee-insight-card total">
        <div><h3>Onboarding Queue</h3><strong><?php echo count($selected); ?> Pending</strong><p>Awaiting conversion to employee records.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">badge</span></div>
    </div>
</div>

<section class="employee-records-section recruitment-table-section">
    <div class="employee-records-header">
        <div><h2>Selected Candidate List</h2><p>Approved candidates with option to convert to employee (demo success message).</p></div>
    </div>
    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($selected)): ?>
                    <tr><td colspan="6" style="text-align:center;color:#94a3b8;font-weight:700;padding:40px;">No selected candidates yet. Shortlist applicants, record interviews with Passed result to populate this list.</td></tr>
                    <?php else: ?>
                    <?php foreach ($selected as $candidate): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($candidate['name']); ?></strong><br><small><?php echo htmlspecialchars($candidate['id']); ?></small></td>
                        <td><?php echo htmlspecialchars($candidate['phone']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['email']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['applied_position']); ?></td>
                        <td><span class="employee-status active">Selected</span></td>
                        <td>
                            <form method="post" onsubmit="return confirm('Convert <?php echo htmlspecialchars($candidate['name']); ?> to employee?');">
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                                <input type="hidden" name="recruitment_action" value="convert_employee">
                                <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($candidate['id']); ?>">
                                <button type="submit" class="recruitment-convert-btn">
                                    <span class="material-symbols-rounded">person_add</span>
                                    <span>Convert to Employee</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing <?php echo count($selected); ?> selected candidate(s)</span>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
