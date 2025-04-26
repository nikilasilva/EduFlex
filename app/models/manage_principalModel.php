<?php

class manage_principalModel
{

    use Model;

    protected $table = 'principals';
    protected $allowedColumns = [
        'principalId',
        'regNo',
        'experience',
        'hireDate'
    
    ];

    protected $order_column = 'principalId'; // Defined here


    // Method to fetch non-academic staff along with user full name and initials
    public function findAllWithUserInfo()
    {
        $query = "SELECT n.*, u.fullName, u.nameWithInitial
                  FROM principals n
                  JOIN users u ON n.regNo = u.regNo
                  ORDER BY n.{$this->order_column} ASC";
        return $this->query($query);
    }
}
