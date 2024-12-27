<?php
class ClassModel {
    use Database; // Use the Database trait

    public function getAllClasses() {
        $query = 'SELECT * FROM classes'; 
        $result = $this->query($query); 
        // var_dump($result); // Debug the query result
        // return $result;
    }
    
}



