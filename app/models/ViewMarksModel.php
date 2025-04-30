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
                  JOIN subjects s ON m.subject_id = s.subjectId
                  WHERE m.student_id = :student_id
                  ORDER BY m.term DESC";
    
        $params = ['student_id' => $studentId];
        return $this->query($query, $params);
    }

    public function getStudentsMarksByParentRegNo($parentRegNo) {
        $query = "SELECT s.student_id
                  FROM students s
                  JOIN parent_students ps ON s.regNo = ps.studentRegNo
                  WHERE ps.parentRegNo = :parentRegNo";
    
        return $this->query($query, ['parentRegNo' => $parentRegNo]);
    }

    public function getTotalMarksByTerm($term) {
        $query = "
            SELECT m.student_id, SUM(m.marks) AS total_marks
            FROM marks m
            WHERE m.term = :term
            GROUP BY m.student_id
            ORDER BY total_marks DESC
        ";
    
        return $this->query($query, ['term' => $term]);
    }
    
    
}