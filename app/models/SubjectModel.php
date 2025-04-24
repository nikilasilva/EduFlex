<?php
class SubjectModel {
    use Database; // Use the Database trait directly
    use Model;

    protected $table = 'subjects';

    // Example method to get subjects for a class
    public function getSubjectsByClass($classId) {
        $query = 'SELECT * FROM subjects WHERE class_id = :class_id';  // Adjust the table name as needed
        $data = ['class_id' => $classId];
        return $this->query($query, $data);  // Using the query method from the Database trait
    }

    public function getAllSubjects() {
        $sql = "SELECT subjectId, subjectName FROM subjects ORDER BY subjectName ASC";
        return $this->query($sql);
    }

    public function getSubjectIdByName($subjectName) {
        $sql = "SELECT subjectId FROM $this->table WHERE subjectName = :subjectName";
        $result = $this->query($sql, ['subjectName' => $subjectName]);
        return $result ? $result[0]->subjectId : null;
    }
}
?>

