<?php

class LeavingCertificate extends Controller {
    private $leavingCertificateModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->leavingCertificateModel = new LeavingCertificateModel();
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'certificate_id' => $this->generateUniqueCertificateId(),
                'full_name' => trim($_POST['fullName']),
                'student_id' => trim($_POST['studentId']),
                'DOB' => trim($_POST['dob']),
                'Admission_date' => trim($_POST['admissionDate']),
                'Reason' => trim($_POST['reason'])
            ];

            try {
                $validationErrors = $this->leavingCertificateModel->validate($data);

                if (!empty($validationErrors)) {
                    throw new Exception(implode(', ', $validationErrors));
                }

                $insertResult = $this->leavingCertificateModel->insert($data);
                if ($insertResult) {
                    header("Location: " . URLROOT . "/Student/leaving");
                    exit();
                } else {
                    throw new Exception("Failed to insert data.");
                }
            } catch (Exception $e) {
                error_log($e->getMessage());
                $data['errors'] = [$e->getMessage()];
                $this->view('inc/student/leaving', $data);
                exit();
            }
        }
    }

    private function generateUniqueCertificateId() {
        return abs(crc32(uniqid('', true)));
    }
}
