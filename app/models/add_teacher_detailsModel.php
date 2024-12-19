<?php

class TeacherDetailsModel
{

    use Model;

    protected $table = 'teacher_details';
    protected $allowedColumns = [
        'tea_id',
        'tea_fullName',
        'tea_subject',
        'tea_address',
        'tea_dob',
        'tea_appointeddate',
        'tea_phone',
        'tea_email'
    ];

    protected $order_column = 'tea_fullName'; // You can change this to any column you want to order by
}

?>
