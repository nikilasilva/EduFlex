<?php
require_once APPROOT . '/libraries/Model.php';

class User {
    use Model;

    protected $table = 'users';
    protected $allowedColumns = ['email', 'password', 'username', 'role', 'reset_token', 'token_expiry'];
    protected $order_column = 'id';

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
}
?>