<?php
class ClassModel {
    use Database; // Use the Database trait

    public function getAllClasses() {
        $query = 'SELECT * FROM classes'; 
        $result = $this->query($query); 
        //var_dump($result); // Debug the query result
        return $result;
    }

    public function getClassName($classId) {
        $sql = "SELECT className FROM classes WHERE classId = :classId";
        $result = $this->query($sql, ['classId' => $classId]);
        return $result[0]->className ?? 'Unknown';
    }   
}
