<?php

class manage_classModel
{
    use Model;

    protected $table = 'classes';

    protected $allowedColumns = [
        'classId',
        'className',
        'academicYear'

    ];

    protected $order_column = 'classId'; // Defined here

    public function getClassIdByName($className)
{
    $query = "SELECT classId FROM classes WHERE className = :className LIMIT 1";
    $result = $this->query($query, ['className' => $className]);

    if (!empty($result)) {
        return $result[0]->classId;
    }

    return null; // Or handle as needed
}



}
