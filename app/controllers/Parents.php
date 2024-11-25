<?php
class Parents extends Controller {


    private $FeedbackModel;

    public function __construct() {
        // Load the FeedbackModel
        $this->FeedbackModel = $this->model('FeedbackModel');
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
    public function details() {
        $this->view('inc/Parent/details_parent');
    }

    // Display academic details
    public function academic_details() {
        $this->view('inc/Parent/aca_parent');
    }

    // Display payment details
    public function pay_details() {
        $this->view('inc/Parent/parent_pay');
    }

    // Display charges form
    public function charges_form() {
        $this->view('inc/Parent/parent_charges');
    }

    public function attendance() {
        $this->view('inc/Parent/attendance_parent');
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
        $this->view('inc/student/time_table', $data);
    }






    // Handle feedback submission
    public function submitFeedback() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = htmlspecialchars($_POST['content'] ?? '');
            $date = date('Y-m-d');

            if (!empty($content)) {
                $data = [
                    'content' => $content,
                    'date' => $date
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

    // public function submitFeedback(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $activityData = [
                
    //             'content' => $_POST['content']
                
                

    //         ];

    //         $activity = new FeedbackModel();
    //         $activity->insert($activityData);
    //         // Here, save the activity data to the database.
    //         // Example: $this->activityModel->addActivity($activityData);

    //         // Display a success message or redirect to a success page
    //         echo "Activity recorded successfully: " . htmlspecialchars($activityData['content']);
    //     } else {
    //         // If not a POST request, reload the daily activities page
    //         $this->view('feedbacks');
    //     }
    // }

    // Update feedback
    
    // public function updateFeedback($id) {
    //     $FeedbackModel = new FeedbackModel();
    
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
    //             $data = [
    //                 'content' => $_POST['content'],
    //                 'date' => $_POST['date']
    //             ];
    //             echo "hiiii";
    //             if ($this->FeedbackModel->update($id, $data, 'feedback_id')) {
    //                 //header("Location: " . URLROOT . "/parents/feedback");
    //                 echo 'hooo';
    //             }
    //             exit();
                
    //         }

    //     }

    
      
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

                    header("location: URLROOT . 'parents/feedback'");
                    
                    
    
            }
        }
    }
    

    
    
             
    

    // Delete feedback
    public function deleteFeedback($id) {
        try {
            // Use feedback_id as the identifier column
            $this->FeedbackModel->delete($id, 'feedback_id');

            // Redirect after successful deletion
            header('Location: ' . URLROOT . '/parents/feedback');
            exit;
        } catch (Exception $e) {
            echo "Error deleting feedback: " . $e->getMessage();
        }
    }



    public function toggleReadStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the status from the checkbox (1 if checked, 0 if unchecked)
            $isRead = isset($_POST['is_read']) ? 1 : 0;
            
            // Prepare the data for updating
            $updateData = [
                'is_read' => $isRead
            ];
            
            // Update the feedback status in the database
            $updateSuccess = $this->FeedbackModel->update($id, $updateData, 'feedback_id');
            
            if ($updateSuccess) {
                // Redirect back to the feedbacks page after successful update
                header('Location: ' . URLROOT . '/parents/feedback');
                exit;
            } else {
                echo "Error updating feedback status.";
            }
        }
    }
    
}
