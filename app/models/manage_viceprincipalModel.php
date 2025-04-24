<?php

class manage_viceprincipalModel
{

    use Model;

    protected $table = 'viceprincipals';
    protected $allowedColumns = [
        'vicePrincipalId',
        'regNo',
        'experience',
        'hireDate'
    
    ];

    protected $order_column = 'vicePrincipalId'; // Defined here

      // Method to fetch Student along with user full name and initials
      public function findAllWithUserInfo()
      {
          $query = "SELECT n.*, u.fullName, u.nameWithInitial
                    FROM viceprincipals n
                    JOIN users u ON n.regNo = u.regNo
                    ORDER BY n.{$this->order_column} ASC";
          return $this->query($query);
      }
  


}
