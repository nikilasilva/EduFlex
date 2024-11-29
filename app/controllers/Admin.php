<?php

class Admin extends Controller {
    private $userModel;

    public function __construct() {
        // Initialize the User model
        $this->userModel = new User();  
    }  

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Collect data
            $data = [
                'email' => trim($_POST['email']),
                'mobileNo' => trim($_POST['mobileNo']),
                'address' => trim($_POST['address']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'dob' => trim($_POST['dob']),
                'gender' => trim($_POST['gender']),
                'religion' => trim($_POST['religion']),
                'role' => trim($_POST['role']),
            ];

            // Validate the input data
            if ($this->userModel->validate($data)) {
                // Hash password before saving
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Insert user data
                if ($this->userModel->insert($data)) {
                    header("Location: " . URLROOT . "/Admin/addUser");
                    exit();
                } else {
                    die('Something went wrong while saving user data.');
                }
            } else {
                // Load the form with errors
                $this->view('inc/admin/addUser', ['errors' => $this->userModel->errors]);
            }
        } else {
            // Load the form with empty data
            $this->view('inc/admin/addUser');
        }
    }

    public function listUsers() {
        $users = $this->userModel->findAll();
        $data = [
            'users' => $users,
        ];
        $this->view('inc/admin/listUsers', $data); // Pass data as an associative array
    }    

    public function deleteUser($id) {
        if ($this->userModel->delete($id, 'regNo')) {
            header("Location: " . URLROOT . "/Admin/listUsers");
            exit();
        } else {
            die('Failed to delete the user.');
        }
    }


}
