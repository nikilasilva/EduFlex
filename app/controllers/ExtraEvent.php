<!-- ask how to save 'Target Audience' -->


<?php
class ExtraEvent extends Controller
{
    private $extraEventModel;

    // public function __construct() {
    //     // Load the AnnouncementModel
    //     $this->extraEventModel = $this->model('extraEventModel');
    // }

    public function index()
    {
        // $this->view('inc/extra-events/createEvent');
    }

    public function CreateEvent()
    {
        $this->view('inc/extra-events/createEvent');
    }

    // save the Event data to the database.
    public function SubmitCreateEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            // save all Target Audience to single variable

            // $TargetAudience = NULL;
            $TargetAudience_students = false;
            $TargetAudience_students = false;
            $TargetAudience_students = false;
            $TargetAudience_students = false;


            if (isset($_POST['TargetAudience_students'])) {
                $TargetAudience_students = TRUE;
            }
            if (isset($_POST['TargetAudience_teachers'])) {
                $TargetAudience_teachers = TRUE;
            }
            if (isset($_POST['TargetAudience_parents'])) {
                $TargetAudience_parents = TRUE;
            }
            if (isset($_POST['TargetAudience_Academic'])) {
                $TargetAudience_Academic = TRUE;
            }


            $activityData = [
                'EventName' => $_POST['EventName'],
                'EventStartDateTime' => $_POST['EventStartDateTime'],
                'EventType' => $_POST['EventType'],
                'Venue' => $_POST['Venue'],
                'TargetAudienceStudents' => $TargetAudience_students,
                'TargetAudienceTeachers' => $TargetAudience_teachers,
                'TargetAudienceParents' => $TargetAudience_parents,
                'TargetAudienceNonAcademicStaff' => $TargetAudience_Academic,
                'Description' => $_POST['Description'],
                'EventCoordinators' => $_POST['EventCoordinators'],

            ];

            $activity = new createEvent();
            $activity->insert($activityData);
            // Here, save the activity data to the database.
            // Example: $this->activityModel->addActivity($activityData);

            // Display a success message or redirect to a success page

            echo "<script>alert('Event 1 has been created: " . htmlspecialchars($activityData['EventName']) . "');</script>";


            // echo "Event 1 has been created. " . htmlspecialchars($activityData['EventName']);
        } else {
            // If not a POST request, reload the daily activities page
            // $this->view('CreateEvent');
        }
    }
}
