
<?php


class TeacherAttendanceModel
{
    use Model;

    protected $table = 'teacherattendance';

    protected $allowedColumns = [
        'teacher_id',
        'status',
        'attendance_date',
    ];

    protected $order_column = 'attendance_date';

    public function update($teacherId, $data)
{
    // Assuming $teacherId and $attendance_date are used as a composite key
    $this->query('UPDATE ' . $this->table . ' SET status = :status WHERE teacher_id = :teacher_id AND attendance_date = :attendance_date', [
        'teacher_id' => $teacherId,
        'attendance_date' => $data['attendance_date'],
        'status' => $data['status']
    ]);
}

public function where($conditions)
{
    $sql = 'SELECT * FROM ' . $this->table . ' WHERE ';
    $params = [];

    foreach ($conditions as $key => $value) {
        $sql .= "$key = :$key AND ";
        $params[$key] = $value;
    }

    $sql = rtrim($sql, ' AND ');

    return $this->query($sql, $params);
}



}

