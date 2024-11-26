<?php
class Teacher extends Controller
{
    public function __construct() {}

    // View all teachers.
    public function teachers()
    {
        $this->view('all_teachers');
    }



    //----------------------------------

    // Display the daily activities form
    public function dailyActivities()
    {

        $this->view('inc/teacher/daily_activities');
    }

    // Handle the submission of daily activities
    public function submitActivities()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityData = [
                'date' => $_POST['date'],
                'period' => $_POST['period'],
                'subject' => $_POST['subject'],
                'class' => $_POST['class'],
                'description' => $_POST['description'],
                'additional_note' => $_POST['additional_note']

            ];

            $activity = new Current_activityModel();
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

    public function viewActivities()
    {
        $activityModel = new Current_activityModel();
        $activities = $activityModel->findAll();

        $this->view('inc/teacher/view_activities', ['activities' => $activities]);
    }


    public function editActivity($id)
    {
        $activityModel = new Current_activityModel();

        // If the request is POST, update the activity
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'date' => $_POST['date'],
                'period' => $_POST['period'],
                'subject' => $_POST['subject'],
                'class' => $_POST['class'],
                'description' => $_POST['description'],
                'additional_note' => $_POST['additional_note']
            ];

            $activityModel->update($id, $data, 'activity_id');

            // Redirect to the view activities page
            header("Location: " . URLROOT . "/teacher/viewActivities");
            exit();
        } else {
            // Get the activity details
            $activity = $activityModel->first(['activity_id' => $id]);

            if ($activity) {
                $this->view('inc/teacher/edit_activity', ['activity' => $activity]);
            } else {
                die('Activity not found.');
            }
        }
    }

    public function deleteActivity($id)
    {
        $activityModel = new Current_activityModel();

        // Delete the activity
        $activityModel->delete($id, 'activity_id');

        // Redirect to the view activities page
        header("Location: " . URLROOT . "/teacher/viewActivities");
        exit();
    }
}
