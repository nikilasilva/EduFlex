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

        $sql = "SELECT t.regNo, t.teacher_id, u.fullName, u.email, u.mobileNo,
                       GROUP_CONCAT(s.subjectName) as subjects, c.className
                FROM teachers t
                JOIN users u ON t.regNo = u.regNo
                LEFT JOIN teacher_subjects ts ON t.teacher_id = ts.teacherRegNo
                LEFT JOIN subjects s ON ts.subjectId = s.subjectId
                LEFT JOIN class_teacher ct ON ct.teacher_id = t.teacher_id
                LEFT JOIN classes c ON ct.classId = c.classId
                WHERE u.role = 'teacher'
                GROUP BY t.teacher_id, t.firstName, t.lastName, u.email, u.mobileNo
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
        
        $sql = "SELECT t.teacher_id 
            FROM teachers t
            INNER JOIN users u ON u.regNo = t.regNo 
            WHERE u.fullName = :fullName";
        
        $data = [
            'fullName' => $fullName
        ];
        
        $result = $this->query($sql, $data);
        return $result ? $result[0]->teacher_id : null;
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

    // Fetch all classes with their current teachers
    public function getClassesWithTeachers($academicYear = null) {
        $sql = "SELECT 
                    c.classId, 
                    c.className, 
                    c.academicYear,
                    GROUP_CONCAT(CONCAT('(', t.teacher_id, ')', ' ', t.firstName, ' ', t.lastName)) as teacherName
                FROM classes c
                LEFT JOIN class_teacher ct ON c.classId = ct.classId
                LEFT JOIN teachers t ON ct.teacher_id = t.teacher_id";
        
        if ($academicYear) {
            $sql .= " WHERE c.academicYear = :academicYear";
        }

        $sql .= " GROUP BY c.classId, c.className, c.academicYear";

        $data = $academicYear ? ['academicYear' => $academicYear] : [];
        return $this->query($sql, $data);
    }

    // Fetch teachers who are not assigned to any class
    public function getTeachersForAssignment() {
        $sql = "SELECT t.teacher_id, CONCAT(t.firstName, ' ', t.lastName) as teacher_name 
                FROM teachers t
                JOIN users u ON t.regNo = u.regNo 
                LEFT JOIN class_teacher ct ON t.teacher_id = ct.teacher_id
                WHERE u.role = 'teacher' AND ct.teacher_id IS NULL
                GROUP BY t.teacher_id, t.firstName, t.lastName";
        return $this->query($sql);
    }

    // Assign teachers to a class
    // Assign teachers to a class
    public function assignTeacherToClass($classId, $teacherId) {
        try {
            // First check if a record already exists
            $checkSql = "SELECT COUNT(*) as count FROM class_teacher WHERE classId = :classId";
            $result = $this->query($checkSql, ['classId' => $classId]);
            
            if ($result && $result[0]->count > 0) {
                // Update existing record
                $sql = "UPDATE class_teacher 
                        SET teacher_id = :teacherId 
                        WHERE classId = :classId";
            } else {
                // Insert new record
                $sql = "INSERT INTO class_teacher (classId, teacher_id) 
                        VALUES (:classId, :teacherId)";
            }
            
            $data = [
                'teacherId' => $teacherId,
                'classId' => $classId
            ];
            
            $this->query($sql, $data);
            return true;
        } catch (Exception $e) {
            // Log the error
            error_log("Error assigning teacher: " . $e->getMessage());
            return false;
        }
    }

    public function getTeacherId($regNo) {
        $sql = "SELECT t.teacher_id
            FROM teachers t
            INNER JOIN users u ON u.regNo = t.regNo
            WHERE t.regNo = :regNo";
        $result = $this->query($sql, ['regNo' => $regNo]);
        return is_array($result) && !empty($result) ? $result[0]->teacher_id : "";
    }
}