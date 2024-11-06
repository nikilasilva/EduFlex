<?php
    class Student extends Controller {
        public function __construct() {
        }

        // View all students.
        public function students() {
            $this->view('all_students');
        }

        public function details() {
            $this->view('details');
        }


        public function certificate() {
            $this->view('certificate');
        }

        public function form() {
            $this->view('chargesForm');
        }

        public function academic(){
            $this->view('aca_details');
        }

        public function payment(){
            $this->view('pay_details');
        }

        public function library_fine(){
            $this->view('libry_fine');
        }

        public function f_s(){
            $this->view('F_S');
        }

        public function character(){
            $this->view('character');
        }

        public function leaving(){
            $this->view('leaving');
        }



    }



?>