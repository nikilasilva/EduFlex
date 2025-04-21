<?php

class manage_viceprincipalModel
{

    use Model;

    protected $table = 'viceprincipals';
    protected $allowedColumns = [
        'vicePrincipalId',
        'regNo',
        'firstName',
        'lastName',
        'experience',
        'hireDate'
    
    ];

    protected $order_column = 'vicePrincipalId'; // Defined here
}
