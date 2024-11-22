<?php

class Current_Issuance_books {

    use Model;

    protected $table = 'library_activities';
    protected $allowedColumns = [
        'full_name',
        'student_id',
        'book_id',
        'book_id',
        'Date_of_issuance',
        'Date_of_receipt'
    ];

    protected $order_column = 'date'; // Defined here
}