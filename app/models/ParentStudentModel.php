<?php

class ParentStudentModel {
    use Model;

    protected $table = 'students';
    protected $allowedColumns = [
        'student_id',
        'regNo',
        'firstName',
        'lastName',
        'classId'
    ];
    protected $order_column = 'student_id';

    public function getStudentsByParentRegNo($parentRegNo) {
        $query = "SELECT s.*
                  FROM students s
                  JOIN parent_students ps ON s.regNo = ps.studentRegNo
                  WHERE ps.parentRegNo = :parentRegNo";
    
        return $this->query($query, ['parentRegNo' => $parentRegNo]);
    }
    
}