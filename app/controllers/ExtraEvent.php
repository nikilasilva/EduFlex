
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
        $this->view('inc/extra-events/createEvent');
    }

    // --------event funtino starrtt

    public function events()
    {
        $eventModel = new createEvent();
        $allEvents = $eventModel->findAll();

        $eventsByDate = [];
        $upcomingEvents = [];

        // Current date for filtering upcoming events
        $today = date('Y-m-d');

        if (!empty($allEvents)){
            foreach ($allEvents as $event) {
                $date = date('Y-m-d', strtotime($event->EventStartDateTime));

                // Append to date array
                if (!isset($eventsByDate[$date])) {
                    $eventsByDate[$date] = [];
                }
                $eventsByDate[$date][] = $event->EventName;

                // Show upcoming events (today and future)
                if ($date >= $today) {
                    $upcomingEvents[] = [
                        'date' => $date,
                        'description' => $event->EventName
                    ];
                }
            }
        }

        $data = [
            'events' => $eventsByDate,
            'upcomingEvents' => $upcomingEvents
        ];

        $this->view('inc/extra-events/scheduled_events', $data);
    }


    // create Event 
    public function CreateEvent()
    {
        $this->view('inc/extra-events/createEvent');
    }

    // save the Event data to the database.
    public function SubmitCreateEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Initialize Target Audience variables
            $TargetAudience_students = false;
            $TargetAudience_teachers = false;
            $TargetAudience_parents = false;
            $TargetAudience_Academic = false;

            // Check each checkbox
            if (isset($_POST['TargetAudience_students'])) {
                $TargetAudience_students = true;
            }
            if (isset($_POST['TargetAudience_teachers'])) {
                $TargetAudience_teachers = true;
            }
            if (isset($_POST['TargetAudience_parents'])) {
                $TargetAudience_parents = true;
            }
            if (isset($_POST['TargetAudience_Academic'])) {
                $TargetAudience_Academic = true;
            }

            // Prepare event data
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
            header('Location: ' . URLROOT . '/ExtraEvent/events');
            // echo "<script>alert('Event has been created: " . htmlspecialchars($activityData['EventName']) . "');</script>";
            // echo "Activity recorded successfully: " . htmlspecialchars($activityData['full_name']);
        } else {
            // If not a POST request, redirect or show form again
        }

        
    }
}