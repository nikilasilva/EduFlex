<?php

class manage_studentModel
{
    use Model;

    protected $table = 'students';

    protected $allowedColumns = [
        'student_id',
        'regNo',
        'firstName',
        'lastName',
        'classId'
    

    ];

    protected $order_column = 'student_Id'; // Defined here
}
