<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class CurrentActivities extends Controller {
    private $currentActModel;

    public function __construct() {
        checkRole('principal');
        // Load the currrentActModel
        $this->currentActModel = $this->model('CurrentActModel');
    }

    public function allFreeClasses() {
        // Fetch free classes from the model
        $freeClasses = $this->currentActModel->getFreeClasses();
        
        // Prepare data for the view
        $data = [
            'freeClasses' => []
        ];

        // Check if $freeClasses is an array and not false
        if (is_array($freeClasses) && !empty($freeClasses)) {
            $data['freeClasses'] = array_map(function ($class) {
                return [
                    'className' => $class->className,
                    'subjectName' => $class->subjectName,
                    'periodName' => $class->periodName,
                    'roomNumber' => $class->roomNumber,
                    'subjectId' => $class->subjectId,
                    'periodId' => $class->periodId,
                    'day' => $class->day
                ];
            }, $freeClasses);
        } else {
            // Optionally add a message to display in the view
            $data['message'] = 'No free classes found for today.';
        }

        // Pass the data to the view
        $this->view('inc/principal/viewCurrentActivities/allFreeClasses', $data);
    }

    public function showAvailableTeachers() {
        // Fetch parameters from $_GET
        $subjectId = isset($_GET['subjectId']) ? $_GET['subjectId'] : null;
        $periodId = isset($_GET['periodId']) ? $_GET['periodId'] : null;
        $day = isset($_GET['day']) ? $_GET['day'] : null;

        $availableTeachers = $this->currentActModel->getAvailableTeachers($subjectId, $periodId, $day);
        
        $data = [
            'availableTeachers' => []
        ];

        if (is_array($availableTeachers) && !empty($availableTeachers)) {
            $data['availableTeachers'] = $availableTeachers;
            $data['subjectId'] = $subjectId;
            $data['periodId'] = $periodId;
            $data['day'] = $day;
        } 
        else {
            $data['message'] = 'No available teachers found for this slot.';
        }      
        
        $this->view('inc/principal/viewCurrentActivities/allFreeTeachers', $data);
    }

    public function sendAssignmentEmail() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get data from POST
            $teacherId = $_POST['teacherId'];
            $teacherName = $_POST['teacherName'];
            $teacherEmail = $_POST['teacherEmail'];
            $subjectId = $_POST['subjectId'];
            $periodId = $_POST['periodId'];
            $day = $_POST['day'];
            $className = $_POST['className'];
            $subjectName = $_POST['subjectName'];
            $periodName = $_POST['periodName'];
            $roomNumber = $_POST['roomNumber'];

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
            $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = SMTP_PORT;
                
                // Recipients
                $mail->setFrom(SMTP_USER, 'School Administration');
                $mail->addAddress($teacherEmail, $teacherName);
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Class Assignment Notification';
                $mail->Body = "
                    <h2>Class Assignment Notification</h2>
                    <p>Dear {$teacherName},</p>
                    <p>You have been assigned to the following class:</p>
                    <ul>
                        <li><strong>Class:</strong> {$className}</li>
                        <li><strong>Subject:</strong> {$subjectName}</li>
                        <li><strong>Period:</strong> {$periodName}</li>
                        <li><strong>Room Number:</strong> {$roomNumber}</li>
                        <li><strong>Day:</strong> {$day}</li>
                    </ul>
                    <p>Please make necessary arrangements to attend this class.</p>
                    <p>Thank you,<br>School Administration</p>
                ";
                
                $mail->send();

                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Email sent successfully! Teacher has been notified of the assignment.'
                ];
            }
            catch (Exception $e) {
                // Set error message
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Email could not be sent. Error: ' . $mail->ErrorInfo
                ];
                
                // Return error response for AJAX
                echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
                exit;
            }
        } else {
            header("Location: " . URLROOT . "/CurrentActivities/showAvailableTeachers");
            exit();
        }
    }
}

?>