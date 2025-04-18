<?php
class ViewMarksModel {
    use Database;

    protected $table = 'marks';
    protected $allowedColumns = [
        'student_id',
        'subject_id',
        'term',
        'subjectName',
        'marks'
    ];

    
    public function __construct() {
        // $this->db = new Database(); // Assuming you have a Database class for DB handling
        $this->connect(); // Initialize the database connection
    }

    public function getStudentMarks($studentId) {
        $query = "SELECT s.subjectName, m.term, m.marks
                  FROM marks m
                  JOIN subjects s ON m.subject_id = s.subject_id
                  WHERE m.student_id = :student_id
                  ORDER BY m.term DESC";
    
        $params = ['student_id' => $studentId];
        return $this->query($query, $params);
    }
    
}
