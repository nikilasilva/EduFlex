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
}
