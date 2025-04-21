<?php

class manage_studentModel
{
    use Model;

    protected $table = 'students';

    protected $allowedColumns = [
        'studentId',
        'regNo',
        'firstName',
        'lastName',
        'classId'
    

    ];

    protected $order_column = 'studentId'; // Defined here
}
