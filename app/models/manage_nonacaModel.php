<?php

class manage_nonacaModel
{

    use Model;

    protected $table = 'nonacademicstaff';
    protected $allowedColumns = [
        'staffId',
        'userID',
        'position',
        'department',
        'hireDate'
    
    ];

    protected $order_column = 'staffId'; // Defined here
}
