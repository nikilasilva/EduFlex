<?php
    class Teacher extends Controller {
        public function __construct() {
        }

        // View all teachers.
        public function teachers() {
            $this->view('all_teachers');
        }
    }
?>