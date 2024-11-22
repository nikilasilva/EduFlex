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

        public function Issuance_books_submit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityData = [
                'Student_full_name' => $_POST['Student_full_name'],                   
                'Student_ID' => $_POST['Student_ID'],
                'Name_Of_Book' => $_POST['Name_Of_Book'],
                'Book_ID' => $_POST['Book_ID'],
                'date' => $_POST['date'],
                
            ];

            $activity = new Current_Issuance_books();
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