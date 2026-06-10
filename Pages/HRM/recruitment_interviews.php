<?php
$pageTitle = "Interviews";
$activePage = "recruitment-interviews";
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

        $action = $_POST['recruitment_action'] ?? '';

        if ($action === 'add_interview') {
            hrmRecruitmentAddInterview($_POST);
            header('Location: recruitment_interviews.php?saved=1');
            exit;
        }

        if ($action === 'edit_interview') {
            hrmRecruitmentUpdateInterview($_POST['interview_id'] ?? '', $_POST);
            header('Location: recruitment_interviews.php?updated=1');
            exit;
        }
    } catch (Throwable $exception) {
        $flashError = $exception->getMessage();
    }
}

if (isset($_GET['saved'])) $flashMessage = 'Interview result recorded successfully.';
if (isset($_GET['updated'])) $flashMessage = 'Interview record updated successfully.';

$interviews = hrmRecruitmentInterviewRecords();
$applicants = hrmRecruitmentApplicants();
$shortlisted = array_filter($applicants, function ($a) { return ($a['status'] ?? '') === 'Shortlisted'; });

$passedCount = count(array_filter($interviews, function ($i) { return ($i['result'] ?? '') === 'Passed'; }));
$failedCount = count($interviews) - $passedCount;

include '../../includes/header_sidebar.php';
?>
<style>
    body { zoom: 75%; }
    .recruitment-page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 28px; margin-bottom: 44px; }
    .recruitment-page-header h1 { color: var(--neutral-darkest); font-size: 2.2rem; line-height: 1.12; margin-bottom: 8px; }
    .recruitment-page-header p { color: #475569; font-size: 1.05rem; font-weight: 500; line-height: 1.45; max-width: 850px; }
    .recruitment-insights-grid { display: grid; grid-template-columns: repeat(3, minmax(260px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .recruitment-insights-grid .employee-insight-card { min-height: 200px; }
    .recruitment-table-section .employee-data-table { min-width: 1180px; }
    .recruitment-result { border-radius: var(--radius-full); display: inline-flex; align-items: center; justify-content: center; min-width: 72px; padding: 7px 10px; font-size: 0.72rem; font-weight: 900; }
    .recruitment-result.passed { background-color: var(--success-light); color: var(--success-hover); }
    .recruitment-result.failed { background-color: var(--danger-light); color: var(--danger-hover); }
    .employee-registration-message { border-radius: var(--radius-md); font-weight: 800; margin-bottom: 18px; padding: 14px 16px; }
    .employee-registration-message.success { background-color: var(--success-light); color: var(--success-hover); }
    .employee-registration-message.error { background-color: var(--danger-light); color: var(--danger-hover); }
    .recruitment-modal { position: fixed; inset: 0; z-index: 1400; display: none; align-items: center; justify-content: center; padding: 32px; }
    .recruitment-modal.open { display: flex; }
    .recruitment-modal-backdrop { position: absolute; inset: 0; background-color: rgba(15, 23, 42, 0.62); backdrop-filter: blur(6px); }
    .recruitment-modal-dialog { position: relative; z-index: 1; width: min(900px, 100%); max-height: min(820px, calc(100vh - 64px)); display: flex; flex-direction: column; background: linear-gradient(135deg, rgba(240, 249, 255, 0.96), rgba(255, 255, 255, 0.96) 48%, rgba(255, 241, 247, 0.94)); border: 1px solid var(--neutral-border); border-radius: var(--radius-lg); box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24); overflow: hidden; }
    .recruitment-modal-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 24px; padding: 32px 36px; border-bottom: 1px solid rgba(203, 213, 225, 0.75); }
    .recruitment-modal-header h2 { color: var(--neutral-darkest); font-size: 1.55rem; margin-bottom: 8px; }
    .recruitment-modal-header p { color: #64748b; font-size: 1.05rem; font-weight: 500; }
    .recruitment-modal-close { width: 58px; height: 58px; border: none; border-radius: var(--radius-md); background-color: var(--secondary-light); color: var(--neutral-darkest); display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    .recruitment-modal-close:hover { background-color: var(--secondary-color); color: var(--neutral-white); }
    .recruitment-modal-body { overflow: auto; padding: 36px; }
    .recruitment-form-grid { display: grid; grid-template-columns: repeat(2, minmax(240px, 1fr)); gap: 18px; }
    .recruitment-form-field { display: grid; gap: 8px; }
    .recruitment-form-field.full { grid-column: 1 / -1; }
    .recruitment-form-field label { color: #334155; font-size: 0.86rem; font-weight: 800; }
    .recruitment-form-field input, .recruitment-form-field select, .recruitment-form-field textarea { width: 100%; border: 1px solid var(--neutral-border); border-radius: var(--radius-sm); padding: 12px 14px; font: inherit; background-color: var(--neutral-white); }
    .recruitment-form-field textarea { min-height: 100px; resize: vertical; }
    .recruitment-form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; padding-top: 22px; border-top: 1px solid rgba(203, 213, 225, 0.7); }
    .recruitment-detail-grid { display: grid; grid-template-columns: repeat(2, minmax(240px, 1fr)); gap: 18px; }
    .recruitment-detail-card { border: 1px solid rgba(226, 232, 240, 0.72); border-radius: var(--radius-md); background-color: rgba(255, 255, 255, 0.72); padding: 22px; }
    .recruitment-detail-card span { color: #94a3b8; display: block; font-size: 0.78rem; font-weight: 900; letter-spacing: 0.04em; margin-bottom: 12px; text-transform: uppercase; }
    .recruitment-detail-card strong { color: var(--neutral-dark); display: block; font-size: 1.05rem; line-height: 1.3; }
    @media (max-width: 1180px) { .recruitment-page-header { flex-direction: column; } .recruitment-insights-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .recruitment-insights-grid, .recruitment-form-grid, .recruitment-detail-grid { grid-template-columns: 1fr; } .recruitment-modal { padding: 16px; } }
</style>

<?php recruitmentRenderMessage($flashMessage, 'success'); ?>
<?php recruitmentRenderMessage($flashError, 'error'); ?>

<div class="recruitment-page-header">
    <div>
        <h1>Interviews</h1>
        <p>Record interview results, scores, and comments for shortlisted candidates.</p>
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="openAddInterviewModal" <?php echo empty($shortlisted) ? 'disabled title="No shortlisted applicants"' : ''; ?>>
            <span class="material-symbols-rounded" style="font-size: 18px;">add</span>
            <span>Record Interview</span>
        </button>
    </div>
</div>

<div class="recruitment-insights-grid">
    <div class="employee-insight-card total">
        <div><h3>Total Interviews</h3><strong><?php echo count($interviews); ?></strong><p>All interview records in the system.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">event</span></div>
    </div>
    <div class="employee-insight-card active">
        <div><h3>Passed</h3><strong><?php echo $passedCount; ?></strong><p>Candidates who passed the interview.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">check_circle</span></div>
    </div>
    <div class="employee-insight-card least-performing">
        <div><h3>Failed</h3><strong><?php echo $failedCount; ?></strong><p>Candidates who did not pass.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">cancel</span></div>
    </div>
</div>

<section class="employee-records-section recruitment-table-section">
    <div class="employee-records-header">
        <div><h2>Interview Records</h2><p>Interview schedule, evaluation scores, comments, and final results.</p></div>
    </div>
    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Position</th>
                        <th>Interview Date</th>
                        <th>Score</th>
                        <th>Comment</th>
                        <th>Result</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($interviews as $interview):
                        $applicant = $applicants[$interview['applicant_id']] ?? null;
                        if (!$applicant) continue;
                    ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($applicant['name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($applicant['applied_position']); ?></td>
                        <td><?php echo htmlspecialchars($interview['interview_date']); ?></td>
                        <td><?php echo (int) $interview['score']; ?>/100</td>
                        <td><?php echo htmlspecialchars($interview['comment'] ?: '—'); ?></td>
                        <td><span class="recruitment-result <?php echo hrmRecruitmentInterviewResultClass($interview['result']); ?>"><?php echo htmlspecialchars($interview['result']); ?></span></td>
                        <td>
                            <div class="employee-row-actions">
                                <button type="button" data-interview-view
                                    data-name="<?php echo htmlspecialchars($applicant['name']); ?>"
                                    data-position="<?php echo htmlspecialchars($applicant['applied_position']); ?>"
                                    data-date="<?php echo htmlspecialchars($interview['interview_date']); ?>"
                                    data-score="<?php echo (int) $interview['score']; ?>"
                                    data-comment="<?php echo htmlspecialchars($interview['comment']); ?>"
                                    data-result="<?php echo htmlspecialchars($interview['result']); ?>">
                                    <span class="material-symbols-rounded">visibility</span>
                                </button>
                                <button type="button" data-interview-edit
                                    data-id="<?php echo htmlspecialchars($interview['id']); ?>"
                                    data-date="<?php echo htmlspecialchars($interview['interview_date']); ?>"
                                    data-score="<?php echo (int) $interview['score']; ?>"
                                    data-comment="<?php echo htmlspecialchars($interview['comment']); ?>"
                                    data-result="<?php echo htmlspecialchars($interview['result']); ?>">
                                    <span class="material-symbols-rounded">edit_square</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing 1-<?php echo count($interviews); ?> of <?php echo count($interviews); ?> records</span>
        </div>
    </div>
</section>

<div class="recruitment-modal" id="addInterviewModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2>Record Interview Result</h2><p>Enter interview evaluation for a shortlisted candidate.</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                <input type="hidden" name="recruitment_action" value="add_interview">
                <div class="recruitment-form-grid">
                    <div class="recruitment-form-field full"><label for="add_applicant_id">Applicant</label>
                        <select id="add_applicant_id" name="applicant_id" required>
                            <option value="">Select shortlisted applicant</option>
                            <?php foreach ($shortlisted as $applicant): ?>
                            <option value="<?php echo htmlspecialchars($applicant['id']); ?>"><?php echo htmlspecialchars($applicant['name']); ?> — <?php echo htmlspecialchars($applicant['applied_position']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="recruitment-form-field"><label for="add_interview_date">Interview Date</label><input type="date" id="add_interview_date" name="interview_date" required></div>
                    <div class="recruitment-form-field"><label for="add_score">Score (0-100)</label><input type="number" id="add_score" name="score" min="0" max="100" required></div>
                    <div class="recruitment-form-field"><label for="add_result">Result</label>
                        <select id="add_result" name="result" required>
                            <option value="Passed">Passed</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <div class="recruitment-form-field full"><label for="add_comment">Comment</label><textarea id="add_comment" name="comment" placeholder="Interview notes and feedback"></textarea></div>
                </div>
                <div class="recruitment-form-actions">
                    <button type="button" class="btn btn-secondary" data-recruitment-close>Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded" style="font-size:18px;">save</span><span>Save Result</span></button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="recruitment-modal" id="editInterviewModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2>Edit Interview Record</h2><p>Update interview evaluation details.</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                <input type="hidden" name="recruitment_action" value="edit_interview">
                <input type="hidden" name="interview_id" id="edit_interview_id">
                <div class="recruitment-form-grid">
                    <div class="recruitment-form-field"><label for="edit_interview_date">Interview Date</label><input type="date" id="edit_interview_date" name="interview_date" required></div>
                    <div class="recruitment-form-field"><label for="edit_score">Score (0-100)</label><input type="number" id="edit_score" name="score" min="0" max="100" required></div>
                    <div class="recruitment-form-field"><label for="edit_result">Result</label>
                        <select id="edit_result" name="result" required>
                            <option value="Passed">Passed</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <div class="recruitment-form-field full"><label for="edit_comment">Comment</label><textarea id="edit_comment" name="comment"></textarea></div>
                </div>
                <div class="recruitment-form-actions">
                    <button type="button" class="btn btn-secondary" data-recruitment-close>Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded" style="font-size:18px;">save</span><span>Update Record</span></button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="recruitment-modal" id="viewInterviewModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2 id="viewInterviewName">Interview Details</h2><p id="viewInterviewPosition">Position</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <div class="recruitment-detail-grid">
                <div class="recruitment-detail-card"><span>Interview Date</span><strong id="viewInterviewDate"></strong></div>
                <div class="recruitment-detail-card"><span>Score</span><strong id="viewInterviewScore"></strong></div>
                <div class="recruitment-detail-card"><span>Result</span><strong id="viewInterviewResult"></strong></div>
                <div class="recruitment-detail-card" style="grid-column:1/-1;"><span>Comment</span><strong id="viewInterviewComment"></strong></div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modals = document.querySelectorAll('.recruitment-modal');
    function openModal(modal) { if (modal) { modal.classList.add('open'); modal.setAttribute('aria-hidden', 'false'); document.body.classList.add('hrm-modal-open'); } }
    function closeModals() { modals.forEach(function (m) { m.classList.remove('open'); m.setAttribute('aria-hidden', 'true'); }); document.body.classList.remove('hrm-modal-open'); }
    var addBtn = document.getElementById('openAddInterviewModal');
    if (addBtn) addBtn.addEventListener('click', function () { openModal(document.getElementById('addInterviewModal')); });
    document.querySelectorAll('[data-recruitment-close]').forEach(function (el) { el.addEventListener('click', closeModals); });
    document.addEventListener('click', function (e) {
        var viewBtn = e.target.closest('[data-interview-view]');
        if (viewBtn) {
            document.getElementById('viewInterviewName').textContent = viewBtn.getAttribute('data-name');
            document.getElementById('viewInterviewPosition').textContent = viewBtn.getAttribute('data-position');
            document.getElementById('viewInterviewDate').textContent = viewBtn.getAttribute('data-date');
            document.getElementById('viewInterviewScore').textContent = viewBtn.getAttribute('data-score') + '/100';
            document.getElementById('viewInterviewResult').textContent = viewBtn.getAttribute('data-result');
            document.getElementById('viewInterviewComment').textContent = viewBtn.getAttribute('data-comment') || '—';
            openModal(document.getElementById('viewInterviewModal'));
        }
        var editBtn = e.target.closest('[data-interview-edit]');
        if (editBtn) {
            document.getElementById('edit_interview_id').value = editBtn.getAttribute('data-id');
            document.getElementById('edit_interview_date').value = editBtn.getAttribute('data-date');
            document.getElementById('edit_score').value = editBtn.getAttribute('data-score');
            document.getElementById('edit_comment').value = editBtn.getAttribute('data-comment');
            document.getElementById('edit_result').value = editBtn.getAttribute('data-result');
            openModal(document.getElementById('editInterviewModal'));
        }
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModals(); });
});
</script>

<?php include '../../includes/footer.php'; ?>
