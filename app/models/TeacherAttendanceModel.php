
<?php


class TeacherAttendanceModel
{
    use Model;

    protected $table = 'teacherattendance';

    protected $allowedColumns = [
        'attendanceId', // 'attendance_id' change to 'attendanceId',
        'teacherRegNo',// 'teacher_id' to 'teacherRegNo', techers table this valuw save as 'teacher_id' techers tabale's primary key in teacher_id,
        'date', // 'attendance_date',
        'status	',  // 'status' to 'date',
        'recordedBy', // 'recordedBy' (New)
        'recordedAt' // 'recordedAt' (New)

    ];

    protected $order_column = 'teacherRegNo';

    public function update($teacherId, $data)
{
    // Update query using 'date' instead of 'attendance_date'
    $this->query('UPDATE ' . $this->table . ' SET status = :status WHERE teacherRegNo = :teacherRegNo AND date = :date', [
        'teacherRegNo' => $teacherId,  // Correct column name for teacher ID
        'date' => $data['date'],  // Use 'date' here
        'status' => $data['status']  // Status for the update
    ]);
}

    
    public function where($conditions)
{
    $sql = 'SELECT * FROM ' . $this->table . ' WHERE ';
    $params = [];

    foreach ($conditions as $key => $value) {
        $sql .= $key . ' = :' . $key . ' AND ';
        $params[':' . $key] = $value;
    }

    // Remove the trailing 'AND' from the query
    $sql = rtrim($sql, ' AND ');

    return $this->query($sql, $params);
}

    

public function findAll()
{
    return $this->query("SELECT * FROM teacherattendance");
}

// public function getAttendanceByDate($date)
// {
//     return $this->query('SELECT * FROM teacherattendance WHERE date = :date', ['date' => $date]);
// }

public function getAttendanceByDate($date)
{
    $result = $this->query('SELECT * FROM teacherattendance WHERE date = :date', ['date' => $date]);
    
    if ($result === false) {
        // You can log the error here or handle it
        error_log('Query failed for date: ' . $date);
    }
    
    return $result ?: [];  // Return an empty array instead of false if query fails
}





// public function getAttendanceByTeacherAndDate($teacher_id, $date)
// {
//     $this->query('SELECT * FROM teacherattendance WHERE teacherRegNo = :teacher_id AND date = :date', [
//         ':teacher_id' => $teacher_id,
//         ':date' => $date
//     ]);
//     return $this->single();
// }




}

?>

