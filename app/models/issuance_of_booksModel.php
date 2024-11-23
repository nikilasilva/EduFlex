<?php

class issuance_of_booksModel {

    use Model;

    protected $table = 'library_activities';
    protected $allowedColumns = [
        'student_id',
        'book_id',
        'full_name',
        'book_name',
        'issue_date',
        'receipt_date'
    ];

    protected $order_column = 'student_id'; // Defined here
}
