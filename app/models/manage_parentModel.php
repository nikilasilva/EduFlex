<?php

class manage_parentModel
{

    use Model;

    protected $table = 'parents';
    protected $allowedColumns = [
        'parentId',
        'userID',
        'occupation'
        
    ];

    protected $order_column = 'parentId'; // Defined here
}
