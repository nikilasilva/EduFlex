<?php
class AbsenceModel {
    use Model;

    protected $table = 'absences';
    protected $allowedColumns = [
        'absence_id',
        'student_id',
        'content',
        'date',
        
    ];

    protected $order_column = 'date';
}