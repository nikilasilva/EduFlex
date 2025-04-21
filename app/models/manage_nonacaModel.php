<?php

class manage_nonacaModel
{

    use Model;

    protected $table = 'nonacademicstaff';
    protected $allowedColumns = [
        'staffId',
        'regNo',
        'firstName',
        'lastName',
        'position',
        'department',
        'hireDate'
    
    ];

    protected $order_column = 'staffId'; // Defined here
}
