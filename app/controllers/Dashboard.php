<?php
class Dashboard extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Load the dashboard view
    public function index() {
        // Pass user data to the dashboard view
        if (!isset($_SESSION['user'])) {
            $data = [
                'user' => 'guest'
            ];
        }
        else {
            $data = [
                'user' => $_SESSION['user']
            ];
        }
        $this->view('dashboard', $data);
    }
}
?>