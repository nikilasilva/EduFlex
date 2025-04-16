<?php
require_once APPROOT. '/models/User.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();

class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Display forgot password form
    public function forgotPassword() {
        $this->view('forgotPassword');
    }

    // Handle sending the reset link
    public function sendResetLink() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $user = $this->userModel->findUserByEmail($email);

            if ($user) {
                // Generate a unique token
                $token = bin2hex(random_bytes(50));
                
                // Save the token to the database
                $this->userModel->storeResetToken($user->id, $token);

                // Send the reset email
                if ($this->sendPasswordResetEmail($email, $token)) {
                    echo "Reset link sent to your email.";
                } else {
                    echo "Failed to send email. Try again later.";
                }
            } else {
                echo "No user found with that email.";
            }
        }
    }

    // Send the password reset email using PHPMailer
    private function sendPasswordResetEmail($email, $token) {
        require '../vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('nikilasilva@gmail.com', 'EduFlex');
            $mail->addAddress($email);

            // Content
            $resetLink = URLROOT . "/users/resetPassword?token=" . $token;
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "<p>Click <a href='$resetLink'>here</a> to reset your password.</p>";
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    public function viewProfile() {
        $this->view('userProfile');
    }

    public function settings() {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);

        if (!$user) {
            die('User not found.');
        }

        $data = [
            'user' => $user,
            'current_password' => '',
            'new_password' => '',
            'confirm_password' => '',
            'errors' => [],
            'message' => ''
        ];
    
        if (isset($_SESSION['message'])) {
            $data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $this->view('userSettings', $data);
    }

    public function updatePassword() {
        // Ensure user is logged in
        if (!isset($_SESSION['user']['regNo']) || !isset($_SESSION['user']['email'])) {
            $_SESSION['error'] = 'Please log into change your password';
            header('Location: '. URLROOT . '/Login/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitize inputs
            $data = [
                'regNo' => $_SESSION['user']['regNo'],
                'current_password' => trim($_POST['current_password'] ?? ''),
                'new_password' => trim($_POST['new_password'] ?? ''),
                'confirm_password' => trim($_POST['confirm_password'] ?? ''),
                'errors' => [],
                'message' => ''
            ];

            // Fetch user
            $user = $this->userModel->findUserByEmail($_SESSION['user']['email']);
            if (!$user) {
                $data['errors']['general'] = 'User account not found';
            }

            // Validate inputs
            if (empty($data['current_password'])) {
                $data['errors']['current_password'] = 'Current password is required';
            } else if ($user && !password_verify($data['current_password'], $user->password)) {
                $data['errors']['current_password'] =' Current password is incorrect';
            }

            if (empty($data['new_password'])) {
                $data['errors']['new_password'] = 'New password is required.';
            } elseif (strlen($data['new_password']) < 8) {
                $data['errors']['new_password'] = 'New password must be at least 8 characters.';
            } elseif (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data['new_password'])) {
                $data['errors']['new_password'] = 'New password must include letters and numbers.';
            } elseif ($user && password_verify($data['new_password'], $user->password)) {
                $data['errors']['new_password'] = 'New password cannot be the same as the current password.';
            }

            if (empty($data['confirm_password'])) {
                $data['errors']['confirm_password'] = 'Please confirm your new password.';
            } elseif ($data['new_password'] !== $data['confirm_password']) {
                $data['errors']['confirm_password'] = 'Passwords do not match.';
            }

            // Process if no errors
            if (empty($data['errors']) && $user) {
                $hashedPassword = password_hash($data['new_password'], PASSWORD_BCRYPT);
                if ($this->userModel->updatePassword($data['regNo'], $hashedPassword)) {
                    // Clear must_reset_password flag
                    $this->userModel->clearResetFlag($data['regNo']);
                    $_SESSION['message'] = 'Password change successfully';
                    header('Location:' . URLROOT . '/users/settings');
                } else {
                    $data['errors']['general'] = 'Failed to update password. Please try again';
                }
            }

            $this->view('userSettings', $data);            
        } 
        else {
            // Display form
            $data = [
                'current_password' => '',
                'new_password' => '',
                'confirm_password' => '',
                'errors' => [],
                'message' => ''
            ];

            // Check if reset is required
            $user = $this->userModel->findUserByEmail($_SESSION['user']['email']);
            if ($user && $user->must_reset_password) {
                $data['message'] = 'You must change your password before continuing';
            }

            $this->view('userSettings', $data);
        }
    }
}
?>
