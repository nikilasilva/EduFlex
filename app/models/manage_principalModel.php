<?php

class manage_principalModel
{

    use Model;

    protected $table = 'principals';
    protected $allowedColumns = [
        'principalId',
        'regNo',
        'firstName',
        'lastName',
        'experience',
        'hireDate'
    
    ];

    protected $order_column = 'principalId'; // Defined here
}
