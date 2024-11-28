<?php
    class Student extends Controller {
        private $StudentModel;

        public function __construct() {
          // $this->StudentModel = $this->model('StudentModel');
          // $this->model('StudentModel');
        }

        // View all students.
        public function students() {
            $this->view('inc/student/all_students');
        }

        public function details() {
            //
            // $Student = $this->StudentModel->getUsers();

            // $data = [
            //     'Student' => $Student
            // ];

            //
            $this->view('inc/student/details');

        }
//
        public function view($view, $data = []) {
            require_once "../app/views/{$view}.php";
        }


        public function certificate() {
            $this->view('inc/student/certificate');
        }

        public function form() {
            $this->view('inc/student/chargesForm');
        }

        public function academic(){
            $this->view('inc/student/aca_details');
        }

        public function payment(){
            $this->view('inc/student/pay_details');
        }

        public function library_fine(){
            $this->view('inc/student/libry_fine');
        }

        public function f_s(){
            $this->view('inc/student/F_S');
        }

        public function character(){
            $this->view('inc/student/character');
        }

        public function leaving(){
            $this->view('inc/student/leaving');
        }

        public function attendance(){
            
            $this->view('inc/student/attendance'); 
        }

        public function events() {
            // Example events array (replace with your actual data)
            $data = [
                'events' => [
                    '2024-01-19' => 'Event 1',
                    '2024-01-20' => 'Event 2',
                ],
                'upcomingEvents' => [
                    ['date' => '2024-01-19', 'description' => 'Event 1 Description'],
                    ['date' => '2024-01-20', 'description' => 'Event 2 Description'],
                ],
                'reminders' => [
                    ['date' => '2024-01-18', 'description' => 'Reminder 1'],
                    ['date' => '2024-01-19', 'description' => 'Reminder 2'],
                ]
            ];
    
            // Load the view and pass data
            $this->view('scheduled_events', $data);
        }

        public function timeTable() {
            // Sample timetable data (you can retrieve this from a database in real use cases)
            $data = [
                'timeTable' => [
                    ['time' => '08:30 - 09:30', 'monday' => 'Period 1', 'tuesday' => 'Period 1', 'wednesday' => 'Period 1', 'thursday' => 'Period 1', 'friday' => 'Period 1'],
                    ['time' => '09:30 - 10:30', 'monday' => 'Period 2', 'tuesday' => 'Period 2', 'wednesday' => 'Period 2', 'thursday' => 'Period 2', 'friday' => 'Period 2'],
                    ['time' => '10:30 - 11:00', 'monday' => 'Lunch 1', 'tuesday' => 'Lunch 1', 'wednesday' => 'Lunch 1', 'thursday' => 'Lunch 1', 'friday' => 'Lunch 1'],
                    ['time' => '11:00 - 12:00', 'monday' => 'Period 3', 'tuesday' => 'Period 3', 'wednesday' => 'Period 3', 'thursday' => 'Period 3', 'friday' => 'Period 3'],
                    ['time' => '12:00 - 1:00', 'monday' => 'Period 4', 'tuesday' => 'Period 4', 'wednesday' => 'Period 4', 'thursday' => 'Period 4', 'friday' => 'Period 4'],
                    ['time' => '1:00 - 1:30', 'monday' => 'Lunch 2', 'tuesday' => 'Lunch 2', 'wednesday' => 'CONNECT', 'thursday' => 'Lunch 2', 'friday' => 'Lunch 2'],
                    ['time' => '1:30 - 2:30', 'monday' => 'Period 5', 'tuesday' => 'Period 5', 'wednesday' => 'CONNECT', 'thursday' => 'Period 5', 'friday' => 'Period 5']
                ]
            ];

            // Load the view and pass the timetable data
            $this->view('inc/student/time_table', $data);
        }




    }



?>