<?php
$pageTitle = "Job Vacancies";
$activePage = "recruitment-vacancies";
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

        if ($action === 'add_vacancy') {
            hrmRecruitmentAddVacancy($_POST);
            header('Location: recruitment_vacancies.php?saved=1');
            exit;
        }

        if ($action === 'edit_vacancy') {
            hrmRecruitmentUpdateVacancy($_POST['vacancy_id'] ?? '', $_POST);
            header('Location: recruitment_vacancies.php?updated=1');
            exit;
        }

        if ($action === 'close_vacancy') {
            hrmRecruitmentCloseVacancy($_POST['vacancy_id'] ?? '');
            header('Location: recruitment_vacancies.php?closed=1');
            exit;
        }
    } catch (Throwable $exception) {
        $flashError = $exception->getMessage();
    }
}

if (isset($_GET['saved'])) {
    $flashMessage = 'Vacancy created successfully.';
}
if (isset($_GET['updated'])) {
    $flashMessage = 'Vacancy updated successfully.';
}
if (isset($_GET['closed'])) {
    $flashMessage = 'Vacancy closed successfully.';
}

$vacancies = hrmRecruitmentVacancies();
$openCount = count(array_filter($vacancies, function ($v) { return ($v['status'] ?? '') === 'Open'; }));
$closedCount = count($vacancies) - $openCount;
$departments = recruitmentDepartments();

include '../../includes/header_sidebar.php';
?>
<style>
    body { zoom: 75%; }
    .recruitment-page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 28px; margin-bottom: 44px; }
    .recruitment-page-header h1 { color: var(--neutral-darkest); font-size: 2.2rem; line-height: 1.12; margin-bottom: 8px; }
    .recruitment-page-header p { color: #475569; font-size: 1.05rem; font-weight: 500; line-height: 1.45; max-width: 850px; }
    .recruitment-insights-grid { display: grid; grid-template-columns: repeat(3, minmax(260px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .recruitment-insights-grid .employee-insight-card { min-height: 200px; }
    .recruitment-table-section { margin-top: 32px; }
    .recruitment-table-section .employee-data-table { min-width: 1180px; }
    .recruitment-status { border-radius: var(--radius-full); display: inline-flex; align-items: center; justify-content: center; min-width: 72px; padding: 7px 10px; font-size: 0.72rem; font-weight: 900; }
    .recruitment-status.open { background-color: var(--success-light); color: var(--success-hover); }
    .recruitment-status.closed { background-color: var(--danger-light); color: var(--danger-hover); }
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
    .recruitment-modal-close { width: 58px; height: 58px; border: none; border-radius: var(--radius-md); background-color: var(--secondary-light); color: var(--neutral-darkest); display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition-fast); }
    .recruitment-modal-close:hover { background-color: var(--secondary-color); color: var(--neutral-white); }
    .recruitment-modal-body { overflow: auto; padding: 36px; }
    .recruitment-form-grid { display: grid; grid-template-columns: repeat(2, minmax(240px, 1fr)); gap: 18px; }
    .recruitment-form-field { display: grid; gap: 8px; }
    .recruitment-form-field.full { grid-column: 1 / -1; }
    .recruitment-form-field label { color: #334155; font-size: 0.86rem; font-weight: 800; }
    .recruitment-form-field input, .recruitment-form-field select, .recruitment-form-field textarea { width: 100%; border: 1px solid var(--neutral-border); border-radius: var(--radius-sm); padding: 12px 14px; font: inherit; background-color: var(--neutral-white); }
    .recruitment-form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; padding-top: 22px; border-top: 1px solid rgba(203, 213, 225, 0.7); }
    .recruitment-detail-grid { display: grid; grid-template-columns: repeat(2, minmax(240px, 1fr)); gap: 18px; }
    .recruitment-detail-card { border: 1px solid rgba(226, 232, 240, 0.72); border-radius: var(--radius-md); background-color: rgba(255, 255, 255, 0.72); padding: 22px; }
    .recruitment-detail-card span { color: #94a3b8; display: block; font-size: 0.78rem; font-weight: 900; letter-spacing: 0.04em; margin-bottom: 12px; text-transform: uppercase; }
    .recruitment-detail-card strong { color: var(--neutral-dark); display: block; font-size: 1.05rem; line-height: 1.3; }
    @media (max-width: 1180px) { .recruitment-page-header { flex-direction: column; } .recruitment-insights-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .recruitment-insights-grid, .recruitment-form-grid, .recruitment-detail-grid { grid-template-columns: 1fr; } .recruitment-modal { padding: 16px; } .recruitment-modal-header, .recruitment-modal-body { padding: 22px; } }
</style>

<?php recruitmentRenderMessage($flashMessage, 'success'); ?>
<?php recruitmentRenderMessage($flashError, 'error'); ?>

<div class="recruitment-page-header">
    <div>
        <h1>Job Vacancies</h1>
        <p>Create and manage open positions, required qualifications, deadlines, and vacancy status.</p>
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="openAddVacancyModal">
            <span class="material-symbols-rounded" style="font-size: 18px;">add</span>
            <span>Add Vacancy</span>
        </button>
    </div>
</div>

<div class="recruitment-insights-grid">
    <div class="employee-insight-card total">
        <div><h3>Total Vacancies</h3><strong><?php echo count($vacancies); ?> Vacancies</strong><p>All job vacancies in the system.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">work</span></div>
    </div>
    <div class="employee-insight-card active">
        <div><h3>Open Vacancies</h3><strong><?php echo $openCount; ?> Open</strong><p>Positions currently accepting applications.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">door_open</span></div>
    </div>
    <div class="employee-insight-card least-performing">
        <div><h3>Closed Vacancies</h3><strong><?php echo $closedCount; ?> Closed</strong><p>Positions no longer accepting applications.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">door_front</span></div>
    </div>
</div>

<section class="employee-records-section recruitment-table-section">
    <div class="employee-records-header">
        <div><h2>Vacancy Register</h2><p>Job openings with department, qualification requirements, and application deadlines.</p></div>
    </div>
    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Department</th>
                        <th>Required Qualification</th>
                        <th>Positions</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacancies as $vacancy): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($vacancy['job_title']); ?></strong><br><small><?php echo htmlspecialchars($vacancy['id']); ?></small></td>
                        <td><?php echo htmlspecialchars($vacancy['department']); ?></td>
                        <td><?php echo htmlspecialchars($vacancy['qualification']); ?></td>
                        <td><?php echo (int) $vacancy['positions']; ?></td>
                        <td><?php echo htmlspecialchars($vacancy['deadline']); ?></td>
                        <td><span class="recruitment-status <?php echo hrmRecruitmentVacancyStatusClass($vacancy['status']); ?>"><?php echo htmlspecialchars($vacancy['status']); ?></span></td>
                        <td>
                            <div class="employee-row-actions">
                                <button type="button" aria-label="View vacancy" data-vacancy-view
                                    data-id="<?php echo htmlspecialchars($vacancy['id']); ?>"
                                    data-title="<?php echo htmlspecialchars($vacancy['job_title']); ?>"
                                    data-department="<?php echo htmlspecialchars($vacancy['department']); ?>"
                                    data-qualification="<?php echo htmlspecialchars($vacancy['qualification']); ?>"
                                    data-positions="<?php echo (int) $vacancy['positions']; ?>"
                                    data-deadline="<?php echo htmlspecialchars($vacancy['deadline']); ?>"
                                    data-status="<?php echo htmlspecialchars($vacancy['status']); ?>">
                                    <span class="material-symbols-rounded">visibility</span>
                                </button>
                                <button type="button" aria-label="Edit vacancy" data-vacancy-edit
                                    data-id="<?php echo htmlspecialchars($vacancy['id']); ?>"
                                    data-title="<?php echo htmlspecialchars($vacancy['job_title']); ?>"
                                    data-department="<?php echo htmlspecialchars($vacancy['department']); ?>"
                                    data-qualification="<?php echo htmlspecialchars($vacancy['qualification']); ?>"
                                    data-positions="<?php echo (int) $vacancy['positions']; ?>"
                                    data-deadline="<?php echo htmlspecialchars($vacancy['deadline']); ?>">
                                    <span class="material-symbols-rounded">edit_square</span>
                                </button>
                                <?php if (($vacancy['status'] ?? '') === 'Open'): ?>
                                <form method="post" style="display:inline;" onsubmit="return confirm('Close this vacancy?');">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                                    <input type="hidden" name="recruitment_action" value="close_vacancy">
                                    <input type="hidden" name="vacancy_id" value="<?php echo htmlspecialchars($vacancy['id']); ?>">
                                    <button type="submit" aria-label="Close vacancy"><span class="material-symbols-rounded">block</span></button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="employee-table-footer">
            <span>Showing 1-<?php echo count($vacancies); ?> of <?php echo count($vacancies); ?> records</span>
        </div>
    </div>
</section>

<div class="recruitment-modal" id="addVacancyModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2>Add Vacancy</h2><p>Create a new job vacancy and publish it to the recruitment pipeline.</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                <input type="hidden" name="recruitment_action" value="add_vacancy">
                <div class="recruitment-form-grid">
                    <div class="recruitment-form-field"><label for="add_job_title">Job Title</label><input type="text" id="add_job_title" name="job_title" required placeholder="e.g. Finance Analyst"></div>
                    <div class="recruitment-form-field"><label for="add_department">Department</label>
                        <select id="add_department" name="department" required>
                            <?php foreach ($departments as $dept): ?><option value="<?php echo htmlspecialchars($dept); ?>"><?php echo htmlspecialchars($dept); ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    <div class="recruitment-form-field full"><label for="add_qualification">Required Qualification</label><input type="text" id="add_qualification" name="qualification" required placeholder="e.g. Bachelor in Finance"></div>
                    <div class="recruitment-form-field"><label for="add_positions">Number of Positions</label><input type="number" id="add_positions" name="positions" min="1" value="1" required></div>
                    <div class="recruitment-form-field"><label for="add_deadline">Deadline</label><input type="date" id="add_deadline" name="deadline" required></div>
                </div>
                <div class="recruitment-form-actions">
                    <button type="button" class="btn btn-secondary" data-recruitment-close>Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded" style="font-size:18px;">save</span><span>Save Vacancy</span></button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="recruitment-modal" id="editVacancyModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2>Edit Vacancy</h2><p>Update vacancy details and requirements.</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <form method="post" id="editVacancyForm">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                <input type="hidden" name="recruitment_action" value="edit_vacancy">
                <input type="hidden" name="vacancy_id" id="edit_vacancy_id">
                <div class="recruitment-form-grid">
                    <div class="recruitment-form-field"><label for="edit_job_title">Job Title</label><input type="text" id="edit_job_title" name="job_title" required></div>
                    <div class="recruitment-form-field"><label for="edit_department">Department</label>
                        <select id="edit_department" name="department" required>
                            <?php foreach ($departments as $dept): ?><option value="<?php echo htmlspecialchars($dept); ?>"><?php echo htmlspecialchars($dept); ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    <div class="recruitment-form-field full"><label for="edit_qualification">Required Qualification</label><input type="text" id="edit_qualification" name="qualification" required></div>
                    <div class="recruitment-form-field"><label for="edit_positions">Number of Positions</label><input type="number" id="edit_positions" name="positions" min="1" required></div>
                    <div class="recruitment-form-field"><label for="edit_deadline">Deadline</label><input type="date" id="edit_deadline" name="deadline" required></div>
                </div>
                <div class="recruitment-form-actions">
                    <button type="button" class="btn btn-secondary" data-recruitment-close>Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded" style="font-size:18px;">save</span><span>Update Vacancy</span></button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="recruitment-modal" id="viewVacancyModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2 id="viewVacancyTitle">Vacancy Details</h2><p id="viewVacancySubtitle">Vacancy information</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <div class="recruitment-detail-grid">
                <div class="recruitment-detail-card"><span>Department</span><strong id="viewVacancyDepartment"></strong></div>
                <div class="recruitment-detail-card"><span>Positions</span><strong id="viewVacancyPositions"></strong></div>
                <div class="recruitment-detail-card"><span>Deadline</span><strong id="viewVacancyDeadline"></strong></div>
                <div class="recruitment-detail-card"><span>Status</span><strong id="viewVacancyStatus"></strong></div>
                <div class="recruitment-detail-card" style="grid-column:1/-1;"><span>Required Qualification</span><strong id="viewVacancyQualification"></strong></div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modals = document.querySelectorAll('.recruitment-modal');
    function openModal(modal) {
        if (!modal) return;
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }
    function closeModals() {
        modals.forEach(function (m) { m.classList.remove('open'); m.setAttribute('aria-hidden', 'true'); });
        document.body.classList.remove('hrm-modal-open');
    }
    document.getElementById('openAddVacancyModal').addEventListener('click', function () { openModal(document.getElementById('addVacancyModal')); });
    document.querySelectorAll('[data-recruitment-close]').forEach(function (el) { el.addEventListener('click', closeModals); });
    document.addEventListener('click', function (e) {
        var viewBtn = e.target.closest('[data-vacancy-view]');
        if (viewBtn) {
            document.getElementById('viewVacancyTitle').textContent = viewBtn.getAttribute('data-title');
            document.getElementById('viewVacancySubtitle').textContent = viewBtn.getAttribute('data-id');
            document.getElementById('viewVacancyDepartment').textContent = viewBtn.getAttribute('data-department');
            document.getElementById('viewVacancyPositions').textContent = viewBtn.getAttribute('data-positions');
            document.getElementById('viewVacancyDeadline').textContent = viewBtn.getAttribute('data-deadline');
            document.getElementById('viewVacancyStatus').textContent = viewBtn.getAttribute('data-status');
            document.getElementById('viewVacancyQualification').textContent = viewBtn.getAttribute('data-qualification');
            openModal(document.getElementById('viewVacancyModal'));
        }
        var editBtn = e.target.closest('[data-vacancy-edit]');
        if (editBtn) {
            document.getElementById('edit_vacancy_id').value = editBtn.getAttribute('data-id');
            document.getElementById('edit_job_title').value = editBtn.getAttribute('data-title');
            document.getElementById('edit_department').value = editBtn.getAttribute('data-department');
            document.getElementById('edit_qualification').value = editBtn.getAttribute('data-qualification');
            document.getElementById('edit_positions').value = editBtn.getAttribute('data-positions');
            document.getElementById('edit_deadline').value = editBtn.getAttribute('data-deadline');
            openModal(document.getElementById('editVacancyModal'));
        }
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModals(); });
});
</script>

<?php include '../../includes/footer.php'; ?>
