<?php
class Student_attendanceModel {
    use Model;

    protected $table = 'student_attendance';
    protected $allowedColumns = [
        'date',
        'student_id',
        'name',
        'class',
        'status'
    ];

    public function getClasses() {
        $sql = "SELECT DISTINCT id, name FROM classes ORDER BY name";
        return $this->query($sql);
    }

    public function getStudentsByClass($classId) {
        $sql = "SELECT student_id, name FROM students WHERE class_id = :class_id";
        return $this->query($sql, ['class_id' => $classId]);
    }

    public function getAttendance($filters = []) {
        $where = [];

        if (!empty($filters['date'])) {
            $where[] = "date = :date";
        }
        if (!empty($filters['class'])) {
            $where[] = "class = :class";
        }

        $sql = "SELECT * FROM {$this->table}";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY date DESC";

        return $this->query($sql, $filters);
    }
}




