<?php
class Feedback extends Controller {

    public function __construct() {
        // Ensure only principal has access
        // // authentication system
        // if (!isLoggedIn() || $_SESSION['role'] != 'principal') {
        //     redirect('login')
        // }

        // // Load the feedback model
        // $this->feedback = $this->model('Feedback');
    }

    // Method to display the feedback page for principal
    public function index() {
        //// Fetch feedback data from the model
        // $feedbacks = $this->feedbackModel->getFeedbacks();

        // $this->view('principal/feedback', ['feedbacks' => $feedbacks]);
        $this->view('feedbacks');
    }
}
?>