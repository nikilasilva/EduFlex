<?php

class dev3_Users {
    use Model;

    protected $table = 'Users'; // Your actual table name
    protected $order_column = 'userID'; // Default order column

    // Only these columns will be allowed in insert/update operations
    protected $allowedColumns = [
        'email',
        'mobileNo',
        'address',
        'firstName',
        'lastName',
        'username',
        'password',
        'dob',
        'gender',
        'religion',
        'role'
    ];

    // Example: validate user registration data
    public function validate($data) {
        $this->errors = [];

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "A valid email is required.";
        }

        if (empty($data['username'])) {
            $this->errors['username'] = "Username is required.";
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            $this->errors['password'] = "Password must be at least 6 characters.";
        }

        return empty($this->errors);
    }

    // Example: get user by email
    public function getUserByEmail($email) {
        return $this->first(['email' => $email]);
    }

    // Example: get users by role
    public function getUsersByRole($role) {
        return $this->where(['role' => $role]);
    }
}
