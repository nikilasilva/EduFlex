<?php
class Payment_chargesModel {
    use Model;

    protected $table = 'facility_charges';
    protected $allowedColumns = [
        'payment_id',
        'full_name',
        'student_id',
        'year_of_payment',
        'payment_slip'
    ];
    protected $order_column = 'payment_id';

    // Inside Payment_chargesModel.php
    public function validate($data) {
        $errors = [];
    
        if (empty($data['full_name'])) {
            $errors['fullName'] = "Full Name is required.";
        }
    
        if (empty($data['student_id'])) {
            $errors['studentId'] = "Student ID is required.";
        }
    
        // if (empty($data['year_of_payment'])) {
        //     $errors['payment'] = "Year of Payment is required.";
        // }
        if (empty($data['year_of_payment'])) {
            $errors['payment'] = "Year of Payment is required.";
        } elseif (!preg_match('/^\d{4}$/', $data['year_of_payment'])) {
            $errors['payment'] = "Year of Payment must be a 4-digit year.";
        }
        
        if (empty($_FILES['paymentSlip']['name'])) { 
            $errors['paymentSlip'] = "Payment Slip is required.";
        }
    
        return $errors;
    }
    


    public function checkDuplicateEntry($studentId, $yearOfPayment) {
        $query = "SELECT COUNT(*) as count FROM $this->table 
                  WHERE student_id = :student_id AND year_of_payment = :year_of_payment";
        
        $params = [
            'student_id' => $studentId,
            'year_of_payment' => $yearOfPayment
        ];

        $result = $this->query($query, $params);
        return $result[0]->count > 0;
    }

    public function getPaymentsByStudentId($studentId) {
        $query = "SELECT * FROM $this->table WHERE student_id = :student_id ORDER BY year_of_payment DESC";
        $params = ['student_id' => $studentId];
        return $this->query($query, $params);
    }

    public function getPaymentsByParentRegNo($parentRegNo) {
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
