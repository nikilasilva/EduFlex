<?php
class AttendanceController {
    private $attendanceModel;

    public function __construct() {
        $this->attendanceModel = new P_ViewAttendanceModel();
    }

    public function index() {
        $student_id = $this->attendanceModel->getStudentId();
        $data = [];

        if ($student_id) {
            $data['attendanceData'] = $this->attendanceModel->getAttendanceByStudentId($student_id);
            $data['studentId'] = $student_id;
        } else {
            $data['attendanceData'] = $this->attendanceModel->findAll();
        }

        $data['currentMonth'] = date('F');
        ; // For debugging

        // Pass the data to the view
        $this->view('inc/student/attendance', $data);
    }

    // The view method to load the view template
    public function view($view, $data = []) {
        // Check if the view file exists
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data); // Extract data as variables
            include($viewPath); // Include the view file
        } else {
            die("View file not found: " . $view);
        }
    }
}
