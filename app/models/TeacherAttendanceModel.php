
<?php


class TeacherAttendanceModel
{
    use Model;

    protected $table = 'teacherattendance';

    protected $allowedColumns = [
        'attendanceId', // 'attendance_id' change to 'attendanceId',
        'teacherRegNo',// 'teacher_id' to 'teacherRegNo',
        'date', // 'attendance_date',
        'status	',  // 'status' to 'date',
        'recordedBy', // 'recordedBy' (New)
        'recordedAt' // 'recordedAt' (New)

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

