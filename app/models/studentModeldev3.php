
<?php


class studentModeldev3
{
    use Model;

    protected $table = 'students';

    protected $allowedColumns = [
        'student_id ',
        'regNo',
        'firstName',
        'lastName',
        'classId'
    ];

    protected $order_column = 'student_id';
    protected $primaryKey = 'student_id';
    
}