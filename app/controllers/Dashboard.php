<?php
    class Dashboard extends Controller {
        public function __construct() {
            // Ensure the user is logged in before accessing the dashboard
            // if (isLoggedIn()) {
            //     redirect('users/login');
            // }
        }

        // Load the same dashboard view for all users.
        public function index() {
            $this->view('dashboard');
        }
    }
?>