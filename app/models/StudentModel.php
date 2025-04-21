<?php
class StudentModel {
    use Model;

    protected $table = 'students';
    protected $allowedColumns = [
        'firstName',
        'lastName',
        'classId',
        'guardianRegN0'   
    ];


    // Example method to get all students
    public function getAllStudents() {
        $query = 'SELECT * FROM students';  // Adjust the table name as needed
        return $this->query($query); // Using the query method from the Database trait
    }
    
    public function __construct()
    {
     $this->order_column='student_id';   
    }
    

}
?>

