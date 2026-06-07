<?php
$pageTitle = "Employees";
$activePage = "employees";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
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
        width: min(1040px, 100%);
        max-height: min(820px, calc(100vh - 64px));
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
        padding: 28px 32px;
        border-bottom: 1px solid var(--neutral-border);
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
        padding: 32px;
    }

    .add-employee-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(220px, 1fr));
        gap: 20px;
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
        margin-top: 24px;
        padding: 22px;
    }

    .add-employee-section h3 {
        color: var(--neutral-darkest);
        font-size: 1.05rem;
        margin-bottom: 16px;
    }

    .add-employee-upload-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 18px;
    }

    .add-employee-upload-box {
        border: 1px dashed rgba(77, 168, 218, 0.55);
        border-radius: var(--radius-md);
        background-color: rgba(77, 168, 218, 0.06);
        min-height: 132px;
        padding: 20px;
        display: grid;
        align-content: center;
        gap: 10px;
        cursor: pointer;
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
        width: 42px;
        height: 42px;
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
        margin-top: 28px;
    }

    @media (max-width: 1024px) {
        .add-employee-grid {
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
            <p>Across all active branches</p>
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
            <p>Refine the employee list by branch, department, date, and search term.</p>
        </div>
        <button type="button" class="employee-filter-settings" aria-label="Filter settings">
            <span class="material-symbols-rounded">tune</span>
        </button>
    </div>

    <div class="employee-filter-grid">
        <label>
            <span>Branch</span>
            <select class="form-control" data-employee-filter="branch">
                <option value="">All Hargeisa Branches</option>
                <option value="Idaacada Branch">Idaacada Branch</option>
                <option value="Xero Awr Branch">Xero Awr Branch</option>
                <option value="Togdheer Branch">Togdheer Branch</option>
                <option value="Calaamada Branch">Calaamada Branch</option>
                <option value="Hargaysa Branch">Hargaysa Branch</option>
            </select>
        </label>

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
                    <tr data-name="Cabdiraxmaan Cali" data-number="EMP-0001" data-department="Human Resource" data-branch="Idaacada Branch" data-join-date="2024-01-12" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">CC</span>
                                <div><strong>Cabdiraxmaan Cali</strong><span>EMP-0001</span></div>
                            </div>
                        </td>
                        <td>Human Resource</td>
                        <td>Idaacada Branch</td>
                        <td>2024-01-12</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=EMP-0001" aria-label="View Cabdiraxmaan Cali"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit Cabdiraxmaan Cali"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable Cabdiraxmaan Cali"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                    <tr data-name="Fadumo Xasan" data-number="EMP-0002" data-department="Finance" data-branch="Xero Awr Branch" data-join-date="2023-11-07" data-status="On Leave">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">FX</span>
                                <div><strong>Fadumo Xasan</strong><span>EMP-0002</span></div>
                            </div>
                        </td>
                        <td>Finance</td>
                        <td>Xero Awr Branch</td>
                        <td>2023-11-07</td>
                        <td><span class="employee-status leave">On Leave</span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=EMP-0002" aria-label="View Fadumo Xasan"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit Fadumo Xasan"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable Fadumo Xasan"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                    <tr data-name="Mahad Axmed" data-number="EMP-0003" data-department="Operations" data-branch="Togdheer Branch" data-join-date="2022-08-16" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">MA</span>
                                <div><strong>Mahad Axmed</strong><span>EMP-0003</span></div>
                            </div>
                        </td>
                        <td>Operations</td>
                        <td>Togdheer Branch</td>
                        <td>2022-08-16</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=EMP-0003" aria-label="View Mahad Axmed"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit Mahad Axmed"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable Mahad Axmed"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                    <tr data-name="Sahra Maxamed" data-number="EMP-0004" data-department="Marketing" data-branch="Calaamada Branch" data-join-date="2024-03-03" data-status="Inactive">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">SM</span>
                                <div><strong>Sahra Maxamed</strong><span>EMP-0004</span></div>
                            </div>
                        </td>
                        <td>Marketing</td>
                        <td>Calaamada Branch</td>
                        <td>2024-03-03</td>
                        <td><span class="employee-status inactive">Inactive</span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=EMP-0004" aria-label="View Sahra Maxamed"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit Sahra Maxamed"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable Sahra Maxamed"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                    <tr data-name="Hodan Maxamed" data-number="EMP-0005" data-department="Finance" data-branch="Hargaysa Branch" data-join-date="2021-06-24" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">HM</span>
                                <div><strong>Hodan Maxamed</strong><span>EMP-0005</span></div>
                            </div>
                        </td>
                        <td>Finance</td>
                        <td>Hargaysa Branch</td>
                        <td>2021-06-24</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=EMP-0005" aria-label="View Hodan Maxamed"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit Hodan Maxamed"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable Hodan Maxamed"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                    <tr data-name="Mustafe Cabdi" data-number="EMP-0006" data-department="Information Technology" data-branch="Idaacada Branch" data-join-date="2020-04-18" data-status="Active">
                        <td>
                            <div class="employee-table-name"><span class="employee-avatar">MC</span>
                                <div><strong>Mustafe Cabdi</strong><span>EMP-0006</span></div>
                            </div>
                        </td>
                        <td>Information Technology</td>
                        <td>Idaacada Branch</td>
                        <td>2020-04-18</td>
                        <td><span class="employee-status active">Active</span></td>
                        <td>
                            <div class="employee-row-actions"><a href="employee_view.php?id=EMP-0006" aria-label="View Mustafe Cabdi"><span class="material-symbols-rounded">visibility</span></a><button aria-label="Edit Mustafe Cabdi"><span class="material-symbols-rounded">edit_square</span></button><button aria-label="Disable Mustafe Cabdi"><span class="material-symbols-rounded">person_off</span></button></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="employee-table-footer">
            <span data-employee-table-summary>Showing 1-4 of 6 employees</span>
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
                <p>Create a new employee profile with branch, department, and onboarding details.</p>
            </div>
            <button type="button" class="add-employee-close" data-add-employee-close aria-label="Close add employee form">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <form class="add-employee-form" id="addEmployeeForm">
            <div class="add-employee-grid">
                <label>
                    <span>Employee Number</span>
                    <input type="text" class="form-control" name="employee_number" placeholder="EMP-0007" required>
                </label>
                <label>
                    <span>Full Name</span>
                    <input type="text" class="form-control" name="full_name" placeholder="Employee full name" required>
                </label>
                <label>
                    <span>Status</span>
                    <select class="form-control" name="status" required>
                        <option value="Active">Active</option>
                        <option value="On Leave">On Leave</option>
                        <option value="Inactive">Inactive</option>
                    </select>
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
                    <span>Branch</span>
                    <select class="form-control" name="branch" required>
                        <option value="">Select branch</option>
                        <option value="Idaacada Branch">Idaacada Branch</option>
                        <option value="Xero Awr Branch">Xero Awr Branch</option>
                        <option value="Togdheer Branch">Togdheer Branch</option>
                        <option value="Calaamada Branch">Calaamada Branch</option>
                        <option value="Hargaysa Branch">Hargaysa Branch</option>
                    </select>
                </label>
                <label>
                    <span>Join Date</span>
                    <input type="date" class="form-control" name="join_date" required>
                </label>
                <label>
                    <span>Role</span>
                    <input type="text" class="form-control" name="role" placeholder="Job title" required>
                </label>
                <label>
                    <span>Phone</span>
                    <input type="tel" class="form-control" name="phone" placeholder="+252 61 555 0000">
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" class="form-control" name="email" placeholder="employee@hrms.local">
                </label>
            </div>

            <div class="add-employee-section">
                <h3>Uploads</h3>
                <div class="add-employee-upload-grid">
                    <label class="add-employee-upload-box">
                        <span>Profile Photo</span>
                        <strong><span class="material-symbols-rounded">add_photo_alternate</span> Upload employee photo</strong>
                        <small>Accepted: JPG, PNG, or WEBP profile image.</small>
                        <input type="file" class="form-control" name="profile_photo" accept="image/*">
                    </label>
                    <label class="add-employee-upload-box">
                        <span>Employee Documents</span>
                        <strong><span class="material-symbols-rounded">upload_file</span> Upload registration documents</strong>
                        <small>Accepted: PDF, DOC, DOCX, JPG, or PNG. Multiple files allowed.</small>
                        <input type="file" class="form-control" name="employee_documents[]" accept=".pdf,.doc,.docx,image/*" multiple>
                    </label>
                </div>
            </div>

            <div class="add-employee-section">
                <h3>Onboarding Notes</h3>
                <label>
                    <span>Notes</span>
                    <textarea class="form-control" name="notes" rows="4" placeholder="Add onboarding or HR notes..."></textarea>
                </label>
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

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        closeModal();
        form.reset();
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
