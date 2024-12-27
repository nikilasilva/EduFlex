<?php
class StudentModel {
    use Database; // Use the Database trait

    // Example method to get all students
    public function getAllStudents() {
        $query = 'SELECT * FROM students';  // Adjust the table name as needed
        return $this->query($query); // Using the query method from the Database trait
    }
}
?>

