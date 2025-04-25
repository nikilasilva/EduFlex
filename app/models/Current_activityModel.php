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
        $query = "SELECT * FROM {$this->table} WHERE teacher_id = :teacher_id ORDER BY date DESC";
        return $this->query($query, ['teacher_id' => $teacherId]);
    }
}

