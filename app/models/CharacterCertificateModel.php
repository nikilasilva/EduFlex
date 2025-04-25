<?php
class CharacterCertificateModel {
    use Model;

    protected $table = 'character_certificates';
    protected $allowedColumns = [
        'certificate_id',
        'full_name',
        'student_id',
        'date_of_birth',
        'guardian_name',
        'address',
        'slip'
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
        if (!empty($data['guardian_name']) && strlen($data['guardian_name']) > 255) {
            $errors[] = "Guardian Name cannot exceed 255 characters.";
        }

        // Address Validation
        if (empty($data['address'])) {
            $errors[] = "Address is required.";
        }

        // Slip Validation
        if (empty($data['slip'])) {
            $errors[] = "Slip is required.";
        }

        return $errors;
    }

    /**
     * Check for duplicate entries based on `student_id` and `date_of_birth`.
     */
    // public function checkDuplicateEntry($studentId, $dateOfBirth) {
    //     $query = "SELECT COUNT(*) as count FROM $this->table 
    //               WHERE student_id = :student_id AND date_of_birth = :date_of_birth";

    //     $params = [
    //         'student_id' => $studentId,
    //         'date_of_birth' => $dateOfBirth
    //     ];

    //     $result = $this->query($query, $params);
    //     return $result[0]->count > 0;
    // }

    
}
