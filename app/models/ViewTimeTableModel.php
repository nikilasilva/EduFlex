<?php
class ViewTimeTableModel {
    use Model;

    protected $table = 'timetables';
    protected $allowedColumns = [
        'periodId',
        'subjectId',
        'teacherRegNo',
        'day',
        'classId'
       
    ];
     protected $order_column = 'periodId';

    // public function getTimetableByClass($classId) {
    //     $this->db->query("SELECT * FROM timetable WHERE classId = :class_id");
    //     $this->db->bind(':class_id', $classId);
    //     return $this->db->resultSet();
    // }

public function getStudentTimetable($studentId) {
    $query ="
        SELECT tt.periodId, s.subjectName, t.firstName, t.lastName, tt.day,p.startTime,p.endTime
        FROM timetables tt
        JOIN students st ON tt.classId = st.classId
        JOIN subjects s ON tt.subjectId = s.subject_id
        JOIN teachers t ON tt.teacherRegNo = t.regNo
        JOIN periods p ON tt.periodId = p.periodId
        WHERE st.student_id = :student_id
        ORDER BY tt.periodId ASC
    ";
    $params = [
        'student_id' => $studentId
    ];
    
    return $this->query($query, $params);
}



public function viewTimeTable($parentRegNo){
    $query = "SELECT s.student_id
    FROM students s
    JOIN parent_students ps ON s.regNo = ps.studentRegNo
    WHERE ps.parentRegNo = :parentRegNo";

return $this->query($query, ['parentRegNo' => $parentRegNo]);
}
}


