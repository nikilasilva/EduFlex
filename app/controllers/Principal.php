<?php
class Principal extends Controller {
    private $FeedbackModel;
     
    public function __construct() {
        $this->FeedbackModel = $this->model('FeedbackModel');
         
        if (!$this->FeedbackModel) {
            die("Error: FeedbackModel could not be loaded.");
        }
    }

    
    
     
    public function viewFeedbacks() {
        // Fetch all feedbacks from the database
         //$feedbacks = $this->FeedbackModel->findAll();
        $feedbacks = $this->FeedbackModel->where(['recipient' => 'principal']);
         
        if ($feedbacks === false) {
            $feedbacks = []; // Fallback to an empty array if no feedbacks are found
        }
         
        $data = [
            'feedbacks' => $feedbacks,
        ];
         
        $this->view('inc/principal/viewFeedbacks', $data);
    }

    // NEW METHOD: Mark Feedback as Read
    public function markFeedbackAsRead() {
        // Check if the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the feedback ID from the form submission
            $feedback_id = $_POST['feedback_id'] ?? null;
            
            // Determine the read status (toggle)
            $is_read = isset($_POST['is_read']) ? 1 : 0;
             
            // Validate feedback ID
            if ($feedback_id) {
                // Update the feedback's read status
                $result = $this->FeedbackModel->update($feedback_id, [
                    'is_read' => $is_read
                ], 'feedback_id');
                 
                // Redirect back to the view feedbacks page
                header('Location: ' . URLROOT . '/Principal/viewFeedbacks');
                exit();
            }
        }
        
        // If something goes wrong, redirect to the feedbacks page
        header('Location: ' . URLROOT . '/Principal/viewFeedbacks');
        exit();
    }

    public function msi() {
        $this->view('inc/principal/msi');
    }



       

}
?>