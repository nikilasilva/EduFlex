<?php

class TeacherModeldev3
{
    use Model;

    protected $table = 'teachers'; // Table name should match your DB
    protected $allowedColumns = [
        'teacher_id',
        'firstName',
        'lastName	',
        'regNo'
    ];

    protected $order_column = 'teacher_id';
}
