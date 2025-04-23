<?php

class ClassesModel {
    use Model;

    protected $table = 'classes';
    protected $allowedColumns = [
        'classId',
        'className',
        'classTeacherRegNo'
    ];

    protected $order_column = 'classId';

    // Fetch all grades for students
    public function getAllGrades() {
        $sql = "SELECT DISTINCT SUBSTRING(className, 7, LOCATE('-', className) - 7) AS grade
                FROM classes
                ORDER BY CAST(grade AS UNSIGNED)";
        return $this->query($sql);
    }

    public function classIdExists($classId) {
        return $this->first(['classId' => $classId]) !== false;
    }

    public function getTableName() {
        return $this->table;
    }
}
