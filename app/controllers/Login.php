<?php
require_once APPROOT . '/models/User.php';
session_start();

class Login extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        $this->view('login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = [
                    'regNo' => $user->regNo,
                    'email' => $user->email,
                    'username' => $user->username,
                    'role' => $user->role,
                ];

                header('Location: ' . URLROOT . '/Dashboard/index');
                exit();
            } else {
                $error = "Invalid email or password.";
                $this->view('login', ['error' => $error]);
            }
        } else {
            $this->index();
        }
    }

    public function logout() {
        // Clear session data and destroy the session
        $_SESSION = [];
        session_destroy();
    
        // Redirect to the landing page
        header('Location: ' . URLROOT . '/Dashboard/index');
        exit();
    }
    
}
