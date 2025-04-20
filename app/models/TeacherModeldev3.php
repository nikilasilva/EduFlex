<?php

class TeacherModeldev3
{
    use Model;

    protected $table = 'teacher'; // Table name should match your DB
    protected $allowedColumns = [
        'teacher_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'hire_date',
        'department',
        'date_of_birth',
        'address'
    ];

    protected $order_column = 'teacher_id';
}
