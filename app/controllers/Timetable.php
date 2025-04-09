<?php

class Timetable extends Controller {
    private $timetableModel;
    private $classModel;

    public function __construct() {
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        // $this->timetableModel = $this->model('TimetableModel');
        $this->classModel = $this->model('ClassModel');
    }

    public function index() {
        $this->classTimetable();
    }

    public function classTimetable() {
        $this->classModel->setLimit(50);
        $classes = $this->classModel->findAll();
        $data = [
            'classes' => $classes
        ];
        $this->view('inc/timetables/classTimetable', $data);
    }

    public function teacherTimetable() {
        $this->view('inc/timetables/teacherTimetable');
    }
}
?>