<?php

class ParentStudent extends controller{
    private $parentStudentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->parentStudentModel = new ParentStudentModel();
    }

    public function details() {
     

    //   if (!isset($_SESSION['user']) || !isset($_SESSION['user']->regNo)) {
    //     header('Location: ' . URLROOT . '/login');
    //     exit();
    // }

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
        header("Location: " . URLROOT . "/login");
        exit();
    }


    $parentRegNo = $_SESSION['user']['regNo'] ?? null;

    // Fetch associated students
    $students = $this->parentStudentModel->getStudentsByParentRegNo($parentRegNo);
    
        $this->view('inc/Parent/details_parent', ['students' => $students]);
    }
    

    // public function submit() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = [
    //             'full_name' => trim($_POST['fullName']),
    //             'student_id' => trim($_POST['studentId']),
    //             'DOB' => trim($_POST['dob']),
    //             'Admission_date' => trim($_POST['admissionDate']),
    //             'Reason' => trim($_POST['reason'])
    //         ];

    //         try {
    //             $validationErrors = $this->parentStudentModel->validate($data);

    //             if (!empty($validationErrors)) {
    //                 throw new Exception(implode(', ', $validationErrors));
    //             }

    //             $insertResult = $this->parentStudentModel->insert($data);
    //             if ($insertResult) {
    //                 header("Location: " . URLROOT . "/Student/parentStudent");
    //                 exit();
    //             } else {
    //                 throw new Exception("Failed to insert data.");
    //             }
    //         } catch (Exception $e) {
    //             error_log($e->getMessage());
    //             $data['errors'] = [$e->getMessage()];
    //             $this->view('inc/student/parentStudent', $data);
    //             exit();
    //         }
    //     }
    // }
}