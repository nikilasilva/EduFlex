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
        'fullName',
        'nameWithInitial',
        'password',
        'dob',
        'gender',
        'religion',
        'role'

        
    ];

     protected $order_column = 'regNo'; // Defined here

     //For update the full name and name with initials
     public function updateUserNameDetails($regNo, $data)
{
    $this->update($regNo, $data, 'regNo'); // Pass 'regNo' as key column
}


     

}

?>
