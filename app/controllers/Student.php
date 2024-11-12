<?php
    class Student extends Controller {
        public function __construct() {
        }

        // View all students.
        public function students() {
            $this->view('inc/student/all_students');
        }

        public function details() {
            $this->view('inc/student/details');
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



    }



?>