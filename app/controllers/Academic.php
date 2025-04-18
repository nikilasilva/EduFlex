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
}
