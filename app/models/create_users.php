<?php

class issuance_of_booksModel
{

    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'id',
        'username',
        'email',
        'password',
        'role',
        'created_at'
    ];

    protected $order_column = 'issue_date'; // Defined here
}
