<?php

class MarksModel {
    use Database;

    public function insertMarks($studentId, $subjectId, $marks) {
        try {
            $query = "INSERT INTO marks (student_id, subject_id, marks) VALUES (:student_id, :subject_id, :marks)";
            return $this->query($query, [
                ':student_id' => $studentId,
                ':subject_id' => $subjectId,
                ':marks' => $marks
            ]);
        } catch (PDOException $e) {
            die("Insert Marks Error: " . $e->getMessage());
        }
    }

    public function getClassReport($classId) {
        try {
            $query = "
                SELECT s.student_id AS student_id, s.name AS student_name, sub.id AS subject_id, sub.name AS subject_name, m.marks 
                FROM marks m
                INNER JOIN students s ON m.student_id = s.student_id
                INNER JOIN subjects sub ON m.subject_id = sub.id
                WHERE s.class_id = :class_id
            ";
            return $this->query($query, [':class_id' => $classId]);
        } catch (PDOException $e) {
            die("Class Report Error: " . $e->getMessage());
        }
    }

    public function getStudentRanks($classId) {
        try {
            $query = "
                SELECT s.student_id AS student_id, s.name AS student_name, AVG(m.marks) AS average_marks
                FROM students s
                INNER JOIN marks m ON s.student_id = m.student_id
                WHERE s.class_id = :class_id
                GROUP BY s.student_id, s.name
                ORDER BY average_marks DESC
            ";
            return $this->query($query, [':class_id' => $classId]);
        } catch (PDOException $e) {
            die("Student Ranks Error: " . $e->getMessage());
        }
    }
}

?>



