<?php
class ViewTimeTable extends Controller {

    private $ViewTimeTableModel;
    private $studentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->ViewTimeTableModel = new ViewTimeTableModel();
        $this->studentModel = new StudentModel();
    }

    public function timeTable() {
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
        $timetableRaw = $this->ViewTimeTableModel->getStudentTimetable($studentId);

        // Structure: ['08:00-09:00' => ['Monday' => [...], 'Tuesday' => [...]]]
        $timetable = [];

        if (!empty($timetableRaw)) {
        foreach ($timetableRaw as $row) {
            $timeSlot = $row->startTime;
            $day = $row->day;
            $subject = $row->subjectName;

            $timetable[$timeSlot][$day] = [
                'subject' => $subject,
            ];
        }
        }

        $this->view('inc/student/time_table', [
            'timetable' => $timetable
        ]);
    }

    public function timetables(){
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $studentId = trim($_POST['student_id']);
            $parentRegNo = $_SESSION['user']['regNo'];
    
            // Check if student belongs to the logged-in parent
            $students = $this->ViewTimeTableModel-> viewTimeTable($parentRegNo);
            $allowedStudentIds = array_map(fn($s) => $s->student_id, $students);
    
            if (!in_array($studentId, $allowedStudentIds)) {
                $this->view('inc/Parent/aca_parent', ['error' => 'Invalid Student ID or access denied.']);
                return;
            }
    
            // Fetch and show marks
            $timetableRaws = $this->ViewTimeTableModel->getStudentTimetable($studentId);

            $timetables = []; 
            
            if (!empty($timetableRaws)) {
                foreach ($timetableRaws as $row) {
                    $timeSlot = $row->startTime;
                    $day = $row->day;
                    $subject = $row->subjectName;
        
                    $timetables[$timeSlot][$day] = [
                        'subject' => $subject,
                    ];
                }
            }

           
            $this->view('inc/Parent/ViewTime_Table', [
                'timetables' => $timetables,
                'studentId' => $studentId	
            ]);
        } else {
         $this->view('inc/Parent/ViewTime_Table');
    }

}
}
?>
