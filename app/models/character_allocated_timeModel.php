<?php

class character_allocated_timeModel
{
    use Model;

    protected $table = 'character_allocated_time';
    protected $allowedColumns = [
        'student_id',
        'certificate_id',
        'time_slot',
        'day'
    ];
    protected $order_column = 'day';

    // Method to get user email using student_id
    public function getUserEmailByStudentIdForCharacter($student_id)
{
    $query = "SELECT users.email 
              FROM character_allocated_time 
              JOIN students ON character_allocated_time.student_id = students.student_id 
              JOIN users ON students.regno = users.regno 
              WHERE character_allocated_time.student_id = :student_id 
              LIMIT 1";

    return $this->query($query, ['student_id' => $student_id])[0] ?? null;
}

}
 ?>
