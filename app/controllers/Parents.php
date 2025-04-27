<?php
class Parents extends Controller {


    private $FeedbackModel;
    private $AbsenceModel;
    private $studentModel;
    

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Load the FeedbackModel
        $this->FeedbackModel = $this->model('FeedbackModel');
        $this->AbsenceModel = $this->model('AbsenceModel');
        $this->studentModel = $this->model('StudentModel');
    }

    // Default method for this controller
    public function index() {
        $this->view('inc/Parent/default');
    }

    // Display all feedback
    public function feedback() {
        try {
            // Fetch all feedbacks from the database
            $feedbacks = $this->FeedbackModel->findAll();

            // Pass the feedbacks to the view
            $data = [
                'feedbacks' => $feedbacks
            ];
            $this->view('inc/Parent/feedbacks', $data);
        } catch (Exception $e) {
            echo "Error fetching feedback: " . $e->getMessage();
        }
    }

    // Display parent details
    // public function details() {
    //     $this->view('inc/Parent/details_parent');
    // }

    // Display academic details
    // public function academic_details() {
    //     $this->view('inc/Parent/aca_parent');
    // }

    // Display payment details
    public function pay_details() {
        $this->view('inc/Parent/parent_pay');
    }

    // Display charges form
    public function charges_form() {
        $this->view('inc/Parent/parent_charges');
    }

    public function absences(){
        $this->view('inc/Parent/Absence_Report');
    }

    public function report(){
        $this->view('inc/Parent/Parent_Report');
    }

    // public function attendance() {
    //     $this->view('inc/Parent/attendance_parent');
    // }

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

    // public function timeTable() {
    //     // Sample timetable data (you can retrieve this from a database in real use cases)
    //     $data = [
    //         'timeTable' => [
    //             ['time' => '08:30 - 09:30', 'monday' => 'Period 1', 'tuesday' => 'Period 1', 'wednesday' => 'Period 1', 'thursday' => 'Period 1', 'friday' => 'Period 1'],
    //             ['time' => '09:30 - 10:30', 'monday' => 'Period 2', 'tuesday' => 'Period 2', 'wednesday' => 'Period 2', 'thursday' => 'Period 2', 'friday' => 'Period 2'],
    //             ['time' => '10:30 - 11:00', 'monday' => 'Lunch 1', 'tuesday' => 'Lunch 1', 'wednesday' => 'Lunch 1', 'thursday' => 'Lunch 1', 'friday' => 'Lunch 1'],
    //             ['time' => '11:00 - 12:00', 'monday' => 'Period 3', 'tuesday' => 'Period 3', 'wednesday' => 'Period 3', 'thursday' => 'Period 3', 'friday' => 'Period 3'],
    //             ['time' => '12:00 - 1:00', 'monday' => 'Period 4', 'tuesday' => 'Period 4', 'wednesday' => 'Period 4', 'thursday' => 'Period 4', 'friday' => 'Period 4'],
    //             ['time' => '1:00 - 1:30', 'monday' => 'Lunch 2', 'tuesday' => 'Lunch 2', 'wednesday' => 'CONNECT', 'thursday' => 'Lunch 2', 'friday' => 'Lunch 2'],
    //             ['time' => '1:30 - 2:30', 'monday' => 'Period 5', 'tuesday' => 'Period 5', 'wednesday' => 'CONNECT', 'thursday' => 'Period 5', 'friday' => 'Period 5']
    //         ]
    //     ];

    //     // Load the view and pass the timetable data
    //     $this->view('inc/student/time_table', $data);
    // }


    public function submitFeedback() {

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $recipient = trim($_POST['recipient'] ?? '');
            $date = date('Y-m-d');
            $parentRegNo = $_SESSION['user']['regNo'];

            if (!empty($content)) {
                $data = [
                    'content' => $content,
                    'recipient' => $recipient,
                    'date' => $date,
                    'parentRegNo' => $parentRegNo,
                
                ];
                try {
                    if ($this->FeedbackModel->insert($data)) {
                        header('Location: ' . URLROOT . '/parents/feedback');
                        exit;
                    } else {
                        echo "Failed to submit feedback.";
                    }
                } catch (Exception $e) {
                    echo "Error submitting feedback: " . $e->getMessage();
                }
            } else {
                echo "Feedback content cannot be empty.";
            }
        }
    }

    
      
    public function updateFeedback($id) {
        $feedbackModel = new FeedbackModel();
    
        // Check if the request is POST and contains feedback content
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true); // Get the POST data (JSON format)
            
            if (isset($data['content']) && !empty($data['content'])) {
                $content = htmlspecialchars($data['content']);
                
                // Prepare data for update
                $updateData = [
                    'content' => $content,
                    'date' => date('Y-m-d') // You can update the date if needed, or keep it static
                ];
    

                    // Update the feedback in the database
                    $updateSuccess = $feedbackModel->update($id, $updateData, 'feedback_id');

                    header("location: URLROOT . 'parents/viewFeedbacks'");
                    
                    
    
            }
        }
    }

   
    

    
    

    
    
             
    

    // Delete feedback
    public function deleteFeedback($id) {
        try {
            // Use feedback_id as the identifier column
            $this->FeedbackModel->delete($id, 'feedback_id');

            // Redirect after successful deletion
            header('Location: ' . URLROOT . '/parents/viewFeedbacks');
            exit;
        } catch (Exception $e) {
            echo "Error deleting feedback: " . $e->getMessage();
        }
    }

   
    

//     public function viewFeedbacks() {
//         if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
//             header("Location: " . URLROOT . "/login");
//             exit();
//         }
// -
//         // Get feedbacks from the database
//         $feedbacks = $this->FeedbackModel->findAll();
        
//         // Pass feedbacks to the view
//         $data = [
//             'feedbacks' => $feedbacks
//         ];
    
//         $this->view('inc/Parent/viewFeedback_parent', $data);
//     }

    public function viewFeedbacks() {
        // Ensure user is logged in and is a parent
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        // Get parentRegNo from session
        $parentRegNo = $_SESSION['user']['regNo'];
    
        // Load model and fetch only the parent's feedbacks
        $feedbacks = $this->FeedbackModel->findByParentId($parentRegNo);
    
        // Load view with data
        $this->view('inc/Parent/viewFeedback_parent', ['feedbacks' => $feedbacks]);
    }
    

    

    public function deleteFeedback_Principal($id) {
        try {
            // Use feedback_id as the identifier column
            $this->FeedbackModel->delete($id, 'feedback_id');

            // Redirect after successful deletion
            header('Location: ' . URLROOT . '/principal/viewFeedbacks');
            exit;
        } catch (Exception $e) {
            echo "Error deleting feedback: " . $e->getMessage();
        }

    }


    public function submitAbsence() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student_id = trim($_POST['student_id'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $date = date('Y-m-d');
            $parentRegNo = $_SESSION['user']['regNo'];
            $students = $this->AbsenceModel->getAbsenceByParentRegNo($parentRegNo);
            $allowedStudentIds = array_map(fn($s) => $s->student_id, $students);

            // Check if the student_id is vali
            if (in_array($student_id, $allowedStudentIds)) {
            if (!empty($content)) {
                $data = [
                    'student_id' => $student_id,
                    'content' => $content,
                    'date' => $date,
                    'parentRegNo' => $parentRegNo, // Replace with actual parentRegNo from session	
                
                ];
                try {
                    if ($this->AbsenceModel->insert($data)) {
                        header('Location: ' . URLROOT . '/parents/absences');
                        exit;
                    } else {
                        echo "Failed to submit the Absence the absence report.";
                    }
                } catch (Exception $e) {
                    echo "Error submitting report: " . $e->getMessage();
                }
            } else {
                echo "content cannot be empty.";
            }
            }else{
                echo "Invalid student ID or access denied";
            }
        }
    }

    public function viewAbsences() {
        // Ensure user is logged in and is a parent
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        // Get parentRegNo from session
        $parentRegNo = $_SESSION['user']['regNo'];
    
        // Load model and fetch only the parent's feedbacks
        $absences = $this->AbsenceModel->findByParentId($parentRegNo);
    
        // Load view with data
        $this->view('inc/Parent/viewAbsenceRecords', ['absences' => $absences]);
       



    
    
    

    
    
    

    }
    
}
