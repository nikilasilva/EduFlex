<?php

class LeavingCertificate extends Controller {
    private $leavingCertificateModel;
    private $studentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->leavingCertificateModel = new LeavingCertificateModel();
        $this->studentModel = new StudentModel();
    }

    public function submit() {
        checkRole('student'); // Ensure the user is a student
    
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        $regNo = $_SESSION['user']['regNo'];
        if (!$regNo) die("Student registration number not found.");
    
        $student = $this->studentModel->getStudentByRegNo($regNo);
        if (!$student) die("Student not found.");
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $enteredStudentId = trim($_POST['student_id']);
    
            if ($enteredStudentId !== $student->student_id) {
                $data['errors'] = ["Invalid ID or access Denied."];
                $this->view('inc/student/leaving', $data);
                return;
            }
    
            $data = [
                'certificate_id' => $this->generateUniqueCertificateId(),
                'full_name' => trim($_POST['fullName']),
                'student_id' => $enteredStudentId,
                'DOB' => trim($_POST['dob']),
                'Admission_date' => trim($_POST['dateOfAdmission']),
                'Reason' => trim($_POST['reason'])
            ];
    
            try {
                $validationErrors = $this->validateInput($data);
    
                if (!empty($validationErrors)) {
                    throw new Exception(implode(', ', $validationErrors));
                }
    
                $this->leavingCertificateModel->insert($data);
                
                    header("Location: " . URLROOT . "/LeavingCertificate/submit");
                    
                // } else {
                //     throw new Exception("Failed to insert data.");
                
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = [$e->getMessage()];
                $this->view('inc/student/leaving', $data);
                exit();
            }
        } else {
            $student = $this->studentModel->getStudentDetails($regNo);
    
            $data = [
                'Reason' => '',
                'studentDetails' => $student,
                
            ];
           
            
            $this->view('inc/student/leaving', $data);
            return;
        }
    }
    

    private function generateUniqueCertificateId() {
        return abs(crc32(uniqid('', true)));
    }

    private function validateInput($data) {
        $errors = [];

        if (!preg_match('/^S\d{4}$/', $data['student_id'])) {
            $errors[] = "Invalid Student ID. Format should be S000.";
        }

        if (strtotime($data['DOB']) > time()) {
            $errors[] = "Date of birth cannot be in the future.";
        }

        if (strtotime($data['Admission_date']) <= strtotime($data['DOB'])) {
            $errors[] = "Admission date is invalid.";
        }

        if (strtotime($data['Admission_date']) > time()) {
            $errors[] = "Admission date is invalid.";
        }

        return $errors;
    }

}
