<?php

class Current_activityModel {

    use Model;

    protected $table = 'current_activity';
    protected $allowedColumns = [
        'activity_id',
        'teacher_id',
        'date',
        'description',
        'additional_note'
    ];

    protected $order_column = 'date'; // Defined here
}

