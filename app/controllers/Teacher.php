<?php
require_once '../app/helpers/url_helper.php';
require_once '../app/helpers/session_helper.php';

class Teacher extends Controller {

    //new
    private $marksModel;
    private $classModel;
    private $studentModel;
    private $subjectModel;
    private $teacherModel;
    private $ClassesModel;

    public function __construct() {


        //new
        $this->marksModel = $this->model('MarksModel');
        $this->classModel = $this->model('ClassModel');
        $this->studentModel = $this->model('StudentModel');
        $this->subjectModel = $this->model('SubjectModel');
        $this->teacherModel = $this->model('TeacherModel');
        $this->ClassesModel = $this->model('ClassesModel');
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
            $classId = $_POST['classId'];
    
            $classModel = $this->model('ClassModel');
            $studentModel = $this->model('StudentModel');
    
            $students = $studentModel->where(['classId' => $classId]);
            $students = is_array($students) ? $students : [];
    
            $this->view('inc/teacher/attendance', [
                'students' => $students,
                'class' => $classId
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
                header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
                exit();
            }
    
            $attendanceModel = new Student_attendanceModel();
    
            //  Check if attendance already exists
            $existing = $attendanceModel->where(['class' => $class, 'date' => $date]);
    
            if (!empty($existing)) {
                $_SESSION['error'] = "Attendance for this class has already been entered for today.";
                header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
                exit();
            }
    
            //  Save new attendance
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


    //absences

    public function viewAbsences() {
        $date = $_GET['absence_date'] ?? null;
        $class = $_GET['class'] ?? null;
    
        if (!$date || !$class) {
            $_SESSION['error'] = "Date or class not provided.";
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }
    
        $attendanceModel = new Student_attendanceModel();
        $absences = $attendanceModel->getAbsencesByDateAndClass($date, $class);
        $absences = json_decode(json_encode($absences), true);
    
        $this->view('inc/teacher/view_absences', [
            'absences' => $absences,
            'date' => $date,
            'class' => $class
        ]);
    }
    

    public function dailyActivities() {
        $this->view('inc/teacher/daily_activities');
    }
    
    public function submitActivities() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $date = $_POST['date'];
            $today = date('Y-m-d');
            $oneWeekAgo = date('Y-m-d', strtotime('-7 days'));
    
            // Validate date: should not be a future date or older than 7 days
            if ($date > $today || $date < $oneWeekAgo) {
                $_SESSION['error'] = "Date must be today or within the last 7 days.";
                header("Location: " . URLROOT . "/teacher/dailyActivities");
                exit();
            }
    
            $activityData = [
                'date' => $date,
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
    
        // Just call query(), no need for fetchAll()
        $activities = $activityModel->query("SELECT * FROM current_activity ORDER BY date");
    
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
                'term' => $term,
                'class' => $classId
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
                'class' => $classId
            ]);
        } else {
            header("Location: " . URLROOT . "/teacher");
        }
    }
  
  
    public function showAllTeachers($page = 1) {
        checkRoles(['principal', 'vice-principal']);
    
        $limit = 25; // Number of teachers per page
        $offset = ($page - 1) * $limit;
    
        // Fetch paginated teachers and total count
        $teachers = $this->teacherModel->getAllTeachers($limit, $offset);
        $totalTeachers = $this->teacherModel->getTotalTeachers();
        $grades = $this->ClassesModel->getAllGrades();
        $subjects = $this->subjectModel->getAllSubjects();

    
        // Prepare data for the view
        $data = [
            'teachers' => [],
            'teacherCount' => count($teachers),
            'teacherTotal' => $totalTeachers,
            'grades' => $grades,
            'subjects' => $subjects,
            'page' => $page,
            'totalPages' => ceil($totalTeachers / $limit),
            'message' => ''
        ];
    
        // Check if $teachers is an array and not empty
        if (is_array($teachers) && !empty($teachers)) {
            $data['teachers'] = array_map(function ($teacher) {
                return [
                    'regNo' => $teacher->regNo,
                    'fullName' => $teacher->firstName . ' ' . $teacher->lastName,
                    'email' => $teacher->email,
                    'mobileNo' => $teacher->mobileNo,
                    'subjects' => $teacher->subjects,
                    'className' => $teacher->className
                ];
            }, $teachers);
        } else {
            $data['message'] = 'No teachers found in the database.';
        }
    
        // Pass the data to the view
        $this->view('inc/teacher/all_teachers', $data);
    }

    public function updateMarks() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marksModel = $this->model('MarksModel');

            $classId = $_POST['class'];
            $term = $_POST['term'];
            $marksData = $_POST['marks'];

            foreach ($marksData as $studentId => $subjectMarks) {
                foreach ($subjectMarks as $subjectName => $mark) {
                    $marksModel->updateOrInsertMarks($studentId, $subjectName, $term, $mark, $classId);
                }
            }

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

    public function submitMarks() {
        $classModel = $this->model('ClassModel');
        $studentModel = $this->model('StudentModel');
        $subjectModel = $this->model('SubjectModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['classId'];

            $results = $subjectModel->query("
                SELECT s.id, s.name 
                FROM subject_class sc
                JOIN subjects s ON sc.subject_id = s.id
                WHERE sc.class_id = ?", 
                [$classId]
            );

            $students = $studentModel->where(['classId' => $classId]);

            $subjects = is_array($results) ? $results : [];
            $students = is_array($students) ? $students : [];

            $this->view('inc/teacher/submit_marks', [
                'subjects' => $subjects,
                'students' => $students,
                'class'=> $classId
            ]);
        }
    }
    

 }

?>