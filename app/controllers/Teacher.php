<?php
require_once '../app/helpers/url_helper.php';
require_once '../app/helpers/session_helper.php';

class Teacher extends Controller {

    //new
    private $marksModel;
    private $classModel;
    private $studentModel;
    private $subjectModel;

    public function __construct() {

        //new
        $this->marksModel = $this->model('MarksModel');
        $this->classModel = $this->model('ClassModel');
        $this->studentModel = $this->model('StudentModel');
        $this->subjectModel = $this->model('SubjectModel');
    }

    public function teachers() {
        $this->view('all_teachers');
    }

    public function events() {
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

        $this->view('scheduled_events', $data);
    }

    public function timeTable() {
        $data = [
            'timeTable' => [
                ['time' => '08:30 - 09:30', 'monday' => 'Period 1', 'tuesday' => 'Period 1', 'wednesday' => 'Period 1', 'thursday' => 'Period 1', 'friday' => 'Period 1'],
                
            ]
        ];

        $this->view('time_table', $data);
    }

    public function attendance() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class_id = $_POST['class_id'];
    
            $classModel = $this->model('ClassModel');
            $studentModel = $this->model('StudentModel');
    
            $students = $studentModel->where(['class_id' => $class_id]);
            $students = is_array($students) ? $students : [];
    
            $this->view('inc/teacher/attendance', [
                'students' => $students,
                'class' => $class_id
            ]);
        }
    }
    
    public function submitAttendance() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $class = $_POST['class'] ?? null;
            $attendance = $_POST['attendance'] ?? [];
            $date = date('Y-m-d');    
            if (empty($class) || empty($attendance)) {
                $_SESSION['error'] = "Class or attendance data missing.";
                // header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
                var_dump($_SESSION['error']);
                exit();
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
    
            $_SESSION['success'] = "Attendance submitted successfully.";
            header("Location: " . URLROOT . "/teacher/viewAttendance?attendance_date=$date&view_class=$class");
            exit();
        } else {
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }
    }
    
    public function viewAttendance() {
        $date = $_GET['attendance_date'] ?? null;
        $class = $_GET['view_class'] ?? null;
    
        if (!$date || !$class) {
            $_SESSION['error'] = "Date or class not provided.";
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }
    
        $attendanceModel = new Student_attendanceModel();
        $attendanceRecords = $attendanceModel->where(['date' => $date, 'class' => $class]);
    
        $attendanceRecords = json_decode(json_encode($attendanceRecords), true);
    
        $this->view('inc/teacher/view_attendance', [
            'attendanceRecords' => $attendanceRecords,
            'date' => $date,
            'class' => $class
        ]);
    }

    public function dailyActivities() {
        $this->view('inc/teacher/daily_activities');
    }

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

            $_SESSION['success'] = "Activity recorded successfully.";
            header("Location: " . URLROOT . "/teacher/viewActivities");
            exit();
        } else {
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
            header("Location: " . URLROOT . "/teacher/viewActivities");
            exit();
        } else {
            $activity = $activityModel->first(['activity_id' => $id]);
            $this->view('inc/teacher/edit_activity', ['activity' => $activity]);
        }
    }

    public function deleteActivity($id) {
        $activityModel = new Current_activityModel();
        $activityModel->delete($id, 'activity_id');
        header("Location: " . URLROOT . "/teacher/viewActivities");
        exit();
    }

    public function index() {
        // Ensure that enterMarks does not redirect back to index
        redirect('teacher/selectClass'); // Change to a safe default page
    }


    public function selectClass() {
        $classModel = $this->model('ClassModel');
        $classes = $classModel->getAllClasses();
        $this->view('inc/teacher/selectClass', ['classes' => $classes]);
    }


    public function selectClassForAttendance() {
        // var_dump("this is selectClassForAttendance method");
        // die();
        $classModel = $this->model('ClassModel');
        $classes = $classModel->getAllClasses();
        $this->view('inc/teacher/select_class_for_attendance', ['classes' => $classes]);
    }

    public function selectClassForViewReport() {
        $classModel = $this->model('ClassModel');
        $classes = $classModel->getAllClasses();
        $this->view('inc/teacher/view_report_by_term', ['classes' => $classes]);
    }




    // public function viewClassReport() {
    //     $classId = $_POST['class'] ?? null;
    //     var_dump($_POST);
    //     if ($classId) {
    //         $classReport = $this->marksModel->getClassReport($classId);
    //         $ranks = $this->marksModel->getStudentRanks($classId);

    //         $this->view('inc/teacher/class_report', [
    //             'classReport' => $classReport,
    //             'ranks' => $ranks
    //         ]);
    //     } else {
    //         die("Class not provided.");
    //     }
    // }



    public function viewClassReport() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['class'];
            $marksData = $_POST['marks'] ?? [];
            $term = $_POST['term'] ?? null;
    
            $marksModel = $this->model('MarksModel');
    
            // Insert marks
            foreach ($marksData as $studentId => $subjects) {
                foreach ($subjects as $subjectId => $marks) {
                    $marksModel->insertMarks($studentId, $subjectId, $term, $marks, $classId);
                }
            }
    
            // Get data for the report
            $subjectWise = $marksModel->getClassReport($classId, $term);
            $rankData = $marksModel->getStudentRanks($classId, $term);
    
            // Group subject-wise marks for each student
            $classReport = [];
            foreach ($subjectWise as $row) {
                $sid = $row->student_id;
                if (!isset($classReport[$sid])) {
                    $classReport[$sid] = [
                        'student_id' => $sid,
                        'student_name' => $row->student_name,
                        'subjects' => [],
                        'total_marks_obtained' => 0,
                        'average_marks' => 0,
                    ];
                }
                $classReport[$sid]['subjects'][$row->subject_name] = $row->marks;
                $classReport[$sid]['total_marks_obtained'] += $row->marks;
            }
    
            // Calculate average
            foreach ($classReport as &$student) {
                $subjectCount = count($student['subjects']);
                $student['average_marks'] = $subjectCount > 0 ? $student['total_marks_obtained'] / $subjectCount : 0;
            }
    
            // Prepare ranks
            $ranks = [];
            foreach ($rankData as $row) {
                $ranks[] = [
                    'student_id' => $row->student_id,
                    'student_name' => $row->student_name,
                    'total_marks_obtained' => $classReport[$row->student_id]['total_marks_obtained'],
                    'percentage' => $classReport[$row->student_id]['average_marks'],
                ];
            }
    
            // Sort by percentage
            usort($ranks, fn($a, $b) => $b['percentage'] <=> $a['percentage']);
    
            // Load the view
            $this->view('inc/teacher/class_report', [
                'classReport' => $classReport,
                'ranks' => $ranks,
                'subjects' => array_map(fn($row) => (object)['name' => $row->subject_name], $subjectWise),
                'term' => $term
            ]);
        } else {
            header("Location: " . URLROOT . "/teacher");
        }
    }
    
    public function viewTermReport() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['class'];
            $term = $_POST['term'];
    
            $marksModel = $this->model('MarksModel');
    
            $subjectWise = $marksModel->getClassReportByTerm($classId, $term);
            $rankData = $marksModel->getStudentRanksByTerm($classId, $term);
    
            if (!$subjectWise || count($subjectWise) === 0) {
                $this->view('inc/teacher/class_report', [
                    'message' => 'No data entered for this term.',
                    'term' => $term
                ]);
                return;
            }
    
            $classReport = [];
            $subjectIds = [];
            foreach ($subjectWise as $row) {
                $sid = $row->student_id;
                if (!isset($classReport[$sid])) {
                    $classReport[$sid] = [
                        'student_id' => $sid,
                        'student_name' => $row->student_name,
                        'subjects' => [],
                        'total_marks_obtained' => 0,
                        'average_marks' => 0,
                    ];
                }
                $classReport[$sid]['subjects'][$row->subject_name] = $row->marks;
                $classReport[$sid]['total_marks_obtained'] += $row->marks;
    
                // Map subject names to IDs
                $subjectIds[$row->subject_name] = $row->subject_id;
            }
    
            foreach ($classReport as &$student) {
                $subjectCount = count($student['subjects']);
                $student['average_marks'] = $subjectCount > 0 ? $student['total_marks_obtained'] / $subjectCount : 0;
            }
    
            $ranks = [];
            foreach ($rankData as $row) {
                $ranks[] = [
                    'student_id' => $row->student_id,
                    'student_name' => $row->student_name,
                    'total_marks_obtained' => $classReport[$row->student_id]['total_marks_obtained'] ?? 0,
                    'percentage' => $classReport[$row->student_id]['average_marks'] ?? 0,
                ];
            }
    
            usort($ranks, fn($a, $b) => $b['percentage'] <=> $a['percentage']);
    
            $this->view('inc/teacher/class_report', [
                'classReport' => $classReport,
                'ranks' => $ranks,
                'term' => $term,
                'subjects' => array_map(fn($r) => (object)['name' => $r->subject_name], $subjectWise),
                'subjectIds' => $subjectIds
            ]);
        } else {
            header("Location: " . URLROOT . "/teacher");
        }
    }


    public function updateMarks()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $marksModel = $this->model('MarksModel');

        $classId = $_POST['class'];
        
        $term = $_POST['term'];
        $marksData = $_POST['marks']; // ['student_id']['subject'] => mark

        foreach ($marksData as $studentId => $subjectMarks) {
            foreach ($subjectMarks as $subjectName => $mark) {
                $marksModel->updateOrInsertMarks($studentId, $subjectName, $term, $mark, $classId);
            }
        }

        // Redirect to updated report
        echo '<form id="redirectForm" method="POST" action="' . URLROOT . '/teacher/viewTermReport">';
        echo '<input type="hidden" name="class" value="' . htmlspecialchars($classId) . '">';
        echo '<input type="hidden" name="term" value="' . htmlspecialchars($term) . '">';
        echo '</form>';
        echo '<script>document.getElementById("redirectForm").submit();</script>';
        exit;
    } else {
        header("Location: " . URLROOT . "/teacher");
    }
}

    
    

    
    // public function classReport() {
    //     $marksModel = $this->model('MarksModel');
    
    //     $data = [
    //         'classReport' => $marksModel->getClassReport(),
    //         'ranks' => $marksModel->getClassRanks(),
    //     ];
    
    //     $this->view('inc/teacher/class_report', $data);
    // }
    

    // public function selectClass() {
    //     $classModel = $this->model('ClassModel'); // Instantiate the model
    //     $classes = $classModel->getAllClasses(); // Fetch classes

    //     // var_dump($classes); 
    //     // die(); // Stop execution to inspect the output

    //     $this->view('inc/teacher/selectClass', ['classes' => $classes]); // Pass to view
    // }
    

    // public function getStudentsAndSubjects()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $class = $_POST['class'];
    //         $students = $this->studentModel->getStudentsByClass($class);
    //         $subjects = $this->subjectModel->getSubjectsByClass($class);

    //         $this->view('inc/teacher/submit_marks', [
    //             'class' => $class,
    //             'students' => $students,
    //             'subjects' => $subjects
    //         ]);
    //     }
    // }

     
    //new
    // public function submitMarks() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $classId = $_POST['class_id'];
    //         $marksData = $_POST['marks'] ?? [];

    //         foreach ($marksData as $studentId => $subjects) {
    //             foreach ($subjects as $subjectId => $marks) {
    //                 $this->marksModel->insertMarks($studentId, $subjectId, $marks);
    //             }
    //         }

    //         flash('marks_success', 'Marks submitted successfully!');
    //         // redirect('teacher/viewClassReport?class=' . $classId);
    //         redirect('teacher/submitMarks');
            
    //     } else {
    //         $data = [
    //             'classes' => $this->model('ClassModel')->getAllClasses(),
    //             'students' => [],
    //             'subjects' => [],
    //         ];

    //         if (!empty($_POST['class'])) {
    //             $data['students'] = $this->studentModel->getStudentsByClass($_POST['class_id']);
    //             $data['subjects'] = $this->subjectModel->getSubjectsByClass($_POST['class_id']);
    //         }

    //         var_dump($data['students']);

    //         $this->view('inc/teacher/submit_marks', $data);
    //     }
    // }

    public function submitMarks() {
        $classModel = $this->model('ClassModel');
        $studentModel = $this->model('StudentModel');
        $subjectModel = $this->model('SubjectModel');
        $marksModel = $this->model('MarksModel');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class_id = $_POST['class_id'];
    
            // Fetch subjects
            $results = $subjectModel->query("
                SELECT s.id, s.name 
                FROM subject_class sc
                JOIN subjects s ON sc.subject_id = s.id
                WHERE sc.class_id = ?", 
                [$class_id]
            );
    
            // Fetch students
            $students = $studentModel->where(['class_id' => $class_id]);
    
            // Ensure they are arrays to avoid foreach errors
            $subjects = is_array($results) ? $results : [];
            $students = is_array($students) ? $students : [];
    
            // Debugging output (Remove later)
    
            // Pass subjects and students to the view
            $this->view('inc/teacher/submit_marks', [
                'subjects' => $subjects,
                'students' => $students,
                'class'=> $class_id
            ]);
        }
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
 }

?>