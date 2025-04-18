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



    public function viewTeachersAttendenceeForm()
    {
        $teacherName = new dev3_Users();
        $Name = $teacherName->findAll();

        
        $this->view('inc/nonAcademic/record_teachers_attendencee', ['teachername' => $Name]);
    }
    



    // public function SubmitTeachersAttendenceeForm()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $attendanceData = $_POST['attendance']; // [teacherId => 'present'/'absent']

    //         $model = new Teachers_RecodeModel();

    //         foreach ($attendanceData as $teacherId => $status) {
    //             $model->recordAttendance($teacherId, $status);
    //         }

    //         // Redirect or load a success view
    //         redirect('nonAcademic/TeachersAttendenceeForm');
    //     } else {
    //         // If not POST, redirect back
    //         redirect('nonAcademic/TeachersAttendenceeForm');
    //     }
    // }


    public function recordAttendance($teacherId, $status)
    {
        $this->db->query("INSERT INTO TeacherAttendance (teacherId, status, date) VALUES (:teacherId, :status, CURDATE())");
        $this->db->bind(':teacherId', $teacherId);
        $this->db->bind(':status', $status);
        $this->db->execute();
    }










    


    // public function TeachersRecode()
    // {
    //     $activityModel = new Teachers_RecodeModel();
    //     $activities = $activityModel->findAll();

    //     $this->view('inc/nonAcademic/view_teachers_attendencee', ['activities' => $activities]);
    // }


    public function ReceipfBooks()
    {


        $this->view('inc/nonAcademic/receipt_of_books');
    }


    public function checkServiceCharges()
    {


        $this->view('inc/nonAcademic/verify_service_charges');
    }
}
?>