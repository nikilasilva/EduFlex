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


    public function getClassName($classId) {
        $sql = "SELECT className FROM classes WHERE classId = :classId";
        $result = $this->query($sql, ['classId' => $classId]);
        return $result[0]->className ?? 'Unknown';
    }


    public function findByParentId($parentRegNo) {
        $query ="SELECT * FROM absences WHERE parentRegNo = :parentRegNo";
    
        return $this->query($query, ['parentRegNo' => $parentRegNo]);

    
        
    }

//     ALTER TABLE absences
// ADD CONSTRAINT fk_parent_user
// FOREIGN KEY (parentRegNo)
// REFERENCES users(regNo)
// ON DELETE CASCADE
// ON UPDATE CASCADE;

}