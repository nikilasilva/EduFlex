<?php

class manage_teacherModel
{

    use Model;

    protected $table = 'teachers';
    protected $allowedColumns = [
        'teacher_id',
        'regNo',
        'subject',
        'experience',
        'hireDate'

    ];

    protected $order_column = 'teacher_id'; // Defined here

    // Method to fetch non-academic staff along with user full name and initials
    public function findAllWithUserInfo()
    {
        $query = "SELECT n.*, u.fullName, u.nameWithInitial, s.subjectName
                  FROM teachers n
                  JOIN users u ON n.regNo = u.regNo 
                  INNER JOIN teacher_subjects ts ON ts.teacherRegNo = n.teacher_id
                  INNER JOIN subjects s ON s.subjectId = ts.subjectId
                  ORDER BY n.{$this->order_column} ASC";
        return $this->query($query);
    }

    public function assignTeacherToSubject($teacherId, $subjectId) {
        $sql = "INSERT INTO teacher_subjects (teacherRegNo, subjectId)
         VALUES (:teacherId, :subjectId)";

        $data = [
            'teacherId' => $teacherId,
            'subjectId' => $subjectId
        ];

        return $this->query($sql, $data);
    }


    public function getNextTeacherId()
    {
        $query = "SELECT teacher_id FROM {$this->table} ORDER BY teacher_id DESC LIMIT 1";
        $result = $this->query($query);
        
        if (!empty($result)) {
            $lastId = $result[0]->teacher_id; // e.g., T005
            $num = (int)substr($lastId, 1);   // remove 'T' and convert to int
            $nextNum = $num + 1;
            return 'T' . str_pad($nextNum, 3, '0', STR_PAD_LEFT); // e.g., T006
        } else {
            return 'T001'; // If table is empty
        }
    }
        
    public function getTeacherSubject($teacher_id)
    {
        return $this->query(
            "SELECT s.subjectName 
            FROM subjects s 
            JOIN teacher_subjects ts ON s.subjectId = ts.subjectId 
            WHERE ts.teacherRegNo = ?", 
            [$teacher_id]   // ← Notice the array brackets
        );
    }


    
}
