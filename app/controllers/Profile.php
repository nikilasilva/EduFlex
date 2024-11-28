<?php
require_once APPROOT .'/models/User.php';
session_start();

class Profile extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();

        // Ensure user is logged in 
        if (!isset($_SESSION['user'])) {
            header("Location: " . URLROOT . "/Login/index");
            exit();
        }
    }

    public function index() {
        $user = $this->userModel->findUserByEmail($_SESSION['user']['email']);
        $data = [
            'user' => $user
        ];

        $this->view('userProfile', $data);
    }
}