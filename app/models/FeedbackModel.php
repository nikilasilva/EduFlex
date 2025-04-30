<?php
class FeedbackModel {
    use Model;

    protected $table = 'feedbacks';
    protected $allowedColumns = [
        'feedback_id',
        'content',
        'date' ,
        'is_read',
        'recipient',
        'user_id',
        'parentRegNo'
           
    ];

    protected $order_column = 'date';

    public function findByParentId($parentRegNo) {
        $query ="SELECT * FROM feedbacks WHERE parentRegNo = :parentRegNo";
    
        return $this->query($query, ['parentRegNo' => $parentRegNo]);

    
        
    }

    public function findById($feedback_id) {
        $query = "SELECT * FROM feedbacks WHERE feedback_id = :id";
        return $this->query($query, ['feedback_id' => $feedback_id]);
    }
}
    






