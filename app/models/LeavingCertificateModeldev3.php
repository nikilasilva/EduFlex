<?php

class LeavingCertificateModeldev3
{
    use Model;

    protected $table = 'leaving_certificates';
    protected $allowedColumns = [
        'certificate_id',
        'full_name',
        'student_id',
        'DOB',
        'Admission_date',
        'Reason',
        'status'
    ];
    protected $order_column = 'status';

    



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
        if (empty($data['DOB'])) {
            $errors[] = "Date of Birth is required.";
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['DOB'])) {
            $errors[] = "Date of Birth must be in YYYY-MM-DD format.";
        }

        
        


        return $errors;
    }
}