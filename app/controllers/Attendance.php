<?php

class Attendance {
    private $attendanceModel;

    public function __construct() {
        $this->attendanceModel = new P_ViewAttendanceModel();
    }

    public function index() {
        // Get student ID
        $student_id = $_GET['student_id'] ?? $this->attendanceModel->getStudentId();

        // Default to current month/year
        $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
        $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

        $data = [
            'studentId' => $student_id,
            'month' => $month,
            'year' => $year,
            'attendanceData' => [],
        ];

        if ($student_id) {
            // Build start and end dates
            $startDate = sprintf('%04d-%02d-01', $year, $month);
            $endDate = date('Y-m-t', strtotime($startDate)); // End of month

            // Get attendance data for selected month
            $data['attendanceData'] = $this->attendanceModel->getAttendanceByStudentIdAndMonth($student_id, $startDate, $endDate);
        }

        $this->view('inc/student/attendance', $data);
    }

    public function view($view, $data = []) {
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            include($viewPath);
        } else {
            die("View file not found: " . $view);
        }
    }
}
