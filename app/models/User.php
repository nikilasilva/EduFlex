<?php
// require_once APPROOT . '/libraries/Model.php';

class User {
    use Model;

    protected $table = 'users1';
    protected $allowedColumns = [
        "regNo",
        "email",
        "mobileNo",
        "address",
        "username",
        "password",
        "dob",
        "gender",
        "religion",
        "role"
    ];
    protected $order_column = 'regNo';

    public function findUserByEmail($email) {
        return $this->first(['email' => $email]);
    }

    public function storeResetToken($userId, $token) {
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour
        $data = [
            'reset_token' => $token,
            'token_expiry' => $expiry,
        ];

        return $this->update($userId, $data);
    }

    public function updatePassword($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->update($email, ['password' => $hashedPassword], 'email');
    }
}
?>