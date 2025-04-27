<?php session_start();
require_once '../app/helpers/url_helper.php';
require_once '../app/helpers/session_helper.php';

class Teacher extends Controller
{

    //new
    private $marksModel;
    private $classModel;
    private $studentModel;
    private $subjectModel;
    private $teacherModel;
    private $ClassesModel;

    public function __construct()
    {


        //new
        $this->marksModel = $this->model('MarksModel');
        $this->classModel = $this->model('ClassModel');
        $this->studentModel = $this->model('StudentModel');
        $this->subjectModel = $this->model('SubjectModel');
        $this->teacherModel = $this->model('TeacherModel');
        $this->ClassesModel = $this->model('ClassesModel');
    }

    public function teachers()
    {
        $this->view('all_teachers');
    }

    public function events()
    {
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

    public function timeTable()
    {
        $data = [
            'timeTable' => [
                ['time' => '08:30 - 09:30', 'monday' => 'Period 1', 'tuesday' => 'Period 1', 'wednesday' => 'Period 1', 'thursday' => 'Period 1', 'friday' => 'Period 1'],

            ]
        ];

        $this->view('time_table', $data);
    }

    public function attendance()
    {
        checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['classId'];
            $errors = [];

            if (empty($classId)) {
                $errors['class'] = "Please select a class.";

                $classModel = $this->model('ClassModel');
                $classes = $classModel->query("SELECT classId, className FROM classes");

                $this->view('inc/teacher/select_class_for_attendance', [
                    'classes' => $classes,
                    'errors' => $errors
                ]);
                return;
            }

            $studentModel = $this->model('StudentModel');
            $students = $studentModel->where(['classId' => $classId]);
            $students = is_array($students) ? $students : [];

            $this->view('inc/teacher/attendance', [
                'students' => $students,
                'class' => $classId,
                'errors' => [],
                'success' => '',
                'oldInput' => []
            ]);
        } else {
            // Handle GET request: show class selection page
            $classModel = $this->model('ClassModel');
            $classes = $classModel->query("SELECT classId, className FROM classes");

            $this->view('inc/teacher/select_class_for_attendance', [
                'classes' => $classes,
                'errors' => []
            ]);
        }
    }

    public function submitAttendance()
    {
        checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class = $_POST['class'] ?? null;
            $attendance = $_POST['attendance'] ?? [];
            $studentNames = $_POST['student_name'] ?? [];
            $date = date('Y-m-d');
            $errors = [];

            $studentModel = $this->model('StudentModel');
            $students = $studentModel->where(['classId' => $class]);
            $students = is_array($students) ? $students : [];

            // Validate class
            if (empty($class)) {
                $errors['general'] = "Class information is missing.";
            }

            // Validate attendance data
            if (empty($attendance)) {
                $errors['general'] = "Attendance data is missing. Please mark all students.";
            }

            // Validate individual attendance records
            foreach ($students as $student) {
                $studentId = $student->student_id;

                // Check if status is selected
                if (!isset($attendance[$studentId])) {
                    $errors['attendance'][$studentId] = "Please select a status.";
                }
                // Check if status is valid
                elseif (!in_array($attendance[$studentId], ['present', 'absent'])) {
                    $errors['attendance'][$studentId] = "Invalid status.";
                }
            }

            // Check for existing attendance on this date
            if (empty($errors['general'])) {
                $attendanceModel = new Student_attendanceModel();
                $existing = $attendanceModel->where(['class' => $class, 'date' => $date]);

                if (!empty($existing)) {
                    $errors['general'] = "Attendance for this class has already been entered today.";
                }
            }

            // If validation fails, return to form with errors and old input
            if (!empty($errors)) {
                $this->view('inc/teacher/attendance', [
                    'students' => $students,
                    'class' => $class,
                    'errors' => $errors,
                    'oldInput' => [
                        'attendance' => $attendance
                    ]
                ]);
                return;
            }

            // If we reach here, validation passed - insert the attendance records
            $attendanceModel = new Student_attendanceModel();
            foreach ($attendance as $studentId => $status) {
                $studentData = [
                    'date' => $date,
                    'student_id' => $studentId,
                    'name' => $studentNames[$studentId],
                    'class' => $class,
                    'status' => $status,
                ];
                $attendanceModel->insert($studentData);
            }

            // Redirect to view attendance page with success parameter
            header("Location: " . URLROOT . "/teacher/viewAttendance?attendance_date=$date&view_class=$class&success=submitted");
            exit();
        } else {
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }
    }


    public function viewAttendance()
    {
        checkRole('teacher');
        $date = $_GET['attendance_date'] ?? null;
        $classId = $_GET['view_class'] ?? null;

        if (!$date || !$classId) {
            $_SESSION['error'] = "Date or class not provided.";
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }

        $attendanceModel = new Student_attendanceModel();
        $attendanceRecords = $attendanceModel->where(['date' => $date, 'class' => $classId]);
        $className = $attendanceModel->getClassName($classId);

        $attendanceRecords = json_decode(json_encode($attendanceRecords), true);

        $this->view('inc/teacher/view_attendance', [
            'attendanceRecords' => $attendanceRecords,
            'date' => $date,
            'class' => $classId,         // for logic if needed
            'className' => $className    // for display
        ]);
    }


    public function editAttendance()
    {
        checkRole('teacher');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'];
            $classId = $_POST['class'];

            $attendanceModel = new Student_attendanceModel();
            $records = $attendanceModel->where(['date' => $date, 'class' => $classId]);
            $className = $attendanceModel->getClassName($classId);

            $records = json_decode(json_encode($records), true);

            $this->view('inc/teacher/edit_attendance', [
                'attendanceRecords' => $records,
                'date' => $date,
                'class' => $classId,
                'className' => $className
            ]);
        }
    }


    public function updateAttendance()
    {
        checkRole('teacher');
        $attendanceModel = new Student_attendanceModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $submittedDate = $_POST['date'];
            $class = $_POST['class'];
            $today = date('Y-m-d');
            $daysDiff = (strtotime($today) - strtotime($submittedDate)) / (60 * 60 * 24);

            if ($daysDiff > 7) {
                $_SESSION['error'] = "You can only update attendance within 7 days of submission.";
                header("Location: " . URLROOT . "/teacher/viewAttendance?attendance_date=$submittedDate&view_class=$class");
                exit();
            }

            foreach ($_POST['status'] as $studentId => $status) {
                $data = [
                    'status' => $status,
                    'name' => $_POST['student_name'][$studentId] ?? ''
                ];

                $where = [
                    'student_id' => $studentId,
                    'date' => $submittedDate,
                    'class' => $class
                ];

                $attendanceModel->updateWhere($where, $data);
            }

            $_SESSION['success'] = "Attendance updated successfully.";
            header("Location: " . URLROOT . "/teacher/viewAttendance?attendance_date=$submittedDate&view_class=$class");
            exit();
        } else {
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }
    }




    //absences

    public function viewAbsences()
    {
        checkRole('teacher');
        $date = $_GET['attendance_date'] ?? null;
        $class = $_GET['class'] ?? null;

        if (!$date || !$class) {
            $_SESSION['error'] = "Date or class not provided.";
            header("Location: " . URLROOT . "/teacher/selectClassForAttendance");
            exit();
        }

        $attendanceModel = new Student_attendanceModel();
        $absences = $attendanceModel->getAbsencesByDateAndClass($date, $class);
        $absences = json_decode(json_encode($absences), true);


        $absenceModel = new AbsenceModel();
        $className = $absenceModel->getClassName($class); // use $class (which is classId from the form)

        $this->view('inc/teacher/view_absences', [
            'absences' => $absences,
            'date' => $date,
            'className' => $className // <- this should now be the actual class name
        ]);
    }


    public function dailyActivities()
    {
        checkRole('teacher');

        $classModel = new ClassModel();
        $subjectModel = new SubjectModel();

        $classes = $classModel->getAllClasses();
        $subjects = $subjectModel->getAllSubjects();

        $this->view('inc/teacher/daily_activities', [
            'classes' => $classes,
            'subjects' => $subjects
        ]);
    }


    // Handle form submission
    public function submitActivities()
    {
        checkRole('teacher');

        // Initialize variables for form data and errors
        $data = [
            'subjects' => (new SubjectModel())->getAllSubjects(),
            'classes' => (new ClassModel())->getAllClasses(),
            'form_errors' => [],
            'form_data' => [
                'attendance_date' => '',
                'period' => '',
                'subject' => '',
                'class' => '',
                'description' => '',
                'additional_note' => ''
            ]
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Store form data to repopulate form if validation fails
            $data['form_data'] = [
                'attendance_date' => trim($_POST['attendance_date'] ?? ''),
                'period' => trim($_POST['period'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'class' => trim($_POST['class'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'additional_note' => trim($_POST['additional_note'] ?? '')
            ];

            // Validate Date
            $today = date('Y-m-d');
            if (empty($data['form_data']['attendance_date'])) {
                $data['form_errors']['attendance_date'] = 'Date is required.';
            } elseif ($data['form_data']['attendance_date'] > $today) {
                $data['form_errors']['attendance_date'] = 'Date must be today or a previous date.';
            }

            // Validate Period
            if (empty($data['form_data']['period'])) {
                $data['form_errors']['period'] = 'Period is required.';
            }

            // Validate Subject
            if (empty($data['form_data']['subject'])) {
                $data['form_errors']['subject'] = 'Subject is required.';
            }

            // Validate Class
            if (empty($data['form_data']['class'])) {
                $data['form_errors']['class'] = 'Class is required.';
            }

            // Validate Description
            if (empty($data['form_data']['description'])) {
                $data['form_errors']['description'] = 'Description is required.';
            }

            // If no errors, process form
            if (empty($data['form_errors'])) {
                // Build activity record
                $activityData = [
                    'teacher_id'      => $_SESSION['user']['regNo'],
                    'date'            => $data['form_data']['attendance_date'],
                    'period'          => $data['form_data']['period'],
                    'subject'         => $data['form_data']['subject'],
                    'class'           => $data['form_data']['class'],
                    'description'     => $data['form_data']['description'],
                    'additional_note' => $data['form_data']['additional_note'],
                ];

                $activityModel = new Current_activityModel();
                $success = $activityModel->insert($activityData);

                if ($success) {
                    redirect('/teacher/viewActivities?success=Activity recorded successfully.');
                } else {
                    // If database insert failed
                    $data['error'] = 'Failed to save activity. Please try again.';
                    $this->view('inc/teacher/daily_activities', $data);
                }
            } else {
                // Return to form with errors
                $this->view('inc/teacher/daily_activities', $data);
            }
        } else {
            // GET request - just show the form
            $this->view('inc/teacher/daily_activities', $data);
        }
    }

    // List only this teacher's activities
    public function viewActivities()
    {
        checkRole('teacher');
        $teacherId = $_SESSION['user']['regNo'];

        $data = [];

        // Check for success message in URL (from redirect)
        if (isset($_GET['success'])) {
            $data['success'] = $_GET['success'];
        }

        // Check for error message in URL (from redirect)
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }

        $activityModel = new Current_activityModel();
        $data['activities'] = $activityModel->getTeacherActivities($teacherId);

        $this->view('inc/teacher/view_activities', $data);
    }

    // Helper function for redirects with messages
    private function redirect($url)
    {
        header("Location: " . URLROOT . $url);
        exit;
    }

    // Edit existing activity (only if it belongs to this teacher)
    public function editActivity($id)
    {
        checkRole('teacher');
        $teacherId = $_SESSION['user']['regNo'];
        $activityModel = new Current_activityModel();
        $classModel = new ClassModel();
        $subjectModel = new SubjectModel();

        // Initialize data array
        $data = [
            'classes' => $classModel->getAllClasses(),
            'subjects' => $subjectModel->getAllSubjects(),
            'form_errors' => [],
            'activity' => null
        ];

        // Fetch the record and ensure it belongs to this teacher
        $activity = $activityModel->first([
            'activity_id' => $id,
            'teacher_id'  => $teacherId
        ]);

        if (!$activity) {
            return $this->redirect('/teacher/viewActivities?error=You are not authorized to edit that activity.');
        }

        $data['activity'] = $activity;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Store form data
            $formData = [
                'date' => trim($_POST['date'] ?? ''),
                'period' => trim($_POST['period'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'class' => trim($_POST['class'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'additional_note' => trim($_POST['additional_note'] ?? '')
            ];

            // Validate (add more validations as needed)
            if (empty($formData['date'])) {
                $data['form_errors']['date'] = 'Date is required.';
            } elseif ($formData['date'] > date('Y-m-d')) {
                $data['form_errors']['date'] = 'Date must be today or a previous date.';
            }

            if (empty($formData['period'])) {
                $data['form_errors']['period'] = 'Period is required.';
            }

            if (empty($formData['subject'])) {
                $data['form_errors']['subject'] = 'Subject is required.';
            }

            if (empty($formData['class'])) {
                $data['form_errors']['class'] = 'Class is required.';
            }

            if (empty($formData['description'])) {
                $data['form_errors']['description'] = 'Description is required.';
            }

            // If no errors, update the activity
            if (empty($data['form_errors'])) {
                $activityModel->update($id, $formData, 'activity_id');
                return $this->redirect('/teacher/viewActivities?success=Activity updated successfully.');
            } else {
                // Update activity with form data to preserve input values
                $data['activity'] = (object)array_merge((array)$activity, $formData);
                $this->view('inc/teacher/edit_activity', $data);
            }
        } else {
            // GET request - just show the form
            $this->view('inc/teacher/edit_activity', $data);
        }
    }

    // Delete an activity (only if it belongs to this teacher)
    public function deleteActivity($id)
    {
        checkRole('teacher');
        $teacherId = $_SESSION['user']['regNo'];
        $activityModel = new Current_activityModel();

        // Ensure it's really this teacher's record
        $activity = $activityModel->first([
            'activity_id' => $id,
            'teacher_id'  => $teacherId
        ]);

        if (!$activity) {
            return $this->redirect('/teacher/viewActivities?error=You are not authorized to delete that activity.');
        } else {
            $activityModel->delete($id, 'activity_id');
            return $this->redirect('/teacher/viewActivities?success=Activity deleted successfully.');
        }
    }

    public function index()
    {
        checkRole('teacher');
        // Ensure that enterMarks does not redirect back to index
        redirect('teacher/selectClass'); // Change to a safe default page
    }


    public function selectClass()
    {
        checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['classId'] ?? '';
            $term = $_POST['term'] ?? '';

            // Manual validation: Check if both class and term are selected
            if (empty($classId) || empty($term)) {
                $_SESSION['error'] = "Please select both class and term.";
                header("Location: " . URLROOT . "/teacher/selectClass");
                exit();
            }

            // Redirect to submitMarks with classId and term
            header("Location: " . URLROOT . "/teacher/submitMarks?classId=$classId&term=$term");
            exit();
        } else {
            // If it's GET request, show select class form
            $classModel = $this->model('ClassModel');
            $classes = $classModel->getAllClasses();
            $this->view('inc/teacher/selectClass', ['classes' => $classes]);
        }
    }



    public function selectClassForAttendance()
    {
        checkRole('teacher');
        // var_dump("this is selectClassForAttendance method");
        // die();
        $classModel = $this->model('ClassModel');
        $classes = $classModel->getAllClasses();
        $this->view('inc/teacher/select_class_for_attendance', ['classes' => $classes]);
    }

    public function selectClassForViewReport()
    {
        checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['class'] ?? '';
            $term = $_POST['term'] ?? '';

            // Manual validation: Check if both class and term selected
            if (empty($classId) || empty($term)) {
                $_SESSION['error'] = "Please select both class and term.";
                header("Location: " . URLROOT . "/teacher/selectClassForViewReport");
                exit();
            }

            // If validated, redirect to viewTermReport with GET params
            header("Location: " . URLROOT . "/teacher/viewTermReport?class=$classId&term=$term");
            exit();
        } else {
            // GET request -> Show class and term selection page
            $classModel = $this->model('ClassModel');
            $classes = $classModel->getAllClasses();
            $this->view('inc/teacher/view_report_by_term', ['classes' => $classes]);
        }
    }


    public function viewClassReport()
    {
        checkRole('teacher');
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

            // Validate data before using it
            if (!is_array($subjectWise)) $subjectWise = [];
            if (!is_array($rankData)) $rankData = [];

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
                if (isset($classReport[$row->student_id])) {
                    $ranks[] = [
                        'student_id' => $row->student_id,
                        'student_name' => $row->student_name,
                        'total_marks_obtained' => $classReport[$row->student_id]['total_marks_obtained'],
                        'percentage' => $classReport[$row->student_id]['average_marks'],
                    ];
                }
            }

            // Sort by percentage
            usort($ranks, fn($a, $b) => $b['percentage'] <=> $a['percentage']);

            $classModel = $this->model('ClassModel');
            $className = $classModel->getClassName($classId);

            // Load the view
            $this->view('inc/teacher/class_report', [
                'classReport' => $classReport,
                'ranks' => $ranks,
                'subjects' => array_map(fn($row) => (object)['name' => $row->subject_name], $subjectWise),
                'term' => $term,
                'class' => $classId,
                'className' => $className
            ]);
        } else {
            header("Location: " . URLROOT . "/teacher");
        }
    }


    public function viewTermReport()
    {
        checkRole('teacher');

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $classId = $_GET['class'] ?? null;
            $term = $_GET['term'] ?? null;

            if (!$classId || !$term) {
                $_SESSION['error'] = "Class or Term missing.";
                header("Location: " . URLROOT . "/teacher/selectClassForViewReport");
                exit();
            }

            $marksModel = $this->model('MarksModel');
            $attendanceModel = $this->model('ClassModel');

            $className = $attendanceModel->getClassName($classId);
            $subjectWise = $marksModel->getClassReportByTerm($classId, $term);
            $rankData = $marksModel->getStudentRanksByTerm($classId, $term);

            if (!$subjectWise || count($subjectWise) === 0) {
                $this->view('inc/teacher/class_report', [
                    'message' => 'No data entered for this term.',
                    'term' => $term,
                    'className' => $className,
                    'class' => $classId
                ]);
                return;
            }

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
                'className' => $className,
                'class' => $classId
            ]);
        } else {
            header("Location: " . URLROOT . "/teacher");
            exit();
        }
    }



    public function showAllTeachers($page = 1)
    {
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

    public function submitMarks()
    {
        checkRole('teacher');
        $classModel = $this->model('ClassModel');
        $studentModel = $this->model('StudentModel');
        $subjectModel = $this->model('SubjectModel');
        $marksModel = $this->model('MarksModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_SESSION['form_data'])) {
            if (isset($_SESSION['form_data'])) {
                $classId = $_SESSION['form_data']['class'];
                $term = $_SESSION['form_data']['term'];
                unset($_SESSION['form_data']);
            } else {
                $classId = $_POST['classId'];
                $term = $_POST['term'] ?? null;
            }

            if (!$classId || !$term) {
                $_SESSION['error'] = "Class and term are required.";
                header("Location: " . URLROOT . "/teacher/selectClass");
                exit();
            }

            if ($marksModel->marksExistForClassTerm($classId, $term)) {
                $_SESSION['error'] = "Marks already submitted for this class and term.";
                header("Location: " . URLROOT . "/teacher/selectClass");
                exit();
            }

            $subjects = $subjectModel->query(
                "SELECT s.subjectId, s.subjectName
             FROM subject_class sc
             JOIN subjects s ON sc.subject_id = s.subjectId
             WHERE sc.class_id = ?",
                [$classId]
            );

            $students = $studentModel->where(['classId' => $classId]);

            $this->view('inc/teacher/submit_marks', [
                'subjects' => is_array($subjects) ? $subjects : [],
                'students' => is_array($students) ? $students : [],
                'class'    => $classId,
                'term'     => $term
            ]);
        }
    }


    public function processMarks()
    {
        checkRole('teacher');
        $marksModel = $this->model('MarksModel');
        $classModel = $this->model('ClassModel');
        $studentModel = $this->model('StudentModel');
        $subjectModel = $this->model('SubjectModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['class'] ?? null;
            $term = $_POST['term'] ?? null;
            $marksData = $_POST['marks'] ?? [];

            if (!$classId || !$term) {
                $_SESSION['error'] = "Class and term are required.";
                header("Location: " . URLROOT . "/teacher/selectClass");
                exit();
            }

            if ($marksModel->marksExistForClassTerm($classId, $term)) {
                $_SESSION['error'] = "Marks already submitted for this class and term.";
                header("Location: " . URLROOT . "/teacher/selectClass");
                exit();
            }

            // Validate if all marks are filled
            foreach ($marksData as $studentId => $subjectMarks) {
                foreach ($subjectMarks as $subjectId => $mark) {
                    if ($mark === '' || $mark === null) {
                        // Save entered data into session
                        $_SESSION['error'] = "All marks must be entered for each student.";
                        $_SESSION['form_data'] = [
                            'class' => $classId,
                            'term' => $term,
                            'marks' => $marksData
                        ];
                        header("Location: " . URLROOT . "/teacher/submitMarks");
                        exit();
                    }
                }
            }

            // Insert marks
            foreach ($marksData as $studentId => $subjectMarks) {
                foreach ($subjectMarks as $subjectId => $mark) {
                    $marksModel->insertMarks($studentId, $subjectId, $term, $mark, $classId);
                }
            }

            // Redirect safely
            echo '<form id="redirectForm" method="POST" action="' . URLROOT . '/teacher/viewClassReport">';
            echo '<input type="hidden" name="class" value="' . htmlspecialchars($classId) . '">';
            echo '<input type="hidden" name="term" value="' . htmlspecialchars($term) . '">';
            echo '</form>';
            echo '<script>document.getElementById("redirectForm").submit();</script>';
            exit();
        }
    }


    public function updateMarks()
{
    checkRole('teacher');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $marksModel = $this->model('MarksModel');

        $classId = $_POST['class'] ?? null;
        $term = $_POST['term'] ?? null;
        $marksData = $_POST['marks'] ?? [];

        if (!$classId || !$term) {
            $_SESSION['error'] = "Class and term are required.";
            header("Location: " . URLROOT . "/teacher/selectClass");
            exit();
        }

        // Manual validation: Check for empty marks
        foreach ($marksData as $studentId => $subjectMarks) {
            foreach ($subjectMarks as $subjectId => $mark) {
                if ($mark === '' || $mark === null) {
                    $_SESSION['error'] = "All marks must be entered for each student.";
                    header("Location: " . URLROOT . "/teacher/viewTermReport?class=" . urlencode($classId) . "&term=" . urlencode($term));
                    exit();
                }
            }
        }

        // Update or Insert marks
        foreach ($marksData as $studentId => $subjectMarks) {
            foreach ($subjectMarks as $subjectId => $mark) {
                $marksModel->updateOrInsertMarks($studentId, $subjectId, $term, $mark, $classId);
            }
        }

        
        header("Location: " . URLROOT . "/teacher/viewTermReport?class=" . urlencode($classId) . "&term=" . urlencode($term));
        exit();
    } else {
        header("Location: " . URLROOT . "/teacher");
        exit();
    }
}



    public function assignClassTeacher()
    {
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get data from form
            $classId = isset($_POST['classId']) ? $_POST['classId'] : null;
            $teacherId = isset($_POST['teacherId']) ? $_POST['teacherId'] : null;
            $academicYear = isset($_POST['academicYear']) ? $_POST['academicYear'] : null;

            // Validate data
            if (!$classId || !$teacherId) {
                $_SESSION['error'] = 'Please select both a class and a teacher.';
                header('Location: ' . URLROOT . '/teacher/assignClassTeacher?academicYear=' . urlencode($academicYear));
                exit;
            }

            // Attempt to assign teacher
            if ($this->teacherModel->assignTeacherToClass($classId, $teacherId)) {
                $_SESSION['success'] = 'Teacher assigned successfully.';
                header('Location: ' . URLROOT . '/teacher/assignClassTeacher?academicYear=' . urlencode($academicYear));
                exit;
            } else {
                $_SESSION['error'] = 'Failed to assign teacher to class.';
                header('Location: ' . URLROOT . '/teacher/assignClassTeacher?academicYear=' . urlencode($academicYear));
                exit;
            }
        } else {
            // Display the class teacher assignment page
            $academicYear = isset($_GET['academicYear']) ? $_GET['academicYear'] : '';

            // Get all academic years
            $academicYears = $this->ClassesModel->getAcademicYears();

            // Get classes for the selected academic year
            $classes = $academicYear ? $this->teacherModel->getClassesWithTeachers($academicYear) : [];

            // Format class data for display
            $formattedClasses = [];
            foreach ($classes as $class) {
                $formattedClasses[] = [
                    'classId' => $class->classId,
                    'className' => $class->className,
                    'academicYear' => $class->academicYear,
                    'teacherName' => $class->teacherName ?: 'None'
                ];
            }

            // Get teachers available for assignment
            $teachers = $this->teacherModel->getTeachersForAssignment();

            $data = [
                'title' => 'Assign Class Teachers',
                'academic_year' => $academicYears,
                'selected_academic_year' => $academicYear,
                'classes' => $formattedClasses,
                'teachers' => $teachers,
                'error' => $_SESSION['error'] ?? '',
                'success' => $_SESSION['success'] ?? ''
            ];

            // Clear session messages after using them
            unset($_SESSION['error'], $_SESSION['success']);

            $this->view('inc/assignClassTeacher', $data);
        }
    }




   
}
