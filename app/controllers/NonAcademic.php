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



    // public function Issuance_books()
    // {


    //     $this->view('/inc/nonAcademic/Issuance_of_books');
    // }


    // public function Issuance_books_searched()
    // {

    //     // if (isset($_POST['search_student_id'])) {
    //     //     $search = $conn->real_escape_string($_GET['search_student_id']);
    //     //     $searchmodel=new issuance_of_booksModel;
    //     //     $result=$searchmodel->search("student_id",search_student_id)

    //     // }

    //     $this->view('/inc/nonAcademic/Issuance_of_books');
    // }

    // public function submitActivities()
    // {


    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $activityData = [
    //             'student_id' => $_POST['student_id'],
    //             'book_id' => $_POST['book_id'],
    //             'full_name' => $_POST['full_name'],
    //             'book_name' => $_POST['book_name'],
    //             'issue_date' => $_POST['issue_date'],

    //         ];

    //         $activity = new issuance_of_booksModel();
    //         $activity->insert($activityData);
    //         // Here, save the activity data to the database.
    //         // Example: $this->activityModel->addActivity($activityData);

    //         // Display a success message or redirect to a success page
    //         echo "Activity recorded successfully: " . htmlspecialchars($activityData['full_name']);
    //     } else {
    //         // If not a POST request, reload the daily activities page
    //         $this->view('Issuance_books');
    //     }
    // }


    // public function viewActivities()
    // {
    //     $activityModel = new issuance_of_booksModel();
    //     $activities = $activityModel->findAll();

    //     $this->view('inc/nonAcademic/See_library_activity', ['activities' => $activities]);
    // }





    // public function editActivity($id)
    // {
    //     $activityModel = new issuance_of_booksModel();

    //     // If the request is POST, update the activity
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $data = [
    //             'book_id' => $_POST['book_id'],
    //             'full_name' => $_POST['full_name'],
    //             'book_name' => $_POST['book_name'],
    //             'issue_date' => $_POST['issue_date']
    //         ];

    //         $activityModel->update($id, $data, 'student_id');

    //         // Redirect to the view activities page
    //         header("Location: " . URLROOT . "/NonAcademic/viewActivities");
    //         exit();
    //     } else {
    //         // Get the activity details
    //         $activity = $activityModel->first(['student_id' => $id]);

    //         if ($activity) {
    //             $this->view('inc/NonAcademic/edit_Issuance_of_books', ['activity' => $activity]);
    //         } else {
    //             die('Activity not found.');
    //         }
    //     }
    // }

    // public function deleteActivity($id)
    // {
    //     $activityModel = new issuance_of_booksModel();

    //     // Delete the activity
    //     $activityModel->delete($id, 'student_id');

    //     // Redirect to the view activities page
    //     header("Location: " . URLROOT . "/NonAcademic/viewActivities");
    //     exit();
    // }

    // Start Teachers Attendencee Funtions

    public function TeachersAttendenceeForm()
    {
        $teacherModel = new TeacherModeldev3(); // Make sure this model exists
        $teachers = $teacherModel->findAll();

        $this->view('inc/nonAcademic/record_teachers_attendance', ['teachers' => $teachers]);
    }



    public function SubmitTeachersAttendanceForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $attendanceModel = new TeacherAttendanceModel();

            $teacherIds = $_POST['teacher_ids'];
            $attendance = $_POST['attendance'];
            $currentDate = date('Y-m-d');

            $errors = [];

            foreach ($teacherIds as $teacherId) {
                if (isset($attendance[$teacherId])) {
                    //  Check if attendance for this teacher on this date already exists
                    $existing = $attendanceModel->where([
                        'teacher_id' => $teacherId,
                        'attendance_date' => $currentDate
                    ]);

                    if ($existing) {
                        $errors[] = "Attendance already marked for Teacher ID $teacherId.";
                        continue;
                    }

                    //  Otherwise, insert attendance
                    $status = $attendance[$teacherId];

                    $attendanceModel->insert([
                        'teacher_id' => $teacherId,
                        'status' => $status,
                        'attendance_date' => $currentDate
                    ]);
                }
            }


            //  Pass error messages to the view (to show in a popup)
            if (!empty($errors)) {
                $_SESSION['attendance_errors'] = $errors;
            } else {
                $_SESSION['success_message'] = "Attendance submitted successfully!";
            }
        }
    }


    public function ViewTeachersAttendance()
    {
        $attendanceModel = new TeacherAttendanceModel();
        $records = $attendanceModel->findAll();
        $teacherModel = new TeacherModeldev3();

        $teachersList = $teacherModel->findAll();

        // Re-index teachers by teacher_id
        $teachers = [];
        foreach ($teachersList as $teacher) {
            $teachers[$teacher->teacher_id] = $teacher;
        }

        $this->view('inc/nonAcademic/view_teachers_attendance', [
            'attendance' => $records,
            'teachers' => $teachers
        ]);
    }

    // END All Teachers Attendencee Funtions





    //start verify service charges

    



    //-------------
    public function verify_service_charges()
    {
        $serviceChargesModel = new Payment_chargesModel(); // Assuming you have this model to load students
        $serviceCharge = $serviceChargesModel->findAll();

    

        $this->view('inc/nonAcademic/verify_service_charges', ['serviceCharges' => $serviceCharge]);

    }
}
?>