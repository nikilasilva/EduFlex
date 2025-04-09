<?php

class Timetable extends Controller {
    private $timetableModel;
    private $classModel;

    public function __construct() {
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        $this->timetableModel = $this->model('TimetableModel');
        $this->classModel = $this->model('ClassModel');
    }

    public function index() {
        $this->classTimetable();
    }

    public function classTimetable() {
        // For regular page load
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->classModel->setLimit(50);
            $classes = $this->classModel->findAll();
            $data = [
                'classes' => $classes,
                'timetable' => []
            ];
            $this->view('inc/timetables/classTimetable', $data);
        } 
        // For AJAX requests
        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if this is an AJAX request
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
                      
            // Get JSON input data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            
            $classId = !empty($data['classId']) ? $data['classId'] : null;
            $day = !empty($data['day']) ? $data['day'] : null;
            
            if ($classId && $day) {
                $timetable = $this->timetableModel->getTimetableByClassAndDay($classId, $day);
                
                // Return JSON response
                header('Content-Type: application/json');
                echo json_encode($timetable);
                exit;
            } else {
                // Return empty array if no selection
                header('Content-Type: application/json');
                echo json_encode([]);
                exit;
            }
        }
    }

    public function teacherTimetable() {
        $this->view('inc/timetables/teacherTimetable');
    }
}
?>