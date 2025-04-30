<?php
class CharacterCertificate extends Controller {
    private $characterCertificateModel;
    private $studentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->characterCertificateModel = new CharacterCertificateModel();
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
                'student_id' =>  $enteredStudentId,
                'date_of_birth' => trim($_POST['dob']),
                'reason' => trim($_POST['reason']),
                
            ];

            try {
                $validationErrors = $this->characterCertificateModel->validate($data);
    
                if (!empty($validationErrors)) {
                    throw new Exception(implode(', ', $validationErrors));
                }
                // Optional: Validate input data if validation is implemented
                // $validationErrors = $this->characterCertificateModel->validate($data);
                // if (!empty($validationErrors)) {
                //     throw new Exception(implode(', ', $validationErrors));
                // }

                $this->characterCertificateModel->insert($data);

              
                    header("Location: " . URLROOT . "/CharacterCertificate/submit");
                //     exit();
                // } else {
                //     throw new Exception("Failed to insert data.");
                
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = [$e->getMessage()];
                $this->view('inc/student/character', $data);
                exit();
            }
        }else {
            $student = $this->studentModel->getStudentDetails($regNo);
    
            $data = [
                'reason' => '',
                'studentDetails' => $student,
                
            ];
           
            
            $this->view('inc/student/character', $data);
            return;
        }
    }

    private function generateUniqueCertificateId() {
        return abs(crc32(uniqid('', true)));
    }



    private function uploadFile($file) {
        $uploadDir = __DIR__ . '/../../uploads/';
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception("Failed to create upload directory.");
            }
        }

        if (empty($file['name'])) {
            throw new Exception("No file uploaded.");
        }

        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type. Only JPG, PNG, and PDF are allowed.");
        }

        if ($file['size'] > $maxFileSize) {
            throw new Exception("File is too large. Maximum size is 5MB.");
        }

        $filename = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $filename;
        } else {
            throw new Exception("File upload failed.");
        }
    }
    private function validateInput($data) {
        $errors = [];

        if (!preg_match('/^S\d{4}$/', $data['student_id'])) {
            $errors[] = "Invalid Student ID. Format should be S000.";
        }

        if (strtotime($data['date_of_birth']) > time()) {
            $errors[] = "Date of birth cannot be in the future.";
        }


        if (strtotime($data['Admission_date']) > time()) {
            $errors[] = "Admission date is invalid.";
        }

        if (empty($data['reason'])) {
            $errors[] = "Reason  is required.";
        }

        return $errors;
    }


    

   
}
