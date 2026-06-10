<?php
$pageTitle = "Employee Profile";
$activePage = "employees";
$assetPath = "../../assets";
$menuPath = __DIR__ . "/menu.php";
require_once __DIR__ . '/../../includes/hrm_employee_store.php';

$employeeId = isset($_GET['id']) ? $_GET['id'] : 'EMP-0001';
$employee = hrmEmployeeFind($employeeId);
$employeeId = $employee['employee_number'];
$statusClass = hrmEmployeeStatusClass($employee['status']);
$employeeDocuments = isset($employee['documents']) && is_array($employee['documents']) ? $employee['documents'] : [];
$employeeDocumentCount = count($employeeDocuments);
$employeeQualificationCount = count(array_filter($employeeDocuments, function ($document) {
    return ($document['category'] ?? '') === 'Academic';
}));
$employeeIdentityCount = count(array_filter($employeeDocuments, function ($document) {
    return ($document['category'] ?? '') === 'Identity';
}));
$employeeCertificateCount = count(array_filter($employeeDocuments, function ($document) {
    return in_array(($document['type'] ?? ''), ['Qualification', 'Profile Photo'], true);
}));

include '../../includes/header_sidebar.php';
?>
<div class="employee-profile-actions">
    <a href="employees.php" class="btn btn-secondary">
        <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
        <span>Go Back</span>
    </a>
    <button type="button" class="btn btn-outline">
        <span class="material-symbols-rounded" style="font-size: 20px;">print</span>
        <span>Print Employee Info</span>
    </button>
</div>

<section class="employee-profile-panel">
    <div class="employee-profile-summary">
        <div class="employee-profile-photo">
            <div class="employee-profile-photo-inner">
                <span><?php echo htmlspecialchars($employee['initials']); ?></span>
            </div>
        </div>

        <h1><?php echo htmlspecialchars($employee['name']); ?></h1>
        <p><?php echo htmlspecialchars($employee['role']); ?></p>

        <div class="employee-profile-badges">
            <span class="employee-status <?php echo htmlspecialchars($statusClass); ?>"><?php echo htmlspecialchars($employee['status']); ?></span>
            <span class="employee-profile-id"><?php echo htmlspecialchars($employeeId); ?></span>
        </div>
    </div>

    <div class="employee-profile-details">
        <div class="employee-detail-group">
            <h2>Employment Details</h2>
            <dl>
                <div>
                    <span class="employee-detail-icon material-symbols-rounded">badge</span>
                    <dt>Department</dt>
                    <dd><?php echo htmlspecialchars($employee['department']); ?></dd>
                </div>
                <div>
                    <span class="employee-detail-icon material-symbols-rounded">account_tree</span>
                    <dt>Branch</dt>
                    <dd><?php echo htmlspecialchars($employee['branch']); ?></dd>
                </div>
                <div>
                    <span class="employee-detail-icon material-symbols-rounded">event</span>
                    <dt>Join Date</dt>
                    <dd><?php echo htmlspecialchars($employee['join_date']); ?></dd>
                </div>
                <div>
                    <span class="employee-detail-icon material-symbols-rounded">call</span>
                    <dt>Phone Number</dt>
                    <dd><?php echo htmlspecialchars($employee['phone']); ?></dd>
                </div>
            </dl>
        </div>

        <div class="employee-detail-group">
            <h2>Contact & Location</h2>
            <dl>
                <div>
                    <span class="employee-detail-icon material-symbols-rounded">mail</span>
                    <dt>Email Address</dt>
                    <dd><?php echo htmlspecialchars($employee['email']); ?></dd>
                </div>
                <div>
                    <span class="employee-detail-icon material-symbols-rounded">location_on</span>
                    <dt>Current Location</dt>
                    <dd><?php echo htmlspecialchars($employee['location']); ?></dd>
                </div>
            </dl>
        </div>
    </div>
</section>

<nav class="employee-profile-tabs" aria-label="Employee profile sections">
    <a href="#basic-info" class="active" data-employee-tab-target="basic-info">Basic Info</a>
    <a href="#attendance" data-employee-tab-target="attendance">Attendance</a>
    <a href="#warnings" data-employee-tab-target="warnings">Warnings</a>
    <a href="#leaves" data-employee-tab-target="leaves">Leaves</a>
    <a href="#promotion" data-employee-tab-target="promotion">Promotion</a>
    <a href="#payroll" data-employee-tab-target="payroll">Payroll</a>
    <a href="#training" data-employee-tab-target="training">Training</a>
    <a href="#pension" data-employee-tab-target="pension">Pension</a>
    <a href="#roster" data-employee-tab-target="roster">Roster</a>
    <a href="#documents" data-employee-tab-target="documents">Documents</a>
    <a href="#job-experience" data-employee-tab-target="job-experience">Job Experience</a>
    <a href="#academic-background" data-employee-tab-target="academic-background">Academic Background</a>
</nav>

<section class="employee-profile-tab-panel active" id="basic-info" data-employee-tab-panel="basic-info">
<div class="employee-basic-info-section">
    <div class="employee-basic-panel personal-info">
        <div class="employee-basic-header">
            <h2>Personal Information</h2>
            <p>Overview of employee personal and employment details.</p>
        </div>

        <div class="employee-basic-list two-column">
            <div class="employee-basic-item">
                <span class="material-symbols-rounded">person</span>
                <div>
                    <dt>Full Name</dt>
                    <dd><?php echo htmlspecialchars($employee['name']); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">confirmation_number</span>
                <div>
                    <dt>Employee Number</dt>
                    <dd><?php echo htmlspecialchars($employeeId); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">wc</span>
                <div>
                    <dt>Gender</dt>
                    <dd><?php echo htmlspecialchars($employee['gender'] ?? ''); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">cake</span>
                <div>
                    <dt>Date of Birth</dt>
                    <dd><?php echo htmlspecialchars($employee['date_of_birth'] ?? ''); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">call</span>
                <div>
                    <dt>Phone Number</dt>
                    <dd><?php echo htmlspecialchars($employee['phone']); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">mail</span>
                <div>
                    <dt>Email Address</dt>
                    <dd><?php echo htmlspecialchars($employee['email']); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">badge</span>
                <div>
                    <dt>Department</dt>
                    <dd><?php echo htmlspecialchars($employee['department']); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">account_tree</span>
                <div>
                    <dt>Branch</dt>
                    <dd><?php echo htmlspecialchars($employee['branch']); ?></dd>
                </div>
            </div>
        </div>
    </div>

    <aside class="employee-basic-panel employment-summary">
        <div class="employee-basic-header">
            <h2>Employment Summary</h2>
            <p>Current job and contract snapshot.</p>
        </div>

        <div class="employee-basic-list">
            <div class="employee-basic-item">
                <span class="material-symbols-rounded">work</span>
                <div>
                    <dt>Designation</dt>
                    <dd><?php echo htmlspecialchars($employee['role']); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">event_available</span>
                <div>
                    <dt>Join Date</dt>
                    <dd><?php echo htmlspecialchars($employee['join_date']); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">verified_user</span>
                <div>
                    <dt>Employment Type</dt>
                    <dd><?php echo htmlspecialchars($employee['employment_type'] ?? ''); ?></dd>
                </div>
            </div>

            <div class="employee-basic-item">
                <span class="material-symbols-rounded">supervisor_account</span>
                <div>
                    <dt>Reporting Manager</dt>
                    <dd>Asha Mohamed</dd>
                </div>
            </div>
        </div>
    </aside>
</div>
</section>

<section class="employee-profile-tab-panel" id="attendance" data-employee-tab-panel="attendance">
    <div class="employee-attendance-insights">
        <div class="employee-insight-card total">
            <div>
                <h3>Attendance Rate</h3>
                <strong>94%</strong>
                <p>Average monthly attendance rate</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">fact_check</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Present Days</h3>
                <strong>3</strong>
                <p>Recorded present days this month</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">event_available</span>
            </div>
        </div>

        <div class="employee-insight-card leave">
            <div>
                <h3>Late Days</h3>
                <strong>2</strong>
                <p>Attendance records with late arrival</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">schedule</span>
            </div>
        </div>

        <div class="employee-insight-card least-performing">
            <div>
                <h3>Absent Days</h3>
                <strong>1</strong>
                <p>Days without check-in records</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">person_off</span>
            </div>
        </div>
    </div>

    <section class="employee-attendance-history-panel">
        <div class="hrm-chart-header">
            <div>
                <h2>Attendance History</h2>
                <p>Track the employee attendance trend by day, week, or month.</p>
            </div>
            <button type="button" class="btn btn-outline btn-sm">
                <span>Monthly</span>
                <span class="material-symbols-rounded" style="font-size: 18px;">expand_more</span>
            </button>
        </div>

        <div class="employee-attendance-chart" aria-label="Employee attendance history chart">
            <svg viewBox="0 0 980 360" role="img">
                <defs>
                    <linearGradient id="employeeAttendanceArea" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#0F4C81" stop-opacity="0.22"></stop>
                        <stop offset="100%" stop-color="#4DA8DA" stop-opacity="0.04"></stop>
                    </linearGradient>
                </defs>
                <g class="chart-grid">
                    <line x1="70" y1="46" x2="936" y2="46"></line>
                    <line x1="70" y1="118" x2="936" y2="118"></line>
                    <line x1="70" y1="190" x2="936" y2="190"></line>
                    <line x1="70" y1="262" x2="936" y2="262"></line>
                    <line x1="70" y1="334" x2="936" y2="334"></line>
                </g>
                <g class="chart-axis-labels">
                    <text x="26" y="50">100%</text>
                    <text x="34" y="122">80%</text>
                    <text x="34" y="194">60%</text>
                    <text x="34" y="266">40%</text>
                    <text x="34" y="338">20%</text>
                </g>
                <path class="employee-attendance-fill" d="M70 96 C180 90 250 82 330 76 C440 66 520 55 610 58 C720 62 770 82 850 75 C895 72 920 66 936 62 L936 334 L70 334 Z"></path>
                <path class="employee-attendance-line" d="M70 96 C180 90 250 82 330 76 C440 66 520 55 610 58 C720 62 770 82 850 75 C895 72 920 66 936 62"></path>
                <g class="employee-attendance-points">
                    <circle cx="70" cy="96" r="7" data-chart-title="Nov 2025" data-chart-value="88% attendance"></circle>
                    <circle cx="330" cy="76" r="7" data-chart-title="Dec 2025" data-chart-value="91% attendance"></circle>
                    <circle cx="500" cy="64" r="7" data-chart-title="Jan 2026" data-chart-value="94% attendance"></circle>
                    <circle cx="670" cy="58" r="7" data-chart-title="Feb 2026" data-chart-value="96% attendance"></circle>
                    <circle cx="835" cy="74" r="7" data-chart-title="Mar 2026" data-chart-value="93% attendance"></circle>
                    <circle cx="936" cy="62" r="7" data-chart-title="Apr 2026" data-chart-value="95% attendance"></circle>
                </g>
                <g class="chart-days">
                    <text x="70" y="356">Nov 2025</text>
                    <text x="330" y="356">Dec 2025</text>
                    <text x="500" y="356">Jan 2026</text>
                    <text x="670" y="356">Feb 2026</text>
                    <text x="835" y="356">Mar 2026</text>
                    <text x="936" y="356">Apr 2026</text>
                </g>
            </svg>
        </div>
    </section>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Monthly Attendance Log</h2>
                <p>April 2026 attendance records including today.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-attendance-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-attendance-sort-key="date">Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-attendance-sort-key="checkIn">Check In <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-attendance-sort-key="checkOut">Check Out <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-attendance-sort-key="workHours">Work Hours <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-attendance-sort-key="lateBy">Late By <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-attendance-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-date="2026-04-24" data-check-in="08:01 AM" data-check-out="05:12 PM" data-work-hours="09h 11m" data-late-by="1 min" data-status="Present"><td>2026-04-24</td><td>08:01 AM</td><td>05:12 PM</td><td>09h 11m</td><td>1 min</td><td><span class="employee-status active">Present</span></td></tr>
                        <tr data-date="2026-04-23" data-check-in="08:18 AM" data-check-out="05:05 PM" data-work-hours="08h 47m" data-late-by="18 min" data-status="Late"><td>2026-04-23</td><td>08:18 AM</td><td>05:05 PM</td><td>08h 47m</td><td>18 min</td><td><span class="employee-status late">Late</span></td></tr>
                        <tr data-date="2026-04-22" data-check-in="--" data-check-out="--" data-work-hours="00h 00m" data-late-by="--" data-status="Absent"><td>2026-04-22</td><td>--</td><td>--</td><td>00h 00m</td><td>--</td><td><span class="employee-status inactive">Absent</span></td></tr>
                        <tr data-date="2026-04-21" data-check-in="07:58 AM" data-check-out="05:04 PM" data-work-hours="09h 06m" data-late-by="--" data-status="Present"><td>2026-04-21</td><td>07:58 AM</td><td>05:04 PM</td><td>09h 06m</td><td>--</td><td><span class="employee-status active">Present</span></td></tr>
                        <tr data-date="2026-04-20" data-check-in="08:07 AM" data-check-out="05:01 PM" data-work-hours="08h 54m" data-late-by="7 min" data-status="Late"><td>2026-04-20</td><td>08:07 AM</td><td>05:01 PM</td><td>08h 54m</td><td>7 min</td><td><span class="employee-status late">Late</span></td></tr>
                        <tr data-date="2026-04-17" data-check-in="07:55 AM" data-check-out="05:10 PM" data-work-hours="09h 15m" data-late-by="--" data-status="Present"><td>2026-04-17</td><td>07:55 AM</td><td>05:10 PM</td><td>09h 15m</td><td>--</td><td><span class="employee-status active">Present</span></td></tr>
                    </tbody>
                </table>
            </div>

            <div class="employee-table-footer">
                <span data-attendance-table-summary>Showing 1-4 of 6 records</span>
                <div class="employee-pagination" data-attendance-pagination></div>
            </div>
        </div>
    </section>
</section>

<section class="employee-profile-tab-panel" id="warnings" data-employee-tab-panel="warnings">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Total Warnings</h3>
                <strong>3</strong>
                <p>All warning records currently attached to this employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">warning</span>
            </div>
        </div>

        <div class="employee-insight-card new-month">
            <div>
                <h3>Attendance Issues</h3>
                <strong>1</strong>
                <p>Warnings related to missing attendance or late reporting.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">event_busy</span>
            </div>
        </div>

        <div class="employee-insight-card leave">
            <div>
                <h3>Low Performance</h3>
                <strong>1</strong>
                <p>Performance warnings requiring manager follow-up.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">monitoring</span>
            </div>
        </div>

        <div class="employee-insight-card least-performing">
            <div>
                <h3>Rule Violations</h3>
                <strong>1</strong>
                <p>Company policy violations and disciplinary notices.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">balance</span>
            </div>
        </div>
    </div>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Employee Warnings</h2>
                <p>Warning history with letters sent to the employee and violation evidence.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-warning-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-warning-sort-key="date">Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-warning-sort-key="type">Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-warning-sort-key="warning">Warning <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-warning-sort-key="issuedBy">Issued By <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-warning-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-date="2026-04-22" data-type="Missing Attendance" data-warning="Unexplained absence recorded" data-issued-by="Asha Mohamed" data-status="Open" data-note="Employee was marked absent without an approved leave request or supervisor exception. HR sent a first attendance warning and requested written explanation." data-letters="first-attendance-warning-letter.pdf|absence-explanation-request.pdf" data-evidence="attendance-log-2026-04-22.pdf|shift-roster-screenshot.png">
                            <td>2026-04-22</td>
                            <td><strong>Missing Attendance</strong></td>
                            <td>Unexplained absence recorded</td>
                            <td>Asha Mohamed</td>
                            <td><span class="employee-status inactive">Open</span></td>
                            <td><button type="button" class="warning-view-btn" data-warning-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-date="2026-04-15" data-type="Low Performance" data-warning="Monthly KPI score below threshold" data-issued-by="Asha Mohamed" data-status="Monitoring" data-note="Monthly KPI score fell below the approved HR threshold. Manager follow-up is active and improvement targets were shared with the employee." data-letters="performance-warning-letter.pdf|improvement-plan-notice.pdf" data-evidence="monthly-kpi-summary-2026-04.pdf|manager-review-notes.pdf">
                            <td>2026-04-15</td>
                            <td><strong>Low Performance</strong></td>
                            <td>Monthly KPI score below threshold</td>
                            <td>Asha Mohamed</td>
                            <td><span class="employee-status late">Monitoring</span></td>
                            <td><button type="button" class="warning-view-btn" data-warning-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-date="2026-03-28" data-type="Rule Violation" data-warning="Late submission of confidential files" data-issued-by="HR Compliance Office" data-status="Closed" data-note="Confidential HR files were submitted after the required deadline. The compliance team reviewed the case and closed it after corrective action." data-letters="compliance-warning-letter.pdf|case-closure-notice.pdf" data-evidence="submission-timeline.pdf|file-receipt-log.pdf">
                            <td>2026-03-28</td>
                            <td><strong>Rule Violation</strong></td>
                            <td>Late submission of confidential files</td>
                            <td>HR Compliance Office</td>
                            <td><span class="employee-status active">Closed</span></td>
                            <td><button type="button" class="warning-view-btn" data-warning-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-warning-table-summary>Showing 1-3 of 3 warnings</span>
                <div class="employee-pagination" data-warning-pagination></div>
            </div>
        </div>
    </section>
</section>

<div class="warning-details-modal" id="warningDetailsModal" aria-hidden="true">
    <div class="warning-details-backdrop" data-warning-details-close></div>
    <section class="warning-details-dialog" role="dialog" aria-modal="true" aria-labelledby="warningDetailsTitle">
        <div class="warning-details-header">
            <div>
                <h2 id="warningDetailsTitle">Warning Details</h2>
                <p id="warningDetailsSubtitle">Warning record details.</p>
            </div>
            <button type="button" class="warning-details-close" data-warning-details-close aria-label="Close warning details">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="warning-details-body">
            <div class="warning-details-summary">
                <article>
                    <span>Warning Type</span>
                    <strong data-warning-detail-type></strong>
                </article>
                <article>
                    <span>Issued Date</span>
                    <strong data-warning-detail-date></strong>
                </article>
                <article>
                    <span>Status</span>
                    <strong data-warning-detail-status></strong>
                </article>
            </div>

            <article class="warning-details-note">
                <span>Warning Note</span>
                <p data-warning-detail-note></p>
            </article>

            <div class="warning-details-files-grid">
                <section>
                    <h3>Letters Sent</h3>
                    <div class="warning-details-file-list" data-warning-detail-letters></div>
                </section>
                <section>
                    <h3>Evidence Files</h3>
                    <div class="warning-details-file-list" data-warning-detail-evidence></div>
                </section>
            </div>
        </div>
    </section>
</div>

<section class="employee-profile-tab-panel" id="leaves" data-employee-tab-panel="leaves">
    <div class="employee-insights-grid">
        <div class="employee-insight-card active">
            <div>
                <h3>Leaves Left</h3>
                <strong>18 Days</strong>
                <p>Current leave balance available to the employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">event_available</span>
            </div>
        </div>

        <div class="employee-insight-card total">
            <div>
                <h3>Leaves Used</h3>
                <strong>12 Days</strong>
                <p>Approved leave days already taken this year.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">calendar_month</span>
            </div>
        </div>

        <div class="employee-insight-card least-performing">
            <div>
                <h3>Rejected Leaves</h3>
                <strong>1 Requests</strong>
                <p>Requests that were declined by management.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">event_busy</span>
            </div>
        </div>

        <div class="employee-insight-card new-month">
            <div>
                <h3>Approved Leaves</h3>
                <strong>3 Requests</strong>
                <p>Leave requests approved for this employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">approval</span>
            </div>
        </div>
    </div>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Leave History</h2>
                <p>Complete leave request list with access to supporting evidence.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-leave-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-leave-sort-key="leaveType">Leave Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-leave-sort-key="appliedOn">Applied On <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-leave-sort-key="startDate">Start Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-leave-sort-key="endDate">End Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-leave-sort-key="days">Days <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-leave-sort-key="reason">Reason <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-leave-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-leave-type="Annual Leave" data-applied-on="2026-03-18" data-start-date="2026-04-02" data-end-date="2026-04-05" data-days="4" data-reason="Family visit in Berbera" data-status="Approved" data-evidence-note="Approved leave letter and travel ticket copy" data-evidence-files="travel-ticket.pdf|approval-letter.pdf">
                            <td><strong>Annual Leave</strong></td>
                            <td>2026-03-18</td>
                            <td>2026-04-02</td>
                            <td>2026-04-05</td>
                            <td>4 Days</td>
                            <td>Family visit in Berbera</td>
                            <td><span class="employee-status active">Approved</span></td>
                            <td><button type="button" class="warning-view-btn" data-leave-evidence-view><span class="material-symbols-rounded">visibility</span><span>View Evidence</span></button></td>
                        </tr>
                        <tr data-leave-type="Sick Leave" data-applied-on="2026-02-07" data-start-date="2026-02-08" data-end-date="2026-02-09" data-days="2" data-reason="Seasonal flu recovery" data-status="Approved" data-evidence-note="Clinic visit note and approved sick leave form" data-evidence-files="clinic-note.pdf|sick-leave-form.pdf">
                            <td><strong>Sick Leave</strong></td>
                            <td>2026-02-07</td>
                            <td>2026-02-08</td>
                            <td>2026-02-09</td>
                            <td>2 Days</td>
                            <td>Seasonal flu recovery</td>
                            <td><span class="employee-status active">Approved</span></td>
                            <td><button type="button" class="warning-view-btn" data-leave-evidence-view><span class="material-symbols-rounded">visibility</span><span>View Evidence</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-leave-table-summary>Showing 1-2 of 2 leaves</span>
                <div class="employee-pagination" data-leave-pagination></div>
            </div>
        </div>
    </section>
</section>

<div class="leave-evidence-modal" id="leaveEvidenceModal" aria-hidden="true">
    <div class="leave-evidence-backdrop" data-leave-evidence-close></div>
    <section class="leave-evidence-dialog" role="dialog" aria-modal="true" aria-labelledby="leaveEvidenceTitle">
        <div class="leave-evidence-header">
            <div>
                <h2 id="leaveEvidenceTitle">Leave Supporting Evidence</h2>
                <p id="leaveEvidenceSubtitle">Leave evidence details.</p>
            </div>
            <button type="button" class="leave-evidence-close" data-leave-evidence-close aria-label="Close leave evidence">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="leave-evidence-body">
            <div class="leave-evidence-summary">
                <article>
                    <span>Leave Type</span>
                    <strong data-leave-evidence-type></strong>
                </article>
                <article>
                    <span>Status</span>
                    <strong data-leave-evidence-status></strong>
                </article>
            </div>

            <article class="leave-evidence-note">
                <span>Evidence Note</span>
                <p data-leave-evidence-note></p>
            </article>

            <section class="leave-evidence-files-section">
                <h3>Attached Files</h3>
                <div class="leave-evidence-file-list" data-leave-evidence-files></div>
            </section>
        </div>
    </section>
</div>

<section class="employee-profile-tab-panel" id="promotion" data-employee-tab-panel="promotion">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Total Promotions</h3>
                <strong>3 Times</strong>
                <p>Number of times the employee has been promoted.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">trending_up</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Last Promotion Date</h3>
                <strong>2024-09-03</strong>
                <p>Most recent approved promotion date on record.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">event_available</span>
            </div>
        </div>

        <div class="employee-insight-card new-month">
            <div>
                <h3>Current Role</h3>
                <strong>Human Resource Officer</strong>
                <p>Employee's current role after promotion updates.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">business_center</span>
            </div>
        </div>
    </div>

    <section class="employee-promotion-timeline-panel">
        <div class="promotion-timeline-header">
            <div>
                <h2>Promotion History</h2>
                <p>Journey through employee role milestones.</p>
            </div>
            <div class="promotion-nav">
                <button type="button" aria-label="Previous promotion"><span class="material-symbols-rounded">chevron_left</span></button>
                <button type="button" aria-label="Next promotion"><span class="material-symbols-rounded">chevron_right</span></button>
            </div>
        </div>

        <div class="promotion-timeline-track" aria-label="Promotion timeline">
            <div class="promotion-node active" style="left: 0%;">
                <span>2021</span>
            </div>
            <div class="promotion-node active" style="left: 48%;">
                <span>2023</span>
            </div>
            <div class="promotion-node active" style="left: 96%;">
                <span>2024</span>
            </div>
        </div>

        <div class="promotion-highlight">
            <div>
                <span class="promotion-branch">Idaacada Branch</span>
                <time>2024-09-03</time>
                <h3>Human Resource Officer</h3>
                <p class="promotion-from">Promoted from HR Executive</p>
                <p>Promoted to current officer role after strong service delivery, policy follow-up, and departmental support.</p>
            </div>
            <div class="promotion-tags">
                <span>Leadership</span>
                <span>Policy Follow-up</span>
                <span>Coordination</span>
            </div>
        </div>

        <div class="promotion-meta">
            <div>
                <span>Promotion Span</span>
                <strong>4 Years</strong>
            </div>
            <div>
                <span>Current Branch</span>
                <strong>Idaacada Branch</strong>
            </div>
        </div>
    </section>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Promotion Documents</h2>
                <p>Promotion details and supporting documents for each employee promotion.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-promotion-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-promotion-sort-key="promotionDate">Promotion Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-promotion-sort-key="fromRole">From Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-promotion-sort-key="toRole">To Role <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-promotion-sort-key="department">Department <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-promotion-sort-key="approvedBy">Approved By <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-promotion-date="2021-06-12" data-from-role="HR Assistant" data-to-role="Senior HR Assistant" data-department="Human Resource" data-approved-by="Asha Mohamed" data-promotion-note="Promotion supported by HR performance review and staff service recommendation." data-promotion-files="hr-performance-review.pdf|service-recommendation.pdf">
                            <td>2021-06-12</td>
                            <td>HR Assistant</td>
                            <td><strong>Senior HR Assistant</strong></td>
                            <td>Human Resource</td>
                            <td>Asha Mohamed</td>
                            <td><button type="button" class="warning-view-btn" data-promotion-documents-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-promotion-date="2023-02-20" data-from-role="Senior HR Assistant" data-to-role="HR Executive" data-department="Human Resource" data-approved-by="Asha Mohamed" data-promotion-note="Promotion approved after department leadership evaluation and improved service delivery report." data-promotion-files="leadership-evaluation.pdf|service-delivery-report.pdf">
                            <td>2023-02-20</td>
                            <td>Senior HR Assistant</td>
                            <td><strong>HR Executive</strong></td>
                            <td>Human Resource</td>
                            <td>Asha Mohamed</td>
                            <td><button type="button" class="warning-view-btn" data-promotion-documents-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-promotion-date="2024-09-03" data-from-role="HR Executive" data-to-role="Human Resource Officer" data-department="Human Resource" data-approved-by="Asha Mohamed" data-promotion-note="Promotion supported by HR service review and final management approval." data-promotion-files="hr-service-review.pdf|management-approval.pdf">
                            <td>2024-09-03</td>
                            <td>HR Executive</td>
                            <td><strong>Human Resource Officer</strong></td>
                            <td>Human Resource</td>
                            <td>Asha Mohamed</td>
                            <td><button type="button" class="warning-view-btn" data-promotion-documents-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-promotion-table-summary>Showing 1-3 of 3 promotions</span>
                <div class="employee-pagination" data-promotion-pagination></div>
            </div>
        </div>
    </section>
</section>

<div class="promotion-documents-modal" id="promotionDocumentsModal" aria-hidden="true">
    <div class="promotion-documents-backdrop" data-promotion-documents-close></div>
    <section class="promotion-documents-dialog" role="dialog" aria-modal="true" aria-labelledby="promotionDocumentsTitle">
        <div class="promotion-documents-header">
            <div>
                <h2 id="promotionDocumentsTitle">Promotion Supporting Documents</h2>
                <p id="promotionDocumentsSubtitle">Promotion document details.</p>
            </div>
            <button type="button" class="promotion-documents-close" data-promotion-documents-close aria-label="Close promotion documents">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="promotion-documents-body">
            <div class="promotion-documents-summary">
                <article>
                    <span>Promotion Date</span>
                    <strong data-promotion-document-date></strong>
                </article>
                <article>
                    <span>Role Change</span>
                    <strong data-promotion-document-role></strong>
                </article>
            </div>

            <article class="promotion-documents-note">
                <span>Promotion Note</span>
                <p data-promotion-document-note></p>
            </article>

            <section class="promotion-documents-files-section">
                <h3>Attached Files</h3>
                <div class="promotion-documents-file-list" data-promotion-document-files></div>
            </section>
        </div>
    </section>
</div>

<section class="employee-profile-tab-panel" id="payroll" data-employee-tab-panel="payroll">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Base Salary</h3>
                <strong>$350</strong>
                <p>Current fixed salary amount for the employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">payments</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Total Bonuses</h3>
                <strong>$78</strong>
                <p>Total bonus value across listed payroll records.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">monetization_on</span>
            </div>
        </div>

        <div class="employee-insight-card least-performing">
            <div>
                <h3>Total Deductions</h3>
                <strong>$26</strong>
                <p>All deductions recorded in the payroll list below.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">request_quote</span>
            </div>
        </div>
    </div>

    <section class="employee-payroll-breakdown-panel">
        <div class="employee-records-header">
            <div>
                <h2>Payroll Breakdown</h2>
                <p>Visual split between base salary, bonuses, and deductions.</p>
            </div>
        </div>

        <div class="payroll-breakdown-layout">
            <div class="payroll-donut-wrap">
                <svg class="payroll-donut" viewBox="0 0 180 180" role="img" aria-label="Payroll breakdown chart">
                    <circle class="payroll-ring base" cx="90" cy="90" r="62" data-chart-title="Base Salary" data-chart-value="$350 fixed monthly salary"></circle>
                    <circle class="payroll-ring bonus" cx="90" cy="90" r="62" data-chart-title="Bonuses" data-chart-value="$78 total approved bonus value"></circle>
                    <circle class="payroll-ring deduction" cx="90" cy="90" r="62" data-chart-title="Deductions" data-chart-value="$26 total deducted from payroll"></circle>
                    <circle class="payroll-ring-hole" cx="90" cy="90" r="42"></circle>
                    <text x="90" y="84" text-anchor="middle">$402</text>
                    <text x="90" y="104" text-anchor="middle">Total</text>
                </svg>
            </div>

            <div class="payroll-breakdown-list">
                <div class="payroll-breakdown-item base">
                    <span></span>
                    <div>
                        <strong>Base Salary</strong>
                        <p>$350 fixed monthly salary</p>
                    </div>
                    <b>87%</b>
                </div>
                <div class="payroll-breakdown-item bonus">
                    <span></span>
                    <div>
                        <strong>Bonuses</strong>
                        <p>$78 total approved bonus value</p>
                    </div>
                    <b>19%</b>
                </div>
                <div class="payroll-breakdown-item deduction">
                    <span></span>
                    <div>
                        <strong>Deductions</strong>
                        <p>$26 total deducted from payroll</p>
                    </div>
                    <b>6%</b>
                </div>
            </div>
        </div>
    </section>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Payroll History</h2>
                <p>Monthly payroll records with reference slip view.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-payroll-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-payroll-sort-key="paymentDate">Payment Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-payroll-sort-key="month">Month <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-payroll-sort-key="baseSalary">Base Salary <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-payroll-sort-key="bonuses">Bonuses <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-payroll-sort-key="deductions">Deductions <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-payroll-sort-key="netPay">Net Pay <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-payment-date="2026-04-30" data-month="April 2026" data-base-salary="350" data-bonuses="25" data-deductions="8" data-net-pay="367" data-payroll-note="Payroll processed with punctuality bonus and light statutory deductions." data-payroll-files="april-payslip.pdf|bank-transfer-reference.pdf">
                            <td>2026-04-30</td><td>April 2026</td><td>$350</td><td>$25</td><td>$8</td><td>$367</td>
                            <td><button type="button" class="warning-view-btn" data-payroll-slip-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-payment-date="2026-03-31" data-month="March 2026" data-base-salary="350" data-bonuses="20" data-deductions="7" data-net-pay="363" data-payroll-note="Payroll processed with monthly performance allowance and standard deductions." data-payroll-files="march-payslip.pdf|bank-transfer-reference.pdf">
                            <td>2026-03-31</td><td>March 2026</td><td>$350</td><td>$20</td><td>$7</td><td>$363</td>
                            <td><button type="button" class="warning-view-btn" data-payroll-slip-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-payment-date="2026-02-28" data-month="February 2026" data-base-salary="350" data-bonuses="18" data-deductions="6" data-net-pay="362" data-payroll-note="Payroll processed with attendance allowance and standard deductions." data-payroll-files="february-payslip.pdf|bank-transfer-reference.pdf">
                            <td>2026-02-28</td><td>February 2026</td><td>$350</td><td>$18</td><td>$6</td><td>$362</td>
                            <td><button type="button" class="warning-view-btn" data-payroll-slip-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-payment-date="2026-01-31" data-month="January 2026" data-base-salary="350" data-bonuses="15" data-deductions="5" data-net-pay="360" data-payroll-note="Payroll processed with monthly allowance and routine deductions." data-payroll-files="january-payslip.pdf|bank-transfer-reference.pdf">
                            <td>2026-01-31</td><td>January 2026</td><td>$350</td><td>$15</td><td>$5</td><td>$360</td>
                            <td><button type="button" class="warning-view-btn" data-payroll-slip-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-payroll-table-summary>Showing 1-4 of 4 payroll records</span>
                <div class="employee-pagination" data-payroll-pagination></div>
            </div>
        </div>
    </section>
</section>

<div class="payroll-slip-modal" id="payrollSlipModal" aria-hidden="true">
    <div class="payroll-slip-backdrop" data-payroll-slip-close></div>
    <section class="payroll-slip-dialog" role="dialog" aria-modal="true" aria-labelledby="payrollSlipTitle">
        <div class="payroll-slip-header">
            <div>
                <h2 id="payrollSlipTitle">Payment Slip</h2>
                <p id="payrollSlipSubtitle">Payroll reference details.</p>
            </div>
            <button type="button" class="payroll-slip-close" data-payroll-slip-close aria-label="Close payment slip">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="payroll-slip-body">
            <div class="payroll-slip-summary">
                <article>
                    <span>Payment Date</span>
                    <strong data-payroll-slip-date></strong>
                </article>
                <article>
                    <span>Month</span>
                    <strong data-payroll-slip-month></strong>
                </article>
                <article>
                    <span>Base Salary</span>
                    <strong data-payroll-slip-base></strong>
                </article>
                <article>
                    <span>Net Pay</span>
                    <strong data-payroll-slip-net></strong>
                </article>
                <article>
                    <span>Bonuses</span>
                    <strong data-payroll-slip-bonuses></strong>
                </article>
                <article>
                    <span>Deductions</span>
                    <strong data-payroll-slip-deductions></strong>
                </article>
            </div>

            <article class="payroll-slip-note">
                <span>Reference Note</span>
                <p data-payroll-slip-note></p>
            </article>

            <section class="payroll-slip-files-section">
                <h3>Attached References</h3>
                <div class="payroll-slip-file-list" data-payroll-slip-files></div>
            </section>
        </div>
    </section>
</div>

<section class="employee-profile-tab-panel" id="training" data-employee-tab-panel="training">
    <div class="employee-insights-grid">
        <div class="employee-insight-card active">
            <div>
                <h3>Trainings Completed</h3>
                <strong>3</strong>
                <p>Training sessions completed by the employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">school</span>
            </div>
        </div>

        <div class="employee-insight-card total">
            <div>
                <h3>Average Score</h3>
                <strong>78%</strong>
                <p>Average score across completed and graded trainings.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">analytics</span>
            </div>
        </div>

        <div class="employee-insight-card new-month">
            <div>
                <h3>Passed</h3>
                <strong>2</strong>
                <p>Trainings passed successfully by the employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">check_circle</span>
            </div>
        </div>

        <div class="employee-insight-card least-performing">
            <div>
                <h3>Failed</h3>
                <strong>1</strong>
                <p>Trainings marked as failed or not passed.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">cancel</span>
            </div>
        </div>

        <div class="employee-insight-card leave">
            <div>
                <h3>Ongoing</h3>
                <strong>1</strong>
                <p>Trainings still pending or currently ongoing.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">progress_activity</span>
            </div>
        </div>
    </div>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Training History</h2>
                <p>Training list with provider, date, score, and completion status.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-training-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-training-sort-key="training">Training <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-training-sort-key="provider">Provider <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-training-sort-key="date">Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-training-sort-key="score">Score <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-training-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-training="Workplace Ethics & Compliance" data-provider="HR Academy" data-date="2026-02-10" data-score="91" data-status="Passed" data-training-note="Certificate issued after successfully completing the ethics and compliance assessment." data-training-files="ethics-certificate.pdf">
                            <td><strong>Workplace Ethics & Compliance</strong></td>
                            <td>HR Academy</td>
                            <td>2026-02-10</td>
                            <td>91%</td>
                            <td><span class="employee-status active">Passed</span></td>
                            <td><button type="button" class="warning-view-btn" data-training-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-training="Employee Records Management" data-provider="Talent Hub" data-date="2026-01-18" data-score="88" data-status="Passed" data-training-note="Completion certificate issued after passing employee file handling and record compliance modules." data-training-files="records-management-certificate.pdf">
                            <td><strong>Employee Records Management</strong></td>
                            <td>Talent Hub</td>
                            <td>2026-01-18</td>
                            <td>88%</td>
                            <td><span class="employee-status active">Passed</span></td>
                            <td><button type="button" class="warning-view-btn" data-training-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-training="Conflict Resolution Basics" data-provider="People First Institute" data-date="2025-12-06" data-score="54" data-status="Failed" data-training-note="Assessment result did not meet the required pass score. Re-enrollment was recommended by HR training office." data-training-files="conflict-resolution-result.pdf">
                            <td><strong>Conflict Resolution Basics</strong></td>
                            <td>People First Institute</td>
                            <td>2025-12-06</td>
                            <td>54%</td>
                            <td><span class="employee-status inactive">Failed</span></td>
                            <td><button type="button" class="warning-view-btn" data-training-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                        <tr data-training="Leadership Development Workshop" data-provider="HR Academy" data-date="2026-05-06" data-score="0" data-status="Pending" data-training-note="Training registration is active and certificate will be attached after successful completion." data-training-files="leadership-workshop-registration.pdf">
                            <td><strong>Leadership Development Workshop</strong></td>
                            <td>HR Academy</td>
                            <td>2026-05-06</td>
                            <td>--</td>
                            <td><span class="employee-status leave">Pending</span></td>
                            <td><button type="button" class="warning-view-btn" data-training-details-view><span class="material-symbols-rounded">visibility</span><span>View</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-training-table-summary>Showing 1-4 of 4 trainings</span>
                <div class="employee-pagination" data-training-pagination></div>
            </div>
        </div>
    </section>
</section>

<div class="training-details-modal" id="trainingDetailsModal" aria-hidden="true">
    <div class="training-details-backdrop" data-training-details-close></div>
    <section class="training-details-dialog" role="dialog" aria-modal="true" aria-labelledby="trainingDetailsTitle">
        <div class="training-details-header">
            <div>
                <h2 id="trainingDetailsTitle">Training Details</h2>
                <p id="trainingDetailsSubtitle">Training reference details.</p>
            </div>
            <button type="button" class="training-details-close" data-training-details-close aria-label="Close training details">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>

        <div class="training-details-body">
            <div class="training-details-summary">
                <article>
                    <span>Training</span>
                    <strong data-training-detail-name></strong>
                </article>
                <article>
                    <span>Status</span>
                    <strong data-training-detail-status></strong>
                </article>
            </div>

            <article class="training-details-note">
                <span>Certificate</span>
                <p data-training-detail-note></p>
            </article>

            <section class="training-details-files-section">
                <h3>References</h3>
                <div class="training-details-file-list" data-training-detail-files></div>
            </section>
        </div>
    </section>
</div>

<section class="employee-profile-tab-panel" id="pension" data-employee-tab-panel="pension">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Fund Balance</h3>
                <strong>$1,834</strong>
                <p>Current accumulated pension balance.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">account_balance_wallet</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Employee Share</h3>
                <strong>$72</strong>
                <p>Total contribution made by the employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">health_and_safety</span>
            </div>
        </div>

        <div class="employee-insight-card new-month">
            <div>
                <h3>Employer Share</h3>
                <strong>$100</strong>
                <p>Total contribution covered by the employer.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">business_center</span>
            </div>
        </div>

        <div class="employee-insight-card leave">
            <div>
                <h3>Vesting Status</h3>
                <strong>Fully Vested</strong>
                <p>Current vesting stage of the pension plan.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">verified_user</span>
            </div>
        </div>
    </div>

    <section class="employee-beneficiaries-panel">
        <div class="employee-records-header">
            <div>
                <h2>Beneficiaries</h2>
                <p>Registered pension beneficiaries including spouse and children.</p>
            </div>
        </div>

        <div class="beneficiary-grid">
            <div class="beneficiary-card">
                <div class="beneficiary-header">
                    <span class="beneficiary-avatar material-symbols-rounded">favorite</span>
                    <div>
                        <strong>Amina Hassan</strong>
                        <span>Wife</span>
                    </div>
                    <b>40%</b>
                </div>
                <div class="beneficiary-progress"><span style="width: 40%;"></span></div>
                <p>Beneficiary allocation under the current pension nomination.</p>
            </div>

            <div class="beneficiary-card">
                <div class="beneficiary-header">
                    <span class="beneficiary-avatar material-symbols-rounded">family_restroom</span>
                    <div>
                        <strong>Ahmed Cabdiraxmaan</strong>
                        <span>Son</span>
                    </div>
                    <b>30%</b>
                </div>
                <div class="beneficiary-progress"><span style="width: 30%;"></span></div>
                <p>Beneficiary allocation under the current pension nomination.</p>
            </div>

            <div class="beneficiary-card">
                <div class="beneficiary-header">
                    <span class="beneficiary-avatar material-symbols-rounded">diversity_1</span>
                    <div>
                        <strong>Hibo Cabdiraxmaan</strong>
                        <span>Daughter</span>
                    </div>
                    <b>30%</b>
                </div>
                <div class="beneficiary-progress"><span style="width: 30%;"></span></div>
                <p>Beneficiary allocation under the current pension nomination.</p>
            </div>
        </div>
    </section>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Contribution History</h2>
                <p>Monthly pension contribution history for the employee and employer.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-pension-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-pension-sort-key="month">Month <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-pension-sort-key="contributionDate">Contribution Date <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-pension-sort-key="employeeShare">Employee Share <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-pension-sort-key="employerShare">Employer Share <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-pension-sort-key="total">Total <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-pension-sort-key="fundBalance">Fund Balance <span class="material-symbols-rounded">unfold_more</span></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-month="January 2026" data-contribution-date="2026-01-31" data-employee-share="18" data-employer-share="25" data-total="43" data-fund-balance="1705"><td>January 2026</td><td>2026-01-31</td><td>$18</td><td>$25</td><td><strong>$43</strong></td><td>$1,705</td></tr>
                        <tr data-month="February 2026" data-contribution-date="2026-02-28" data-employee-share="18" data-employer-share="25" data-total="43" data-fund-balance="1748"><td>February 2026</td><td>2026-02-28</td><td>$18</td><td>$25</td><td><strong>$43</strong></td><td>$1,748</td></tr>
                        <tr data-month="March 2026" data-contribution-date="2026-03-31" data-employee-share="18" data-employer-share="25" data-total="43" data-fund-balance="1791"><td>March 2026</td><td>2026-03-31</td><td>$18</td><td>$25</td><td><strong>$43</strong></td><td>$1,791</td></tr>
                        <tr data-month="April 2026" data-contribution-date="2026-04-30" data-employee-share="18" data-employer-share="25" data-total="43" data-fund-balance="1834"><td>April 2026</td><td>2026-04-30</td><td>$18</td><td>$25</td><td><strong>$43</strong></td><td>$1,834</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-pension-table-summary>Showing 1-4 of 4 contributions</span>
                <div class="employee-pagination" data-pension-pagination></div>
            </div>
        </div>
    </section>
</section>

<section class="employee-profile-tab-panel" id="roster" data-employee-tab-panel="roster">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Current Shift</h3>
                <strong>Morning Shift</strong>
                <p>Assigned shift currently active for this employee.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">schedule</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Current Status</h3>
                <strong>On Duty</strong>
                <p>Live roster state based on the latest duty assignment.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">person_check</span>
            </div>
        </div>

        <div class="employee-insight-card leave">
            <div>
                <h3>Swap Request</h3>
                <strong>1 Open</strong>
                <p>Total open or recent roster swap requests.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">sync</span>
            </div>
        </div>

        <div class="employee-insight-card new-month">
            <div>
                <h3>Assigned Group</h3>
                <strong>Group A</strong>
                <p>Current duty team or rotation group assignment.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">groups</span>
            </div>
        </div>
    </div>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Weekly Duty Roster</h2>
                <p>Assigned weekly duty schedule for the employee.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-roster-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-roster-sort-key="day">Day <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-roster-sort-key="shift">Shift <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-roster-sort-key="time">Time <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-roster-sort-key="location">Location <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-roster-sort-key="group">Group <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-roster-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-day="1" data-shift="Morning Shift" data-time="08:00" data-location="Idaacada Branch" data-group="Group A" data-status="Assigned"><td>Monday</td><td>Morning Shift</td><td>08:00 AM - 04:00 PM</td><td>Idaacada Branch</td><td>Group A</td><td><span class="employee-status active">Assigned</span></td></tr>
                        <tr data-day="2" data-shift="Morning Shift" data-time="08:00" data-location="Idaacada Branch" data-group="Group A" data-status="Assigned"><td>Tuesday</td><td>Morning Shift</td><td>08:00 AM - 04:00 PM</td><td>Idaacada Branch</td><td>Group A</td><td><span class="employee-status active">Assigned</span></td></tr>
                        <tr data-day="3" data-shift="Morning Shift" data-time="08:00" data-location="Idaacada Branch" data-group="Group A" data-status="Assigned"><td>Wednesday</td><td>Morning Shift</td><td>08:00 AM - 04:00 PM</td><td>Idaacada Branch</td><td>Group A</td><td><span class="employee-status active">Assigned</span></td></tr>
                        <tr data-day="4" data-shift="Morning Shift" data-time="08:00" data-location="Idaacada Branch" data-group="Group A" data-status="Assigned"><td>Thursday</td><td>Morning Shift</td><td>08:00 AM - 04:00 PM</td><td>Idaacada Branch</td><td>Group A</td><td><span class="employee-status active">Assigned</span></td></tr>
                        <tr data-day="5" data-shift="Half Day" data-time="08:00" data-location="Idaacada Branch" data-group="Group A" data-status="Assigned"><td>Friday</td><td>Half Day</td><td>08:00 AM - 01:00 PM</td><td>Idaacada Branch</td><td>Group A</td><td><span class="employee-status active">Assigned</span></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-roster-table-summary>Showing 1-5 of 5 roster days</span>
                <div class="employee-pagination" data-roster-pagination></div>
            </div>
        </div>
    </section>

    <div class="roster-activity-grid">
        <section class="employee-basic-panel roster-activity-panel">
            <div class="employee-records-header">
                <div>
                    <h2>Recent Duty Assignments</h2>
                    <p>Latest shifts and duty allocations assigned to the employee.</p>
                </div>
            </div>

            <div class="roster-activity-list">
                <article class="roster-activity-card">
                    <div>
                        <strong>Morning Shift</strong>
                        <time datetime="2026-04-25">2026-04-25</time>
                        <p>Admissions Desk Coverage</p>
                        <span>Assigned by Asha Mohamed</span>
                    </div>
                    <b>Duty</b>
                </article>

                <article class="roster-activity-card">
                    <div>
                        <strong>Morning Shift</strong>
                        <time datetime="2026-04-24">2026-04-24</time>
                        <p>Staff File Verification</p>
                        <span>Assigned by HR Office</span>
                    </div>
                    <b>Duty</b>
                </article>
            </div>
        </section>

        <section class="employee-basic-panel roster-activity-panel">
            <div class="employee-records-header">
                <div>
                    <h2>Swap Requests</h2>
                    <p>Recent submitted or reviewed shift swap requests.</p>
                </div>
            </div>

            <div class="roster-activity-list">
                <article class="roster-activity-card">
                    <div>
                        <strong>Friday Morning Shift</strong>
                        <time datetime="2026-04-24">2026-04-24</time>
                        <p>Requested swap with Fadumo Xasan</p>
                    </div>
                    <span class="employee-status leave">Pending</span>
                </article>

                <article class="roster-activity-card">
                    <div>
                        <strong>Wednesday Morning Shift</strong>
                        <time datetime="2026-04-18">2026-04-18</time>
                        <p>Swap approved with Mahad Axmed</p>
                    </div>
                    <span class="employee-status active">Approved</span>
                </article>
            </div>
        </section>
    </div>
</section>

<section class="employee-profile-tab-panel" id="documents" data-employee-tab-panel="documents">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Qualifications</h3>
                <strong><?php echo $employeeDocumentCount ? $employeeQualificationCount : 1; ?></strong>
                <p>Academic and professional qualifications on file.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">school</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Certificates</h3>
                <strong><?php echo $employeeDocumentCount ? $employeeCertificateCount : 1; ?></strong>
                <p>Issued certificates and professional course evidence.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">workspace_premium</span>
            </div>
        </div>

        <div class="employee-insight-card leave">
            <div>
                <h3>Identity Docs</h3>
                <strong><?php echo $employeeDocumentCount ? $employeeIdentityCount : 1; ?></strong>
                <p>Identity and compliance documents currently available.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">badge</span>
            </div>
        </div>
    </div>

    <section class="employee-records-section">
        <div class="employee-records-header">
            <div>
                <h2>Documents & Qualifications</h2>
                <p>Employee document register with uploaded files and profile document previews.</p>
            </div>
        </div>

        <div class="employee-table-panel" data-document-table>
            <div class="employee-table-scroll">
                <table class="employee-data-table">
                    <thead>
                        <tr>
                            <th><button type="button" data-document-sort-key="type">Type <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-document-sort-key="document">Document <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-document-sort-key="category">Category <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-document-sort-key="status">Status <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th><button type="button" data-document-sort-key="updated">Updated <span class="material-symbols-rounded">unfold_more</span></button></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($employeeDocuments): ?>
                            <?php foreach ($employeeDocuments as $document): ?>
                            <tr data-type="<?php echo htmlspecialchars($document['type'] ?? ''); ?>" data-document="<?php echo htmlspecialchars($document['document'] ?? ''); ?>" data-category="<?php echo htmlspecialchars($document['category'] ?? ''); ?>" data-status="<?php echo htmlspecialchars($document['status'] ?? ''); ?>" data-updated="<?php echo htmlspecialchars($document['updated'] ?? ''); ?>" data-doc-key="<?php echo htmlspecialchars($document['key'] ?? ''); ?>">
                                <td><strong><?php echo htmlspecialchars($document['type'] ?? ''); ?></strong></td>
                                <td><?php echo htmlspecialchars($document['original_name'] ?? ($document['document'] ?? '')); ?></td>
                                <td><?php echo htmlspecialchars($document['category'] ?? ''); ?></td>
                                <td><span class="employee-status active"><?php echo htmlspecialchars($document['status'] ?? 'Uploaded'); ?></span></td>
                                <td><?php echo htmlspecialchars($document['updated'] ?? ''); ?></td>
                                <td><a class="warning-view-btn" href="<?php echo htmlspecialchars($document['url'] ?? '#'); ?>" target="_blank" rel="noopener"><span class="material-symbols-rounded">open_in_new</span> Open</a></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr data-type="CV" data-document="Employee CV" data-category="Profile" data-status="Verified" data-updated="2026-04-14" data-doc-key="cv"><td><strong>CV</strong></td><td>Employee CV</td><td>Profile</td><td><span class="employee-status active">Verified</span></td><td>2026-04-14</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="National ID Card" data-document="National ID Card" data-category="Identity" data-status="Verified" data-updated="2026-01-18" data-doc-key="national-id"><td><strong>National ID Card</strong></td><td>National ID Card</td><td>Identity</td><td><span class="employee-status active">Verified</span></td><td>2026-01-18</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="Certificate" data-document="HR Compliance Certificate" data-category="Professional" data-status="Verified" data-updated="2026-03-21" data-doc-key="certificate"><td><strong>Certificate</strong></td><td>HR Compliance Certificate</td><td>Professional</td><td><span class="employee-status active">Verified</span></td><td>2026-03-21</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="Approval Letter" data-document="Promotion Approval Letter" data-category="Approval" data-status="Verified" data-updated="2026-04-08" data-doc-key="approval-letter"><td><strong>Approval Letter</strong></td><td>Promotion Approval Letter</td><td>Approval</td><td><span class="employee-status active">Verified</span></td><td>2026-04-08</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="Recommendation Letter" data-document="Recommendation Letter" data-category="Reference" data-status="Verified" data-updated="2026-02-22" data-doc-key="recommendation-letter"><td><strong>Recommendation Letter</strong></td><td>Recommendation Letter</td><td>Reference</td><td><span class="employee-status active">Verified</span></td><td>2026-02-22</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="Employee Contract" data-document="Employee Contract" data-category="Employment" data-status="Pending Review" data-updated="2026-02-05" data-doc-key="employee-contract"><td><strong>Employee Contract</strong></td><td>Employee Contract</td><td>Employment</td><td><span class="employee-status leave">Pending Review</span></td><td>2026-02-05</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="Honor Certificate" data-document="Honor Certificate" data-category="Recognition" data-status="Verified" data-updated="2026-04-20" data-doc-key="honor-certificate"><td><strong>Honor Certificate</strong></td><td>Honor Certificate</td><td>Recognition</td><td><span class="employee-status active">Verified</span></td><td>2026-04-20</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <tr data-type="Qualification" data-document="Bachelor of Business Administration" data-category="Academic" data-status="Verified" data-updated="2026-04-12" data-doc-key="certificate"><td><strong>Qualification</strong></td><td>Bachelor of Business Administration</td><td>Academic</td><td><span class="employee-status active">Verified</span></td><td>2026-04-12</td><td><button type="button" class="warning-view-btn" data-document-view><span class="material-symbols-rounded">visibility</span> View</button></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="employee-table-footer">
                <span data-document-table-summary>Showing 1-4 of <?php echo $employeeDocumentCount ?: 8; ?> documents</span>
                <div class="employee-pagination" data-document-pagination></div>
            </div>
        </div>
    </section>
</section>

<section class="employee-profile-tab-panel" id="job-experience" data-employee-tab-panel="job-experience">
    <section class="employee-basic-panel job-experience-skills-panel">
        <div class="employee-records-header">
            <div>
                <h2>Professional Skills</h2>
                <p>Core competencies and technical expertise of the employee.</p>
            </div>
        </div>

        <div class="job-skill-cloud" aria-label="Professional skills">
            <span class="skill-primary">HR Policy Development</span>
            <span class="skill-primary">Talent Acquisition</span>
            <span class="skill-primary">Performance Management</span>
            <span class="skill-success">Employee Relations</span>
            <span class="skill-success">Conflict Resolution</span>
            <span class="skill-info">Payroll Administration</span>
            <span class="skill-info">Labour Law Compliance</span>
            <span class="skill-warning">Staff Training</span>
            <span class="skill-warning">Organizational Development</span>
            <span class="skill-purple">HRMS Software</span>
        </div>
    </section>

    <section class="employee-basic-panel job-roadmap-panel">
        <div class="employee-records-header">
            <div>
                <h2>Career Roadmap</h2>
                <p>Previous organizations and roles held by the employee.</p>
            </div>
        </div>

        <div class="job-roadmap-list">
            <article class="job-roadmap-item current">
                <div class="job-roadmap-marker">
                    <span class="material-symbols-rounded">business_center</span>
                </div>
                <div class="job-roadmap-card">
                    <div>
                        <h3>Human Resource Director</h3>
                        <strong>HRMS Somaliland (Current)</strong>
                        <p>Overseeing all HR operations at Idaacada Branch including recruitment, employee relations, payroll, and compliance with local labour standards.</p>
                    </div>
                    <time datetime="2024-01">Jan 2024 - Present</time>
                </div>
            </article>

            <article class="job-roadmap-item success">
                <div class="job-roadmap-marker">
                    <span class="material-symbols-rounded">business_center</span>
                </div>
                <div class="job-roadmap-card">
                    <div>
                        <h3>Senior HR Officer</h3>
                        <strong>Somaliland Civil Service Commission</strong>
                        <p>Managed recruitment drives, policy documentation, staff welfare programs, and inter-departmental coordination for government ministry staffing needs.</p>
                    </div>
                    <time datetime="2021-03">Mar 2021 - Dec 2023</time>
                </div>
            </article>

            <article class="job-roadmap-item warning">
                <div class="job-roadmap-marker">
                    <span class="material-symbols-rounded">business_center</span>
                </div>
                <div class="job-roadmap-card">
                    <div>
                        <h3>HR Assistant</h3>
                        <strong>Dahabshiil Group - Hargeisa</strong>
                        <p>Supported HR administration tasks including contract management, attendance tracking, employee records maintenance, and onboarding coordination.</p>
                    </div>
                    <time datetime="2018-06">Jun 2018 - Feb 2021</time>
                </div>
            </article>
        </div>
    </section>
</section>

<section class="employee-profile-tab-panel" id="academic-background" data-employee-tab-panel="academic-background">
    <div class="employee-insights-grid">
        <div class="employee-insight-card total">
            <div>
                <h3>Degrees</h3>
                <strong>2</strong>
                <p>Formal academic degrees on record.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">school</span>
            </div>
        </div>

        <div class="employee-insight-card active">
            <div>
                <h3>Certificates</h3>
                <strong>3</strong>
                <p>Professional certificates earned.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">workspace_premium</span>
            </div>
        </div>

        <div class="employee-insight-card least-performing">
            <div>
                <h3>Highest Level</h3>
                <strong>Master's</strong>
                <p>Highest academic qualification attained.</p>
            </div>
            <div class="employee-insight-icon">
                <span class="material-symbols-rounded">school</span>
            </div>
        </div>
    </div>

    <section class="employee-basic-panel academic-history-panel">
        <div class="employee-records-header">
            <div>
                <h2>Education History</h2>
                <p>Academic qualifications ordered from most recent.</p>
            </div>
        </div>

        <div class="academic-history-list">
            <article class="academic-history-card primary">
                <div class="academic-history-icon">
                    <span class="material-symbols-rounded">school</span>
                </div>
                <div>
                    <h3>Master of Business Administration (MBA)</h3>
                    <strong>University of Hargeisa - Hargeisa, Somaliland</strong>
                    <p>Major: Human Resource Management. GPA: 3.8/4.0. Thesis: Effective HR Practices in Developing Economies.</p>
                </div>
                <time datetime="2019">2019 - 2021</time>
            </article>

            <article class="academic-history-card success">
                <div class="academic-history-icon">
                    <span class="material-symbols-rounded">school</span>
                </div>
                <div>
                    <h3>Bachelor of Arts - Management Studies</h3>
                    <strong>Amoud University - Borama, Somaliland</strong>
                    <p>Focus: Organizational Behaviour and Public Administration. Graduated with Honours.</p>
                </div>
                <time datetime="2015">2015 - 2018</time>
            </article>

            <article class="academic-history-card warning">
                <div class="academic-history-icon">
                    <span class="material-symbols-rounded">workspace_premium</span>
                </div>
                <div>
                    <h3>Certificate in HR Leadership</h3>
                    <strong>Alpha Training Institute - Hargeisa, Somaliland</strong>
                    <p>6-month professional development course covering leadership, team dynamics, and advanced HR analytics.</p>
                </div>
                <time datetime="2022">2022</time>
            </article>

            <article class="academic-history-card info">
                <div class="academic-history-icon">
                    <span class="material-symbols-rounded">workspace_premium</span>
                </div>
                <div>
                    <h3>Certificate in Labour Law & Compliance</h3>
                    <strong>Somaliland Business School - Hargeisa</strong>
                    <p>Covered Somaliland labour regulations, employee rights, contract law, and HR compliance frameworks.</p>
                </div>
                <time datetime="2020">2020</time>
            </article>

            <article class="academic-history-card purple">
                <div class="academic-history-icon">
                    <span class="material-symbols-rounded">workspace_premium</span>
                </div>
                <div>
                    <h3>Certificate in HRMS & Payroll Systems</h3>
                    <strong>TechBridge Academy - Hargeisa, Somaliland</strong>
                    <p>Practical training on digital HR management systems, payroll processing software, and data-driven workforce planning.</p>
                </div>
                <time datetime="2023">2023</time>
            </article>
        </div>
    </section>
</section>

<!-- Document preview modal: one reusable modal for every document row in the Documents tab. -->
<style>
    .warning-details-modal {
        position: fixed;
        inset: 0;
        z-index: 680;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .warning-details-modal.open {
        display: flex;
    }

    .warning-details-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    .warning-details-dialog {
        position: relative;
        width: min(980px, 100%);
        max-height: min(780px, calc(100vh - 64px));
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .warning-details-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid var(--neutral-border);
    }

    .warning-details-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .warning-details-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .warning-details-close {
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

    .warning-details-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .warning-details-body {
        overflow: auto;
        padding: 32px;
    }

    .warning-details-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .warning-details-summary article,
    .warning-details-note,
    .warning-details-file-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
    }

    .warning-details-summary article {
        padding: 22px;
    }

    .warning-details-summary span,
    .warning-details-note span,
    .warning-details-files-grid h3 {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .warning-details-summary strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        margin-top: 14px;
    }

    .warning-details-note {
        padding: 22px;
        margin-bottom: 24px;
    }

    .warning-details-note p {
        color: var(--neutral-dark);
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.55;
        margin-top: 14px;
    }

    .warning-details-files-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(260px, 1fr));
        gap: 24px;
    }

    .warning-details-file-list {
        display: grid;
        gap: 14px;
        margin-top: 14px;
    }

    .warning-details-file-card {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: 14px;
        align-items: center;
        padding: 16px;
    }

    .warning-details-file-card i {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: var(--warning-light);
        color: var(--warning-hover);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
    }

    .warning-details-file-card.evidence i {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .warning-details-file-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.96rem;
    }

    .warning-details-file-card span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 4px;
    }

    .leave-evidence-modal {
        position: fixed;
        inset: 0;
        z-index: 680;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .leave-evidence-modal.open {
        display: flex;
    }

    .leave-evidence-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    .leave-evidence-dialog {
        position: relative;
        width: min(860px, 100%);
        max-height: min(720px, calc(100vh - 64px));
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .leave-evidence-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid var(--neutral-border);
    }

    .leave-evidence-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .leave-evidence-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .leave-evidence-close {
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

    .leave-evidence-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .leave-evidence-body {
        overflow: auto;
        padding: 32px;
    }

    .leave-evidence-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .leave-evidence-summary article,
    .leave-evidence-note,
    .leave-evidence-file-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
    }

    .leave-evidence-summary article,
    .leave-evidence-note {
        padding: 22px;
    }

    .leave-evidence-summary span,
    .leave-evidence-note span,
    .leave-evidence-files-section h3 {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .leave-evidence-summary strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        margin-top: 14px;
    }

    .leave-evidence-note {
        margin-bottom: 24px;
    }

    .leave-evidence-note p {
        color: var(--neutral-dark);
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.55;
        margin-top: 14px;
    }

    .leave-evidence-file-list {
        display: grid;
        gap: 14px;
        margin-top: 14px;
    }

    .leave-evidence-file-card {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: 14px;
        align-items: center;
        padding: 16px;
    }

    .leave-evidence-file-card i {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(99, 102, 241, 0.08);
        color: #4f46e5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
    }

    .leave-evidence-file-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.96rem;
    }

    .leave-evidence-file-card span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 4px;
    }

    .promotion-documents-modal {
        position: fixed;
        inset: 0;
        z-index: 680;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .promotion-documents-modal.open {
        display: flex;
    }

    .promotion-documents-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    .promotion-documents-dialog {
        position: relative;
        width: min(860px, 100%);
        max-height: min(720px, calc(100vh - 64px));
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .promotion-documents-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid var(--neutral-border);
    }

    .promotion-documents-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .promotion-documents-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .promotion-documents-close {
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

    .promotion-documents-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .promotion-documents-body {
        overflow: auto;
        padding: 32px;
    }

    .promotion-documents-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .promotion-documents-summary article,
    .promotion-documents-note,
    .promotion-documents-file-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
    }

    .promotion-documents-summary article,
    .promotion-documents-note {
        padding: 22px;
    }

    .promotion-documents-summary span,
    .promotion-documents-note span,
    .promotion-documents-files-section h3 {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .promotion-documents-summary strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        margin-top: 14px;
    }

    .promotion-documents-note {
        margin-bottom: 24px;
    }

    .promotion-documents-note p {
        color: var(--neutral-dark);
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.55;
        margin-top: 14px;
    }

    .promotion-documents-file-list {
        display: grid;
        gap: 14px;
        margin-top: 14px;
    }

    .promotion-documents-file-card {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: 14px;
        align-items: center;
        padding: 16px;
    }

    .promotion-documents-file-card i {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(99, 102, 241, 0.08);
        color: #4f46e5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
    }

    .promotion-documents-file-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.96rem;
    }

    .promotion-documents-file-card span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 4px;
    }

    .payroll-slip-modal {
        position: fixed;
        inset: 0;
        z-index: 680;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .payroll-slip-modal.open {
        display: flex;
    }

    .payroll-slip-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    .payroll-slip-dialog {
        position: relative;
        width: min(760px, 100%);
        max-height: min(720px, calc(100vh - 64px));
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .payroll-slip-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid var(--neutral-border);
    }

    .payroll-slip-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .payroll-slip-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .payroll-slip-close {
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

    .payroll-slip-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .payroll-slip-body {
        overflow: auto;
        padding: 32px;
    }

    .payroll-slip-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .payroll-slip-summary article,
    .payroll-slip-note,
    .payroll-slip-file-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
    }

    .payroll-slip-summary article,
    .payroll-slip-note {
        padding: 22px;
    }

    .payroll-slip-summary span,
    .payroll-slip-note span,
    .payroll-slip-files-section h3 {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .payroll-slip-summary strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        margin-top: 14px;
    }

    .payroll-slip-note {
        margin-bottom: 24px;
    }

    .payroll-slip-note p {
        color: var(--neutral-dark);
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.55;
        margin-top: 14px;
    }

    .payroll-slip-file-list {
        display: grid;
        gap: 14px;
        margin-top: 14px;
    }

    .payroll-slip-file-card {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: 14px;
        align-items: center;
        padding: 16px;
    }

    .payroll-slip-file-card i {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(99, 102, 241, 0.08);
        color: #4f46e5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
    }

    .payroll-slip-file-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.96rem;
    }

    .payroll-slip-file-card span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 4px;
    }

    .training-details-modal {
        position: fixed;
        inset: 0;
        z-index: 680;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 32px;
    }

    .training-details-modal.open {
        display: flex;
    }

    .training-details-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    .training-details-dialog {
        position: relative;
        width: min(860px, 100%);
        max-height: min(720px, calc(100vh - 64px));
        background-color: var(--neutral-white);
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-lg);
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .training-details-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        padding: 28px 32px;
        border-bottom: 1px solid var(--neutral-border);
    }

    .training-details-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .training-details-header p {
        color: var(--neutral-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .training-details-close {
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

    .training-details-close:hover {
        background-color: var(--secondary-color);
        color: var(--neutral-white);
    }

    .training-details-body {
        overflow: auto;
        padding: 32px;
    }

    .training-details-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .training-details-summary article,
    .training-details-note,
    .training-details-file-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
    }

    .training-details-summary article,
    .training-details-note {
        padding: 22px;
    }

    .training-details-summary span,
    .training-details-note span,
    .training-details-files-section h3 {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .training-details-summary strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 1.08rem;
        margin-top: 14px;
    }

    .training-details-note {
        margin-bottom: 24px;
    }

    .training-details-note p {
        color: var(--neutral-dark);
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.55;
        margin-top: 14px;
    }

    .training-details-file-list {
        display: grid;
        gap: 14px;
        margin-top: 14px;
    }

    .training-details-file-card {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: 14px;
        align-items: center;
        padding: 16px;
    }

    .training-details-file-card i {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(99, 102, 241, 0.08);
        color: #4f46e5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-style: normal;
    }

    .training-details-file-card strong {
        color: var(--neutral-dark);
        display: block;
        font-size: 0.96rem;
    }

    .training-details-file-card span {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 4px;
    }

    .job-experience-skills-panel,
    .job-roadmap-panel,
    .academic-history-panel {
        margin-bottom: 32px;
    }

    .academic-history-list {
        display: grid;
        gap: 20px;
        margin-top: 28px;
    }

    .academic-history-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
        display: grid;
        grid-template-columns: 74px 1fr auto;
        align-items: center;
        gap: 22px;
        padding: 24px 28px;
    }

    .academic-history-icon {
        width: 58px;
        height: 58px;
        border-radius: var(--radius-md);
        background-color: #4f46e5;
        color: var(--neutral-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 12px 24px rgba(79, 70, 229, 0.14);
    }

    .academic-history-icon .material-symbols-rounded {
        font-size: 28px;
    }

    .academic-history-card h3 {
        color: var(--neutral-darkest);
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .academic-history-card strong {
        color: #4f46e5;
        display: block;
        font-size: 0.96rem;
        margin-bottom: 10px;
    }

    .academic-history-card p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.55;
    }

    .academic-history-card time {
        border-radius: var(--radius-full);
        background-color: rgba(99, 102, 241, 0.08);
        color: #4f46e5;
        padding: 9px 15px;
        font-size: 0.78rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .academic-history-card.success .academic-history-icon {
        background-color: var(--success-color);
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.14);
    }

    .academic-history-card.success strong,
    .academic-history-card.success time {
        color: #059669;
    }

    .academic-history-card.success time {
        background-color: rgba(16, 185, 129, 0.1);
    }

    .academic-history-card.warning .academic-history-icon {
        background-color: var(--warning-color);
        box-shadow: 0 12px 24px rgba(245, 158, 11, 0.14);
    }

    .academic-history-card.warning strong,
    .academic-history-card.warning time {
        color: #d97706;
    }

    .academic-history-card.warning time {
        background-color: rgba(245, 158, 11, 0.1);
    }

    .academic-history-card.info .academic-history-icon {
        background-color: var(--secondary-color);
        box-shadow: 0 12px 24px rgba(14, 165, 233, 0.14);
    }

    .academic-history-card.info strong,
    .academic-history-card.info time {
        color: #0284c7;
    }

    .academic-history-card.info time {
        background-color: rgba(14, 165, 233, 0.1);
    }

    .academic-history-card.purple .academic-history-icon {
        background-color: #8b5cf6;
        box-shadow: 0 12px 24px rgba(139, 92, 246, 0.14);
    }

    .academic-history-card.purple strong,
    .academic-history-card.purple time {
        color: #7c3aed;
    }

    .academic-history-card.purple time {
        background-color: rgba(139, 92, 246, 0.1);
    }

    .job-skill-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 28px;
    }

    .job-skill-cloud span {
        border: 1px solid rgba(148, 163, 184, 0.28);
        border-radius: var(--radius-full);
        display: inline-flex;
        align-items: center;
        min-height: 42px;
        padding: 0 18px;
        font-size: 0.95rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .job-skill-cloud .skill-primary {
        background-color: rgba(99, 102, 241, 0.08);
        border-color: rgba(99, 102, 241, 0.16);
        color: #4f46e5;
    }

    .job-skill-cloud .skill-success {
        background-color: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.18);
        color: #047857;
    }

    .job-skill-cloud .skill-info {
        background-color: rgba(14, 165, 233, 0.1);
        border-color: rgba(14, 165, 233, 0.18);
        color: #0369a1;
    }

    .job-skill-cloud .skill-warning {
        background-color: rgba(245, 158, 11, 0.1);
        border-color: rgba(245, 158, 11, 0.22);
        color: #b45309;
    }

    .job-skill-cloud .skill-purple {
        background-color: rgba(124, 58, 237, 0.08);
        border-color: rgba(124, 58, 237, 0.14);
        color: #6d28d9;
    }

    .job-roadmap-list {
        position: relative;
        display: grid;
        gap: 28px;
        margin-top: 28px;
    }

    .job-roadmap-list::before {
        content: '';
        position: absolute;
        top: 28px;
        bottom: 28px;
        left: 28px;
        width: 3px;
        border-radius: var(--radius-full);
        background-color: var(--neutral-white);
        box-shadow: 0 0 0 1px rgba(148, 163, 184, 0.12);
    }

    .job-roadmap-item {
        position: relative;
        display: grid;
        grid-template-columns: 58px 1fr;
        gap: 24px;
        align-items: center;
    }

    .job-roadmap-marker {
        position: relative;
        z-index: 1;
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background-color: #4f46e5;
        color: var(--neutral-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 12px 24px rgba(79, 70, 229, 0.16);
    }

    .job-roadmap-marker .material-symbols-rounded {
        font-size: 24px;
    }

    .job-roadmap-item.success .job-roadmap-marker {
        background-color: var(--success-color);
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.16);
    }

    .job-roadmap-item.warning .job-roadmap-marker {
        background-color: var(--warning-color);
        box-shadow: 0 12px 24px rgba(245, 158, 11, 0.16);
    }

    .job-roadmap-card {
        border: 1px solid var(--neutral-border);
        border-radius: var(--radius-md);
        background-color: var(--neutral-white);
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 22px;
        align-items: start;
        padding: 24px 28px;
    }

    .job-roadmap-card h3 {
        color: var(--neutral-darkest);
        font-size: 1.08rem;
        margin-bottom: 4px;
    }

    .job-roadmap-card strong {
        color: #4f46e5;
        display: block;
        font-size: 0.95rem;
        margin-bottom: 14px;
    }

    .job-roadmap-item.success .job-roadmap-card strong {
        color: #059669;
    }

    .job-roadmap-item.warning .job-roadmap-card strong {
        color: #d97706;
    }

    .job-roadmap-card p {
        color: var(--neutral-gray);
        font-size: 0.92rem;
        font-weight: 500;
        line-height: 1.55;
    }

    .job-roadmap-card time {
        border-radius: var(--radius-full);
        background-color: rgba(99, 102, 241, 0.08);
        color: #4f46e5;
        padding: 8px 14px;
        font-size: 0.78rem;
        font-weight: 900;
        white-space: nowrap;
    }

    .job-roadmap-item.success .job-roadmap-card time {
        background-color: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .job-roadmap-item.warning .job-roadmap-card time {
        background-color: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }

    @media (max-width: 768px) {
        .warning-details-modal {
            padding: 16px;
        }

        .warning-details-header {
            padding: 22px;
        }

        .warning-details-body {
            padding: 22px;
        }

        .warning-details-summary,
        .warning-details-files-grid,
        .leave-evidence-summary,
        .promotion-documents-summary,
        .payroll-slip-summary,
        .training-details-summary {
            grid-template-columns: 1fr;
        }

        .leave-evidence-modal,
        .promotion-documents-modal,
        .payroll-slip-modal,
        .training-details-modal {
            padding: 16px;
        }

        .leave-evidence-header,
        .leave-evidence-body,
        .promotion-documents-header,
        .promotion-documents-body,
        .payroll-slip-header,
        .payroll-slip-body,
        .training-details-header,
        .training-details-body {
            padding: 22px;
        }

        .job-skill-cloud span {
            white-space: normal;
        }

        .job-roadmap-item,
        .job-roadmap-card,
        .academic-history-card {
            grid-template-columns: 1fr;
        }

        .job-roadmap-list::before {
            display: none;
        }
    }

    #employeeDocumentPreviewModal {
        position: fixed;
        inset: 0;
        z-index: 700;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 28px;
    }

    #employeeDocumentPreviewModal.open {
        display: flex;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-backdrop {
        position: absolute;
        inset: 0;
        background-color: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(5px);
    }

    #employeeDocumentPreviewModal .employee-doc-preview-dialog {
        position: relative;
        width: min(1060px, 100%);
        max-height: min(820px, calc(100vh - 56px));
        background-color: #ffffff;
        border: 1px solid rgba(148, 163, 184, 0.32);
        border-radius: 16px;
        box-shadow: 0 28px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 22px 26px;
        border-bottom: 1px solid rgba(148, 163, 184, 0.24);
    }

    #employeeDocumentPreviewModal .employee-doc-preview-header h2 {
        color: var(--neutral-darkest);
        font-size: 1.35rem;
        margin-bottom: 4px;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-header p {
        color: var(--neutral-gray);
        font-size: 0.9rem;
        font-weight: 600;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-btn {
        height: 42px;
        border: none;
        border-radius: var(--radius-md);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 15px;
        font-weight: 800;
        cursor: pointer;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-btn.primary {
        background-color: var(--primary-color);
        color: #ffffff;
    }

    #employeeDocumentPreviewModal .employee-doc-preview-btn.secondary {
        background-color: var(--secondary-light);
        color: var(--primary-color);
    }

    #employeeDocumentPreviewModal .employee-doc-preview-btn.close {
        background-color: var(--neutral-light);
        color: var(--neutral-darkest);
    }

    #employeeDocumentPreviewModal .employee-doc-preview-body {
        background-color: #f8fafc;
        overflow: auto;
        padding: 28px;
    }

    #employeeDocumentPreviewModal .employee-doc-page {
        width: min(780px, 100%);
        min-height: 760px;
        margin: 0 auto;
        background-color: #ffffff;
        border: 1px solid rgba(148, 163, 184, 0.28);
        border-radius: 14px;
        box-shadow: 0 16px 42px rgba(15, 23, 42, 0.12);
        overflow: hidden;
        color: #1e293b;
    }

    #employeeDocumentPreviewModal .employee-doc-official-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 30px 34px;
        background: linear-gradient(135deg, rgba(15, 76, 129, 0.12), rgba(99, 102, 241, 0.12));
        border-bottom: 4px solid var(--primary-color);
    }

    #employeeDocumentPreviewModal .employee-doc-logo {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background-color: var(--primary-color);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.25rem;
    }

    #employeeDocumentPreviewModal .employee-doc-brand strong {
        display: block;
        color: var(--neutral-darkest);
        font-size: 1.15rem;
    }

    #employeeDocumentPreviewModal .employee-doc-brand span,
    #employeeDocumentPreviewModal .employee-doc-ref {
        color: var(--neutral-gray);
        display: block;
        font-size: 0.84rem;
        font-weight: 700;
        margin-top: 4px;
    }

    #employeeDocumentPreviewModal .employee-doc-content {
        padding: 36px 40px;
    }

    #employeeDocumentPreviewModal .employee-doc-kicker {
        color: var(--primary-color);
        font-size: 0.82rem;
        font-weight: 900;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    #employeeDocumentPreviewModal .employee-doc-content h3 {
        color: var(--neutral-darkest);
        font-size: 2rem;
        line-height: 1.2;
        margin-bottom: 18px;
    }

    #employeeDocumentPreviewModal .employee-doc-content p {
        color: #334155;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.7;
        margin-bottom: 16px;
    }

    #employeeDocumentPreviewModal .employee-doc-meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(180px, 1fr));
        gap: 12px;
        margin: 26px 0;
    }

    #employeeDocumentPreviewModal .employee-doc-meta div {
        border: 1px solid rgba(148, 163, 184, 0.28);
        border-radius: 10px;
        padding: 12px 14px;
        background-color: #ffffff;
    }

    #employeeDocumentPreviewModal .employee-doc-meta dt {
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 900;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    #employeeDocumentPreviewModal .employee-doc-meta dd {
        color: #0f172a;
        font-size: 0.95rem;
        font-weight: 800;
        margin: 0;
    }

    #employeeDocumentPreviewModal .employee-doc-id-card {
        border: 1px solid rgba(15, 76, 129, 0.22);
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(15, 76, 129, 0.1), rgba(99, 102, 241, 0.11));
        display: grid;
        grid-template-columns: 128px 1fr;
        gap: 24px;
        padding: 26px;
        margin-top: 20px;
    }

    #employeeDocumentPreviewModal .employee-doc-avatar {
        width: 118px;
        height: 118px;
        border-radius: 16px;
        background-color: var(--primary-color);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 900;
    }

    #employeeDocumentPreviewModal .employee-doc-pill-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    #employeeDocumentPreviewModal .employee-doc-pill-row span {
        border-radius: 999px;
        background-color: rgba(99, 102, 241, 0.12);
        color: #4338ca;
        padding: 8px 12px;
        font-size: 0.82rem;
        font-weight: 800;
    }

    #employeeDocumentPreviewModal .employee-doc-signatures {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 34px;
        margin-top: 54px;
    }

    #employeeDocumentPreviewModal .employee-doc-signatures span {
        border-top: 1px solid #334155;
        color: #64748b;
        display: block;
        font-size: 0.84rem;
        font-weight: 800;
        padding-top: 10px;
        text-align: center;
    }

    #employeeDocumentPreviewModal .employee-doc-clause-list {
        border-top: 1px solid rgba(148, 163, 184, 0.28);
        border-bottom: 1px solid rgba(148, 163, 184, 0.28);
        padding: 18px 0 2px;
        margin-top: 24px;
    }

    #employeeDocumentPreviewModal .employee-doc-honor-seal {
        width: 112px;
        height: 112px;
        border-radius: 50%;
        border: 8px solid rgba(99, 102, 241, 0.16);
        color: #4338ca;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        float: right;
        font-weight: 900;
        text-align: center;
    }

    @media (max-width: 768px) {
        #employeeDocumentPreviewModal {
            padding: 14px;
        }

        #employeeDocumentPreviewModal .employee-doc-preview-header,
        #employeeDocumentPreviewModal .employee-doc-official-header,
        #employeeDocumentPreviewModal .employee-doc-id-card,
        #employeeDocumentPreviewModal .employee-doc-meta,
        #employeeDocumentPreviewModal .employee-doc-signatures {
            grid-template-columns: 1fr;
            flex-direction: column;
            align-items: stretch;
        }

        #employeeDocumentPreviewModal .employee-doc-preview-body,
        #employeeDocumentPreviewModal .employee-doc-content {
            padding: 20px;
        }
    }

    @media print {
        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            width: 210mm;
            min-height: 297mm;
            margin: 0;
            padding: 0;
            background: #ffffff !important;
        }

        body * {
            visibility: hidden;
        }

        #employeeDocumentPreviewModal.open .employee-doc-page,
        #employeeDocumentPreviewModal.open .employee-doc-page * {
            visibility: visible;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        #employeeDocumentPreviewModal.open {
            display: block;
            position: absolute;
            inset: 0;
            padding: 0;
            width: 210mm;
            min-height: 297mm;
            background: #ffffff !important;
        }

        #employeeDocumentPreviewModal .employee-doc-preview-backdrop,
        #employeeDocumentPreviewModal .employee-doc-preview-header {
            display: none;
        }

        #employeeDocumentPreviewModal .employee-doc-preview-dialog,
        #employeeDocumentPreviewModal .employee-doc-preview-body {
            display: block;
            width: 210mm;
            min-height: 297mm;
            max-height: none;
            margin: 0;
            background: #ffffff !important;
            border: none;
            box-shadow: none;
            overflow: visible;
            padding: 0;
        }

        #employeeDocumentPreviewModal .employee-doc-page {
            position: absolute;
            top: 0;
            left: 0;
            width: 210mm;
            min-height: 297mm;
            margin: 0;
            border: none;
            border-radius: 0;
            box-shadow: none;
            overflow: visible;
        }
    }
</style>

<div id="employeeDocumentPreviewModal" aria-hidden="true" data-employee-name="<?php echo htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8'); ?>" data-employee-id="<?php echo htmlspecialchars($employeeId, ENT_QUOTES, 'UTF-8'); ?>" data-employee-role="<?php echo htmlspecialchars($employee['role'], ENT_QUOTES, 'UTF-8'); ?>" data-employee-department="<?php echo htmlspecialchars($employee['department'], ENT_QUOTES, 'UTF-8'); ?>" data-employee-branch="<?php echo htmlspecialchars($employee['branch'], ENT_QUOTES, 'UTF-8'); ?>" data-employee-email="<?php echo htmlspecialchars($employee['email'], ENT_QUOTES, 'UTF-8'); ?>" data-employee-phone="<?php echo htmlspecialchars($employee['phone'], ENT_QUOTES, 'UTF-8'); ?>" data-employee-join-date="<?php echo htmlspecialchars($employee['join_date'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="employee-doc-preview-backdrop" data-employee-doc-close></div>
    <section class="employee-doc-preview-dialog" role="dialog" aria-modal="true" aria-labelledby="employeeDocumentPreviewTitle">
        <div class="employee-doc-preview-header">
            <div>
                <h2 id="employeeDocumentPreviewTitle">Document Preview</h2>
                <p id="employeeDocumentPreviewSubtitle">Generated employee document sample.</p>
            </div>
            <div class="employee-doc-preview-actions">
                <button type="button" class="employee-doc-preview-btn primary" data-employee-doc-print>
                    <span class="material-symbols-rounded" style="font-size: 19px;">print</span>
                    <span>Print</span>
                </button>
                <button type="button" class="employee-doc-preview-btn secondary" data-employee-doc-download>
                    <span class="material-symbols-rounded" style="font-size: 19px;">download</span>
                    <span>Download PDF</span>
                </button>
                <button type="button" class="employee-doc-preview-btn close" data-employee-doc-close>
                    <span class="material-symbols-rounded" style="font-size: 19px;">close</span>
                    <span>Cancel</span>
                </button>
            </div>
        </div>
        <div class="employee-doc-preview-body">
            <article class="employee-doc-page" data-employee-doc-page></article>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var warningModal = document.getElementById('warningDetailsModal');
    if (warningModal) {
        var warningTitle = document.getElementById('warningDetailsTitle');
        var warningSubtitle = document.getElementById('warningDetailsSubtitle');
        var warningType = warningModal.querySelector('[data-warning-detail-type]');
        var warningDate = warningModal.querySelector('[data-warning-detail-date]');
        var warningStatus = warningModal.querySelector('[data-warning-detail-status]');
        var warningNote = warningModal.querySelector('[data-warning-detail-note]');
        var warningLetters = warningModal.querySelector('[data-warning-detail-letters]');
        var warningEvidence = warningModal.querySelector('[data-warning-detail-evidence]');

        function warningEscapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function renderWarningFiles(files, type) {
            if (!files) return '';

            return files.split('|').filter(Boolean).map(function (file) {
                var label = type === 'evidence' ? 'Evidence attached to this warning.' : 'Letter sent to the employee.';
                var icon = type === 'evidence' ? 'description' : 'inventory_2';

                return '<article class="warning-details-file-card ' + warningEscapeHtml(type) + '">' +
                    '<i><span class="material-symbols-rounded">' + icon + '</span></i>' +
                    '<div><strong>' + warningEscapeHtml(file) + '</strong><span>' + label + '</span></div>' +
                '</article>';
            }).join('');
        }

        function openWarningModal(data) {
            warningTitle.textContent = 'Warning Details';
            warningSubtitle.textContent = data.warning + ' issued by ' + data.issuedBy + '.';
            warningType.textContent = data.type;
            warningDate.textContent = data.date;
            warningStatus.textContent = data.status;
            warningNote.textContent = data.note;
            warningLetters.innerHTML = renderWarningFiles(data.letters, 'letter');
            warningEvidence.innerHTML = renderWarningFiles(data.evidence, 'evidence');
            warningModal.classList.add('open');
            warningModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('hrm-modal-open');
        }

        function closeWarningModal() {
            warningModal.classList.remove('open');
            warningModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('hrm-modal-open');
        }

        document.querySelectorAll('[data-warning-details-view]').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.closest('tr');
                if (!row) return;

                openWarningModal({
                    date: row.dataset.date || '',
                    type: row.dataset.type || '',
                    warning: row.dataset.warning || '',
                    issuedBy: row.dataset.issuedBy || '',
                    status: row.dataset.status || '',
                    note: row.dataset.note || '',
                    letters: row.dataset.letters || '',
                    evidence: row.dataset.evidence || ''
                });
            });
        });

        warningModal.querySelectorAll('[data-warning-details-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeWarningModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && warningModal.classList.contains('open')) {
                closeWarningModal();
            }
        });
    }

    var leaveModal = document.getElementById('leaveEvidenceModal');
    if (leaveModal) {
        var leaveTitle = document.getElementById('leaveEvidenceTitle');
        var leaveSubtitle = document.getElementById('leaveEvidenceSubtitle');
        var leaveType = leaveModal.querySelector('[data-leave-evidence-type]');
        var leaveStatus = leaveModal.querySelector('[data-leave-evidence-status]');
        var leaveNote = leaveModal.querySelector('[data-leave-evidence-note]');
        var leaveFiles = leaveModal.querySelector('[data-leave-evidence-files]');

        function leaveEscapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function renderLeaveFiles(files) {
            if (!files) return '';

            return files.split('|').filter(Boolean).map(function (file) {
                return '<article class="leave-evidence-file-card">' +
                    '<i><span class="material-symbols-rounded">attach_file</span></i>' +
                    '<div><strong>' + leaveEscapeHtml(file) + '</strong><span>Supporting file attached to this leave request.</span></div>' +
                '</article>';
            }).join('');
        }

        function openLeaveModal(data) {
            leaveTitle.textContent = 'Leave Supporting Evidence';
            leaveSubtitle.textContent = data.leaveType + ' evidence submitted on ' + data.appliedOn + '.';
            leaveType.textContent = data.leaveType;
            leaveStatus.textContent = data.status;
            leaveNote.textContent = data.note;
            leaveFiles.innerHTML = renderLeaveFiles(data.files);
            leaveModal.classList.add('open');
            leaveModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('hrm-modal-open');
        }

        function closeLeaveModal() {
            leaveModal.classList.remove('open');
            leaveModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('hrm-modal-open');
        }

        document.querySelectorAll('[data-leave-evidence-view]').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.closest('tr');
                if (!row) return;

                openLeaveModal({
                    leaveType: row.dataset.leaveType || '',
                    appliedOn: row.dataset.appliedOn || '',
                    status: row.dataset.status || '',
                    note: row.dataset.evidenceNote || '',
                    files: row.dataset.evidenceFiles || ''
                });
            });
        });

        leaveModal.querySelectorAll('[data-leave-evidence-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeLeaveModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && leaveModal.classList.contains('open')) {
                closeLeaveModal();
            }
        });
    }

    var promotionModal = document.getElementById('promotionDocumentsModal');
    if (promotionModal) {
        var promotionTitle = document.getElementById('promotionDocumentsTitle');
        var promotionSubtitle = document.getElementById('promotionDocumentsSubtitle');
        var promotionDate = promotionModal.querySelector('[data-promotion-document-date]');
        var promotionRole = promotionModal.querySelector('[data-promotion-document-role]');
        var promotionNote = promotionModal.querySelector('[data-promotion-document-note]');
        var promotionFiles = promotionModal.querySelector('[data-promotion-document-files]');

        function promotionEscapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function renderPromotionFiles(files) {
            if (!files) return '';

            return files.split('|').filter(Boolean).map(function (file) {
                return '<article class="promotion-documents-file-card">' +
                    '<i><span class="material-symbols-rounded">description</span></i>' +
                    '<div><strong>' + promotionEscapeHtml(file) + '</strong><span>Supporting promotion document.</span></div>' +
                '</article>';
            }).join('');
        }

        function openPromotionModal(data) {
            promotionTitle.textContent = 'Promotion Supporting Documents';
            promotionSubtitle.textContent = data.toRole + ' promotion documents from ' + data.date + '.';
            promotionDate.textContent = data.date;
            promotionRole.textContent = data.fromRole + ' to ' + data.toRole;
            promotionNote.textContent = data.note;
            promotionFiles.innerHTML = renderPromotionFiles(data.files);
            promotionModal.classList.add('open');
            promotionModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('hrm-modal-open');
        }

        function closePromotionModal() {
            promotionModal.classList.remove('open');
            promotionModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('hrm-modal-open');
        }

        document.querySelectorAll('[data-promotion-documents-view]').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.closest('tr');
                if (!row) return;

                openPromotionModal({
                    date: row.dataset.promotionDate || '',
                    fromRole: row.dataset.fromRole || '',
                    toRole: row.dataset.toRole || '',
                    note: row.dataset.promotionNote || '',
                    files: row.dataset.promotionFiles || ''
                });
            });
        });

        promotionModal.querySelectorAll('[data-promotion-documents-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closePromotionModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && promotionModal.classList.contains('open')) {
                closePromotionModal();
            }
        });
    }

    var payrollModal = document.getElementById('payrollSlipModal');
    if (payrollModal) {
        var payrollTitle = document.getElementById('payrollSlipTitle');
        var payrollSubtitle = document.getElementById('payrollSlipSubtitle');
        var payrollDate = payrollModal.querySelector('[data-payroll-slip-date]');
        var payrollMonth = payrollModal.querySelector('[data-payroll-slip-month]');
        var payrollBase = payrollModal.querySelector('[data-payroll-slip-base]');
        var payrollNet = payrollModal.querySelector('[data-payroll-slip-net]');
        var payrollBonuses = payrollModal.querySelector('[data-payroll-slip-bonuses]');
        var payrollDeductions = payrollModal.querySelector('[data-payroll-slip-deductions]');
        var payrollNote = payrollModal.querySelector('[data-payroll-slip-note]');
        var payrollFiles = payrollModal.querySelector('[data-payroll-slip-files]');

        function payrollEscapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function payrollMoney(value) {
            return '$' + payrollEscapeHtml(value || '0');
        }

        function renderPayrollFiles(files) {
            if (!files) return '';

            return files.split('|').filter(Boolean).map(function (file) {
                return '<article class="payroll-slip-file-card">' +
                    '<i><span class="material-symbols-rounded">receipt_long</span></i>' +
                    '<div><strong>' + payrollEscapeHtml(file) + '</strong><span>Reference file attached to this payroll entry.</span></div>' +
                '</article>';
            }).join('');
        }

        function openPayrollModal(data) {
            payrollTitle.textContent = 'Payment Slip';
            payrollSubtitle.textContent = data.month + ' payroll reference details.';
            payrollDate.textContent = data.paymentDate;
            payrollMonth.textContent = data.month;
            payrollBase.textContent = payrollMoney(data.baseSalary);
            payrollNet.textContent = payrollMoney(data.netPay);
            payrollBonuses.textContent = payrollMoney(data.bonuses);
            payrollDeductions.textContent = payrollMoney(data.deductions);
            payrollNote.textContent = data.note;
            payrollFiles.innerHTML = renderPayrollFiles(data.files);
            payrollModal.classList.add('open');
            payrollModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('hrm-modal-open');
        }

        function closePayrollModal() {
            payrollModal.classList.remove('open');
            payrollModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('hrm-modal-open');
        }

        document.querySelectorAll('[data-payroll-slip-view]').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.closest('tr');
                if (!row) return;

                openPayrollModal({
                    paymentDate: row.dataset.paymentDate || '',
                    month: row.dataset.month || '',
                    baseSalary: row.dataset.baseSalary || '',
                    bonuses: row.dataset.bonuses || '',
                    deductions: row.dataset.deductions || '',
                    netPay: row.dataset.netPay || '',
                    note: row.dataset.payrollNote || '',
                    files: row.dataset.payrollFiles || ''
                });
            });
        });

        payrollModal.querySelectorAll('[data-payroll-slip-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closePayrollModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && payrollModal.classList.contains('open')) {
                closePayrollModal();
            }
        });
    }

    var trainingModal = document.getElementById('trainingDetailsModal');
    if (trainingModal) {
        var trainingTitle = document.getElementById('trainingDetailsTitle');
        var trainingSubtitle = document.getElementById('trainingDetailsSubtitle');
        var trainingName = trainingModal.querySelector('[data-training-detail-name]');
        var trainingStatus = trainingModal.querySelector('[data-training-detail-status]');
        var trainingNote = trainingModal.querySelector('[data-training-detail-note]');
        var trainingFiles = trainingModal.querySelector('[data-training-detail-files]');

        function trainingEscapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function renderTrainingFiles(files) {
            if (!files) return '';

            return files.split('|').filter(Boolean).map(function (file) {
                return '<article class="training-details-file-card">' +
                    '<i><span class="material-symbols-rounded">description</span></i>' +
                    '<div><strong>' + trainingEscapeHtml(file) + '</strong><span>Training reference document.</span></div>' +
                '</article>';
            }).join('');
        }

        function openTrainingModal(data) {
            trainingTitle.textContent = 'Training Details';
            trainingSubtitle.textContent = data.training + ' details from ' + data.date + '.';
            trainingName.textContent = data.training;
            trainingStatus.textContent = data.status;
            trainingNote.textContent = data.note;
            trainingFiles.innerHTML = renderTrainingFiles(data.files);
            trainingModal.classList.add('open');
            trainingModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('hrm-modal-open');
        }

        function closeTrainingModal() {
            trainingModal.classList.remove('open');
            trainingModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('hrm-modal-open');
        }

        document.querySelectorAll('[data-training-details-view]').forEach(function (button) {
            button.addEventListener('click', function () {
                var row = button.closest('tr');
                if (!row) return;

                openTrainingModal({
                    training: row.dataset.training || '',
                    date: row.dataset.date || '',
                    status: row.dataset.status || '',
                    note: row.dataset.trainingNote || '',
                    files: row.dataset.trainingFiles || ''
                });
            });
        });

        trainingModal.querySelectorAll('[data-training-details-close]').forEach(function (trigger) {
            trigger.addEventListener('click', closeTrainingModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && trainingModal.classList.contains('open')) {
                closeTrainingModal();
            }
        });
    }

    var modal = document.getElementById('employeeDocumentPreviewModal');
    if (!modal) return;

    var page = modal.querySelector('[data-employee-doc-page]');
    var title = document.getElementById('employeeDocumentPreviewTitle');
    var subtitle = document.getElementById('employeeDocumentPreviewSubtitle');
    var employee = {
        name: modal.dataset.employeeName || '',
        id: modal.dataset.employeeId || '',
        role: modal.dataset.employeeRole || '',
        department: modal.dataset.employeeDepartment || '',
        branch: modal.dataset.employeeBranch || '',
        email: modal.dataset.employeeEmail || '',
        phone: modal.dataset.employeePhone || '',
        joinDate: modal.dataset.employeeJoinDate || ''
    };

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function officialHeader(documentData) {
        return '<div class="employee-doc-official-header">' +
            '<div style="display:flex;align-items:center;gap:14px;">' +
                '<div class="employee-doc-logo">EIA</div>' +
                '<div class="employee-doc-brand"><strong>Egal International Airport</strong><span>Human Resource Department</span></div>' +
            '</div>' +
            '<div class="employee-doc-ref">Ref: ' + escapeHtml(employee.id) + ' / ' + escapeHtml(documentData.type) + '<br>Updated: ' + escapeHtml(documentData.updated) + '</div>' +
        '</div>';
    }

    function employeeMeta(documentData) {
        return '<dl class="employee-doc-meta">' +
            '<div><dt>Employee</dt><dd>' + escapeHtml(employee.name) + '</dd></div>' +
            '<div><dt>Employee ID</dt><dd>' + escapeHtml(employee.id) + '</dd></div>' +
            '<div><dt>Position</dt><dd>' + escapeHtml(employee.role) + '</dd></div>' +
            '<div><dt>Department</dt><dd>' + escapeHtml(employee.department) + '</dd></div>' +
            '<div><dt>Branch</dt><dd>' + escapeHtml(employee.branch) + '</dd></div>' +
            '<div><dt>Status</dt><dd>' + escapeHtml(documentData.status) + '</dd></div>' +
        '</dl>';
    }

    function signatures(leftLabel, rightLabel) {
        return '<div class="employee-doc-signatures"><span>' + escapeHtml(leftLabel) + '</span><span>' + escapeHtml(rightLabel) + '</span></div>';
    }

    function pageShell(documentData, bodyHtml) {
        return officialHeader(documentData) + '<div class="employee-doc-content">' + bodyHtml + '</div>';
    }

    // CV template.
    function renderCv(documentData) {
        return pageShell(documentData,
            '<p class="employee-doc-kicker">Curriculum Vitae</p>' +
            '<h3>' + escapeHtml(employee.name) + '</h3>' +
            '<p><strong>' + escapeHtml(employee.role) + '</strong> assigned to ' + escapeHtml(employee.department) + ' at ' + escapeHtml(employee.branch) + '.</p>' +
            employeeMeta(documentData) +
            '<div class="employee-doc-clause-list">' +
                '<p><strong>Professional Summary:</strong> Experienced team member with active HR records, branch assignment, and verified employment profile.</p>' +
                '<p><strong>Contact:</strong> ' + escapeHtml(employee.email) + ' · ' + escapeHtml(employee.phone) + '</p>' +
                '<p><strong>Employment Start:</strong> ' + escapeHtml(employee.joinDate) + '</p>' +
            '</div>' +
            signatures(employee.name, 'HR Office')
        );
    }

    // National ID card template.
    function renderNationalId(documentData) {
        var initials = employee.name.split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2);
        return pageShell(documentData,
            '<p class="employee-doc-kicker">Identity Document</p>' +
            '<h3>National ID Card Preview</h3>' +
            '<div class="employee-doc-id-card">' +
                '<div class="employee-doc-avatar">' + escapeHtml(initials) + '</div>' +
                '<div>' +
                    '<h3 style="font-size:1.55rem;margin-bottom:10px;">' + escapeHtml(employee.name) + '</h3>' +
                    '<p>' + escapeHtml(employee.role) + '</p>' +
                    employeeMeta(documentData) +
                '</div>' +
            '</div>'
        );
    }

    // Certificate template.
    function renderCertificate(documentData) {
        return pageShell(documentData,
            '<p class="employee-doc-kicker">' + escapeHtml(documentData.category) + ' Certificate</p>' +
            '<h3>Certificate of ' + escapeHtml(documentData.document) + '</h3>' +
            '<p>This certifies that <strong>' + escapeHtml(employee.name) + '</strong>, employee number <strong>' + escapeHtml(employee.id) + '</strong>, has this document recorded and verified in the employee file.</p>' +
            employeeMeta(documentData) +
            signatures('HR Director', 'Authorized Signature')
        );
    }

    // Approval letter template.
    function renderApprovalLetter(documentData) {
        return pageShell(documentData,
            '<p class="employee-doc-kicker">Official Approval Letter</p>' +
            '<h3>' + escapeHtml(documentData.document) + '</h3>' +
            '<p>Dear ' + escapeHtml(employee.name) + ',</p>' +
            '<p>This letter confirms that the Human Resource Department has reviewed and approved the related employee request under your current employment record.</p>' +
            employeeMeta(documentData) +
            '<p>The approval remains subject to department policy, branch assignment, and management confirmation.</p>' +
            signatures('Prepared by HR Office', 'Approving Officer')
        );
    }

    // Recommendation letter template.
    function renderRecommendationLetter(documentData) {
        return pageShell(documentData,
            '<p class="employee-doc-kicker">Recommendation Letter</p>' +
            '<h3>Professional Recommendation</h3>' +
            '<p>To whom it may concern,</p>' +
            '<p>Egal International Airport confirms that <strong>' + escapeHtml(employee.name) + '</strong> serves as <strong>' + escapeHtml(employee.role) + '</strong> in the <strong>' + escapeHtml(employee.department) + '</strong> department.</p>' +
            '<p>The employee has maintained an official employment record with branch placement at <strong>' + escapeHtml(employee.branch) + '</strong>.</p>' +
            employeeMeta(documentData) +
            signatures('Human Resource Office', 'Authorized Signatory')
        );
    }

    // Employee contract template.
    function renderEmployeeContract(documentData) {
        return pageShell(documentData,
            '<p class="employee-doc-kicker">Employment Agreement</p>' +
            '<h3>' + escapeHtml(documentData.document) + '</h3>' +
            '<p>This employee contract preview records the employment relationship between Egal International Airport and <strong>' + escapeHtml(employee.name) + '</strong>.</p>' +
            employeeMeta(documentData) +
            '<div class="employee-doc-clause-list">' +
                '<p>1. The employee is assigned to the position of ' + escapeHtml(employee.role) + '.</p>' +
                '<p>2. The employee reports under the ' + escapeHtml(employee.department) + ' department and ' + escapeHtml(employee.branch) + ' branch.</p>' +
                '<p>3. This sample preview is generated from the current employee profile.</p>' +
            '</div>' +
            signatures(employee.name, 'Human Resource Office')
        );
    }

    // Honor certificate template.
    function renderHonorCertificate(documentData) {
        return pageShell(documentData,
            '<div class="employee-doc-honor-seal">Honor<br>Seal</div>' +
            '<p class="employee-doc-kicker">Recognition</p>' +
            '<h3>Honor Certificate</h3>' +
            '<p>This honor certificate is presented to <strong>' + escapeHtml(employee.name) + '</strong> in recognition of valued service as <strong>' + escapeHtml(employee.role) + '</strong>.</p>' +
            employeeMeta(documentData) +
            '<div class="employee-doc-pill-row"><span>Service</span><span>Recognition</span><span>Official HR Record</span></div>' +
            signatures('General Manager', 'HR Director')
        );
    }

    // Fallback template for any future document type added to the table.
    function renderGenericDocument(documentData) {
        return pageShell(documentData,
            '<p class="employee-doc-kicker">' + escapeHtml(documentData.type) + '</p>' +
            '<h3>' + escapeHtml(documentData.document) + '</h3>' +
            '<p>This document preview was generated from the selected row and current employee profile.</p>' +
            employeeMeta(documentData) +
            signatures('Prepared by HR Office', 'Authorized Signature')
        );
    }

    var templates = {
        'cv': renderCv,
        'national-id': renderNationalId,
        'certificate': renderCertificate,
        'approval-letter': renderApprovalLetter,
        'recommendation-letter': renderRecommendationLetter,
        'employee-contract': renderEmployeeContract,
        'honor-certificate': renderHonorCertificate
    };

    function openModal(documentData) {
        var renderer = templates[documentData.key] || renderGenericDocument;
        title.textContent = documentData.document;
        subtitle.textContent = documentData.type + ' · ' + documentData.category;
        page.innerHTML = renderer(documentData);
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hrm-modal-open');
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hrm-modal-open');
    }

    function printExactDocumentPage() {
        if (!page.innerHTML.trim()) return;

        var printWindow = window.open('', '_blank', 'width=900,height=1100');
        if (!printWindow) {
            window.print();
            return;
        }

        printWindow.document.write('<!doctype html><html><head><meta charset="utf-8"><title>' + escapeHtml(title.textContent || 'Document Preview') + '</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('@page{size:A4;margin:0;}html,body{margin:0;padding:0;background:#fff;font-family:Outfit,Arial,sans-serif;color:#1e293b;}*{box-sizing:border-box;-webkit-print-color-adjust:exact;print-color-adjust:exact;}.employee-doc-page{width:210mm;min-height:297mm;margin:0;background:#fff;overflow:hidden;color:#1e293b;}.employee-doc-official-header{display:flex;align-items:center;justify-content:space-between;gap:20px;padding:30px 34px;background:linear-gradient(135deg,rgba(15,76,129,.12),rgba(99,102,241,.12));border-bottom:4px solid #0f4c81;}.employee-doc-logo{width:58px;height:58px;border-radius:16px;background:#0f4c81;color:#fff;display:inline-flex;align-items:center;justify-content:center;font-weight:900;font-size:1.25rem;}.employee-doc-brand strong{display:block;color:#0f172a;font-size:1.15rem;}.employee-doc-brand span,.employee-doc-ref{color:#64748b;display:block;font-size:.84rem;font-weight:700;margin-top:4px;}.employee-doc-content{padding:36px 40px;}.employee-doc-kicker{color:#0f4c81;font-size:.82rem;font-weight:900;margin-bottom:10px;text-transform:uppercase;}.employee-doc-content h3{color:#0f172a;font-size:2rem;line-height:1.2;margin:0 0 18px;}.employee-doc-content p{color:#334155;font-size:1rem;font-weight:500;line-height:1.7;margin:0 0 16px;}.employee-doc-meta{display:grid;grid-template-columns:repeat(2,minmax(180px,1fr));gap:12px;margin:26px 0;}.employee-doc-meta div{border:1px solid rgba(148,163,184,.28);border-radius:10px;padding:12px 14px;background:#fff;}.employee-doc-meta dt{color:#64748b;font-size:.75rem;font-weight:900;margin-bottom:6px;text-transform:uppercase;}.employee-doc-meta dd{color:#0f172a;font-size:.95rem;font-weight:800;margin:0;}.employee-doc-id-card{border:1px solid rgba(15,76,129,.22);border-radius:18px;background:linear-gradient(135deg,rgba(15,76,129,.1),rgba(99,102,241,.11));display:grid;grid-template-columns:128px 1fr;gap:24px;padding:26px;margin-top:20px;}.employee-doc-avatar{width:118px;height:118px;border-radius:16px;background:#0f4c81;color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:2rem;font-weight:900;}.employee-doc-pill-row{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px;}.employee-doc-pill-row span{border-radius:999px;background:rgba(99,102,241,.12);color:#4338ca;padding:8px 12px;font-size:.82rem;font-weight:800;}.employee-doc-signatures{display:grid;grid-template-columns:repeat(2,1fr);gap:34px;margin-top:54px;}.employee-doc-signatures span{border-top:1px solid #334155;color:#64748b;display:block;font-size:.84rem;font-weight:800;padding-top:10px;text-align:center;}.employee-doc-clause-list{border-top:1px solid rgba(148,163,184,.28);border-bottom:1px solid rgba(148,163,184,.28);padding:18px 0 2px;margin-top:24px;}.employee-doc-honor-seal{width:112px;height:112px;border-radius:50%;border:8px solid rgba(99,102,241,.16);color:#4338ca;display:inline-flex;align-items:center;justify-content:center;float:right;font-weight:900;text-align:center;}@media print{.employee-doc-page{width:210mm;min-height:297mm;margin:0;box-shadow:none;border:0;}}');
        printWindow.document.write('</style></head><body>');
        printWindow.document.write(page.outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };
    }

    document.querySelectorAll('[data-document-view]').forEach(function (button) {
        button.addEventListener('click', function () {
            var row = button.closest('tr');
            if (!row) return;

            openModal({
                key: row.dataset.docKey || '',
                type: row.dataset.type || '',
                document: row.dataset.document || '',
                category: row.dataset.category || '',
                status: row.dataset.status || '',
                updated: row.dataset.updated || ''
            });
        });
    });

    modal.querySelectorAll('[data-employee-doc-close]').forEach(function (trigger) {
        trigger.addEventListener('click', closeModal);
    });

    modal.querySelector('[data-employee-doc-print]').addEventListener('click', function () {
        if (!modal.classList.contains('open')) return;
        printExactDocumentPage();
    });

    modal.querySelector('[data-employee-doc-download]').addEventListener('click', function () {
        if (!modal.classList.contains('open')) return;
        printExactDocumentPage();
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
