<?php
class CharacterCertificateModel {
    use Model;

    protected $table = 'character_certificates';
    protected $allowedColumns = [
        'certificate_id',
        'full_name',
        'student_id',
        'date_of_birth',
        'reason',
    ];
    protected $order_column = 'certificate_id';

    /**
     * Validate input data.
     */
    public function validate($data) {
        $errors = [];

        // Full Name Validation
        if (empty($data['full_name'])) {
            $errors[] = "Full Name is required.";
        } elseif (strlen($data['full_name']) > 255) {
            $errors[] = "Full Name cannot exceed 255 characters.";
        }

        // Student ID Validation
        if (empty($data['student_id'])) {
            $errors[] = "Student ID is required.";
        }

        // Date of Birth Validation
        if (empty($data['date_of_birth'])) {
            $errors[] = "Date of Birth is required.";
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date_of_birth'])) {
            $errors[] = "Date of Birth must be in YYYY-MM-DD format.";
        }

        // Guardian Name Validation (Optional)
        

        // Address Validation
       
        // Slip Validation
        

        if (empty($data['reason'])) {
            $errors[] = "Reason  is required.";
        }

        return $errors;
    }

    
    public function findById($certificate_id) {
        $query = "SELECT * FROM character_certificates WHERE certificate_id = :id";
        return $this->query($query, ['certificate_id' => $certificate_id]);
    }

    
}
