<?php

class manage_parentModel
{

    use Model;

    protected $table = 'parents';
    protected $allowedColumns = [
        'regNo',
        'NIC',
        'relationship'
        
    ];

    protected $order_column = 'regNo'; // Defined here

      // Method to fetch non-academic staff along with user full name and initials
      public function findAllWithUserInfo()
      {
          $query = "SELECT n.*, u.fullName, u.nameWithInitial
                    FROM parents n
                    JOIN users u ON n.regNo = u.regNo
                    ORDER BY n.{$this->order_column} ASC";
          return $this->query($query);
      }
}
