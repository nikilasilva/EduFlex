<?php

class CurrentActModel {
    use Model;

    protected $table = 'Timetables';
    protected $allowedColumns = [
        'timetableId',
        'classId',
        'subjectId',
        'teacherId',
        'periodId',
        'day',
        'roomNumber'
    ];

    protected $order_column = 'periodId'; // Default ordering by periodId

    // Fetch free classes where teachers are absent
    public function getFreeClasses() {
        $sql = "SELECT t.timetableId, t.classId, c.className, t.subjectId, s.subjectName, 
                       t.teacherRegNo, te.firstName AS teacherFirstName, te.lastName AS teacherLastName, 
                       t.periodId, p.periodName, t.day, t.roomNumber
                FROM Timetables t
                JOIN Classes c ON t.classId = c.classId
                JOIN Subjects s ON t.subjectId = s.subjectId
                JOIN Teachers te ON t.teacherRegNo = te.teacher_id
                JOIN Periods p ON t.periodId = p.periodId
                LEFT JOIN TeacherAttendance ta ON t.teacherRegNo = ta.teacherRegNo 
                    --    AND ta.date = CURDATE()
                WHERE ta.status = 'Absent'";

        return $this->query($sql);
    }

    // Fetch available teachers for a specific free class
    public function getAvailableTeachers($subjectId, $periodId, $day) {
        $sql = "SELECT DISTINCT t.teacher_id, u.fullName, u.email, u.mobileNo
            FROM Teachers t
            JOIN Teacher_Subjects ts ON t.teacher_id = ts.teacherRegNo
            LEFT JOIN TeacherAttendance ta ON t.teacher_id = ta.teacherRegNo 
                -- AND ta.date = CURDATE()
            LEFT JOIN Timetables tt ON t.teacher_id = tt.teacherRegNo 
                AND tt.periodId = :periodId 
                AND tt.day = :day
            LEFT JOIN users u ON t.regNo = u.regNo  -- Joining users table to get mobileNo
            WHERE ts.subjectId = :subjectId 
            AND ta.status = 'Present'
            AND tt.timetableId IS NULL";


        $params = [
            'subjectId' => $subjectId,
            'periodId' => $periodId,
            'day' => $day
        ];

        return $this->query($sql, $params);
    }

    // // Get timetable for a specific class on a specific day
    // public function getClassTimetable($classId, $day) {
    //     $query = "SELECT t.timetableId, t.classId, c.className, t.subjectId, s.subjectName, 
    //                      t.teacherId, u.firstName AS teacherFirstName, u.lastName AS teacherLastName, 
    //                      t.periodId, p.periodName, p.startTime, p.endTime, t.day, t.roomNumber
    //               FROM $this->table t
    //               JOIN Classes c ON t.classId = c.classId
    //               JOIN Subjects s ON t.subjectId = s.subjectId
    //               JOIN Teachers te ON t.teacherId = te.teacherId
    //               JOIN Users u ON te.userID = u.userID
    //               JOIN Periods p ON t.periodId = p.periodId
    //               WHERE t.classId = :classId AND t.day = :day
    //               ORDER BY p.startTime";

    //     $params = [
    //         'classId' => $classId,
    //         'day' => $day
    //     ];

    //     return $this->query($query, $params);
    // }

    // // Get timetable for a specific teacher on a specific day
    // public function getTeacherTimetable($teacherId, $day) {
    //     $query = "SELECT t.timetableId, t.classId, c.className, t.subjectId, s.subjectName, 
    //                      t.teacherId, u.firstName AS teacherFirstName, u.lastName AS teacherLastName, 
    //                      t.periodId, p.periodName, p.startTime, p.endTime, t.day, t.roomNumber
    //               FROM $this->table t
    //               JOIN Classes c ON t.classId = c.classId
    //               JOIN Subjects s ON t.subjectId = s.subjectId
    //               JOIN Teachers te ON t.teacherId = te.teacherId
    //               JOIN Users u ON te.userID = u.userID
    //               JOIN Periods p ON t.periodId = p.periodId
    //               WHERE t.teacherId = :teacherId AND t.day = :day
    //               ORDER BY p.startTime";

    //     $params = [
    //         'teacherId' => $teacherId,
    //         'day' => $day
    //     ];

    //     return $this->query($query, $params);
    // }
}