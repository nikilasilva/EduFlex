<?php

class manage_teacherModel
{

    use Model;

    protected $table = 'teachers';
    protected $allowedColumns = [
        'teacher_id',
        'regNo',
        'firstName',
        'lastName',
        'subject',
        'experience',
        'hireDate'

    ];

    protected $order_column = 'teacher_id'; // Defined here
}
