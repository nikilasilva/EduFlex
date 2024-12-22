<?php
    class Teacher extends Controller {
        public function __construct() {
        }

        // View all teachers.
        public function teachers() {
            $this->view('all_teachers');
        }

        public function events() {
            // Example events array (replace with your actual data)
            $data = [
                'events' => [
                    '2024-01-19' => 'Event 1',
                    '2024-01-20' => 'Event 2',
                ],
                'upcomingEvents' => [
                    ['date' => '2024-01-19', 'description' => 'Event 1 Description'],
                    ['date' => '2024-01-20', 'description' => 'Event 2 Description'],
                ],
                'reminders' => [
                    ['date' => '2024-01-18', 'description' => 'Reminder 1'],
                    ['date' => '2024-01-19', 'description' => 'Reminder 2'],
                ]
            ];
    
            // Load the view and pass data
            $this->view('scheduled_events', $data);
        }
        
        public function timeTable() {
            // Sample timetable data (you can retrieve this from a database in real use cases)
            $data = [
                'timeTable' => [
                    ['time' => '08:30 - 09:30', 'monday' => 'Period 1', 'tuesday' => 'Period 1', 'wednesday' => 'Period 1', 'thursday' => 'Period 1', 'friday' => 'Period 1'],
                    ['time' => '09:30 - 10:30', 'monday' => 'Period 2', 'tuesday' => 'Period 2', 'wednesday' => 'Period 2', 'thursday' => 'Period 2', 'friday' => 'Period 2'],
                    ['time' => '10:30 - 11:00', 'monday' => 'Lunch 1', 'tuesday' => 'Lunch 1', 'wednesday' => 'Lunch 1', 'thursday' => 'Lunch 1', 'friday' => 'Lunch 1'],
                    ['time' => '11:00 - 12:00', 'monday' => 'Period 3', 'tuesday' => 'Period 3', 'wednesday' => 'Period 3', 'thursday' => 'Period 3', 'friday' => 'Period 3'],
                    ['time' => '12:00 - 1:00', 'monday' => 'Period 4', 'tuesday' => 'Period 4', 'wednesday' => 'Period 4', 'thursday' => 'Period 4', 'friday' => 'Period 4'],
                    ['time' => '1:00 - 1:30', 'monday' => 'Lunch 2', 'tuesday' => 'Lunch 2', 'wednesday' => 'CONNECT', 'thursday' => 'Lunch 2', 'friday' => 'Lunch 2'],
                    ['time' => '1:30 - 2:30', 'monday' => 'Period 5', 'tuesday' => 'Period 5', 'wednesday' => 'CONNECT', 'thursday' => 'Period 5', 'friday' => 'Period 5']
                ]
            ];

            // Load the view and pass the timetable data
            $this->view('time_table', $data);
        }

        public function attendance() {
            $data = [
                'students' => [
                    ['id' => 'S001', 'name' => 'John Doe'],
                    ['id' => 'S002', 'name' => 'Jane Smith'],
                    ['id' => 'S003', 'name' => 'Michael Johnson'],
                    ['id' => 'S004', 'name' => 'Emily Davis'],
                ]
            ];
            $this->view('inc/teacher/attendance', $data);
        }
    
        public function submitAttendance() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $class = $_POST['class'] ?? null;
                $attendance = $_POST['attendance'] ?? [];
                $date = date('Y-m-d');
    
                if (empty($class) || empty($attendance)) {
                    die("Class or attendance data missing");
                }
    
                $attendanceModel = new Student_attendanceModel();
                foreach ($attendance as $studentId => $status) {
                    $studentData = [
                        'date' => $date,
                        'student_id' => $studentId,
                        'name' => $_POST['student_name'][$studentId],
                        'class' => $class,
                        'status' => $status,
                    ];
                    $attendanceModel->insert($studentData);
                }
    
                header("Location: " . URLROOT . "/teacher/viewAttendance?date=$date");
                exit();
            } else {
                header("Location: " . URLROOT . "/teacher/attendance");
                exit();
            }
        }
    
        public function viewAttendance() {
            $date = $_GET['date'] ?? null;
        
            if ($date) {
                $attendanceModel = new Student_attendanceModel();
                $attendanceRecords = $attendanceModel->where(['date' => $date]);
        
                // Convert objects to arrays for array-style access
                $attendanceRecords = json_decode(json_encode($attendanceRecords), true);
        
                $this->view('inc/teacher/view_attendance', ['attendanceRecords' => $attendanceRecords, 'date' => $date]);
            } else {
                die("Date not provided");
            }
        }
        
        
    // Display the daily activities form
    public function dailyActivities() {
        
        $this->view('inc/teacher/daily_activities');
    }

    // Handle the submission of daily activities
    public function submitActivities() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityData = [
                'date' => $_POST['date'],
                'period' => $_POST['period'],
                'subject' => $_POST['subject'],
                'class' => $_POST['class'],
                'description' => $_POST['description'],
                'additional_note' => $_POST['additional_note']

            ];

            $activity = new Current_activityModel();
            $activity->insert($activityData);
            // Here, save the activity data to the database.
            // Example: $this->activityModel->addActivity($activityData);

            // Display a success message or redirect to a success page
            echo "Activity recorded successfully: " . htmlspecialchars($activityData['description']);
        } else {
            // If not a POST request, reload the daily activities page
            $this->view('daily_activities');
        }
    }

    public function viewActivities() {
    $activityModel = new Current_activityModel();
    $activities = $activityModel->findAll();

    $this->view('inc/teacher/view_activities', ['activities' => $activities]);
}


public function editActivity($id) {
    $activityModel = new Current_activityModel();

    // If the request is POST, update the activity
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
                'date' => $_POST['date'],
                'period' => $_POST['period'],
                'subject' => $_POST['subject'],
                'class' => $_POST['class'],
                'description' => $_POST['description'],
                'additional_note' => $_POST['additional_note']
        ];

        $activityModel->update($id, $data, 'activity_id');

        // Redirect to the view activities page
        header("Location: " . URLROOT . "/teacher/viewActivities");
        exit();
    } else {
        // Get the activity details
        $activity = $activityModel->first(['activity_id' => $id]);

        if ($activity) {
            $this->view('inc/teacher/edit_activity', ['activity' => $activity]);
        } else {
            die('Activity not found.');
        }
    }
}

public function deleteActivity($id) {
    $activityModel = new Current_activityModel();

    // Delete the activity
    $activityModel->delete($id, 'activity_id');

    // Redirect to the view activities page
    header("Location: " . URLROOT . "/teacher/viewActivities");
    exit();
}

public function index() {
    // Example: redirect to a default page or load a view
    redirect('Teacher/enterMarks');
}

// public function enterMarks($classId = null) {
//     // Example method to handle Enter Marks
//     $this->view('teacher/enterMarks', ['classId' => $classId]);
// }
// public function __construct() {
//     $this->reportModel = $this->model('Report'); // Load the Report model
// }

//     public function generateReports($classId) {
//         // Get classroom details
//         $classDetails = $this->reportModel->getClassDetails($classId);

//         // Get students and their marks
//         $studentReports = $this->reportModel->getStudentReports($classId);

//         // Pass data to the view
//         $data = [
//             'classDetails' => $classDetails,
//             'studentReports' => $studentReports
//         ];

//         $this->view('inc/teacher/reports', $data);
//     }

//     public function saveStudentMarks() {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             // Sanitize POST data
//             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//             $data = [
//                 'student_id' => $_POST['student_id'],
//                 'subject_id' => $_POST['subject_id'],
//                 'marks' => $_POST['marks'],
//             ];

//             // Save marks
//             if ($this->reportModel->saveMarks($data)) {
//                 flash('report_message', 'Marks saved successfully');
//                 redirect('teacher/generateReports/' . $_POST['class_id']);
//             } else {
//                 die('Something went wrong');
//             }
//         }

// public function viewReports($classId) {
//     $classDetails = $this->reportModel->getClassDetails($classId);
//     $studentReports = $this->reportModel->getStudentReports($classId);

//     $data = [
//         'classDetails' => $classDetails,
//         'studentReports' => $studentReports,
//     ];

//     $this->view('teacher/Report', $data);
// }

// public function enterMarks($classId) {
//     $classDetails = $this->reportModel->getClassDetails($classId);
//     $students = $this->reportModel->getStudentsByClass($classId);
//     $subjects = $this->reportModel->getSubjects();

//     $data = [
//         'classDetails' => $classDetails,
//         'students' => $students,
//         'subjects' => $subjects,
//     ];

//     $this->view('teacher/enterMarks', $data);
// }

// public function saveStudentMarks() {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         $classId = $_POST['class_id'];
//         foreach ($_POST['marks'] as $studentId => $marks) {
//             $subjectId = $_POST['subject_id'][$studentId];
//             $this->reportModel->saveMarks([
//                 'student_id' => $studentId,
//                 'subject_id' => $subjectId,
//                 'marks' => $marks,
//             ]);
//         }
//         flash('report_message', 'Marks saved successfully');
//         redirect('teacher/viewReports/' . $classId);
//     }
// }

    }
?>