<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
class mail
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
        $this->mail->Host = 'smtp.gmail.com'; // SMTP server
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'c.t.gamlath@gmail.com';
        $this->mail->Password = 'wsnx vvbp hiet wcex'; // app password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function forwardMinuteContent()
    {
        try {
            $this->configureSMTP();
            $this->mail->setFrom('c.t.gamlath@gmail.com', 'MinuteMate');
            $this->mail->addAddress("gamlathcharitha@gail.com", "charitha"); // Recipient
            $this->mail->Subject = 'Forwarded Minute Content';
            // $this->mail->addCC($depheademail, $depheadname); //cc
            $this->mail->Body = '
                        <p>Dear Student,</p>
            <p>Your leaving certificate is complete. You can come between <strong>8:00 AM and 12:00 PM</strong> to collect it.</p>
            <p>Best regards,<br>Non-Academic Staff<br>[School Name]</p>';
            $this->mail->AltBody = 'Forwarded Minute Content';

            $this->mail->send();

            return true;
        } catch (Exception $e) {
            return "Email could not be sent. Error: {$this->mail->ErrorInfo}";
        }
    }
    public function sendMail() {}
}
