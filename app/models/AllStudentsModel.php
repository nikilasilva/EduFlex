<?php
class AllStudentsModel {
    use Model;

    protected $table = 'students';
    protected $allowedColumns = [
        'studentId',
        'regNo',
        'firstName',
        'lastName',
        'classId',
        'guardianRegNo'
    ];

    // Fetch all students with their details
    public function getAllStudents() {
        $sql = "SELECT s.studentId, s.regNo, s.firstName, s.lastName, 
                       c.className,
                       u.email, u.mobileNo, u.religion,
                       p.firstName AS parentFirstName, p.lastName AS parentLastName,
                       pu.mobileNo AS parentMobileNo
                    
                FROM students s
                JOIN users u ON s.regNo = u.regNo
                JOIN classes c ON s.classId = c.classId
                LEFT JOIN parents p ON s.guardianRegNo = p.regNo
                LEFT JOIN users pu ON p.regNo = pu.regNo
                WHERE u.role = 'student'
                ORDER BY s.studentId ASC";

        return $this->query($sql);
    }

    // Fetch all distinct religions for students
    public function getAllReligions() {
        $sql = "SELECT DISTINCT religion
                FROM users
                WHERE role = 'student' AND religion IS NOT NULL
                ORDER BY religion";

        return $this->query($sql);
    }
}