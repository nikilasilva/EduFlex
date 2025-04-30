<?php

class manage_studentModel
{
    use Model;

    protected $table = 'students';

    protected $allowedColumns = [
        'student_id',
        'regNo',
        'classId'
    

    ];

    protected $order_column = 'student_Id'; // Defined here

    // Method to fetch Student along with user full name and initials
    public function findAllWithUserInfo()
    {
        $query = "SELECT n.*, u.fullName, u.nameWithInitial, c.className
                  FROM students n
                  JOIN users u ON n.regNo = u.regNo
                  JOIN classes c ON n.classId = c.classId
                  ORDER BY n.{$this->order_column} ASC";
        return $this->query($query);
    }
    

    public function getClassIdByName($className)
{
    $query = "SELECT classId FROM {$this->table} WHERE className = :className";
    $this->query($query);
    $this->bind(':className', $className);
    return $this->single()->classId;
}

public function generateStudentID()
{
    $query = "SELECT student_id FROM {$this->table} ORDER BY student_id DESC LIMIT 1";
    $result = $this->query($query);

    if (!empty($result)) {
        $lastId = $result[0]->student_id;
        $num = (int)substr($lastId, 1); // Remove 'S' prefix and convert to int
        $newId = 'S' . str_pad($num + 1, 4, '0', STR_PAD_LEFT);
        return $newId;
    } else {
        return 'S0001'; // First ID
    }
}



}
