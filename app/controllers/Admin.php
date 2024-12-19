<?php

class Admin extends Controller
{
    //private $TeacherModel;
    public function __construct() {}
        // Load necessary models (if required)
       // $this->teacherModel = $this->model('TeacherModel');
    

//to practice



    public function Issuance_books()
    {


        $this->view('/inc/admin/Issuance_of_books');
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
            header("Location: " . URLROOT . "/Admin/viewActivities");
            exit();
        } else {
            // If not a POST request, reload the daily activities page
            $this->view('Issuance_books');
        }
    }


    public function viewActivities()
    {
        $activityModel = new issuance_of_booksModel();
        $activities = $activityModel->findAll();

        $this->view('inc/Admin/See_library_activity', ['activities' => $activities]);
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




    // Manage students
    public function managestudent(){
        $this->view('inc/admin/maneage_student');
    }
    // Insert Student details
    public function insertstudent(){
        $this->view('inc/admin/add_student_by_admin');
    }

    /* For Parent */
    // Manage parents
    public function manageparent(){
        $this->view('inc/admin/manage_parent');
    }
    




    // Manage Teacher details
    public function Manage_teacher(){
        
        $this->view('inc/admin/manage_teacher');
    }




















    /* For Principal */
    // Manage principal
    public function manageprincipal(){
        $this->view('inc/admin/manage_principal_by_admin');
    }
    // Insert principal details
    public function insertprincipal(){
        $this->view('inc/admin/add_principal_by_admin');
    }

    /* For Vice Principal */
    // Manage vice principal
    public function manageviceprincipal(){
        $this->view('inc/admin/manage_viceprincipal_by_admin');
    }
    // Insert vice principal details
    public function insert_vice_principal(){
        $this->view('inc/admin/add_viceprincipal_by_admin');
    }

    /* For Non-academic */
    // Manage non-academic staff
    public function manage_nonaca(){
        $this->view('inc/admin/manage_nonaca_by_admin');
    }
    // Insert non-academic details
    public function insert_nonaca(){
        $this->view('inc/admin/add_nonaca_by_admin');
    }

    /* For MIS */
    // Manage MIS
    public function manage_MIS(){
        $this->view('inc/admin/manage_MIS_by_admin');
    }
    // Insert MIS details
    public function insert_MIS(){
        $this->view('inc/admin/add_MIS_by_admin');
    }

    /* For Classroom */
    // Manage classroom
    public function manage_classroom(){
        $this->view('inc/admin/manage_classroom_by_admin');
    }
    // Insert classroom details
    public function insert_class_room(){
        $this->view('inc/admin/add_class_by_admin');
    }

    /* For Timetable */
    // Manage timetable
    public function manage_class_timetable(){
        $this->view('inc/admin/manage_timetable_by_admin');
    }
    // Insert class timetable
    public function insert_aca_time_table(){
        $this->view('inc/admin/add_aca_ttable_by_admin');
    }
    
}
