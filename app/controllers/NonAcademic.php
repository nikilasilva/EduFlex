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

    public function ViewTeachersAttendance()
    {
        $attendanceModel = new TeacherAttendanceModel();
        $records = $attendanceModel->findAll();
        $teacherModel = new TeacherModeldev3();
        $teachersList = $teacherModel->findAll();

        $teachers = [];
        foreach ($teachersList as $teacher) {
            $teachers[$teacher->teacher_id] = $teacher;
        }

        $this->view('inc/nonAcademic/view_teachers_attendance', [
            'attendance' => $records,
            'teachers' => $teachers
        ]);
    }

    public function UpdateTeachersAttendanceForm()
    {
        $date = $_GET['date'] ?? date('Y-m-d');
        $teacherModel = new TeacherModeldev3();
        $attendanceModel = new TeacherAttendanceModel();

        $teachers = $teacherModel->findAll();
        $attendance = [];

        foreach ($teachers as $teacher) {
            $records = $attendanceModel->where([
                'teacher_id' => $teacher->teacher_id,
                'attendance_date' => $date
            ]);

            // Get the first record if exists
            $status = !empty($records) ? $records[0]->status : null;
            $attendance[$teacher->teacher_id] = $status;
        }

        $this->view('inc/nonAcademic/update_teachers_attendance', [
            'teachers' => $teachers,
            'attendance' => $attendance,
            'date' => $date
        ]);
    }


    public function SubmitUpdatedTeachersAttendance()
{
    $teacherIds = $_POST['teacher_ids'];
    $statuses = $_POST['attendance'];
    $date = $_POST['date'];

    $attendanceModel = new TeacherAttendanceModel();

    foreach ($teacherIds as $teacherId) {
        $data = [
            'teacher_id' => $teacherId,
            'attendance_date' => $date,
            'status' => $statuses[$teacherId]
        ];

        // Check if the attendance record exists by teacher_id and attendance_date
        $existingRecords = $attendanceModel->where([
            'teacher_id' => $teacherId,
            'attendance_date' => $date
        ]);

        if (!empty($existingRecords)) {
            // If the record exists, update it
            $attendanceModel->update($existingRecords[0]->teacher_id, $data);
        } else {
            // If the record does not exist, insert it
            $attendanceModel->insert($data);
        }
    }

    // Redirect after submission
    header('Location: ' . URLROOT . '/NonAcademic/ViewTeachersAttendance?date=' . $date);
    exit(); // Ensure that the script stops executing after the redirect
}






    // public function SubmitTeachersAttendanceForm() // Submit the teachers attendance form
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $attendanceModel = new TeacherAttendanceModel();

    //         $teacherIds = $_POST['teacher_ids'];
    //         $attendance = $_POST['attendance'];
    //         $currentDate = date('Y-m-d');

    //         $errors = [];

    //         foreach ($teacherIds as $teacherId) {
    //             if (isset($attendance[$teacherId])) {
    //                 //  Check if attendance for this teacher on this date already exists
    //                 $existing = $attendanceModel->where([
    //                     'teacher_id' => $teacherId,
    //                     'attendance_date' => $currentDate
    //                 ]);

    //                 if ($existing) {
    //                     $errors[] = "Attendance already marked for Teacher ID $teacherId.";
    //                     continue;
    //                 }

    //                 //  Otherwise, insert attendance
    //                 $status = $attendance[$teacherId];

    //                 $attendanceModel->insert([
    //                     'teacher_id' => $teacherId,
    //                     'status' => $status,
    //                     'attendance_date' => $currentDate
    //                 ]);
    //             }
    //         }


    //         //  Pass error messages to the view (to show in a popup)
    //         if (!empty($errors)) {
    //             $_SESSION['attendance_errors'] = $errors;
    //         } else {
    //             $_SESSION['success_message'] = "Attendance submitted successfully!";
    //         }

    //         $this->view('inc/nonAcademic/ViewTeachersAttendance');


    //     }
    // }

    // public function updateAllTeachersAttendance() // Update all teachers attendance records
    // {
    //     $attendanceModel = new TeacherAttendanceModel();
    //     $records = $attendanceModel->findAll();
    //     $teacherModel = new TeacherModeldev3();

    //     $teachersList = $teacherModel->findAll();

    //     // Re-index teachers by teacher_id
    //     $teachers = [];
    //     foreach ($teachersList as $teacher) {
    //         $teachers[$teacher->teacher_id] = $teacher;
    //     }

    //     $this->view('inc/nonAcademic/update_teachers_attendance', [
    //         'attendance' => $records,
    //         'teachers' => $teachers
    //     ]);
    // }




    // public function ViewTeachersAttendance()  // View all teachers attendance records
    // {
    //     $attendanceModel = new TeacherAttendanceModel();
    //     $records = $attendanceModel->findAll();
    //     $teacherModel = new TeacherModeldev3();

    //     $teachersList = $teacherModel->findAll();

    //     // Re-index teachers by teacher_id
    //     $teachers = [];
    //     foreach ($teachersList as $teacher) {
    //         $teachers[$teacher->teacher_id] = $teacher;
    //     }

    //     $this->view('inc/nonAcademic/view_teachers_attendance', [
    //         'attendance' => $records,
    //         'teachers' => $teachers
    //     ]);
    // }
    //====================+++++++++++++++++++++======================++++++++++++++++++====================
    // END All Teachers Attendencee Funtions

    //start verify service charges

    public function requestedCertificate()
    {
        $this->view('inc/nonAcademic/requestedCertificate');
    }
    public function allocatedTime()
    {
        $this->view('inc/nonAcademic/allocatedTime');
    }

    //-------------
    public function searchServiceChargesByStudentId()  // Search service charges by student ID
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

    public function verify_service_charges()  // view all service charges
    {
        $serviceChargesModel = new payment_chargesModel_verryfy(); // Assuming you have this model to load students
        $serviceCharge = $serviceChargesModel->findAll();
        $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => $serviceCharge]);
    }


    public function downloadFile($fileName)  // Download file function
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


    public function RequestLeavingCertificatesView() // View all requested leaving certificates
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
        $maxPerSlot = 1;
        $allocationModel = new leaving_allocated_timeModel();

        // Load all current allocations
        $allocatedSlots = $allocationModel->findAll();
        $slotCounts = [];

        foreach ($allocatedSlots as $allocation) {
            $date = $allocation->day; // already in YYYY-MM-DD
            $key = $date . '|' . $allocation->time_slot;

            if (!isset($slotCounts[$key])) {
                $slotCounts[$key] = 0;
            }
            $slotCounts[$key]++;
        }

        // Try to allocate on the next available Monday or Friday
        $daysChecked = 0;
        $dateToCheck = new DateTime();
        $maxDaysAhead = 60; // Safety limit

        $found = false;
        while ($daysChecked < $maxDaysAhead && !$found) {
            $weekday = $dateToCheck->format('l');

            if ($weekday === 'Monday' || $weekday === 'Friday') {
                $dateStr = $dateToCheck->format('Y-m-d');

                foreach ($timeSlots as $slot) {
                    $key = $dateStr . '|' . $slot;
                    if (!isset($slotCounts[$key]) || $slotCounts[$key] < $maxPerSlot) {
                        // Found available slot
                        $allocationModel->insert([
                            'student_id' => $studentId,
                            'certificate_id' => $allocatedId,
                            'time_slot' => $slot,
                            'day' => $dateStr
                        ]);
                        $found = true;
                        break;
                    }
                }
            }

            $dateToCheck->modify('+1 day');
            $daysChecked++;
        }

        if (!$found) {
            // Fallback - assign to next Monday
            $nextMonday = new DateTime('next Monday');
            $allocationModel->insert([
                'student_id' => $studentId,
                'certificate_id' => $allocatedId,
                'time_slot' => $timeSlots[0],
                'day' => $nextMonday->format('Y-m-d')
            ]);
        }
    }


    public function allocatedleavingCertificatesView()
    {
        $allocatedLeavingCertificateModel = new leaving_allocated_timeModel(); // Make sure this model exists
        $allocatedLeavingCertificates = $allocatedLeavingCertificateModel->findAll();

        $this->view('inc/nonAcademic/AllocatedLeavingCertificates', ['allocatedLeavingCertificates' => $allocatedLeavingCertificates]);
    }

    public function RequestedCharacterCertificateView()
    {
        $characterCertificateModel = new CharacterCertificateModeldev3(); // Make sure this model exists
        $characterCertificates = $characterCertificateModel->findAll();

        $this->view('inc/nonAcademic/Character_Certificates', ['characterCertificates' => $characterCertificates]);
    }


    public function markCharacterCertificateComplete($id)
    {
        $model = new CharacterCertificateModeldev3();
        $certificate = $model->first(['certificate_id' => $id]);

        if ($certificate) {
            // Allocate time
            $this->autoAllocateCharacterCertificateTime($certificate->certificate_id, $certificate->student_id);

            // Get allocated time from the DB
            $allocModel = new character_allocated_timeModel();
            $allocated = $allocModel->first([
                'student_id' => $certificate->student_id,
                'certificate_id' => $certificate->certificate_id
            ]);

            if ($allocated) {
                $timeSlot = $allocated->time_slot;
                $day = $allocated->day;

                // Get the email of the student via JOIN
                $emailData = $allocModel->getUserEmailByStudentIdForCharacter($certificate->student_id);
                $recipientEmail = $emailData ? $emailData->email : null;

                if ($recipientEmail) {
                    // Send email with allocated time
                    $mail = new Email_sendCharacterCertificates();
                    $mail->sendEailCharacterCertificates($timeSlot, $day, $recipientEmail);
                }
            }

            // Update status from 0 to 1
            $model->update($id, ['status' => 1], 'certificate_id');
        }

        header("Location: " . URLROOT . "/NonAcademic/RequestedCharacterCertificateView");
        exit();
    }


    public function autoAllocateCharacterCertificateTime($allocatedId, $studentId)
    {
        $timeSlots = ['8:00 AM - 9:00 AM', '9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM'];
        $maxPerSlot = 1;
        $allocationModel = new character_allocated_timeModel();

        // Load all current allocations
        $allocatedSlots = $allocationModel->findAll();
        $slotCounts = [];

        foreach ($allocatedSlots as $allocation) {
            $date = $allocation->day; // already in YYYY-MM-DD
            $key = $date . '|' . $allocation->time_slot;

            if (!isset($slotCounts[$key])) {
                $slotCounts[$key] = 0;
            }
            $slotCounts[$key]++;
        }

        // Try to allocate on the next available Monday or Friday
        $daysChecked = 0;
        $dateToCheck = new DateTime();
        $maxDaysAhead = 60; // Safety limit

        $found = false;
        while ($daysChecked < $maxDaysAhead && !$found) {
            $weekday = $dateToCheck->format('l');

            if ($weekday === 'Monday' || $weekday === 'Friday') {
                $dateStr = $dateToCheck->format('Y-m-d');

                foreach ($timeSlots as $slot) {
                    $key = $dateStr . '|' . $slot;
                    if (!isset($slotCounts[$key]) || $slotCounts[$key] < $maxPerSlot) {
                        // Found available slot
                        $allocationModel->insert([
                            'student_id' => $studentId,
                            'certificate_id' => $allocatedId,
                            'time_slot' => $slot,
                            'day' => $dateStr
                        ]);
                        $found = true;
                        break;
                    }
                }
            }

            $dateToCheck->modify('+1 day');
            $daysChecked++;
        }

        if (!$found) {
            // Fallback - assign to next Monday
            $nextMonday = new DateTime('next Monday');
            $allocationModel->insert([
                'student_id' => $studentId,
                'certificate_id' => $allocatedId,
                'time_slot' => $timeSlots[0],
                'day' => $nextMonday->format('Y-m-d')
            ]);
        }
    }


    public function allocatedCharacterCertificatesView()
    {
        $allocatedCharacterCertificateModel = new character_allocated_timeModel(); // Make sure this model exists
        $allocatedCharacterCertificates = $allocatedCharacterCertificateModel->findAll();

        $this->view('inc/nonAcademic/AllocatedCharacterCertificates', ['allocatedCharacterCertificates' => $allocatedCharacterCertificates]);
    }


    function getWeekdayFromDate($date)
    {
        // Convert date string to weekday name
        return date("l", strtotime($date));
    }

    function getDateFromWeekday($weekday)
    {
        // Convert the weekday string to a date based on the upcoming weekday
        $timestamp = strtotime("next " . $weekday);

        // If today is the same weekday, strtotime("next Monday") returns next week's Monday
        // So, check if today is the same as $weekday and return today's date instead
        if (date('l') === ucfirst(strtolower($weekday))) {
            $timestamp = strtotime("today");
        }

        return date("Y-m-d", $timestamp);
    }

    private function getNextDateFromWeekday($weekday)
    {
        $today = new DateTime();
        $todayWeekday = $today->format('l');

        if (strtolower($weekday) === strtolower($todayWeekday)) {
            return $today->format('Y-m-d');
        }

        $target = new DateTime("next $weekday");
        return $target->format('Y-m-d');
    }
}

?>