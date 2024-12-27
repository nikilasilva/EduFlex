<?php

class MarksModel {
    use Model;

    public function __construct() {
        $this->table = 'marks'; // Set the database table name
        $this->order_column = 'student_id'; // Default order column
        $this->allowedColumns = ['student_id', 'class', 'subject', 'marks_obtained', 'total_marks', 'date']; // Columns allowed for insert/update
    }

    public function insertMarks($data) {
        return $this->insert($data);
    }

    public function getClassReport() {
        $query = "SELECT student_id, subject, SUM(marks_obtained) AS total_marks_obtained, 
                         SUM(total_marks) AS total_marks_possible,
                         AVG(marks_obtained) AS average_marks
                  FROM marks
                  GROUP BY student_id, subject";
        return $this->query($query);
    }
    
    public function getClassRanks() {
        $query = "SELECT student_id, SUM(marks_obtained) AS total_marks_obtained, 
                         SUM(total_marks) AS total_marks_possible,
                         (SUM(marks_obtained) / SUM(total_marks)) * 100 AS percentage
                  FROM marks
                  GROUP BY student_id
                  ORDER BY percentage DESC";
        return $this->query($query);
    }
    

    public function getStudentRanks($class) {
        $query = "SELECT student_id, SUM(marks_obtained) as total_obtained, 
                         RANK() OVER (ORDER BY SUM(marks_obtained) DESC) as rank
                  FROM $this->table
                  WHERE class = ?
                  GROUP BY student_id";
        return $this->query($query, [$class]);
    }
}

