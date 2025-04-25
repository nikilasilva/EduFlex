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

    // public function submit() {
    //     if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    //         header("Location: " . URLROOT . "/login");
    //         exit();
    //     }
           
    //     $regNo = $_SESSION['user']['regNo'];
    //     if (!$regNo) die("Student registration number not found.");
    
    //     $student = $this->studentModel->getStudentByRegNo($regNo);
    //     if (!$student) die("Student not found.");
    
    //     $student_id = $student->student_id;
    
        
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $allowedStudentIds = array_map(fn($s) => $s->student_id, $student);

          

    //         $data = [
    //             'certificate_id' => $this->generateUniqueCertificateId(),
    //             'full_name' => trim($_POST['fullName']),
    //             'student_id' => $_SESSION['user']['student_id'],
    //             'DOB' => trim($_POST['dob']),
    //             'Admission_date' => trim($_POST['admissionDate']),
    //             'Reason' => trim($_POST['reason'])
    //         ];

              
    //         if (!in_array($student_id, $allowedStudentIds)) {
    //             $error = 'Invalid Student ID or access denied.';
    //         } else {
    //             $insertResult = $this->leavingCertificateModel->insert($data);
    //         }

    //         try {
    //             $validationErrors = $this->validateInput($data);

    //             if (!empty($validationErrors)) {
    //                 throw new Exception(implode(', ', $validationErrors));
    //             }

    //             $insertResult = $this->leavingCertificateModel->insert($data);
    //             if ($insertResult) {
    //                 header("Location: " . URLROOT . "/Student/leaving");
    //                 exit();
    //             } else {
    //                 throw new Exception("Failed to insert data.");
    //             }
    //         } catch (Exception $e) {
    //             error_log($e->getMessage());
    //             $data['errors'] = [$e->getMessage()];
    //             $this->view('inc/student/leaving', $data);
    //             exit();
    //         }
    //     }
    // }

    public function submit() {
        checkRole('student'); // Ensure the user is a student

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
           
        // Get the student's registration number from the session
        $regNo = $_SESSION['user']['regNo'];
        if (!$regNo) die("Student registration number not found.");
        
        // Retrieve the student details based on the registration number
        $student = $this->studentModel->getStudentByRegNo($regNo);
        if (!$student) die("Student not found.");
        
        // Ensure the entered student ID matches the student's ID in the session
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve student ID from the POST data
            $enteredStudentId = trim($_POST['student_id']);
            
            // Check if the entered student ID matches the session's student ID
            if ($enteredStudentId !== $student->student_id) {
                $data['errors'] = ["Invalid ID or access Denied."];
                $this->view('inc/student/leaving', $data);
                return;
            }
            
            // Prepare data for the leaving certificate
            $data = [
                'certificate_id' => $this->generateUniqueCertificateId(),
                'full_name' => trim($_POST['fullName']),
                'student_id' => $enteredStudentId,  // Use entered student ID
                'DOB' => trim($_POST['dob']),
                'Admission_date' => trim($_POST['admissionDate']),
                'Reason' => trim($_POST['reason'])
            ];
    
            try {
                // Validate input data
                $validationErrors = $this->validateInput($data);
    
                if (!empty($validationErrors)) {
                    throw new Exception(implode(', ', $validationErrors));
                }
    
                // Insert the leaving certificate data into the database
                $insertResult = $this->leavingCertificateModel->insert($data);
                if ($insertResult) {
                    header("Location: " . URLROOT . "/Student/leaving");
                    exit();
                } else {
                    throw new Exception("Failed to insert data.");
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = [$e->getMessage()];
                $this->view('inc/student/leaving', $data);
                exit();
            }
        } 
        // else {
        //     $student = $this->studentModel->getStudentByRegNo($regNo);
        //     $data = [
        //         'full_name' => $student->full_name,
        //         'student_id' => $student->student_id,
        //         'DOB' => $student->DOB,
        //         'Admission_date' => $student->Admission_date,
        //         'Reason' => ''
        //     ]
        //     $this->view('inc/student/leaving', $data);
        //     return;
        // }
    }
    
    private function generateUniqueCertificateId() {
        return abs(crc32(uniqid('', true)));
    }

    private function validateInput($data) {
        $errors = [];

        // Student ID format
        if (!preg_match('/^S\d{3}$/', $data['student_id'])) {
            $errors[] = "Invalid Student ID. Format should be S000.";
        }

        // DOB should not be after today
        if (strtotime($data['DOB']) > time()) {
            $errors[] = "Date of birth cannot be in the future.";
        }

        // Admission date must be after DOB and not in the future
        if (strtotime($data['Admission_date']) <= strtotime($data['DOB'])) {
            $errors[] = "Admission date is invalid.";
        }

        if (strtotime($data['Admission_date']) > time()) {
            $errors[] = "Admission date is invalid.";
        }

        return $errors;
    }
}
