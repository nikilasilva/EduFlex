<?php
class CurrentActModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Fetch free classes
    public function getFreeClasses() {
        $sql = "SELECT t.timetableId, t.classId, c.className, t.subjectId, s.subjectName, 
                       t.teacherRegNo, te.firstName AS teacherFirstName, te.lastName AS teacherLastName, 
                       t.periodId, p.periodName, t.day, t.roomNumber
                FROM Timetables t
                JOIN Classes c ON t.classId = c.classId
                JOIN Subjects s ON t.subjectId = s.subjectId
                JOIN Teachers te ON t.teacherRegNo = te.regNo
                JOIN Periods p ON t.periodId = p.periodId
                LEFT JOIN TeacherAttendance ta ON t.teacherRegNo = ta.teacherRegNo 
                       AND ta.date = CURDATE()
                WHERE ta.status = 'Absent'";
        return $this->db->query($sql)->fetchAll();
    }

    // Fetch available teachers for a specific free class
    public function getAvailableTeachers($subjectId, $periodId, $day) {
        $sql = "SELECT DISTINCT t.regNo, t.firstName, t.lastName
                FROM Teachers t
                JOIN Teacher_Subjects ts ON t.regNo = ts.teacherRegNo
                LEFT JOIN TeacherAttendance ta ON t.regNo = ta.teacherRegNo 
                       AND ta.date = CURDATE()
                LEFT JOIN Timetables tt ON t.regNo = tt.teacherRegNo 
                       AND tt.periodId = :periodId AND tt.day = :day
                WHERE ts.subjectId = :subjectId 
                AND ta.status = 'Present'
                AND tt.timetableId IS NULL";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['subjectId' => $subjectId, 'periodId' => $periodId, 'day' => $day]);
        return $stmt->fetchAll();
    }
}
?>