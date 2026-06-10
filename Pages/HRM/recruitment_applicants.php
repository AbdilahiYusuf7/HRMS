<?php
$pageTitle = "Applicants";
$activePage = "recruitment-applicants";
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

        if ($action === 'add_applicant') {
            hrmRecruitmentAddApplicant($_POST);
            header('Location: recruitment_applicants.php?saved=1');
            exit;
        }

        if ($action === 'edit_applicant') {
            hrmRecruitmentUpdateApplicant($_POST['applicant_id'] ?? '', $_POST);
            header('Location: recruitment_applicants.php?updated=1');
            exit;
        }

        if ($action === 'shortlist_applicant') {
            hrmRecruitmentSetApplicantStatus($_POST['applicant_id'] ?? '', 'Shortlisted');
            header('Location: recruitment_applicants.php?shortlisted=1');
            exit;
        }

        if ($action === 'reject_applicant') {
            hrmRecruitmentSetApplicantStatus($_POST['applicant_id'] ?? '', 'Rejected');
            header('Location: recruitment_applicants.php?rejected=1');
            exit;
        }
    } catch (Throwable $exception) {
        $flashError = $exception->getMessage();
    }
}

if (isset($_GET['saved'])) $flashMessage = 'Applicant registered successfully.';
if (isset($_GET['updated'])) $flashMessage = 'Applicant updated successfully.';
if (isset($_GET['shortlisted'])) $flashMessage = 'Applicant shortlisted successfully.';
if (isset($_GET['rejected'])) $flashMessage = 'Applicant rejected successfully.';

$applicants = hrmRecruitmentApplicants();
$vacancies = array_filter(hrmRecruitmentVacancies(), function ($v) { return ($v['status'] ?? '') === 'Open'; });
$statusCounts = ['Pending' => 0, 'Shortlisted' => 0, 'Rejected' => 0, 'Selected' => 0];
foreach ($applicants as $a) {
    $s = $a['status'] ?? 'Pending';
    if (isset($statusCounts[$s])) $statusCounts[$s]++;
}

include '../../includes/header_sidebar.php';
?>
<style>
    body { zoom: 75%; }
    .recruitment-page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 28px; margin-bottom: 44px; }
    .recruitment-page-header h1 { color: var(--neutral-darkest); font-size: 2.2rem; line-height: 1.12; margin-bottom: 8px; }
    .recruitment-page-header p { color: #475569; font-size: 1.05rem; font-weight: 500; line-height: 1.45; max-width: 850px; }
    .recruitment-insights-grid { display: grid; grid-template-columns: repeat(4, minmax(220px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .recruitment-insights-grid .employee-insight-card { min-height: 200px; }
    .recruitment-table-section .employee-data-table { min-width: 1280px; }
    .recruitment-status { border-radius: var(--radius-full); display: inline-flex; align-items: center; justify-content: center; min-width: 88px; padding: 7px 10px; font-size: 0.72rem; font-weight: 900; }
    .recruitment-status.pending { background-color: var(--warning-light); color: var(--warning-hover); }
    .recruitment-status.shortlisted { background-color: var(--secondary-light); color: #0284c7; }
    .recruitment-status.rejected { background-color: var(--danger-light); color: var(--danger-hover); }
    .recruitment-status.selected { background-color: var(--success-light); color: var(--success-hover); }
    .recruitment-cv-link { color: var(--primary-color); font-weight: 800; text-decoration: none; }
    .recruitment-cv-link:hover { text-decoration: underline; }
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
    .recruitment-form-field input, .recruitment-form-field select { width: 100%; border: 1px solid var(--neutral-border); border-radius: var(--radius-sm); padding: 12px 14px; font: inherit; background-color: var(--neutral-white); }
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
        <h1>Applicants</h1>
        <p>Register candidates, review applications, shortlist for interview, or reject from the pipeline.</p>
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="openAddApplicantModal">
            <span class="material-symbols-rounded" style="font-size: 18px;">add</span>
            <span>Add Applicant</span>
        </button>
    </div>
</div>

<div class="recruitment-insights-grid">
    <div class="employee-insight-card total">
        <div><h3>Total Applicants</h3><strong><?php echo count($applicants); ?></strong><p>All registered candidates.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">groups</span></div>
    </div>
    <div class="employee-insight-card leave">
        <div><h3>Pending</h3><strong><?php echo $statusCounts['Pending']; ?></strong><p>Awaiting initial review.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">hourglass_top</span></div>
    </div>
    <div class="employee-insight-card active">
        <div><h3>Shortlisted</h3><strong><?php echo $statusCounts['Shortlisted']; ?></strong><p>Advanced to interview stage.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">how_to_reg</span></div>
    </div>
    <div class="employee-insight-card least-performing">
        <div><h3>Rejected</h3><strong><?php echo $statusCounts['Rejected']; ?></strong><p>Not proceeding in pipeline.</p></div>
        <div class="employee-insight-icon"><span class="material-symbols-rounded">cancel</span></div>
    </div>
</div>

<section class="employee-records-section recruitment-table-section">
    <div class="employee-records-header">
        <div><h2>Applicant Register</h2><p>Candidate applications with contact details, CV, and recruitment status.</p></div>
    </div>
    <div class="employee-table-panel">
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Applied Position</th>
                        <th>CV</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applicants as $applicant): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($applicant['name']); ?></strong><br><small><?php echo htmlspecialchars($applicant['id']); ?></small></td>
                        <td><?php echo htmlspecialchars($applicant['phone']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                        <td><?php echo htmlspecialchars($applicant['applied_position']); ?></td>
                        <td>
                            <?php if (!empty($applicant['cv_file'])): ?>
                                <a class="recruitment-cv-link" href="<?php echo htmlspecialchars($applicant['cv_file']); ?>" target="_blank" rel="noopener">View CV</a>
                            <?php else: ?>
                                <span style="color:#94a3b8;font-weight:600;">No file</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="recruitment-status <?php echo hrmRecruitmentApplicantStatusClass($applicant['status']); ?>"><?php echo htmlspecialchars($applicant['status']); ?></span></td>
                        <td>
                            <div class="employee-row-actions">
                                <button type="button" data-applicant-view
                                    data-id="<?php echo htmlspecialchars($applicant['id']); ?>"
                                    data-name="<?php echo htmlspecialchars($applicant['name']); ?>"
                                    data-phone="<?php echo htmlspecialchars($applicant['phone']); ?>"
                                    data-email="<?php echo htmlspecialchars($applicant['email']); ?>"
                                    data-position="<?php echo htmlspecialchars($applicant['applied_position']); ?>"
                                    data-status="<?php echo htmlspecialchars($applicant['status']); ?>"
                                    data-cv="<?php echo htmlspecialchars($applicant['cv_file'] ?? ''); ?>">
                                    <span class="material-symbols-rounded">visibility</span>
                                </button>
                                <button type="button" data-applicant-edit
                                    data-id="<?php echo htmlspecialchars($applicant['id']); ?>"
                                    data-name="<?php echo htmlspecialchars($applicant['name']); ?>"
                                    data-phone="<?php echo htmlspecialchars($applicant['phone']); ?>"
                                    data-email="<?php echo htmlspecialchars($applicant['email']); ?>"
                                    data-vacancy="<?php echo htmlspecialchars($applicant['vacancy_id']); ?>">
                                    <span class="material-symbols-rounded">edit_square</span>
                                </button>
                                <?php if (($applicant['status'] ?? '') === 'Pending'): ?>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                                    <input type="hidden" name="recruitment_action" value="shortlist_applicant">
                                    <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($applicant['id']); ?>">
                                    <button type="submit" aria-label="Shortlist applicant" title="Shortlist"><span class="material-symbols-rounded">thumb_up</span></button>
                                </form>
                                <form method="post" style="display:inline;" onsubmit="return confirm('Reject this applicant?');">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                                    <input type="hidden" name="recruitment_action" value="reject_applicant">
                                    <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($applicant['id']); ?>">
                                    <button type="submit" aria-label="Reject applicant" title="Reject"><span class="material-symbols-rounded">thumb_down</span></button>
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
            <span>Showing 1-<?php echo count($applicants); ?> of <?php echo count($applicants); ?> records</span>
        </div>
    </div>
</section>

<div class="recruitment-modal" id="addApplicantModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2>Add Applicant</h2><p>Register a new candidate for an open vacancy.</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                <input type="hidden" name="recruitment_action" value="add_applicant">
                <div class="recruitment-form-grid">
                    <div class="recruitment-form-field"><label for="add_name">Applicant Name</label><input type="text" id="add_name" name="name" required placeholder="Full name"></div>
                    <div class="recruitment-form-field"><label for="add_phone">Phone</label><input type="tel" id="add_phone" name="phone" required placeholder="+252 61 700 0000"></div>
                    <div class="recruitment-form-field"><label for="add_email">Email</label><input type="email" id="add_email" name="email" required placeholder="email@example.com"></div>
                    <div class="recruitment-form-field"><label for="add_vacancy_id">Applied Position</label>
                        <select id="add_vacancy_id" name="vacancy_id" required>
                            <option value="">Select vacancy</option>
                            <?php foreach ($vacancies as $vacancy): ?>
                            <option value="<?php echo htmlspecialchars($vacancy['id']); ?>"><?php echo htmlspecialchars($vacancy['job_title']); ?> (<?php echo htmlspecialchars($vacancy['department']); ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="recruitment-form-field full"><label for="add_cv">CV Upload (PDF, DOC, DOCX)</label><input type="file" id="add_cv" name="cv_document" accept=".pdf,.doc,.docx"></div>
                </div>
                <div class="recruitment-form-actions">
                    <button type="button" class="btn btn-secondary" data-recruitment-close>Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded" style="font-size:18px;">person_add</span><span>Register Applicant</span></button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="recruitment-modal" id="editApplicantModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2>Edit Applicant</h2><p>Update candidate contact details and applied position.</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmRecruitmentCsrfToken()); ?>">
                <input type="hidden" name="recruitment_action" value="edit_applicant">
                <input type="hidden" name="applicant_id" id="edit_applicant_id">
                <div class="recruitment-form-grid">
                    <div class="recruitment-form-field"><label for="edit_name">Applicant Name</label><input type="text" id="edit_name" name="name" required></div>
                    <div class="recruitment-form-field"><label for="edit_phone">Phone</label><input type="tel" id="edit_phone" name="phone" required></div>
                    <div class="recruitment-form-field"><label for="edit_email">Email</label><input type="email" id="edit_email" name="email" required></div>
                    <div class="recruitment-form-field"><label for="edit_vacancy_id">Applied Position</label>
                        <select id="edit_vacancy_id" name="vacancy_id" required>
                            <?php foreach (hrmRecruitmentVacancies() as $vacancy): ?>
                            <option value="<?php echo htmlspecialchars($vacancy['id']); ?>"><?php echo htmlspecialchars($vacancy['job_title']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="recruitment-form-field full"><label for="edit_cv">Replace CV (optional)</label><input type="file" id="edit_cv" name="cv_document" accept=".pdf,.doc,.docx"></div>
                </div>
                <div class="recruitment-form-actions">
                    <button type="button" class="btn btn-secondary" data-recruitment-close>Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded" style="font-size:18px;">save</span><span>Update Applicant</span></button>
                </div>
            </form>
        </div>
    </section>
</div>

<div class="recruitment-modal" id="viewApplicantModal" aria-hidden="true">
    <div class="recruitment-modal-backdrop" data-recruitment-close></div>
    <section class="recruitment-modal-dialog" role="dialog" aria-modal="true">
        <div class="recruitment-modal-header">
            <div><h2 id="viewApplicantName">Applicant Details</h2><p id="viewApplicantId">Applicant ID</p></div>
            <button type="button" class="recruitment-modal-close" data-recruitment-close><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="recruitment-modal-body">
            <div class="recruitment-detail-grid">
                <div class="recruitment-detail-card"><span>Phone</span><strong id="viewApplicantPhone"></strong></div>
                <div class="recruitment-detail-card"><span>Email</span><strong id="viewApplicantEmail"></strong></div>
                <div class="recruitment-detail-card"><span>Applied Position</span><strong id="viewApplicantPosition"></strong></div>
                <div class="recruitment-detail-card"><span>Status</span><strong id="viewApplicantStatus"></strong></div>
                <div class="recruitment-detail-card" style="grid-column:1/-1;"><span>CV</span><strong id="viewApplicantCv"></strong></div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modals = document.querySelectorAll('.recruitment-modal');
    function openModal(modal) { if (modal) { modal.classList.add('open'); modal.setAttribute('aria-hidden', 'false'); document.body.classList.add('hrm-modal-open'); } }
    function closeModals() { modals.forEach(function (m) { m.classList.remove('open'); m.setAttribute('aria-hidden', 'true'); }); document.body.classList.remove('hrm-modal-open'); }
    document.getElementById('openAddApplicantModal').addEventListener('click', function () { openModal(document.getElementById('addApplicantModal')); });
    document.querySelectorAll('[data-recruitment-close]').forEach(function (el) { el.addEventListener('click', closeModals); });
    document.addEventListener('click', function (e) {
        var viewBtn = e.target.closest('[data-applicant-view]');
        if (viewBtn) {
            document.getElementById('viewApplicantName').textContent = viewBtn.getAttribute('data-name');
            document.getElementById('viewApplicantId').textContent = viewBtn.getAttribute('data-id');
            document.getElementById('viewApplicantPhone').textContent = viewBtn.getAttribute('data-phone');
            document.getElementById('viewApplicantEmail').textContent = viewBtn.getAttribute('data-email');
            document.getElementById('viewApplicantPosition').textContent = viewBtn.getAttribute('data-position');
            document.getElementById('viewApplicantStatus').textContent = viewBtn.getAttribute('data-status');
            var cv = viewBtn.getAttribute('data-cv');
            document.getElementById('viewApplicantCv').innerHTML = cv ? '<a class="recruitment-cv-link" href="' + cv + '" target="_blank" rel="noopener">View CV</a>' : 'No file uploaded';
            openModal(document.getElementById('viewApplicantModal'));
        }
        var editBtn = e.target.closest('[data-applicant-edit]');
        if (editBtn) {
            document.getElementById('edit_applicant_id').value = editBtn.getAttribute('data-id');
            document.getElementById('edit_name').value = editBtn.getAttribute('data-name');
            document.getElementById('edit_phone').value = editBtn.getAttribute('data-phone');
            document.getElementById('edit_email').value = editBtn.getAttribute('data-email');
            document.getElementById('edit_vacancy_id').value = editBtn.getAttribute('data-vacancy');
            openModal(document.getElementById('editApplicantModal'));
        }
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModals(); });
});
</script>

<?php include '../../includes/footer.php'; ?>
