<?php

class manage_useraccountModel
{

    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'regNo',
        'email',
        'mobileNo',
        'address',
        'username',
        'password',
        'dob',
        'gender',
        'religion',
        'role'

        
    ];

     protected $order_column = 'regNo'; // Defined here

     

}

?>
