<?php
class Payment_charges extends Controller {
    private $payment_chargesModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->payment_chargesModel = new Payment_chargesModel();
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
                $data['payment_slip'] = $this->uploadFile($_FILES['paymentSlip']);
                
                // Validate input
                $validationErrors = $this->payment_chargesModel->validate($data);

                // Check for duplicate entries
                if ($this->payment_chargesModel->checkDuplicateEntry(
                    $data['student_id'], 
                    $data['year_of_payment']
                )) {
                    $validationErrors[] = "Payment for this student and year already exists.";
                }

                // Handle validation errors
                if (!empty($validationErrors)) {
                    $data['errors'] = $validationErrors;
                    $this->view('payment/facility_charges', $data);
                    exit();
                }

                // Insert data
                $insertResult = $this->payment_chargesModel->insert($data);

                if ($insertResult) {
                    header("Location: " . URLROOT . "/Student/f_s");
                    exit();
                } else {
                    throw new Exception("Failed to insert data.");
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = ["An unexpected error occurred. Please try again."];
                $this->view('payment/facility_charges', $data);
                exit();
            }
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
}
