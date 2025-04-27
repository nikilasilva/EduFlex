<?php
class AbsenceModel {
    use Model;

    protected $table = 'absences';
    protected $allowedColumns = [
        'absence_id',
        'student_id',
        'content',
        'date',
        'parentRegNo'
        
    ];

    protected $order_column = 'date';

    public function findByParentId($parentRegNo) {
        $query ="SELECT * FROM absences WHERE parentRegNo = :parentRegNo";
    
        return $this->query($query, ['parentRegNo' => $parentRegNo]);

    
        
    }

    public function getAbsenceByParentRegNo($parentRegNo) {

        $query = "SELECT s.student_id
        FROM students s 
        JOIN parent_students ps ON s.regNo = ps.studentRegNo
        WHERE ps.parentRegNo = :parentRegNo";

        // Execute the query and return the results
        return $this->query($query, ['parentRegNo' => $parentRegNo]);
    }

//     ALTER TABLE absences
// ADD CONSTRAINT fk_parent_user
// FOREIGN KEY (parentRegNo)
// REFERENCES users(regNo)
// ON DELETE CASCADE
// ON UPDATE CASCADE;
}