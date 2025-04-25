
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

    
}

