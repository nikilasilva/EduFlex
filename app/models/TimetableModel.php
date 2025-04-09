<?php

class TimetableModel {
    use Model;

    protected $table = 'timetables';

    protected $allowedColumns = [
        'timetableId',
        'classId',
        'subjectId',
        'teacherRegNo',
        'periodId',
        'day',
        'roomNumber'
    ];

    protected $order_column = 'periodId';

    /**
     * Get timetable for a specific class and day
     *
     * @param int $classId
     * @param string $day (e.g., 'Monday', 'Tuesday')
     * @return array
     */
    public function getTimetableByClassAndDay($classId, $day) {
        // Handle "All" option
        if (strtolower($day) === 'all') {
            $query = "SELECT 
                    p.periodName, 
                    p.startTime, 
                    p.endTime, 
                    s.subjectName, 
                    CONCAT(t.firstName, ' ', t.lastName) AS teacherName,
                    tm.roomNumber,
                    tm.day
                  FROM timetables tm
                  JOIN periods p ON tm.periodId = p.periodId
                  JOIN subjects s ON tm.subjectId = s.subjectId
                  JOIN teachers t ON tm.teacherRegNo = t.regNo
                  WHERE tm.classId = :classId
                  ORDER BY tm.day, p.periodId ASC";
                  
            return $this->query($query, ['classId' => $classId]);
        } else {
            // Original query for a specific day
            $query = "SELECT 
                    p.periodName, 
                    p.startTime, 
                    p.endTime, 
                    s.subjectName, 
                    CONCAT(t.firstName, ' ', t.lastName) AS teacherName,
                    tm.roomNumber
                  FROM timetables tm
                  JOIN periods p ON tm.periodId = p.periodId
                  JOIN subjects s ON tm.subjectId = s.subjectId
                  JOIN teachers t ON tm.teacherRegNo = t.regNo
                  WHERE tm.classId = :classId AND tm.day = :day
                  ORDER BY p.periodId ASC";
    
            return $this->query($query, [
                'classId' => $classId,
                'day' => $day
            ]);
        }
    }


    // For teacher timetable
    public function getTimetableByTeacherAndDay($teacherRegNo, $day) {
        // Handle "All" option
        if (strtolower($day) === 'all') {
            $query = "SELECT 
                    p.periodName, 
                    p.startTime, 
                    p.endTime, 
                    s.subjectName, 
                    c.className,
                    tm.roomNumber,
                    tm.day
                  FROM timetables tm
                  JOIN periods p ON tm.periodId = p.periodId
                  JOIN subjects s ON tm.subjectId = s.subjectId
                  JOIN classes c ON tm.classId = c.classId
                  WHERE tm.teacherRegNo = :teacherRegNo
                  ORDER BY tm.day, p.periodId ASC";
                  
            return $this->query($query, ['teacherRegNo' => $teacherRegNo]);
        } else {
            // Query for a specific day
            $query = "SELECT 
                    p.periodName, 
                    p.startTime, 
                    p.endTime, 
                    s.subjectName, 
                    c.className,
                    tm.roomNumber
                  FROM timetables tm
                  JOIN periods p ON tm.periodId = p.periodId
                  JOIN subjects s ON tm.subjectId = s.subjectId
                  JOIN classes c ON tm.classId = c.classId
                  WHERE tm.teacherRegNo = :teacherRegNo AND tm.day = :day
                  ORDER BY p.periodId ASC";
    
            return $this->query($query, [
                'teacherRegNo' => $teacherRegNo,
                'day' => $day
            ]);
        }
    }
}
