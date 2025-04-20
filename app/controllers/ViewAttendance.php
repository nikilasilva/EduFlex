<?php

// require_once '../app/models/ViewAttendanceModel.php';
require_once '../app/models/StudentModel.php';

class ViewAttendance extends Controller {
    private $ViewAttendanceModel;
    private $studentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->ViewAttendanceModel = $this->model('ViewAttendanceModel');
        $this->studentModel = $this->model('StudentModel');
    }

    public function attendance() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        $regNo = $_SESSION['user']['regNo'] ?? null;
        if (!$regNo) die("Student registration number not found.");
    
        $student = $this->studentModel->getStudentByRegNo($regNo);
        if (!$student) die("Student not found.");
    
        $studentId = $student->student_id;
    
        // Handle month and year navigation
        $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
        $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
    
        // Prevent invalid months
        if ($month < 1) {
            $month = 12;
            $year--;
        } elseif ($month > 12) {
            $month = 1;
            $year++;
        }
    
        $attendance = $this->ViewAttendanceModel->getAttendanceByMonthYear($studentId, $month, $year);
    
        $this->view('inc/student/attendance', [
            'attendance' => $attendance,
            'student' => $student,
            'month' => $month,
            'year' => $year
        ]);
    }

    public function attendanceParent() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        $studentId = null;
        $attendance = [];
        $error = null;
        $month = date('n');
        $year = date('Y');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = trim($_POST['student_id']);
            $month = isset($_POST['month']) ? (int)$_POST['month'] : $month;
            $year = isset($_POST['year']) ? (int)$_POST['year'] : $year;
    
            $parentRegNo = $_SESSION['user']['regNo'];
            $students = $this->ViewAttendanceModel->getAttendanceByParentRegNo($parentRegNo);
            $allowedStudentIds = array_map(fn($s) => $s->student_id, $students);
    
            if (!in_array($studentId, $allowedStudentIds)) {
                $error = 'Invalid Student ID or access denied.';
            } else {
                $attendance = $this->ViewAttendanceModel->getAttendanceByMonthYear($studentId, $month, $year);
            }
        }
    
        $this->view('inc/Parent/attendance_parent', [
            'attendance' => $attendance,
            'studentId' => $studentId,
            'month' => $month,
            'year' => $year,
            'error' => $error
        ]);
    }
}    