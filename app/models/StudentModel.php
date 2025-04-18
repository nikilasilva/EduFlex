<?php
    class StudentModel{
        use Database; // Use the Database trait for database operations
        protected $table = 'students'; // Define the table name
        public function __construct() {
            if ($this->db === null) {
                $this->connect(); // Ensure the connection is established here
            }
        }

        public function getUsers() {
            return $this->query('SELECT * FROM students');  // Using the query method from the trait
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
        



    }