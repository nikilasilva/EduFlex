<?php
class payment_chargesModel_verryfy
{
    use Model;

    protected $table = 'facility_charges';
    protected $allowedColumns = [
        'payment_id',
        'full_name',
        'student_id',
        'year_of_payment',
        'payment_slip',
        'status'
    ];
    protected $order_column = 'payment_id';

    public function validate($data)
    {
        $errors = [];

        // Full Name Validation
        if (empty($data['full_name'])) {
            $errors[] = "Full Name is required";
        }

        // Student ID Validation
        if (empty($data['student_id'])) {
            $errors[] = "Student ID is required";
        }

        // Year of Payment Validation
        if (empty($data['year_of_payment'])) {
            $errors[] = "Year of Payment is required";
        }

        // Ensure year is 4 digits
        if (!preg_match('/^\d{4}$/', $data['year_of_payment'])) {
            $errors[] = "Year must be a 4-digit number";
        }

        // Payment Slip Validation
        if (empty($data['payment_slip'])) {
            $errors[] = "Payment Slip is required";
        }

        return $errors;
    }

    public function checkDuplicateEntry($studentId, $yearOfPayment)
    {
        $query = "SELECT COUNT(*) as count FROM $this->table 
                  WHERE student_id = :student_id AND year_of_payment = :year_of_payment";

        $params = [
            'student_id' => $studentId,
            'year_of_payment' => $yearOfPayment
        ];

        $result = $this->query($query, $params);
        return $result[0]->count > 0;
    }

    public function getPaymentsByStudentId($studentId)
    {
        $query = "SELECT * FROM $this->table WHERE student_id = :student_id ORDER BY year_of_payment DESC";
        $params = ['student_id' => $studentId];
        return $this->query($query, $params);
    }

    public function getPaymentsByParentRegNo($parentRegNo)
    {
        // Query to get payments for all students associated with the parent
        $query = "SELECT p.*
                  FROM facility_charges p
                  WHERE p.student_id IN (
                      SELECT s.student_id
                      FROM students s
                      JOIN parent_students ps ON s.regNo = ps.studentRegNo
                      WHERE ps.parentRegNo = :parentRegNo
                  )";

        return $this->query($query, ['parentRegNo' => $parentRegNo]);
    }


    public function updateStatusByStudentId($studentId, $status)
    {
        $query = "UPDATE facility_charges SET status = :status WHERE student_id = :student_id";
        $params = [
            'status' => $status,
            'student_id' => $studentId
        ];

        return $this->query($query, $params);
    }
}


// CREATE TABLE facility_charges (
//     payment_id INT AUTO_INCREMENT PRIMARY KEY,               
//     full_name VARCHAR(255) NOT NULL,                 
//     student_id VARCHAR(100) NOT NULL,                
//     year_of_payment YEAR NOT NULL,                   
//     payment_slip VARCHAR(255),                  
//     
//     UNIQUE (student_id, year_of_payment)            
// );
