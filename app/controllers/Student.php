<?php
    class Student extends Controller {
        public function __construct() {
        }

        // View all students.
        public function students() {
            $this->view('all_students');
        }
    }
?>