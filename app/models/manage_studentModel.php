<?php

class manage_studentModel
{
    use Model;

    protected $table = 'students';

    protected $allowedColumns = [
        'studentId',
        'userID',
        'firstName',
        'lastName',
        'classId',
        'guardianUserID'

    ];

    protected $order_column = 'studentId'; // Defined here
}
