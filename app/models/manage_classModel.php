<?php

class manage_classModel
{
    use Model;

    protected $table = 'classes';

    protected $allowedColumns = [
        'className',
        'classTeacherId'

    ];

    protected $order_column = 'classId'; // Defined here
}
