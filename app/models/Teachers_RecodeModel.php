<?php

class Teachers_RecodeModel
{

    use Model;

    protected $table = 'Teachers_Recode';
    protected $allowedColumns = [
        'teacher_id',
        'teacher_name',
        'attendance'
    ];

    protected $order_column = 'teacher_id'; // Defined here
}
