<?php
class manage_nonacaModel
{
    use Model;

    protected $table = 'nonacademicstaff';
    protected $allowedColumns = [
        'staffId',
        'regNo',
        'position',
        'department',
        'hireDate'
    ];

    protected $order_column = 'staffId';

    public function findAllWithUserInfo()
    {
        $query = "SELECT n.*, u.fullName, u.nameWithInitial
                  FROM nonacademicstaff n
                  JOIN users u ON n.regNo = u.regNo
                  ORDER BY n.{$this->order_column} ASC";
        return $this->query($query);
    }
}


