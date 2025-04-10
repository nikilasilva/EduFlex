<?php
class TeacherModel {
    use Model;

    protected $table = 'teachers';
    protected $allowedColumns = [
        'regNo',
        'firstName',
        'lastName'
    ];

    // Fetch all teachers with their details
    public function getAllTeachers() {
        $sql = "SELECT t.regNo, t.firstName, t.lastName, u.email, u.mobileNo,
                       GROUP_CONCAT(s.subjectName) as subjects
                FROM teachers t
                JOIN users u ON t.regNo = u.regNo
                LEFT JOIN teacher_subjects ts ON t.regNo = ts.teacherRegNo
                LEFT JOIN subjects s ON ts.subjectId = s.subjectId
                WHERE u.role = 'teacher'
                GROUP BY t.regNo, t.firstName, t.lastName, u.email, u.mobileNo";

        return $this->query($sql);
    }
}