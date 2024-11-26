<?php
class Dashboard extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Ensure session is started
        }
    }

    // Load the appropriate page based on login status
    public function index() {
        if (!isset($_SESSION['user'])) {
            // If the user is not logged in, redirect to the landing page
            $this->view('landing');
        } else {
            // If the user is logged in, show the dashboard
            $data = [
                'user' => $_SESSION['user']
            ];
            $this->view('dashboard', $data);
        }
    }
}