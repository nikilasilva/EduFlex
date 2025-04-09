<?php

class ClassModel {
    use Model;

    protected $table = 'classes';
    protected $allowedColumns = [
        'classId',
        'className',
        'classTeacherRegNo'
    ];

    protected $order_column = 'classId';
}
