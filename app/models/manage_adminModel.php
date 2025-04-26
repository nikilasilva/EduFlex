<?php

class manage_adminModel
{

    use Model;

    protected $table = 'admins';
    protected $allowedColumns = [
        'regNo',
        'NIC',
        'firstName',
        'lastName'
        
    ];

    protected $order_column = 'regNo'; // Defined here
}
