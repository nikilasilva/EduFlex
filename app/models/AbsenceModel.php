<?php
class AbsenceModel {
    use Model;

    protected $table = 'absences';
    protected $allowedColumns = [
        'absence_id',
        'student_id',
        'content',
        'date',
        
    ];

    protected $order_column = 'date';

    public function getClassName($classId) {
        $sql = "SELECT className FROM classes WHERE classId = :classId";
        $result = $this->query($sql, ['classId' => $classId]);
        return $result[0]->className ?? 'Unknown';
    }

}