<?php
require_once __DIR__ . '/hrm_config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('HRM_EMPLOYEE_DATA_FILE', dirname(__DIR__) . '/data/hrm_employees.json');
define('HRM_EMPLOYEE_UPLOAD_DIR', dirname(__DIR__) . '/uploads/hrm_employees');
define('HRM_EMPLOYEE_UPLOAD_URL', '../../uploads/hrm_employees');

function hrmEmployeeSampleData()
{
    return [
        'EMP-0001' => [
            'employee_number' => 'EMP-0001',
            'name' => 'Cabdiraxmaan Cali',
            'role' => 'Human Resource Director',
            'status' => 'Active',
            'department' => 'Human Resource',
            'branch' => hrmBranchName(),
            'join_date' => '2024-01-12',
            'phone' => '+252 61 555 0101',
            'email' => 'cabdiraxmaan.cali@hrms.local',
            'location' => hrmBranchLocation(),
            'initials' => 'CC',
            'gender' => 'Male',
            'date_of_birth' => '1992-04-18',
            'employment_type' => 'Full Time',
            'documents' => [],
        ],
        'EMP-0002' => [
            'employee_number' => 'EMP-0002',
            'name' => 'Fadumo Xasan',
            'role' => 'Finance Officer',
            'status' => 'On Leave',
            'department' => 'Finance',
            'branch' => hrmBranchName(),
            'join_date' => '2023-11-07',
            'phone' => '+252 61 555 0202',
            'email' => 'fadumo.xasan@hrms.local',
            'location' => hrmBranchLocation(),
            'initials' => 'FX',
            'gender' => 'Female',
            'date_of_birth' => '1994-06-12',
            'employment_type' => 'Full Time',
            'documents' => [],
        ],
        'EMP-0003' => [
            'employee_number' => 'EMP-0003',
            'name' => 'Mahad Axmed',
            'role' => 'Operations Supervisor',
            'status' => 'Active',
            'department' => 'Operations',
            'branch' => hrmBranchName(),
            'join_date' => '2022-08-16',
            'phone' => '+252 61 555 0303',
            'email' => 'mahad.axmed@hrms.local',
            'location' => hrmBranchLocation(),
            'initials' => 'MA',
            'gender' => 'Male',
            'date_of_birth' => '1990-09-08',
            'employment_type' => 'Full Time',
            'documents' => [],
        ],
        'EMP-0004' => [
            'employee_number' => 'EMP-0004',
            'name' => 'Sahra Maxamed',
            'role' => 'Marketing Coordinator',
            'status' => 'Inactive',
            'department' => 'Marketing',
            'branch' => hrmBranchName(),
            'join_date' => '2024-03-03',
            'phone' => '+252 61 555 0404',
            'email' => 'sahra.maxamed@hrms.local',
            'location' => hrmBranchLocation(),
            'initials' => 'SM',
            'gender' => 'Female',
            'date_of_birth' => '1996-02-21',
            'employment_type' => 'Full Time',
            'documents' => [],
        ],
        'EMP-0005' => [
            'employee_number' => 'EMP-0005',
            'name' => 'Hodan Maxamed',
            'role' => 'Finance Manager',
            'status' => 'Active',
            'department' => 'Finance',
            'branch' => hrmBranchName(),
            'join_date' => '2021-06-24',
            'phone' => '+252 61 555 0505',
            'email' => 'hodan.maxamed@hrms.local',
            'location' => hrmBranchLocation(),
            'initials' => 'HM',
            'gender' => 'Female',
            'date_of_birth' => '1989-11-17',
            'employment_type' => 'Full Time',
            'documents' => [],
        ],
        'EMP-0006' => [
            'employee_number' => 'EMP-0006',
            'name' => 'Mustafe Cabdi',
            'role' => 'IT Systems Officer',
            'status' => 'Active',
            'department' => 'Information Technology',
            'branch' => hrmBranchName(),
            'join_date' => '2020-04-18',
            'phone' => '+252 61 555 0606',
            'email' => 'mustafe.cabdi@hrms.local',
            'location' => hrmBranchLocation(),
            'initials' => 'MC',
            'gender' => 'Male',
            'date_of_birth' => '1988-07-04',
            'employment_type' => 'Full Time',
            'documents' => [],
        ],
    ];
}

function hrmEmployeeText($value)
{
    return trim((string) $value);
}

function hrmEmployeeInitials($name)
{
    $parts = preg_split('/\s+/', trim($name));
    $initials = '';

    foreach ($parts as $part) {
        if ($part !== '') {
            $initials .= strtoupper(substr($part, 0, 1));
        }
    }

    return substr($initials ?: 'EM', 0, 2);
}

function hrmEmployeeStatusClass($status)
{
    if ($status === 'On Leave') {
        return 'leave';
    }

    return strtolower(str_replace(' ', '-', $status ?: 'inactive'));
}

function hrmEmployeeCsrfToken()
{
    if (empty($_SESSION['hrm_employee_csrf'])) {
        $_SESSION['hrm_employee_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['hrm_employee_csrf'];
}

function hrmEmployeeVerifyCsrf($token)
{
    return isset($_SESSION['hrm_employee_csrf']) && hash_equals($_SESSION['hrm_employee_csrf'], (string) $token);
}

function hrmEmployeeStoredData()
{
    if (!is_file(HRM_EMPLOYEE_DATA_FILE)) {
        return [];
    }

    $json = file_get_contents(HRM_EMPLOYEE_DATA_FILE);
    $data = json_decode($json, true);

    return is_array($data) ? $data : [];
}

function hrmEmployeeAll()
{
    return array_replace(hrmEmployeeSampleData(), hrmEmployeeStoredData());
}

function hrmEmployeeFind($employeeId)
{
    $employees = hrmEmployeeAll();

    return isset($employees[$employeeId]) ? $employees[$employeeId] : reset($employees);
}

function hrmEmployeeSaveStoredData($employees)
{
    $dir = dirname(HRM_EMPLOYEE_DATA_FILE);

    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    file_put_contents(HRM_EMPLOYEE_DATA_FILE, json_encode($employees, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
}

function hrmEmployeeUploadDocument($field, $employeeNumber, $type, $document, $category, $key)
{
    if (empty($_FILES[$field]) || !isset($_FILES[$field]['error']) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException($document . ' upload failed.');
    }

    $allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'webp'];
    $originalName = basename($_FILES[$field]['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedExtensions, true)) {
        throw new RuntimeException($document . ' file type is not allowed.');
    }

    $safeEmployee = preg_replace('/[^A-Za-z0-9_-]/', '_', $employeeNumber);
    $uploadDir = HRM_EMPLOYEE_UPLOAD_DIR . '/' . $safeEmployee;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0775, true);
    }

    $fileName = $key . '-' . date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
    $targetPath = $uploadDir . '/' . $fileName;

    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath)) {
        throw new RuntimeException($document . ' could not be saved.');
    }

    return [
        'type' => $type,
        'document' => $document,
        'category' => $category,
        'status' => 'Uploaded',
        'updated' => date('Y-m-d'),
        'key' => $key,
        'original_name' => $originalName,
        'url' => HRM_EMPLOYEE_UPLOAD_URL . '/' . rawurlencode($safeEmployee) . '/' . rawurlencode($fileName),
    ];
}

function hrmEmployeeRegister($post)
{
    $employeeNumber = hrmEmployeeText($post['employee_number'] ?? '');
    $fullName = hrmEmployeeText($post['full_name'] ?? '');

    if ($employeeNumber === '' || $fullName === '') {
        throw new RuntimeException('Employee ID and full name are required.');
    }

    $storedEmployees = hrmEmployeeStoredData();
    $allEmployees = hrmEmployeeAll();

    if (isset($allEmployees[$employeeNumber])) {
        throw new RuntimeException('Employee ID already exists.');
    }

    $documentFields = [
        ['cv_document', 'CV', 'Employee CV', 'Profile', 'cv'],
        ['contract_document', 'Employee Contract', 'Employee Contract', 'Employment', 'employee-contract'],
        ['qualification_document', 'Qualification', 'Qualification Document', 'Academic', 'certificate'],
        ['national_id_document', 'National ID Card', 'National ID Card', 'Identity', 'national-id'],
        ['profile_photo', 'Profile Photo', 'Profile Photo', 'Profile', 'profile-photo'],
    ];

    $documents = [];

    foreach ($documentFields as $fieldConfig) {
        $document = hrmEmployeeUploadDocument($fieldConfig[0], $employeeNumber, $fieldConfig[1], $fieldConfig[2], $fieldConfig[3], $fieldConfig[4]);

        if ($document) {
            $documents[] = $document;
        }
    }

    $employee = [
        'employee_number' => $employeeNumber,
        'name' => $fullName,
        'gender' => hrmEmployeeText($post['gender'] ?? ''),
        'date_of_birth' => hrmEmployeeText($post['date_of_birth'] ?? ''),
        'phone' => hrmEmployeeText($post['phone'] ?? ''),
        'email' => hrmEmployeeText($post['email'] ?? ''),
        'national_id' => hrmEmployeeText($post['national_id'] ?? ''),
        'address' => hrmEmployeeText($post['address'] ?? ''),
        'department' => hrmEmployeeText($post['department'] ?? ''),
        'role' => hrmEmployeeText($post['role'] ?? ''),
        'employment_type' => hrmEmployeeText($post['employment_type'] ?? ''),
        'join_date' => hrmEmployeeText($post['join_date'] ?? ''),
        'branch' => hrmEmployeeText($post['branch'] ?? '') ?: hrmBranchName(),
        'status' => hrmEmployeeText($post['status'] ?? 'Active'),
        'basic_salary' => hrmEmployeeText($post['basic_salary'] ?? ''),
        'allowance' => hrmEmployeeText($post['allowance'] ?? ''),
        'contract_type' => hrmEmployeeText($post['contract_type'] ?? ''),
        'contract_start_date' => hrmEmployeeText($post['contract_start_date'] ?? ''),
        'contract_end_date' => hrmEmployeeText($post['contract_end_date'] ?? ''),
        'notes' => hrmEmployeeText($post['notes'] ?? ''),
        'emergency_contact_name' => hrmEmployeeText($post['emergency_contact_name'] ?? ''),
        'emergency_relationship' => hrmEmployeeText($post['emergency_relationship'] ?? ''),
        'emergency_phone' => hrmEmployeeText($post['emergency_phone'] ?? ''),
        'emergency_address' => hrmEmployeeText($post['emergency_address'] ?? ''),
        'location' => hrmEmployeeText($post['address'] ?? '') ?: hrmEmployeeText($post['branch'] ?? ''),
        'initials' => hrmEmployeeInitials($fullName),
        'documents' => $documents,
        'created_at' => date('c'),
    ];

    $storedEmployees[$employeeNumber] = $employee;
    hrmEmployeeSaveStoredData($storedEmployees);

    return $employeeNumber;
}
?>
