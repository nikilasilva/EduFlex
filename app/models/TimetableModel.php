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

    public $errors = [];

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
                  JOIN teachers t ON tm.teacherRegNo = t.teacher_id
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
                  JOIN teachers t ON tm.teacherRegNo = t.teacher_id
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
                  JOIN teachers t ON tm.teacherRegNo = t.teacher_id
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
                  JOIN teachers t ON tm.teacherRegNo = t.teacher_id
                  WHERE tm.teacherRegNo = :teacherRegNo AND tm.day = :day
                  ORDER BY p.periodId ASC";
    
            return $this->query($query, [
                'teacherRegNo' => $teacherRegNo,
                'day' => $day
            ]);
        }
    }

    public function checkClassScheduleConflict($classId, $periodId, $day) {
        $sql = "SELECT COUNT(*) as count FROM $this->table 
                WHERE classId = :classId AND periodId = :periodId AND day = :day";
        
        $data = [
            'classId' => $classId,
            'periodId' => $periodId,
            'day' => $day
        ];
        
        $result = $this->query($sql, $data);
        return $result[0]->count > 0;
    }

    public function checkTeacherScheduleConflict($teacherRegNo, $periodId, $day) {
        $sql = "SELECT COUNT(*) as count FROM $this->table 
                WHERE teacherRegNo = :teacherRegNo AND periodId = :periodId AND day = :day";
        
        $data = [
            'teacherRegNo' => $teacherRegNo,
            'periodId' => $periodId,
            'day' => $day
        ];
        
        $result = $this->query($sql, $data);
        return $result[0]->count > 0;
    }

    public function getTimetableByClass($classId) {
        $sql = "SELECT t.*, s.subjectName, 
                CONCAT(tc.firstName, ' ', tc.lastName) as teacherName 
                FROM $this->table t
                JOIN subjects s ON t.subjectId = s.subjectId
                JOIN teachers tc ON t.teacherRegNo = tc.teacher_id
                WHERE t.classId = :classId
                ORDER BY t.day, t.periodId";
        
        return $this->query($sql, ['classId' => $classId]);
    }

    public function getTimetableByTeacher($teacherRegNo) {
        $sql = "SELECT t.*, s.subjectName, c.className 
                FROM $this->table t
                JOIN subjects s ON t.subjectId = s.subjectId
                JOIN classes c ON t.classId = c.classId
                JOIN teachers t ON tm.teacherRegNo = t.teacher_id
                WHERE t.teacherRegNo = :teacherRegNo
                ORDER BY t.day, t.periodId";
        
        return $this->query($sql, ['teacherRegNo' => $teacherRegNo]);
    }

    public function clearTimetableByClass($classId) {
        $sql = "DELETE FROM $this->table WHERE classId = :classId";
        return $this->query($sql, ['classId' => $classId]);
    }

    public function validateUploadTimetable($data, $file) {
        $this->errors = [];

        if (empty($data['academic_year'])) {
            $this->errors['academic_year'] = 'Please select academic year.';
        }

        return empty($this->errors);
    }
}
?>
