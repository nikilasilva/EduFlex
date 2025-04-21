<?php

// Trait Database{

//     protected function connect(){
//         $string = "mysql:hostname=".DB_HOST.";dbname=".DB_NAME;
//         $conn = new PDO($string,DB_USER,DB_PASSWORD);
//         return $conn;
//     }

// main-dev
   // protected function connect(){
     //   $string = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
       // $conn = new PDO($string,DB_USER,DB_PASSWORD);        
        //return $conn;
    }

//     public function query($query,$data = []){

//         $conn = $this->connect();
//         $stm=$conn->prepare($query);

//         $check = $stm->execute($data);
//         if($check){
            
//             $result = $stm->fetchAll(PDO::FETCH_OBJ);
//             if(is_array($result) && count($result)){
               
//                 return $result;
//             }
//         }

//         return false;
//     }

//     public function getRow($query,$data = []){
        
//         $conn = $this->connect();
//         $stm=$conn->prepare($query);

//         $check = $stm->execute($data);
//         if($check){
//             $result = $stm->fetchAll(PDO::FETCH_OBJ);
//             if(is_array($result) && count($result)){
//                 return $result[0];
//             }
//         }

//         return false;
//     }


// }


// Database Trait
trait Database {
    private $conn;

    // Connect to the database
    private function connect() {
        try {
            $string = "mysql:hostname=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->conn = new PDO($string, DB_USER, DB_PASSWORD);
            // Set PDO attributes for error handling and fetching
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Prepare and execute a query
    public function query($query, $data = []) {
        if ($this->conn === null) {
            $this->connect();
        }
        $stm = $this->conn->prepare($query);
        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }

    // Fetch a single row from the database
    public function getRow($query, $data = []) {
        if ($this->conn === null) {
            $this->connect();
        }
        $stm = $this->conn->prepare($query);
        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result[0]; // Return the first row
            }
        }
        return false;
    }

    // Close the database connection
    public function close() {
        $this->conn = null;
    }
}
?>



