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
        checkRole('student');

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
                $_SESSION['error'] = "Invalid Student ID or Access Denied.";
                header("Location: " . URLROOT . "/CharacterCertificate/submit");
                exit();
            }

            $data = [
                'certificate_id' => $this->generateUniqueCertificateId(),
                'full_name' => trim($_POST['fullName']),
                'student_id' => $enteredStudentId,
                'date_of_birth' => trim($_POST['dob']),
                'reason' => trim($_POST['reason']),
            ];

            $validationErrors = $this->characterCertificateModel->validate($data);

            if (!empty($validationErrors)) {
                $studentDetails = $this->studentModel->getStudentDetails($regNo);
                $this->view('inc/student/character', [
                    'errors' => $validationErrors,
                    'studentDetails' => $studentDetails,
                    'reason' => $data['reason']
                ]);
                return;
            }

            $this->characterCertificateModel->insert($data);

            $_SESSION['success'] = "Character Certificate Application submitted successfully.";
            header("Location: " . URLROOT . "/CharacterCertificate/submit");
            exit();
        } else {
            $studentDetails = $this->studentModel->getStudentDetails($regNo);
            $this->view('inc/student/character', [
                'studentDetails' => $studentDetails,
                'reason' => '',
                'errors' => []
            ]);
        }
    }

    private function generateUniqueCertificateId() {
        return abs(crc32(uniqid('', true)));
    }
}
