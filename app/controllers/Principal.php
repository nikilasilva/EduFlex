<?php

class Principal extends Controller {
    private $FeedbackModel;

    public function __construct() {
        // Initialize the FeedbackModel
        $this->FeedbackModel = $this->model('FeedbackModel');

        // Ensure the model is loaded correctly
        if (!$this->FeedbackModel) {
            die("Error: FeedbackModel could not be loaded.");
        }
    }

    /**
     * Load the view for viewing feedbacks.
     */
    public function viewFeedbacks() {
        // Fetch all feedbacks from the database
        $feedbacks = $this->FeedbackModel->findAll();

        // Check if feedbacks were retrieved successfully
        if ($feedbacks === false) {
            $feedbacks = []; // Fallback to an empty array if no feedbacks are found
        }

        // Pass feedbacks to the view
        $data = [
            'feedbacks' => $feedbacks,
        ];

        $this->view('inc/principal/viewFeedbacks', $data);
    }
}
?>