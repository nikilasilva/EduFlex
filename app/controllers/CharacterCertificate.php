<?php
class CharacterCertificate extends Controller {
    private $characterCertificateModel;


    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        $this->characterCertificateModel = new CharacterCertificateModel();
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'certificate_id' => $this->generateUniqueCertificateId(),
                'full_name' => trim($_POST['fullName']),
                'student_id' => trim($_POST['studentId']),
                'date_of_birth' => trim($_POST['dob']),
                'guardian_name' => trim($_POST['guardianName']),
                'address' => trim($_POST['address']),
                'slip' => ''
            ];

            try {
                $data['slip'] = $this->uploadFile($_FILES['slip']);
                $validationErrors = $this->characterCertificateModel->validate($data);

                if (!empty($validationErrors)) {
                    throw new Exception(implode(', ', $validationErrors));
                }

                $insertResult = $this->characterCertificateModel->insert($data);
                if ($insertResult) {
                    header("Location: " . URLROOT . "/Student/character");
                    exit();
                } else {
                    throw new Exception("Failed to insert data.");
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = [$e->getMessage()];
                $this->view('character_certificate/request_form', $data);
                exit();
                
            }
        }
    }

    private function generateUniqueCertificateId() {
        return abs(crc32(uniqid('', true)));
    }

    private function uploadFile($file) {
        $uploadDir = __DIR__ . '/../../uploads/';
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception("Failed to create upload directory.");
            }
        }

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

        $filename = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $filename;
        } else {
            throw new Exception("File upload failed.");
        }
    }

   
}
