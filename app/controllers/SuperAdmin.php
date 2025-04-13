<?php
class SuperAdmin extends Controller {
    private $UserModel;
    private $AllStudentsModel;
    private $ClassModel;
    private $ParentModel;

    public function __construct() {
        // Initialize the User model
        $this->UserModel = $this->model('User'); 
        $this->AllStudentsModel = $this->model('AllStudentsModel');
        $this->ClassModel = $this->model('classModel');
        $this->ParentModel = $this->model('ParentModel');
    }

    public function uploadUsers() {
        $data = [];
        $this->view('inc/admin/uploadUsers', $data);
    }

    public function uploadResult() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['csv_file'])) {
            $data = ['message' => 'Invalid request.'];
            $this->view('inc/admin/uploadResult', $data);
            return;
        }
    
        $file = $_FILES['csv_file'];
        $data = [
            'successCount' => 0,
            'errors' => [],
            'message' => ''
        ];
    
        // Validate file
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $data['message'] = 'File upload failed: Error code ' . $file['error'];
            $this->view('inc/admin/uploadResult', $data);
            return;
        }
        if ($file['type'] !== 'text/csv' && pathinfo($file['name'], PATHINFO_EXTENSION) !== 'csv') {
            $data['message'] = 'Only CSV files are allowed.';
            $this->view('inc/admin/uploadResult', $data);
            return;
        }
    
        $handle = fopen($file['tmp_name'], 'r');
        if ($handle === false) {
            $data['message'] = 'Failed to open CSV file.';
            $this->view('inc/admin/uploadResult', $data);
            return;
        }
    
        fgetcsv($handle); // Skip header
        $successCount = 0;
        $errors = [];
    
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 9) {
                $errors[] = "Invalid row format: " . implode(',', $row);
                continue;
            }
    
            $userData = [
                'regNo' => trim($row[0]),
                'email' => trim($row[1]),
                'mobileNo' => trim($row[2]),
                'address' => trim($row[3]),
                'username' => trim($row[4]),
                'dob' => trim($row[5]),
                'gender' => trim($row[6]),
                'religion' => trim($row[7]),
                'role' => trim($row[8])
            ];
    
            // Generate password
            $password = $userData['username'] . '123';
            $userData['password'] = password_hash($password, PASSWORD_BCRYPT);
    
            // Validate user data
            $userModel = new User();
            if (!$userModel->validate($userData)) {
                foreach ($userModel->errors as $field => $error) {
                    $errors[] = "regNo {$userData['regNo']}: $error";
                }
                continue;
            }
    
            if ($this->UserModel->regNoExists($userData['regNo'])) {
                $errors[] = "Duplicate regNo: {$userData['regNo']}";
                continue;
            }
    
            // Insert user
            if ($this->UserModel->insert($userData)) {
                $successCount++;
    
                if ($userData['role'] === 'student') {
                    $studentData = [
                        'studentId' => isset($row[9]) && $row[9] ? trim($row[9]) : 'S' . str_pad($userData['regNo'], 4, '0', STR_PAD_LEFT),
                        'regNo' => $userData['regNo'],
                        'firstName' => $userData['username'], // Using username as firstName
                        'lastName' => '',
                        'classId' => isset($row[10]) ? trim($row[10]) : null,
                        'guardianRegNo' => isset($row[11]) ? trim($row[11]) : null
                    ];
                    if (!$studentData['classId'] || !is_numeric($studentData['classId']) || !$this->ClassModel->classIdExists($studentData['classId'])) {
                        $errors[] = "Invalid or missing classId for student regNo: {$userData['regNo']}";
                        continue;
                    }
                    if ($studentData['guardianRegNo'] && (!is_numeric($studentData['guardianRegNo']) || !$this->UserModel->regNoExists($studentData['guardianRegNo']))) {
                        $errors[] = "Invalid or non-existent guardianRegNo for student regNo: {$userData['regNo']}";
                        continue;
                    }
                    if ($this->AllStudentsModel->studentIdExists($studentData['studentId'])) {
                        $errors[] = "Duplicate studentId: {$studentData['studentId']}";
                        continue;
                    }
    
                    if (!$this->AllStudentsModel->insertStudent($studentData)) {
                        $errors[] = "Failed to insert student regNo: {$userData['regNo']}";
                    }
                } elseif ($userData['role'] === 'parent') {
                    $parentData = [
                        'regNo' => $userData['regNo'],
                        'firstName' => ucwords(strtolower($userData['username'])), // Using username as firstName
                        'lastName' => '',
                        'occupation' => isset($row[12]) && $row[12] !== '' ? ucwords(strtolower(trim($row[12]))) : 'Not Specified',
                        'relationship' => isset($row[13]) && $row[13] !== '' ? trim($row[13]) : 'Guardian'

                    ];

                    $parentModel = new ParentModel();
                    if (!$parentModel->validate($parentData)) {
                        foreach ($parentModel->errors as $field => $error) {
                            $errors[] = "regNo {$userData['regNo']}: Parent $field - $error";
                        }
                        continue;
                    }
                    if ($this->ParentModel->regNoExists($parentData['regNo'])) {
                        $errors[] = "Duplicate parent regNo: {$userData['regNo']}";
                        continue;
                    }
                    if (!$this->ParentModel->insertParent($parentData)) {
                        $errors[] = "Failed to insert parent regNo: {$userData['regNo']}";
                    }
                }
            } else {
                $errors[] = "Failed to insert user regNo: {$userData['regNo']}";
            }
        }
    
        fclose($handle);
    
        $data['successCount'] = $successCount;
        $data['errors'] = $errors;
        if ($successCount === 0 && empty($errors)) {
            $data['message'] = 'No valid data found in the CSV.';
        }
    
        $this->view('inc/admin/uploadResult', $data);
    }

    }
?>