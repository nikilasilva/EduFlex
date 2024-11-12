<?php
    class Parents extends Controller {
        public function __construct() {
        }

        // Default method for this controller
        public function index() {
            $this->view('inc/Parent/default'); // Adjust the view as needed
        }

        // View all students
        public function feedback() {
            $this->view('inc/Parent/feedbacks');
        }

        public function details() {
            $this->view('inc/Parent/details_parent');
        }

        public function academic_details() {
            $this->view('inc/Parent/aca_parent');
        }

        public function pay_details() {
            $this->view('inc/Parent/parent_pay');
        }

        public function charges_form() {
            $this->view('inc/Parent/parent_charges');
        }
    }
?>
