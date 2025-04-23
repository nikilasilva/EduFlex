<?php

require_once '../app/models/StudentModel.php';
require_once '../app/models/ViewMarksModel.php';

class Academic extends Controller {
    private $ViewMarksModel;
    private $studentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->ViewMarksModel = new ViewMarksModel();
        $this->studentModel = new StudentModel();
    }

    public function academic() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            header("Location: " . URLROOT . "/login");
            exit();
        }

      

        $regNo = $_SESSION['user']['regNo'] ?? null;

        if (!$regNo) {
            die("Student registration number not found.");
        }

        $student = $this->studentModel->getStudentByRegNo($regNo);

        if (!$student) {
            die("Student not found.");
        }

        $studentId = $student->student_id;
        $marks = $this->ViewMarksModel->getStudentMarks($studentId);

        $this->view('inc/student/aca_details', [
            'marks' => $marks,
            'student' => $student
        ]);
    }

    public function academic_details() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = trim($_POST['student_id']);
            $parentRegNo = $_SESSION['user']['regNo'];
    
            // Check if student belongs to the logged-in parent
            $students = $this->ViewMarksModel->getStudentsMarksByParentRegNo($parentRegNo);
            $allowedStudentIds = array_map(fn($s) => $s->student_id, $students);
    
            if (!in_array($studentId, $allowedStudentIds)) {
                $this->view('inc/Parent/aca_parent', ['error' => 'Invalid Student ID or access denied.']);
                return;
            }
    
            // Fetch and show marks
            $marks = $this->ViewMarksModel->getStudentMarks($studentId);
            $this->view('inc/Parent/aca_parent', [
                'marks' => $marks,
                'studentId' => $studentId
            ]);
        } else {
            // Initial load of form
            $this->view('inc/Parent/aca_parent');
        }
    }
    
}
