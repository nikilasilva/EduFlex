<?php

class Timetable extends Controller {
    private $timetableModel;
    private $classModel;
    private $SubjectModel;
    private $TeacherModel;

    public function __construct() {
        checkRoles(['principal', 'vice-principal']);
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        $this->timetableModel = $this->model('TimetableModel');
        $this->classModel = $this->model('ClassesModel');
        $this->SubjectModel = $this->model('SubjectModel');
        $this->TeacherModel = $this->model('TeacherModel');
    }

    public function index() {
        $this->classTimetable();
    }

    public function classTimetable() {
        // For regular page load
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->classModel->setLimit(50);
            $classes = $this->classModel->findAll();
            $data = [
                'classes' => $classes,
                'timetable' => []
            ];
            $this->view('inc/timetables/classTimetable', $data);
        } 
        // For AJAX requests
        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if this is an AJAX request
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
                      
            // Get JSON input data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $classId = !empty($data['classId']) ? $data['classId'] : null;
            $day = !empty($data['day']) ? $data['day'] : null;
            
            if ($classId && $day) {
                $timetable = $this->timetableModel->getTimetableByClassAndDay($classId, $day);
                
                // Return JSON response
                header('Content-Type: application/json');
                echo json_encode($timetable);
                exit;
            } else {
                // Return empty array if no selection
                header('Content-Type: application/json');
                echo json_encode([]);
                exit;
            }
        }
    }

    public function teacherTimetable() {
        // For regular page load
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Get unique teachers from timetables table
            $teachersQuery = "SELECT DISTINCT t.teacher_id AS teacherId, 
                            CONCAT(t.firstName, ' ', t.lastName) AS teacherName 
                            FROM teachers t 
                            JOIN timetables tm ON t.teacher_id = tm.teacherRegNo 
                            LIMIT 50";
            $teachers = $this->timetableModel->query($teachersQuery);
            $data = [
                'teachers' => $teachers,
                'timetable' => [],
                'selectedTeacherName' => '',
                'selectedDay' => '',
            ];
            $this->view('inc/timetables/teacherTimetable', $data);
        } 
        // For AJAX requests
        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if this is an AJAX request
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
                      
            // Get JSON input data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            
            $teacherId = !empty($data['teacherId']) ? $data['teacherId'] : null;
            $day = !empty($data['day']) ? $data['day'] : null;
            
            if ($teacherId && $day) {
                $timetable = $this->timetableModel->getTimetableByTeacherAndDay($teacherId, $day);
                
                // Return JSON response
                header('Content-Type: application/json');
                echo json_encode($timetable);
                exit;
            } else {
                // Return empty array if no selection
                header('Content-Type: application/json');
                echo json_encode([]);
                exit;
            }
        }
    }

    public function uploadTimetable() {
        checkRole('vice-principal');
        $data = [
            'academicYears' => $this->classModel->getAcademicYears()
        ];
        $this->view('inc/timetables/uploadTimetable', $data);
    }

    public function uploadTimetableProcess() {
        checkRole('vice-principal');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['timetable_csv'])) {
            $data = ['message' => 'Invalid request.'];
            $this->view('inc/admin/uploadTimetableResult', $data);
            return;
        }

        $file = $_FILES['timetable_csv'];
        $academicYear = $_POST['academic_year'] ?? date('Y') . '-' . (date('Y') + 1);
        
        $data = [
            'academic_year' => trim($_POST['academic_year']),
            'successCount' => 0,
            'errors' => [],
            'message' => ''
        ];
        if (!$this->timetableModel->validateUploadTimetable($_POST, $file)) {
            $data['errors'] = $this->timetableModel->errors;
        }

        if (empty($data['errors'])) {
        // Validate file
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $data['message'] = 'File upload failed: Error code ' . $file['error'];
                $this->view('inc/admin/uploadTimetableResult', $data);
                return;
            }
            
            if ($file['type'] !== 'text/csv' && pathinfo($file['name'], PATHINFO_EXTENSION) !== 'csv') {
                $data['message'] = 'Only CSV files are allowed.';
                $this->view('inc/admin/uploadTimetableResult', $data);
                return;
            }

            $handle = fopen($file['tmp_name'], 'r');
            if ($handle === false) {
                $data['message'] = 'Failed to open CSV file.';
                $this->view('inc/admin/uploadTimetableResult', $data);
                return;
            }

            fgetcsv($handle); // Skip header
            $successCount = 0;
            $errors = [];
            $rowNumber = 2; // Start from row 2 (after header)

            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) < 6) {
                    $errors[] = "Row $rowNumber: Invalid row format. Expected 6 columns.";
                    $rowNumber++;
                    continue;
                }

                $className = trim($row[0]);
                $subjectName = trim($row[1]);
                $teacherFullName = trim($row[2]);
                $periodId = (int)trim($row[3]);
                $day = trim($row[4]);
                $roomNumber = trim($row[5]);

                // Get classId
                $classId = $this->classModel->getClassIdByNameAndYear($className, $academicYear);
                if (!$classId) {
                    $errors[] = "Row $rowNumber: Class '$className' not found for academic year $academicYear";
                    $rowNumber++;
                    continue;
                }

                // Get subjectId
                $subjectId = $this->SubjectModel->getSubjectIdByName($subjectName);
                if (!$subjectId) {
                    $errors[] = "Row $rowNumber: Subject '$subjectName' not found";
                    $rowNumber++;
                    continue;
                }

                // Get teacherRegNo
                $teacherRegNo = $this->TeacherModel->getTeacherRegNoByFullName($teacherFullName);
                if (!$teacherRegNo) {
                    $errors[] = "Row $rowNumber: Teacher '$teacherFullName' not found";
                    $rowNumber++;
                    continue;
                }

                // Check teacher-subject assignment
                if (!$this->TeacherModel->isTeacherAssignedToSubject($teacherRegNo, $subjectId)) {
                    $errors[] = "Row $rowNumber: Teacher '$teacherFullName' is not assigned to teach '$subjectName'";
                    $rowNumber++;
                    continue;
                }

                // Check for conflicts
                if ($this->timetableModel->checkClassScheduleConflict($classId, $periodId, $day)) {
                    $errors[] = "Row $rowNumber: Class '$className' already has a subject scheduled for period $periodId on $day";
                    $rowNumber++;
                    continue;
                }

                if ($this->timetableModel->checkTeacherScheduleConflict($teacherRegNo, $periodId, $day)) {
                    $errors[] = "Row $rowNumber: Teacher '$teacherFullName' already has a class scheduled for period $periodId on $day";
                    $rowNumber++;
                    continue;
                }

                // Insert into timetable
                $timetableData = [
                    'classId' => $classId,
                    'subjectId' => $subjectId,
                    'teacherRegNo' => $teacherRegNo,
                    'periodId' => $periodId,
                    'day' => $day,
                    'roomNumber' => $roomNumber
                ];

                if ($this->timetableModel->insert($timetableData)) {
                    $successCount++;
                } else {
                    $errors[] = "Row $rowNumber: Failed to insert timetable entry";
                }

                $rowNumber++;
            }

            fclose($handle);

            $data['successCount'] = $successCount;
            $data['errors'] = $errors;
            
            if ($successCount === 0 && empty($errors)) {
                $data['message'] = 'No valid data found in the CSV.';
            }

            $this->view('inc/timetables/uploadTimetableResult', $data);
        } else {
        $data['academicYears'] = $this->classModel->getAcademicYears();
        
        $this->view('inc/timetables/uploadTimetable', $data);
        }
    }

    // Download timetable template in directory.
    public function downloadTemplate() {
        $file = dirname(APPROOT) . '/public/templates/timetable_template.csv';
        
        if (file_exists($file)) {
            // Set appropriate headers
            header('Content-Description: File Transfer');
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="timetable_template.csv"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            
            // Clean output buffer
            ob_clean();
            flush();
            
            // Read file and output it
            readfile($file);
            exit;
        } else {
            // File not found handling
            die('File not found.');
        }
    }
}
?>