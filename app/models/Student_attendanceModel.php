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

    // Renamed property
    protected $attendance_order_column = 'date';

    public function getAttendance($filters = []) {
        $where = [];

        // Check for filters and build the WHERE clause
        if (isset($filters['date']) && !empty($filters['date'])) {
            $where[] = "date = :date";
        }
        if (isset($filters['class']) && !empty($filters['class'])) {
            $where[] = "class = :class";
        }

        $sql = "SELECT * FROM {$this->table}";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY {$this->attendance_order_column} DESC";

        return $this->query($sql, $filters);
    }
}


