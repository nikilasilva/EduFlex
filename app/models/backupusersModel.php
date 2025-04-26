<?php

class backupusersModel
{
    use Model;

    protected $table = 'backupusers';

    protected $allowedColumns = [
        'regNo',
        'email',
        'mobileNo',
        'address',
        'fullName',
        'nameWithInitial',
        'password',
        'dob',
        'gender',
        'religion',
        'role'
    ];

    protected $order_column = 'regNo';
}
?>
