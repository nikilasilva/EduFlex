<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPROOT . '/../vendor/autoload.php';

class SuperAdmin extends Controller {
    private $UserModel;
    private $AllStudentsModel;
    private $ClassModel;
    private $ParentModel;

    public function __construct() {
        // Initialize the User model
        $this->UserModel = $this->model('User'); 
        $this->AllStudentsModel = $this->model('AllStudentsModel');
        $this->ClassModel = $this->model('ClassesModel');
        $this->ParentModel = $this->model('ParentModel');
    }

    public function uploadUsers() {
        checkRole('admin');
        $data = [];
        $this->view('inc/admin/uploadUsers', $data);
    }

    public function uploadResult() {
        checkRole('admin');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['csv_file'])) {
            $data = ['message' => 'Invalid request.'];
            $this->view('inc/admin/uploadResult', $data);
            return;
        }
    
        $file = $_FILES['csv_file'];
        $data = [
            'successCount' => 0,
            'errors' => [],
            'message' => '',
            'emailErrors' => []
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
        $emailErrors = [];
    
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
                'fullName' => trim($row[4]),
                'nameWithInitial' => trim($row[5]),
                'dob' => trim($row[6]),
                'gender' => trim($row[7]),
                'religion' => trim($row[8]),
                'role' => trim($row[9]),
                // 'must_reset_password' => 1
            ];
    
            // Generate password
            $plainPassword = strtolower($userData['nameWithInitial']) . '123';
            $userData['password'] = password_hash($plainPassword, PASSWORD_BCRYPT);
    
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

                // Send Email
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = SMTP_HOST;
                    $mail->SMTPAuth = true;
                    $mail->Username = SMTP_USER;
                    $mail->Password = SMTP_PASSWORD;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('nikilasilva@gmail.com', 'Eduflex Admin');
                    $mail->addAddress($userData['email'], $userData['fullName']);

                    $mail->isHTML(true);
                    $mail->Subject = 'Your Eduflex Account Details';
                    $mail->Body = "
                        <h2>Welcome to EduFlex!</h2>
                        <p>Your account has been created. Below are your login details:</p>
                        <p><strong>Full Name:</strong> {$userData['fullName']}</p>
                        <p><strong>Password:</strong> {$plainPassword}</p>
                        <p>Please change your password immediately by clicking the link below:</p>
                        <p><a href='".URLROOT."/Users/updatePassword'>Change Password</a></p>
                        <p>For security, this is a one-time password. Log in and update it as soon as possible.</p>
                        <p>Thank you, <br>Eduflex Team</p>
                    ";
                    $mail->AltBody = "Welcome to EduFlex!\nYour account details:\nUsername: {$userData['fullName']}\nPassword: {$plainPassword}\nPlease change your password at " . URLROOT . "/Users/updatePassword\nThis is a one-time password. Log in and update it soon.\nThank you,\nEduflex Team";
                    $mail->send();
                } catch (Exception $e) {
                    $emailErrors[] = "Failed to send email to {$userData['email']}: {$mail->ErrorInfo}";
                }
    
                if ($userData['role'] === 'student') {
                    $studentData = [
                        'student_id' => isset($row[10]) && $row[10] ? trim($row[10]) : 'S' . str_pad($userData['regNo'], 4, '0', STR_PAD_LEFT),
                        'regNo' => $userData['regNo'],
                        // 'firstName' => $userData['username'], // Using username as firstName
                        // 'lastName' => '',
                        'classId' => isset($row[11]) ? trim($row[11]) : null,
                        'guardianRegNo' => isset($row[12]) ? trim($row[12]) : null
                    ];
                    if (!$studentData['classId'] || !is_numeric($studentData['classId']) || !$this->ClassModel->classIdExists($studentData['classId'])) {
                        $errors[] = "Invalid or missing classId for student regNo: {$userData['regNo']}";
                        continue;
                    }
                    if ($studentData['guardianRegNo'] && (!is_numeric($studentData['guardianRegNo']) || !$this->UserModel->regNoExists($studentData['guardianRegNo']))) {
                        $errors[] = "Invalid or non-existent guardianRegNo for student regNo: {$userData['regNo']}";
                        continue;
                    }
                    if ($this->AllStudentsModel->studentIdExists($studentData['student_id'])) {
                        $errors[] = "Duplicate student_id: {$studentData['student_id']}";
                        continue;
                    }
                    if (!$this->AllStudentsModel->insertStudent($studentData)) {
                        $errors[] = "Failed to insert student regNo: {$userData['regNo']}";
                    }
                } elseif ($userData['role'] === 'parent') {
                    $parentData = [
                        'regNo' => $userData['regNo'],
                        // 'firstName' => ucwords(strtolower($userData['username'])), // Using username as firstName
                        // 'lastName' => '',
                        'occupation' => isset($row[13]) && $row[13] !== '' ? ucwords(strtolower(trim($row[13]))) : 'Not Specified',
                        'relationship' => isset($row[14]) && $row[14] !== '' ? trim($row[14]) : 'Guardian'

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
        $data['emailErrors'] = $emailErrors;
        if ($successCount === 0 && empty($errors)) {
            $data['message'] = 'No valid data found in the CSV.';
        }
    
        $this->view('inc/admin/uploadResult', $data);
    }

    }
?>