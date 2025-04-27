<?php

class ParentStudentModel {
    use Model;

    protected $table = 'students';
    protected $allowedColumns = [
        'student_id',
        'regNo',
        'firstName',
        'lastName',
        'classId',
        'dateOfAdmission',
        'guardianRegNo',
    ];
    protected $order_column = 'student_id';

    public function getStudentsByParentRegNo($parentRegNo) {
        $query = "SELECT s.*, u.profile_picture ,u.fullName,c.className
                  FROM students s
                  JOIN parents p ON s.guardianRegNo = p.regNo
                  JoiN classes c ON s.classId = c.classId
                  INNER JOIN users u ON u.regNo = s.regNo
                  WHERE p.regNo = :parentRegNo";
    
        return $this->query($query, ['parentRegNo' => $parentRegNo]);
    }

    // public function getPaymentsByParentRegNo($parentRegNo) {
    //     // Query to get payments for all students associated with the parent
    //     $query = "SELECT p.*
    //               FROM facility_charges p
    //               WHERE p.student_id IN (
    //                   SELECT s.student_id
    //                   FROM students s
    //                   JOIN parent_students ps ON s.regNo = ps.studentRegNo
    //                   WHERE ps.parentRegNo = :parentRegNo
    //               )";
    
    //     return $this->query($query, ['parentRegNo' => $parentRegNo]);
    // }
    
}