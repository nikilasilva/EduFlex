<?php

class Report {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getClassDetails($classId) {
        $this->db->query('SELECT * FROM classrooms WHERE id = :class_id');
        $this->db->bind(':class_id', $classId);
        return $this->db->single();
    }

    public function getStudentReports($classId) {
        $this->db->query('
            SELECT 
                s.id AS student_id, 
                s.name AS student_name, 
                AVG(m.marks) AS average_marks
            FROM students s
            LEFT JOIN marks m ON s.id = m.student_id
            WHERE s.class_id = :class_id
            GROUP BY s.id
        ');
        $this->db->bind(':class_id', $classId);
        return $this->db->resultSet();
    }

    public function saveMarks($data) {
        $this->db->query('
            INSERT INTO marks (student_id, subject_id, marks) 
            VALUES (:student_id, :subject_id, :marks)
        ');
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':subject_id', $data['subject_id']);
        $this->db->bind(':marks', $data['marks']);
        return $this->db->execute();
    }
}

