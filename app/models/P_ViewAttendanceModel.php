<?php

class P_ViewAttendanceModel {
    // use Model;
    use Database;

    protected $table = 'student_attendance';
    protected $allowedColumns = [
        'date',
        'studentId',
        'name',
        'class',
        'status',
    ];
    public function getStudentId() {
        $query = "SELECT studentId FROM $this->table WHERE studentId IS NOT NULL LIMIT 1";
        $result = $this->query($query);
        
        // Assuming $result is an object and we need to extract the studentId
        if ($result && isset($result[0])) {
            return $result[0]->studentId; // Access the studentId
        }
        return null; // Return null if no result
    }
    

    public function getAttendanceByStudentId($studentId) {
        $data = ['student_id' => $studentId];
        $query = "SELECT * FROM $this->table WHERE studentId = :student_id";
        return $this->query($query, $data);
    }

    public function getAttendanceByStudentIdAndMonth($studentId, $startDate, $endDate) {
        $data = [
            'student_id' => $studentId,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        $query = "SELECT * FROM $this->table 
                  WHERE studentId = :student_id 
                  AND date BETWEEN :start_date AND :end_date 
                  ORDER BY date ASC";
        return $this->query($query, $data);
    }

    public function findAll() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }
}