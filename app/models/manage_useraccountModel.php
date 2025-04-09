<?php

class manage_useraccountModel
{

    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'userID',
        'email',
        'mobileNo',
        'address',
        'firstName',
        'lastName',
        'username',
        'password',
        'dob',
        'gender',
        'religion',
        'role'

        
    ];

     protected $order_column = 'userID'; // Defined here

     

}

?>
