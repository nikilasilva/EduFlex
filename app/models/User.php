<?php

class User {
    use Model;

    protected $table = 'users';
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
        "role",
        // "must_reset_password",
        "profile_picture"
    ];
    protected $order_column = 'regNo';
    protected $primaryKey = 'regNo';

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

    public function updatePassword($regNo, $hashedPassword) {
        return $this->update(['regNo' => $regNo], ['password' => $hashedPassword]);
    }

    public function regNoExists($regNo) {
        return $this->first(['regNo' => $regNo]) !== false;
    }

    public $errors = [];

    public function validate($data) {
        $this->errors = [];

        // Email validation
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'A valid email address is required.';
        }

        // Mobile number validation
        if (empty($data['mobileNo']) || !preg_match('/^\d{10,15}$/', $data['mobileNo'])) {
            $this->errors['mobileNo'] = 'A valid mobile number is required (10-15 digits).';
        }

        // Username validation
        if (empty($data['username'])) {
            $this->errors['username'] = 'Username is required.';
        }

        // Password validation
        if (empty($data['password']) || strlen($data['password']) < 6) {
            $this->errors['password'] = 'Password must be at least 6 characters long.';
        }

        // Date of birth validation
        if (empty($data['dob'])) {
            $this->errors['dob'] = 'Date of birth is required.';
        }

        // Gender validation
        if (empty($data['gender']) || !in_array($data['gender'], ['Male', 'Female', 'Other'])) {
            $this->errors['gender'] = 'A valid gender is required.';
        }

        // Religion validation
        if (empty($data['religion'])) {
            $this->errors['religion'] = 'Religion is required.';
        }

        // Role validation
        if (empty($data['role']) || !in_array($data['role'], ['admin', 'teacher', 'student', 'principal', 'vice-principal', 'non-academic', 'parent'])) {
            $this->errors['role'] = 'A valid role is required.';
        }

        return empty($this->errors);
    }

    // public function clearResetFlag($regNo) {
    //     return $this->update(['regNo' => $regNo], ['must_reset_password' => 0]);
    // }


    public function update($conditions, $data) {
        if (empty($data) || empty($conditions) || !isset($conditions['regNo'])) {
            return false;
        }

        $query = "UPDATE $this->table SET ";
        $updates = [];
        $params = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowedColumns)) {
                $updates[] = "$key = ?";
                $params[] = $value; // e.g., $hashedPassword
            }
        }

        if (empty($updates)) {
            return false;
        }

        $query .= implode(', ', $updates);
        $query .= " WHERE regNo = ?";
        $params[] = $conditions['regNo']; // e.g., $regNo

        $result = $this->query($query, $params);
        return $result !== false;
    }

    public function updateProfilePicture($regNo, $file) {
        if (!is_numeric($regNo) || $regNo <= 0) {
            $this->errors['regNo'] = 'Invalid registration number';
            return false;
        }

        if (empty($file['name']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return true;
        }

        // validate file
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024; // 2MB
        if (!in_array($file['type'], $allowedTypes)) {
            $this->errors['profile_picture'] = 'Only JPEG or PNG files are allowed';
            return false;
        }
        if ($file['size'] > $maxSize) {
            $this->errors['profile_picture'] = 'File size must be less than 2MB';
            return false;
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors['profile_picture'] = 'File upload failed';
            return false;
        }
        // Generate file path
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = $regNo . '.' . $extension;
        $uploadDir = 'public/img/profiles/';
        $uploadPath = APPROOT . '/../' . $uploadDir . $filename; // Absolute path

        // Ensure upload directory exists
        if (!is_dir(APPROOT . '/../' . $uploadDir)) {
            if (!mkdir(APPROOT . '/../' . $uploadDir, 0755, true)) {
                $this->errors['profile_picture'] = 'Failed to create upload directory';
                error_log("Failed to create directory: " . APPROOT . '/../' . $uploadDir);
                return false;
            }
        }

        // Check directory permissions
        if (!is_writable(APPROOT . '/../' . $uploadDir)) {
            $this->errors['profile_picture'] = 'Upload directory is not writable';
            error_log("Directory not writable: " . APPROOT . '/../' . $uploadDir);
            return false;
        }

        // Move file
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $this->errors['profile_picture'] = 'Failed to save profile picture';
            error_log("Failed to move file to: $uploadPath");
            return false;
        }

        // Delete old picture (if exists)
        $user = $this->first(['regNo' => $regNo]);
        if ($user && !empty($user->profile_picture) && file_exists(APPROOT . '/../' . $user->profile_picture)) {
            unlink(APPROOT . '/../' . $user->profile_picture);
        }

        // Update database with relative path
        $dbPath = $uploadDir . $filename;
        if (!$this->update(['regNo' => $regNo], ['profile_picture' => $dbPath])) {
            $this->errors['profile_picture'] = 'Failed to update database';
            error_log("Failed to update profile_picture for regNo=$regNo");
            return false;
        }

        error_log("Profile picture updated for regNo=$regNo: $dbPath");
        return true;
    }
}
?>
