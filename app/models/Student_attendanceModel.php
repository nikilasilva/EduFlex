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
        $sql = "SELECT DISTINCT classId, className FROM classes ORDER BY className";
        return $this->query($sql);
    }

    public function getStudentsByClass($classId) {
        $sql = "SELECT student_id, firstName, lastName FROM students WHERE classId = :classId";
        return $this->query($sql, ['classId' => $classId]);
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


    public function getAbsencesByDateAndClass($date, $class) {
        $sql = "SELECT 
                    a.student_id, 
                    CONCAT(s.firstName, ' ', s.lastName) AS name, 
                    a.content
                FROM absences a
                JOIN students s ON a.student_id = s.student_id
                WHERE a.date = :date AND s.classId = :class";
        return $this->query($sql, ['date' => $date, 'class' => $class]);
    }
        
}




