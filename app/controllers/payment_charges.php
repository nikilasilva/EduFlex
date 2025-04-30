
<?php

require_once APPROOT . '/models/StudentModel.php'; // Include StudentModel if needed

class Payment_charges extends Controller {
    private $payment_chargesModel;
    private $studentModel;
    private $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();

        }

        $this->payment_chargesModel = $this->model('Payment_chargesModel');
        $this->studentModel = $this->model('StudentModel');
        $students = $this->studentModel->getUsers();  // This will now work



    }

    public function submit() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = [
                'payment_id' => $this->generateUniquePaymentId(),
                'full_name' => trim($_POST['fullName']),
                'student_id' => trim($_POST['studentId']),
                'year_of_payment' => trim($_POST['payment']),
                'payment_slip' => ''
            ];

            try {
                // File upload
                
                // Validate input
                $validationErrors = $this->payment_chargesModel->validate($data);
            
                
                // Check for duplicate entries
                // if ($this->payment_chargesModel->checkDuplicateEntry(
                //     $data['student_id'], 
                //     $data['year_of_payment']
                //     )) {                    
                //     $validationErrors[] = "Payment for this student and year already exists.";
                // }
                    // Handle validation errors
                if (!empty($validationErrors)) {                    
                    $data['errors'] = $validationErrors;
                    $this->view('inc/student/F_S', $data);                    
                    exit();
                }
                $data['payment_slip'] = $this->uploadFile($_FILES['paymentSlip']);
                
                // Insert data
                $this->payment_chargesModel->insert($data);
               
                header("Location: " . URLROOT . "/payment_charges/submit");
                exit();
                // } else {
                //     throw new Exception("Failed to insert data.");
                // }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = ["An unexpected error occurred. Please try again."];
                $this->view('inc/student/F_S', $data);
                exit();
            }
        } else {
            // If not a POST request, redirect or show an error
            $this->view('inc/student/F_S');
            exit();
        }
    }

    private function generateUniquePaymentId() {
        return abs(crc32(uniqid('', true)));
    }

    private function uploadFile($file) {
        $uploadDir = __DIR__ . '/../../uploads/';
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception("Failed to create upload directory.");
            }
        }

        // Validate file
        if (empty($file['name'])) {
            throw new Exception("No file uploaded.");
        }

        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type. Only JPG, PNG, and PDF are allowed.");
        }

        if ($file['size'] > $maxFileSize) {
            throw new Exception("File is too large. Maximum size is 5MB.");
        }

        // Generate unique filename
        $filename = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $filename;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $filename;
        } else {
            throw new Exception("File upload failed.");
        }
    }

    public function payment() {
        if ($_SESSION['user']['role'] !== 'student') {
            header("Location: " . URLROOT . "/login");
            exit();
        }



        $regNo = $_SESSION['user']['regNo'];

        // Get student_id from StudentModel
        $student = $this->studentModel->getStudentByRegNo($regNo);

        
        if (!$student) {
            $data = [
                'payments' => [],
                'error' => "Student profile not found."
            ];
            $this->view('inc/student/pay_details', $data);
            return;
        }

        $studentId = $student->student_id;
        $payments = $this->payment_chargesModel->getPaymentsByStudentId($studentId);
        
        $data = [
            'payments' => $payments
        ];
       
    $this->view('inc/student/pay_details', $data);
    }


    public function paymentParent() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'parent') {
            header("Location: " . URLROOT . "/login");
            exit();
        }

        $payments = [];
        $error = null;
        $parentRegNo = $_SESSION['user']['regNo'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentId = trim($_POST['student_id']);

            // Get all student_ids related to the parent
            $allowedStudentIds = $this->payment_chargesModel->getPaymentsByParentRegNo($parentRegNo);

            if ($allowedStudentIds === false) {
                $error = "There was an issue fetching payment records.";
            }
    
            if (empty($studentId)) {
                $error = "Please enter a student ID.";
            } elseif (!in_array($studentId, array_column($allowedStudentIds, 'student_id'))) { // Use array_column to extract student_id values from the result
                $error = "Invalid student ID or Access Denied.";
            } else {
                // Get payments
                $payments = $this->payment_chargesModel->getPaymentsByStudentId($studentId);
    
                if (empty($payments)) {
                    $error = "No payment records found for this student.";
                }
            }
        }
    
        $this->view('inc/Parent/parent_pay', [
            'payments' => $payments,
            'studentId' => $studentId ?? '',
            'error' => $error
        ]);
    }

    // public function updatePayment($id){
    //     $payment_chargesModel = $this->model('Payment_chargesModel');
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = json_decode(file_get_contents('php://input'), true);

    //         $updateData = [
               
    //             'full_name' => trim($data['fullName']),
    //             'student_id' => trim($data['studentId']),
    //             'year_of_payment' => trim($data['payment']),
    //             'payment_slip' => ''
    //         ];

    //        $updateSucces =  $payment_chargesModel->update($id, $updateData,'payment_id');
    //        header("location: " . URLROOT . "payment_charges/submit");

    // }
   
}
