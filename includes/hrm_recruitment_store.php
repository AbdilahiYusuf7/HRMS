<?php
require_once __DIR__ . '/hrm_config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('HRM_RECRUITMENT_DATA_FILE', dirname(__DIR__) . '/data/hrm_recruitment.json');
define('HRM_RECRUITMENT_UPLOAD_DIR', dirname(__DIR__) . '/uploads/hrm_recruitment');
define('HRM_RECRUITMENT_UPLOAD_URL', '../../uploads/hrm_recruitment');

function hrmRecruitmentText($value)
{
    return trim((string) $value);
}

function hrmRecruitmentCsrfToken()
{
    if (empty($_SESSION['hrm_recruitment_csrf'])) {
        $_SESSION['hrm_recruitment_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['hrm_recruitment_csrf'];
}

function hrmRecruitmentVerifyCsrf($token)
{
    return isset($_SESSION['hrm_recruitment_csrf']) && hash_equals($_SESSION['hrm_recruitment_csrf'], (string) $token);
}

function hrmRecruitmentSampleData()
{
    return [
        'vacancies' => [
            'VAC-0001' => [
                'id' => 'VAC-0001',
                'job_title' => 'Human Resource Officer',
                'department' => 'Human Resource',
                'qualification' => 'Bachelor in HR Management or related field',
                'positions' => 2,
                'deadline' => '2026-07-15',
                'status' => 'Open',
                'created_at' => '2026-03-01T08:00:00+00:00',
            ],
            'VAC-0002' => [
                'id' => 'VAC-0002',
                'job_title' => 'Finance Analyst',
                'department' => 'Finance',
                'qualification' => 'Bachelor in Accounting or Finance',
                'positions' => 1,
                'deadline' => '2026-06-30',
                'status' => 'Open',
                'created_at' => '2026-02-18T08:00:00+00:00',
            ],
            'VAC-0003' => [
                'id' => 'VAC-0003',
                'job_title' => 'IT Systems Support Engineer',
                'department' => 'Information Technology',
                'qualification' => 'Diploma or Degree in Computer Science',
                'positions' => 3,
                'deadline' => '2026-08-10',
                'status' => 'Open',
                'created_at' => '2026-04-02T08:00:00+00:00',
            ],
            'VAC-0004' => [
                'id' => 'VAC-0004',
                'job_title' => 'Marketing Coordinator',
                'department' => 'Marketing',
                'qualification' => 'Bachelor in Marketing or Communications',
                'positions' => 1,
                'deadline' => '2026-05-01',
                'status' => 'Closed',
                'created_at' => '2026-01-10T08:00:00+00:00',
            ],
        ],
        'applicants' => [
            'APP-0001' => [
                'id' => 'APP-0001',
                'name' => 'Amina Yusuf',
                'phone' => '+252 61 700 1101',
                'email' => 'amina.yusuf@email.demo',
                'vacancy_id' => 'VAC-0001',
                'applied_position' => 'Human Resource Officer',
                'cv_file' => '',
                'status' => 'Shortlisted',
                'created_at' => '2026-03-05T10:00:00+00:00',
            ],
            'APP-0002' => [
                'id' => 'APP-0002',
                'name' => 'Khadar Jama',
                'phone' => '+252 61 700 1102',
                'email' => 'khadar.jama@email.demo',
                'vacancy_id' => 'VAC-0002',
                'applied_position' => 'Finance Analyst',
                'cv_file' => '',
                'status' => 'Selected',
                'created_at' => '2026-02-22T10:00:00+00:00',
            ],
            'APP-0003' => [
                'id' => 'APP-0003',
                'name' => 'Ilwad Noor',
                'phone' => '+252 61 700 1103',
                'email' => 'ilwad.noor@email.demo',
                'vacancy_id' => 'VAC-0003',
                'applied_position' => 'IT Systems Support Engineer',
                'cv_file' => '',
                'status' => 'Shortlisted',
                'created_at' => '2026-04-08T10:00:00+00:00',
            ],
            'APP-0004' => [
                'id' => 'APP-0004',
                'name' => 'Nimco Warsame',
                'phone' => '+252 61 700 1104',
                'email' => 'nimco.warsame@email.demo',
                'vacancy_id' => 'VAC-0001',
                'applied_position' => 'Human Resource Officer',
                'cv_file' => '',
                'status' => 'Pending',
                'created_at' => '2026-04-12T10:00:00+00:00',
            ],
            'APP-0005' => [
                'id' => 'APP-0005',
                'name' => 'Ahmed Jama',
                'phone' => '+252 61 700 1105',
                'email' => 'ahmed.jama@email.demo',
                'vacancy_id' => 'VAC-0003',
                'applied_position' => 'IT Systems Support Engineer',
                'cv_file' => '',
                'status' => 'Rejected',
                'created_at' => '2026-04-10T10:00:00+00:00',
            ],
            'APP-0006' => [
                'id' => 'APP-0006',
                'name' => 'Roda Jama',
                'phone' => '+252 61 700 1106',
                'email' => 'roda.jama@email.demo',
                'vacancy_id' => 'VAC-0002',
                'applied_position' => 'Finance Analyst',
                'cv_file' => '',
                'status' => 'Shortlisted',
                'created_at' => '2026-03-18T10:00:00+00:00',
            ],
            'APP-0007' => [
                'id' => 'APP-0007',
                'name' => 'Asha Mohamed',
                'phone' => '+252 61 700 1107',
                'email' => 'asha.mohamed@email.demo',
                'vacancy_id' => 'VAC-0004',
                'applied_position' => 'Marketing Coordinator',
                'cv_file' => '',
                'status' => 'Selected',
                'created_at' => '2026-02-01T10:00:00+00:00',
            ],
            'APP-0008' => [
                'id' => 'APP-0008',
                'name' => 'Cali Maxamed',
                'phone' => '+252 61 700 1108',
                'email' => 'cali.maxamed@email.demo',
                'vacancy_id' => 'VAC-0001',
                'applied_position' => 'Human Resource Officer',
                'cv_file' => '',
                'status' => 'Pending',
                'created_at' => '2026-04-20T10:00:00+00:00',
            ],
        ],
        'interviews' => [
            'INT-0001' => [
                'id' => 'INT-0001',
                'applicant_id' => 'APP-0001',
                'interview_date' => '2026-04-18',
                'score' => 82,
                'comment' => 'Strong communication and HR policy knowledge.',
                'result' => 'Passed',
                'created_at' => '2026-04-18T14:00:00+00:00',
            ],
            'INT-0002' => [
                'id' => 'INT-0002',
                'applicant_id' => 'APP-0002',
                'interview_date' => '2026-03-10',
                'score' => 88,
                'comment' => 'Excellent analytical skills and finance background.',
                'result' => 'Passed',
                'created_at' => '2026-03-10T14:00:00+00:00',
            ],
            'INT-0003' => [
                'id' => 'INT-0003',
                'applicant_id' => 'APP-0005',
                'interview_date' => '2026-04-14',
                'score' => 54,
                'comment' => 'Limited troubleshooting experience for the role.',
                'result' => 'Failed',
                'created_at' => '2026-04-14T14:00:00+00:00',
            ],
        ],
    ];
}

function hrmRecruitmentStoredData()
{
    if (!is_file(HRM_RECRUITMENT_DATA_FILE)) {
        return [];
    }

    $json = file_get_contents(HRM_RECRUITMENT_DATA_FILE);
    $data = json_decode($json, true);

    return is_array($data) ? $data : [];
}

function hrmRecruitmentMergeData($stored, $sample)
{
    $merged = $sample;

    foreach (['vacancies', 'applicants', 'interviews'] as $section) {
        if (!empty($stored[$section]) && is_array($stored[$section])) {
            $merged[$section] = array_replace($merged[$section], $stored[$section]);
        }
    }

    return $merged;
}

function hrmRecruitmentAll()
{
    return hrmRecruitmentMergeData(hrmRecruitmentStoredData(), hrmRecruitmentSampleData());
}

function hrmRecruitmentSaveStoredData($data)
{
    $dir = dirname(HRM_RECRUITMENT_DATA_FILE);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    file_put_contents(HRM_RECRUITMENT_DATA_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
}

function hrmRecruitmentPersistRecord($section, $id, $record)
{
    $stored = hrmRecruitmentStoredData();

    if (!isset($stored[$section]) || !is_array($stored[$section])) {
        $stored[$section] = [];
    }

    $stored[$section][$id] = $record;
    hrmRecruitmentSaveStoredData($stored);
}

function hrmRecruitmentNextId($prefix, $records)
{
    $max = 0;

    foreach (array_keys($records) as $id) {
        if (preg_match('/' . preg_quote($prefix, '/') . '-(\d+)/', $id, $matches)) {
            $max = max($max, (int) $matches[1]);
        }
    }

    return $prefix . '-' . str_pad((string) ($max + 1), 4, '0', STR_PAD_LEFT);
}

function hrmRecruitmentVacancies()
{
    return hrmRecruitmentAll()['vacancies'];
}

function hrmRecruitmentApplicants()
{
    return hrmRecruitmentAll()['applicants'];
}

function hrmRecruitmentInterviews()
{
    return hrmRecruitmentAll()['interviews'];
}

function hrmRecruitmentInterviewRecords()
{
    return hrmRecruitmentAll()['interviews'];
}

function hrmRecruitmentFindVacancy($id)
{
    $vacancies = hrmRecruitmentVacancies();

    return isset($vacancies[$id]) ? $vacancies[$id] : null;
}

function hrmRecruitmentFindApplicant($id)
{
    $applicants = hrmRecruitmentApplicants();

    return isset($applicants[$id]) ? $applicants[$id] : null;
}

function hrmRecruitmentFindInterview($id)
{
    $interviews = hrmRecruitmentInterviewRecords();

    return isset($interviews[$id]) ? $interviews[$id] : null;
}

function hrmRecruitmentOpenVacancyCount()
{
    return count(array_filter(hrmRecruitmentVacancies(), function ($vacancy) {
        return ($vacancy['status'] ?? '') === 'Open';
    }));
}

function hrmRecruitmentStats()
{
    $applicants = hrmRecruitmentApplicants();

    return [
        'open_vacancies' => hrmRecruitmentOpenVacancyCount(),
        'total_applicants' => count($applicants),
        'shortlisted' => count(array_filter($applicants, function ($a) {
            return ($a['status'] ?? '') === 'Shortlisted';
        })),
        'selected' => count(array_filter($applicants, function ($a) {
            return ($a['status'] ?? '') === 'Selected';
        })),
    ];
}

function hrmRecruitmentVacancyStatusClass($status)
{
    return strtolower($status) === 'open' ? 'open' : 'closed';
}

function hrmRecruitmentApplicantStatusClass($status)
{
    $map = [
        'Pending' => 'pending',
        'Shortlisted' => 'shortlisted',
        'Rejected' => 'rejected',
        'Selected' => 'selected',
    ];

    return $map[$status] ?? 'pending';
}

function hrmRecruitmentInterviewResultClass($result)
{
    return strtolower($result) === 'passed' ? 'passed' : 'failed';
}

function hrmRecruitmentUploadCv($applicantId)
{
    if (empty($_FILES['cv_document']) || !isset($_FILES['cv_document']['error']) || $_FILES['cv_document']['error'] === UPLOAD_ERR_NO_FILE) {
        return '';
    }

    if ($_FILES['cv_document']['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('CV upload failed.');
    }

    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $originalName = basename($_FILES['cv_document']['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedExtensions, true)) {
        throw new RuntimeException('CV file type is not allowed. Use PDF, DOC, or DOCX.');
    }

    $safeId = preg_replace('/[^A-Za-z0-9_-]/', '_', $applicantId);
    $uploadDir = HRM_RECRUITMENT_UPLOAD_DIR . '/cvs';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $fileName = $safeId . '-' . date('YmdHis') . '.' . $extension;
    $targetPath = $uploadDir . '/' . $fileName;

    if (!move_uploaded_file($_FILES['cv_document']['tmp_name'], $targetPath)) {
        throw new RuntimeException('CV could not be saved.');
    }

    return HRM_RECRUITMENT_UPLOAD_URL . '/cvs/' . rawurlencode($fileName);
}

function hrmRecruitmentAddVacancy($post)
{
    $jobTitle = hrmRecruitmentText($post['job_title'] ?? '');
    $department = hrmRecruitmentText($post['department'] ?? '');
    $qualification = hrmRecruitmentText($post['qualification'] ?? '');
    $positions = (int) ($post['positions'] ?? 0);
    $deadline = hrmRecruitmentText($post['deadline'] ?? '');

    if ($jobTitle === '' || $department === '' || $qualification === '' || $positions < 1 || $deadline === '') {
        throw new RuntimeException('All vacancy fields are required.');
    }

    $all = hrmRecruitmentAll();
    $id = hrmRecruitmentNextId('VAC', $all['vacancies']);

    $all['vacancies'][$id] = [
        'id' => $id,
        'job_title' => $jobTitle,
        'department' => $department,
        'qualification' => $qualification,
        'positions' => $positions,
        'deadline' => $deadline,
        'status' => 'Open',
        'created_at' => date('c'),
    ];

    hrmRecruitmentPersistRecord('vacancies', $id, $all['vacancies'][$id]);

    return $id;
}

function hrmRecruitmentUpdateVacancy($id, $post)
{
    $vacancy = hrmRecruitmentFindVacancy($id);

    if (!$vacancy) {
        throw new RuntimeException('Vacancy not found.');
    }

    $jobTitle = hrmRecruitmentText($post['job_title'] ?? '');
    $department = hrmRecruitmentText($post['department'] ?? '');
    $qualification = hrmRecruitmentText($post['qualification'] ?? '');
    $positions = (int) ($post['positions'] ?? 0);
    $deadline = hrmRecruitmentText($post['deadline'] ?? '');

    if ($jobTitle === '' || $department === '' || $qualification === '' || $positions < 1 || $deadline === '') {
        throw new RuntimeException('All vacancy fields are required.');
    }

    $all = hrmRecruitmentAll();
    $all['vacancies'][$id] = array_merge($vacancy, [
        'job_title' => $jobTitle,
        'department' => $department,
        'qualification' => $qualification,
        'positions' => $positions,
        'deadline' => $deadline,
    ]);

    hrmRecruitmentPersistRecord('vacancies', $id, $all['vacancies'][$id]);

    return $id;
}

function hrmRecruitmentCloseVacancy($id)
{
    $vacancy = hrmRecruitmentFindVacancy($id);

    if (!$vacancy) {
        throw new RuntimeException('Vacancy not found.');
    }

    $all = hrmRecruitmentAll();
    $all['vacancies'][$id]['status'] = 'Closed';

    hrmRecruitmentPersistRecord('vacancies', $id, $all['vacancies'][$id]);

    return $id;
}

function hrmRecruitmentAddApplicant($post)
{
    $name = hrmRecruitmentText($post['name'] ?? '');
    $phone = hrmRecruitmentText($post['phone'] ?? '');
    $email = hrmRecruitmentText($post['email'] ?? '');
    $vacancyId = hrmRecruitmentText($post['vacancy_id'] ?? '');

    if ($name === '' || $phone === '' || $email === '' || $vacancyId === '') {
        throw new RuntimeException('Name, phone, email, and applied position are required.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException('Please enter a valid email address.');
    }

    $vacancy = hrmRecruitmentFindVacancy($vacancyId);

    if (!$vacancy) {
        throw new RuntimeException('Selected vacancy was not found.');
    }

    $all = hrmRecruitmentAll();
    $id = hrmRecruitmentNextId('APP', $all['applicants']);
    $cvFile = hrmRecruitmentUploadCv($id);

    $all['applicants'][$id] = [
        'id' => $id,
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'vacancy_id' => $vacancyId,
        'applied_position' => $vacancy['job_title'],
        'cv_file' => $cvFile,
        'status' => 'Pending',
        'created_at' => date('c'),
    ];

    hrmRecruitmentPersistRecord('applicants', $id, $all['applicants'][$id]);

    return $id;
}

function hrmRecruitmentUpdateApplicant($id, $post)
{
    $applicant = hrmRecruitmentFindApplicant($id);

    if (!$applicant) {
        throw new RuntimeException('Applicant not found.');
    }

    $name = hrmRecruitmentText($post['name'] ?? '');
    $phone = hrmRecruitmentText($post['phone'] ?? '');
    $email = hrmRecruitmentText($post['email'] ?? '');
    $vacancyId = hrmRecruitmentText($post['vacancy_id'] ?? '');

    if ($name === '' || $phone === '' || $email === '' || $vacancyId === '') {
        throw new RuntimeException('Name, phone, email, and applied position are required.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException('Please enter a valid email address.');
    }

    $vacancy = hrmRecruitmentFindVacancy($vacancyId);

    if (!$vacancy) {
        throw new RuntimeException('Selected vacancy was not found.');
    }

    $all = hrmRecruitmentAll();
    $cvFile = hrmRecruitmentUploadCv($id);

    $all['applicants'][$id] = array_merge($applicant, [
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'vacancy_id' => $vacancyId,
        'applied_position' => $vacancy['job_title'],
        'cv_file' => $cvFile ?: ($applicant['cv_file'] ?? ''),
    ]);

    hrmRecruitmentPersistRecord('applicants', $id, $all['applicants'][$id]);

    return $id;
}

function hrmRecruitmentSetApplicantStatus($id, $status)
{
    $applicant = hrmRecruitmentFindApplicant($id);

    if (!$applicant) {
        throw new RuntimeException('Applicant not found.');
    }

    $all = hrmRecruitmentAll();
    $all['applicants'][$id]['status'] = $status;

    hrmRecruitmentPersistRecord('applicants', $id, $all['applicants'][$id]);

    return $id;
}

function hrmRecruitmentAddInterview($post)
{
    $applicantId = hrmRecruitmentText($post['applicant_id'] ?? '');
    $interviewDate = hrmRecruitmentText($post['interview_date'] ?? '');
    $score = (int) ($post['score'] ?? -1);
    $comment = hrmRecruitmentText($post['comment'] ?? '');
    $result = hrmRecruitmentText($post['result'] ?? '');

    if ($applicantId === '' || $interviewDate === '' || $score < 0 || $score > 100 || !in_array($result, ['Passed', 'Failed'], true)) {
        throw new RuntimeException('Applicant, interview date, score (0-100), and result are required.');
    }

    $applicant = hrmRecruitmentFindApplicant($applicantId);

    if (!$applicant) {
        throw new RuntimeException('Applicant not found.');
    }

    if (($applicant['status'] ?? '') !== 'Shortlisted') {
        throw new RuntimeException('Only shortlisted applicants can be scheduled for interview.');
    }

    $all = hrmRecruitmentAll();
    $id = hrmRecruitmentNextId('INT', $all['interviews']);

    $all['interviews'][$id] = [
        'id' => $id,
        'applicant_id' => $applicantId,
        'interview_date' => $interviewDate,
        'score' => $score,
        'comment' => $comment,
        'result' => $result,
        'created_at' => date('c'),
    ];

    if ($result === 'Passed') {
        $all['applicants'][$applicantId]['status'] = 'Selected';
    }

    hrmRecruitmentPersistRecord('applicants', $applicantId, $all['applicants'][$applicantId]);
    hrmRecruitmentPersistRecord('interviews', $id, $all['interviews'][$id]);

    return $id;
}

function hrmRecruitmentUpdateInterview($id, $post)
{
    $interview = hrmRecruitmentFindInterview($id);

    if (!$interview) {
        throw new RuntimeException('Interview record not found.');
    }

    $interviewDate = hrmRecruitmentText($post['interview_date'] ?? '');
    $score = (int) ($post['score'] ?? -1);
    $comment = hrmRecruitmentText($post['comment'] ?? '');
    $result = hrmRecruitmentText($post['result'] ?? '');

    if ($interviewDate === '' || $score < 0 || $score > 100 || !in_array($result, ['Passed', 'Failed'], true)) {
        throw new RuntimeException('Interview date, score (0-100), and result are required.');
    }

    $all = hrmRecruitmentAll();
    $applicantId = $interview['applicant_id'];

    $all['interviews'][$id] = array_merge($interview, [
        'interview_date' => $interviewDate,
        'score' => $score,
        'comment' => $comment,
        'result' => $result,
    ]);

    if ($result === 'Passed') {
        $all['applicants'][$applicantId]['status'] = 'Selected';
    } elseif (($all['applicants'][$applicantId]['status'] ?? '') === 'Selected') {
        $all['applicants'][$applicantId]['status'] = 'Shortlisted';
    }

    hrmRecruitmentPersistRecord('applicants', $applicantId, $all['applicants'][$applicantId]);
    hrmRecruitmentPersistRecord('interviews', $id, $all['interviews'][$id]);

    return $id;
}

function hrmRecruitmentConvertToEmployee($applicantId)
{
    $applicant = hrmRecruitmentFindApplicant($applicantId);

    if (!$applicant) {
        throw new RuntimeException('Candidate not found.');
    }

    if (($applicant['status'] ?? '') !== 'Selected') {
        throw new RuntimeException('Only selected candidates can be converted to employee.');
    }

    return $applicantId;
}
