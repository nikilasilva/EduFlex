<?php
class SubjectModel {
    use Database; // Use the Database trait directly

    // Example method to get subjects for a class
    public function getSubjectsByClass($classId) {
        $query = 'SELECT * FROM subjects WHERE class_id = :class_id';  // Adjust the table name as needed
        $data = ['class_id' => $classId];
        return $this->query($query, $data);  // Using the query method from the Database trait
    }
}
?>

