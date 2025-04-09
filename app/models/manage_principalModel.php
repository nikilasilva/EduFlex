<?php

class manage_principalModel
{

    use Model;

    protected $table = 'principals';
    protected $allowedColumns = [
        'principalId',
        'userID',
        'experience',
        'hireDate'
    
    ];

    protected $order_column = 'principalId'; // Defined here
}
