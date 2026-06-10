<?php
$pageTitle = "Employees";
$activePage = "employees";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_employee_store.php';

$registrationMessage = '';
$registrationError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_employee'])) {
    try {
        if (!hrmEmployeeVerifyCsrf($_POST['csrf_token'] ?? '')) {
            throw new RuntimeException('Security token expired. Please try again.');
        }

        $newEmployeeId = hrmEmployeeRegister($_POST);
        header('Location: employees.php?saved=1&id=' . rawurlencode($newEmployeeId));
        exit;
    } catch (Throwable $exception) {
        $registrationError = $exception->getMessage();
    }
}

$employees = hrmEmployeeAll();

if (isset($_GET['saved'])) {
    $registrationMessage = 'Employee registered successfully.';
}

include '../../includes/header_sidebar.php';
?>
<style>
    body {
        zoom: 75%;
    }

    .add-employee-modal {
        position: fixed;
        inset: 0;
        z-index: 680;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .add-employee-modal.open {
        display: flex;
    }

    .add-employee-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    .add-employee-dialog {
        position: relative;
        width: min(1180px, 100%);
        max-height: min(860px, calc(100vh - 64px));
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .add-employee-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 24px 30px;
        border-bottom: 1px solid var(--neutral-border);
        background: linear-gradient(135deg, rgba(77, 168, 218, 0.12), rgba(255, 255, 255, 0.96));
    }

    .add-employee-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .add-employee-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .add-employee-close {
        width: 52px;
        height: 52px;
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

    .add-employee-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .add-employee-form {
        overflow: auto;
        padding: 26px 30px 30px;
        background-color: rgba(248, 250, 252, 0.78);
    }

    .add-employee-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(190px, 1fr));
        gap: 16px;
    }

    .add-employee-grid .add-employee-wide {
        grid-column: span 2;
    }

    .add-employee-grid label,
    .add-employee-section label {
        display: block;
    }

    .add-employee-grid label span,
    .add-employee-section label span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.76rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .add-employee-section {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
        margin-bottom: 18px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    }

    .add-employee-section:first-child {
        margin-top: 0;
    }

    .add-employee-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .add-employee-section-icon {
        width: 42px;
        height: 42px;
        border-radius: var(--radius-md);
        background-color: var(--secondary-light);
        color: var(--primary-color);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
    }

    .add-employee-section h3 {
        color: var(--neutral-darkest);
        font-size: 1.05rem;
        margin-bottom: 3px;
    }

    .add-employee-section p {
        color: var(--neutral-gray);
        font-size: 0.84rem;
        font-weight: 600;
        margin: 0;
    }

    .add-employee-upload-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(180px, 1fr));
        gap: 14px;
    }

    .add-employee-upload-box {
        border: 1px dashed rgba(77, 168, 218, 0.55);
        border-radius: var(--radius-md);
        background-color: rgba(77, 168, 218, 0.06);
        min-height: 126px;
        padding: 16px;
        display: grid;
        align-content: center;
        gap: 8px;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .add-employee-upload-box:hover {
        border-color: var(--primary-color);
        background-color: rgba(77, 168, 218, 0.1);
    }

    .add-employee-upload-box input {
        width: 100%;
    }

    .add-employee-upload-box strong {
        color: var(--neutral-dark);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.98rem;
    }

    .add-employee-upload-box strong .material-symbols-rounded {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-md);
        background-color: var(--secondary-light);
        color: var(--primary-color);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .add-employee-upload-box small {
        color: var(--neutral-gray);
        font-weight: 600;
        line-height: 1.4;
    }

    .add-employee-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--neutral-border);
    }

    .employee-registration-message {
        border-radius: var(--radius-md);
        font-weight: 800;
        margin-bottom: 18px;
        padding: 14px 16px;
    }

    .employee-registration-message.success {
        background-color: var(--success-light);
        color: var(--success-hover);
    }

    .employee-registration-message.error {
        background-color: var(--danger-light);
        color: var(--danger-hover);
    }

    @media (max-width: 1024px) {
        .add-employee-grid {
            grid-template-columns: repeat(2, minmax(220px, 1fr));
        }

        .add-employee-upload-grid {
            grid-template-columns: repeat(2, minmax(220px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .add-employee-modal {
            padding: 16px;
        }

        .add-employee-header,
        .add-employee-form {
            padding: 22px;
        }

        .add-employee-grid {
            grid-template-columns: 1fr;
        }

        .add-employee-grid .add-employee-wide {
            grid-column: span 1;
        }

        .add-employee-upload-grid {
            grid-template-columns: 1fr;
        }

        .add-employee-actions {
            flex-direction: column-reverse;
        }
    }
</style>

<div class="hrm-page-title-row">
    <div>
        <h1>Employees</h1>
        <p>Manage employee records, status, and onboarding details.</p>
    </div>
</div>

<div class="employee-insights-grid">
    <div class="employee-insight-card total">
        <div>
            <h3>Total Employees</h3>
            <strong>1,420</strong>
            <p>At <?php echo htmlspecialchars(hrmBranchName()); ?></p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">groups</span>
        </div>
    </div>

    <div class="employee-insight-card active">
        <div>
            <h3>Active Employees</h3>
            <strong>1,284</strong>
            <p>Currently active in the system</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">person_check</span>
        </div>
    </div>

    <div class="employee-insight-card leave">
        <div>
            <h3>On Leave Employees</h3>
            <strong>46</strong>
            <p>Approved leave requests this month</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">beach_access</span>
        </div>
    </div>

    <div class="employee-insight-card new-month">
        <div>
            <h3>New This Month</h3>
            <strong>38</strong>
            <p>Newly added employee profiles</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">person_add</span>
        </div>
    </div>

    <div class="employee-insight-card least-performing">
        <div>
            <h3>Least Performing</h3>
            <strong>Ahmed Jama</strong>
            <p>Marketing - 69% performance score</p>
        </div>
        <div class="employee-insight-icon">
            <span class="material-symbols-rounded">trending_down</span>
        </div>
    </div>
</div>

<section class="employee-filter-panel">
    <div class="employee-filter-header">
        <div>
            <h2>Filters</h2>
            <p>Refine the employee list by department, date, and search term.</p>
        </div>
        <button type="button" class="employee-filter-settings" aria-label="Filter settings">
            <span class="material-symbols-rounded">tune</span>
        </button>
    </div>

    <div class="employee-filter-grid">
        <label>
            <span>Department</span>
            <select class="form-control" data-employee-filter="department">
                <option value="">All Departments</option>
                <option value="Human Resource">Human Resource</option>
                <option value="Finance">Finance</option>
                <option value="Operations">Operations</option>
                <option value="Marketing">Marketing</option>
                <option value="Information Technology">Information Technology</option>
            </select>
        </label>

        <label>
            <span>Date</span>
            <input type="date" class="form-control" data-employee-filter="date">
        </label>

        <label>
            <span>Search By Name Or Number</span>
            <div class="form-control-wrapper">
                <span class="form-control-icon material-symbols-rounded">search</span>
                <input type="search" class="form-control" placeholder="Search employee..." data-employee-filter="search">
            </div>
        </label>
    </div>
</section>

<?php if ($registrationMessage): ?>
<div class="employee-registration-message success"><?php echo htmlspecialchars($registrationMessage); ?></div>
<?php endif; ?>

<?php if ($registrationError): ?>
<div class="employee-registration-message error"><?php echo htmlspecialchars($registrationError); ?></div>
<?php endif; ?>

<section class="employee-records-section">
    <div class="employee-records-header">
        <div>
            <h2>Employee Records</h2>
            <p>Review employee details and manage records from one place.</p>
        </div>
        <button type="button" class="btn btn-secondary" data-add-employee-open>
            <span class="material-symbols-rounded" style="font-size: 18px;">add</span>
            <span>Add Employee</span>
        </button>
    </div>

    <div class="employee-table-panel" data-employee-table>
        <div class="employee-table-scroll">
            <table class="employee-data-table">
                <thead>
                    <tr>
                        <th><button type="button" data-sort-key="name">Full Name <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-sort-key="department">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-sort-key="branch">Branch <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-sort-key="joinDate">Join Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th><button type="button" data-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employeeNumber => $employee): ?>
                    <tr data-name="<?php echo htmlspecialchars($employee['name']); ?>" data-number="<?php echo htmlspecialchars($employeeNumber); ?>" data-department="<?php echo htmlspecialchars($employee['department']); ?>" data-branch="<?php echo htmlspecialchars($employee['branch']); ?>" data-join-date="<?php echo htmlspecialchars($employee['join_date']); ?>" data-status="<?php echo htmlspecialchars($employee['status']); ?>">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar"><?php echo htmlspecialchars($employee['initials']); ?></span>
                                <div><strong><?php echo htmlspecialchars($employee['name']); ?></strong><span><?php echo htmlspecialchars($employeeNumber); ?></span></div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($employee['department']); ?></td>
                        <td><?php echo htmlspecialchars($employee['branch']); ?></td>
                        <td><?php echo htmlspecialchars($employee['join_date']); ?></td>
                        <td><span class="employee-status <?php echo htmlspecialchars(hrmEmployeeStatusClass($employee['status'])); ?>"><?php echo htmlspecialchars($employee['status']); ?></span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=<?php echo rawurlencode($employeeNumber); ?>" aria-label="View <?php echo htmlspecialchars($employee['name']); ?>"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit <?php echo htmlspecialchars($employee['name']); ?>"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable <?php echo htmlspecialchars($employee['name']); ?>"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="employee-table-footer">
            <span data-employee-table-summary>Showing 1-4 of <?php echo count($employees); ?> employees</span>
            <div class="employee-pagination" data-employee-pagination></div>
        </div>
    </div>
</section>

<div class="add-employee-modal" id="addEmployeeModal" aria-hidden="true">
    <div class="add-employee-backdrop" data-add-employee-close></div>
    <section class="add-employee-dialog" role="dialog" aria-modal="true" aria-labelledby="addEmployeeTitle">
        <div class="add-employee-header">
            <div>
                <h2 id="addEmployeeTitle">Add Employee</h2>
                <p>Create a new employee profile with department and onboarding details.</p>
            </div>
            <button type="button" class="add-employee-close" data-add-employee-close aria-label="Close add employee form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <form class="add-employee-form" id="addEmployeeForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="add_employee" value="1">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(hrmEmployeeCsrfToken()); ?>">
            <div class="add-employee-section">
                <div class="add-employee-section-header">
                    <span class="add-employee-section-icon material-symbols-rounded">badge</span>
                    <div>
                        <h3>Personal Information</h3>
                        <p>Employee identity and contact details.</p>
                    </div>
                </div>
                <div class="add-employee-grid">
                    <label>
                        <span>Full Name</span>
                        <input type="text" class="form-control" name="full_name" placeholder="Employee full name" required>
                    </label>
                    <label>
                        <span>Gender</span>
                        <select class="form-control" name="gender">
                            <option value="">Select gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </label>
                    <label>
                        <span>Date of Birth</span>
                        <input type="date" class="form-control" name="date_of_birth">
                    </label>
                    <label>
                        <span>Phone</span>
                        <input type="tel" class="form-control" name="phone" placeholder="+252 61 555 0000">
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" class="form-control" name="email" placeholder="employee@hrms.local">
                    </label>
                    <label>
                        <span>National ID/Passport</span>
                        <input type="text" class="form-control" name="national_id" placeholder="ID or passport number">
                    </label>
                    <label class="add-employee-wide">
                        <span>Address</span>
                        <input type="text" class="form-control" name="address" placeholder="Residential address">
                    </label>
                </div>
            </div>

            <div class="add-employee-section">
                <div class="add-employee-section-header">
                    <span class="add-employee-section-icon material-symbols-rounded">work</span>
                    <div>
                        <h3>Job Information</h3>
                        <p>Department, role, and work status.</p>
                    </div>
                </div>
                <div class="add-employee-grid">
                    <label>
                        <span>Employee ID</span>
                        <input type="text" class="form-control" name="employee_number" placeholder="EMP-0007" required>
                    </label>
                    <label>
                        <span>Department</span>
                        <select class="form-control" name="department" required>
                            <option value="">Select department</option>
                            <option value="Human Resource">Human Resource</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Information Technology">Information Technology</option>
                        </select>
                    </label>
                    <label>
                        <span>Position</span>
                        <input type="text" class="form-control" name="role" placeholder="Job title" required>
                    </label>
                    <label>
                        <span>Employment Type</span>
                        <select class="form-control" name="employment_type">
                            <option value="">Select employment type</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </label>
                    <label>
                        <span>Joining Date</span>
                        <input type="date" class="form-control" name="join_date" required>
                    </label>
                    <input type="hidden" name="branch" value="<?php echo htmlspecialchars(hrmBranchName()); ?>">
                    <label>
                        <span>Work Location</span>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars(hrmBranchName()); ?>" readonly>
                    </label>
                    <label>
                        <span>Status</span>
                        <select class="form-control" name="status" required>
                            <option value="Active">Active</option>
                            <option value="On Leave">On Leave</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </label>
                </div>
            </div>

            <div class="add-employee-section">
                <div class="add-employee-section-header">
                    <span class="add-employee-section-icon material-symbols-rounded">contract</span>
                    <div>
                        <h3>Salary & Contract</h3>
                        <p>Compensation package and contract validity.</p>
                    </div>
                </div>
                <div class="add-employee-grid">
                    <label>
                        <span>Basic Salary</span>
                        <input type="number" class="form-control" name="basic_salary" placeholder="0.00" min="0" step="0.01">
                    </label>
                    <label>
                        <span>Allowance</span>
                        <input type="number" class="form-control" name="allowance" placeholder="0.00" min="0" step="0.01">
                    </label>
                    <label>
                        <span>Contract Type</span>
                        <select class="form-control" name="contract_type">
                            <option value="">Select contract type</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Fixed Term">Fixed Term</option>
                            <option value="Temporary">Temporary</option>
                            <option value="Probation">Probation</option>
                        </select>
                    </label>
                    <label>
                        <span>Contract Start Date</span>
                        <input type="date" class="form-control" name="contract_start_date">
                    </label>
                    <label>
                        <span>Contract End Date</span>
                        <input type="date" class="form-control" name="contract_end_date">
                    </label>
                    <label class="add-employee-wide">
                        <span>Contract Notes</span>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Add contract or HR notes..."></textarea>
                    </label>
                </div>
            </div>

            <div class="add-employee-section">
                <div class="add-employee-section-header">
                    <span class="add-employee-section-icon material-symbols-rounded">contact_emergency</span>
                    <div>
                        <h3>Emergency Contact</h3>
                        <p>Primary contact for urgent employee matters.</p>
                    </div>
                </div>
                <div class="add-employee-grid">
                    <label>
                        <span>Contact Name</span>
                        <input type="text" class="form-control" name="emergency_contact_name" placeholder="Contact full name">
                    </label>
                    <label>
                        <span>Relationship</span>
                        <input type="text" class="form-control" name="emergency_relationship" placeholder="Relationship">
                    </label>
                    <label>
                        <span>Phone Number</span>
                        <input type="tel" class="form-control" name="emergency_phone" placeholder="+252 61 555 0000">
                    </label>
                    <label class="add-employee-wide">
                        <span>Address</span>
                        <input type="text" class="form-control" name="emergency_address" placeholder="Emergency contact address">
                    </label>
                </div>
            </div>

            <div class="add-employee-section">
                <div class="add-employee-section-header">
                    <span class="add-employee-section-icon material-symbols-rounded">folder_open</span>
                    <div>
                        <h3>Documents</h3>
                        <p>Attach employee files and profile image.</p>
                    </div>
                </div>
                <div class="add-employee-upload-grid">
                    <label class="add-employee-upload-box">
                        <span>Upload CV</span>
                        <strong><span class="material-symbols-rounded">description</span> Select CV file</strong>
                        <small>Accepted: PDF, DOC, or DOCX.</small>
                        <input type="file" class="form-control" name="cv_document" accept=".pdf,.doc,.docx">
                    </label>
                    <label class="add-employee-upload-box">
                        <span>Upload Contract</span>
                        <strong><span class="material-symbols-rounded">contract</span> Select contract file</strong>
                        <small>Accepted: PDF, DOC, DOCX, JPG, or PNG.</small>
                        <input type="file" class="form-control" name="contract_document" accept=".pdf,.doc,.docx,image/*">
                    </label>
                    <label class="add-employee-upload-box">
                        <span>Upload Qualification</span>
                        <strong><span class="material-symbols-rounded">school</span> Select qualification file</strong>
                        <small>Accepted: PDF, DOC, DOCX, JPG, or PNG.</small>
                        <input type="file" class="form-control" name="qualification_document" accept=".pdf,.doc,.docx,image/*">
                    </label>
                    <label class="add-employee-upload-box">
                        <span>Upload National ID</span>
                        <strong><span class="material-symbols-rounded">badge</span> Select ID file</strong>
                        <small>Accepted: PDF, JPG, or PNG.</small>
                        <input type="file" class="form-control" name="national_id_document" accept=".pdf,image/*">
                    </label>
                    <label class="add-employee-upload-box">
                        <span>Upload Profile Photo</span>
                        <strong><span class="material-symbols-rounded">add_photo_alternate</span> Select profile photo</strong>
                        <small>Accepted: JPG, PNG, or WEBP profile image.</small>
                        <input type="file" class="form-control" name="profile_photo" accept="image/*">
                    </label>
                </div>
            </div>

            <div class="add-employee-actions">
                <button type="button" class="btn btn-secondary" data-add-employee-close>Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <span class="material-symbols-rounded" style="font-size: 18px;">person_add</span>
                    <span>Save Employee</span>
                </button>
            </div>
        </form>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('addEmployeeModal');
    var form = document.getElementById('addEmployeeForm');
    var openButton = document.querySelector('[data-add-employee-open]');

    if (!modal || !form || !openButton) return;

    function openModal() {
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');

        var firstInput = form.querySelector('input, select, textarea');
        if (firstInput) {
            firstInput.focus();
        }
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    openButton.addEventListener('click', openModal);

    modal.querySelectorAll('[data-add-employee-close]').forEach(function (trigger) {
        trigger.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('open')) {
            closeModal();
        }
    });
});
</script>

<?php
include '../../includes/footer.php';
?>
