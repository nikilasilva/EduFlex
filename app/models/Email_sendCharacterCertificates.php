<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

class Email_sendCharacterCertificates
{
    protected $mail;

    public function __construct()
    {
        $this->configureMail();
    }

    private function configureMail()
    {
        $mail = new PHPMailer(true);
        $this->mail = $mail;
    }

    private function configureSMTP()
    {
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'Eduflex.schools@gmail.com';
        $this->mail->Password = 'rvao yubc uhiv xqbw';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function sendEailCharacterCertificates($timeSlot, $day, $recipientEmail)
    {
        try {
            $this->configureSMTP();
            $this->mail->setFrom('Eduflex.schools@gmail.com', 'EduFlex');
            $this->mail->addAddress($recipientEmail, "student");
            $this->mail->Subject = 'Leaving Certificate Collection Details';

            $this->mail->Body = "
                <p>Dear Student,</p>
                <p>Your character certificate is complete. You can collect it on <strong>{$day}</strong> between <strong>{$timeSlot}</strong>.</p>
                <p>Best regards,<br>Non-Academic Staff<br>Rajasinghe College</p>
            ";
            $this->mail->AltBody = "Your leaving certificate is ready. Collect it on {$day} between {$timeSlot}.";

            $this->mail->send();

            return true;
        } catch (Exception $e) {
            return "Email could not be sent. Error: {$this->mail->ErrorInfo}";
        }
    }

    public function sendMail() {}
}

