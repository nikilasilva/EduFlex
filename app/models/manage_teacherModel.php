<?php

class manage_teacherModel
{

    use Model;

    protected $table = 'teachers';
    protected $allowedColumns = [
        'teacherId',
        'regNo',
        'firstName',
        'lastName',
        'subject',
        'experience',
        'hireDate'

    ];

    protected $order_column = 'teacherId'; // Defined here
}
