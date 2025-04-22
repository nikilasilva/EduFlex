<?php

class MarksModel {
    use Database;

    public function insertMarks($studentId, $subjectId, $term, $marks, $classId) {
        // Check if the record already exists
        $existing = $this->getRow("SELECT * FROM marks WHERE student_id = :sid AND subject_id = :subid AND term = :term", [
            ':sid' => $studentId,
            ':subid' => $subjectId,
            ':term' => $term
        ]);
    
        if ($existing) {
            // Update the existing record
            $this->query("UPDATE marks SET marks = :marks, classId = :classId WHERE student_id = :sid AND subject_id = :subid AND term = :term", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId
            ]);
        } else {
            // Insert a new record if no existing entry is found
            $this->query("INSERT INTO marks (student_id, subject_id, term, marks, classId) VALUES (:sid, :subid, :term, :marks, :classId)", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId
            ]);
        }
    }
    
    

    public function getClassReport($classId, $term) {
        $query = "
            SELECT s.student_id, s.firstName AS student_name, sub.name AS subject_name, m.marks
            FROM marks m
            JOIN students s ON m.student_id = s.student_id
            JOIN subjects sub ON m.subject_id = sub.id
            WHERE s.classId = :classId AND m.term = :term
        ";
        return $this->query($query, [
            ':classId' => $classId,
            ':term' => $term
        ]);
    }

    public function getStudentRanks($classId, $term) {
        $query = "
            SELECT s.student_id, s.firstName AS student_name, AVG(m.marks) AS average_marks
            FROM students s
            JOIN marks m ON s.student_id = m.student_id
            WHERE s.classId = :classId AND m.term = :term
            GROUP BY s.student_id
            ORDER BY average_marks DESC
        ";
        return $this->query($query, [
            ':classId' => $classId,
            ':term' => $term
        ]);
    }

    public function getClassReportByTerm($classId, $term)
{
    $sql = "
    SELECT 
        m.student_id,
        s.name AS subject_name,
        m.marks,
        CONCAT(st.firstName, ' ', st.lastName) AS student_name
    FROM marks m
    JOIN subjects s ON m.subject_id = s.id
    JOIN students st ON m.student_id = st.student_id
    WHERE m.classId = :classId AND m.term = :term
    ORDER BY m.student_id, s.name
";


    return $this->query($sql, [
        'classId' => $classId,
        'term' => $term
    ]);
}

    
    
    
    public function getStudentRanksByTerm($classId, $term) {
        $query = "
            SELECT s.student_id, s.firstName AS student_name, AVG(m.marks) AS average_marks
            FROM students s
            JOIN marks m ON s.student_id = m.student_id
            WHERE s.classId = :classId AND m.term = :term
            GROUP BY s.student_id
            ORDER BY average_marks DESC
        ";
        return $this->query($query, [':classId' => $classId, ':term' => $term]);
    }

    
    public function updateOrInsertMarks($studentId, $subjectName, $term, $marks, $classId) {
        // Get subject ID
        $subjectId = $this->getSubjectIdByName($subjectName);
    
        if (!$subjectId) {
            // Handle error if subject is not found
            return false;
        }
    
        // Validate classId
        if (empty($classId)) {
            // Handle error if classId is empty (you can set a default classId or return false)
            return false;  // You can replace this with a more meaningful error message if needed
        }
    
        // Check if record exists in the database
        $existing = $this->getRow("SELECT * FROM marks WHERE student_id = :sid AND subject_id = :subid AND term = :term", [
            ':sid' => $studentId,
            ':subid' => $subjectId,
            ':term' => $term
        ]);
    
        if ($existing) {
            // If the record exists, update it
            $this->query("UPDATE marks SET marks = :marks, classId = :classId WHERE student_id = :sid AND subject_id = :subid AND term = :term", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId
            ]);
        } else {
            // If the record does not exist, insert a new one
            $this->query("INSERT INTO marks (student_id, subject_id, term, marks, classId) VALUES (:sid, :subid, :term, :marks, :classId)", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId
            ]);
        }
    
        return true;
    }
    
    
    
    

    public function getSubjectIdByName($subjectName) {
        $query = "SELECT id FROM subjects WHERE name = :name LIMIT 1";
        $result = $this->getRow($query, [':name' => $subjectName]);
        return $result ? $result->id : null;
    }
    
    
}

?>



