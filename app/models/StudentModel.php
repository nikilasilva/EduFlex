<?php
class StudentModel {
    use Model;
    use Database; // Use the Database trait for database operations
    protected $table = 'students'; // Define the table name
    protected $allowedColumns = [
        'firstName',
        'lastName',
        'classId',
       'dateOfAdmission',
        
        
    ];
    protected $order_column;

      public function getUsers() {
          return $this->query('SELECT * FROM students');  
      }


      public function getStudentByRegNo($regNo) {


          // Using a prepared statement with a named placeholder
          $query = 'SELECT * FROM students WHERE regNo = :regNo';


          if ($this->db === null) {
              $this->connect(); // Force database connection if not already established
          }
          // Prepare the query
          $stmt = $this->db->prepare($query);

          // Bind the :regNo placeholder to the actual value
          $stmt->bindParam(':regNo', $regNo, PDO::PARAM_INT);

          // Execute the query
          $stmt->execute();

          // Fetch and return the result
          return $stmt->fetch(PDO::FETCH_OBJ);
      }
        

    //Example method to get all students
    public function getAllStudents() {
        $query = 'SELECT * FROM students';  // Adjust the table name as needed
        return $this->query($query); // Using the query method from the Database trait
    }
    
    public function __construct()
    {
     $this->order_column='student_id';   
    }
    

    public function getStudentDetails($regNo) {
        $query = "SELECT 
            u.regNo,
            u.fullName,
            u.nameWithInitial,
            u.email,
            u.mobileNo,
            u.address,
            u.dob,
            u.gender,
            u.religion,
            u.profile_picture,
            s.student_id,
            c.className,
            c.academicYear,
            s.guardianRegNo,
            s.dateOfAdmission
        FROM users u
        JOIN students s ON u.regNo = s.regNo
        JOIN classes c ON c.classId = s.classId
        WHERE u.regNo = :regNo;";

        $result = $this->query($query, ['regNo' => $regNo]);
        return is_array($result) && !empty($result) ? $result[0] : new stdClass();
    }

}
?>

