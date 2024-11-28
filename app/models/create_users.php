<?php

class create_users
{

    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'id',
        'username',
        'email',
        'password',
        'role'
    ];

    protected $order_column = 'issue_date'; // Defined here
}
