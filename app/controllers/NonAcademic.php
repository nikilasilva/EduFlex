<?php
    class NonAcademic extends Controller {
        public function __construct() {
        }

        // // View all NonAcademics.
        // public function nonAcademics() {
        //     $this->view('all_teachers');
        // }


        public function Issuance_books() {
            $this->view('/inc/nonAcademic/Issuance_of_books');
        }

        public function submitActivities() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityData = [
                'student_id' => $_POST['student_id'],                   
                'book_id' => $_POST['book_id'],
                'full_name' => $_POST['full_name'],
                'book_name' => $_POST['book_name'],
                'issue_date' => $_POST['issue_date'],
                
            ];
        
            $activity = new test();
            $activity->insert($activityData);
            // Here, save the activity data to the database.
            // Example: $this->activityModel->addActivity($activityData);

            // Display a success message or redirect to a success page
            echo "Activity recorded successfully: " . htmlspecialchars($activityData['description']);
        } else {
            // If not a POST request, reload the daily activities page
            $this->view('daily_activities');
        }

        }

        

        
    }
?>