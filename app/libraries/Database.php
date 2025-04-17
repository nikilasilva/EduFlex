<?php

trait Database {
    protected $db;

    // This method will initialize the database connection and store it in $db property
    protected function connect() {
        try {
            $string = "mysql:hostname=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->db = new PDO($string, DB_USER, DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode for debugging
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // General method to execute a query
    public function query($query, $data = []) {
        if ($this->db === null) {
            $this->connect(); // Ensure the connection is made if not already
        }
        $stm = $this->db->prepare($query);
        $check = $stm->execute($data);
        
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result ? $result : false;
        }
        return false;
    }

    // Helper method to fetch a single row
    public function getRow($query, $data = []) {
        if ($this->db === null) {
            $this->connect(); // Ensure the connection is made if not already
        }
        $stm = $this->db->prepare($query);
        $check = $stm->execute($data);
        
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result ? $result[0] : false;
        }
        return false;
    }
}







// $string = "mysql:hostname=localhost;dbname=my_db";
// $con = new PDO($string,'root','');

// show($conn);