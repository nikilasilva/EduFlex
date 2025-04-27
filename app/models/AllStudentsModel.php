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

    // Fetch students with pagination
    public function getAllStudents($limit = 20, $offset = 0) {
        // Sanitize limit and offset to ensure they are integers
        $limit = (int)$limit;
        $offset = (int)$offset;
    
        $sql = "SELECT s.student_id, s.regNo, 
            u.fullName AS studentFullName, u.nameWithInitial AS studentNameWithInitial, 
            c.className,
            u.email, u.mobileNo, u.religion,
            pu.nameWithInitial AS parentNameWithInitial,
            pu.mobileNo AS parentMobileNo
            FROM students s
            JOIN users u ON s.regNo = u.regNo
            JOIN classes c ON s.classId = c.classId
            LEFT JOIN parents p ON s.guardianRegNo = p.regNo
            LEFT JOIN users pu ON p.regNo = pu.regNo
            WHERE u.role = 'student'
            ORDER BY s.student_id ASC
            LIMIT $limit OFFSET $offset;
        ";
    
        return $this->query($sql);
    }

    // Count total number of students
    public function getTotalStudents() {
        $sql = "SELECT COUNT(*) as count
                FROM students s
                JOIN users u ON s.regNo = u.regNo
                WHERE u.role = 'student'";

        return $this->query($sql)[0]->count;
    }

    // Fetch all distinct religions for students
    public function getAllReligions() {
        $sql = "SELECT DISTINCT religion
                FROM users
                WHERE role = 'student' AND religion IS NOT NULL
                ORDER BY religion";

        return $this->query($sql);
    }

    // Insert student to table
    public function insertStudent($data) {
        return $this->insert($data);
    }

    // Check duplicate studentId
    public function studentIdExists($studentId) {
        return $this->first(['student_id' => $studentId]) !== false;
    }
}