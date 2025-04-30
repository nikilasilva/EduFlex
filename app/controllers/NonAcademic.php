
<!-- // all emty -->
<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;


class NonAcademic extends Controller
{
    public function __construct()
    {
        checkRole('non-academic'); // can not be log athers
    }

    // Start Teachers Attendencee Funtions

    public function TeachersAttendenceeForm()
    {
        // Load Teacher model
        $teacherModel = new TeacherModeldev3();

        // Fetch all teachers
        $teachers = $teacherModel->findAll();

        // Pass data to the view
        $this->view('inc/nonAcademic/record_teachers_attendance', [
            'teachers' => $teachers
        ]);
    }

    public function ViewTeachersAttendance()
    {
        $teacherAttendanceModel = new TeacherAttendanceModel();
        $teacherModel = new TeacherModeldev3(); // Correct model

        // Get selected date from URL, or use today's date
        $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

        // Fetch all attendance records
        $attendanceRecords = $teacherAttendanceModel->findAll();

        // Fetch all teachers
        $teachers = $teacherModel->findAll();

        // Reformat teachers array: [teacher_id => teacherObject]
        $teachersArray = [];
        foreach ($teachers as $teacher) {
            $teachersArray[$teacher->teacher_id] = $teacher;
        }

        // Prepare data to send to view
        $data = [
            'attendance' => [],
            'teachers' => $teachersArray,
            'selectedDate' => $selectedDate
        ];

        // Fix attendance records
        foreach ($attendanceRecords as $record) {
            $data['attendance'][] = (object)[
                'teacher_id' => $record->teacherRegNo,  // 'teacherRegNo' actually matches 'teacher_id'
                'attendance_date' => $record->date,
                'status' => $record->status
            ];
        }

        // Load the view
        $this->view('inc/nonAcademic/view_teachers_attendance', $data);
    }



    public function UpdateTeachersAttendanceForm()
{
    $teacherAttendanceModel = new TeacherAttendanceModel();
    $teacherModel = new TeacherModeldev3();

    // Get selected date from URL or today's date
    $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // Fetch all teachers
    $teachers = $teacherModel->findAll();

    // Fetch attendance records for selected date
    $attendanceRecords = $teacherAttendanceModel->getAttendanceByDate($selectedDate);

    // Check if the data returned is valid
    $attendanceArray = [];
    if ($attendanceRecords && is_array($attendanceRecords)) {
        // Reformat attendance records: [teacher_id => status]
        foreach ($attendanceRecords as $record) {
            $attendanceArray[$record->teacherRegNo] = $record->status;
        }
    }

    $data = [
        'teachers' => $teachers,
        'attendance' => $attendanceArray,
        'date' => $selectedDate
    ];

    $this->view('inc/nonAcademic/update_teachers_attendance', $data);
}



public function SubmitUpdatedTeachersAttendance()
{
    // Assuming the staff ID is stored in the session (modify according to your actual session handling)
    $staffId = $_SESSION['user']['regNo'];  // Adjust based on how you store staff information

    // Instantiate the required models
    $teacherAttendanceModel = new TeacherAttendanceModel();
    $teacherModel = new TeacherModeldev3();

    // Get the submitted form data
    $teacherIds = $_POST['teacher_ids']; // Array of teacher IDs
    $attendanceStatuses = $_POST['attendance']; // Array of attendance statuses
    $date = $_POST['date']; // The selected date from the form

    // Loop through each teacher and update their attendance
    // Loop through each teacher and update their attendance
foreach ($teacherIds as $teacherId) {
    if (isset($attendanceStatuses[$teacherId])) {
        // Prepare the data for updating
        $data = [
            'teacherRegNo' => $teacherId,
            'date' => $date,  // Use the 'date' field here, not 'attendance_date'
            'status' => $attendanceStatuses[$teacherId],
            'recordedBy' => $staffId // Include the staffId here for the foreign key constraint
        ];

        // Check if the attendance for this teacher on this date already exists
        $existingAttendance = $teacherAttendanceModel->where([
            'teacherRegNo' => $teacherId,
            'date' => $date  // Correct field used for checking
        ]);

        if ($existingAttendance) {
            // Update existing attendance record
            $teacherAttendanceModel->update($teacherId, $data);
        } else {
            // Insert new attendance record if not exists
            $teacherAttendanceModel->insert($data);
        }
    }
}


    // Redirect to a page with a success message or a confirmation view
    header('Location: ' . URLROOT . '/nonAcademic/UpdateTeachersAttendanceForm?date=' . urlencode($date));
    exit();
}







    public function SubmitTeachersAttendanceForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $teacherAttendanceModel = new TeacherAttendanceModel();

            $teacher_ids = $_POST['teacher_ids'];
            $attendance_status = $_POST['attendance'];

            $currentDate = date('Y-m-d');
            $recordedBy = $_SESSION['user']['regNo']; // or something like that

            // $recordedBy = $_SESSION['USER']->user_id ?? 'system'; // or whatever your session user_id is
            $recordedAt = date('Y-m-d H:i:s');

            foreach ($teacher_ids as $teacher_id) {
                if (isset($attendance_status[$teacher_id])) {
                    $data = [
                        'teacherRegNo' => $teacher_id,
                        'date' => $currentDate,
                        'status' => $attendance_status[$teacher_id],
                        'recordedBy' => $recordedBy,
                        'recordedAt' => $recordedAt
                    ];
                    // echo '<pre>'; print_r($data); echo '</pre>'; exit;

                    $teacherAttendanceModel->insert($data);
                }
            }

            // After inserting, redirect back to the ViewTeachersAttendance page
            header('Location: ' . URLROOT . '/NonAcademic/ViewTeachersAttendance');
        } else {
            // If not a POST request, just redirect back
            header('Location: ' . URLROOT . '/NonAcademic/ViewTeachersAttendance');
        }
    }

    //====================+++++++++++++++++++++======================++++++++++++++++++====================
    // END All Teachers Attendencee Funtions

    //start verify service charges

    //
    // start service charges

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

    public function submitted_verify_service_charges()  // view all submitted service charges
    {
        $serviceChargesModel = new payment_chargesModel_verryfy(); // Assuming you have this model to load students
        $serviceCharge = $serviceChargesModel->findAll();
        $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => $serviceCharge]);
    }

    public function SubmitServiceCharges()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $attendance = $_POST['attendance']; // attendance contains student_id => status pairs

            $serviceChargesModel = new payment_chargesModel_verryfy();

            foreach ($attendance as $studentId => $status) {
                // Update the status for each student
                $serviceChargesModel->updateStatusByStudentId($studentId, $status);
            }

            // Redirect back with a success message (optional)
            $_SESSION['success_message'] = "Service charges updated successfully.";
            header('Location: ' . URLROOT . '/NonAcademic/submitted_verify_service_charges');
            exit;
        }
    }

    // Inside app/controllers/NonAcademic.php

    public function viewVerifyServiceCharges()
    {
        // Load the model
        $serviceChargesModel = new payment_chargesModel_verryfy();

        // Fetch service charges data (you can adjust query conditions if needed)
        $serviceCharges = $serviceChargesModel->findAll();

        // Send the data to the view
        $this->view('inc/nonAcademic/view_verify_service_charges', [
            'serviceCharges' => $serviceCharges
        ]);
    }

    public function searchVerifiedServiceChargesByStudentId()  // Search service charges by student ID
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentId = $_POST['student_id'];

            if (!empty($studentId)) {
                $serviceChargesModel = new payment_chargesModel_verryfy();
                $result = $serviceChargesModel->where(['student_id' => $studentId]);

                if ($result) {
                    $this->view('inc/nonAcademic/view_verify_service_charges', ['serviceCharges' => $result]);
                } else {
                    $_SESSION['error_message'] = "No service charges found for Student ID: " . htmlspecialchars($studentId);
                    $this->view('inc/nonAcademic/view_verify_service_charges', ['serviceCharges' => []]);
                }
            } else {
                $_SESSION['error_message'] = "Student ID cannot be empty.";
                $this->view('inc/nonAcademic/view_verify_service_charges', ['serviceCharges' => []]);
            }
        } else {
            $this->view('inc/nonAcademic/view_verify_service_charges', ['serviceCharges' => []]);
        }
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


    public function requestedCertificate()
    {
        $this->view('inc/nonAcademic/requestedCertificate');
    }
    public function allocatedTime()
    {
        $this->view('inc/nonAcademic/allocatedTime');
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