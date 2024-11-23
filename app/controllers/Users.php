<?php
require_once APPROOT. '/models/User.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
}
?>
