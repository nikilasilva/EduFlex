<?php

class leaving_allocated_timeModel
{
    use Model;

    protected $table = 'leaving_allocated_time';
    protected $allowedColumns = [
        'student_id',
        'certificate_id',
        'time_slot',
        'day'
    ];
    protected $order_column = 'allocated_id';

    // Method to get user email using student_id
    public function getUserEmailByStudentId($student_id)
{
    $query = "SELECT users.email 
              FROM leaving_allocated_time 
              JOIN students ON leaving_allocated_time.student_id = students.student_id 
              JOIN users ON students.regno = users.regno 
              WHERE leaving_allocated_time.student_id = :student_id 
              LIMIT 1";

    return $this->query($query, ['student_id' => $student_id])[0] ?? null;
}

}
?>
