<?php

class manage_teacherModel
{

    use Model;

    protected $table = 'teachers';
    protected $allowedColumns = [
        'teacherId',
        'userID',
        'specialization'

    ];

    protected $order_column = 'teacherId'; // Defined here
}
