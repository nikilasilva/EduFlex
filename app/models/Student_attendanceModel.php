<?php

class Student_attendanceModel {

    use Model;

    protected $table = 'student_attendance';
    protected $allowedColumns = [
        'date',
        'student_id',
        'name',
        'class',
        'status'
    ];

    protected $order_column = 'date'; // Defined here
}

