<?php

class Teachers_RecodeModel
{
    use Model;

    protected $table = 'teachers_recode'; // Correct table name
    protected $allowedColumns = [
        'teacher_id',
        'attendance'
    ];

    // Define the column to order by
    protected $order_column = 'teacher_id';
}
