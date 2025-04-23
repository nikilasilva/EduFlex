<?php

class manage_classModel
{
    use Model;

    protected $table = 'classes';

    protected $allowedColumns = [
        'classId',
        'className'

    ];

    protected $order_column = 'classId'; // Defined here
}
