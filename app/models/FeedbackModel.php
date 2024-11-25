<?php
class FeedbackModel {
    use Model;

    protected $table = 'feedbacks';
    protected $allowedColumns = [
        'feedback_id',
        'content',
        'date' ,
        'is_read'       
    ];

    protected $order_column = 'date';
}