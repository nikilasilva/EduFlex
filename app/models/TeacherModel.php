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
    public function getAllTeachers($limit = 25, $offset = 0) {
        $limit = (int)$limit;
        $offset = (int)$offset;

        $sql = "SELECT t.regNo, t.firstName, t.lastName, u.email, u.mobileNo,
                       GROUP_CONCAT(s.subjectName) as subjects, c.className
                FROM teachers t
                JOIN users u ON t.regNo = u.regNo
                LEFT JOIN teacher_subjects ts ON t.regNo = ts.teacherRegNo
                LEFT JOIN subjects s ON ts.subjectId = s.subjectId
                LEFT JOIN classes c ON c.classTeacherRegNo = t.regNo
                WHERE u.role = 'teacher'
                GROUP BY t.regNo, t.firstName, t.lastName, u.email, u.mobileNo
                LIMIT $limit OFFSET $offset";

        return $this->query($sql);
    }

    // Count total number of teachers
    public function getTotalTeachers() {
        $sql = "SELECT COUNT(*) as count
                FROM teachers t
                JOIN users u ON t.regNo = u.regNo
                WHERE u.role = 'teacher'";

        return $this->query($sql)[0]->count;
    }

    public function getTeacherRegNoByFullName($fullName) {
        // Split the full name into first and last name
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        
        $sql = "SELECT regNo FROM teachers 
                WHERE firstName = :firstName AND lastName = :lastName";
        
        $data = [
            'firstName' => $firstName,
            'lastName' => $lastName
        ];
        
        $result = $this->query($sql, $data);
        return $result ? $result[0]->regNo : null;
    }
    
    public function isTeacherAssignedToSubject($teacherRegNo, $subjectId) {
        $sql = "SELECT COUNT(*) as count FROM teacher_subjects 
                WHERE teacherRegNo = :teacherRegNo AND subjectId = :subjectId";
        
        $data = [
            'teacherRegNo' => $teacherRegNo,
            'subjectId' => $subjectId
        ];
        
        $result = $this->query($sql, $data);
        return $result[0]->count > 0;
    }
}