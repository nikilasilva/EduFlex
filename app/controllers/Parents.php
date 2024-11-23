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
}
