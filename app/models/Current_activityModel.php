<?php

class Current_activityModel {

    use Model;
    

    protected $table = 'current_activity';
    protected $allowedColumns = [
        'activity_id',
        'teacher_id',
        'date',
        'period',
        'subject',
        'class',
        'description',
        'additional_note'
    ];

    protected $custom_order_column = 'date'; // Renamed to avoid conflict

    // Fetch activities for the current logged-in teacher
    public function getTeacherActivities($teacherId) {
        $query = "
            SELECT ca.*, c.className 
            FROM {$this->table} ca
            JOIN classes c ON ca.class = c.classId
            WHERE ca.teacher_id = :teacher_id
            ORDER BY ca.date DESC
        ";
        return $this->query($query, ['teacher_id' => $teacherId]);
    }
    
}
