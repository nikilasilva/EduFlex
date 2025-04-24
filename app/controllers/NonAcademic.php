<!-- // all emty -->
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class NonAcademic extends Controller
{
    public function __construct() {}

    // // View all NonAcademics.
    // public function nonAcademics() {
    //     $this->view('all_teachers');
    // }
    // // View all NonAcademics.
    // public function nonAcademics() {
    //     $this->view('all_teachers');
    // }



    // public function Issuance_books()
    // {


    //     $this->view('/inc/nonAcademic/Issuance_of_books');
    // }


    // public function Issuance_books_searched()
    // {

    //     // if (isset($_POST['search_student_id'])) {
    //     //     $search = $conn->real_escape_string($_GET['search_student_id']);
    //     //     $searchmodel=new issuance_of_booksModel;
    //     //     $result=$searchmodel->search("student_id",search_student_id)

    //     // }

    //     $this->view('/inc/nonAcademic/Issuance_of_books');
    // }

    // public function submitActivities()
    // {


    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $activityData = [
    //             'student_id' => $_POST['student_id'],
    //             'book_id' => $_POST['book_id'],
    //             'full_name' => $_POST['full_name'],
    //             'book_name' => $_POST['book_name'],
    //             'issue_date' => $_POST['issue_date'],

    //         ];

    //         $activity = new issuance_of_booksModel();
    //         $activity->insert($activityData);
    //         // Here, save the activity data to the database.
    //         // Example: $this->activityModel->addActivity($activityData);

    //         // Display a success message or redirect to a success page
    //         echo "Activity recorded successfully: " . htmlspecialchars($activityData['full_name']);
    //     } else {
    //         // If not a POST request, reload the daily activities page
    //         $this->view('Issuance_books');
    //     }
    // }


    // public function viewActivities()
    // {
    //     $activityModel = new issuance_of_booksModel();
    //     $activities = $activityModel->findAll();

    //     $this->view('inc/nonAcademic/See_library_activity', ['activities' => $activities]);
    // }





    // public function editActivity($id)
    // {
    //     $activityModel = new issuance_of_booksModel();

    //     // If the request is POST, update the activity
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $data = [
    //             'book_id' => $_POST['book_id'],
    //             'full_name' => $_POST['full_name'],
    //             'book_name' => $_POST['book_name'],
    //             'issue_date' => $_POST['issue_date']
    //         ];

    //         $activityModel->update($id, $data, 'student_id');

    //         // Redirect to the view activities page
    //         header("Location: " . URLROOT . "/NonAcademic/viewActivities");
    //         exit();
    //     } else {
    //         // Get the activity details
    //         $activity = $activityModel->first(['student_id' => $id]);

    //         if ($activity) {
    //             $this->view('inc/NonAcademic/edit_Issuance_of_books', ['activity' => $activity]);
    //         } else {
    //             die('Activity not found.');
    //         }
    //     }
    // }

    // public function deleteActivity($id)
    // {
    //     $activityModel = new issuance_of_booksModel();

    //     // Delete the activity
    //     $activityModel->delete($id, 'student_id');

    //     // Redirect to the view activities page
    //     header("Location: " . URLROOT . "/NonAcademic/viewActivities");
    //     exit();
    // }

    // Start Teachers Attendencee Funtions

    public function TeachersAttendenceeForm()
    {
        $teacherModel = new TeacherModeldev3(); // Make sure this model exists
        $teachers = $teacherModel->findAll();

        $this->view('inc/nonAcademic/record_teachers_attendance', ['teachers' => $teachers]);
    }



    public function SubmitTeachersAttendanceForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $attendanceModel = new TeacherAttendanceModel();

            $teacherIds = $_POST['teacher_ids'];
            $attendance = $_POST['attendance'];
            $currentDate = date('Y-m-d');

            $errors = [];

            foreach ($teacherIds as $teacherId) {
                if (isset($attendance[$teacherId])) {
                    //  Check if attendance for this teacher on this date already exists
                    $existing = $attendanceModel->where([
                        'teacher_id' => $teacherId,
                        'attendance_date' => $currentDate
                    ]);

                    if ($existing) {
                        $errors[] = "Attendance already marked for Teacher ID $teacherId.";
                        continue;
                    }

                    //  Otherwise, insert attendance
                    $status = $attendance[$teacherId];

                    $attendanceModel->insert([
                        'teacher_id' => $teacherId,
                        'status' => $status,
                        'attendance_date' => $currentDate
                    ]);
                }
            }


            //  Pass error messages to the view (to show in a popup)
            if (!empty($errors)) {
                $_SESSION['attendance_errors'] = $errors;
            } else {
                $_SESSION['success_message'] = "Attendance submitted successfully!";
            }
        }
    }


    public function ViewTeachersAttendance()
    {
        $attendanceModel = new TeacherAttendanceModel();
        $records = $attendanceModel->findAll();
        $teacherModel = new TeacherModeldev3();

        $teachersList = $teacherModel->findAll();

        // Re-index teachers by teacher_id
        $teachers = [];
        foreach ($teachersList as $teacher) {
            $teachers[$teacher->teacher_id] = $teacher;
        }

        $this->view('inc/nonAcademic/view_teachers_attendance', [
            'attendance' => $records,
            'teachers' => $teachers
        ]);
    }

    // END All Teachers Attendencee Funtions

    //start verify service charges


    //-------------
    public function searchServiceChargesByStudentId()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentId = $_POST['student_id'];

            if (!empty($studentId)) {
                $serviceChargesModel = new payment_chargesModel_verryfy();
                $result = $serviceChargesModel->where(['student_id' => $studentId]);

                if ($result) {
                    $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => $result]);
                } else {
                    $_SESSION['error_message'] = "No service charges found for Student ID: " . htmlspecialchars($studentId);
                    $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => []]);
                }
            } else {
                $_SESSION['error_message'] = "Student ID cannot be empty.";
                $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => []]);
            }
        } else {
            $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => []]);
        }
    }

    public function verify_service_charges()
    {
        $serviceChargesModel = new payment_chargesModel_verryfy(); // Assuming you have this model to load students
        $serviceCharge = $serviceChargesModel->findAll();



        $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => $serviceCharge]);
    }
    //
    public function downloadFile($fileName)
    {
        $filePath = APPROOT . '/../uploads/' . $fileName;

        if (file_exists($filePath)) {
            // Disable output buffering
            if (ob_get_level()) {
                ob_end_clean();
            }

            // Get the MIME type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $filePath);
            finfo_close($finfo);

            header('Content-Description: File Transfer');
            header('Content-Type: ' . $mime);
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));

            readfile($filePath);
            exit;
        } else {
            die('File not found.');
        }
    }



    public function RequestLeavingCertificatesView()
    {
        $LeavingCertificateMode = new LeavingCertificateModeldev3(); // Make sure this model exists
        $LeavingCertificates = $LeavingCertificateMode->findAll();

        $this->view('inc/nonAcademic/Leaving_Certificates', ['LeavingCertificates' => $LeavingCertificates]);
    }



    public function markCertificateComplete($id)
{
    $model = new LeavingCertificateModeldev3();
    $certificate = $model->first(['certificate_id' => $id]);

    if ($certificate) {
        // Allocate time
        $this->autoAllocateLeavingCertificateTime($certificate->certificate_id, $certificate->student_id);

        // Get allocated time from the DB
        $allocModel = new leaving_allocated_timeModel();
        $allocated = $allocModel->first([
            'student_id' => $certificate->student_id,
            'certificate_id' => $certificate->certificate_id
        ]);

        if ($allocated) {
            $timeSlot = $allocated->time_slot;
            $day = $allocated->day;

            // Get the email of the student via JOIN
            $emailData = $allocModel->getUserEmailByStudentId($certificate->student_id);
            $recipientEmail = $emailData ? $emailData->email : null;

            if ($recipientEmail) {
                // Send email with allocated time
                $mail = new mail();
                $mail->sendEailLeavingCertificates($timeSlot, $day, $recipientEmail);
            }
        }

        // Update status from 0 to 1
        $model->update($id, ['status' => 1], 'certificate_id');
    }

    header("Location: " . URLROOT . "/NonAcademic/RequestLeavingCertificatesView");
    exit();
}



    


    public function autoAllocateLeavingCertificateTime($allocatedId, $studentId)
    {
        $timeSlots = ['8:00 AM - 9:00 AM', '9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM'];
        $days = ['Monday', 'Friday'];
        // Function to allocate a time slot and day
        $allocationModel = new leaving_allocated_timeModel();

        // Check the current allocation count for each time slot on each day
        $allocatedSlots = $allocationModel->findAll();
        $slotCounts = [];

        foreach ($allocatedSlots as $allocation) {
            $key = $allocation->day . '|' . $allocation->time_slot;
            if (!isset($slotCounts[$key])) {
            $slotCounts[$key] = 0;
            }
            $slotCounts[$key]++;
        }

        // Find the next available time slot and day
        $timeSlot = null;
        $day = null;

        foreach ($days as $currentDay) {
            foreach ($timeSlots as $currentSlot) {
            $key = $currentDay . '|' . $currentSlot;
            if (!isset($slotCounts[$key]) || $slotCounts[$key] < 2) {
                $timeSlot = $currentSlot;
                $day = $currentDay;
                break 2; // Exit both loops once a slot is found
            }
            }
        }

        // If no slot is available, assign the next nearest day
        if (!$timeSlot || !$day) {
            $day = $days[0]; // Default to the first day
            $timeSlot = $timeSlots[0]; // Default to the first time slot
        }
        // a to Z select a time slot and day


        // Save the allocation in the database
        $allocationModel = new leaving_allocated_timeModel();
        $allocationModel->insert([
            'student_id' => $studentId,
            'certificate_id' => $allocatedId, // This is actually the certificate ID
            'time_slot' => $timeSlot,
            'day' => $day
        ]);
        

        // Output the allocated time and day
        // echo "Time slot and day allocated successfully: $timeSlot on $day";
    }



   



    // public function RequestCharacterCertificateView()
    // {
    //     $characterCertificateModel = new CharacterCertificateModel(); // Make sure this model exists
    //     $characterCertificates = $characterCertificateModel->findAll();

    //     $this->view('inc/nonAcademic/Character_Certificate', ['characterCertificates' => $characterCertificates]);
    // }    





    private function sendCharacterCertificateEmail($recipientEmail)
    {
        require '../vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gamlathcharitha@gmail.com'; // Replace with actual sender email
            $mail->Password = ''; // Replace with actual app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('gamlathcharitha@gmail.com', 'School Non-Academic Staff');
            $mail->addAddress($recipientEmail);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Reddy – Your Character Certificate';
            $mail->Body    = "
                <p>Dear Student,</p>
                <p>Your living certificate is complete. You can come between <strong>8:00 AM and 12:00 PM</strong> to collect it.</p>
                <p>Best regards,<br>Non-Academic Staff<br>[School Name]</p>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
?>