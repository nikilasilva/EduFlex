<!-- // all emty -->
<?php
class NonAcademic extends Controller
{
    public function __construct() {}

    // // View all NonAcademics.
    // public function nonAcademics() {
    //     $this->view('all_teachers');
    // }
    // // View all NonAcademics.
    // public function nonAcademics() {
    //     $this->view('all_teachers');
    // }



    public function Issuance_books()
    {


        $this->view('/inc/nonAcademic/Issuance_of_books');
    }


    public function Issuance_books_searched()
    {

        // if (isset($_POST['search_student_id'])) {
        //     $search = $conn->real_escape_string($_GET['search_student_id']);
        //     $searchmodel=new issuance_of_booksModel;
        //     $result=$searchmodel->search("student_id",search_student_id)

        // }

        $this->view('/inc/nonAcademic/Issuance_of_books');
    }

    public function submitActivities()
    {

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $activityData = [
                'student_id' => $_POST['student_id'],
                'book_id' => $_POST['book_id'],
                'full_name' => $_POST['full_name'],
                'book_name' => $_POST['book_name'],
                'issue_date' => $_POST['issue_date'],

            ];

            $activity = new issuance_of_booksModel();
            $activity->insert($activityData);
            // Here, save the activity data to the database.
            // Example: $this->activityModel->addActivity($activityData);

            // Display a success message or redirect to a success page
            echo "Activity recorded successfully: " . htmlspecialchars($activityData['full_name']);
        } else {
            // If not a POST request, reload the daily activities page
            $this->view('Issuance_books');
        }
    }


    public function viewActivities()
    {
        $activityModel = new issuance_of_booksModel();
        $activities = $activityModel->findAll();

        $this->view('inc/nonAcademic/See_library_activity', ['activities' => $activities]);
    }





    public function editActivity($id)
    {
        $activityModel = new issuance_of_booksModel();

        // If the request is POST, update the activity
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'book_id' => $_POST['book_id'],
                'full_name' => $_POST['full_name'],
                'book_name' => $_POST['book_name'],
                'issue_date' => $_POST['issue_date']
            ];

            $activityModel->update($id, $data, 'student_id');

            // Redirect to the view activities page
            header("Location: " . URLROOT . "/NonAcademic/viewActivities");
            exit();
        } else {
            // Get the activity details
            $activity = $activityModel->first(['student_id' => $id]);

            if ($activity) {
                $this->view('inc/NonAcademic/edit_Issuance_of_books', ['activity' => $activity]);
            } else {
                die('Activity not found.');
            }
        }
    }

    public function deleteActivity($id)
    {
        $activityModel = new issuance_of_booksModel();

        // Delete the activity
        $activityModel->delete($id, 'student_id');

        // Redirect to the view activities page
        header("Location: " . URLROOT . "/NonAcademic/viewActivities");
        exit();
    }




















    public function TeachersAttendenceeForm()   // file this form Teachers attendence 
    {
        $recodeModel = new Teachers_RecodeModel();
        $recode = $recodeModel->findAll();


        // Load the view and pass Teachers data
        $this->view('inc/nonAcademic/record_teachers_attendencee', ['attendance' => $recode]);


        // $this->view('inc/nonAcademic/record_teachers_attendencee');
    }


    // public function SubmitTeachersAttendenceeForm()   // file this form Teachers attendence 
    // {
    //     $recodeModel = new Teachers_RecodeModel();
    //     $recode = $recodeModel->findAll();


    //     // Load the view and pass Teachers data
    //     $this->view('inc/nonAcademic/record_teachers_attendencee', ['attendance' => $recode]);


    //     // $this->view('inc/nonAcademic/record_teachers_attendencee');
    // }

    public function SubmitTeachersAttendenceeForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $attendanceData = [];

            // Assuming each row in the table corresponds to a teacher
            foreach ($_POST['attendance'] as $teacherId => $status) {
                $attendanceData[] = [
                    'teacher_id' => $teacherId,
                    'attendance' => $status // 'present' or 'absent'
                ];
            }

            // Save attendance data to the database
            $recodeModel = new Teachers_RecodeModel();

            foreach ($attendanceData as $record) {
                $recodeModel->insert($record);
            }

            // Redirect to a success page or show a success message
            header("Location: " . URLROOT . "/nonAcademic/TeachersRecode");
            exit();
        } else {
            // Reload the attendance form if not POST
            $this->view('inc/nonAcademic/record_teachers_attendencee');
        }
    }











    public function TeachersRecode()
    {
        $activityModel = new Teachers_RecodeModel();
        $activities = $activityModel->findAll();

        $this->view('inc/nonAcademic/view_teachers_attendencee', ['activities' => $activities]);
    }


    public function ReceipfBooks()
    {


        $this->view('inc/nonAcademic/receipt_of_books');
    }


    public function checkServiceCharges()
    {


        $this->view('inc/nonAcademic/check_service_charges');
    }
}
?>