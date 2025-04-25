<?php

class MarksModel {
    use Database;

    public function insertMarks($studentId, $subjectId, $term, $marks, $classId) {
        $year = date('Y');

        $existing = $this->getRow("SELECT * FROM marks WHERE student_id = :sid AND subject_id = :subid AND term = :term AND year = :year", [
            ':sid' => $studentId,
            ':subid' => $subjectId,
            ':term' => $term,
            ':year' => $year
        ]);

        if ($existing) {
            $this->query("UPDATE marks SET marks = :marks, classId = :classId WHERE student_id = :sid AND subject_id = :subid AND term = :term AND year = :year", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId,
                ':year' => $year
            ]);
        } else {
            $this->query("INSERT INTO marks (student_id, subject_id, term, marks, classId, year) VALUES (:sid, :subid, :term, :marks, :classId, :year)", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId,
                ':year' => $year
            ]);
        }
    }

    public function getClassReport($classId, $term) {
        $year = date('Y');
        $query = "
            SELECT s.student_id, s.firstName AS student_name, sub.name AS subject_name, m.marks
            FROM marks m
            JOIN students s ON m.student_id = s.student_id
            JOIN subjects sub ON m.subject_id = sub.id
            WHERE s.classId = :classId AND m.term = :term AND m.year = :year
        ";
        return $this->query($query, [
            ':classId' => $classId,
            ':term' => $term,
            ':year' => $year
        ]);
    }

    public function getStudentRanks($classId, $term) {
        $year = date('Y');
        $query = "
            SELECT s.student_id, s.firstName AS student_name, AVG(m.marks) AS average_marks
            FROM students s
            JOIN marks m ON s.student_id = m.student_id
            WHERE s.classId = :classId AND m.term = :term AND m.year = :year
            GROUP BY s.student_id
            ORDER BY average_marks DESC
        ";
        return $this->query($query, [
            ':classId' => $classId,
            ':term' => $term,
            ':year' => $year
        ]);
    }

    public function getClassReportByTerm($classId, $term) {
        $year = date('Y');
        $sql = "
            SELECT 
                m.student_id,
                s.name AS subject_name,
                m.marks,
                CONCAT(st.firstName, ' ', st.lastName) AS student_name
            FROM marks m
            JOIN subjects s ON m.subject_id = s.id
            JOIN students st ON m.student_id = st.student_id
            WHERE m.classId = :classId AND m.term = :term AND m.year = :year
            ORDER BY m.student_id, s.name
        ";
        return $this->query($sql, [
            'classId' => $classId,
            'term' => $term,
            'year' => $year
        ]);
    }

    public function getStudentRanksByTerm($classId, $term) {
        $year = date('Y');
        $query = "
            SELECT s.student_id, s.firstName AS student_name, AVG(m.marks) AS average_marks
            FROM students s
            JOIN marks m ON s.student_id = m.student_id
            WHERE s.classId = :classId AND m.term = :term AND m.year = :year
            GROUP BY s.student_id
            ORDER BY average_marks DESC
        ";
        return $this->query($query, [':classId' => $classId, ':term' => $term, ':year' => $year]);
    }

    public function updateOrInsertMarks($studentId, $subjectName, $term, $marks, $classId) {
        $year = date('Y');
        $subjectId = $this->getSubjectIdByName($subjectName);

        if (!$subjectId || empty($classId)) {
            return false;
        }

        $existing = $this->getRow("SELECT * FROM marks WHERE student_id = :sid AND subject_id = :subid AND term = :term AND year = :year", [
            ':sid' => $studentId,
            ':subid' => $subjectId,
            ':term' => $term,
            ':year' => $year
        ]);

        if ($existing) {
            $this->query("UPDATE marks SET marks = :marks, classId = :classId WHERE student_id = :sid AND subject_id = :subid AND term = :term AND year = :year", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId,
                ':year' => $year
            ]);
        } else {
            $this->query("INSERT INTO marks (student_id, subject_id, term, marks, classId, year) VALUES (:sid, :subid, :term, :marks, :classId, :year)", [
                ':sid' => $studentId,
                ':subid' => $subjectId,
                ':term' => $term,
                ':marks' => $marks,
                ':classId' => $classId,
                ':year' => $year
            ]);
        }

        return true;
    }

    public function getSubjectIdByName($subjectName) {
        $query = "SELECT id FROM subjects WHERE name = :name LIMIT 1";
        $result = $this->getRow($query, [':name' => $subjectName]);
        return $result ? $result->id : null;
    }

    // 🔍 New function to help controller check if marks already exist
    public function where($conditions = []) {
        $sql = "SELECT * FROM marks WHERE ";
        $params = [];
        $clauses = [];

        foreach ($conditions as $key => $value) {
            $clauses[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $sql .= implode(' AND ', $clauses);
        return $this->query($sql, $params);
    }

    public function marksExistForClassTerm($classId, $term) {
        $query = "SELECT COUNT(*) as total FROM marks WHERE classId = :classId AND term = :term";
        $result = $this->getRow($query, [
            ':classId' => $classId,
            ':term' => $term
        ]);
        return $result && $result->total > 0;
    }
    
}




